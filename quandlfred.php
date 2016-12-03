
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

$qcode = $_GET['qcode'];

if($_GET['qcode'] != '')
    $qcode = $_GET['qcode'];
else
    $qcode = "FRED/PI20171";

//************  Prices  ****************
//$qlink_json = file_get_contents('https://www.quandl.com/api/v1/datasets/FRED/PI20171.json?collapse=quarterly&start_date=2016-06-01&end_date=2016-09-01&api_key=xcN1MXUnC_248YofABy-');
$qlink_json = 'https://www.quandl.com/api/v1/datasets/'.$qcode.'.json?collapse=quarterly&start_date=2012-01-01&end_date=2013-12-31&api_key=xcN1MXUnC_248YofABy-';
$br_json = file_get_contents($qlink_json);
$br_obj = json_decode($br_json, true);
//Build arrays
$stock_code = $br_obj['code'];
$stock_close = 0;
$stock_colnames = array();
$stock_colnames = $br_obj['column_names'];
//while ($stock_colnames[$stock_close]<>"VALUE") {
//    echo $stock_colnames[$stock_close];
//    $stock_close++;
//}

//print_r($stock_colnames);
$br_label_arr = array();
$br_value_arr = array();
$i = 0;
	foreach ($br_obj['data'] as $br_data){ //loop through data

		$br_label_arr[] = date('M j',strtotime($br_data[0])); //pull dates
		$br_value_arr[] = $br_data[1]; //pull prices
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
        window.location = "quandlfred.php?qcode=" + page;
    }

</script>

<!-- Content Start -->

		<script src="charts/Chart.js"></script>
		<h1>Quandl Data</h1>
		
 <h2>Quandl Charts - FRED (Federal Reserve Economic Data)</h2>
<p>Select a Code for a Stock Price</p>
  <form>
  <select name="page" id="page" onchange="goToPage(this.value)">
  <option value="all">Select a Stock:</option>
    <option value="FRED/IRLIMPORTQDSMEI">Imports of Goods in Ireland</option>
    <option value="FRED/IRLEXPORTADSMEI">Exports of Goods in Ireland</option>
<option value="FRED/SIPOVGINIIRL,GINI Index for Ireland</option>
<option value="FRED/SEENRPRIMFMZSIRL">Ratio of Female to Male Primary School Enrollment for Ireland</option>
<option value="FRED/SEENRSECOFMZSIRL">Ratio of Female to Male Secondary School Enrollment for Ireland</option>
<option value="FRED/SEENRTERTFMZSIRL">Ratio of Female to Male Tertiary School Enrollment for Ireland</option>
<option value="FRED/ITNETUSERP2NOR">Internet users for Norway</option>
<option value="FRED/ITNETUSERP2ARE">Internet users for the United Arab Emirates</option>
<option value="FRED/ITNETUSERP2DZA">Internet users for Algeria</option>
<option value="FRED/ITNETUSERP2FIN">Internet users for Finland</option>
<option value="FRED/ITNETUSERP2GNQ">Internet users for Equatorial Guinea</option>
<option value="FRED/ITNETUSERP2ISL">Internet users for Iceland</option>
<option value="FRED/ITNETUSERP2KWT">Internet users for Kuwait</option>
<option value="FRED/ITNETUSERP2LUX">Internet users for Luxembourg</option>
<option value="FRED/ITNETUSERP2MMR">Internet users for Myanmar</option>
<option value="FRED/ITNETUSERP2SVK">Internet users for the Slovak Republic</option>
<option value="FRED/ITNETUSERP2ARG">Internet users for Argentina</option>
<option value="FRED/ITNETUSERP2BEN">Internet users for Benin</option>
<option value="FRED/ITNETUSERP2CHE">Internet users for Switzerland</option>
<option value="FRED/ITNETUSERP2CUB">Internet users for Cuba</option>
<option value="FRED/ITNETUSERP2GBR">Internet users for the United Kingdom</option>
<option value="FRED/ITNETUSERP2LDC">Internet users for Least Developed Countries</option>
<option value="FRED/ITNETUSERP2MDG">Internet users for Madagascar</option>
<option value="FRED/ITNETUSERP2MRT">Internet users for Mauritania</option>
<option value="FRED/ITNETUSERP2PYF">Internet users for French Polynesia</option>
<option value="FRED/ITNETUSERP2AUS">Internet users for Australia</option>
<option value="FRED/ITNETUSERP2ARM">Internet users for Armenia</option>
<option value="FRED/ITNETUSERP2BHR">Internet users for Bahrain</option>
<option value="FRED/ITNETUSERP2EST">Internet users for Estonia</option>
<option value="FRED/ITNETUSERP2ITA">Internet users for Italy</option>
<option value="FRED/ITNETUSERP2LBN">Internet users for Lebanon</option>
<option value="FRED/ITNETUSERP2MDA">Internet users for the Republic of Moldova</option>
<option value="FRED/ITNETUSERP2POL">Internet users for Poland</option>
<option value="FRED/ITNETUSERP2RWA">Internet users for Rwanda</option>
<option value="FRED/ITNETUSERP2AFG">Internet users for the Islamic Republic of Afghanistan</option>
<option value="FRED/ITNETUSERP2BGR">Internet users for Bulgaria</option>
<option value="FRED/ITNETUSERP2CAF">Internet users for the Central African Republic</option>
<option value="FRED/ITNETUSERP2EUU">Internet users for the European Union</option>
<option value="FRED/ITNETUSERP2GRL">Internet users for Greenland</option>
<option value="FRED/ITNETUSERP2IRL">Internet users for Ireland</option>

  </select>
</form>


  <!-- form>
  <select name="page" id="page" onchange="goToPage(this.value)">
                <option class="form" style="width: 245px;" value="N/A">Select Stock</option>
                <?php drop_down("id", fred_code, fred_name, fred_codes, "fred_code"); ?>

  </form-->



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
