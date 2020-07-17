<?php
    $username=$_SESSION['username'];
     include('connect.php');
 
    $sqlCode = oci_parse($connection, ' SELECT USERS_ID FROM USERS where USERNAME = :username ');
    oci_bind_by_name($sqlCode, ":username", $username);  
    oci_execute($sqlCode);
    $row = oci_fetch_array($sqlCode);
    $_SESSION['userID']=$row['USERS_ID'];
?>