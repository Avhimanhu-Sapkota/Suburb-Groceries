<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> </title>

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

        <!--Creating a nav bar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <!-- this is shown only on mobile and medium screens -->

            <a href="index.php" class="navbar-brand d-lg-none">
                <img src="../images/logo.PNG" height="50vw" alt="Suburb Groceries Logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation" onclick="openNav()">
                <img src="../images/redMenuIcon.png" height="30vw" alt="Menu Icon">
            </button>

            <!--  Using flexbox classes to remove in small screen and present on large screens -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarToggle">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link " href="shops.php">SHOPS <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">PRODUCTS </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="specials.php">SPECIALS</a>
                    </li>
                </ul>

                <a class="navbar-brand d-none d-lg-block" href="index.php">
                    <img src="../images/logo.PNG" height="55vw" alt="Suburb Groceries Logo">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="ourStory.php">OUR STORY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="../images/blackSearch.png" height="25vw" alt="Search Icon" 
                            onmouseover= "this.src='../images/redSearch.png'" 
                            onmouseout="this.src='../images/blackSearch.png'" onclick="openSearch()">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="basket.php">
                            <img src="../images/blackCart.png" height="25vw" alt="Basket Icon" 
                            onmouseover= "this.src='../images/redCart.png'" 
                            onmouseout="this.src='../images/blackCart.png'" >
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <img src="../images/blackLogin.png" height="25vw" alt="Login Icon"
                            onmouseover= "this.src='../images/redLogin.png'" 
                            onmouseout="this.src='../images/blackLogin.png'" >
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="overlay" id="mynav">
            <a href="" class="closebutton" onclick="closeNav()">&times;</a>
            
            <div class="overlay-content">
                <a href="index.php"> HOME </a>
                <a href="shops.php"> SHOPS </a>
                <a href="products.php"> PRODUCTS </a>
                <a href="specials.php"> SPECIALS </a>
                <a href="ourStory.php"> OUR STORY </a>
                <a href="#" onclick="openSearch()"> SEARCH </a>
                <a href="basket.php"> BASKET </a>
                <a href="login.php"> LOGIN </a>
            </div>
        </div>

        <div class="overlay" id="search">
            <a href="#" class="closebutton" onclick="closeSearch()">&times;</a>

            <div class="overlay-content">
                <form method='post' action='search.php'>
                    <input type="text" name="search" placeholder="SEARCH HERE" autocomplete="off"
                    style="width:70%;background-color: #360303;border: 1px solid lightslategray;color:white;
                    font-family: 'Open Sans', sans-serif; font-size: 2vw;text-align: center;text-transform:uppercase;"> <br><br>
                    <input class="button" type="submit" name="searchsubmit" value="SEARCH">
                </form>
            </div>
        </div>

        <script>
            function openNav(){
                document.getElementById("mynav").style.height="100%";
            }
            function closeNav(){
                document.getElementById("mynav").style.height="0";
            }
            function openSearch(){
                document.getElementById("search").style.height="100%";
            }
            function closeSearch(){
                document.getElementById("search").style.height="0";
            }
        </script>
    </body>
</html>