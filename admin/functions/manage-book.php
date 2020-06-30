<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../classes/manage-database.php");
if(isset($_POST['GET_COUNT_BOOK'])){
	$query="SELECT * FROM books";

	$countRow=$dbobj -> numRows($query);

	echo $countRow;
}
if(isset($_POST['GET_BOOKS']))
{
	$where='';
	if(isset($_POST['id']) && $_POST['id'] != ''){
	$id=$dbobj->escapeString($_POST['id']);
	}
	if(isset($id) && $id != '') {

		$where="WHERE books.id='$id'";
	}
	$query="SELECT books.*,categories.category FROM books JOIN categories ON books.category_id=categories.id " . $where . " ORDER BY books.id DESC";

	$countRow=$dbobj -> numRows($query);

	if($countRow > 0)
	{
		if(isset($id) && $id != '') {
			$result=$dbobj -> getData($query,true);
			
		}
		else {
			$result=$dbobj -> getData($query);
		}
		$response['book']=['status'=> 202, 'message'=> $result];
	}
	else
	{
		$response['book']=['status'=> 303, 'message'=> 'No data found!'];
	}
	
	$query1="SELECT id,category FROM categories ORDER BY category ASC";
	$countRow1=$dbobj -> numRows($query1);

	if($countRow1 > 0)
	{
		$result1=$dbobj->getData($query1);
		$response['category']=['status'=> 202, 'message'=> $result1];
	}
	else
	{
		$response['category']=['status'=> 303, 'message'=> 'No data found!'];
	}

	echo json_encode($response);
}
if (isset($_REQUEST['submit_data']))
{
	$category_id=$dbobj->escapeString($_POST['category_id']);
	$name=$dbobj->escapeString($_POST['name']);
	$price=$dbobj->escapeString($_POST['price']);
	$qty=$dbobj->escapeString($_POST['qty']);
	$short_desc=$dbobj->escapeString($_POST['short_desc']);
	$desc=$dbobj->escapeString($_POST['desc']);
	$meta_keyword=$dbobj->escapeString($_POST['meta_keyword']);
	$id=$dbobj->escapeString($_POST['id']);
	
	$query="SELECT * FROM books WHERE name='$name'";

	$count=$dbobj->numRows($query);
	$flag=true;
	if($count >0)
	{
		if(isset($id)  && $id != '')
      {
        $getData=$dbobj ->getData($query,true);
        if($id != $getData['id'])
        {
            $response[]=['status'=> 303, 'message'=> 'Book already exists!'];
			$flag=false;
        }
      }
      else
      {
      		$response[]=['status'=> 303, 'message'=> 'Book already exists!'];
			$flag=false;
      }
		
	}
	if($_FILES['image']['name'] != '')
	{
		if($_FILES['image']['type'] != 'image/png' && $_FILES['image']['type'] != 'image/jpg' && $_FILES['image']['type'] != 'image/jpeg')
		{
			$response[]=['status'=> 303, 'message'=> 'Please select only png,jpg and jpeg image format'];
			$flag=false;
		}
	}
	
	if($flag)
	{
		if(isset($_POST['id'])  && $_POST['id'] != '')
		{
			if($_FILES['image']['name'] != '')
			{
				$image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
       			move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);
				$sql="UPDATE books SET category_id='$category_id',name='$name',price='$price',qty='$qty',image='$image',short_desc='$short_desc',description='$desc',meta_keyword='$meta_keyword' WHERE id='$id'";
			}
			else
			{
				$sql="UPDATE books SET category_id='$category_id',name='$name',price='$price',qty='$qty',short_desc='$short_desc',description='$desc',meta_keyword='$meta_keyword' WHERE id='$id'";
			}			
		}
		else
		{
			$image=rand(1111111111,9999999999).'_'.$_FILES['image']['name'];
        	move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH.$image);
			$sql="INSERT INTO books(category_id,name,price,qty,image,short_desc,description,meta_keyword,status) VALUES ('$category_id','$name','$price','$qty','$image','$short_desc','$desc','$meta_keyword',1)";
		}
		 
        $res=$dbobj->execute($sql);
        if($res)
        {
        	if(isset($_POST['id'])  && $_POST['id'] != '')
        	{
        		$response[]=['status'=> 202, 'message'=> 'Book Updated successfully!'];
        	}
        	else
        	{
        		$response[]=['status'=> 202, 'message'=> 'Book Added successfully!'];
        	}
        	
        }
        else
        {
        	$response[]=['status'=> 303, 'message'=> 'Some problem occured,try again!'];
        }

	}
	echo json_encode($response);
}
if(isset($_POST['DELETE_BOOK']))
{
	$id=$dbobj->escapeString($_POST['id']);
	if(isset($id) && $id != '') {

		$sql = "SELECT image from books WHERE id='$id'";
		$data = $dbobj->getData($sql,true);
		unlink(PRODUCT_IMAGE_SERVER_PATH . $data['image']);

		$delete_sql="DELETE FROM books WHERE id='$id'";
		$result=$dbobj->execute($delete_sql);

		if($result)
		{	
			$response=['status'=> 202, 'message'=> 'Book Deleted successfully!'];
		}
		else
		{
			$response=['status'=> 303, 'message'=> 'Failed to run query!'];
		}
		
	}else{
		$response = ['status'=> 303, 'message'=> 'Invalid book ID'];
	}
	echo json_encode($response);	
}

if(isset($_POST['UPDATE_STATUS']))
{
	$id=$dbobj->escapeString($_POST['id']);
	$status=$dbobj->escapeString($_POST['status']);
	if(isset($id) && $id != '') {
		$delete_sql="UPDATE books SET status='$status' WHERE id='$id'";
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