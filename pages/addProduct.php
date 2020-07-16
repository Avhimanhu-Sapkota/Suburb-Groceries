
<?php
    session_start();
    include('connect.php'); 

    if(isset($_POST['submitButton'])){
        
        $productName= trim($_POST['productName']);
        $price= trim($_POST['price']);
        $quantity= trim($_POST['quantity']);
        $availableStock= trim($_POST['availableStock']);
        $minOrder= trim($_POST['minOrder']);
        $maxOrder= trim($_POST['maxOrder']);
        $category= trim($_POST['category']);
        $productDesc= trim($_POST['productDesc']);
        $allergyInfo= trim($_POST['allergyInfo']);
        $offerID= trim($_POST['offerID']);
        $shopID= trim($_POST['shopID']);

        $uniqe = uniqid();
        if (!empty($_FILES['productimage']['name'])){
			$file_name= $uniqe.$_FILES['productimage']['name'];
        	$file_tmp_loc= $_FILES['productimage']['tmp_name'];
        	$file_store="../images/uploads/".$file_name;

			move_uploaded_file($file_tmp_loc, $file_store);
        }
        
        include('userID.php');
            $userID = $_SESSION['userID'];
            include('connect.php');

        $sql="INSERT INTO PRODUCTS (PRODUCT_ID, NAME, PRICE, QUANTITY_PER_ITEM, AVAILABLE_STOCK, MINIMUN_ORDER, MAXIMUM_ORDER, PRODUCT_CATEGORY, IMAGE, DESCRIPTION, ALLERGY_INFO, FK1_OFFER_ID, FK2_SHOP_ID, FK3_USERS_ID) 
                    VALUES (pk_product_id.nextval, :productName, :price, :quantity, :availableStock, :minOrder, :maxOrder, :category, :file_name, :productDesc, :allergyInfo, :offerID, :shopID, :userID)";

        $sqlCode = oci_parse($connection, $sql);

        oci_bind_by_name($sqlCode, ":productName", $productName);
        oci_bind_by_name($sqlCode, ":price", $price);
        oci_bind_by_name($sqlCode,":quantity", $quantity);
        oci_bind_by_name($sqlCode, ":availableStock", $availableStock);
        oci_bind_by_name($sqlCode, ":minOrder", $minOrder);
        oci_bind_by_name($sqlCode, ":maxOrder", $maxOrder);
        oci_bind_by_name($sqlCode, ":category", $category);
        oci_bind_by_name($sqlCode, ":file_name", $file_name);
        oci_bind_by_name($sqlCode, ":productDesc", $productDesc);
        oci_bind_by_name($sqlCode, ":allergyInfo", $allergyInfo);
        oci_bind_by_name($sqlCode, ":offerID", $offerID);
        oci_bind_by_name($sqlCode, ":shopID", $shopID);
        oci_bind_by_name($sqlCode, ":userID", $userID);
            
        $insert=oci_execute($sqlCode);
            
        if ($insert){
            header("Location: manageProduct.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Add Product - Suburb Groceries </title>

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
            //error_reporting(0);
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>

        <img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">ADD PRODUCT</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Please fill in the information below to  add a new product:
        </p>

        <div class="gap"></div>
        
            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="addProduct.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="13">
                        <!------------------------------Manage Here ------------------------------->
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td>
                            <input type="text" name="productName" class="textInput" autocomplete="off" placeholder=" Product Name "  value="<?php if(isset($productName)){echo $productName;} ?>" required >
                        </td>
                    </tr>
                    <tr>
                        <td><input type='file' name='productimage' class="textInput"> </td> 
                    </tr>
                    <tr>
                        <td> <input type="number" name="price" class="textInput" autocomplete="off" placeholder=" Price (£) "  value="<?php if(isset($price)){echo $price;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="quantity" class="textInput" autocomplete="off" placeholder=" Quantity (in KG per Order) "  value="<?php if(isset($quantity)){echo $quantity;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="availableStock" class="textInput" autocomplete="off" placeholder=" Available Stock "  value="<?php if(isset($availableStock)){echo $availableStock;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="minOrder" class="textInput" autocomplete="off" placeholder=" Minimum Order "  value="<?php if(isset($minOrder)){echo $minOrder;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="maxOrder" class="textInput" autocomplete="off" placeholder=" Maximum Order "  value="<?php if(isset($maxOrder)){echo $maxOrder;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="category" class="textInput"  value="<?php if(isset($category)){echo $category;} ?>"required>
                                <option value="" disabled selected> Select product type</option>
                               <?php
                                    include('userID.php');
                                    $userID = $_SESSION['userID'];
                                    include('connect.php');
                                    $sqlCode = oci_parse($connection, ' SELECT TYPE FROM SHOP WHERE FK1_USERS_ID = :userID ');
                                    oci_bind_by_name($sqlCode, ":userID", $userID);  
                                    oci_execute($sqlCode);
                                    while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                                        $shopType=$row['TYPE'];
                                        echo"<option value='".$shopType."' >".$shopType."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="productDesc" rows="5" cols="20"  class="textInput" autocomplete="off" placeholder=" Product Description "  value="<?php if(isset($productDesc)){echo $productDesc;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="allergyInfo" rows="3" cols="20"  class="textInput" autocomplete="off" placeholder=" Allergy Info "  value="<?php if(isset($allergyInfo)){echo $allergyInfo;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td>
                        <select name="offerID" class="textInput"  value="<?php if(isset($offerID)){echo $offerID;} ?>">
                                <option value="" disabled selected> Select offer </option>
                                <?php
                                    include('userID.php');
                                    $userID = $_SESSION['userID'];
                                    include('connect.php');
                                    $sqlCode = oci_parse($connection, ' SELECT OFFER_ID, NAME FROM OFFERS WHERE FK1_USERS_ID = :userID ');
                                    oci_bind_by_name($sqlCode, ":userID", $userID);  
                                    oci_execute($sqlCode);
                                    while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                                        $offerID=$row['OFFER_ID'];
                                        $offerName=$row['NAME'];
                                        echo"<option value='".$offerID."' >".$offerName."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <select name="shopID" class="textInput"  value="<?php if(isset($shopID)){echo $shopID;} ?>"required>
                                <option value="" disabled selected> Select shop </option>
                                <?php
                                    include('userID.php');
                                    $userID = $_SESSION['userID'];
                                    include('connect.php');
                                    $sqlCode = oci_parse($connection, ' SELECT SHOP_ID, SHOP_NAME FROM SHOP WHERE FK1_USERS_ID = :userID ');
                                    oci_bind_by_name($sqlCode, ":userID", $userID);  
                                    oci_execute($sqlCode);
                                    while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                                        $shopID=$row['SHOP_ID'];
                                        $shopName=$row['SHOP_NAME'];
                                        echo"<option value='".$shopID."' >".$shopName."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <br>
                            <input type="submit" name="submitButton" value=" ADD SHOP" class="newButton"> 
                        </td>
                    </tr>
                </tbody>
                      
        </form>
            </table>  

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