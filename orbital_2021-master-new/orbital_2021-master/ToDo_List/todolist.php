<?php
  include_once 'includes/database_connection.php';
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../ToDo_List/styleTodoList.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
             <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey bg_img">

    <?php
            include_once '../Header/Header.php';          
            if (!isset($_SESSION["useruid"])) {
                header("Location: ../Main/Main.php");
            } else { 
                $userid = $_SESSION['useruid'];

                $getquery = "SELECT * FROM tasks
                ORDER BY taskId DESC";

                $alltasks = mysqli_query($conn, $getquery);
    ?>
    

    <div class = "to-do-body">

        <div class="container bg_to_do">
            <div class="row">
                <div class="col-md-12">
                    <h1 class = "title fontsset1">To-Do List</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    
                    <div class="all-tasks fontsset1">
                        <h2 class="tasks-list-title">Task Lists</h2>
                        <ul class="task-list" data-lists>
                            <?php 
                                $taskList = $conn -> query("SELECT * FROM taskList WHERE userId = '$userid' ORDER BY listId ASC");
                            ?>
                            <?php while($listRow = $taskList->fetch_assoc()) { ?>
                                <li class = "listElement" id = '<?php echo $listRow['listId']?>'> 
                                    <?php echo $listRow['listName']?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="all-tasks fontsset1">
                        <form action="includes/addList.php" method = "POST" autocomplete = "off">
                            <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error1') { ?>
                                <input type="text"
                                name = "listName"
                                class = "new list"
                                data-new-list-input
                                placeholder="This is a required field"
                                aria-label="New List Name"
                                />
                                <button class="btn-list" aria-label="create new list">+</button>
                            <?php } else { ?>
                                <input type="text"
                                name = "listName"
                                class = "new list"
                                data-new-list-input
                                placeholder="Create New List"
                                aria-label="New List Name"
                                />
                                <button class="btn-list" aria-label="create new list">+</button>
                            <?php } ?>
                        </form> 
                    </div>

                </div>

                <div class="col-md-10">
                    
                    <div class="todo-list">
                        <div id = "todo-container">
                        </div>
                    </div>
                            
                    <div class="errorPopout" id = "errorpopout">
                        <div class="errorPopout-content" >
                            <h1 class = "task-title">Error</h1>
                            <div class="errorMessage">
                                <p>Please enter a value!</p>
                            </div>
                            <button class = "close-btn"> Close </button>
                        </div>
                    </div>

                    <div class="errorPopout" id = "invalidDateErrorpopout">
                        <div class="errorPopout-content" >
                            <h1 class = "task-title">Error</h1>
                            <div class="invalidErrorMessage">
                                <p>Please enter a valid date (YYYY-MM-DD)!</p>
                            </div>
                            <button class = "close-btn"> Close </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
        
    </div>
        <!-- </div>
        <template id = "task-template">
            <div class="task">
                <input type="checkbox"/>
                <label class = "name">
                    <span class = "custom-checkbox"></span>
                </label>
                <label class = "deadline">
                    <span class = "deadline"></span>
                </label>
                <button class= "option-btn">
                    <i class = "material-icons" data-option-button>more_horiz</i>
                </button>
            </div>
        </template> -->
    </body>
    <?php 
        }
    ?>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

    const localStorageKeyCurrentList = 'current.list.selection' 
    currentListId = localStorage.getItem(localStorageKeyCurrentList);

    var errorPopoutBox = document.getElementById("errorpopout")

    var invalidErrorPopoutBox = document.getElementById("invalidDateErrorpopout")
    
    invalidErrorPopoutBox.style.display = 'none'
    errorPopoutBox.style.display = 'none'

    $(document).ready(function() {

        function loadTasks() {
            $.ajax({ 
                    type: "POST", 
                    url: "includes/show-task.php", 
                    data: {currentListId : currentListId}, 
                    success: function(data) { 
                        $("#todo-container").html(data);
                    } 
            });
        }

        loadTasks();

        $('.btn-task').click(function(){
            $.post("includes/add.php", 
            {
                listId: currentListId
            })
        });

        $('.btn-clear').click(function(){

            $.post("includes/delete.php",
            {
                id: 100
            },
            (data) => {
                window.location.reload();
            });
        });

        $('.material-icons').click(function() {
            const taskId = $(this).attr('id');
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            popoutBox.style.display = 'flex'
        });

        $('.cancel-btn').click(function() {
            const taskId = $(this).attr('id');
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            popoutBox.style.display = 'none'
        });

        $('.close-btn').click(function() {
            errorPopoutBox.style.display = 'none'
            invalidErrorPopoutBox.style.display = 'none'
        });

        $('.listElement').click(function() {
            const listId = $(this).attr('id');
            if (currentListId != listId) //diff list
            {
                if (currentListId != null && currentListId != "null" && currentListId != 0)
                {
                    const currListItem = document.getElementById(currentListId);
                    if (currListItem == null)
                    {
                        currentListId = 'null';
                        save();
                    }
                    else
                    {
                        currListItem.classList.remove('active-list');
                    }
                }
                const listItem = document.getElementById(listId);
                listItem.classList.add('active-list');
                currentListId = listId;
                save();
            }
            else
            {
                const currlistItem = document.getElementById(currentListId);
                currlistItem.classList.remove('active-list');
                currentListId = 0;
                save();
            }
            init();
            loadTasks();
        })

        function init()
        {
            if (currentListId != null && currentListId != "null" && currentListId != 0)
            {
                const currListItem = document.getElementById(currentListId);
                if (currListItem == null)
                {
                    currentListId = 'null';
                    save();
                }
                else
                {
                    currListItem.classList.add('active-list');
                }
            }
        }

        init();

        function save()
        {
            localStorage.setItem(localStorageKeyCurrentList, currentListId);
        }

    });

</script>