<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

$view = new Views();
$view->menuView();

echo("	<table class=\"table table-striped\" style=\"margin-top: 80px\">
			<thead>
			  <tr>
				<th>id</th>
				<th>name</th>
				<th>code</th>
				<th>quantity</th>
				<th>unit</th>
				<th>category</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
			  	<td>1</td>
			  	<td>teszt</td>
			  	<td>TESZT-01</td>
			  	<td>5</td>
			  	<td>db</td>
			  	<td>tej</td>
			  </tr>
		</table>
	");

$view->tableRenderView();

?>