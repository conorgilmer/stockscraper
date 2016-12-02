
<!-- header -->
<?php include('header.php'); ?>

<!-- additional header stuff -->

<!-- menu -->
<?php include('menu.php'); ?>


<!-- Content Start -->

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Stock Price Scraper</h1>
        <p class="lead">Scraping Stock prices from various indices.</p>
        <!--p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p-->
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-sm-6 col-md-4">
          <h2>Yahoo Finance</h2>
          <p>Yahoo Finance Provides many stock listings.</p>
          <p><a class="btn btn-primary" href="yahoo.php" role="button">View details &raquo;</a></p>
        </div>

        <div class="col-sm-6 col-md-4">
          <h2>Quandl</h2>
          <p>Quandl Provides various open stock listings WIKI, Federal Reserve Economic Data (FRED).</p>
          <p><a class="btn btn-primary" href="quandl.php" role="button">View details &raquo;</a></p>
        </div>

        <div class="col-sm-6 col-md-4">
          <h2>Local</h2>
          <p>Downloaded and Locally Stored data.</p>
          <p><a class="btn btn-primary" href="local.php" role="button">Local &raquo;</a></p>
        </div>
      </div>

<!-- Content End -->

<div class="row"></div>

<!-- footer -->
<?php include('footer.php'); ?>
