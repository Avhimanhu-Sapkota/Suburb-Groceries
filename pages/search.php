<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Search Results - Suburb Groceries   </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">SEARCH RESULTS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
            <div class="row">

            <?php
                     include('connect.php');
 
                    $searchDetails = $_POST['search'];
                    $searchDetails = strtolower($searchDetails);

                    $sql="SELECT * FROM PRODUCTS WHERE LOWER(NAME) LIKE '%' || :searchDetails || '%' OR LOWER(DESCRIPTION) LIKE '%' || :searchDetails || '%' OR LOWER(PRODUCT_CATEGORY) LIKE '%' || :searchDetails || '%' ";
                    $sqlCode = oci_parse($connection, $sql);
                    oci_bind_by_name($sqlCode, ":searchDetails", $searchDetails);  
                    oci_bind_by_name($sqlCode, ":searchDetails", $searchDetails);  
                    oci_bind_by_name($sqlCode, ":searchDetails", $searchDetails);  

                    oci_execute($sqlCode);
                    $count=0;
                    include('printProduct.php');

                    if ($count == 0){
                        echo"</div> <div class='empty-box' height='980px'></div>";
                        echo"<h3 style='text-align:center'> T H E R E &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            S U C H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P R O D U C T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I N &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S U B U R B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G R O C E R I E S </h3><br><br>";
                        echo"<h6 style='text-align:center'>PLEASE SEARCH FOR OTHERS PRODUCTS </h6>";
                        echo" <div class='empty-box' height='80px'></div>";
                    }

            ?>
            </div>
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