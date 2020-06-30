<?php
session_start();
require("../classes/manage-database.php");
if(isset($_POST['login_admin']))
{
	$username=$dbobj->escapeString($_POST['username']);
	$user_password=$dbobj->escapeString($_POST['password']);
	// echo $hashpassword=password_hash('$user_password',PASSWORD_BCRYPT);
	$query="SELECT * FROM admin_users WHERE username='$username'";
	$countRow=$dbobj->numRows($query);
	if($countRow > 0)
	{
			$result=$dbobj -> getData($query,true);
			if(password_verify($user_password,$result['password']))
			{
				$_SESSION['ADMIN_LOGIN']='yes';
         		$_SESSION['ADMIN_USERNAME']='$username';
				$response=['status'=> 202, 'message'=> 'Login Successful!'];

			}	
			else
			{
				$response=['status'=> 303, 'message'=> 'Incorrect password'];
			}	
	}
	else
	{
		$response=['status'=> 303, 'message'=> 'Incorrect username'];
		
	}

	echo json_encode($response);
}

?>