<?php
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleTimetable.css">
        <style>
            <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full bg_img">
    <?php 
      include_once '../Header/Header.php'; ?>

      <div class="block">
        
      
      <?php

      //Accessing data from database
      $userID = $_SESSION["userid"];
      $sql = "SELECT * FROM schedules WHERE userID = $userID;";
      $result = mysqli_query($conn, $sql);
      $classes = array();
      $resultCheck = mysqli_num_rows($result);
      if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)) {
          array_push($classes, $row);         
        }
      }

      $modules = array();
      //Creating list of currently selected modules
      foreach($classes as $class) {
        if (!is_null($class['userID'])) {
          $temp = array($class['moduleCode'], $class['moduleName']);
          if (!in_array($temp, $modules)) {
            $module = array($class['moduleCode'], $class['moduleName']);
            array_push($modules, $module);
          }
        }
      }

      //Creating color coding for modules

      //Increases or decreases the brightness of a color by a percentage of the current brightness.
      function adjustBrightness($hexCode, $adjustPercent) {
        $hexCode = ltrim($hexCode, '#');
        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }
        $hexCode = array_map('hexdec', str_split($hexCode, 2));
        foreach ($hexCode as & $color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);
            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }
        return '#' . implode($hexCode);
      }

      $temps = $modules;
      $coloredModules = array();
      //echo print_r($modules); 
      foreach($temps as $temp) {
        $rand = adjustBrightness(sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 0.7);
        array_push($temp, $rand);
        //echo print_r($temp);
        array_push($coloredModules, $temp);
      }
      //echo print_r($coloredModules);
    ?>  

    </div>

