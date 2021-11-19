<?php

session_set_cookie_params(3600);
session_start();

class Database
{
	public $connection;
	public $server = "localhost";
	public $username;
	public $password;
	public $database = "raktarprojekt";

	function __construct()
	{

	}

	function connect($status)
	{
		switch ($status) {
			case 'LOCAL':
				$this->username = "root";
				$this->password = "";
				break;

			case 'SERVER':
				$this->username = "raktarprojekt";
				$this->password = "RakTar987+";
				break;
			
			default:
				
				break;
		}

		$this->connection=mysqli_connect($this->server,$this->username,$this->password,$this->database);
	}

	function sqlquery($sql)
	{
		$eredmenysql = mysqli_query($this->connection,$sql);
		if(is_bool($eredmenysql)){
			return $eredmenysql;
		}
		else{
			return mysqli_fetch_assoc($eredmenysql);
		}
	}

	function __destruct()
	{	
		mysqli_close($this->connection);
	}
}

?>