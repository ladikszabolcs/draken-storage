<?php

class Database
{
	public $connection;
	public $server = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "raktarprojekt";

	function __construct()
	{
		$this->connection=mysqli_connect($this->server,$this->username,$this->password,$this->database);
	}

	function kiskutya($sql)
	{
		$eredmenysql = mysqli_query($this->connection,$sql);
		$kimenet = mysqli_fetch_assoc($eredmenysql);
		return $kimenet;
	}

	function __destruct()
	{	
		mysqli_close($this->connection);
	}
}

?>