<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Refund Policy - Suburb Groceries </title>

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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
        <img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">

        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">REFUND POLICY</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
        <p style='text-align:justify'>
            We try providing you with the best possible grocery items available. However, we do understand that
            there might be some lapses from our side as well. Due to the perishable nature of our products, we
            cannot return them. So, we cannot accept returns for our products. But we do, however, offer refunds
            for the items that were damaged, defective, or spoilt during the time of purchase.
            In the event you are dissatisfied with your purchase, you must contact us within a day of receiving your
            order. We reserve the right to limit refunds and replacements, and we can only offer one replacement
            per consumer. Failure to report spoilage within 48 hours of receiving the order will be at the loss of the
            consumer.
        </p>
        <p style='text-align:justify'>
            We urge the customers to check the addresses carefully while placing an order as we cannot guarantee
            the quality of the product if the package has to be re-routed.
        </p>
        <p style='text-align:justify'>
            Cancellations of any orders that have been confirmed must be informed within an hour of the purchase,
            otherwise the product will be delivered and you will be charged for the product.
        </p>
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