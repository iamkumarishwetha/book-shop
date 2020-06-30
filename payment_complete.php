<?php
session_start();
if(!isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] == '')
{
	header("location:index.php");
}
require("classes/manage-database.php"); 
echo '<b>Transaction In Process, Please do not reload</b>';
$order_id=$_SESSION['ORDER_ID'];
$user_id=$_SESSION['USER_ID'];

$payment_mode=$_POST['mode'];
$pay_id=$_POST['mihpayid'];
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$MERCHANT_KEY = "gtKFFx"; 
$SALT = "eCwWELxi";
$udf5='';
$keyString 	= $MERCHANT_KEY .'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
$keyArray 	= explode("|",$keyString);
$reverseKeyArray = array_reverse($keyArray);
$reverseKeyString =	implode("|",$reverseKeyArray);
$saltString     = $SALT.'|'.$status.'|'.$reverseKeyString;
$sentHashString = strtolower(hash('sha512', $saltString));

if($sentHashString != $posted_hash){
?>
	<script type="text/javascript">
        window.location.href="/ebook/payment_fail"
    </script>	
<?php
}else{
	$order_update_sql="update order_tbl set payment_status='$status',txnid='$txnid' where id='$order_id' and user_id='$user_id'";
	$dbobj->execute("$order_update_sql");
?>
 	<script type="text/javascript">
        window.location.href="/ebook/thank-you"
    </script>
<?php
	}
?>