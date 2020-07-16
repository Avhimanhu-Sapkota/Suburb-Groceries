<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Welcome to Suburb Groceries!!!</title>

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

        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>

    <!--Body of the webpage-->
    <body>

    <?php
            include('connect.php');
            session_start();

    
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>
        
        <div class="carousel-slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" height="100%">
                        <img src="../images/sliderBanner1.png" alt="Slider Banner 1" width="100%">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/sliderBanner2.png" alt="Slider Banner 2"  width="100%">
                    </div>
                    <div class="carousel-item">
                        <img src="../images/sliderBanner3.png" alt="Slider Banner 3"  width="100%">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>

        <div class="gap"></div>    
        <h6 style="text-align:center; ">Explore Our</h6>
        <h3 style="text-align:center; color:#e52029; ">BEST SELLERS</h3>

        <div class="container">
            <div class="row">
            <?php
                error_reporting(0);
                 include('connect.php');

                 $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS');
                 oci_execute($sqlCode);

                 $index = 0;

                 while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    
                    if ( $index<6 && $row['AVAILABLE_STOCK']<=5){
                        $description =  $row['DESCRIPTION'];
                        $shortDesc = substr($description,0,80);
                        $index = $index + 1;

                        $offerID = $row['FK1_OFFER_ID'];

                        echo "<div class='col-xl-4 col-sm-6'> 
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
                 }
            ?>
            </div>

            <div class="gap" style="height:35px"></div>

            <form>
                <a href="products.php" class='productTitle'> 
                    <input type="button" class="moreButton" value="View Products" style="margin:auto;display:block;"> 
                </a>
            </form>
        </div>

        <div class="gap"></div> 

            <div class='container-fluid'  style="background-image: url('../images/coverBackground.png'); height:19vw;">
                <div class="row">
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/greenGrocer.php'>
                            <img class='image-fluid rounded-circle z-depth-2'  src="../images/shop11.png" width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>    
                        </a>
                    </div>
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/bakery.php'>
                            <img class='image-fluid rounded-circle z-depth-2' src="../images/shop3.png"  width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>
                            </a>
                    </div>
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/butcher.php'>
                            <img class='image-fluid rounded-circle z-depth-2'  src="../images/shop8.png"  width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>
                        </a>
                    </div>
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/fishmonger.php'>
                            <img class='image-fluid rounded-circle z-depth-2'  src="../images/shop5.png"  width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>
                        </a>
                    </div>
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/delicatessen.php'>
                            <img class='image-fluid rounded-circle z-depth-2'  src="../images/shop9.png"  width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>
                        </a>
                    </div>
                    <div class='col-xl-2 col-sm-2'> 
                        <a href='../pages/shops.php'>
                            <img class='image-fluid rounded-circle z-depth-2'  src="../images/allShop.png"  width="100%" onMouseOver='this.style.opacity=0.5' onMouseOut='this.style.opacity=1'/>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php
            error_reporting(0);
            $date = strtotime(date("Y-m-d"));
            include('connect.php');

            $sqlCode = oci_parse($connection, 'SELECT * FROM OFFERS ORDER BY OFFER_ID');
            oci_execute($sqlCode);
            $offer = "false";

            while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                
                if(strtotime($row['START_DATE'])<= $date && strtotime($row['END_DATE'])>= $date){
                    $offer = "true";
                }
            }
            if ($offer=="true"){
                echo '<div class="gap"></div>    
                <h6 style="text-align:center; ">Todays</h6>
                <h3 style="text-align:center; color:#e52029; ">SPECIAL</h3>';
            echo"
                <div class='container'>
                    <div class='row'>
                        <a href='../pages/specials.php'>
                            <img src='../images/todaySpecial.png' alt='Todays Special Image' width='100%'>
                        </a> 
                    </div>
                </div>";
            }
        ?>

        <div class="gap"></div> <div class="gap"></div> 
       <img src="../images/infoBanner1.png" width="100%" alt="InfoGraphics Banner">
        <div class="gap"></div> 

        <h6 style="text-align:center; ">Suburb Groceries</h6>
        <h3 style="text-align:center; color:#e52029; ">PHOTO PORTFOLIO</h3>

        <div class='container'>
            <div class='row'>
                <img src="../images/coverImage.png" width="100%" alt="Portfolio Banner">
            </div>
        </div>


        <div class="gap"></div> 
        <a href='ourStory.php'>
            <img src="../images/aboutUsBanner.png" width="100%" alt="About Us Banner">
        </a>
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