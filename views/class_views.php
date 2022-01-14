<?php

require 'vendor/autoload.php';

class Views {
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
		$menuheader = '<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  			<div class="container-fluid">
  			<a class="navbar-brand" href="index.php">Storage</a>';
  		$registermenu = '<ul class"nav navbar-nav">
				<li class="nav-item">
					<form action="index.php" method="post">
						<button type="submit" name="registry" class="btn btn-primary">Regisztráció</button>
					</form>
				</li>
			</ul>';
		$logoutmenu = '<ul class"nav navbar-nav">
				<li class="nav-item">
					<form action="logout.php" method="post">
						<button type="submit" name="logout" class="btn btn-primary">Kijelentkezés</button>
					</form>
				</li>
			</ul>';
		$menufooter = '</div>
			</nav>';

		if(array_key_exists("username", $_SESSION)){
			echo($menuheader . $logoutmenu . $menufooter);
		}
		else{
			echo($menuheader . $registermenu . $menufooter);
		}
		//echo($menuheader . $registermenu . $logoutmenu . $menufooter);
	}

	function loginView()
	{
		echo('
			 <div style="margin-top:80px" class="container-fluid">
			 	<center>
			 		<form action="login.php" method="post">
			 			<label for="username" class="form-label">Felhasználónév</label>
			 			<input id="username" name="username" class="form-control "type="text">
			 			<label for="password" class="form-label">Jelszó</label>
			 			<input id="password" name="password" class="form-control "type="password">
			 			<button type="submit" name="login" class="btn btn-primary">Belépés</button>
			 		</form>
			 	</center>
			 </div>
			');
	}

	function registryView()
	{
		echo('
			 <div style="margin-top:80px" class="container-fluid">
			 	<center>
			 		<form action="registry.php" method="post">
			 			<label for="username" class="form-label">Felhasználónév</label>
			 			<input id="username" name="username" class="form-control "type="text">
			 			<label for="password" class="form-label">Jelszó</label>
			 			<input id="password" name="password" class="form-control "type="password">
			 			<button type="submit" name="registry" class="btn btn-primary">Regisztrálok</button>
			 		</form>
			 	</center>
			 </div>
			');
	}

	function errorMessageView($message, $color)
	{
echo('<div class="alert alert-' . $color . ' alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> ' . $message . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>');
	}

	function tableRenderView()
	{
		$items = new Items();
		$itemlist = $items->getItems();

		$result = "";
		//table tag generálás
		$result = "<table class=\"table table-striped\" style=\"margin-top: 80px\">";
		//thead generálás
		$result = $result . "<thead><tr>";

		foreach ($itemlist[0] as $key => $value) {
			$result = $result . "<th>" . $key . "</th>";
		}
		$result = $result . "</tr></thead>";

		$result = $result . "<tbody>";
		//ide kéne valami dinamikus rész, amivel feltöltjük a táblázat törzsét az adatbázisból

		foreach($itemlist as $key => $row) {
			$result = $result . "<tr>";
			foreach($row as $key => $value) {
				//////////////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////////////
					switch ($key) {
						case 'id':
						  $result = $result . "<td>" . $value . "</td>";
							$rowid = $value;
							break;
						case 'unit':
							$result = $result . "<td>" . $items->getUnit($value) . "</td>";
							break;
						
						case 'name':
							$result = $result . "<td>" . "<span data-bs-toggle=\"modal\" data-bs-target=\"#" . "item" . $rowid . "\">" . $value . "</span>" ."</td>" . $this->modalRenderView($rowid);
							break;

						default:
							$result = $result . "<td>" . $value . "</td>";
							break;
					}
				////////////////////////////////////////////////////////////////////////	
			}
			$result = $result . "</tr>";
		}

		$result = $result . "</tbody></table>";

		echo $result;
	}

  ///inputokat megcsinálni!
	function modalRenderView($id){

		$items = new Items();
		$itemlist = $items->getItems();
		//így hivatkozzunk az $id-edik elemen belül a megfelelő mezőre
		//$itemlist[$id-1]["name"];

		$options = "";
		$units = $items->getUnits();
		foreach ($units as $key => $value) {
			if($itemlist[$id-1]["unit"]==$value["id"]){
				$selected = " selected=\"selected\"";
			}
			else{
				$selected = "";
			}
			$options = $options . "<option" .$selected . ">" . $value["name"] . "</option>";
		}

		$result = "
			<div class=\"modal\" id=\"item" . $id . "\">
  			<div class=\"modal-dialog\">
    			<div class=\"modal-content\">

      	<div class=\"modal-header\">
        	<h4 class=\"modal-title\">Item id: " . $id . "</h4>
        	<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
      	</div>

      	<form>
      	<div class=\"modal-body\">
      	  <label for=\"name\" class=\"form-label\">name</label>
        	<input id=\"name\" class=\"form-control\" type=\"text\" value=\"" . $itemlist[$id-1]["name"] . "\">

      	  <label for=\"code\" class=\"form-label\">code</label>
        	<input id=\"code\" class=\"form-control\" type=\"text\" value=\"" . $itemlist[$id-1]["code"] . "\">

      	  <label for=\"quantity\" class=\"form-label\">quantity</label>
        	<input id=\"quantity\" class=\"form-control\" type=\"text\" value=\"" . $itemlist[$id-1]["quantity"] . "\">

      	  <label for=\"unit\" class=\"form-label\">unit</label>			
					<select class=\"form-select\" id=\"unit\">
     			" . $options . "
    			</select>

      	  <label for=\"category\" class=\"form-label\">category</label>
        	<input id=\"category\" class=\"form-control\" type=\"text\" value=\"" . $itemlist[$id-1]["category"] . "\">        	        	        	
      	</div>
      	

      	<div class=\"modal-footer\">
      		<button type=\"button\" type=\"submit\" name=\"save\" class=\"btn btn-success\">Save</button>
        	<button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
        	</form>
      	</div>
    	</div>
  	</div>
	</div>
		";
		return $result;
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