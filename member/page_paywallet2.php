<?php
include "../serverdb/server.php";
session_start();
$lp = $_SESSION["USERPRO"];

$userid = $_POST['userid'];
$amount = $_POST['amount'];

$sql34="SELECT walletb FROM wallet WHERE id='$userid'";
$data34 = mysqli_query($conn,$sql34) or die(mysqli_error($conn));
$info34 = mysqli_fetch_array( $data34 );
$walletb = $info34['walletb'];
$topup = $walletb+$amount;

$sql35="SELECT walletc FROM wallet WHERE id='$lp'";
$data35 = mysqli_query($conn,$sql35) or die(mysqli_error($conn));
$info35 = mysqli_fetch_array( $data35 );
$walletc = $info35['walletc'];
$deduct = $walletc - $amount;

$sqlUP="UPDATE wallet set walletb = '$topup' WHERE id='$userid'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

$sqlUP35="UPDATE wallet set walletc = '$deduct' WHERE id='$lp'";
$resultUP35=mysqli_query($conn,$sqlUP35) or die(mysqli_error());

if(($resultUP)&&($resultUP35)){

$sql1="INSERT INTO walletlog (memberid,amount, walletb, sender, trc) values('$userid','$amount','$walletb','$lp', 'Deposit')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));

echo ("<script LANGUAGE='JavaScript'>window.location.href='page_paywallet.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_paywallet.php';</script>"); }

?>