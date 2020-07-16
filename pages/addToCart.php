<?php

    ob_start();
    session_start();

    $productID= $_GET['pid'];
    if (empty($_SESSION['username'])){
        
        $cookieName = "cart";
        $cart_name = $cookieName."[$productID]";
        setcookie($cart_name, $productID, time()+(60*60*24*30*6), "/");
        header('Location: basket.php');
    }
    else{
        include('userID.php');
        $userID = $_SESSION['userID'];

        $sqlCode1 = oci_parse($connection, 'SELECT * FROM BASKET where FK1_USERS_ID=:userID');
        oci_bind_by_name($sqlCode1, ":userID", $userID);  
        oci_execute($sqlCode1);

        $row = oci_fetch_array($sqlCode1);
        $basketID = $row['BASKET_ID'];
        $nullVal = '';
        $sql="INSERT INTO BASKET_PRODUCTS (BASKET_PRODUCT_ID, QUANTITY, TOTALPRICE, FK1_BASKET_ID, FK2_PRODUCT_ID, PAYMENT)
                VALUES (PK_BASKET_PRODUCT_ID.nextval, 0, :nullVal, :basketID,:productID, 0 )";
        
        $sqlCode = oci_parse($connection, $sql);
        oci_bind_by_name($sqlCode, ":nullVal", $nullVal);
        oci_bind_by_name($sqlCode, ":basketID", $basketID);
        oci_bind_by_name($sqlCode, ":productID", $productID);

        oci_execute($sqlCode);
        header('Location: basket.php');
    }
?>