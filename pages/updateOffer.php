
<?php
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        
        $offerID= trim($_POST['offerID']);
        $offerName= trim($_POST['offerName']);
        $startDate= trim($_POST['startDate']);
        $endDate= trim($_POST['endDate']);
        $discount= trim($_POST['discount']);

        $sqlCode= oci_parse($connection, 'SELECT IMAGE FROM OFFERS WHERE OFFER_ID=:offerID');
        oci_bind_by_name($sqlCode, ":offerID", $offerID);
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
        
        include('userID.php');
            $userID = $_SESSION['userID'];
             include('connect.php');
 

        $sql="UPDATE OFFERS SET NAME=:offerName, START_DATE=to_date(:startDate,'yyyy-mm-dd'), END_DATE=to_date(:endDate,'yyyy-mm-dd'), IMAGE=:file_name, DISCOUNT_PERCENT=:discount WHERE OFFER_ID=:offerID";

        $sqlCode = oci_parse($connection, $sql);

        oci_bind_by_name($sqlCode, ":offerName", $offerName);
        oci_bind_by_name($sqlCode, ":startDate", $startDate);
        oci_bind_by_name($sqlCode,":endDate", $endDate);
        oci_bind_by_name($sqlCode, ":file_name", $file_name);
        oci_bind_by_name($sqlCode, ":discount", $discount);
        oci_bind_by_name($sqlCode, ":offerID", $offerID);
            
        $insert=oci_execute($sqlCode);
            
        if ($insert){
           header("Location: manageOffer.php");
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
        <title> Update Offer - Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">UPDATE OFFER DETAILS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Customize the information <br>Update the information below by filling up the form:
        </p>

        <div class="gap"></div>
        
        <?php
             include('connect.php');
 

            if(isset($_GET['cid'])){
                $editID=$_GET['cid'];
                $sqlCode= oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:num');
                oci_bind_by_name($sqlCode, ":num", $editID);
                oci_execute($sqlCode);
                
                while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $offerName= $row['NAME'];
                    $startDate= $row['START_DATE'];
                    $endDate= $row['END_DATE'];
                    $discount= $row['DISCOUNT_PERCENT'];
                    $file_name= $row['IMAGE'];
                }
            } 
        ?>

            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="updateOffer.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="9">
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
                            <input type="text" name="offerID" class="textInput" autocomplete="off"  value="<?php echo $editID?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="offerName" class="textInput" autocomplete="off" placeholder=" Offer Name "  value="<?php if(isset($offerName)){echo $offerName;} ?>" required >
                        </td>
                    </tr>
                    <tr>
                        <td> <input type="date" name="startDate" class="textInput" autocomplete="off" placeholder="Offer Start Date (MM/DD/YYYY)" style="text-transform:uppercase " value="<?php if(isset($startDate)){echo $startDate;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="date" name="endDate" class="textInput" autocomplete="off" placeholder="Offer End Date (MM/DD/YYYY)" style="text-transform:uppercase " value="<?php if(isset($endDate)){echo $endDate;} ?>" required > </td>
                    </tr>                    
                    <tr>
                        <td> <input type="number" name="discount" class="textInput" autocomplete="off" placeholder=" Discount (%) "  value="<?php if(isset($discount)){echo $discount;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <br>
                            <input type="submit" name="submitButton" value=" UPDATE OFFER" class="newButton"> 
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