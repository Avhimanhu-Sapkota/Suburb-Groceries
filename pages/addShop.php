<?php
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        
        $shopName= trim($_POST['shopName']);
        $address= trim($_POST['address']);
        $contact= trim($_POST['contact']);
        $shopType= trim($_POST['shopType']);

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
 

        $sql="INSERT INTO shop (SHOP_ID, SHOP_NAME, ADDRESS, CONTACT_NO, TYPE, IMAGE, FK1_USERS_ID) 
                    VALUES (pk_shop_id.nextval, :shopName, :address, :contact, :shopType, :file_name, :userID )";

        $sqlCode = oci_parse($connection, $sql);

        oci_bind_by_name($sqlCode, ":shopName", $shopName);
        oci_bind_by_name($sqlCode, ":address", $address);
        oci_bind_by_name($sqlCode,":contact", $contact);
        oci_bind_by_name($sqlCode, ":shopType", $shopType);
        oci_bind_by_name($sqlCode, ":file_name", $file_name);
        oci_bind_by_name($sqlCode, ":userID", $userID);
            
        $insert=oci_execute($sqlCode);
            
        if ($insert){
            header("Location: manageShop.php");
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
        <title> Add Shop - Suburb Groceries </title>

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
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>

        <img src="../images/coverImage2.jpg" width="100%" alt="Cover Image 2">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">ADD SHOP</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Expand your business as a trader. <br>Please fill in the information below to  add a new shop:
        </p>

        <div class="gap"></div>
        
            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="addShop.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="7">
                        <!------------------------------Manage Here ------------------------------->
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td>
                            <input type="text" name="shopName" class="textInput" autocomplete="off" placeholder=" Shop Name "  value="<?php if(isset($shopName)){echo $shopName;} ?>" required >
                        </td>
                    </tr>

                    <tr>
                    <td><input type='file' name='productimage' class="textInput"> </td> 
                    </tr>
                    <tr>
                        <td> <input type="text" name="address" class="textInput" autocomplete="off" placeholder=" Address "  value="<?php if(isset($address)){echo $address;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="contact" class="textInput" autocomplete="off" placeholder=" Contact No "  value="<?php if(isset($contact)){echo $contact;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="shopType" class="textInput"  value="<?php if(isset($shopType)){echo $shopType;} ?>"required>
                                <option value="" disabled selected> Select shop type</option>
                                <option value="Bakery" >Bakery</option>
                                <option value="Butcher" >Butcher</option>
                                <option value="Fishmonger" >Fishmonger</option>
                                <option value="Delicatessen" >Delicatessen</option>
                                <option value="Green Grocer" >Greeen Grocer</option>
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