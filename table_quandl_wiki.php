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
<h1>Table of Quandl WIKI Database Stocks</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 

$sqlQuery = "SELECT * FROM stockscraper.wiki_codes";
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
	$htmlString .= "<th colspan='4'>Actions</th>";

	$htmlString .= "</tr>";
	
	while ($product = mysql_fetch_assoc($result))
	{
		$htmlString .=  "<tr>" ;
//		$htmlString .=  "<td>";
//		$htmlString .=  $product["wiki_id"];
//		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["wiki_code"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["wiki_name"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["wiki_code"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  $product["wiki_code"];
		$htmlString .=  "</td>";
		
		$htmlString .=  "<td>";
		$htmlString .=  formatQWIKIChartLink($product["wiki_code"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  formatQWIKICSVLink($product["wiki_code"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  formatQWIKILocal($product["wiki_code"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  formatQWIKIjson($product["wiki_code"]);
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

