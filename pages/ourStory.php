<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Our Story -  Suburb Groceries </title>

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
        <img src="../images/coverImage2.jpg" width="100%" alt="Cover Image 2">

        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">OUR STORY</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">
        <div class="gap"></div>

        <div class="container">
            <p style='text-align:justify'>
                In today's world of technology, a residential area of Cleckhuddersfax still has a local shopping
                area for groceries shopping. Larger stores with a wide range of products  and goods have just been proposed in
                the town which would declone the sales revenue of local traders. Thus, Suburb Groceries is an advanced and convenient
                e-commerce grocery store which has merged local traders of cleckhuddersfax to server the people with Fresh, healthy and 
                organic grocery which basically includes green vegetables, meat and animal products, dairy and bakery products and delicatessens.
            </p>
            <p style='text-align:justify'>
                Suburb Grocery aims to be Leeds' biggest online sustenance and grocery store and we are already on our way there. With hundreds of 
                items and a lot of brands on our list, you will discover all that you are searching for. From fruits and vegetables, bakery items, spices and 
                seasonings to packaged items, fish and meat – we have everything. 
            </p>
            <p style='text-align:justify'>
                Suburb Groceries enables you to leave the drudgery of grocery shopping and welcome a simple, loosened up method for pursuing and looking 
                for groceries. Find new items and shop for all your sustenance and grocery needs from the solace of your home or office. No more spending your
                valuable time travelling to the grocery store and picking out the items you need. What you are looking for could just be a click away!
            </p>
            <p style='text-align:justify'>
                With amazing reviews from our customers to back us up, you can be assured to have the best items delivered. Quality and customer satisfaction are our 
                number one priority and we are continuously working to keep raising our standards.
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