<?php

require "views/class_views.php";
require "models/class_models.php";
require "controllers/class_controllers.php";

if(!array_key_exists("username", $_SESSION)){
header("location: index.php");
}
$view = new Views();
$reports = new Reports();
$view->menuView();
echo("<div style=\"margin-top:100px\"></div>");
//echo($reports->getChartDates($_POST["from"],$_POST["to"]));
if(!(array_key_exists("from", $_POST) || array_key_exists("to", $_POST))){
	$_POST["from"] = "";
	$_POST["to"] = "";
	if(array_key_exists("today", $_POST)){
		$_POST["from"] = date("Y-m-d");
		$_POST["to"] = date("Y-m-d");
	}
	if(array_key_exists("thisweek", $_POST)){
		$_POST["from"] = date("Y-m-d");
		$_POST["to"] = date("Y-m-d");
	}
}
//$reports->getChartData($_POST["from"],$_POST["to"]);
?>

<html>
<div style="margin-top:100px"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<div class="card bg-light">
				<div class="card-header">
					<h4 class="card-title">Riportok</h4>
				</div>
				<div class="card-body">
					<form action="reports.php" method="post">
						<label for="from">Ettől:</label>
						<input class="form-control" type="date" id="from" name="from">
						<label for="to">Eddig:</label>
						<input class="form-control" type="date" id="to" name="to">
						<br>
						<button class="btn btn-warning">Mutat</button>
					</form>

					<form action="reports.php" method="post">
						<button class="btn btn-success" name="today">Ma</button>&nbsp;
						<button class="btn btn-success" name="thisweek">Ez a hét</button><br>
						<button class="btn btn-success" name="prevweek">Előző hét</button>&nbsp;
						<button class="btn btn-success" name="prevmonth">Előző hónap</button><br>
					</form>
				</div>
			</div>
		</div>

		<div class="col-sm-9">
			<div class="card bg-light">
				<div class="card-header">
					<h4 class="card-title">Eladások</h4>
				</div>
				<div class="card-body">
					<figure class="highcharts-figure">
  						<div id="riportgrafikon"></div>

					</figure>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	Highcharts.chart('riportgrafikon', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'title'
  },
  xAxis: {
    categories: [
 		<?=$reports->getChartDates($_POST["from"],$_POST["to"])?>
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'egység'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} egység</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [<?=$reports->getChartData($_POST["from"],$_POST["to"])?>]
});
</script>

</html>