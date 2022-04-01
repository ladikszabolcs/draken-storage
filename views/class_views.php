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
			<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
			</head>
			<body>
			');
	}

	function menuView()
	{
		$menuheader = '<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  			<div class="container-fluid">
  			<a class="navbar-brand" href="index.php">Storage</a>';
  		$registermenu = '<ul class="nav navbar-nav">
				<li class="nav-item">
					<form action="index.php" method="post">
						<button type="submit" name="registry" class="btn btn-primary">Regisztráció</button>
					</form>
				</li>
			</ul>';
		$itemsmenu = '<ul class="nav navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="items.php"><center><span class="fas fa-boxes"></span><br></center>Items</a> 
				</li>
			</ul>';
  		$logoutmenu = '<ul class="nav navbar-nav">
				<li class="nav-item">
					<form action="logout.php" method="post">
						<button type="submit" name="logout" class="btn btn-primary">Kijelentkezés</button>
					</form>
				</li>
			</ul>';
		$menufooter = '</div>
			</nav>';
		if(array_key_exists("username", $_SESSION)){
			echo ($menuheader . $itemsmenu . $logoutmenu . $menufooter);
		}
		else{
			echo ($menuheader . $registermenu . $menufooter);
		}

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
			echo('<div class="container mt-3">
			<div class="alert alert-' . $color . ' alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong></strong> ' . $message . '
  </div>
  </div>');
	}

	function tableRenderView()
	{
		$items = new Items();
		$itemlist = $items->getItems();
		#$itemkeys = array_keys($itemlist);
		$rowid = 0;
		$sort = 0;
		#table tag generálás
		$result = "<form id=\"massivedelete\" action=\"render.php\" method=\"post\"><table id=\"itemsTable\" class=\"table table-striped \" style=\"margin-top: 8px\"><form></form>";
		#thead generálás
		$result = $result . "<thead><tr class=\"header\">";
		#ide dinamikus rész
		foreach ($itemlist[0] as $key => $value) {
			$result = $result . "<th onclick=\"sortTable(" . $sort . ")\">" . $key . "</th>";
			$sort++;
		}
		$result = $result . "</tr></thead>";

		#tbody generálás
		$result = $result . "<tbody>";
		#ide dinamikus rész
		foreach ($itemlist as $key => $row) {
			$result = $result . "<tr>";
			
			foreach ($row as $key => $value) {
				#///////
				#if($key == "unit"){
				#	$result = $result . "<td>" . $items->getUnit($value) . "</td>";
				#}
				#else{
				#	$result = $result . "<td>" . $value . "</td>";
				#}
				////////
				switch ($key) {
					case 'id':
						$result = $result . "<td>" . "<input form=\"massivedelete\" type=\"checkbox\" name=\"" . $value . "\" value=\"" . $value . "\">   " . $value . "</td>";
						$rowid = $rowid + 1;

					break;
					case 'unit':
						$result = $result . "<td>" . $items->getUnit($value) . "</td>";
						break;
					case 'category':
						$result = $result . "<td>" . $items->getCategorys()[$value-1]["name"] . "</td>";
						break;
					case 'name':
						$result = $result . "<td>" . "<span data-bs-toggle=\"modal\" data-bs-target=\"#" . "item" . $rowid . "\">" . $value . "</span>" . "</td>" . $this->modalRenderView($rowid);
						break;
					case 'image':
						$result = $result . "<td><img height='50 px' src='data:image/png;base64," . $value . "'/></td>";
						break;
					default:
						$result = $result . "<td>" . $value . "</td>";
						break;
				}
							}
			$result = $result . "</tr>";

		}

		$result = $result . "</tbody></table><button name=\"massivedelete\" class=\"btn btn-danger\" type=\"submit\"><span class=\"fa fa-trash-alt\"></span></button></form><form></form>";
		echo("$result");
	}
#modal body beviteli mezők
	function modalRenderView($id){

		$items = new Items();
		$itemlist = $items->getItems();

		#$itemlist[$id-1]["name"];

		$options = "";
		$units = $items->getUnits();

		foreach ($units as $key => $value) {
			if($itemlist[$id-1]["unit"]==$value["id"]){
				$selected = " selected=\"selected\"";
			}
		else{
			$selected = "";
		}
		$options = $options . "<option" . $selected . " value=" . $value["id"] . ">" . $value["name"] . "</option>";
		}
		
		$options2 = "";
		$category = $items->getCategorys();
		foreach ($category as $key => $value) {
			if($itemlist[$id-1]["category"]==$value["id"]){
				$selected2 = " selected=\"selected\"";
			}
		else{
			$selected2 = "";
		}
		$options2 = $options2 . "<option" . $selected2 . " value=" . $value["id"] . ">" . $value["name"] . "</option>";
		}


		$result = "<div class=\"modal\" id=\"item" . $id . "\">
					  <div class=\"modal-dialog\">
 						  <div class=\"modal-content\">

     		 				<!-- Modal Header -->
 						     <div class=\"modal-header\">
 				    		   <h4 class=\"modal-title\">Item id: " . $itemlist[$id-1]["id"] . "</h4>
		 				       <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
						      </div>

					      <!-- Modal body -->
 					     <form action=\"render.php\" method=\"post\" enctype=\"multipart/form-data\">
 					     <div class=\"modal-body\">
 			    		   <label for=\"name\" class=\"form-label\">name</label>
 			    		   <input id=\"name\" name=\"name\" class=\"form-control\" required type=\"text\" value=\"" . $itemlist[$id-1]["name"] . "\">

  			    		   <label for=\"code\" class=\"form-label\">code</label>
 			    		   <input id=\"code\" name=\"code\" class=\"form-control\" required type=\"text\" value=\"" . $itemlist[$id-1]["code"] . "\">

 			    		   <label for=\"quantity\" class=\"form-label\">quantity</label>
 			    		   <input id=\"quantity\" name=\"quantity\" class=\"form-control\" required type=\"number\" min=0 value=\"" . $itemlist[$id-1]["quantity"] . "\">
		    		   
 			    		   <label for=\"unit\" class=\"form-label\">unit</label>
 			    		    <select class=\"form-select\" id=\"unit\" name=\"unit\">
 			    		   		" . $options . "
		    		   		</select>

 			    		   <label for=\"category\" class=\"form-label\">category</label>
	 			    		<select class=\"form-select\" id=\"category\" name=\"category\">
 			    		   		" . $options2 . "
		    		   		</select>
		    		   		<label for=\"image\" class=\"form-label\">Kép</label>
  							<input class=\"form-control\" type=\"file\" id=\"image\" name=\"image\">
 			    		   
		 			     </div>
		 			    

 					     <!-- Modal footer -->
 			    		 <div class=\"modal-footer\">
 		 		       <button type=\"submit\" name=\"save\" value=\"" . $itemlist[$id-1]["id"] . "\" class=\"btn btn-success\"><span class=\"fas fa-save\"></span></button>
 		 		       <button type=\"submit\" name=\"delete\" value=\"" . $itemlist[$id-1]["id"] . "\" class=\"btn btn-warning\"><span class=\"fas fa-trash-alt\"></span></button>
		 		       <button type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\"><span class=\"fas fa-times\"></span></button>
		 		        </form>
  					    </div>

  						  </div>
 					 </div>
				</div>";
		return $result;
	}

	function addItemView(){
		$items = new Items();
		$result = "";
		$result = $result . "<button data-bs-toggle=\"modal\" data-bs-target=\"#additem\" class=\"btn btn-success\"><span class=\"fas fa-plus\"></span></button>";
		
		$options = "";
		$units = $items->getUnits();

		foreach ($units as $key => $value) {
		$options = $options . "<option" . " value=" . $value["id"] . ">" . $value["name"] . "</option>";
		}
		
		$options2 = "";
		$category = $items->getCategorys();
		foreach ($category as $key => $value) {
		$options2 = $options2 . "<option" . " value=" . $value["id"] . ">" . $value["name"] . "</option>";
		}

		$result = $result . "<div class=\"modal\" id=\"additem\">
					  <div class=\"modal-dialog\">
 						  <div class=\"modal-content\">

     		 				<!-- Modal Header -->
 						     <div class=\"modal-header\">
 				    		   <h4 class=\"modal-title\">Add new item</h4>
		 				       <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
						      </div>

					      <!-- Modal body -->
 					     <form id=\"addnewitem\" action=\"render.php\" method=\"post\" enctype=\"multipart/form-data\">
 					     <div class=\"modal-body\">
 			    		   <label for=\"name\" class=\"form-label\">name</label>
 			    		   <input form=\"addnewitem\" id=\"name\" name=\"name\" class=\"form-control\" required type=\"text\">

  			    		   <label for=\"code\" class=\"form-label\">code</label>
 			    		   <input form=\"addnewitem\" id=\"code\" name=\"code\" class=\"form-control\" required type=\"text\">

 			    		   <label for=\"quantity\" class=\"form-label\">quantity</label>
 			    		   <input form=\"addnewitem\" id=\"quantity\" name=\"quantity\" class=\"form-control\" required type=\"number\" min=0>
		    		   
 			    		   <label for=\"unit\" class=\"form-label\">unit</label>
 			    		    <select form=\"addnewitem\" class=\"form-select\" id=\"unit\" name=\"unit\">
 			    		   		" . $options . "
		    		   		</select>

 			    		   <label for=\"category\" class=\"form-label\">category</label>
	 			    		<select form=\"addnewitem\" class=\"form-select\" id=\"category\" name=\"category\">
 			    		   		" . $options2 . "
		    		   		</select>
	    		   			<label for=\"image\" class=\"form-label\">Kép</label>
  							<input class=\"form-control\" type=\"file\" id=\"image\" name=\"image\"> 			    		   
		 			     </div>
		 			    

 					     <!-- Modal footer -->
 			    		 <div class=\"modal-footer\">
 		 		       <button form=\"addnewitem\" type=\"submit\" name=\"save\" value=\"addnewitem\" class=\"btn btn-success\">Save</button>

		 		       <button form=\"addnewitem\" type=\"button\" class=\"btn btn-danger\" data-bs-dismiss=\"modal\">Close</button>
		 		        </form>
  					    </div>

  						  </div>
 					 </div>
				</div>";

		echo $result;
	}

	function searchBarView(){
		$script = "<div class=\"col-md-4\"><input class=\"form-control\" style='margin-top:100px' type=\"text\" id=\"searchInput\" onkeyup=\"searchFunction()\" placeholder=\"Keresés...\" title=\"Kereső\"></div>
					<script>
					function searchFunction() {
  					// Declare variables
  					var input, filter, found, table, tr, td, i, j, txtValue;
  					input = document.getElementById(\"searchInput\");
 					 filter = input.value.toUpperCase();
 					 table = document.getElementById(\"itemsTable\");
 					 tr = table.getElementsByTagName(\"tr\");

 					 // Loop through all table rows, and hide those who don't match the search query
 					 for (i = 1; i < tr.length; i++) {
 						td = tr[i].getElementsByTagName(\"td\");
 						for (j =0; j < td.length; j++){
			  			    if (td[j].innerText.toUpperCase().indexOf(filter) > -1) {
			  			    	found = true;
			  			    }
			  			}
			  			if (found) {
 			 		    	tr[i].style.display = \"\";
 			 		    	found = false;
			  		    }
			  		    else {
			   		    	tr[i].style.display = \"none\";
 			  			}
 			   		}
 			 		}
			</script>";
			echo $script;
	}

	function sortTableView(){
		$script = "<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById(\"itemsTable\");
  switching = true;
  //Set the sorting direction to ascending:
  dir = \"asc\"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      if (n == 1){
	      x = rows[i].getElementsByTagName(\"SPAN\")[0];
    	  y = rows[i + 1].getElementsByTagName(\"SPAN\")[0];
    	}
       else{
	      x = rows[i].getElementsByTagName(\"TD\")[n];
    	  y = rows[i + 1].getElementsByTagName(\"TD\")[n];
    	}
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == \"asc\") {

if (n == 3){
if (Number(x.innerHTML) > Number(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
}
else{

        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }

}

      } else if (dir == \"desc\") {

if (n == 3){
if (Number(x.innerHTML) < Number(y.innerHTML)) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
}
else{
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
}
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is \"asc\",
      set the direction to \"desc\" and run the while loop again.*/
      if (switchcount == 0 && dir == \"asc\") {
        dir = \"desc\";
        switching = true;
      }
    }
  }
}
</script>";
		echo $script;
	}


	function __destruct()
	{	
		echo('
			</body>
			</htlm>
			');
	}

}


?>