<div class="container-fluid table_one">
  <div class="row justify-content-center">
    <div class="col-md-12">
      
    
    <!-- Timetable -->
    <table class="timetable fontsset1 table">

      <thead>
        <tr>
          <th></th>
          <th>0800</th>
          <th>0900</th>
          <th>1000</th>
          <th>1100</th>
          <th>1200</th>
          <th>1300</th>
          <th>1400</th>
          <th>1500</th>
          <th>1600</th>
          <th>1700</th>
          <th>1800</th>
          <th>1900</th>
          <th>2000</th>
          <th>2100</th>  
        </tr>
      </thead>
      
      <?php
      $status = 'false';
      $color = 'white';
      
      /* Format of each table cell:
      foreach($classes as $class) { 
        if ($class['startTime'] <= 11600 && $class['endTime'] >= 11700) { 
          $status = 'true'; 
          foreach ($coloredModules as $coloredmodule) { 
            if ($class['moduleCode'] == $coloredmodule[0]) {
              $color= $coloredmodule[2];
      }}}}
      if ($status == 'true') {
        foreach($classes as $class) { 
          if($class['startTime'] <= 11600 && $class['endTime'] >= 11700) {
            echo "<td style='background-color:".$color."'>".
            $class['moduleCode'].' '.$class['classNo']."</td>";
          }
        }
        $status = 'false';
      } else {
        echo "<td></td>";
      }
      */

      //In one line:
      //foreach($classes as $class) { if ($class['startTime'] <= 11600 && $class['endTime'] >= 11700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11600 && $class['endTime'] >= 11700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
      
      echo "<tbody>";
        echo "<tr>";
          echo "<td>Mon</td>";
          foreach($classes as $class) { if ($class['startTime'] <= 10800 && $class['endTime'] >= 10900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 10800 && $class['endTime'] >= 10900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 10900 && $class['endTime'] >= 11000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 10900 && $class['endTime'] >= 11000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11000 && $class['endTime'] >= 11100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11000 && $class['endTime'] >= 11100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11100 && $class['endTime'] >= 11200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11100 && $class['endTime'] >= 11200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11200 && $class['endTime'] >= 11300) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11200 && $class['endTime'] >= 11300) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11300 && $class['endTime'] >= 11400) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11300 && $class['endTime'] >= 11400) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11400 && $class['endTime'] >= 11500) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11400 && $class['endTime'] >= 11500) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11500 && $class['endTime'] >= 11600) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11500 && $class['endTime'] >= 11600) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11600 && $class['endTime'] >= 11700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11600 && $class['endTime'] >= 11700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11700 && $class['endTime'] >= 11800) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11700 && $class['endTime'] >= 11800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11800 && $class['endTime'] >= 11900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11800 && $class['endTime'] >= 11900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 11900 && $class['endTime'] >= 12000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 11900 && $class['endTime'] >= 12000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 12000 && $class['endTime'] >= 12100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 12000 && $class['endTime'] >= 12100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 12100 && $class['endTime'] >= 12200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 12100 && $class['endTime'] >= 12200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
        echo "</tr>";
        
        echo "<tr>";
          echo "<td>Tue</td>";
          foreach($classes as $class) { if ($class['startTime'] <= 20800 && $class['endTime'] >= 20900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 20800 && $class['endTime'] >= 20900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 20900 && $class['endTime'] >= 21000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 20900 && $class['endTime'] >= 21000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21000 && $class['endTime'] >= 21100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21000 && $class['endTime'] >= 21100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21100 && $class['endTime'] >= 21200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21100 && $class['endTime'] >= 21200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21200 && $class['endTime'] >= 21300) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21200 && $class['endTime'] >= 21300) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21300 && $class['endTime'] >= 21400) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21300 && $class['endTime'] >= 21400) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21400 && $class['endTime'] >= 21500) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21400 && $class['endTime'] >= 21500) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21500 && $class['endTime'] >= 21600) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21500 && $class['endTime'] >= 21600) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21600 && $class['endTime'] >= 21700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21600 && $class['endTime'] >= 21700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21700 && $class['endTime'] >= 21800) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21700 && $class['endTime'] >= 21800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21800 && $class['endTime'] >= 21900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21800 && $class['endTime'] >= 21900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 21900 && $class['endTime'] >= 22000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 21900 && $class['endTime'] >= 22000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 22000 && $class['endTime'] >= 22100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 22000 && $class['endTime'] >= 22100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 22100 && $class['endTime'] >= 22200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 22100 && $class['endTime'] >= 22200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}   
        echo "</tr>";
        echo "<tr>";
          echo "<td>Wed</td>";
          foreach($classes as $class) { if ($class['startTime'] <= 30800 && $class['endTime'] >= 30900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 30800 && $class['endTime'] >= 30900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 30900 && $class['endTime'] >= 31000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 30900 && $class['endTime'] >= 31000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31000 && $class['endTime'] >= 31100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31000 && $class['endTime'] >= 31100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31100 && $class['endTime'] >= 31200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31100 && $class['endTime'] >= 31200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31200 && $class['endTime'] >= 31300) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31200 && $class['endTime'] >= 31300) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31300 && $class['endTime'] >= 31400) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31300 && $class['endTime'] >= 31400) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31400 && $class['endTime'] >= 31500) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31400 && $class['endTime'] >= 31500) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31500 && $class['endTime'] >= 31600) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31500 && $class['endTime'] >= 31600) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31600 && $class['endTime'] >= 31700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31600 && $class['endTime'] >= 31700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31700 && $class['endTime'] >= 31800) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31700 && $class['endTime'] >= 31800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31800 && $class['endTime'] >= 31900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31800 && $class['endTime'] >= 31900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 31900 && $class['endTime'] >= 32000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 31900 && $class['endTime'] >= 32000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 32000 && $class['endTime'] >= 32100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 32000 && $class['endTime'] >= 32100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 32100 && $class['endTime'] >= 32200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 32100 && $class['endTime'] >= 32200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}    
        echo "</tr>";
        echo "<tr>";
          echo "<td>Thu</td>";
          foreach($classes as $class) { if ($class['startTime'] <= 40800 && $class['endTime'] >= 40900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 40800 && $class['endTime'] >= 40900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 40900 && $class['endTime'] >= 41000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 40900 && $class['endTime'] >= 41000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41000 && $class['endTime'] >= 41100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41000 && $class['endTime'] >= 41100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41100 && $class['endTime'] >= 41200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41100 && $class['endTime'] >= 41200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41200 && $class['endTime'] >= 41300) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41200 && $class['endTime'] >= 41300) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41300 && $class['endTime'] >= 41400) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41300 && $class['endTime'] >= 41400) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41400 && $class['endTime'] >= 41500) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41400 && $class['endTime'] >= 41500) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41500 && $class['endTime'] >= 41600) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41500 && $class['endTime'] >= 41600) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41600 && $class['endTime'] >= 41700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41600 && $class['endTime'] >= 41700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41700 && $class['endTime'] >= 41800) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41700 && $class['endTime'] >= 41800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41800 && $class['endTime'] >= 41900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41800 && $class['endTime'] >= 41800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 41900 && $class['endTime'] >= 42000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 41900 && $class['endTime'] >= 42000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 42000 && $class['endTime'] >= 42100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 42000 && $class['endTime'] >= 42100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 42100 && $class['endTime'] >= 42200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 42100 && $class['endTime'] >= 42200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}    
        echo "</tr>";
        echo "<tr>";
          echo "<td>Fri</td>";
          foreach($classes as $class) { if ($class['startTime'] <= 50800 && $class['endTime'] >= 50900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 50800 && $class['endTime'] >= 50900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 50900 && $class['endTime'] >= 51000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 50900 && $class['endTime'] >= 51000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51000 && $class['endTime'] >= 51100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51000 && $class['endTime'] >= 51100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51100 && $class['endTime'] >= 51200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51100 && $class['endTime'] >= 51200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51200 && $class['endTime'] >= 51300) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51200 && $class['endTime'] >= 51300) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51300 && $class['endTime'] >= 51400) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51300 && $class['endTime'] >= 51400) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51400 && $class['endTime'] >= 51500) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51400 && $class['endTime'] >= 51500) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51500 && $class['endTime'] >= 51600) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51500 && $class['endTime'] >= 51600) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51600 && $class['endTime'] >= 51700) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51600 && $class['endTime'] >= 51700) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51700 && $class['endTime'] >= 51800) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51700 && $class['endTime'] >= 51800) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51800 && $class['endTime'] >= 51900) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51800 && $class['endTime'] >= 51900) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 51900 && $class['endTime'] >= 52000) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 51900 && $class['endTime'] >= 52000) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 52000 && $class['endTime'] >= 52100) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 52000 && $class['endTime'] >= 52100) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";}
          foreach($classes as $class) { if ($class['startTime'] <= 52100 && $class['endTime'] >= 52200) { $status = 'true'; foreach ($coloredModules as $coloredmodule) { if ($class['moduleCode'] == $coloredmodule[0]) {$color= $coloredmodule[2];}}}}if ($status == 'true') {foreach($classes as $class) { if($class['startTime'] <= 52100 && $class['endTime'] >= 52200) {echo "<td style='background-color:".$color."'>".$class['moduleCode'].' '.$class['classNo']."</td>";}}$status = 'false';} else {echo "<td></td>";} 
        echo "</tr>";                            
       echo "</tbody>";
       ?>
       
    </table>

    </div>
  </div>
