<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

$id4rp60=$username;
//$id4rp='yy';include "../serverdb/server.php";

$dataRP60 = mysqli_query($conn,"SELECT * FROM investusdt WHERE id='$id4rp60' ORDER BY created_date ASC") or die(mysqli_error());
while($infoRP60 = mysqli_fetch_array( $dataRP60 )) {

$dataWALLET60 = mysqli_query($conn,"SELECT usdt FROM wallet WHERE id='$id4rp60'") or die(mysqli_error());
$infoWALLET60 = mysqli_fetch_array( $dataWALLET60 );
$walletb60  = $infoWALLET60['usdt'];

$SN60   	  = $infoRP60['sn'];
$planroi60  = $infoRP60['planroi'];
$planday60  = $infoRP60['planday'];
$amount60   = $infoRP60['amount'];
$counter60  = $infoRP60['counter'];
$stat60	  = $infoRP60['stat'];
$cashback60 = $infoRP60['cashback'];
$days60     = $planday60 * 86400;

$parsent60  = (($planroi60 - 100)/$planday60);
$pip60 = (($amount60*$parsent60)/100);

$dateNow60  = date("Y-m-d H:i:s");
$current60  = strtotime($dateNow60);
$datestart60= $infoRP60['created_date'];
$start60    = strtotime($infoRP60['created_date']);
$end60      = $start60 + $days60;

$start60  = date("Y-m-d H:i:s",$start60);
$end60  = date("Y-m-d H:i:s",$end60);

$diff60 = strtotime($dateNow60) - strtotime($datestart60); 
$dateDiff60 = abs(round($diff60 / 86400)); 
if($dateDiff60>$planday60){$dateDiff60 =$planday60; }

if ($dateNow60 > $end60) { $dateNow60 = $end60; }
$bakihari60 = $planday60 - $dateDiff60;

if ($bakihari60<=0){ $bakihari60=0; }

$kalautunggak60 = $dateDiff60 - $counter60;

if ($kalautunggak60!=0){ $pip60=$pip60*$kalautunggak60; } 

//echo $dateDiff."<br>";
//echo $bakihari."<br>";
//echo $kalautunggak;

$lepasdokagi60 = "salohkire";
if ($dateNow60 < $end60) { $lepasdokagi60="dokagi"; } else { $lepasdokagi60="lepasdoh"; }

//start
$piptotal60 = $pip60+$walletb60;
//tutup lu piptotal kira sama lu blake jgn tambah cashback lagi
//if (($lepasdokagi=="dokagi")&&($stat=="Active")){ $piptotal = $pip+$walletb; }
//else if (($lepasdokagi=="lepasdoh")&&($stat=="Active")){ $piptotal = $pip+$walletb+$amount; }
//end

/* ########### UPDATE STATUS INVEST KE COMPLETED AND CASHBACK DAY PASTU CASHBACK MONEY UPDATE LEPAH NI DLM WALLET ########### */
if (($lepasdokagi60=="lepasdoh")&&($stat60=="Active")){
//$toto = $walletb+$amount;
$result360 = mysqli_query($conn,"UPDATE investusdt set stat='Completed', cashback='Y' WHERE id='$id4rp60' AND sn='$SN60'");
//$result4 = mysqli_query($conn,"UPDATE wallet set walletb = '$toto' WHERE id = '$id4rp'"); 
}

/* ########### UPDATE WALLET DAPATHARINI ########### */
if ($lepasdokagi60=="lepasdoh"){ $dapatharini60="0"; }
if (($lepasdokagi60=="dokagi")||(($lepasdokagi60=="lepasdoh")&&($kalautunggak60>0))){
$dapatharini60 = $pip60;
if($counter60 < $dateDiff60){
$result60 = mysqli_query($conn,"UPDATE wallet set usdt='$piptotal60' WHERE id='$id4rp60'");
}
}
/* ########### UPDATE COUNTER DAY ########### */
$result260 = mysqli_query($conn,"UPDATE investusdt set counter='$dateDiff60' WHERE id='$id4rp60' AND sn='$SN60'"); 
}
?>