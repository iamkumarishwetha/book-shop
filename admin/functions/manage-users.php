<?php
session_start();
require("../classes/manage-database.php");
if(isset($_POST['GET_COUNT_USER'])){
	$query="SELECT * FROM users";

	$countRow=$dbobj -> numRows($query);

	echo $countRow;
}
if(isset($_POST['GET_USERSDATA']))
{
	$query="SELECT * FROM users order by id desc";
	$result=$dbobj->getData($query);
	if($dbobj -> numRows($query) > 0)
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
if(isset($_POST['DELETE_USER']))
{
	$id=$dbobj->escapeString($_POST['id']);
	if(isset($id)  && $id != '') {
		$delete_sql="DELETE FROM users WHERE id='$id'";
		$result=$dbobj->execute($delete_sql);
		if($result)
		{
			$response=['status'=> 202, 'message'=> 'User Deleted successfully!'];
		}
		else
		{
			$response=['status'=> 303, 'message'=> 'Failed to run query!'];
		}
		
	}else{
		$response = ['status'=> 303, 'message'=> 'Invalid ID'];
	}
	echo json_encode($response);	
}
?>