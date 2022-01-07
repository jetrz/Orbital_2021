<?php

if (isset($_POST['taskId'])) {

    require('database_connection.php');
    session_start();

    $useruid = $_SESSION["useruid"];    

    $id = $_POST['taskId'];

    
    if (empty($id)) 
    {
        echo 'error';
    } 
    else
    {
        $todoTasks = $conn -> query("SELECT * FROM tasks WHERE taskId= $id");

        $todoTask = $todoTasks->fetch_assoc();
        $uId = $todoTask['taskId'];
        $checked = $todoTask['taskChecked'];

        if ($checked == 1) 
        {
            $uChecked = 0;
        }
        else
        {
            $uChecked = 1;
        }

        $res = $conn-> query(
            "UPDATE tasks 
            SET taskChecked= $uChecked
            WHERE taskId = $id"
            );

        if ($res) 
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }

        $conn = null;
        exit();
    }
    
} 
else
{
    echo 'error';
}

?>