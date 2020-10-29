<?php
include "../serverdb/server.php";

$userid = $_POST['userid'];

$sql33="SELECT id FROM userpro WHERE id='$userid'";
$data33 = mysqli_query($conn,$sql33) or die(mysqli_error($conn));
$info33 = mysqli_fetch_array( $data33 );
$id = $info33['id'];


if($id==null){
$code="Username ".$userid." is not exist";
echo "<script LANGUAGE='JavaScript'>window.location.href='page_paywallet.php?userid=".$userid."&code=".$code."';</script>";
}
else {
	echo "<script LANGUAGE='JavaScript'>window.location.href='page_paywallet.php?userid=".$id."&cekuser=ok';</script>";
	}

/*if($id!=null){
	$getTotalInvestPrime = getTotalInvestPrime($id);
	if($getTotalInvestPrime==null){
		$code="Username ".$userid." did not subscribe PRIME PLAN today";
		echo "<script LANGUAGE='JavaScript'>window.location.href='page_players_send_token.php?userid=".$userid."&code=".$code."';</script>";
	}
	else {
	//echo "<script LANGUAGE='JavaScript'>window.alert('Successfull !');window.location.href='page_players_send_token.php?userid=';</script>";
	echo "<script LANGUAGE='JavaScript'>window.location.href='page_players_send_token.php?userid=".$userid."&cekuser=ok';</script>";
	}
} */



?>