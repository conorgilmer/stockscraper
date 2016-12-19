<?php

/* format money */
function formatMoney($value) {
  $currency = "€";
  //$currency = "$";
  //$currency = "£";
  return $currency.number_format($value,2);
}


/* form the link for show table link */
function formatTableLink($code){

  $filename = $code . ".csv";
  if (file_exists($filename)) {
    return "<a href ='showcsv2.php?code=$code'>Table</a>";
  }
  else 
      return "N/A";
}

/* form the link for download yahooCSV link */
function formatCSVLink($code){
    return "<a href ='http://ichart.finance.yahoo.com/table.csv?s=$code'>CSV</a>";
}


/* form the link for download yahoojson link */
function formatQWIKIjson($code){
    return "<a href ='https://www.quandl.com/api/v1/datasets/$code.json'>JSON</a>";
}

/* form the link for download yahooCSV link */
function formatQWIKICSVLink($code){
    return "<a href ='https://www.quandl.com/api/v1/datasets/$code.csv'>CSV</a>";
}

/* form the link for Quandl WIKI chart */
function formatQWIKIChartLink($code){
    return "<a href ='quandl.php?qcode=$code'>Chart</a>";
}
/* form the link for Quandl WIKI chart */
function formatQWIKILocal($code){
    return "<a href ='quandl.php?qcode=$code'>Local</a>";
}

/* form the link for Yahoo Finance Chart */
function formatChartLink($code){
    //return "<a href ='http://chart.finance.yahoo.com/z?s=$code'>Chart</a>";
    return "<a href ='yahoocharts.php?stockprice=$code'>Chart</a>";
}

/* form the link for Yahoo Finance Chart */
function formatAMEXChartLink($code){
    return "<a href ='yahoochartsamex.php?stockprice=$code'>Chart</a>";
}

/* form the link for Yahoo Finance Chart */
function formatNASDAQChartLink($code){
    return "<a href ='yahoochartsnasdaq.php?stockprice=$code'>Chart</a>";
}

/* form the link for link */
function formatLink($code){
    return "<a href ='http://chart.finance.yahoo.com/z?s=$code'>$code</a>";
}


?>

