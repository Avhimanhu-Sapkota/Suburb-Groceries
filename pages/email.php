<?php

 // Always set content-type when sending HTML email
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

 // More headers
 $headers .= 'From: <webmaster@example.com>' . "\r\n";
 $headers .= 'Cc: myboss@example.com' . "\r\n";

    // the message
    $msg = "First line of text\nSecond line of text <a href='http://localhost/suburbGroceries/pages/index.php'>Go Here</a>";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);
    
    // send email
    if (mail("avi.saps999@gmail.com","My subject",$msg, $headers)){
        echo"mail sent";
    }
    else{
        echo"error";
    }
?>