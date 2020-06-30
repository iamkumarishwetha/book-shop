<?php
session_start();
require("../classes/manage-database.php");
if(isset($_POST['GET_COUNT_CATEGORY'])){
	$query="SELECT * FROM categories";

	$countRow=$dbobj -> numRows($query);

	echo $countRow;
}
	
if(isset($_POST['GET_CATEGORIES']))
{
	$where = '';
	if(isset($_POST['id']) && $_POST['id'] != ''){
		$id=$dbobj->escapeString($_POST['id']);
	}
	
	if(isset($id) && $id != '') {

		$where="WHERE id='$id'";
	}

	$query="SELECT * FROM categories ". $where ." order by category asc";

	$countRow=$dbobj -> numRows($query);

	if($countRow > 0)
	{
		if(isset($id) && $id != '') {
			$result=$dbobj -> getData($query,true);
			
		}
		else {
			$result=$dbobj -> getData($query);
		}
		$response=['status'=> 202, 'message'=> $result];
	}
	else
	{
		$response=['status'=> 303, 'message'=> 'No data found!'];
	}
	echo json_encode($response);
}
if(isset($_POST['submit_data']))
{
	$category=$dbobj->escapeString($_POST['category']);
	$id=$dbobj->escapeString($_POST['id']);
			
	$select_query="SELECT * FROM categories WHERE category='$category'";

	$countRow=$dbobj -> numRows($select_query);

	if($countRow > 0)	
	{
		if(isset($id)  && $id != '')
      {
        $getData=$dbobj ->getData($select_query,true);
        if($id != $getData['id'])
        {
             $msg='Category already exist!';//error display while inserting same category name
        }
      }
      else
      {
         $msg='Category already exist!';//error display while inserting same category name
      }
		
	}
	if($msg == "")
	{
		if(isset($id)  && $id != '')
		{
			$qry="UPDATE categories SET category='$category' WHERE id='$id'";
		}  
		else{
			$qry="INSERT INTO categories(category,status) VALUES ('$category',1)";
		}
		
		$result=$dbobj->execute($qry);
		if($result)
		{
			if(isset($id)  && $id != '')
			{
				$response=['status'=> 202, 'message'=> 'Category Updated Successfully'];
			}
			else
			{
				$response=['status'=> 202, 'message'=> 'Category Inserted Successfully'];
			}
		}
		else
		{
			$response=['status'=> 303, 'message'=> 'Some problem occured try again!'];
		}

	}
	else
	{
		$response=['status'=> 303, 'message'=> $msg];
	}
	echo json_encode($response);
}
if(isset($_POST['DELETE_CATEGORY']))
{
	$id=$dbobj->escapeString($_POST['id']);
	if(isset($id) && $id != '') {
		$delete_sql="DELETE FROM categories WHERE id='$id'";
		$result=$dbobj->execute($delete_sql);
		if($result)
		{
			$response=['status'=> 202, 'message'=> 'Category Deleted Successfully!'];
		}
		else
		{
			$response=['status'=> 303, 'message'=> 'Failed to run query!'];
		}
		
	}else{
		$response = ['status'=> 303, 'message'=> 'Invalid Category ID'];
	}
	echo json_encode($response);	
}

if(isset($_POST['UPDATE_STATUS']))
{
	$id=$dbobj->escapeString($_POST['id']);
	$status=$dbobj->escapeString($_POST['status']);
	if(isset($id) && $id != '') {
		$delete_sql="UPDATE categories SET status='$status' WHERE id='$id'";
		$result=$dbobj->execute($delete_sql);
		if($result)
		{
			$response=['status'=> 202, 'message'=> 'Status Updated Successfully!'];
		}
		else
		{
			$response=['status'=> 303, 'message'=> 'Failed to run query!'];
		}
		
	}else{
		$response = ['status'=> 303, 'message'=> 'Invalid Category ID'];
	}
	echo json_encode($response);	
}
?>