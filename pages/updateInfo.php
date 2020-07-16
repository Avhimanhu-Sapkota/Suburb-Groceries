<?php
error_reporting();
    session_start();
     include('connect.php');
 

    if(isset($_POST['submitButton'])){
        
        include('userID.php');
        $userID = $_SESSION['userID'];
         include('connect.php');
 

        $fullname= trim($_POST['fullname']);
        $email= trim($_POST['email']);
        $username= trim($_POST['username']);
        $dateOfBirth= trim($_POST['dateOfBirth']);
        $contact= trim($_POST['contact']);
        $userType= trim($_POST['userType']);
        echo $password;
        $sqlCode = oci_parse($connection, 'SELECT * FROM users WHERE username=:username');
        oci_bind_by_name($sqlCode, ":username", $username);  
        oci_execute($sqlCode);
        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $count = oci_num_rows($sqlCode);

        if (!(FILTER_VAR($email, FILTER_VALIDATE_EMAIL))){
            $message = "ENTER CORRECT EMAIL FORMAT !!!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else{
            $password=md5($password);
            
            $sqlCode= oci_parse($connection, 'SELECT IMAGE FROM USERS WHERE USERS_ID=:userID');
        oci_bind_by_name($sqlCode, ":userID", $userID);
        oci_execute($sqlCode);

        $row = oci_fetch_array($sqlCode, OCI_BOTH);
        $file_name = $row['IMAGE'];

            $uniqe = uniqid();
            if (!empty($_FILES['productimage']['name'])){
                $file_name= $uniqe.$_FILES['productimage']['name'];
                $file_tmp_loc= $_FILES['productimage']['tmp_name'];
                $file_store="../images/uploads/".$file_name;

                move_uploaded_file($file_tmp_loc, $file_store);
            }
        
           $sql="UPDATE USERS SET FULLNAME=:fullname, EMAIL=:email, USERNAME=:username, 
           DATE_OF_BIRTH=to_date(:dateOfBirth,'yyyy-mm-dd'), CONTACT_NO=:contact, TYPE=:userType, IMAGE=:file_name WHERE USERS_ID=:userID";

            $sqlCode = oci_parse($connection, $sql);

            oci_bind_by_name($sqlCode, ":fullname", $fullname);
            oci_bind_by_name($sqlCode, ":email", $email);
            oci_bind_by_name($sqlCode, ":username", $username);
            oci_bind_by_name($sqlCode, ":dateOfBirth", $dateOfBirth);
            oci_bind_by_name($sqlCode,":contact", $contact);
            oci_bind_by_name($sqlCode, ":userType", $userType);
            oci_bind_by_name($sqlCode, ":file_name", $file_name);
            oci_bind_by_name($sqlCode, ":userID", $userID);
            $insert=oci_execute($sqlCode);
            
            if ($insert){
                
                $msg = "Hello!!\nThis email is to notify you about some changes in your profile information Suburb Groceries. Your information has been successfully updated. Please feel free to make any changes even in the future.\n If you encounter any support from our side please contact us via the email. We are always there for your support. \n Thanks!! and have a good time!! \n\n Regards,\n Suburb Groceries";
                
                    if (mail($email,"Profile Update Notification - Suburb Groceries",$msg)){
                        echo "HI";
                    }   
               header("Location: profile.php");
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
        <title> Update Personal Info - Suburb Groceries </title>

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

        <img src="../images/coverImage1.jpg" width="100%" alt="Cover Image 1">
        
        <div class="gap"></div> 
        <h2 style="text-align:center;color:#e52029;font-size:1.6vw;">PERSONAL INFO</h2>
        <hr style="width:5%;border:0.1vw solid #e52029;">

        <p style="text-align:center;font-size:1vw;">
            <br>Create your personalized profile. <br>Please fill in the information below to  update your info:
        </p>

        <div class="gap"></div>

        <?php
             include('connect.php');
 

            include('userID.php');
            $userID = $_SESSION['userID'];
             include('connect.php');
 

            $sqlCode= oci_parse($connection, 'SELECT * FROM USERS WHERE USERS_ID=:num');
            oci_bind_by_name($sqlCode, ":num", $userID);
            oci_execute($sqlCode);

                while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                    $fullname= $row['FULLNAME'];
                    $email= $row['EMAIL'];
                    $username= $row['USERNAME'];
                    $password=$row['PASSWORD'];
                    $dateOfBirth= $row['DATE_OF_BIRTH'];
                    $contact= $row['CONTACT_NO'];
                    $userType=$row['TYPE'];
                    $file_name=$row['IMAGE'];
                }
        ?>
        
            <table class="form-table" cellpadding="5" cellspacing="5" >
            <form method="post" action="updateInfo.php" class="sign-up-form"  method="POST" enctype="multipart/form-data"> 
                <tbody>
                    <tr>
                        <td rowspan="9">
                            <img src="../images/signUpImage.png"  alt="Sign Up Graphic Image" style="height:auto; width:auto; max-width:100%">
                        </td>
                        <td style="text-align:center">
                            <?php echo '<img alt =" '. $file_name.'"  src="../images/uploads/'.$file_name.'"  style="height:auto; width:auto; max-width:20%;"/>';?>
                        </td>
                    </tr>
                    <tr>
                        <td><input type='file' name='productimage' class="textInput"> </td> 
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="fullname" class="textInput" autocomplete="off" placeholder=" Your Full Name "  value="<?php echo $fullname ?>" required >
                        </td>
                    </tr>

                    <tr>
                        <td> <input type="text" name="email" class="textInput" autocomplete="off" placeholder=" Email "  value="<?php if(isset($email)){echo $email;} ?>" readonly > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="username" class="textInput" autocomplete="off" placeholder=" Username "  value="<?php if(isset($username)){echo $username;} ?>"  readonly> </td>
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
                        <td style="text-align:center">
                            <a href="changePassword.php">
                                <br><input type="button" value="  CHANGE PASSWORD" class="newButton"> 
                            </a><br><br>
                            <input type="submit" name="submitButton" value=" UPDATE INFO" class="newButton"> 
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