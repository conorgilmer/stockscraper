<?php

require ("db.php");
/* build drop down from database table */
function drop_down($intID, $strName, $strText,  $tableName, $strOrderField, $strMethod="asc") {

  $strQuery = "select $strName, $strText from $tableName";
  $rsrcResult = mysql_query($strQuery);

  while($arrayRow = mysql_fetch_assoc($rsrcResult)) {
   $strNameField = $arrayRow["$strName"];
   $strTextField = $arrayRow["$strText"];
     echo "<option value=\"$strNameField\">$strNameField - $strTextField</option>\n";
  }
  echo "</select>\n\n";
}

?>

<?php 

if($_GET['qcode'] != '')
    $qcode = $_GET['qcode'];
else
    $qcode = 'WIKI/MMM';

    $qfreq = $_GET['freq'];


$today = date("Y-m-d");
$end_date = $today;
$start_date = Date("Y-m-d", strtotime($today." -120 Month -1 Day"));

/************  Prices  ****************/
/* call quandl using version 3        */
$qlink_json = 'https://www.quandl.com/api/v3/datasets/'.$qcode.'.json?collapse=quarterly&start_date='.$start_date.'&end_date='.$today.'&api_key='.$quandl_token;


$br_json = file_get_contents($qlink_json);
$br_obj = json_decode($br_json, true);
//Build arrays


$data_set=$br_obj['dataset'];

$stock_code = $data_set['dataset_code'];
$stock_dbase = $data_set['database_code'];
$stock_name = $data_set['name'];
$stock_close = 0;
$stock_colnames = array();
$stock_colnames = $data_set['column_names'];
while ($stock_colnames[$stock_close]<>"Close") {
    $stock_close++;
}


$br_label_arr = array();
$br_value_arr = array();
$i = 0;
	foreach ($data_set['data'] as $br_data){ //loop through data
		$br_label_arr[] = date('Y M j',strtotime($br_data[0])); //pull dates
		$br_value_arr[] = $br_data[$stock_close]; //pull prices
//		if (++$i == 30) break;
	}

$br_labels = array_reverse($br_label_arr); //reverse the data for ASC
$br_values = array_reverse($br_value_arr); //reverse the data for ASC
$br_labels = implode('","', $br_labels); //comma sep
$br_values = implode(", ", $br_values); //comma sep


?>

<!-- header -->
<?php include('header.php'); ?>

<!-- additional header stuff -->

<!-- menu -->
<?php include('menu.php'); ?>


<script>

    function goToPage() {
        var page = document.getElementById('page').value;
        var freq = document.getElementById('freq').value;
        console.log(freq);
        window.location = "yahoojson.php?qcode=" + page + "&freq=" + freq;
    }

</script>

<!-- Content Start -->

		<script src="charts/Chart.js"></script>
		<h1>Quandl Data</h1>
		
 <h2>Quandl Charts - WIKI DB</h2>
<p>Select a Code for a Stock Price</p>
  <!--form>
  <select name="page" id="page" onchange="goToPage(this.value)">
  <option value="all">Select a Stock:</option>
    <option value="all">All</option>
    <option value="WIKI/FB">FB</option>
    <option value="WIKI/MMM">MMM</option>
    <option value="WIKI/AP">AP</option>
  </select>
</form-->


  <form>
  <select name="page" id="page" onchange="goToPage(this.value, document.getElementbyId('freq'))">
                <option class="form" style="width: 245px;" value="N/A">Select Stock</option>
                <?php drop_down("id", wiki_code, wiki_name, wiki_codes, "wiki_code"); ?>
  <br><input type="radio" name="freq" value="quaterly" checked> Quaterly
  <input type="radio" name="freq" value="weekly"> Weekly
  <input type="radio" name="freq" value="yearly"> Yearly<br>


  </form>



		<p>Stock Code = <?php echo $stock_code;?></p>
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
					label: "<?php echo $stock_code;?>",
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

<!-- footer -->
<?php include('footer.php'); ?>
