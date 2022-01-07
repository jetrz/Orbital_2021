<?php

if (isset($_POST['id'])) {

    include_once 'database_connection.php';
    session_start();
    
    $id = $_POST['id'];
    
    if (empty($id)) 
    {
        echo 'error';
    } 
    else
    {
        $completed = $conn -> prepare("DELETE FROM tasks WHERE taskChecked = 1");
        $res = $completed-> execute();

        if ($res) 
        {
            echo 'success';
        }
        else
        {
            echo 'error1';
        }

        $conn = null;
        exit();
    }
} 
else
{
    echo 'error2';
}

?>