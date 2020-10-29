<?php
session_start();
include "../serverdb/server.php";
$id=$_SESSION["USERPRO"];
$addressbtc= $_POST['addressbtc']; //usdt wallet
$trustwallet = $_POST['trustwallet'];
echo $trustwallet;
$sqlUP="UPDATE userpro set addressbtc = '$addressbtc',trustwallet = '$trustwallet' WHERE id = '$id'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error($conn));

	if($resultUP){
	echo ("<script LANGUAGE='JavaScript'>window.alert('Wallet address updated');window.location.href='page_deposit2.php?f1=update53success53';</script>");
	exit();

	}
	else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_deposit2.php?f1=verify85update4568794323563';</script>"); }
?>