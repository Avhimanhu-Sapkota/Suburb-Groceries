<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title>  </title>

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

        <img src="../images/coverImage4.jpg" width="100%" alt="Cover Image 4">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">TRADER'S INTERFACE</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <div class="container">
            <div class="row no-gutters">
                <div class="col-xl-4 col-sm-12" style="border:0.5vw solid white">
                    <a href="manageShop.php"> <img class="image-fluid" src="../images/manageShop.png" alt="Manage Shop Image" width="100%" height="100%"> </a>
                </div>
                <div class="col-xl-4 col-sm-12" style="border:0.5vw solid white">
                    <a href="manageProduct.php"> <img class="image-fluid" src="../images/manageProduct.png" alt="Manage Product Image" width="100%" height="100%"> </a>
                </div>
                <div class="col-xl-4 col-sm-12" style="border:0.5vw solid white">
                    <a href="manageOffer.php"> <img class="image-fluid" src="../images/manageOffer.png" alt="Manage Offer Image" width="100%" height="100%"> </a>
                </div>
            </div>
        </div>

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