<?php
    session_start();

    $cookieName="cart";
    if(empty($_COOKIE["cart"])){
        header('Location: basket.php');
    }
    else{
        $cartID = $_COOKIE["cart"];
        foreach($cartID as $key => $value){
            $cookieName="cart";
            $cart_name=$cookieName."[$key]";
        
            setcookie($cart_name, $key, time()-(60*60*24*30*6), "/");
        
        }
        header('Location: basket.php');
    }