<?php

include "../serverdb/server.php";
$userid = $_POST['memberid'];
$amount = $_POST['point'];
$sn = $_POST['sn'];

$sql34="SELECT usdt FROM wallet WHERE id='$userid'";
$data34 = mysqli_query($conn,$sql34) or die(mysqli_error($conn));
$info34 = mysqli_fetch_array( $data34 );

$usdt = $info34['usdt'];
$topup = $usdt+$amount;

$sqlUP="UPDATE wallet set usdt = '$topup' WHERE id='$userid'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error($conn));


$sqlUP2="UPDATE btcdepo set stat = 'Paid' WHERE memberid='$userid' AND sn='$sn' ";
$resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error($conn));

if(($resultUP)&&($resultUP2)){
$sql1="INSERT INTO walletlog (memberid,amount, sender, trc) values('$userid','$amount','$sn', 'USDT')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_report3.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_report3.php';</script>"); }
?>