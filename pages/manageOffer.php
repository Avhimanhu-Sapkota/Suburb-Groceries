<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Manage Offers - Trader Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">MANAGE OFFERS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>
        
        <form method='post' action='addOffer.php' class="container" style="text-align:right;overflow-x:auto;">
            <input class="newButton" type="submit" name="addOffer" value="Add Offer">
            <br><br>
        </form>

        <div class="container" style="overflow-x:auto;">
            <table class="tables" cellpadding="5" cellspacing="5" >            
                <thead>
                    <tr>
                        <th style="text-align:center">OFFER ID</th>
                        <th>OFFER NAME</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                        <th style="text-align:center">IMAGE</th>
                        <th style="text-align:center"> DISCOUNT (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        error_reporting(0);
                       include('userID.php');
                       $userID = $_SESSION['userID'];
                         include('connect.php');
 

                        $sqlCode = oci_parse($connection, 'SELECT * FROM offers where FK1_USERS_ID=:userID order by OFFER_ID');
                        oci_bind_by_name($sqlCode, ":userID", $userID);  
                        oci_execute($sqlCode);

                        while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                            
                            echo '<tr>
                                    <td style="text-align:center">'.$row["OFFER_ID"].'</td>
                                    <td>'.$row["NAME"].'</td>
                                    <td>'.$row["START_DATE"].'</td>
                                    <td>'.$row["END_DATE"].'</td>
                                    <td><img alt ="'.$row['IMAGE'].'" src="../images/uploads/'.$row['IMAGE'].'"  style="height:auto;width:auto;max-width:100%"/></td>
                                    <td style="text-align:center">'.$row['DISCOUNT_PERCENT'].'</td>
                                    <td><a href=updateOffer.php?cid='.$row['OFFER_ID'].'>EDIT </a><br> 
                                    <a href=deleteOffer.php?cid='.$row['OFFER_ID'].' >DELETE</a> </td>
                                </tr>';
                        }

                        oci_free_statement($sqlCode);
                        oci_close($connection);
                    ?>
                </tbody>
            </table>
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