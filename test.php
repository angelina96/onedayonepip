<?php
/*
$progress = ((0 - 0) / (0 - 0)) * 100;
$progress = bcdiv($progress,1,2);
echo $progress; */
include "serverdb/server.php";
$id4rp="waja";

$dataRP = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id4rp' ORDER BY created_date ASC") or die(mysqli_error());
while($infoRP = mysqli_fetch_array( $dataRP )) {

date_default_timezone_set('Asia/Kuala_Lumpur');

$dataWALLET = mysqli_query($conn,"SELECT walletb FROM wallet WHERE id='$id4rp'") or die(mysqli_error());
$infoWALLET = mysqli_fetch_array( $dataWALLET );
//$walletb  = $infoWALLET['walletb'];

$SN   	  = $infoRP['sn'];
$planroi  = $infoRP['planroi'];
$planday  = $infoRP['planday'];
$amount   = $infoRP['amount'];
$days     = $planday * 86400;

$income   = (($amount*$planroi)/100);  
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$walletb  = $infoWALLET['walletb'] + $income ;

$dateNow  = date("Y-m-d H:i:s");

$current  = strtotime($dateNow);
$start    = strtotime($infoRP['created_date']);
$end      = $start + $days;

// echo $current."a<br>";
// echo $start."b<br>";
// echo $end."c<br>";
 echo $start."datesaat<br>";
 echo $days."dayssaat<br>";
//echo $end - $start;

$progress = (($current - $start) / ($end - $start)) * 100;
$progress = bcdiv($progress,1,2);
}


?>