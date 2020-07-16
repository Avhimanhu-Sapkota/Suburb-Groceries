<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> </title>

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
        <footer class="page-footer">
            <div class="container-fluid">

                <div class="row">
                    
                    <div class="col-md-4 mt-md-0 mt-3" id="footer-content">
                        <br>
                        <center>
                            <img class="img-fluid" src="../images/logo.PNG" alt="EDC Warehouse Logo" width="50%">
                        </center>
                        <br><br><br><br><br>
                        <h4 style="font-size:1.3vw;text-align:center;color:#7e0000"> FOLLOW US </h4>
                        <br>
                        <ul class="list">
                            <li style="padding-left:4.5vw">
                                <a href="https://www.facebook.com/">
                                    <img src="../images/facebook.png" alt="Facebook Icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/">
                                    <img src="../images/instagram.png" alt="Instagram Icon">
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/">
                                    <img  src="../images/twitter.png" alt="Twitter Icon">
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-4 mt-md-0 mt-3">
                        <h4 style="font-size:1.3vw;text-align:center;color:#7e0000"> NAVIGATE </h4>
                        <div class="row">
                            <div class="col-md-6 mt-md-0 mt-3">
                                <ul class="list-nav">
                                    <li>
                                        <a href="index.php"> HOME </a>
                                    </li>
                                    <li>
                                        <a href="shops.php"> SHOP </a>
                                    </li>
                                    
                                    <?php
                                        $user=$_SESSION['username'];
                                         include('connect.php');
 
                                        $sqlCode = oci_parse($connection, 'SELECT USERNAME, TYPE FROM USERS');
                                        oci_execute($sqlCode);
                                            
                                        while($row = oci_fetch_array($sqlCode)){
                                            $name=$row['USERNAME'];
                                            $userType=$row['TYPE'];
                                            if($name==$user && $userType=='trader'){
                                                echo '<li><a href="profile.php"> PROFILE </a></li> ';
                                                echo '<li><a href="traderInterface.php"> TRADER INTERFACE </a></li>';
                                                echo'<li><a href="http://127.0.0.1:8080/apex/f?p=102:LOGIN_DESKTOP:7171244334703:::::"> ORACLE INTERFACE </a></li>';
                                            }
                                            else if ($name==$user && $userType=='customer') {
                                                echo '<li><a href="profile.php"> PROFILE </a></li>';
                                            }
                                            else{
                                                
                                            }
                                        }
                                    ?>
                                    <li>
                                        <a href="ourStory.php"> OUR STORY </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 mt-md-0 mt-3">
                                <ul class="list-nav">
                                    
                                    <li>
                                        <a href="products.php"> PRODUCTS </a>
                                    </li>
                                    <li>
                                        <a href="logout.php"> LOG OUT </a>
                                    </li>
                                    <li>
                                        <a href="basket.php"> BASKET </a>
                                    </li>
                                    
                                    <li>
                                        <a href="specials.php"> SPECIALS </a>
                                    </li>
                                    <li>
                                        <a href="refundPolicy.php"> REFUND POLICY </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mt-md-0 mt-3">

                    <h4 style="font-size:1.3vw;text-align:center;color:#7e0000"> CONTACT US</h4>
                        <br>
                        <ul class="list" style="font-size:0.9vw">
                            <li>
                                <img src="../images/location.png" alt="Location Icon" height="38vw"> Cleckhuddersfax, Leeds, UK
                            </li>
                            <br><br>
                            <li>
                                <img src="../images/email.png" alt="Email Icon" height="38vw"> contact@suburbgroceries.com.uk
                            </li>
                            <br><br>
                            <li>
                                <img src="../images/phone.png" alt="Phone Icon" height="38vw"> +44 020 7946 0163, +44 020 7946 0164
                            </li>
                        </ul>
                        <br><br>
                        <h4 style="font-size:1.3vw;text-align:center;color:#7e0000"> PAY US</h4>
                        <br> 
                        <ul class="list">
                            <li>
                                <a href="https://www.mastercard.us/en-us.html">
                                    <img src="../images/mastercard.png" alt="Mastercard Icon" height="38em">
                                </a>
                            </li>
                            <li>
                                <a href="https://esewa.com.np/#/home">
                                    <img src="../images/esewa.png" alt="E-sewa Icon" height="38em">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.paypal.com/us/home">
                                    <img src="../images/paypal.png" alt="PayPal Icon" height="38em">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="footer-copyright text-center py-3" style="background-color: #f3f3f3; color:#7e0000">
                    SUBURB&nbsp;&nbsp;&nbsp;GROCERIES&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;© 2020&nbsp;&nbsp;&nbsp;&nbsp;|
                    &nbsp;&nbsp;&nbsp;&nbsp; PROCERATIVE&nbsp;&nbsp;DEVELOPERS
                    &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; ALL&nbsp;&nbsp;RIGHTS &nbsp;&nbsp;RESERVED.<br>
                    <p style="font-size:0.9vw">
                        Contents and Products have been referenced from real-world existing websites. Hope it will be considered
                        as it is a template e-commerce website which contains bogus products. 
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>