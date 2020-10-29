<?php
session_start();
include "../serverdb/server.php";

$id = $_POST['id'];
$cpwd= $_POST['cpwd'];
$npwd= $_POST['npwd'];
$rpwd= $_POST['rpwd'];


$sql="SELECT pwd from userpro WHERE id='$id' ";
$data = mysqli_query($conn,$sql);
$info = mysqli_fetch_array( $data );
$dpwd = $info['pwd'];

$dpwd =strtolower($dpwd);
$cpwd =strtolower($cpwd);
$npwd =strtolower($npwd);

//echo $dpwd."-".$cpwd;

if($cpwd!=$dpwd){
	echo ("<script LANGUAGE='JavaScript'>window.alert('Current Password Invalid');window.location.href='page_profile.php?f2=change6765security67896my567account';</script>");
}
else if($npwd!=$rpwd){
	echo ("<script LANGUAGE='JavaScript'>window.alert('Confirm Your New Password');window.location.href='page_profile.php?f2=change6765security67896my567account';</script>");
}
else{
$sqlUP="UPDATE userpro set pwd = '$npwd' WHERE id = '$id'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

	if($resultUP){
	session_destroy();
	echo ("<script LANGUAGE='JavaScript'>window.alert('Password changed!');window.location.href='../index.php?logon=251fgaer7345wr57gg847dhgrhfhr';</script>");
	exit();

	}
	else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_profile.php?f2=change6765security67896my567account';</script>"); }
}

?>