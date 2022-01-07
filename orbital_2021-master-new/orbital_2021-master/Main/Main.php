<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleMain.css">
        <style>
            <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey bg_img">
   
    <!-- Main -->
    <div class="main">

        <?php
            include_once '../Header/Header.php';          
            if (!isset($_SESSION["useruid"])) {
        ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="main_h_img">
                        <img src="./img/user.png">
                    </div>
                    <div class="main0">
                        <p class="main0-left fontsset1"><a href="../Login_Signup/Signup.php">Sign Up</a></p>
                        <p class="main0-right fontsset1"><a href="../Login_Signup/Login.php">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php 
            } else { 
        ?>

        <div class="container main-left">
            
        </div>
        

        <div class = "main-right bg_color">
            <p class="fontsset1"></p>

            <div class="container bg_main">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class = "main_sec">
                            <?php echo "<h2 class = 'fontsset2'>Hello there, " . $_SESSION["useruid"] . "</h2>"; ?>   
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 border_r">
                        <div class="dashboard">
                        <div class = "right-header">
                            <h1> What's due soon? </h1>
                            <div class="selectMax">
                                <select id = "maximumTasks">
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                    <option value="7">7</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                            <ul id = "upcoming-tasks">
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="class-reminder">
                            <h1><a href="../Timetable/Timetable.php">Upcoming classes</a></h1>
                            <div class = "upcoming-class" >
                                <ul id = "upcoming-class">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>

        <?php
            }
        ?>
        
    </div>

    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

    $(document).ready(function() {  

        const localStorageKeyCurrentMaxValue = 'current.max.value' 
        currentMax = localStorage.getItem(localStorageKeyCurrentMaxValue);
        if (currentMax == null || currentMax == "0")
        {
            currentMax = 3;
        }
        $('#maximumTasks').val(currentMax);

        function loadTasks() {
            $.ajax({ 
                    type: "POST", 
                    url: "includes/retrieve.php", 
                    data: {max : document.getElementById("maximumTasks").value}, 
                    success: function(data) { 
                        $('#upcoming-tasks').html(data);
                    } 
            });
        }

        loadTasks();

        function loadClass() {
            $.ajax({ 
                    type: "POST", 
                    url: "includes/retrieve-class.php", 
                    success: function(data) { 
                        $('#upcoming-class').html(data);
                    } 
            });
        }

        loadClass(); 

        $('.selectMax').on("change", "#maximumTasks", function() {
            var newMax = document.getElementById("maximumTasks").value;
            localStorage.setItem(localStorageKeyCurrentMaxValue, newMax);
            loadTasks();
        });

        
    });

</script>