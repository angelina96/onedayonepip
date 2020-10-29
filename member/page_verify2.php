<?php
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
include "../serverdb/server.php";

$id = $_POST['id'];
$fname= $_POST['fname'];
$imageData = mysqli_real_escape_string($conn,file_get_contents($_FILES["userkp"]["tmp_name"]));

if ($imageData!=null){

$sqlUP="UPDATE userpro set fname = '$fname', image='$imageData', verifymel='N' WHERE id = '$id'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error($conn));

	if($resultUP){
	echo ("<script LANGUAGE='JavaScript'>window.location.href='index.php?verifi=43059346747davse54609sfgdf';</script>");
	exit();

	}
	else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_referral.php';</script>"); }
}
else { 
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_verify.php?fault=img';</script>"); }
?>