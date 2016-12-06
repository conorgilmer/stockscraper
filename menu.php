  </head>

  <body>
<!--?php include_once("php/tracking.php") ?-->
    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Stock Price Scraper</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                      <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Yahoo Finance! <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="yahoocharts.php?stockprice=MMM">Yahoo Finance! Chart - NYSE</a></li>
                        <li><a href="yahoochartsamex.php?stockprice=FAX">Yahoo Finance! Chart - AMEX</a></li>
                        <li><a href="yahoochartsnasdaq.php?stockprice=YHOO">Yahoo Finance! Chart - NASDAQ 100</a></li>
                        <li><a href="yahooindexs.php">Yahoo World Stock Indices</a></li>
                        </ul>
  
                      <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Quandl <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="quandl.php?qcode=WIKI/GOOG">Quandl (WIKI)</a></li>
                        <li><a href="quandlfred.php?qcode=FRED/JTU7000OSR">Quandl (FRED)</a></li>
                        </ul>
                        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Tables <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="table_yf_amex.php">AMEX Stocks Yahoo Finance!</a></li>
                        <li><a href="table_yf_nyse.php">NYSE Stocks Yahoo Finance!</a></li>
                        <li><a href="table_yf_nasdaq.php">NASDAQ 100 Stocks Yahoo Finance!</a></li>
                        <li><a href="table_quandl_wiki.php">Quandl (WIKI) </a></li>
                        </ul>
                        <li><a href="yahoocurr.php">Currency</a></li>
                        </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="about.php">About</a></li>
                </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>


