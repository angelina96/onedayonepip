<?php
$url = 'https://bitpay.com/api/rates';
$json= json_decode(file_get_contents($url));
$dollar = 
$bch = 
$usd = 
$eur = 
$gbp = 
$jpy = 
$cad = 
$aud = 
$cny = 
$nzd = 
0;

foreach($json as $obj){
	if($obj->code=='BCH') { $bch = $obj->rate; }
	if($obj->code=='USD') { $usd = $obj->rate; }
	if($obj->code=='EUR') { $eur = $obj->rate; }
	if($obj->code=='GBP') { $gbp = $obj->rate; }
	if($obj->code=='JPY') { $jpy = $obj->rate; }
	if($obj->code=='CAD') { $cad = $obj->rate; }
	if($obj->code=='AUD') { $aud = $obj->rate; }
	if($obj->code=='CNY') { $cny = $obj->rate; }
	if($obj->code=='NZD') { $nzd = $obj->rate; }
}

//echo '1 bitcoin = $'. $btc .'USD';
//$btcusd   = number_format("".$btc  ."",2)."";
//echo $EUR;
?>