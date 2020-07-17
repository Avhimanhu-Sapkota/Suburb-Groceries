<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <!--Head of the webpage-->
    <head>

        <!--Icon Image that displays in the head of the webpage-->
        <link rel="shortcut icon" href="../images/icon.ico"/>

        <!--Title of the page-->
        <title> Profile - Suburb Groceries </title>

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
                        <td>
                            <input type="text" name="fullname" class="textInput" autocomplete="off" placeholder=" Your Full Name "  value="<?php echo $fullname ?>" readonly >
                        </td>
                    </tr>

                    <tr>
                        <td> <input type="text" name="email" class="textInput" autocomplete="off" placeholder=" Email "  value="<?php if(isset($email)){echo $email;} ?>" readonly > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="username" class="textInput" autocomplete="off" placeholder=" Username "  value="Username: <?php if(isset($username)){echo $username;} ?>"  readonly > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="dateOfBirth" class="textInput" autocomplete="off" placeholder="Date of Birth (MM/DD/YYYY)"  style="text-transform:uppercase " value="Date of Birth: <?php if(isset($dateOfBirth)){echo $dateOfBirth;} ?>" readonly > </td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="contact" class="textInput" autocomplete="off" placeholder=" Contact No "  value="Ph. No: <?php if(isset($contact)){echo $contact;} ?>" readonly > </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="type" class="textInput" autocomplete="off" placeholder=" TYPE "  value="User Type: <?php if(isset($userType)){echo $userType;} ?>" readonly > </td>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            <a href="updateInfo.php">
                                <br><input type="button" value=" UPDATE INFO" class="newButton"> 
                            </a>
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