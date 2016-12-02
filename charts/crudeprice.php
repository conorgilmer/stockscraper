<?php 
//************  Brent Crude Prices  ****************
$br_json = file_get_contents('https://www.quandl.com/api/v1/datasets/CHRIS/CME_BZ1.json?auth_token=xcN1MXUnC_248YofABy-');
$br_obj = json_decode($br_json, true);
//Build arrays
$br_label_arr = array();
$br_value_arr = array();
$i = 0;
	foreach ($br_obj['data'] as $br_data){ //loop through data
		$br_label_arr[] = date('M j',strtotime($br_data[0])); //pull dates
		$br_value_arr[] = $br_data[6]; //pull prices
		if (++$i == 30) break;
	}
$br_labels = array_reverse($br_label_arr); //reverse the data for ASC
$br_values = array_reverse($br_value_arr); //reverse the data for ASC
$br_labels = implode('","', $br_labels); //comma sep
$br_values = implode(", ", $br_values); //comma sep
?>


<!doctype html>
<html>
	<head>
		<title>Crude Line Chart</title>
		<script src="Chart.js"></script>
	</head>
	<body>
		<h1>Quandl Data with Charts.js using JSON and PHP</h1>
		<div style="width:90%">
			<div>
				<canvas id="canvas" height="400" width="800"></canvas>
			</div>
		</div>


	<script>
		var lineChartData = {
			labels : [<?php echo '"'.$br_labels.'"'; ?>],
			datasets : [
				{
					label: "Brent Crude",
					fillColor : "rgba(151,187,205,0.3)",
					strokeColor : "#999",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#000",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [<?php echo $br_values; ?>]
				}
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>
	</body>
</html>
