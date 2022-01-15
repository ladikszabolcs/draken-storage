<?php

require 'vendor/autoload.php';

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

	function sqlqueryall($sql)
	{
		$eredmenysql = mysqli_query($this->connection,$sql);
		if(is_bool($eredmenysql)){
			return $eredmenysql;
		}
		else{
			return mysqli_fetch_all($eredmenysql, MYSQLI_ASSOC);
		}
	}

	function __destruct()
	{	
		mysqli_close($this->connection);
	}
}

class Items extends Database
{
	function __construct()
	{
		$this->connect("LOCAL");
	}

	function getItems()
	{
		$result = $this->sqlqueryall("SELECT * from items");
		return $result;
	}

	function getUnit($unit)
	{
		$result = $this->sqlquery("SELECT name from units WHERE id=" . $unit);
		return $result["name"];
	}

	function getUnits()
	{
		$result = $this->sqlqueryall("SELECT * from units");
		return $result;
	}

	function getCategorys()
	{
		$result = $this->sqlqueryall("SELECT * FROM categories");
		return $result;
	}

	function __destruct()
	{
		parent::__destruct();
	}
}

?>