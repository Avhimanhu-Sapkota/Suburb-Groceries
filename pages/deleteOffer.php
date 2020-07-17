<?php
     include('connect.php');
 

    if(isset($_GET['cid'])){
        $deleteID=$_GET['cid'];
        $sqlCode= oci_parse($connection, 'DELETE FROM OFFERS WHERE OFFER_ID=:num');

        oci_bind_by_name($sqlCode, ":num", $deleteID);
        oci_execute($sqlCode);

        if(oci_execute($sqlCode)){
           header('Location: manageOffer.php');
        }
       else{
        header('Location: manageOffer.php');
       }
}
else{
   header('Location: manageOffer.php');
}

    oci_free_statement($sqlCode);
    oci_close($connection); 
?>