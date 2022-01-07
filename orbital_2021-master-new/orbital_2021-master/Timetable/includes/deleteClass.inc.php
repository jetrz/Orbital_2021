<?php
    include_once 'dbh.inc.php';
    session_start();
    
    $userID = $_SESSION["userid"];
    if (isset($_POST['submit'])) {
        if (!empty($_POST['moduleCode'])) {
            $moduleCode = $_POST['moduleCode'];
        }
    }

    //echo $userID;
    //echo $moduleCode;

    $sql = "DELETE FROM schedules
            WHERE userID = '$userID' AND moduleCode = '$moduleCode';";
    mysqli_query($conn, $sql) or die ('Error updating database: '.mysqli_error($conn));
    
    header("location: ../Timetable.php");
?>