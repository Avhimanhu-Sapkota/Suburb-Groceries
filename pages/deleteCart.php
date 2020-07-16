<?php
    ob_start();
    session_start();

    if (empty($_SESSION['username'])){
        $productID= $_GET['pid'];
        $cookieName="cart";
        $cart_name = $cookieName."[$productID]";
        setcookie($cart_name, $productID, time()-(60*60*24*30*6), "/");
        header('Location: basket.php');
    }
    else{

         include('connect.php');
 

        if(isset($_GET['pid'])){
            $deleteID= $_GET['pid'];
            $sqlCode= oci_parse($connection, 'DELETE FROM BASKET_PRODUCTS WHERE BASKET_PRODUCT_ID=:num');

            oci_bind_by_name($sqlCode, ":num", $deleteID);
            oci_execute($sqlCode);
            header('Location: basket.php');
        }
    }
?>