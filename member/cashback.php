<?php
//$id4rp='yy';
$id4rp=$username;
//include "../serverdb/server.php";
//date_default_timezone_set('Asia/Kuala_Lumpur');
$walletb = 0;
$amount = 0;

$dataWALLET = mysqli_query($conn,"SELECT walletb FROM wallet WHERE id='$id4rp'") or die(mysqli_error($conn));
$infoWALLET = mysqli_fetch_array( $dataWALLET );
$walletb  = $infoWALLET['walletb'];

$sql51="SELECT * FROM invest WHERE id='$id4rp' AND cashback='Y' ORDER BY created_date ASC";
$data51 = mysqli_query($conn,$sql51) or die(mysqli_error($conn));
while($info51 = mysqli_fetch_array($data51)) {

	//kira date cap back 
	$planday51= $info51['planday'];
	//esok hari
	$planday51= $planday51; 
	$days51   = $planday51 * 86400;
	//sekarang
	$dateNow51= date("Y-m-d H:i:s");
	$current51= strtotime($dateNow51);
	
	$start51  = strtotime($info51['created_date']);
	$end51      = $start51 + $days51;
	//$end51  = date("Y-m-d H:i:s",$end51);
	//$current51  = date("Y-m-d H:i:s",$current51);

	//total wallet dgn cashback
	$sn=$info51['sn'];
	$amount=$info51['amount'];
	$walletb=$walletb+$amount;
	//$walletb=(((int)$walletb)+((int)$amount));

	if($current51>$end51){
	$result51 = mysqli_query($conn,"UPDATE wallet set walletb='$walletb' WHERE id='$id4rp'") or die(mysqli_error($conn));
	$result2 = mysqli_query($conn,"UPDATE invest set cashback='DONE' WHERE id='$id4rp' and sn='$sn'");
	}
}
?>