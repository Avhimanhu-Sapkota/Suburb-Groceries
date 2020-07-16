<?php
    error_reporting(0);
    echo"<div class='container' >
                <div class='row'>";
                    while (($row = oci_fetch_array($sqlCode, OCI_BOTH)) != false) {
                        $description =  $row['DESCRIPTION'];
                        $shortDesc = substr($description,0,80);
                        $count++;
                        $offerID = $row['FK1_OFFER_ID'];

                        echo "<div class='gap'></div>
                        <div class='col-xl-4 col-sm-6'> 
                        <div class='card h-100'>";
                            echo"<a href=productView.php?pid=".$row['PRODUCT_ID']."><img class='card-img-top image-fluid' src='../images/uploads/".$row['IMAGE']." ' alt='Product Image' height='100%' width='100%'></a>";
                            echo" <div class='card-body'> <h4 class='card-title' style='text-align: center;'> <a class='productTitle' href=productview.php?pid=".$row['PRODUCT_ID']." >".$row['NAME']."</a></h4>";

                                if(empty($row['FK1_OFFER_ID'])){
                                    echo"<h6 style='color:#e52029;text-align: center;'> £ ".$row['PRICE'].".00 </h6>";
                                }
                                else{
                                    $date = strtotime(date("Y-m-d"));
                                     include('connect.php');
 
                                    $sqlCode1 = oci_parse($connection, 'SELECT * FROM OFFERS WHERE OFFER_ID=:offerID');
                                    oci_bind_by_name($sqlCode1, ":offerID", $offerID);  
                                    oci_execute($sqlCode1);

                                    while (($row2 = oci_fetch_array($sqlCode1, OCI_BOTH)) != false) {
                                        if(strtotime($row2['START_DATE'])<= $date && strtotime($row2['END_DATE'])>= $date){
                                            echo"<h6 style='color:#e52029; text-align: center;'> <strike> £ ".$row['PRICE'].".00  </strike> &nbsp;";
                                            $discount = ($row2['DISCOUNT_PERCENT'])/100;
                                            $orgPrice = $row['PRICE'];
                                            $offerPrice = $orgPrice - ($discount *$orgPrice);
                                                echo "  £ ".$offerPrice."</h6>";
                                        }
                                        else{
                                            echo"<h6 style='color:#e52029;text-align: center;'> £ ".$row['PRICE'].".00 </h6>";
                                        }
                                    }
                                }

                                echo"  <h6 style='text-align: center;'> Stock available:  ".$row['AVAILABLE_STOCK']."</h6>
                                                    <p class='card-text' style='text-align: center;'>"
                                                        .$shortDesc." .....</p></div>";
                                    echo"<a href='addToCart.php?pid=".$row['PRODUCT_ID']."' class='productTitle'><button type='button' name='cartButton' class='moreButton' style='margin:auto;display:block;'> Add to Basket  </button></a>";
                                    echo"<div class='gap' style='height:35px'></div>
                                </div></div>";
                                                        
                    }
                echo"</div>
            <div></div></div>";
            ?>