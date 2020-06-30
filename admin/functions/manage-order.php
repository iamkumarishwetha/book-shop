<?php
session_start();
require("../classes/manage-database.php");

if(isset($_POST['GET_COUNT_ORDER'])){
	$query="SELECT * FROM order_tbl";

	$countRow=$dbobj -> numRows($query);

	echo $countRow;
}
if(isset($_POST['GET_ORDER']))
{
	$query="SELECT * FROM order_tbl";	
	$countRow = $dbobj -> numRows($query);
	if($countRow > 0)
	{
		$result=$dbobj -> getData($query);
		$response=['status'=> 202, 'message'=> $result];
	}
	else
	{
		$response=['status'=> 303, 'message'=> 'No data found!'];
	}
	echo json_encode($response);
}

if(isset($_POST['GET_ORDERDETAIL']))
{
	if(isset($_POST['id']) && $_POST['id'] != ''){
	$id=$dbobj->escapeString($_POST['id']);
	}
	$query="SELECT b.image,b.name,d.qty,d.price,s.id as statusid,d.id FROM  order_detail d INNER JOIN books b ON d.book_id=b.id INNER JOIN order_status s ON d.order_status=s.id WHERE d.order_id ='$id'";

	$countRow=$dbobj -> numRows($query);

	if($countRow > 0)
	{
		$result=$dbobj -> getData($query);
		$response['orderdetail']=['status'=> 202, 'message'=> $result];
	}
	else
	{
		$response['orderdetail']=['status'=> 303, 'message'=> 'No data found!'];
	}
	
	$query1="SELECT id,name FROM order_status ORDER BY id ASC";
	$countRow1=$dbobj -> numRows($query1);

	if($countRow1 > 0)
	{
		$result1=$dbobj->getData($query1);
		$response['orderstatus']=['status'=> 202, 'message'=> $result1];
	}
	else
	{
		$response['orderstatus']=['status'=> 303, 'message'=> 'No data found!'];
	}

	echo json_encode($response);
}

if(isset($_POST['UPDATE_ORDERSTATUS']))
{
	$id=$dbobj->escapeString($_POST['id']);
	$statusid=$dbobj->escapeString($_POST['statusid']);

	$sql="UPDATE order_detail SET order_status='$statusid' WHERE id='$id'";

	$result=$dbobj->execute($sql);
	if($result)
	{
		$response=['status'=> 202, 'message'=> 'Status Updated Successfully!'];
	}
	else
	{
		$response=['status'=> 303, 'message'=> 'Failed to run query!'];
	}
	echo json_encode($response);	
}
?>