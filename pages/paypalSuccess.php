<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Payment Successful - Suburb Groceries </title>

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
            date_default_timezone_set('Europe/London');
            session_start();

            $timestamp = strtotime(date('d-m-Y'));
            $orgDate = date('d-m-Y');
            $currentTime=date('H:i');

            date_default_timezone_set('Europe/London');
            
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
             include('connect.php');
 
            $tradermail = array();
            $paymentDate = date("Y-m-d");

            include('userID.php');
            $userID = $_SESSION['userID'];
                                
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
                
                $totalPrice = $totalPrice + $productPrice;
            }

            $sql="INSERT INTO PAYMENT (PAYMENT_ID, PAYMENT_DATE, TOTAL_AMOUNT, FK1_USERS_ID)
                    VALUES (PK_PAYMENT_ID.nextval, to_date(:paymentDate,'yyyy-mm-dd'), :totalPrice, :userID) ";
            $sqlCode3 = oci_parse($connection, $sql);
            oci_bind_by_name($sqlCode3, ":paymentDate", $paymentDate);
            oci_bind_by_name($sqlCode3, ":totalPrice", $totalPrice);        
            oci_bind_by_name($sqlCode3, ":userID", $userID);
            oci_execute($sqlCode3);

            $orderDate = strtotime(date("Y-m-d"));
            $sqlCode5 = oci_parse($connection, 'SELECT * FROM PAYMENT where FK1_USERS_ID=:userID ORDER BY PAYMENT_ID, PAYMENT_DATE DESC');
            oci_bind_by_name($sqlCode5, ":userID", $userID);  
            oci_execute($sqlCode5);
            while (($row5 = oci_fetch_array($sqlCode5, OCI_BOTH)) != false) {
                if(strtotime($row5['PAYMENT_DATE']) == $orderDate){
                    $paymentID = $row5['PAYMENT_ID'];
                }
            }

            $sql="INSERT INTO ORDER_DETAILS (ORDER_ID, ORDER_DATE, FK1_BASKET_ID, FK2_PAYMENT_ID)
                    VALUES (PK_ORDER_ID.nextval, to_date(:paymentDate,'yyyy-mm-dd'), :basketID, :paymentID)";
            $sqlCode6 = oci_parse($connection, $sql);
            oci_bind_by_name($sqlCode6, ":paymentDate", $paymentDate);
            oci_bind_by_name($sqlCode6, ":basketID", $basketID);
            oci_bind_by_name($sqlCode6, ":paymentID", $paymentID);
            oci_execute($sqlCode6);

            $sqlCode12 = oci_parse($connection, 'SELECT ORDER_ID FROM ORDER_DETAILS WHERE FK2_PAYMENT_ID=:paymentID'); 
            oci_bind_by_name($sqlCode12, ":paymentID", $paymentID);  
            oci_execute($sqlCode12);
            $row12 = oci_fetch_array($sqlCode12);
            $orderID = $row12['ORDER_ID'];

            $sqlCode13 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS WHERE FK1_BASKET_ID=:basketID AND PAYMENT=0'); 
            oci_bind_by_name($sqlCode13, ":basketID", $basketID);  
            oci_execute($sqlCode13);

            while (($row13 = oci_fetch_array($sqlCode13, OCI_BOTH)) != false) {
                $productID = $row13['FK2_PRODUCT_ID'];
                $quantity = $row13['QUANTITY'];
                $sqlCode8 = oci_parse($connection, 'SELECT NAME, PRICE, AVAILABLE_STOCK, FK1_OFFER_ID, FK3_USERS_ID FROM PRODUCTS WHERE PRODUCT_ID=:productID'); 
                oci_bind_by_name($sqlCode8, ":productID", $productID);  
                oci_execute($sqlCode8);
                $row8 = oci_fetch_array($sqlCode8);
                $totalQuantity = $row8['AVAILABLE_STOCK'];
                $perProductPrice = $row8['PRICE'];
                $traderID = $row8['FK3_USERS_ID'];
                $newQuantity = $totalQuantity - $quantity;
                $productName = $row8['NAME'];

                if(empty($row8['FK1_OFFER_ID'])){
                    $amountReceived = $quantity * $perProductPrice;
                }
                else{
                    $offerID = $row8['FK1_OFFER_ID'];
                    $offerdate = strtotime(date("Y-m-d"));
                     include('connect.php');
 
                    $sqlCode15 = oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:offerID');
                    oci_bind_by_name($sqlCode15, ":offerID", $offerID);  
                    oci_execute($sqlCode15);

                    while (($row15 = oci_fetch_array($sqlCode15, OCI_BOTH)) != false) {
                        if(strtotime($row15['START_DATE'])<= $offerdate && strtotime($row15['END_DATE'])>= $offerdate){
                            $discount = ($row15['DISCOUNT_PERCENT'])/100;
                            $orgPrice = $row8['PRICE'];
                            $offerPrice = $orgPrice - ($discount *$orgPrice);
                            $amountReceived = $quantity * $offerPrice;
                        }
                    }
                }
                
                $sql1 = "INSERT INTO SALES (SALES_ID, PRODUCT_ID, PRODUCT_NAME, QUANTITY, AMOUNT_RECEIVED, RECEIVED_DATE, PRO_RECEIVED_STATUS, CUSTOMER_ID, TRADER_ID, FK1_ORDER_ID)
                VALUES (PK_SALES_ID.nextval, :productID, :productName, :quantity, :amountReceived, to_date(:paymentDate,'yyyy-mm-dd'), 0, :userID, :traderID, :orderID) ";
                $sqlCode14 = oci_parse($connection, $sql1);
                oci_bind_by_name($sqlCode14, ":productID", $productID);
                oci_bind_by_name($sqlCode14, ":productName", $productName);
                oci_bind_by_name($sqlCode14, ":quantity", $quantity);
                oci_bind_by_name($sqlCode14, ":amountReceived", $amountReceived);
                oci_bind_by_name($sqlCode14, ":paymentDate", $paymentDate);
                oci_bind_by_name($sqlCode14, ":userID", $userID);
                oci_bind_by_name($sqlCode14, ":traderID", $traderID);
                oci_bind_by_name($sqlCode14, ":orderID", $orderID);
                oci_execute($sqlCode14);

                $sql="UPDATE PRODUCTS SET AVAILABLE_STOCK=:newQuantity WHERE PRODUCT_ID=:productID";
                $sqlCode7 = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode7,":newQuantity", $newQuantity);
                oci_bind_by_name($sqlCode7,":productID", $productID);
                oci_execute($sqlCode7);

                $sqlCode16 = oci_parse($connection, 'SELECT EMAIL FROM USERS WHERE USERS_ID=:traderID'); 
                oci_bind_by_name($sqlCode16, ":traderID", $traderID);  
                oci_execute($sqlCode16);
                $row16 = oci_fetch_array($sqlCode16);

                $email = $row16['EMAIL'];
                $tradermail[] = $email;
            }
            
            $index = 0;
            $tradermail = array_unique($tradermail);

            while ($index <= sizeof($tradermail)){

                $traderEmail = $tradermail[$index];
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <webmaster@example.com>' . "\r\n";
                $headers .= 'Cc: ' . "\r\n";

                $msg = "You have received payment via Paypal \nThis email is to notify you about the transaction performed to your shop in  Suburb Groceries. Please login to the oracle dashboard to view full details of the payment received!!!
                <a href='http://127.0.0.1:8080/apex/f?p=101:LOGIN_DESKTOP:14059474353901:::::'> Login to Oracle <a>\n\nThanks!! and have a good time!! \n\n Regards,\n Suburb Groceries" ;
                
                mail($traderEmail,"Payment received via PayPal - Suburb Groceries",$msg, $headers);
                $index++;
            }

            $sql="UPDATE BASKET_PRODUCTS SET PAYMENT=1 WHERE FK1_BASKET_ID=:basketID AND PAYMENT=0";
            $sqlCode4 = oci_parse($connection, $sql);
            oci_bind_by_name($sqlCode4,":basketID", $basketID);
            oci_execute($sqlCode4);

            $sqlCode10 = oci_parse($connection, 'SELECT EMAIL FROM USERS WHERE USERS_ID=:userID'); 
            oci_bind_by_name($sqlCode10, ":userID", $userID);  
            oci_execute($sqlCode10);
            $row10 = oci_fetch_array($sqlCode10);

            $email = $row10['EMAIL'];

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";
            $headers .= 'Cc: myboss@example.com' . "\r\n";
            
            $msg = "Your payment was received by Suburb Groceries!! \nThis email is to notify you about the transaction performed to your Suburb Groceries account via PayPal. Your amount has been successfully received. Please click on the link below to view Invoicel\n
                <a href='http://localhost/suburbGroceries/pages/receipt.php?pid=$paymentID&ts=$timestamp&od=$orgDate&ct=$currentTime&uid=$userID'> View Invoice <a>\n\n Thanks!! and have a good time!! \n\n Regards,\n Suburb Groceries" ;
                
                mail($email,"Successful Payment via PayPal - Suburb Groceries",$msg, $headers);

        ?>

        <img src="../images/coverImage3.jpg" width="100%" alt="Cover Image 3">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;"> PAYMENT SUCCESSFUL </h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <div class="container">
            <div class="row" >
                <h6 style='text-align:center;margin:auto;display:block;'> 
                    <img src='../images/success.png' alt='Success Tick Mark' height='100vw'> <br>
                    <br>
                    Thank you, we have received your payment via PayPal, You may now look for other products to buy in Suburb Groceries.
                    <br><br>
                    You will receive an email with full details of the transaction. <br> Please look for the
                    collection slot to receive your products and collect them when convenient. 
                    <a target="_blank" id="link" href="receipt.php?pid=<?php echo $paymentID?>&ts=<?php echo $timestamp?>&od=<?php echo $orgDate?>&ct=<?php echo $currentTime?>&uid=<?php echo $userID?>">View your Invoice here</a>
                    <br>
                    You may email us if you have any concerns!! Thank You!!
                    <br>
                    Enjoy sopping at Suburb Groceries!!!
                </h6>
            </div>
        </div>
        <script>
            $(document).ready(function(){
            window.setTimeout(function(){
            var link = document.getElementById("link").href;
            var newTab = window.open(link, '_blank');
            }, 5000);
        });
        </script>

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
