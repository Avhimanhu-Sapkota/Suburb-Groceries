<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Delicatessen Products - Suburb Groceries   </title>

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

<img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">

<div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">DELICATESSEN ITEMS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
            <div class="row">
            <?php
                error_reporting(0);
                $productType="Delicatessen";
                  include('connect.php');
 
                 $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_CATEGORY=:productType ORDER BY PRODUCT_ID');
                 oci_bind_by_name($sqlCode, ":productType", $productType);
                 oci_execute($sqlCode);

                 $index = 0;

                 while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    
                        $description =  $row['DESCRIPTION'];
                        $shortDesc = substr($description,0,80);

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

                                        echo"<a href='addToCart.php?pid=".$row['PRODUCT_ID']."' class='productTitle'><button type='button' name='cartButton' class='moreButton' style='margin:auto;display:block;'> Add to Cart  </button></a>";
                                        echo"<div class='gap' style='height:35px'></div>
                                        </div></div>";
                                        
                    }
            ?>
            </div>
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