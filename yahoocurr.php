<?php 

	if(isset($_POST['submit'])){
		$from   = $_POST['from_currency']; /*change it to your required currencies */
		$to     = $_POST['to_currency'];
		$url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
		$handle = @fopen($url, 'r');
		 
		if ($handle) {
			$result = fgets($handle, 4096);
			fclose($handle);
		}
		$allData = explode(',',$result); /* Get all the contents to an array */
		$currencyValue = $allData[1];
		 
		$responseTxt = 'Value of 1 '.$from.' in '.$to. ' is ' .$currencyValue;
	}
?>


<?php include('header.php'); ?>


<?php include('menu.php'); ?>

<form method='POST'>
<div class='web'>
	<h1>Currency Conversion using Yahoo Finance API</h1>
<p> Currency rates taken from Yahoo! Finance</p>

 <br />
	From Currency : 
	<select name='from_currency'>
		<option value='EUR'>EUR</option>
		<option value='USD'>USD</option>
		<option value='GBP'>GBP</option>
		<option value='CAD'>CAD</option>
		<option value='NOK'>NOK</option>
		<option value='ISK'>ISK</option>
		<option value='DKK'>DKK</option>
		<option value='SEK'>SEK</option>
		<option value='CNY'>CNY</option>
		<option value='JPY'>JPY</option>
		<option value='CHF'>CHF</option>
		<option value='RUB'>RUB</option>
		<option value='INR'>INR</option>
	</select>
	To Currency : 
	<select name='to_currency'>
		<option value='EUR'>EUR</option>
		<option value='USD'>USD</option>
		<option value='GBP'>GBP</option>
		<option value='CAD'>CAD</option>
		<option value='NOK'>NOK</option>
		<option value='ISK'>ISK</option>
		<option value='DKK'>DKK</option>
		<option value='SEK'>SEK</option>
		<option value='CNY'>CNY</option>
		<option value='JPY'>JPY</option>
		<option value='CHF'>CHF</option>
		<option value='RUB'>RUB</option>
		<option value='INR'>INR</option>
	</select>
	<input type='submit' name='submit' value='SUBMIT' />
	<?php
		if(isset($responseTxt)){
			echo '<br /><span style="color:#FF0000;">'.$responseTxt.'</span><br>';
		}
	?>
</div>
</form>

<?php include('footer.php'); ?>

