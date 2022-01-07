<?php 
    include_once 'database_connection.php';    
    session_start();

    $useruid = $_SESSION["useruid"];

    if (isset($_POST ['currentListId'])) {
        $list_id = $_POST['currentListId'];

        if ($list_id != null && $list_id != 0) {
            $list = $conn -> query("SELECT * FROM taskList WHERE listId = $list_id AND userId = '$useruid' ");
            $selectedList = $list -> fetch_assoc();
                if ($selectedList != null) 
                {
                    $listName = $selectedList['listName'];
                    $todoTasks = $conn -> query("SELECT * FROM tasks WHERE listId = '$list_id' AND userId = '$useruid' ORDER BY taskId ASC");
?>
          <div class="todoheader" id = "todoheader">
                <h2 class= "list-title fontsset1" data-list-title><?php echo $listName?></h2>
            </div>

            <div class="todobody" >
                <div class="tasks" data-list-tasks>
                    <?php while($row = $todoTasks->fetch_assoc()) { ?>
                    <div class="task">
                        <div class = "taskContent">
                        <input type="checkbox" class = "task-checkbox" id = "<?php echo $row['taskId']?>" <?php echo ($row['taskChecked']==1 ? 'checked' : '');?>/>
                        <label for = "<?php echo $row['taskId']?>" class = "name fontsset1">
                            <span class = "custom-checkbox"></span>
                            <?php echo $row['taskName']?>
                        </label>
                        <button class= "option-btn">
                            <i class = "material-icons" id = "<?php echo $row['taskId']?>">more_horiz</i>
                        </button>   
                                <?php if ($row['taskDeadline'] !== null) {
                                        $todayDate = date("Y-m-d");
                                        if ($row['taskDeadline'] == $todayDate) 
                                        { ?>
                                        <label class = "deadline fontsset1" style = "color: red; font-size: 15px;">DUE: TODAY</label>
                                        <?php } 
                                        else if ($row['taskDeadline'] < $todayDate) // overdue
                                        { ?>
                                        <label class = "deadline fontsset1" style = "color: red;">OVERDUE: <?php echo $row['taskDeadline'];?></label>
                                        <?php } 
                                        else // not due yet
                                        { ?>
                                        <label class = "deadline fontsset1">DUE: <?php echo $row['taskDeadline'];?></label>
                                        <?php } 
                                    
                                } else { 
                                ?>
                                    <label class = "nulldeadline"></label>
                                <?php } ?>  
                        </div>

                        <div class="holder">
                        <div class="popout" id = "<?php echo $row['taskId']?>editorPopout">
                            
                            <div class="popout-content" >
                                <h1 class = "task-title fontsset1">Task</h1>

                                <div class="cancel">
                                    <button class = "cancel-btn" id = "<?php echo $row['taskId']?>"> X </button>
                                </div>

                                <div class = "edit-task">
                                    <form action = "" method = "POST" name = "editForm">
                                        <div class = "nameInput">
                                            <label class = "fontsset1"> 
                                                Task Name: 
                                            </label>
                                            <input 
                                                type = "text"
                                                name = "newName"
                                                id = "<?php echo $row['taskId']?>editName"
                                                class = "edit task-name"
                                                placeholder= "new task name"
                                            />
                                        </div>
                                        <div class = "dateInput">
                                            <label class = "fontsset1"> 
                                                Deadline: 
                                            </label>
                                            <input 
                                                type = "date"
                                                name = "newDeadline"
                                                id = "<?php echo $row['taskId']?>editDeadline"
                                                class = "edit task-deadline"
                                                placeholder= "yyyy/mm/dd" 
                                            /> 
                                        </div>
                                        <div class = "submitInput">
                                            <button class = "save-btn fontsset1" type = "button" id = "<?php echo $row['taskId']?>"> Save </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="new-task-creator">
                    <form action = "includes/add.php" method = "POST" autocomplete = "off">
                        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                            <input type="text"
                            name = "taskname"
                            class = "new addtask"
                            data-new-task-input
                            placeholder="This is a required field"
                            aria-label="New Task Name"
                            maxlength = "30"
                            />
                            <input type="hidden" id="currList" name="currList" value = "4">
                            <button type = "submit" name = "submit" class="btn-task" aria-label="create new task">+</button>
                        <?php } else { ?>
                            <input type="text"
                            name = "taskname"
                            class = "new addtask"
                            data-new-task-input
                            placeholder="New Task Name"
                            aria-label="New Task Name"
                            maxlength = "30"
                            />
                            <input type="hidden" id="currList" name="currList" value = "4">
                            <button type = "submit" name = "submit" class="btn-task" aria-label="create new task">+</button>
                        <?php } ?>
                    </form>
                </div> 

                <div class="delete-tasks">
                    <button class = "btn-clear fontsset1" data-clear-list>Clear Selected Tasks</button>
                    <button class = "btn-delete fontsset1" data-delete-list>Delete List</button>
                </div>
            </div>


<?php 
            } else {
                

?>

        <div class="todoheader" id = "todoheader">
                <h2 class= "list-title" data-list-title>No List Selected</h2>
            </div>

            <div class="todobody">
            <p>
                Please select a list to start
            </p>
            </div>

<?php       }
        } else { 
?>
            <div class="todoheader" id = "todoheader">
                <h2 class= "list-title" data-list-title>No List Selected</h2>
            </div>

            <div class="todobody">
            <p>
                Please select a list to start
            </p>
            </div>
<?php } 
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">

    currentListId = localStorage.getItem(localStorageKeyCurrentList) 

    errorPopoutBox = document.getElementById("errorpopout")


    $(document).ready(function() {

        $('.task-checkbox').click(function(){
            const taskId = $(this).attr('id');
            $.ajax({ 
                type: "POST", 
                url: "includes/update.php", 
                data: {taskId : taskId},
            }); 

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
            popoutBox.style.display = 'flex';
        });

        $('.cancel-btn').click(function() {
            const taskId = $(this).attr('id');
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            popoutBox.style.display = 'none'
        });

        $('.save-btn').click(function() {
            const taskId = $(this).attr('id');
            const nameId = taskId.toString() + 'editName';
            const deadlineId = taskId.toString() + 'editDeadline';
            const newName = document.getElementById(nameId).value;
            const newDeadline = document.getElementById(deadlineId).value;
            
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            

            let array = [taskId, newName, newDeadline]

            $.ajax({ 
                type: "POST", 
                url: "includes/edit.php", 
                data: {array : array}, 
                success: function(message) { 
                    if (message === 'missing-value-error') 
                    {
                        errorPopoutBox.style.display = ''
                    }
                    else if (message === 'invalid-date-error')
                    {
                        invalidErrorPopoutBox.style.display = ''
                    }
                    else if (message === 'success')
                    {
                        popoutBox.style.display = 'none'
                        window.location.reload();
                    }
                }
            });
        }); 

        $('.btn-delete').click(function(){
            $.post("includes/deleteList.php",
            {
                listId: currentListId
            },
            (data) => {
                currentListId =  null;
                save();
                window.location.reload();
            });
        });

        if (currentListId != null && currentListId != "null" && currentListId != 0) 
        {
            const hiddenInput = document.getElementById("currList");
            if (hiddenInput != null)
            {
                hiddenInput.value = currentListId;
            }
        }
        else
        {
            const hiddenInput = document.getElementById("currList");
            if (hiddenInput != null)
            {
                hiddenInput.value = 0;
            }
        }

        function save()
        {
            localStorage.setItem(localStorageKeyCurrentList, currentListId);
        }

        
    });

</script>