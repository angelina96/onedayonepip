<?php
//----------------------------------------------------------------------------------
// refreshPortf $sql13 sql14 sql15 sql16
//----------------------------------------------------------------------------------
function refreshPortf($id4rp){
include "../serverdb/server.php";

$done = "clean";
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
$walletb = $infoWALLET['walletb'] + $income ;

$dateNow  = date("Y-m-d H:i:s");

$current  = strtotime($dateNow);
$start    = strtotime($infoRP['created_date']);
$end      = $start + $days;

$progress = (($current - $start) / ($end - $start)) * 100;
$progress = bcdiv($progress,1,2);


if ($progress >= 100){
	$stat 	  = $infoRP['stat'];
	if($stat!="Completed"){
		$result = mysqli_query($conn,"UPDATE invest set stat = 'Completed' WHERE id = '$id4rp' AND sn='$SN'"); 
		if($result){
		$resultwalle = mysqli_query($conn,"UPDATE wallet set walletb = '".$walletb."' WHERE id = '$id4rp'"); 
			if($resultwalle){
				$sql1="INSERT INTO investlog (memberid,amount,income,planname,planroi,planday,walletb) values('".$id4rp."','$amount','$income','PLANNAME','$planroi','$planday','$walletb')";
				$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			}
		}
		$done = "updated";
		}
}
}
return $done;
//return $walletb;
}
?>