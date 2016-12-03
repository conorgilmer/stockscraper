<!-- header -->
<?php include('header.php'); ?>  

<!-- additional header stuff -->

<script>

    function goToPage() {
        var page = document.getElementById('page').value;
        window.location = "yahoochartsnasdaq.php?stockprice=" + page;
    }

</script>

<!-- menu -->
<?php include('menu.php'); ?>  



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


<!-- Content Start -->

  
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
 <h2>Yahoo Charts (NASDAQ100)</h2>
<p>Select a Code for a NASDAQ100 Stock Price</p>
  <!--form>
  <select name="page" id="page" onchange="goToPage(this.value)">
  <option value="all">Select a Stock:</option>
    <option value="all">All</option>
    <option value="AMZN">Amazon</option>
    <option value="GOOG">Google</option>
    <option value="MSFT">Microsoft</option>
    <option value="YHOO">Yahoo</option>
  </select>
  </form-->


  <form>
  <select name="page" id="page" onchange="goToPage(this.value)">
                <option class="form" style="width: 245px;" value="N/A">Select Stock</option>
                <?php drop_down("id", nasdaq_code, nasdaq_name, nasdaq_codes, "nasdaq_code"); ?>

  </form>



  <div id="chart_div"></div>

<?php echo $_GET['stockprice'];?>
 <img src="http://chart.finance.yahoo.com/z?s=<?echo $_GET['stockprice'];?>" border="0" alt="photo" class="responsive-image">


        </div>
      </div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<h2>Live Market Data with Yahoo Finance</h2>

<div id='result'></div>
<div id='time'></div>
<div id='change'></div>
<div id='percent'></div>
<br>
<script>
    $("document").ready(function () {

        //Calling function
        reLoad();

        function reLoad(){
            $.getJSON("https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22<?php echo $_GET['stockprice']?>%22)&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=", function(data) {
                $("#result").html("Live Price $"+ data.query.results.quote.LastTradePriceOnly);
                    $("#result").hide().fadeIn(500);
                $("#time").html("Valid Time: "+ data.query.results.quote.LastTradeTime);
                $("#change").html("Change: "+ data.query.results.quote.Change);
                $("#percent").html("Percent: "+ data.query.results.quote.ChangeinPercent);
            });
        setTimeout(reLoad,6000);
        };

    });

</script>
<!-- Content End -->

<!-- footer -->
<?php include('footer.php'); ?>  
