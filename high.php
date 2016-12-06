
<!-- header  -->
<?php include('header.php'); ?>

<!-- menu  -->
<?php include('menu.php');  ?>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-9">
          <h2>Stock Prices</h2>
<p>Displayed using Highbeam</p>

<?php
$qcode = $_GET['qcode'];
$begin = $_GET['startDate'];
$today = date("-m-d");
?>

  <script data-require="jquery@2.1.4" data-semver="2.1.4" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script data-require="highstock@0.0.1" data-semver="0.0.1" src="http://code.highcharts.com/stock/highstock.js"></script>
  <script data-require="highstock@0.0.1" data-semver="0.0.1" src="http://code.highcharts.com/stock/modules/exporting.js"></script>
  

<div id="container"></div>
  <script>
    $.getJSON('https://www.quandl.com/api/v3/datasets/YAHOO/<?php echo $qcode;?>.json?start_date=<?php echo $begin?>&end_date=<?php echo $today;?>&order=asc', function(json) {
        var hiJson = json.dataset.data.map(function(d) {
          return [new Date(d[0]).getTime(), d[4]]
        });

        // Create the chart
        $('#container').highcharts('StockChart', {
          rangeSelector: {
            selected: 1
          },
          title: {
            text: '<?php echo $qcode;?> Stock Price'
          },
          series: [{
            name: '<?php echo $qcode;?>',
            data: hiJson,
            tooltip: {
              valueDecimals: 2
            }
          }]
        });
    });
  </script>




        </div>
      </div>


<!-- footer -->
<?php include('footer.php');  ?>

