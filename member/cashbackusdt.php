<?php
//$id4rp='yy';
$id4rp123=$username;
//include "../serverdb/server.php";
//date_default_timezone_set('Asia/Kuala_Lumpur');
$usdt = 0;
$amount123 = 0;

$dataWALLET = mysqli_query($conn,"SELECT usdt FROM wallet WHERE id='$id4rp123'") or die(mysqli_error($conn));
$infoWALLET = mysqli_fetch_array( $dataWALLET );
$usdt  = $infoWALLET['usdt'];

$sql59="SELECT * FROM investusdt WHERE id='$id4rp123' AND cashback='Y' ORDER BY created_date ASC";
$data59 = mysqli_query($conn,$sql59) or die(mysqli_error($conn));
while($info59 = mysqli_fetch_array($data59)) {

	//kira date cap back 
	$planday59= $info59['planday'];
	//esok hari
	$planday59= $planday59; 
	$days59   = $planday59 * 86400;
	//sekarang
	$dateNow59= date("Y-m-d H:i:s");
	$current59= strtotime($dateNow59);
	
	$start59  = strtotime($info59['created_date']);
	$end59      = $start59 + $days59;
	//$end51  = date("Y-m-d H:i:s",$end51);
	//$current51  = date("Y-m-d H:i:s",$current51);

	//total wallet dgn cashback
	$sn59=$info59['sn'];
	$amount123=$info59['amount'];
	$usdt=$usdt+$amount123;
	//$usdt=(((int)$usdt)+((int)$amount));

	if($current59>$end59){
	$result51 = mysqli_query($conn,"UPDATE wallet set usdt='$usdt' WHERE id='$id4rp'") or die(mysqli_error($conn));
	$result2 = mysqli_query($conn,"UPDATE investusdt set cashback='DONE' WHERE id='$id4rp123' and sn='$sn59'");
	}
}
?>