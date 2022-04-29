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
echo($reports->getChartDates($_POST["from"],$_POST["to"]));
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
      text: 'darab'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
  series: [{
    name: 'Tokyo',
    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

  }, {
    name: 'New York',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

  }, {
    name: 'London',
    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

  }, {
    name: 'Berlin',
    data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

  }]
});
</script>

</html>