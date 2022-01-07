<?php

if (isset($_POST['array'])) {

    include_once 'database_connection.php';
    session_start();
    
    $array = $_POST['array'];
    $id = $array[0];
    $newName = $array[1];
    $newDeadline = $array[2];

    function validateDate($input, $format = 'Y-m-d'){
        $valid = DateTime::createFromFormat($format, $input);
        return $valid && $valid->format($format) === $input;
    }

    function validateDate2($input, $format = 'Y/m/d'){
        $valid = DateTime::createFromFormat($format, $input);
        return $valid && $valid->format($format) === $input;
    }
    
    if (empty($id)) 
    {
        echo 'emptyerror';
    } 
    else
    {

        if ($newName != null && $newDeadline != null)
        {
            if (validateDate($newDeadline) || validateDate2($newDeadline))
            { 
                $res = $conn-> query(
                    "UPDATE tasks 
                    SET taskName= '$newName', taskDeadline = '$newDeadline'
                    WHERE taskId = $id"
                    );
            }
            else 
            {
                $res = false;
                echo('invalid-date-');
            }
        } 
        else if ($newDeadline != null || $newDeadline != '')
        {
            if (validateDate($newDeadline) || validateDate2($newDeadline))
            { 
                $res = $conn-> query(
                    "UPDATE tasks 
                    SET taskDeadline = '$newDeadline'
                    WHERE taskId = $id"
                    );
            }
            else 
            {
                $res = false;
                echo('invalid-date-');
            }
        }
        else if ($newName != null)
        {
            $res = $conn-> query(
                "UPDATE tasks 
                SET taskName= '$newName'
                WHERE taskId = $id"
                );
        } 
        else
        {
            $res = false;
            echo 'missing-value-';
        }
        
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