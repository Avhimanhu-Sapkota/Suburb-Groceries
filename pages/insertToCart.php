<?php
    session_start();

    include('userID.php');
    $userID = $_SESSION['userID'];

    $sqlCode1 = oci_parse($connection, 'SELECT * FROM BASKET where FK1_USERS_ID=:userID');
    oci_bind_by_name($sqlCode1, ":userID", $userID);  
    oci_execute($sqlCode1);

    $row = oci_fetch_array($sqlCode1);
    $basketID = $row['BASKET_ID'];
    $nullVal = '';
    
    $cartID = $_COOKIE["cart"];
    foreach($cartID as $value){
         include('connect.php');
 
        $sqlCode = oci_parse($connection, 'SELECT * FROM PRODUCTS WHERE PRODUCT_ID=:proValue');
        oci_bind_by_name($sqlCode, ":proValue", $value);  
        oci_execute($sqlCode);

        while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
            $productID = $row['PRODUCT_ID'];
            $insert1 = 0;
            $sqlCode1 = oci_parse($connection, 'SELECT * FROM BASKET_PRODUCTS WHERE FK2_PRODUCT_ID=:productID AND FK1_BASKET_ID=:basketID AND PAYMENT=0');
            oci_bind_by_name($sqlCode1, ":productID", $productID);  
            oci_bind_by_name($sqlCode1, ":basketID", $basketID);  
            oci_execute($sqlCode1);

            while (($row1 = oci_fetch_array($sqlCode1, OCI_BOTH)) != false) {
                $newBasketID = $row1['FK1_BASKET_ID'];
                $newProductID = $row1['FK2_PRODUCT_ID'];
                if($newBasketID == $basketID && $newProductID == $productID){
                    $insert1 = 1;
                }
                
            }

            if($insert1 == 1){
                echo "<br>DO NOT INSERT";
            }
            else{
                $sql="INSERT INTO BASKET_PRODUCTS (BASKET_PRODUCT_ID, QUANTITY, TOTALPRICE, FK1_BASKET_ID, FK2_PRODUCT_ID, PAYMENT)
                VALUES (PK_BASKET_PRODUCT_ID.nextval, 0, :nullVal, :basketID,:productID, 0)";
        
                $sqlCode3 = oci_parse($connection, $sql);
                oci_bind_by_name($sqlCode3, ":nullVal", $nullVal);
                oci_bind_by_name($sqlCode3, ":basketID", $basketID);
                oci_bind_by_name($sqlCode3, ":productID", $productID);

                $insert = oci_execute($sqlCode3);

                if ($insert){
                    $cookieName="cart";
                    $cart_name = $cookieName."[$productID]";
                    setcookie($cart_name, $productID, time()-(60*60*24*30*6), "/");
                }
            }
            /**/

        }
    }
    
?>
