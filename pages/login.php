<?php
    session_start();
     include('connect.php');
 
    
    if(isset($_POST['submitButton'])){
        $username= trim($_POST['username']);
        $password= trim($_POST['password']);

        $password=md5($password);

        $sqlCode = oci_parse($connection, 'SELECT * FROM users WHERE username=:username and password=:password');
        oci_bind_by_name($sqlCode, ":username", $username);  
        oci_bind_by_name($sqlCode, ":password", $password);  

        oci_execute($sqlCode);
        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $count = oci_num_rows($sqlCode);
        $verified = $row['VERIFIED'];

        if($count==1 && $verified==1){
            $_SESSION['username']=$username;

             include('connect.php');
 
            $sqlCode = oci_parse($connection, ' SELECT USERS_ID FROM USERS where USERNAME = :username ');
            oci_bind_by_name($sqlCode, ":username", $username);  
            oci_execute($sqlCode);
            $row = oci_fetch_array($sqlCode);
            $_SESSION['userID']=$row['USERS_ID'];
            include ('insertToCart.php');
            header("Location: index.php");
        }
        else{
            $sqlCode = oci_parse($connection, 'SELECT * FROM users WHERE username=:username');
            oci_bind_by_name($sqlCode, ":username", $username);  
            oci_execute($sqlCode);
            $count = oci_fetch_row($sqlCode) ;

            if($count > 1){
                $message = "PLEASE ENTER CORRECT LOGIN CREDENTIALS OR VERIFY YOUR ACCOUNT !!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else{
                $message = "USER DOES NOT EXIST !!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
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
        <title> Log In - Suburb Groceries </title>

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
            
    
            if (empty($_SESSION['username'])){
                include ('header.php');
            }
            else{
                include ('loggedHeader.php');
            }
        ?>
        <img src="../images/coverImage2.jpg" width="100%" alt="Cover Image 2">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">LOGIN</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Please enter your username and password:
        </p>

        <form method="post" action="login.php" class="sign-up-form"> 
            <table class="form-table" cellpadding="5" cellspacing="5" >
                <tbody>
                    <tr>
                        <td>
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td>
                            <input type="text" name="username" class="textInput" autocomplete="off" placeholder=" Username "  value="<?php if(isset($username)){echo $username;} ?>" required >
                            <br><br><br>
                            <input type="password" name="password" class="textInput" autocomplete="off" placeholder=" Password "  required >
                            <br><br><br>
                            <div style="text-align:center">
                                <input type="submit" name="submitButton" value=" LOGIN" class="newButton" > 
                            </div>
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                            Don't have an account? <a href="signUp.php" class="link" >Create one</a> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

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