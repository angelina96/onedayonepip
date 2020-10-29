<?php
include "../serverdb/server.php";
include "functions.php";
session_start();
$token1 = $_SESSION['TOKEN'];

$id = $_POST['id'];
$amount= $_POST['amount'];
$walletb = $_POST['walletb'];
$walletb = $walletb - $amount;

$q1 = $_POST['q1'];

if($token1=="go"){
$_SESSION['TOKEN']="no";
/*
$dataTOKENZ = mysqli_query($conn,"SELECT tokenz FROM wallet WHERE id='$id'") or die(mysqli_error());
$infoTOKENZ = mysqli_fetch_array( $dataTOKENZ );
$tokenb  = $infoTOKENZ['tokenz']; 
include "bontoken.php";
*/

$sql8 ="SELECT count(sn) as mysn FROM investusdt WHERE id='$id'";
$data8 = mysqli_query($conn,$sql8) or die(mysqli_error());
$info8 = mysqli_fetch_array( $data8 );
$sn = $info8['mysn'];
$sn=$sn+1;

//$sql9 = "SELECT * FROM masterctrl ORDER BY created_date DESC LIMIT 1";
$sql9 = "SELECT * FROM masterctrl WHERE planname='$q1' ORDER BY created_date DESC LIMIT 1";
$data9 = mysqli_query($conn,$sql9) or die(mysqli_error());
$info9 = mysqli_fetch_array( $data9 );
$planroi = $info9['planroi'];
$planday = $info9['planday'];
$planname = $info9['planname'];
$plantype = $info9['plantype'];

$sql10="UPDATE wallet set usdt='$walletb' WHERE id='$id'";
//$sql10="INSERT INTO invest (sn,id,amount,planname,planroi,planday,plantype,stat) values('$sn','$id','$amount','$planname','$planroi','$planday','$plantype','Active')";
$result=mysqli_query($conn,$sql10) or die(mysqli_error($conn));

if($result){

$sql11="INSERT INTO investusdt (sn,id,amount,planname,planroi,planday,plantype,stat) values('$sn','$id','$amount','$planname','$planroi','$planday','$plantype','Active')";
//$sql11="UPDATE wallet set walletb='$walletb' WHERE id='$id'";
$resultUP=mysqli_query($conn,$sql11) or die(mysqli_error());

	if($resultUP){ //deletethismeoo
	include "meo.php";
	//echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>"); 
} //deletethismeoo

/* #kalau err resultUP : update wallet# */
	else { echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=decline';</script>"); }
	
}
/* #kalau err insert dlm invest# */
//else { echo "error"; }
}
else if($token1=="re"){ echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>"); exit(); }
else { echo "We've detected you've lost network connection. Please use back button and refresh"; $_SESSION['TOKEN']="re"; }
?>