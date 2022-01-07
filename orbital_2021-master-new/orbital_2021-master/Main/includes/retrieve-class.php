<?php 
    require('database_connection.php');
    $userid = $_SESSION["userid"];

    date_default_timezone_set('Singapore');

    $todayDay = date('l');
    $currentTime = date("H:i");
    $haveClass = 0;


    switch($todayDay) {
        case "Monday":
            $dayOn = 1;
            break;
        case "Tuesday":
            $dayOn = 2;
            break;
        case "Wednesday":
            $dayOn = 3;
            break;
        case "Thursday":
            $dayOn = 4;
            break;
        case "Friday":
            $dayOn = 5;
            break;
        case "Saturday":
            $dayOn = 6;
            break;
        case "Sunday":
            $dayOn = 7;
            break;
        default:
            echo "switch statement not working";
    }

    $timetable = $conn -> query("SELECT * FROM schedules");
    $classes = $conn -> query("SELECT * FROM schedules WHERE userId = '$userid' AND dayOn = '$dayOn' ORDER BY startTime ASC");
?>

<?php if (mysqli_num_rows($classes) > 0) { ?>
            <?php while($row = $classes->fetch_assoc()) {    
                $start = substr( $row['startTime'], -4 );   
                $end = substr( $row['endTime'], -4 ); 
                if ($currentTime >= $start) { // class either started or over alr
                    if ($currentTime <= $end) {  //class on gg
                        $haveClass = 1;?>
                        <li class = "next-class">  
                            <p class = "modname"><?php echo $row['moduleName']?></p>
                            <p class = "modcode"><?php echo $row['moduleCode']?> - <?php echo $row['classNo']?></p>
                            <p class = "modtime"> NOW &nbsp; — &nbsp;From <?php echo $start?> to <?php echo $end?></p>
                        </li>
                    <?php 
                    }
                } else if ($currentTime <= $start) {  // havent start yet 
                    $haveClass = 1;?>
                    <li class = "next-class">  
                        <p class = "modname"><?php echo $row['moduleName']?></p>
                        <p class = "modcode"><?php echo $row['moduleCode']?> - <?php echo $row['classNo']?></p>
                        <p class = "modtime"> At <?php echo $start?> to <?php echo $end?></p>
                    </li>
            <?php } ?> 
            <?php 
                }  
        } else { 
            $haveClass == 0;
        }  
    
    if ($haveClass == 0)
    { ?>
        <li class = "no-class">  
                <p> No Upcoming Classes Today </p>
        </li>
    <?php } ?>

