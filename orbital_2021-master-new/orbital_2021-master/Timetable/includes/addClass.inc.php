<?php
    include_once 'dbh.inc.php';
    session_start();
    
    $userID = $_SESSION["userid"];
    
    /*
    echo $userID;
    if (isset($_POST['submit'])) {
        if (!empty($_POST['selectClass'])) {
            $selected = explode(",", $_POST['selectClass']);
            echo print_r($selected);
            echo '<br>';
            echo is_array($selected) ? 'yes' : 'no';
            echo '<br>';
        }
    }
    */

    if (isset($_POST['submit'])) {
        if (!empty($_POST['selectClass'])) {
            $selected = explode(",", $_POST['selectClass']);
            $moduleCode = $selected[4];
            echo $moduleCode;
            $moduleName = $selected[5];
            echo $moduleName;
            $classNo = $selected[0];
            echo $classNo;
            $startTime = $selected[2];
            //echo $startTime;
            $endTime = $selected[3];
            //echo $endTime;
            switch($selected[1]) {
                case " Monday":
                    $dayOn = 1;
                    $startTime += 10000;
                    $endTime +=10000;
                    break;
                case " Tuesday":
                    $dayOn = 2;
                    $startTime += 20000;
                    $endTime +=20000;
                    break;
                case " Wednesday":
                    $dayOn = 3;
                    $startTime += 30000;
                    $endTime +=30000;
                    break;
                case " Thursday":
                    $dayOn = 4;
                    $startTime += 40000;
                    $endTime +=40000;
                    break;
                case " Friday":
                    $dayOn = 5;
                    $startTime += 50000;
                    $endTime +=50000;
                    break;
                default:
                    echo "switch statement not working";
            }
            echo $dayOn;
            echo $startTime;
            echo $endTime;
        } else {
            $userID = null;
            $moduleCode = null;
            $moduleName = null;
            $classNo = null;
            $dayOn = null;
            $startTime = null;
            $endTime = null;
        }
    }

    function classExists($conn, $uid, $start, $end) {
        $sql = "SELECT * FROM schedules
                WHERE userID = ? AND (startTime = ? OR endTime = ?);";
                //WHERE startTime = ? OR endTime = ? OR (? > startTime AND ? < endTime) OR (? > startTime AND ? < endTime);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../Timetable.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "iii", $uid, $start, $end);
        //mysqli_stmt_bind_param($stmt, "iiiiii", $start, $end, $start, $start, $end, $end);
        mysqli_stmt_execute($stmt);
    
        $resultData = mysqli_stmt_get_result($stmt);
    
        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        
        /* Logic 
        if ($start = $startTime OR $end = $endTime OR ($start > $startTime  AND $start < $endTime) OR ($end > $startTime AND $end < $endTime) {
            $result = false;
            return $result;
        }
        */
        mysqli_stmt_close($stmt);		
    }

    if(classExists($conn, $userID, $startTime, $endTime) === false) {
        $sql = "INSERT INTO schedules (userID, moduleCode, moduleName, classNo, dayOn, startTime, endTime)
                    VALUES ('$userID', '$moduleCode', '$moduleName', '$classNo', '$dayOn', '$startTime', '$endTime');";
        mysqli_query($conn, $sql);
        $strModuleCode =preg_replace('/\s+/', '', $moduleCode);
        header("location: ../Timetable.php?mod={$strModuleCode}");
    } else {
        header("location: ../Timetable.php?error=clashingtime");
        exit();
    }
?>