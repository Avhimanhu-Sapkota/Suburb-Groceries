<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Sorted Products - Suburb Groceries </title>

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
             include('connect.php');
 

        ?>

        <img src="../images/coverImage2.jpg" width="100%" alt="Cover Image 2">

        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">SORTED PRODUCTS</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <?php
                
                if (isset($_POST['sortProudcts'])){

                    if (isset($_POST['alphabet'])){
                        $alphaEmptyCheck = "notEmpty";
                    }
                    else{
                        $alphaEmptyCheck = "empty";
                    }

                    if (isset($_POST['price'])){
                        $priceEmptyCheck = "notEmpty";
                    }
                    else{
                        $priceEmptyCheck = "empty";
                    }
                    if( $alphaEmptyCheck == "notEmpty" && $priceEmptyCheck == "empty"){
                       
                        if($_POST['alphabet'] == "ascending"){
                            $sql = "SELECT * FROM PRODUCTS ORDER BY NAME";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        else{
                            $sql = "SELECT * FROM PRODUCTS ORDER BY NAME DESC";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                    }

                    elseif ( $priceEmptyCheck == "notEmpty" && $alphaEmptyCheck == "empty"){

                            if ($_POST['price']=="range1"){
                                $lowest="0";
                                $highest="20";
                            }
                            else if ($_POST['price']=="range2"){
                                $lowest="20";
                                $highest="50";
                            }
                            else if ($_POST['price']=="range3"){
                                $lowest="50";
                                $highest="100";
                            }
                            else if ($_POST['price']=="range4"){
                                $lowest="100";
                                $highest="1000000";
                            }

                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                            
                     }

                    elseif ( $alphaEmptyCheck == "notEmpty" && $priceEmptyCheck == "notEmpty"){
                        if($_POST['alphabet'] == "ascending" && $_POST['price']=="range1"){
                            $lowest="0";
                            $highest="20";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif($_POST['alphabet'] == "descending" && $_POST['price']=="range1"){
                            $lowest="0";
                            $highest="20";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME DESC";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "ascending" && $_POST['price']=="range2"){
                            $lowest="20";
                            $highest="50";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "descending" && $_POST['price']=="range2"){
                            $lowest="20";
                            $highest="50";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME DESC";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "ascending" && $_POST['price']=="range3"){
                            $lowest="50";
                            $highest="100";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "descending" && $_POST['price']=="range3"){
                            $lowest="50";
                            $highest="100";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME DESC";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "ascending" && $_POST['price']=="range4"){
                            $lowest="100";
                            $highest="1000000";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                        elseif ($_POST['alphabet'] == "descending" && $_POST['price']=="range4"){
                            $lowest="100";
                            $highest="1000000";
                            $sql = "SELECT * FROM PRODUCTS WHERE PRICE BETWEEN :lowest AND :highest ORDER BY NAME DESC";
                            $sqlCode = oci_parse($connection, $sql);
                            oci_bind_by_name($sqlCode, ":lowest", $lowest);
                            oci_bind_by_name($sqlCode, ":highest", $highest);
                            oci_execute($sqlCode);
                            include('printProduct.php');
                        }
                    }
                    else{
                        echo"<h3 style='text-align:center'> T H E R E &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            S U C H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P R O D U C T&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I N &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T H E  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;S U B U R B &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; G R O C E R I E S</h3><br><br>";
                        echo"<h6 style='text-align:center'>PLEASE FIND OTHERS PRODUCTS </h6>";
                    }
                }
                
        ?>

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