</div>

    <div class = "bottom-half">
      <div class = "current-modules bottom-section">
        <table class = "current-modules fontsset1">
          <tr>
            <td>Your Current Modules:</td>
            <?php
            //Script to delete modules
              foreach($modules as $module) {
                echo "<td>".implode($module)."
                  <form class='inline' action='includes/deleteClass.inc.php' method='POST'>
                    <input type='hidden' name='moduleCode' value='".$module[0]."'>
                    <input class='inline' type='submit' name='submit' value='X'>
                  </form> 
                </td>";
              }
            ?>
          </tr>
        </table>
        <p class = "fontsset1">Search for modules:</p>
      </div>

      <form class="form" action="Timetable.php" method="POST">
        <input class="search-bar form-control" name="module" type="text" placeholder="Enter module code here..">
        <button class="btn btn-primary btn_cu" type="submit">Search</button>
      </form>

      <?php
        error_reporting(E_ALL ^ E_WARNING); //Suppress all warnings. This is a (shitty) fix for warnings appearing when searching for a Sem 2 mod, because our app only queries for sem 1 mods
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "clashingtime") {
            echo "<p class = 'error-message fontsset1'>There is already a class at that timing!</p>";
          }
        }

        
        if (isset($_GET['mod'])) {
          $url = "https://api.nusmods.com/v2/2021-2022/modules/{$_GET['mod']}.json";
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $modCode = strtoupper($_POST['module']);
          $url = "https://api.nusmods.com/v2/2021-2022/modules/{$modCode}.json";
        }

        if (isset($url)) {
          $moduledata = @file_get_contents($url);
          if ($moduledata === FALSE) { 
            echo "<p class='fontsset1 status-message'>Invalid module code/No module code entered</p>"; 
          } else {
            $decodedmoduledata = json_decode($moduledata, true);
            //Data (For class types that have multiple lessons in a week, users have to select each lesson individually.)
            $moduleCode = $decodedmoduledata['moduleCode']; //Module code
            $moduleName = $decodedmoduledata['title']; //Module title
            $semesterData = $decodedmoduledata['semesterData'][0]['timetable']; //for semester1 only. assuming all is semester 1
            $lectures = array(); //2d array for lectures: ((classcode1, day, starttime, endtime), (classcode2, day,...)...)
            $tutorials = array(); //2d array for tutorials: ((classcode1, day, starttime, endtime), (classcode2, day,...)...)
            $sectionals = array(); //2d array for sectionals: ((classcode1, day, starttime, endtime), (classcode2, day,...)...)
            $recitations = array(); //2d array for recitations: ((classcode1, day, starttime, endtime), (classcode2, day,...)...)
            $labs = array(); //2d array for labs: ((classcode1, day, starttime, endtime), (classcode2, day,...)...)
            foreach($semesterData as $class) {
              switch($class['lessonType']) {
                case "Lecture":
                  $temp = array(array("Lecture " . $class['classNo'], $class['day'], $class['startTime'], $class['endTime'], $moduleCode, $moduleName)); 
                  $lectures = array_merge($lectures, $temp);
                  break;
                case "Tutorial":
                  $temp = array(array("Tutorial " . $class['classNo'], $class['day'], $class['startTime'], $class['endTime'], $moduleCode, $moduleName));
                  $tutorials = array_merge($tutorials, $temp);
                  break;
                case "Sectional Teaching":
                  $temp = array(array("Sectional " . $class['classNo'], $class['day'], $class['startTime'], $class['endTime'], $moduleCode, $moduleName));
                  $sectionals = array_merge($sectionals, $temp);
                  break;
                case "Recitation":
                  $temp = array(array("Recitation " . $class['classNo'], $class['day'], $class['startTime'], $class['endTime'], $moduleCode, $moduleName));
                  $recitations = array_merge($recitations, $temp);
                  break;
                case "Laboratory":
                  $temp = array(array("Lab " . $class['classNo'], $class['day'], $class['startTime'], $class['endTime'], $moduleCode, $moduleName));
                  $labs = array_merge($labs, $temp);
                  break;
              }
            }
            /*
            echo print_r($lectures);
            echo "<br>";
            echo print_r($tutorials);
            echo "<br>";
            echo print_r($recitations);
            echo "<br>";
            echo print_r($labs);
            */
            $output = '<p class="fontsset1 status-message">Currently viewing timings for: '.$moduleCode.' '.$moduleName.'</p>'; //Display message
            echo $output;
          }
        }
      ?>

      <div class = "detail-select">
        <p>

          <form class = "select-form" action="includes/addClass.inc.php" method="POST">
            <select class="form-control" name="selectClass" placeholder="Select lecture timeslot">
              <option value="" disabled selected>Select Lecture</option>
              <?php
              foreach($lectures as $class) {
                $JOIN_VAR = $class[0].' '.$class[1].' '.$class[2].'-'.$class[3].'Hrs';
                echo "<option value='$class[0], $class[1], $class[2], $class[3], $class[4], $class[5]'>$JOIN_VAR</option>";
              }
              ?>
            </select>
            <input class="btn btn-primary btn_cu" type="submit" name="submit" value="Submit">
          </form>

          <form class = "select-form" action="includes/addClass.inc.php" method="POST"> 
            <select class="form-control" name="selectClass" placeholder="Select tutorial timeslot">
              <option value="" disabled selected>Select Tutorial</option>
              <?php
              foreach($tutorials as $class) {
                $JOIN_VAR = $class[0].' '.$class[1].' '.$class[2].'-'.$class[3].'Hrs';
                echo "<option value='$class[0], $class[1], $class[2], $class[3], $class[4], $class[5]'>$JOIN_VAR</option>";
              }
              ?>
            </select>
            <input class="btn btn-primary btn_cu" type="submit" name="submit" value="Submit">
          </form>

          <form class = "select-form" action="includes/addClass.inc.php" method="POST"> 
            <select class="form-control" name="selectClass" placeholder="Select sectional timeslot">
              <option value="" disabled selected>Select Sectional</option>
              <?php
              foreach($sectionals as $class) {
                $JOIN_VAR = $class[0].' '.$class[1].' '.$class[2].'-'.$class[3].'Hrs';
                echo "<option value='$class[0], $class[1], $class[2], $class[3], $class[4], $class[5]'>$JOIN_VAR</option>";
              }
              ?>
            </select>
            <input class="btn btn-primary btn_cu" type="submit" name="submit" value="Submit">
          </form>

          <form class = "select-form" action="includes/addClass.inc.php" method="POST">
            <select class="form-control" name="selectClass" placeholder="Select recitation timeslot">
              <option value="" disabled selected>Select Recitation</option>
              <?php
              foreach($recitations as $class) {
                $JOIN_VAR = $class[0].' '.$class[1].' '.$class[2].'-'.$class[3].'Hrs';
                echo "<option value='$class[0], $class[1], $class[2], $class[3], $class[4], $class[5]'>$JOIN_VAR</option>";
              }
              ?>
            </select>
            <input class="btn btn-primary btn_cu" type="submit" name="submit" value="Submit">
          </form>

          <form class = "select-form" action="includes/addClass.inc.php" method="POST">
            <select class="form-control" name="selectClass" placeholder="Select lab timeslot">
              <option value="" disabled selected>Select Lab</option>
              <?php
              foreach($labs as $class) {
                $JOIN_VAR = $class[0].' '.$class[1].' '.$class[2].'-'.$class[3].'Hrs';
                echo "<option value='$class[0], $class[1], $class[2], $class[3], $class[4], $class[5]'>$JOIN_VAR</option>";
              }
              ?>
            </select>
            <input class="btn btn-primary btn_cu" type="submit" name="submit"  value="Submit">
          </form>

        </p>
      </div>

    </div>

    </body>
</html>