<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Manage Products - Trader Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">MANAGE PRODUCTS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>
        
        <form method='post' action='addProduct.php' class="container" style="text-align:right;overflow-x:auto;">
            <input class="newButton" type="submit" name="addProduct" value="Add Product">
            <br><br>
        </form>

        <div class="container" style="overflow-x:auto;">
            <table class="otherTables" cellpadding="5" cellspacing="5" >            
                <thead>
                    <tr>
                        <th style="text-align:center">PRODUCT ID</th>
                        <th>PRODUCT NAME</th>
                        <th style="text-align:center">IMAGE</th>
                        <th  style="text-align:center">PRICE (£)</th>
                        <th  style="text-align:center">QUANTITY (in KG per ORDER)</th>
                        <th  style="text-align:center">AVAILABLE STOCK</th>
                        <th  style="text-align:center">MIN ORDER</th>
                        <th  style="text-align:center">MAX ORDER</th>
                        <th>CATEGORY</th>
                        <th>DESCRIPTION</th>
                        <th>ALLERGY INFO</th>
                        <th  style="text-align:center">OFFER ID</th>
                        <th  style="text-align:center">SHOP ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        error_reporting(0);
                        include('userID.php');
                        $userID = $_SESSION['userID'];
                         include('connect.php');
 

                        $sqlCode = oci_parse($connection, 'SELECT * FROM products where FK3_USERS_ID=:userID order by PRODUCT_ID');
                        oci_bind_by_name($sqlCode, ":userID", $userID);  
                        oci_execute($sqlCode);

                        while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                            
                            echo '<tr>
                                    <td style="text-align:center">'.$row["PRODUCT_ID"].'</td>
                                    <td>'.$row["NAME"].'</td>
                                    <td><img alt ="'.$row['IMAGE'].'" src="../images/uploads/'.$row['IMAGE'].'"  style="height:auto;width:auto;max-width:100%"/></td>
                                    <td  style="text-align:center">'.$row["PRICE"].'</td>
                                    <td  style="text-align:center">'.$row["QUANTITY_PER_ITEM"].'</td>
                                    <td  style="text-align:center">'.$row["AVAILABLE_STOCK"].'</td>
                                    <td  style="text-align:center">'.$row["MINIMUN_ORDER"].'</td>
                                    <td  style="text-align:center">'.$row["MAXIMUM_ORDER"].'</td>
                                    <td>'.$row["PRODUCT_CATEGORY"].'</td>
                                    <td>'.$row["DESCRIPTION"].'</td>
                                    <td>'.$row["ALLERGY_INFO"].'</td>
                                    <td style="text-align:center">'.$row["FK1_OFFER_ID"].'</td>
                                    <td style="text-align:center">'.$row["FK2_SHOP_ID"].'</td>
                                    <td><a href=updateProduct.php?cid='.$row['PRODUCT_ID'].'>EDIT </a><br> 
                                    <a href=deleteProduct.php?cid='.$row['PRODUCT_ID'].' >DELETE</a> </td>
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