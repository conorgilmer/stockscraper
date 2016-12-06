<?php

require ("db.php");
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

//************  Prices  ****************
//$qlink_json = 'https://www.quandl.com/api/v1/datasets/'.$qcode.'.json?collapse=quarterly&start_date=2012-01-01&end_date=2013-12-31&api_key=xcN1MXUnC_248YofABy-';
$qlink_json = 'https://www.quandl.com/api/v1/datasets/'.$qcode.'.json?api_key='.$quandl_token;
$br_json = file_get_contents($qlink_json);
$br_obj = json_decode($br_json, true);
//$br_obj = $br_json;
//Build arrays
$stock_code = $br_obj['code'];
$stock_begin = $br_obj['from_date'];
$stock_close = 0;
$stock_colnames = array();
$stock_colnames = $br_obj['column_names'];
while ($stock_colnames[$stock_close]<>"Close") {
    $stock_close++;
}

$br_label_arr = array();
$br_value_arr = array();
$i = 0;
	foreach ($br_obj['data'] as $br_data){ //loop through data
		$br_label_arr[] = date('M j',strtotime($br_data[0])); //pull dates
		$br_value_arr[] = $br_data[$stock_close]; //pull prices
		if (++$i == 30) break;
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
        window.location = "quandl.php?qcode=" + page;
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
  <select name="page" id="page" onchange="goToPage(this.value)">
                <option class="form" style="width: 245px;" value="N/A">Select Stock</option>
                <?php drop_down("id", wiki_code, wiki_name, wiki_codes, "wiki_code"); ?>

  </form>



		<p>Stock Code = <?php echo $stock_code;?>  <a href="high.php?qcode=<?php echo $stock_code?>&startDate=<?php echo $stock_begin;?>">View using Highbeam</a> <?php echo $stock_begin;?></p>
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
