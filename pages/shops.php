<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Shops - Suburb Groceries   </title>

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

        <img src="../images/coverImage2.jpg" width="100%" alt="Cover Image 2">

        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;"> SHOPS </h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
            <div class="row">

            <?php
                error_reporting(0);
                  include('connect.php');
 
                 $sqlCode = oci_parse($connection, 'SELECT * FROM SHOP ORDER BY SHOP_ID');
                 oci_execute($sqlCode);

                 while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    
                        echo "<div class='gap'></div>
                        <div class='col-xl-4 col-sm-6'> 
                                    <div class='card h-100'>";
                                        echo"<a href=shopView.php?sid=".$row['SHOP_ID']."><img class='card-img-top image-fluid' src='../images/uploads/".$row['IMAGE']." ' alt='Shop Image' height='100%' width='100%'></a>";
                                        echo" <div class='card-body'> <h4 class='card-title' style='text-align: center;'> <a class='productTitle' href=shopView.php?sid=".$row['SHOP_ID']." >".$row['SHOP_NAME']."</a></h4>";
                                        echo "</div></div></div>";
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