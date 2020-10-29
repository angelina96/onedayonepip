<?php

include "../serverdb/server.php";
//include "functions.php";

$memberid = $_POST['memberid'];
$sn = $_POST['sn'];
$point = $_POST['point'];
$walletb = $_POST['walletb'];
$total = $walletb+$point;

$data2 = mysqli_query($conn,"SELECT earning FROM wallet WHERE id='$memberid'") or die(mysqli_error());
$info2 = mysqli_fetch_array( $data2 );
$earningbtc = $info2['earning'];
$earningbtc = $earningbtc+$point;

$sqlUP="UPDATE wallet set earning = '$earningbtc' WHERE id='$memberid'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

if($resultUP){
	

/* MASUK DALAM DATA INVEST YANG MASTER CONFIRM */
//AMIK PLAN BTC HARINI
date_default_timezone_set('Asia/Kuala_Lumpur');
$dateNow  = date("Y-m-d H:i:s");
$dateSelect  = date("Y-m-d");
$dataP2_B = mysqli_query($conn,"SELECT * from masterctrl2 WHERE created_date LIKE '".$dateSelect."%' AND plantype='BTC' ORDER BY created_date DESC LIMIT 1") or die(mysqli_error($conn));
$infoP2_B = mysqli_fetch_array( $dataP2_B );
$planname_B  = $infoP2_B['planname'];
$planroi_B   = $infoP2_B['planroi'];
$planday_B   = $infoP2_B['planday'];
/*KIRA TARIKH PO*/
$current_B  = strtotime($dateNow);
$days_B     = $planday_B * 86400;
$payday_B   = $current_B + $days_B;
$payday_B 	 = date('Y-m-d H:i:s', $payday_B);


$sql1="INSERT INTO walletlog (memberid,amount,walletb) values('$memberid','".$point." BTC','$total')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error());

$sql2="UPDATE btcdepo set stat = 'Active',payout_date = '$payday_B' WHERE sn='$sn'";
$result2=mysqli_query($conn,$sql2) or die(mysqli_error());

//MASUK
$sql3="INSERT INTO investbtc (sn,id,amount,planname,planroi,planday,stat) values('$sn','$memberid','$point','$planname_B','$planroi_B','$planday_B','Active')";
$result=mysqli_query($conn,$sql3) or die(mysqli_error($conn));

//bagi bonus 10%
$sepuluh = getAffiliateLV1($memberid);
$status10 = cekAktifTak($sepuluh);

if ($status10 =="Active"){
$bonus10 = ($point * 0.1);
$sql10="UPDATE wallet set bonusbtc = '$bonus10' WHERE id='$sepuluh'";
$result10=mysqli_query($conn,$sql10) or die(mysqli_error($conn));
}

echo ("<script LANGUAGE='JavaScript'>window.location.href='page_players_send_point_btc.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_players_send_point_btc.php';</script>"); }

?>