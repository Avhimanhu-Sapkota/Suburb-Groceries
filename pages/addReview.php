<?php
    session_start();
    include('connect.php');

    if(isset($_POST['submitButton'])){
        
        $rating= trim($_POST['rating']);
        $reviewDetails= $_POST['reviewDetails'];
        $productID= trim($_POST['productID']);
        $date = date("Y-m-d");
        include('userID.php');
            $userID = $_SESSION['userID'];
            include('connect.php');
        
        if($rating >= 0 && $rating <=5){
            $sql="INSERT INTO REVIEWS_RATINGS (REVIEW_ID, RATING_NUMBER, DATE_OF_REVIEW, REVIEW_DETAILS, FK1_PRODUCT_ID, FK2_USERS_ID) 
                    VALUES (pk_review_id.nextval, :rating, to_date(:dateOfReview,'yyyy-mm-dd'), :reviewDetails, :productID, :userID )";

            $sqlCode = oci_parse($connection, $sql);

            oci_bind_by_name($sqlCode, ":rating", $rating);
            oci_bind_by_name($sqlCode, ":dateOfReview", $date);
            oci_bind_by_name($sqlCode,":reviewDetails", $reviewDetails);
            oci_bind_by_name($sqlCode, ":productID", $productID);
            oci_bind_by_name($sqlCode, ":userID", $userID);
                
            $insert=oci_execute($sqlCode);

            if ($insert){
                header("Location: productView.php?pid=$productID");
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
        <title> Add Review - Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">ADD REVIEW</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Review and Rate the product. <br>Please fill in the information below to  review and rate the product:
        </p>

        <div class="gap"></div>
        <?php
             include('connect.php');

            if(isset($_GET['pid'])){
                $editPID=$_GET['pid'];
                $sqlCode= oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:num');
                oci_bind_by_name($sqlCode, ":num", $editPID);
                oci_execute($sqlCode);
                
                while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $productName = $row['NAME'];
                    $file_name = $row['IMAGE'];
                }
            } 

        ?>

        
            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="addReview.php" class="sign-up-form"  method="POST"  enctype="multipart/form-data"> 
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
                            <input type="text" name="productID" class="textInput" autocomplete="off"  value="<?php echo $editPID?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="rating" class="textInput" autocomplete="off" placeholder=" Rate this product (0-5)"  value="<?php if(isset($rating)){echo $rating;} ?>" required >
                        </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="reviewDetails" class="textInput" autocomplete="off" placeholder=" Write Your Review Here "  value="<?php if(isset($reviewDetails)){echo $reviewDetails;} ?>"  > </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <br>
                            <input type="submit" name="submitButton" value=" ADD REVIEW" class="newButton"> 
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