<?php
include "../serverdb/server.php";

$id = $_GET['id'];
$v = $_GET['v'];

$sql39="UPDATE userpro set verifymel = '$v' WHERE id = '$id'";
$result39=mysqli_query($conn,$sql39) or die(mysqli_error());

	if($result39){
	echo ("<script LANGUAGE='JavaScript'>window.location.href='page_approve.php';</script>");
	exit();

	}
	else { echo ("<script LANGUAGE='JavaScript'>window.location.href='page_approve.php';</script>"); }
?>