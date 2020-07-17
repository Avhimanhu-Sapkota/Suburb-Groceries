<?php 
    
    /* 
    * PayPal and database configuration 
    */
    // PayPal configuration 
    define('PAYPAL_ID', 'avi.saps999@gmail.com'); 
    define('PAYPAL_SANDBOX', TRUE); 
    define('PAYPAL_RETURN_URL', 'http://localhost/suburbGroceries/pages/paypalSuccess.php'); 
    define('PAYPAL_CANCEL_URL', 'http://localhost/suburbGroceries/pages/basket.php'); 
    define('PAYPAL_NOTIFY_URL', 'http://localhost/suburbGroceries/pages/ipn.php');
    define('PAYPAL_CURRENCY', 'GBP'); 

     include('connect.php');
 

    define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>