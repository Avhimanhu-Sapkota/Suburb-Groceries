<?php
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        $currentPassword= trim($_POST['currentPassword']);
        $newPassword= trim($_POST['newPassword']);
        $confirmPassword= trim($_POST['confirmPassword']);

        $currentPassword=md5($currentPassword);

        include('userID.php');
            $userID = $_SESSION['userID'];
             include('connect.php');
 

        $sqlCode = oci_parse($connection, 'SELECT * FROM users WHERE USERS_ID=:userID');
        oci_bind_by_name($sqlCode, ":userID", $userID);  
        oci_execute($sqlCode);
        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $tempPassword=$row['PASSWORD'];
        $email=$row['EMAIL'];

        if($tempPassword != $currentPassword){
            $message = "PLEASE ENTER CORRECT CURRENT PASSWORD !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if (!(preg_match("/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/",$newPassword))){
            $message = "PASSWORD MUST BE AT LEAST 6 CHARACTERS LONG AND MUST CONTAIN AT LEAST ONE CAPTIAL LETTER, ONE NUMBER AND A SYMBOL !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if ($newPassword != $confirmPassword){
            $message = "NEW PASSWORD DO NOT MATCH WITH CONFIRM PASSWORD!!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else{
            $newPassword=md5($newPassword);
            
            $sql="UPDATE USERS SET PASSWORD=:newPassword WHERE USERS_ID=:userID";
            $sqlCode = oci_parse($connection, $sql);
            oci_bind_by_name($sqlCode, ":newPassword", $newPassword);
            oci_bind_by_name($sqlCode, ":userID", $userID);
            $insert=oci_execute($sqlCode);
            
            if ($insert){
                $msg = "Hello!!\nThis email is to notify you about password change in your Suburb Groceries' account. Your password has been successfully updated. Please feel free to make any changes even in the future.\n If you encounter any support from our side please contact us via the email. We are always there for your support. \n If you did not change your password then do contact us to secure your account \nThanks!! and have a good time!! \n\n Regards,\n Suburb Groceries";
                
                    if (mail($email,"Password has been changed - Suburb Groceries",$msg)){
                        echo "HI";
                    }   
                session_destroy();
               header("Location: login.php");
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
        <title> Change Password - Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">CHANGE PASSWORD</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Please enter your current password and new password:
        </p>

        <form method="post" action="changePassword.php" class="sign-up-form"> 
            <table class="form-table" cellpadding="5" cellspacing="5" >
                <tbody>
                    <tr>
                        <td>
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td>
                        <input type="password" name="currentPassword" class="textInput" autocomplete="off" placeholder=" Current Password "  required >
                            <br><br><br>
                            <input type="password" name="newPassword" class="textInput" autocomplete="off" placeholder=" New Password "  required >
                            <br><br><br>
                            <input type="password" name="confirmPassword" class="textInput" autocomplete="off" placeholder="Confirm Password "  required >
                            <br><br><br>
                            <div style="text-align:center">
                                <input type="submit" name="submitButton" value=" Chanage Password" class="newButton" > 
                            </div>
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