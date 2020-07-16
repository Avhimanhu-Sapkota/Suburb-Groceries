<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Products - Suburb Groceries   </title>

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

<img src="../images/coverImage3.jpg" width="100%" alt="Cover Image 3">

<div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">ALL PRODUCTS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
            <div class="row">

            <div class='row' style='padding-top:0px;'>
                <div class='col-xl-6 col-sm-6'>
                    <div class='gap' style='height:35px'></div>
                    <h6 style='text-align:center;color:#e52029'>C A T E G O R I Z E &nbsp;&nbsp;&nbsp; P R O D U C T S</h6>
                    <div class='gap' style='height:35px'></div>

                    <div class='row'>
                        <div class='col-4'> 
                            <div class='card' style='padding:0px'>
                                <a href='../pages/greenGrocer.php' style='text-decoration:none'>
                                    <img class='card-img-top image-fluid' src='../images/shop11.png' alt=' ' height='100%' width='100%' onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'>
                                </a>
                            </div>
                        </div>

                        <div class='col-4'> 
                            <div class='card' style='padding:0px'>
                                <a href='../pages/bakery.php' style='text-decoration:none'>
                                    <img class='card-img-top image-fluid' src='../images/shop3.png' alt=' Bakery Picture ' height='100%' width='100%' onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'>
                                </a>
                            </div>
                        </div>

                        <div class='col-4'> 
                            <div class='card' style='padding:0px'>
                                <a href='../pages/butcher.php' style='text-decoration:none'>
                                    <img class='card-img-top image-fluid' src='../images/shop8.png' alt='Butcher Picture ' height='100%' width='100%' onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'>
                                </a>
                            </div>
                        </div>

                        <div class='col-4'> 
                            <div class='card' style='padding:0px'>
                                <a href='../pages/fishMonger.php' style='text-decoration:none'>
                                    <img class='card-img-top image-fluid' src='../images/shop5.png' alt='Fishmonger Picture ' height='100%' width='100%' onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'>
                                </a>
                            </div>
                        </div>

                        <div class='col-4'> 
                            <div class='card' style='padding:0px'>
                                <a href='../pages/delicatessen.php' style='text-decoration:none'>
                                    <img class='card-img-top image-fluid' src='../images/shop9.png' alt=' Delicastessen Picture' height='100%' width='100%' onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='col-xl-6 col-sm-6'>
                    <div class='gap' style='height:35px'></div>
                    <h6 style='text-align:center; color:#e52029'>S O R T&nbsp;&nbsp;&nbsp; P R O D U C T S</h6>
                    <div class='gap' style='height:35px'></div>
                            
                    <form method='post' name='sortform' action='sortProducts.php' class='sign-up-form'>
                        <table class='form-table' style='text-align:center' >
                            <tr class='table-row'>
                                <tr>
                                    <br><br><br>
                                    <td><select name='alphabet' class='textInput' style='color:#e52029'>
                                    <option value='empty' disabled selected>SELECT ORDER</option>
                                    <option value='ascending'>ASCENDING</option>
                                    <option value='descending'>DESCENDING</option>
                                    </select>
                                </td></tr>
                            </tr>

                            <tr class='row'>
                                <tr><td><select name='price' class='textInput'  style='color:#e52029'>
                                        <option value='empty' disabled selected>SELECT PRICE RANGE</option>
                                        <option value='range1'>£0 - £20</option>
                                        <option value='range2'>£20 - £50</option>
                                        <option value='range3'>£50 - £100</option>
                                        <option value='range4'>£100 +</option>
                                    </select>
                                </td></tr>
                            </tr>

                            <tr class='row'> 
                                <td colspan='2' style='text-align:center'>
                                    <div class='gap' style='height:35px;text-align:center'></div>
                                        <a href='sortProducts.php' style='color:white;text-decoration:none;'> 
                                            <small><input type='submit' class='moreButton' name='sortProudcts' value='SORT PRODUCTS' style='margin-left:150%'> </small>
                                        </a>
                                    </td>
                                </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class='gap'></div>

        <div class='row'>
            <?php
                error_reporting(0);
                  include('connect.php');
 
                 $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS ORDER BY PRODUCT_ID');
                 oci_execute($sqlCode);

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

                                        echo"<a href='addToCart.php?pid=".$row['PRODUCT_ID']."' class='productTitle'><button type='button' name='cartButton' class='moreButton' style='margin:auto;display:block;'> Add to Basket  </button></a>";
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