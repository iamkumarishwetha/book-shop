<?php
session_start();
require("../classes/manage-database.php");
if(isset($_POST['GET_CONTACTDATA']))
{
	$query="SELECT * FROM contactus order by id asc";
	$countRow=$dbobj -> numRows($query);

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
if(isset($_POST['DELETE_CONTACTUS']))
{
	$id=$dbobj->escapeString($_POST['id']);
	if(isset($id)  && $id != '') {
		$delete_sql="DELETE FROM contactus WHERE id='$id'";
		$result=$dbobj->execute($delete_sql);
		if($result)
		{
			$response=['status'=> 202, 'message'=> 'Data Deleted successfully!'];
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