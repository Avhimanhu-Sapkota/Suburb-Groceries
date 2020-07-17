
<?php
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        
        $fullname= trim($_POST['fullname']);
        $email= trim($_POST['email']);
        $username= trim($_POST['username']);
        $password= trim($_POST['password']);
        $confirmPassword= trim($_POST['password2']);
        $dateOfBirth= trim($_POST['dateOfBirth']);
        $contact= trim($_POST['contact']);
        $userType= trim($_POST['userType']);
        $terms=$_POST['terms'];

        $sqlCode = oci_parse($connection, 'SELECT * FROM users WHERE username=:username');
        oci_bind_by_name($sqlCode, ":username", $username);  
        oci_execute($sqlCode);
        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $count = oci_num_rows($sqlCode);

        if (!(FILTER_VAR($email, FILTER_VALIDATE_EMAIL))){
            $message = "ENTER CORRECT EMAIL FORMAT !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if(preg_match('/[^a-z_\-0-9]/i', $username)){
            $message = "USERNAME SHOULD ONLY HAVE ALPHA-NUMERIC CHARACTERS !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if($count > 0){
            $message = "USERNAME ALREADY EXIST. PLEASE ENTER SOME OTHER USERNAME !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } 
    
        else if (!(preg_match("/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/",$password))){
            $message = "PASSWORD MUST BE AT LEAST 6 CHARACTERS LONG AND MUST CONTAIN AT LEAST ONE CAPTIAL LETTER, ONE NUMBER AND A SYMBOL !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if ($password != $confirmPassword){
            $message = "PASSWORD DO NOT MATCH WITH CONFIRM PASSWORD!!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else if (empty($terms)){
            $message = "PLEASE ACCEPT TERMS AND CONDITIONS !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else{
            $password=md5($password);
            
            $uniqe = uniqid();
        if (!empty($_FILES['productimage']['name'])){
			$file_name= $uniqe.$_FILES['productimage']['name'];
        	$file_tmp_loc= $_FILES['productimage']['tmp_name'];
        	$file_store="../images/uploads/".$file_name;

			move_uploaded_file($file_tmp_loc, $file_store);
        }

        $vkey = md5(time() .$username);
        $verified = 0;
           $sql="INSERT INTO users (USERS_ID,FULLNAME, EMAIL, USERNAME, PASSWORD, DATE_OF_BIRTH, CONTACT_NO, TYPE, IMAGE, VKEY, VERIFIED) 
                        VALUES (pk_users_id.nextval, :fullname, :email, :username, :password, to_date(:dateOfBirth,'yyyy-mm-dd'), :contact, :userType, :file_name, :vkey, :verified )";

            $sqlCode = oci_parse($connection, $sql);

            oci_bind_by_name($sqlCode, ":fullname", $fullname);
            oci_bind_by_name($sqlCode, ":email", $email);
            oci_bind_by_name($sqlCode, ":username", $username);
            oci_bind_by_name($sqlCode, ":password", $password);
            oci_bind_by_name($sqlCode, ":dateOfBirth", $dateOfBirth);
            oci_bind_by_name($sqlCode,":contact", $contact);
            oci_bind_by_name($sqlCode, ":userType", $userType);
            oci_bind_by_name($sqlCode, ":file_name", $file_name);
            oci_bind_by_name($sqlCode, ":vkey", $vkey);
            oci_bind_by_name($sqlCode, ":verified", $verified);

            $insert=oci_execute($sqlCode);
            
            if ($insert){
                 include('connect.php');
 

                $sqlCode = oci_parse($connection, ' SELECT USERS_ID FROM USERS where USERNAME = :username ');
                oci_bind_by_name($sqlCode, ":username", $username);  
                oci_execute($sqlCode);
                $row = oci_fetch_array($sqlCode);
                $userID = $row['USERS_ID'];
                echo $userID;

                $sql="INSERT INTO BASKET (BASKET_ID, FK1_USERS_ID) VALUES (pk_basket_id.nextval, :userID)";
                $sqlCode1 = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode1, ":userID", $userID);
                oci_execute($sqlCode1);

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <webmaster@example.com>' . "\r\n";
                $headers .= 'Cc: myboss@example.com' . "\r\n";

                $msg = "Hello!!\nWelcome to Suburb Groceries!! \nThis email is to notify you about your Suburb Groceries account. Your account has been successfully created. Please click on the Verify account below to verify your email\n
                <a href='http://localhost/suburbGroceries/pages/verify.php?vkey=$vkey'> Verify Email </a>\n\n Thanks!! and have a good time!! \n\n Regards,\n Suburb Groceries" ;
                
                mail($email,"Verify your email - Suburb Groceries",$msg, $headers);

                header("Location: thankyou.php");
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
        <title> Sign Up - Suburb Groceries </title>

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
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">REGISTER</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Create your personalized profile. <br>Please fill in the information below to  join our community:
        </p>

        <div class="gap"></div>

            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="signUp.php" class="sign-up-form"  method="POST" enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="11">
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td>
                            <input type="text" name="fullname" class="textInput" autocomplete="off" placeholder=" Your Full Name "  value="<?php if(isset($fullname)){echo $fullname;} ?>" required >
                        </td>
                    </tr>

                    <tr>
                    <td><input type='file' name='productimage' class="textInput"> </td> 
                </tr>

                    <tr>
                        <td> <input type="text" name="email" class="textInput" autocomplete="off" placeholder=" Email "  value="<?php if(isset($email)){echo $email;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="username" class="textInput" autocomplete="off" placeholder=" Username "  value="<?php if(isset($username)){echo $username;} ?>"  required > </td>
                    </tr>
                    <tr>
                        <td> <input type="password" name="password" class="textInput" autocomplete="off" placeholder=" New Password " required > </td>
                    </tr>
                    <tr>
                        <td> <input type="password" name="password2" class="textInput" autocomplete="off" placeholder=" Confirm Password " required > </td>
                    </tr>
                    <tr>
                        <td> <input type="date" name="dateOfBirth" class="textInput" autocomplete="off" placeholder="Date of Birth (MM/DD/YYYY)"  style="text-transform:uppercase " value="<?php if(isset($dateOfBirth)){echo $dateOfBirth;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="contact" class="textInput" autocomplete="off" placeholder=" Contact No "  value="<?php if(isset($contact)){echo $contact;} ?>" required > </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="userType" class="textInput"  value="<?php if(isset($userType)){echo $userType;} ?>"required>
                            <option value="" disabled selected> Select user type</option>
                                <option value="trader" >Trader</option>
                                <option value="customer" >Customer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center" required>
                            <br>
                            <input type="checkbox" name="terms"> I accept all the terms and contiditions. 
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <br>
                            <input type="submit" name="submitButton" value=" CREATE MY ACCOUNT" class="newButton"> 
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2" style="text-align:center">Already have an account? <a href="login.php" class="link" >Login</a> </td>
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