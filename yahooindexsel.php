<!-- header -->
<?php include('header.php'); ?>  


<style>
.symbol { float: left; margin-right: 3px; }
.symbol .name { display: block }
    
.symbol.up { background: #70DB70 }
.symbol.up .change { color: green }
    
.symbol.down { background: #f7cdc2 }
.symbol.down .change { color: red }
</style>
<!-- additional header stuff -->

<script>

var symbols = ['^GSPC', '^NDX', 'GLD', 'SLV', '^N225', '^FTSE', '^GDAXI', '^FCHI', '^ISEQ', '^FTAI', '^BFX', 'FTSEMIB.MI', '^OSEAX' ,'^HSI'],
    properties = [
        { classname: 'name', property: 'Name' },
        { classname: 'result', property: 'LastTradePriceOnly' },
        { classname: 'change', property: 'Change' }
    ];

function buildElement(quote) {
    var container = $("<div></div>").addClass("symbol");
    properties.forEach(function (prop) {
        var child = $("<span></span>").addClass(prop.classname);
        child.text(quote[prop.property]);
        container.append(child);
    });
    if(/^\+/.test(quote.PercentChange)) {
        container.addClass("up");
    } else {
        container.addClass("down");
    }
    return container;
}

$.getJSON("http://query.yahooapis.com/v1/public/yql", {
    format: "json",
    diagnostics: "true",
    env: "http://datatables.org/alltables.env",
    q: "select * from yahoo.finance.quotes where symbol in ('" + symbols.join("','") + "')"
}, function (data, xhr, status) {
    // do some sanity checking of the data here
    var elements = data.query.results.quote.map(buildElement);
    $("#indices").append(elements);
});

</script>

<script>

    function goToPage() {
        var page = document.getElementById('page').value;
        window.location = "yahooindexsel.php?idx=" + page;
    }

</script>


<!-- menu -->
<?php include('menu.php'); ?>  

<?php require ("db.php"); ?>

<!-- Content Start -->
  
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-12">
 <h2>Yahoo Finance! Indices</h2>
<div id="indices"> </div>
</div>
</div>
      <div class="row">
        <div class="col-lg-12">
<h2>Yahoo Finance! World Stock Exchanges</h2>
<p>Select a Stock Exchange Code </p>
  <form>
  <select name="page" id="page" onchange="goToPage(this.value)">
  <option value="all">Select a Stock Exchange:</option>
    <option value="^ISEQ">ISEQ</option>
    <option value="^FTSE">FTSE</option>
    <option value="^DJI">Dow Jones</option>
    <option value="^NDX">NASDAQ 100</option>
    <option value="^GSPC">S & P 500</option>
    <option value="^GDAX1">DAX</option>
    <option value="^FCHI">CAC 50</option>
    <option value="^SSMI">Swiss</option>
    <option value="^OSEAX">Oslo Exchange</option>
    <option value="^N225">Nikkei</option>
    <option value="^HSI">Hang Seng</option>
  </select>
  </form>

</div>
</div>
      <div class="row">
        <div class="col-lg-12">

<?php echo $_GET['idx'];?>
 <img src="http://chart.finance.yahoo.com/z?s=<?echo $_GET['idx'];?>" border="0" alt="photo" class="responsive-image">

    </div>
</div>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<br>

<!-- Content End -->

<!-- footer -->
<?php include('footer.php'); ?>  
