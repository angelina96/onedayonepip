<?php
include "../serverdb/server.php";
session_start();
$token1 = $_SESSION['TOKEN'];

if($token1=="go"){
$_SESSION['TOKEN']="no";

$id = $_POST['id'];
$amount= $_POST['amount'];
//$pwd= $_POST['pwd'];
$walletb = $_POST['walletb'];
$walletb = $walletb - $amount;

$sql20="SELECT max(sn) as mysn FROM wd WHERE id='$id'";
$data20 = mysqli_query($conn,$sql20) or die(mysqli_error());
         
$info20 = mysqli_fetch_array( $data20 );
$sn = $info20['mysn'];
$sn=$sn+1;

$sql21="INSERT INTO wd (sn,id,amount,typ,stat) values('$sn','$id','$amount','USDT','Processing')";
$result21=mysqli_query($conn,$sql21) or die(mysqli_error($conn));

if($result21){ //$sql22
$sqlUP="UPDATE wallet set usdt = '$walletb' WHERE id = '$id'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

	if($resultUP){
	echo ("<script LANGUAGE='JavaScript'>window.location.href='page_withdrawal3.php?status=inprocess';</script>");
	exit();
	}else { echo ("<script LANGUAGE='JavaScript'>window.location.href='page_withdrawal3.php?status=fail';</script>"); }
}
else { echo "error"; }


}
else if($token1=="re"){ echo ("<script LANGUAGE='JavaScript'>window.location.href='page_withdrawal3.php';</script>"); exit(); }
else { echo "We've detected you've lost network connection. Please use back button and refresh"; $_SESSION['TOKEN']="re"; }
?>