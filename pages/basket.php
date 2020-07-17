
<?php
    
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        $productID=trim($_POST['productID']);
        $price=trim($_POST['price']);
        $quantity=trim($_POST['quantity']);
        $basketProID=trim($_POST['basketProID']);
        $totalPrice = $price * $quantity;

        $sql="UPDATE BASKET_PRODUCTS SET QUANTITY=:quantity, TOTALPRICE=:totalPrice WHERE BASKET_PRODUCT_ID=:basketProID";

        $sqlCode = oci_parse($connection, $sql);

        oci_bind_by_name($sqlCode, ":quantity", $quantity);
        oci_bind_by_name($sqlCode, ":totalPrice", $totalPrice);
        oci_bind_by_name($sqlCode,":basketProID", $basketProID);
        oci_execute($sqlCode);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Basket - Suburb Groceries   </title>

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

        <script>
            
        </script>
    </head>

    <!--Body of the webpage-->
    <body>
        <?php
            session_start();
    
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>

<img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">

<div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">SHOPPING BASKET</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class='container'>
            <div class='row'>
                    <?php
                        error_reporting(0);

                        include ('config.php');
                        $checkoutPrice = 0;
                        $cookieName = "cart";
                        if (empty($_SESSION['username'])){
                        if(empty($_COOKIE["cart"])){
                            echo"<div class='gap'></div>";
                            echo"<h3 style='margin:auto;display:block;'> Y O U&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            H A V E&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P R O D U C T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            A D D E D &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; T O &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B A S K E T </h3><br><br>";
                            echo"<h6 style='margin:auto;display:block;'><a href='products.php'>FIND PRODUCTS TO ADD TO BASKET </a></h6>";
                            echo" <div class='gap'></div>";
                        }
                        else{
                            echo'
                                </div>
                                <a href="deleteAllCart.php"> 
                                    <input class="newButton" type="submit" name="addProduct" value="Remove All From Basket">
                                </a> 
                                <div class="row">';
                                    $cartID = $_COOKIE["cart"];
                                    foreach($cartID as $value){
                                         include('connect.php');
 
                                        $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:proValue');
                                        oci_bind_by_name($sqlCode, ":proValue", $value);  
                                        oci_execute($sqlCode);
                                            while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                                                $description =  $row['DESCRIPTION'];
                                                $shortDesc = substr($description,0,80);
                                                $count++;
                                                $offerID = $row['FK1_OFFER_ID'];
                        
                                                echo "<div class='gap'></div>
                                                <div class='col-xl-4 col-sm-6'> 
                                                <div class='card h-100'>";
                                                    echo"<a href=productView.php?pid=".$row['PRODUCT_ID']."><img class='card-img-top image-fluid' src='../images/uploads/".$row['IMAGE']." ' alt='Product Image' height='100%' width='100%'></a>";
                                                    echo" <div class='card-body'> <h4 class='card-title' style='text-align: center;'> <a class='productTitle' href=productview.php?pid=".$row['PRODUCT_ID']." >".$row['NAME']."</a></h4>";
                        
                                                        if(empty($row['FK1_OFFER_ID'])){
                                                            echo"<h6 style='color:#e52029;text-align: center;'> £ ".$row['PRICE'].".00 </h6>";
                                                        }
                                                        else{
                                                            $date = strtotime(date("Y-m-d"));
                                                             include('connect.php');
 
                                                            $sqlCode1 = oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:offerID');
                                                            oci_bind_by_name($sqlCode1, ":offerID", $offerID);  
                                                            oci_execute($sqlCode1);
                        
                                                            while (($row2 = oci_fetch_array($sqlCode1, OCI_BOTH)) != false) {
                                                                if(strtotime($row2['START_DATE'])<= $date && strtotime($row2['END_DATE'])>= $date){
                                                                    echo"<h6 style='color:#e52029; text-align: center;'> <strike> £ ".$row['PRICE'].".00  </strike> &nbsp;";
                                                                    $discount = ($row2['DISCOUNT_PERCENT'])/100;
                                                                    $orgPrice = $row['PRICE'];
                                                                    $offerPrice = $orgPrice - ($discount *$orgPrice);
                                                                        echo "  £ ".$offerPrice."</h6>";
                                                                }
                                                                else{
                                                                    echo"<h6 style='color:#e52029;text-align: center;'> £ ".$row['PRICE'].".00 </h6>";
                                                                }
                                                            }
                                                        }
                        
                                                        echo"  <h6 style='text-align: center;'> Stock available:  ".$row['AVAILABLE_STOCK']."</h6>
                                                                            <p class='card-text' style='text-align: center;'>"
                                                                                .$shortDesc." .....</p></div>";
                                                            echo"<a href='deleteCart.php?pid=".$row['PRODUCT_ID']."' class='productTitle'><button type='button' name='removeItem' class='moreButton' style='margin:auto;display:block;'> Remove From Basket  </button></a>";
                                                            echo"<div class='gap' style='height:35px'></div>
                                                        </div></div>";
                                                                                
                                            }
                                        }
                                    }
                                    echo" </div><br> <a href='login.php' > <h6 style='text-align:center'> 
                                        <input type='submit' name='checkout' value=' Login to Checkout ' class='link-button' ></a> </td> </h6>";
                            }
                            else{
                                include('userID.php');
                                $userID = $_SESSION['userID'];
                                
                                $sqlCode1 = oci_parse($connection, 'SELECT * FROM BASKET where FK1_USERS_ID=:userID');
                                oci_bind_by_name($sqlCode1, ":userID", $userID);  
                                oci_execute($sqlCode1);

                                $row = oci_fetch_array($sqlCode1);
                                $basketID = $row['BASKET_ID'];

                                $sqlCode2 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS where FK1_BASKET_ID=:basketID AND PAYMENT=0'); 
                                oci_bind_by_name($sqlCode2, ":basketID", $basketID);  
                                oci_execute($sqlCode2);

                                if (empty($row3 = oci_fetch_array($sqlCode2))){
                                    echo"<div class='gap'></div>";
                                    echo"<h3 style='margin:auto;display:block;'> Y O U&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    H A V E&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P R O D U C T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    A D D E D &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; T O &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B A S K E T </h3><br><br>";
                                    echo"<h6 style='margin:auto;display:block;'><a href='products.php'>FIND PRODUCTS TO ADD TO BASKET </a></h6>";
                                    echo" <div class='gap'></div>";
                                }
                                else{
                                    //<p style="margin:auto;display:block;"> Note: Once you change the quantity of product you want to purchase, do click the update button in order to successfully update quantity. </p>
                                    echo '
                                    <div class="container" style="overflow-x:auto;">
                                        <table class="tables" cellpadding="5" cellspacing="5" >            
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center">PRODUCT ID</th>
                                                    <th style="text-align:center">PRODUCT</th>
                                                    <th></th>
                                                    <th style="text-align:center">PRICE (in £)</th>
                                                    <th style="text-align:center">QUANTITY (in KG)</th>
                                                    <th style="text-align:center"> TOTAL PRICE (in £)</th>
                                                </tr>
                                            </thead>
                                            <tbody> ';

                                    $sqlCode3 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS where FK1_BASKET_ID=:basketID AND PAYMENT=0'); 
                                    oci_bind_by_name($sqlCode3, ":basketID", $basketID);  
                                    oci_execute($sqlCode3);
                                    $count = 1;
                                    while (($row3 = oci_fetch_array($sqlCode3, OCI_BOTH)) != false) {
                                        $basketProID = $row3['BASKET_PRODUCT_ID'];
                                        $cartQuantity = $row3['QUANTITY'];
                                        $totalPrice = $row3['TOTALPRICE'];
                                        $productID = $row3['FK2_PRODUCT_ID'];
                                        $sqlCode4 = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:productID');
                                        oci_bind_by_name($sqlCode4, ":productID", $productID);  
                                        oci_execute($sqlCode4);

                                        
                                        while (($row4 = oci_fetch_array($sqlCode4, OCI_BOTH)) != false) {
                                            if ($count <= 20){
                                                $count++;
                                                $description =  $row4['DESCRIPTION'];
                                                $shortDesc = substr($description,0,80);
                                                $offerID = $row4['FK1_OFFER_ID'];
                                                $stockAvailable = $row4['AVAILABLE_STOCK'];
                                                $productName = $row4['NAME'];
                                                $maxOrder = $row4['MAXIMUM_ORDER'];
                                                $minOrder = $row4['MINIMUN_ORDER'];
                                                $image = $row4['IMAGE'];

                                                if(empty($row4['FK1_OFFER_ID'])){
                                                    $price = $row4['PRICE'];
                                                }
                                                else{
                                                    $date = strtotime(date("Y-m-d"));
                                                     include('connect.php');
 
                                                    $sqlCode4 = oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:offerID');
                                                    oci_bind_by_name($sqlCode4, ":offerID", $offerID);  
                                                    oci_execute($sqlCode4);

                                                    while (($row5 = oci_fetch_array($sqlCode4, OCI_BOTH)) != false) {
                                                        if(strtotime($row5['START_DATE'])<= $date && strtotime($row5['END_DATE'])>= $date){
                                                            $discount = ($row5['DISCOUNT_PERCENT'])/100;
                                                            $orgPrice = $row4['PRICE'];
                                                            $offerPrice = $orgPrice - ($discount *$orgPrice);
                                                            $price = $offerPrice;
                                                        }
                                                    }
                                                }
                                                
                                                echo '<tr> 
                                                            <form method="post" action="basket.php" id="cartForm">
                                                            <td style="text-align:center"><input type="text" name="productID" class="textInput1" autocomplete="off" value="'; if(isset($productID)){echo $productID;}  echo'" readonly > 
                                                            <td style="text-align:center"><img alt ="'.$image.'" src="../images/uploads/'.$image.'" style="height:auto;width:auto;max-width:100%"/></td>
                                                            <td><h5>'.$productName.'
                                                                </h5><p>'
                                                            .$shortDesc.' .....</p></td>
                                                            <td style="text-align:center">  <input type="text" name="price" class="textInput1" autocomplete="off" value="'; if(isset($price)){echo $price;} echo'" readonly></td>';
                                                            echo'
                                                                    <td style="text-align:center">
                                                                    <input type="text" name="quantity" class="textInput2" autocomplete="off" value="'; if(isset($cartQuantity)){echo $cartQuantity;}  
                                                                    echo'" readonly >
                                                                        <select name="quantity" class="textInput1" id="selQuantity" required>
                                                                            <option value="0" disabled selected>Change</option> ';

                                                                            for ($index=$minOrder; $index<=$maxOrder; $index++){
                                                                                echo'
                                                                                    <option value="'.$index.'" >'.$index.'</option>
                                                                                    auto Submit, get and display (try once)';
                                                                            }

                                                                    echo '</select> <br>
                                                                    <input type="hidden" name="basketProID" class="textInput1" autocomplete="off" value="'.$basketProID.'"></noscript>
                                                                    <input type="submit" name="submitButton" value="UPDATE" class="link-button"> </td>
                                                                
                                                                
                                                                <td style="text-align:center"> 
                                                                    <input type="text" name="totalPrice" class="textInput1" autocomplete="off" value="'; if(isset($totalPrice)){echo $totalPrice;}  
                                                                echo'" readonly > <br> <br> 
                                                                </form>
                                                            </td>
                                                            ';

                                                            echo '
                                                            <td>
                                                                <br><br> 
                                                                <a href=deleteCart.php?pid='.$basketProID.'>REMOVE</a> 
                                                            </td>
                                                        </tr>';
                                                        $checkoutPrice = $checkoutPrice + $totalPrice;
                                            }
                                            else{
                                                $exceeded = 1;
                                            }
                                            
                                        }
                                    }
                                } 
                            echo"</tbody>
                            </table>
                        </div></div>";

                        echo'
                        <div class="gap"></div> 
                        <h4 style="text-align:center;color:#e52029;">BASKET TOTAL</h4>
                        <div class="gap" style="height:35px"></div>
                        <h3 style="text-align:center;color:#e52029"> £ '.$checkoutPrice.'</h3><br><br>';
                        ?>
                        <form action="<?php echo PAYPAL_URL; ?>" method="post">
                            <input type="hidden" name="cmd" value="_cart">  
                            <input type="hidden" name="upload" value="1">
                            <input type="hidden" name="business" value="avi.saps999@gmail.com"> 
                            <input type="hidden" name="no_note" value="1">
                            <input type="hidden" name="lc" value="UK">       
                            
                            <?php
                                $sqlCode6 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS where FK1_BASKET_ID=:basketID AND PAYMENT=0'); 
                                oci_bind_by_name($sqlCode6, ":basketID", $basketID);  
                                oci_execute($sqlCode6);
                                $i = 0;
                                while (($row6 = oci_fetch_array($sqlCode6, OCI_BOTH)) != false) {   
                                    $productID = $row6['FK2_PRODUCT_ID'];
                                    $productPrice = $row6['TOTALPRICE'];
                                    $quantity = $row6['QUANTITY'];

                                    $sqlCode7 = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:productID');
                                    oci_bind_by_name($sqlCode7, ":productID", $productID);  
                                    oci_execute($sqlCode7);

                                    while (($row7 = oci_fetch_array($sqlCode7, OCI_BOTH)) != false) {
                                        $productName1 = $row7['NAME'];
                                        
                                        ?>
                                        
                                        <input type="hidden" name="item_name_1" value="<?php echo $productName1; ?>">
                                        <input type="hidden" name="item_number_1" value="<?php echo $productID; ?>">
                                        <input type="hidden" name="amount_1" value="<?php echo $productPrice; ?>">

                                        <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                                        <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                        <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">    
                                       
                                    <?php  $i++;}
                                }
                                ?><input type="hidden" name="amount_1" value="<?php echo $checkoutPrice; ?>">
                                <?php
                                echo'<input type="submit" name="submit" style="margin:auto;display:block;" class="newButton" value="Checkout"></form> ';
                        }
                        

                        if ($exceeded == 1){
                            echo"<div class='gap'></div>";
                                    echo"<h3 style='text-align:center'> Y O U&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    C A N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O N L Y&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A D D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    2 0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P R O D U C T S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T H E
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B A S K E T </h3><br><br>";
                                    echo" <div class='gap'></div>";
                        }
                        
                    ?>
                </div>
            </div>
              
        <div class="gap"></div> 
        <hr style="width:5%;border:1.5px solid #e52029; ">
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