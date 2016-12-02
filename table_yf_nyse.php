<!-- header -->
<?php include('header.php'); ?>

<!-- additional header stuff -->

<!-- menu -->
<?php include('menu.php'); ?>

<?php

require ("db.php");
require ("functions.php");

//Set up variable so 'active' class set on navbar link
$activeHome = "active";

?>

<div class="container">
<div class="row">
<div class="span12">
<h1>Yahoo Finance Tables - NYSE</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 

$sqlQuery = "SELECT * FROM stockscraper.nyse_codes";
$result = mysql_query($sqlQuery);


if ($result) {
	$htmlString = "";
	$htmlString .=  "<table class='table table-bordered table-condensed table-striped' border='1'>\n";
	
	$htmlString .= "<tr>";
//	$htmlString .= "<th>ID</th>";
	$htmlString .= "<th>Code</th>";
	$htmlString .= "<th>Name</th>";
	$htmlString .= "<th>Date</th>";
        $htmlString .= "<th>Start</th>";
	$htmlString .= "<th colspan='3'>Actions</th>";

	$htmlString .= "</tr>";
	
	while ($product = mysql_fetch_assoc($result))
	{
		$htmlString .=  "<tr>" ;
//		$htmlString .=  "<td>";
//		$htmlString .=  $product["nyse_id"];
//		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["nyse_code"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["nyse_name"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["nyse_code"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  $product["nyse_code"];
		$htmlString .=  "</td>";
		
		$htmlString .=  "<td>";
		$htmlString .=  formatChartLink($product["nyse_code"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  formatCSVLink($product["nyse_code"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  formatTableLink($product["nyse_code"]);
		$htmlString .=  "</td>";
		
		
		$htmlString .=  "</tr>\n";
		
	}
	$htmlString .=  "</table>\n";
	
	echo $htmlString ;
	
	
	
} else {
	
	die("Failure: " . mysql_error($link_id));
}
?>
</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->

<?php include('footer.php'); ?>

