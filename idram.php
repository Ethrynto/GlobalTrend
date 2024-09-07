<?php

if(isset($_POST['EDP_TRANS_ID'])){
if($_POST['EDP_TRANS_ID']>0){
require 'config.php';
$oid=$_POST['EDP_BILL_NO'];
$mysqli->query("update `orders` set `payment_type`='6',`is_paid`='1' where `order_number`='$oid'");
}
}
echo "OK";
?>
