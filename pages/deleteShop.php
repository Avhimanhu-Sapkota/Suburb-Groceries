<?php
     include('connect.php');
 

    if(isset($_GET['cid'])){
        $deleteID=$_GET['cid'];
        $sqlCode= oci_parse($connection, 'DELETE FROM SHOP WHERE SHOP_ID=:num');

        oci_bind_by_name($sqlCode, ":num", $deleteID);
        oci_execute($sqlCode);

        if(oci_execute($sqlCode)){
           header('Location: manageShop.php');
        }
       else{
        header('Location: manageShop.php');
       }
}
else{
   header('Location: manageShop.php');
}

    oci_free_statement($sqlCode);
    oci_close($connection); 
?>