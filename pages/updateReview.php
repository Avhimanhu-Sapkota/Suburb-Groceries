<?php
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        $reviewID= trim($_POST['reviewID']);
        $rating= trim($_POST['rating']);
        $reviewDetails= $_POST['reviewDetails'];
        $productID= trim($_POST['productID']);
        $date = date("Y-m-d");
        
        if($rating >= 0 && $rating <=5){
            $sql="UPDATE REVIEWS_RATINGS SET RATING_NUMBER=:rating, DATE_OF_REVIEW=to_date(:dateOfReview,'yyyy-mm-dd'), REVIEW_DETAILS=:reviewDetails WHERE REVIEW_ID=:reviewID";

            $sqlCode = oci_parse($connection, $sql);

            oci_bind_by_name($sqlCode, ":rating", $rating);
            oci_bind_by_name($sqlCode, ":dateOfReview", $date);
            oci_bind_by_name($sqlCode,":reviewDetails", $reviewDetails);
            oci_bind_by_name($sqlCode, ":reviewID", $reviewID);
                
            $insert=oci_execute($sqlCode);

            if ($insert){
                header("Location: products.php");
            }
        }
        else{
            $message = "PLEASE RATE THIS PRODUCT WITHIN 0 TO 5 RATING NUMBER ONLY !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
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
        <title> Update Review - Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">UPDATE REVIEW</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Review and Rate the product. <br>Please fill in the information below to update your review on the product:
        </p>

        <div class="gap"></div>
        <?php
             include('connect.php');
 

            if(isset($_GET['rid'])){
                $editRID=$_GET['rid'];
                $sqlCode= oci_parse($connection, 'SELECT * FROM REVIEWS_RATINGS WHERE REVIEW_ID=:num');
                oci_bind_by_name($sqlCode, ":num", $editRID);
                oci_execute($sqlCode);
                
                while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $rating = $row['RATING_NUMBER'];
                    $reviewDetails = $row['REVIEW_DETAILS'];
                    echo $rating;
                }
            } 

            if(isset($_GET['pid'])){
                $editPID=$_GET['pid'];

                $sqlCode= oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:num');
                oci_bind_by_name($sqlCode, ":num", $editPID);
                oci_execute($sqlCode);
                
                while (($row1 = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $productName = $row1['NAME'];
                    $file_name = $row1['IMAGE'];
                }
            }
        ?>

        
            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="updateReview.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="8">
                        <!------------------------------Manage Here ------------------------------->
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td style="text-align:center">
                            <?php echo '<img alt =" '. $file_name.'"  src="../images/uploads/'.$file_name.'"  alt="Product Image" style="height:auto; width:auto; max-width:20%;"/> <br> <h5 style="color:#e52029"> '.$productName.' </h5>';?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="reviewID" class="textInput" autocomplete="off"  value="<?php echo $editRID?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="rating" class="textInput" autocomplete="off" placeholder=" Rate this product (0-5)"  value="<?php echo $rating ?>" required >
                        </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="reviewDetails" class="textInput" autocomplete="off" placeholder=" Write Your Review Here "  value="<?php echo $reviewDetails ?>"  > </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <br>
                            <input type="submit" name="submitButton" value=" UPDATE REVIEW" class="newButton"> 
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