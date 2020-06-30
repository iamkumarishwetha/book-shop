<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("connection.php");
class Managedatabase
{
	private $con;
	function __construct(){
		$db = new Database();
		$this->con = $db->connect();
	}
	public function execute($sql)
    {
        //mysqli_query($sql,$con)
        $result=$this->con->query($sql);
        
        if($result == false)
        {
            return false;
        }
        return true;
    }

	public function getData($sql,$flag=false)
    {
        
        $result=$this->con->query($sql);
        $rows=array();
        if(!empty($flag))
        {
            while($row=$result->fetch_array())
            {
                $rows=$row;
            }
        }
        else
        {
            while($row=$result->fetch_array())
            {
                $rows[]=$row;
            }

        }  
        return $rows;
    }

	public function escapeString($var)
	{
		$var=trim($var);
		return $this->con->real_escape_string($var);
	}
    public function numRows($sql)
    {
        $result=$this->con->query($sql);
        $row_cnt=$result->num_rows;
        return $row_cnt;
    }
}
$dbobj=new Managedatabase();
?>