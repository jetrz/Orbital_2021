<?php

if (isset($_POST['listName'])) {

    include_once '../includes/database_connection.php';
    session_start();

    $userUID = $_SESSION["useruid"];
    
    $name = $_POST['listName'];

    if (empty($name))
    {
        header("Location: ../todolist.php?mess=error1");
    } 
    else
    {

        $query = "INSERT INTO taskList (userId, listName) VALUES ('$userUID', '$name')" ;
        
        $run = mysqli_query($conn , $query) or die(mysqli_error($conn));

        if (!$run) 
        {
            echo "failed";
        }
        else
        {
            header("Location: ../todolist.php");
        }
    }
} 
else
{
    header("Location: ../todolist.php");
}
?>