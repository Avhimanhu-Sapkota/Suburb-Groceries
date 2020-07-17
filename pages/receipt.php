<?php

     include('connect.php');


    if(isset($_POST['submitButton'])){
        $result = $_POST['collectionSlot'];
        $result_explode = explode('|', $result);

        $collectionDate = $result_explode[0];
        $collectionRange = $result_explode[1];
        $collectionDay = date('D', strtotime($collectionDate));
        $orderID = $_POST['orderID'];
        $sql="INSERT INTO COLLECTION_SLOT (SLOT_ID, COLLECTION_DATE, COLLECTION_DAY, COLLECTION_TIME, FK1_ORDER_ID) 
              VALUES (pk_slot_id.nextval, :collectionDate, :collectionDay, :collectionRange, :orderID)";
                $sqlCode1 = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode1, ":collectionDate", $collectionDate);
                oci_bind_by_name($sqlCode1, ":collectionDay", $collectionDay);
                oci_bind_by_name($sqlCode1, ":collectionRange", $collectionRange);
                oci_bind_by_name($sqlCode1, ":orderID", $orderID);
                oci_execute($sqlCode1);


    }
?>

<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Payment Receipt - Suburb Groceries </title>

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
            error_reporting(0);
            session_start();
            date_default_timezone_set('Europe/London');
            
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }

             include('connect.php');
 

            $paymentDate = date("Y-m-d");

            $userID = $_GET['uid'];
                                
            $sqlCode1 = oci_parse($connection, 'SELECT * FROM BASKET where FK1_USERS_ID=:userID');
            oci_bind_by_name($sqlCode1, ":userID", $userID);  
            oci_execute($sqlCode1);
            $row1 = oci_fetch_array($sqlCode1);
            $basketID = $row1['BASKET_ID'];

            $sqlCode2 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS WHERE FK1_BASKET_ID=:basketID AND PAYMENT=0'); 
            oci_bind_by_name($sqlCode2, ":basketID", $basketID);  
            oci_execute($sqlCode2);

            while (($row2 = oci_fetch_array($sqlCode2, OCI_BOTH)) != false) {
                $productPrice = $row2['TOTALPRICE'];
                $productID = $row2['FK2_PRODUCT_ID'];
                $quantity = $row2['QUANTITY'];
                $totalPrice = $totalPrice + $productPrice;
            }

            $paymentID = $_GET['pid'];
        ?>

        <img src="../images/coverImage3.jpg" width="100%" alt="Cover Image 3">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;"> PAYMENT INVOICE </h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <div class="container" style="margin:auto;display:block;">
            <div class="row" style="max-width:100%;">
            <div class="col-xl-4 col-sm-4" style="max-width:100%">
                <h6 style=''> 
                    <?php
                        $sqlCode9 = oci_parse($connection, 'SELECT ORDER_ID, ORDER_DATE FROM ORDER_DETAILS WHERE FK2_PAYMENT_ID=:paymentID'); 
                        oci_bind_by_name($sqlCode9, ":paymentID", $paymentID);  
                        oci_execute($sqlCode9);
                        $row9 = oci_fetch_array($sqlCode9);

                        $orderID = $row9['ORDER_ID'];
                        $orderDate = $row9['ORDER_DATE'];
                        
                    ?>
                    <?php
                    echo"<h6 style='color:#09863a'>Order ID:".$orderID." <br>
                    Order Date: " .$orderDate." <h6><br><br><h6 style='color:#09863a'>
                    Billing Address:</h6>
                    ";
                        $sqlCode10 = oci_parse($connection, 'SELECT FULLNAME, EMAIL, CONTACT_NO FROM USERS WHERE USERS_ID=:userID'); 
                        oci_bind_by_name($sqlCode10, ':userID', $userID);  
                        oci_execute($sqlCode10);
                        $row10 = oci_fetch_array($sqlCode10);
                    
                        $userName = $row10['FULLNAME'];
                        $userEmail = $row10['EMAIL'];
                        $userContact = $row10['CONTACT_NO'];
                        
                        echo"
                        ".$userName."<br>
                        ".$userContact."<br>
                        ".$userEmail."<br><br>
                    

                    <br><br><h6 style='color:#09863a'>
                    Total Amount Paid:</h6> £ ";
                    
                        $sqlCode5 = oci_parse($connection, 'SELECT * FROM PAYMENT where PAYMENT_ID=:paymentID');
                        oci_bind_by_name($sqlCode5, ':paymentID', $paymentID);  
                        oci_execute($sqlCode5);
                        $row5 = oci_fetch_array($sqlCode5);

                        $amountPaid = $row5['TOTAL_AMOUNT'];
                        echo " ".$amountPaid;
                    echo"
                    
                </h6></div>
                <div class='col-xl-4 col-sm-4' style='text-align:center'>
                    <br><br><br><img src='../images/paid.png' alt='Paid' height='200vw'>
                </div>
                <div class='col-xl-4 col-sm-4' style='text-align:Right;'> 
                <h6 style='color:#09863a'>Collection Slots Available:</h6>";
                
                        date_default_timezone_set('Europe/London');
                        $timestamp = $_GET['ts'];
                        $orgDate = $_GET['od'];
                        $firstSlot = "10:00";
                        $secondSlot = "13:00";
                        $thirdSlot = "16:00";
                        $fourthSlot = "19:00";
                        $finalTime = "23:59";
                        $currentDay = date('D', $timestamp);
                        $currentTime= $_GET['ct']; 
                        
                        $sqlCode6 = oci_parse($connection, 'SELECT * FROM COLLECTION_SLOT where FK1_ORDER_ID=:orderID');
                        oci_bind_by_name($sqlCode6, ':orderID', $orderID);  
                        oci_execute($sqlCode6);

                        $row6 = oci_fetch_array($sqlCode6);
                        $emptyCollection = $row6['COLLECTION_DATE'];

                        if(empty($emptyCollection)){
                            echo " SELECT COLLECTION SLOT ";
                        }
                        else{
                            echo " Collect on: ". $row6['COLLECTION_DATE'];
                            echo ", ". $row6['COLLECTION_DAY'];
                            echo " between: ". $row6['COLLECTION_TIME'];
                        }
                        echo "<br><br>
                            <h6 style='color:#09863a'>Products Bought:</h6>
                        ";

                        $sqlCode10 = oci_parse($connection, 'SELECT * FROM SALES where FK1_ORDER_ID=:orderID');
                        oci_bind_by_name($sqlCode10, ':orderID', $orderID);  
                        oci_execute($sqlCode10);

                        while (($row10 = oci_fetch_array($sqlCode10, OCI_BOTH)) != false) {
                            echo $row10['PRODUCT_NAME']." X ".$row10['QUANTITY']. " = £ ".$row10['AMOUNT_RECEIVED']."<br>";
                        }
                    echo"</div>";
                    ?>
                    
            </div>

            <div class='gap'></div>
            <?php
                if (empty($emptyCollection)){
                    echo '
                        <form method="post" action="" class="sign-up-form"  method="POST" enctype="multipart/form-data">
                        <select name="collectionSlot" class="textInput" required>
                            <option value="" disabled selected> Select Collection Slot </option>
                            '; include('collectionSlots.php'); echo'
                        </select>

                        <div class="gap"></div>
                        <input type="hidden" name="orderID" value="'.$orderID.'">
                        <input type="submit" name="submitButton" value=" CONFIRM COLLECTION SLOT " class="newButton" style="margin:auto;display:block;"> 
                    </form>
                    ';
                }
            ?>
            
        </div>
        <div class="gap"></div>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <?php
            if (empty($_SESSION['username'])){
                include ('footer.php');
            }
            else{
                include ('loggedFooter.php');
            }
        ?>
    </body>
</html>
