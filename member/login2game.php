<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

$id4rp=$username;
//$id4rp='yy';include "../serverdb/server.php";

$dataRP = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id4rp' ORDER BY created_date ASC") or die(mysqli_error());
while($infoRP = mysqli_fetch_array( $dataRP )) {

$dataWALLET = mysqli_query($conn,"SELECT walletb FROM wallet WHERE id='$id4rp'") or die(mysqli_error());
$infoWALLET = mysqli_fetch_array( $dataWALLET );
$walletb  = $infoWALLET['walletb'];

$SN   	  = $infoRP['sn'];
$planroi  = $infoRP['planroi'];
$planday  = $infoRP['planday'];
$amount   = $infoRP['amount'];
$counter  = $infoRP['counter'];
$stat 	  = $infoRP['stat'];
$cashback = $infoRP['cashback'];
$days     = $planday * 86400;

$parsent  = (($planroi - 100)/$planday);
$pip = (($amount*$parsent)/100);

$dateNow  = date("Y-m-d H:i:s");
$current  = strtotime($dateNow);
$datestart= $infoRP['created_date'];
$start    = strtotime($infoRP['created_date']);
$end      = $start + $days;

$start  = date("Y-m-d H:i:s",$start);
$end  = date("Y-m-d H:i:s",$end);

$diff = strtotime($dateNow) - strtotime($datestart); 
$dateDiff = abs(round($diff / 86400)); 
if($dateDiff>$planday){$dateDiff =$planday; }

if ($dateNow > $end) { $dateNow = $end; }
$bakihari = $planday - $dateDiff;

if ($bakihari<=0){ $bakihari=0; }

$kalautunggak = $dateDiff - $counter;

if ($kalautunggak!=0){ $pip=$pip*$kalautunggak; } 

//echo $dateDiff."<br>";
//echo $bakihari."<br>";
//echo $kalautunggak;

$lepasdokagi = "salohkire";
if ($dateNow < $end) { $lepasdokagi="dokagi"; } else { $lepasdokagi="lepasdoh"; }

//start
$piptotal = $pip+$walletb;
//tutup lu piptotal kira sama lu blake jgn tambah cashback lagi
//if (($lepasdokagi=="dokagi")&&($stat=="Active")){ $piptotal = $pip+$walletb; }
//else if (($lepasdokagi=="lepasdoh")&&($stat=="Active")){ $piptotal = $pip+$walletb+$amount; }
//end

/* ########### UPDATE STATUS INVEST KE COMPLETED AND CASHBACK DAY PASTU CASHBACK MONEY UPDATE LEPAH NI DLM WALLET ########### */
if (($lepasdokagi=="lepasdoh")&&($stat=="Active")){
//$toto = $walletb+$amount;
$result3 = mysqli_query($conn,"UPDATE invest set stat='Completed', cashback='Y' WHERE id='$id4rp' AND sn='$SN'");
//$result4 = mysqli_query($conn,"UPDATE wallet set walletb = '$toto' WHERE id = '$id4rp'"); 
}

/* ########### UPDATE WALLET DAPATHARINI ########### */
if ($lepasdokagi=="lepasdoh"){ $dapatharini="0"; }
if (($lepasdokagi=="dokagi")||(($lepasdokagi=="lepasdoh")&&($kalautunggak>0))){
$dapatharini = $pip;
if($counter < $dateDiff){
$result = mysqli_query($conn,"UPDATE wallet set walletb='$piptotal' WHERE id='$id4rp'");
}
}
/* ########### UPDATE COUNTER DAY ########### */
$result2 = mysqli_query($conn,"UPDATE invest set counter='$dateDiff' WHERE id='$id4rp' AND sn='$SN'"); 
}
?>