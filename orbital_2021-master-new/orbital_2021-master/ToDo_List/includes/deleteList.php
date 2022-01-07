<?php

if (isset($_POST['listId'])) {

    include('database_connection.php');
    
    $id = $_POST['listId'];
    
    if (empty($id)) 
    {
        echo 'error1';
    } 
    else
    {
        $deleteTasks = $conn -> prepare("DELETE FROM tasks WHERE listId = $id");
        $res = $deleteTasks-> execute();

        if ($res) 
        {
            echo 'success1';
            $deleteList = $conn -> prepare("DELETE FROM taskList WHERE listId = $id");
            $req = $deleteList-> execute();
            if ($req) 
            {
                echo 'success2';
            }
            else
            {
                echo 'error2';
            }
        }
        else
        {
            echo 'error3';
        }

        $conn = null;
        exit();
    }
} 
else
{
    echo 'error4';
}

?>