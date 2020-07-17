<?php
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        
        $shopID=trim($_POST['shopID']);
        $shopName= trim($_POST['shopName']);
        $address= trim($_POST['address']);
        $contact= trim($_POST['contact']);
        $shopType= trim($_POST['shopType']);

        $sqlCode= oci_parse($connection, 'SELECT IMAGE FROM SHOP WHERE SHOP_ID=:shopID');
        oci_bind_by_name($sqlCode, ":shopID", $shopID);
        oci_execute($sqlCode);

        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $file_name = $row['IMAGE'];

        $uniqe = uniqid();
        if (!empty($_FILES['productimage']['name'])){
            $file_name= $uniqe.$_FILES['productimage']['name'];
            $file_tmp_loc= $_FILES['productimage']['tmp_name'];
            $file_store="../images/uploads/".$file_name;

            move_uploaded_file($file_tmp_loc, $file_store);
        }

            $sql="UPDATE SHOP SET SHOP_NAME=:shopName, ADDRESS=:address, CONTACT_NO=:contact, TYPE=:shopType, IMAGE=:file_name WHERE SHOP_ID=:shopID";
            $sqlCode = oci_parse($connection, $sql);

            oci_bind_by_name($sqlCode, ":shopName", $shopName);
            oci_bind_by_name($sqlCode, ":address", $address);
            oci_bind_by_name($sqlCode,":contact", $contact);
            oci_bind_by_name($sqlCode, ":shopType", $shopType);
            oci_bind_by_name($sqlCode, ":file_name", $file_name);
            oci_bind_by_name($sqlCode, ":shopID", $shopID);
                 
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
        <title> Update Shop - Suburb Groceries </title>

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

        <img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">UPDATE SHOP DETAILS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Customize the information <br>Update the information below by filling up the form:
        </p>

        <div class="gap"></div>
        
        <?php
             include('connect.php');
 

            if(isset($_GET['cid'])){
                $editID=$_GET['cid'];
                $sqlCode= oci_parse($connection, 'SELECT * FROM SHOP WHERE SHOP_ID=:num');
                oci_bind_by_name($sqlCode, ":num", $editID);
                oci_execute($sqlCode);
                
                while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $shopName = $row['SHOP_NAME'];
                    $address = $row['ADDRESS'];
                    $contact = $row['CONTACT_NO'];
                    $shopType = $row['TYPE'];
                    $file_name = $row['IMAGE'];
                }
            } 
        ?>

        <table class="form-table" cellpadding="5" cellspacing="5" >
                        <form method="post" action="updateShop.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
                            <tbody>
                                <tr>
                                    <td rowspan="8">
                                    <!------------------------------Manage Here ------------------------------->
                                        <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                                    </td>
                                
                                    <td style="text-align:center">
                                        <?php echo '<img alt =" '. $file_name.'"  src="../images/uploads/'.$file_name.'"  style="height:auto; width:auto; max-width:20%;"/>';?>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <br><input type='file' name='productimage' class="textInput" > 
                                        </td>
                                    </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="shopID" class="textInput" autocomplete="off"  value="<?php echo $editID?>" readonly >
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="shopName" class="textInput" autocomplete="off" placeholder=" Shop Name "  value="<?php echo $shopName?>" required >
                                    </td>
                                </tr>
                                <tr>
                                    <td> <input type="text" name="address" class="textInput" autocomplete="off" placeholder=" Address "  value="<?php echo $address?>" required > </td>
                                </tr>
                                <tr>
                                    <td> <input type="number" name="contact" class="textInput" autocomplete="off" placeholder=" Contact No "  value="<?php echo $contact?>" required > </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="shopType" class="textInput"  value="<?php echo $type?>" required>
                                            <option value="" disabled> Select shop type</option>
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
                                        <input type="submit" name="submitButton" value=" UPDATE SHOP" class="newButton"> 
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