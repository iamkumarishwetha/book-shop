<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require(dirname(dirname(dirname(__FILE__))) . '/config/constants.php');

class Database
{
	private $con;
	public function connect(){
		$this->con = new Mysqli(HOST,USER,PASSWORD,DATABASE_NAME);
		return $this->con;
	}
}
?>