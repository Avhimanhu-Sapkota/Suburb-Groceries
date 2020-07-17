<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Meta data set for Unicode acceptance-->
        <meta charset="utf-8"/>

        <!--Meta tag to represent the author of the website-->
        <meta name="author" content="Suburb_groceries_procreative_developers"/>

        <!--Keywords that optimizes the Search Engine-->
        <meta name="keywords" content=" "/>

        <!--Description that optimizes the Search Engine Result-->
        <meta name="description" content=" "/>

        <!--Link to Google Fonts Used in the Webpage-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;1,600&display=swap">

        <!--Link to Bootstrap-->
        <link rel="stylesheet" type="text/css" href="../style/bootstrap.min.css">

        <!--Link to Style Sheet Page-->
        <link rel="stylesheet" type="text/css" href="../style/style.css">

    </head>

    <!--Body of the webpage-->
    <body>
        <?php

           
            //----------------------Sunday------------------
            if ($currentDay == "Sun"){

                $date = new DateTime($orgDate);
                $date->modify("+3 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+4 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+5 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
            }

            //----------------------Monday------------------
            elseif ($currentDay == "Mon") {

                $date = new DateTime($orgDate);
                $date->modify("+2 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+3 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+4 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
            }

            //----------------------Tuesday------------------
            elseif($currentDay == "Tue"){
                if ($currentTime >= $firstSlot && $currentTime < $secondSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+3 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";

                }
                elseif($currentTime >= $secondSlot && $currentTime < $thirdSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";;
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+3 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                }
                elseif($currentTime >= $thirdSlot && $currentTime < $fourthSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+3 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                elseif ($currentTime >= $fourthSlot && $currentTime < $finalTime){
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+3 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                else{
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+3 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
            }

            //----------------------Wednesday------------------
            elseif($currentDay == "Wed"){
                if ($currentTime >= $firstSlot && $currentTime < $secondSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    
                }
                elseif($currentTime >= $secondSlot && $currentTime < $thirdSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                }
                elseif($currentTime >= $thirdSlot && $currentTime < $fourthSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                elseif ($currentTime >= $fourthSlot && $currentTime < $finalTime){
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                else{
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+2 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
            }

            //----------------------Thursday------------------
            elseif($currentDay == "Thu"){
                if ($currentTime >= $firstSlot && $currentTime < $secondSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+6 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    
                }
                elseif($currentTime >= $secondSlot && $currentTime < $thirdSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+6 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                }
                elseif($currentTime >= $thirdSlot && $currentTime < $fourthSlot){
                    $date = new DateTime($orgDate);
                    $date->modify("+6 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                elseif ($currentTime >= $fourthSlot && $currentTime < $finalTime){
                    $date = new DateTime($orgDate);
                    $date->modify("+6 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+8 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
                else{
                    $date = new DateTime($orgDate);
                    $date->modify("+1 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";;
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+6 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                    echo"<br>";
                    $date = new DateTime($orgDate);
                    $date->modify("+7 day");
                    $tempDate = $date->format("d-M-Y");
                    echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                    echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                    echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                }
            }

            //----------------------Friday------------------
            elseif($currentDay == "Fri"){
                $date = new DateTime($orgDate);
                $date->modify("+5 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+6 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+7 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
            }

            //----------------------Sat------------------
            elseif ($currentDay == "Sat"){
                $date = new DateTime($orgDate);
                $date->modify("+4 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+5 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
                echo"<br>";
                $date = new DateTime($orgDate);
                $date->modify("+6 day");
                $tempDate = $date->format("d-M-Y");
                echo "<option value='".$tempDate."|10-1' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 10am to 1pm </option>";
                echo "<option value='".$tempDate."|1-4' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 1pm to 4pm </option>";
                echo "<option value='".$tempDate."|4-7' >". $tempDate .", ". date('D', strtotime($tempDate)). ": 4pm to 7pm</option>";
            }
            
        ?>  
    </body>
</html>
