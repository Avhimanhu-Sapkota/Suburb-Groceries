<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Product View - Suburb Groceries </title>

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
            session_start();
    
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">VIEW PRODUCT</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>
        

        <div class="container">
            <div class="row">
            <?php
                error_reporting(0);
                $productID=$_GET['pid'];
                  include('connect.php');
 
                 $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:productID');
                 oci_bind_by_name($sqlCode, ":productID", $productID);  
                 oci_execute($sqlCode);

                 while (($row5 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $offerID = $row5['FK1_OFFER_ID'];
                    $shopID = $row5['FK2_SHOP_ID'];
                    $traderID = $row5['FK3_USERS_ID'];

                    echo"<div class='col-xl-6 col-sm-12'>";
                            echo"<img src='../images/uploads/".$row5['IMAGE']." ' height='100%' width='100%' alt='Product Image'>";
                        echo"</div>";

                        echo"<div class='col-xl-6 col-sm-12'>";
                        echo"<h2 class='card-title' style='color:#09863a'> ".$row5['NAME']."</h2>";
                        echo"<br><p align='justify'> ".$row5['DESCRIPTION']."<p>";
                        echo"<p align='justify'>Allergy Info: ".$row5['ALLERGY_INFO']."<p>";
                        echo"<p align='justify'>
                                    Available Stock: ". $row5['AVAILABLE_STOCK']." <br>
                                    Quantity Per Order: ".$row5['QUANTITY_PER_ITEM']."Kg <br>
                                    Min. Order: ".$row5['MINIMUN_ORDER']."kg &nbsp;&nbsp; Max. Order: ".$row5['MAXIMUM_ORDER']."kg<br>
                                <p>";

                         include('connect.php');
 
                        $sqlCode = oci_parse($connection, 'SELECT * FROM SHOP WHERE SHOP_ID=:shopID');
                        oci_bind_by_name($sqlCode, ":shopID", $shopID);  
                        oci_execute($sqlCode);

                        while (($row1 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                            echo"<p align='justify'>Sold By: ".$row1['SHOP_NAME']." <br>
                                        Shop Contact No:  ".$row1['CONTACT_NO']." <br>
                                        Shop Address:  ".$row1['ADDRESS']." 
                                    <p>";
                        }

                        if(empty($row5['FK1_OFFER_ID'])){
                            echo"<h5 style='color:#e52029'> £ ".$row5['PRICE'].".00 </h5>";
                        }
                        else{
                            $date = strtotime(date("Y-m-d"));
                             include('connect.php');
 
                            $sqlCode = oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:offerID');
                            oci_bind_by_name($sqlCode, ":offerID", $offerID);  
                            oci_execute($sqlCode);

                            while (($row2 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                                if(strtotime($row2['START_DATE'])<= $date && strtotime($row2['END_DATE'])>= $date){
                                    echo "<h6 style='color:#e52029'>  ".$row2['NAME']." (".$row2['DISCOUNT_PERCENT']."% Discount) </h6>";
                                    echo"<h5 style='color:#e52029'> <strike> £ ".$row5['PRICE'].".00  </strike> &nbsp;";
                                    $discount = ($row2['DISCOUNT_PERCENT'])/100;
                                    $orgPrice = $row5['PRICE'];
                                    $offerPrice = $orgPrice - ($discount *$orgPrice);
                                    echo "  £ ".$offerPrice."</h5>";
                                }
                                else{
                                    echo"<h5 style='color:#e52029'> £ ".$row5['PRICE'].".00 </h5>";
                                }
                            }
                        }

                        echo"<a href='addToCart.php?pid=".$row5['PRODUCT_ID']."'><button type='button' name='cartButton' class='moreButton' > Add to Cart  </button></a> ";
                        echo" </div></div>";

                        echo"<div class='gap'></div>
                                 <h3 style='color:#e52029;text-align:center;'> Product Reviews </h3>";

                                if (!(empty($_SESSION['username']))){
                                         echo "<a class='productTitle' href='addReview.php?pid=".$row5['PRODUCT_ID']."&cid="; 
                                         include('userID.php');
                                         $userID = $_SESSION['userID']; 
                                         echo $userID;
                                        echo " '><h6 style='text-align:right'> Add a review for this product </h6><br><br> </a>";
                                }

                             include('connect.php');
 
                            $sqlCode1 = oci_parse($connection, 'SELECT * FROM REVIEWS_RATINGS WHERE FK1_PRODUCT_ID=:productID ORDER BY DATE_OF_REVIEW DESC');
                            oci_bind_by_name($sqlCode1, ":productID", $productID);  
                            oci_execute($sqlCode1);
                            $ratingCheck = 0;

                            while (($row3 = oci_fetch_array($sqlCode1, OCI_BOTH)) != false){
                                $ratingCheck = 1;
                                $reviewID = $row3['REVIEW_ID'];
                                $rating = $row3['RATING_NUMBER'];
                                $dateOfReview = strtotime($row3['DATE_OF_REVIEW']);
                                $reviewDetails = $row3['REVIEW_DETAILS'];
                                $userID = $row3['FK2_USERS_ID'];
                        
                                echo"<div class='container' style='overflow-x:auto;'>
                                                <table cellpadding='5' cellspacing='0' > 
                                                    <tr style='border-bottom:1px solid #e52029'>
                                                            <td>";

                                                             include('connect.php');
 
                                                            $sqlCode = oci_parse($connection, 'SELECT * FROM USERS WHERE USERS_ID=:userID');
                                                            oci_bind_by_name($sqlCode, ":userID", $userID);  
                                                            oci_execute($sqlCode);
                                
                                                            while (($row4 = oci_fetch_array($sqlCode, OCI_BOTH)) != false){
                                                                echo' <img alt ="'.$row4['IMAGE'].'" src="../images/uploads/'.$row4['IMAGE'].'"  height="35%"/>';
                                                         
                                                    echo"</td>
                                                            
                                                            <td style='width:35vw;'>";
                                                                
                                                                if($rating == 0){
                                                                   echo"<span style='font-size:1vw;color:#09863a;'>&star;&star;&star;&star;&star;</span><br>";
                                                                }
                                                                elseif($rating == 1){
                                                                    echo"<span style='font-size:1vw;color:#09863a;'>&starf;&star;&star;&star;&star;</span><br>";
                                                                }
                                                                elseif($rating == 2){
                                                                    echo"<span style='font-size:1vw;color:#09863a;'>&starf;&starf;&star;&star;&star;</span><br>";
                                                                }
                                                                elseif($rating == 3){
                                                                    echo"<span style='font-size:1vw;color:#09863a;'>&starf;&starf;&starf;&star;&star;</span><br>";
                                                                }
                                                                elseif($rating == 4){
                                                                    echo"<span style='font-size:1vw;color:#09863a;'>&starf;&starf;&starf;&starf;&star;</span><br>";
                                                                }
                                                                else{
                                                                    echo"<span style='font-size:1vw;color:#09863a;'>&starf;&starf;&starf;&starf;&starf;</span><br>";
                                                                }
                                                                echo "<h6>" .$row4['FULLNAME']. "";
                                                                echo ", " .date('d M Y', $dateOfReview)."</h6>";
                                                                echo "<p>".$reviewDetails."</p>";
                                                                include('userID.php');
                                                                $userID = $_SESSION['userID']; 
                                                                if ($userID == $row4['USERS_ID']){
                                                                    echo "<a href='updateReview.php?rid=" .$reviewID. "&pid=".$productID."' class='productTitle'>Edit Review</a>";
                                                                }
                                                            }
                                                    echo"
                                                            </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            ";
                            }
                            
                            if($ratingCheck==0){
                                echo"<br><h6 style='text-align:center'> This product has not been reviewed yet. <h6>";
                            }
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