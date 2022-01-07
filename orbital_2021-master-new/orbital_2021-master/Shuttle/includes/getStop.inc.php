<?php
    if (isset($_POST['submit'])) {
        if (!empty($_POST['selectStop'])) {
            $stop = $_POST['selectStop'];
            header("location: ../Shuttle.php?stop={$stop}");
		    exit();
        } else {
            header("location: ../Shuttle.php?error=invalidstop");
            exit();
        }
    }
?>