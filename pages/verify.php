<?php

    if(isset($_GET['vkey'])){
        $vkey = $_GET['vkey'];
         include('connect.php');
 

        $sqlCode = oci_parse($connection, 'SELECT VERIFIED, VKEY FROM USERS WHERE VKEY=:vkey');
        oci_bind_by_name($sqlCode, ":vkey", $vkey); 
        $found = oci_execute($sqlCode);

        if($found){
            while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                $sql="UPDATE USERS SET VERIFIED=1 WHERE VKEY=:vkey";
                $sqlCode1 = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode1, ":vkey", $vkey);
                $done = oci_execute($sqlCode1);
    
                if ($done){
                    header("Location: login.php");
                }
                else{
                    header("Location: login.php");
                }
            }
        }
        else{
            echo "Already verified or no such account found";
        }
        
    }
    else{
        die("Something Went Wrong !!");
    }
?>