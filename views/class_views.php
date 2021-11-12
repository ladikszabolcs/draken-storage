<?php

class Views 
{

	function __construct()
	{
		echo('
			<!DOCTYPE html>
			<html lang="en">
			<head>
  			<title>Draken-Storage</title>
  			<meta charset="utf-8">
  			<meta name="viewport" content="width=device-width, initial-scale=1">
  			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
			</head>
			<body>
			');
	}

	function menuView() 
	{
		echo('
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  			<div class="container-fluid">
    		<a class="navbar-brand" href="index.php">Storage</a>
    		<ul class"nav navbar-nav">
  				<li class="nav-item">
  				<form action="logout.php" method="post">
  					<button type="submit" name="logout" class="btn btn-primary">Kijelentkezés</button>
  				</form>
  				</li>
  			</ul>
  			</div>
			</nav>
			');
	}

	function loginView()
	{
		echo('
			<div style="margin-top:80px" class="container-fluid">
				<center>
					<form action="login.php" method="post">
						<label for="username" class="form-label">Felhasználónév:</label>
						<input id="username" name="username" class="form-control" type="text">

						<label for="password" class="form-label">Jelszó:</label>
						<input id="password" name="password" class="form-control" type="password">

						<button type="submit" name="login" class="btn btn-primary">Belépés</button>
					</form>
				</center>
			</div>
			');
	}

	function __destruct()
	{
		echo('
			</body>
			</html>
			');
	}
}

?>