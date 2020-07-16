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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">VIEW SHOP</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>
        

        <div class="container">
            <div class="row">

            <?php
                error_reporting(0);
                $shopID=$_GET['sid'];
                  include('connect.php');
 
                 $sqlCode = oci_parse($connection, 'SELECT * FROM SHOP WHERE SHOP_ID=:shopID');
                 oci_bind_by_name($sqlCode, ":shopID", $shopID);  
                 oci_execute($sqlCode);

                 while (($row5 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    echo"<div class='col-xl-6 col-sm-12'>";
                        echo"<img src='../images/uploads/".$row5['IMAGE']." ' height='100%' width='100%' alt='Product Image'>";
                    echo"</div>";

                    echo"<div class='col-xl-6 col-sm-12'>";
                        echo"<h2 class='card-title' style='color:#09863a'> ".$row5['SHOP_NAME']."</h2>";
                        echo"<br><p align='justify'>Contact No:<br>".$row5['CONTACT_NO']."<p>";
                        echo"<p align='justify'>Shop Type:<br>".$row5['TYPE']."<p>";
                        echo"<p align='justify'>Shop Address:<br>".$row5['ADDRESS']."<p><br>";

                        $traderID = $row5['FK1_USERS_ID'];
                         include('connect.php');
 
                        $sqlCode = oci_parse($connection, 'SELECT * FROM USERS WHERE USERS_ID=:traderID');
                        oci_bind_by_name($sqlCode, ":traderID", $traderID);  
                        oci_execute($sqlCode);

                        while (($row4 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                            echo"<p align='justify'>Trader:<br>".$row4['FULLNAME']."<p>";
                            echo"<p align='justify'>Trader Contact No:<br>".$row4['CONTACT_NO']."<p>";
                        }
                    echo "</div></div>";
                }
                
                echo"<div class='gap'></div>
                <h3 style='color:#e52029;text-align:center;'>  PRODUCTS OF THIS SHOP </h3>";

                $sql = "SELECT * FROM PRODUCTS WHERE FK2_SHOP_ID=:shopID";
                $sqlCode = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode, ":shopID", $shopID);
                oci_execute($sqlCode);
                include('printProduct.php');

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