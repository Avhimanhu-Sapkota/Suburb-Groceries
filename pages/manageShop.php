<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Manage Shops - Trader Suburb Groceries </title>

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
            error_reporting(0);
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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">MANAGE SHOPS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>
        
        <form method='post' action='addShop.php' class="container" style="text-align:right;overflow-x:auto;">
            <input class="newButton" type="submit" name="addShop" value="Add Shop">
            <br><br>
        </form>

        <div class="container" style="overflow-x:auto;">
            <table class="tables" cellpadding="5" cellspacing="5" >            
                <thead>
                    <tr>
                        <th style="text-align:center">SHOP ID</th>
                        <th>SHOP NAME</th>
                        <th>ADDRESS</th>
                        <th>CONTACT NO</th>
                        <th>SHOP TYPE</th>
                        <th style="text-align:center">IMAGE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('userID.php');
                        $userID = $_SESSION['userID'];
                         include('connect.php');
 

                        $sqlCode = oci_parse($connection, 'SELECT * FROM shop where FK1_USERS_ID=:userID order by SHOP_ID');
                        oci_bind_by_name($sqlCode, ":userID", $userID);  
                        oci_execute($sqlCode);

                        while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                            
                            echo '<tr>
                                    <td style="text-align:center">'.$row["SHOP_ID"].'</td>
                                    <td>'.$row["SHOP_NAME"].'</td>
                                    <td>'.$row["ADDRESS"].'</td>
                                    <td>'.$row["CONTACT_NO"].'</td>
                                    <td>'.$row["TYPE"].'</td>
                                    <td><img alt ="'.$row['IMAGE'].'" src="../images/uploads/'.$row['IMAGE'].'"  style="height:auto;width:auto;max-width:100%"/></td>
                                    <td><a href=updateShop.php?cid='.$row['SHOP_ID'].'>EDIT </a><br> 
                                    <a href=deleteShop.php?cid='.$row['SHOP_ID'].' >DELETE</a> </td>
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