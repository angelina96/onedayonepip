<?php
include "../serverdb/server.php";

$username= $_POST['username'];
// [1] Cek siapa leader dulu
$upline = $_POST['upline'];
$data = mysqli_query($conn,"SELECT * FROM affiliate WHERE userid='".$upline."'") or die(mysqli_error($conn));
$info = mysqli_fetch_array( $data );
$lp_master = $info['leader'];
if($lp_master==null){
$lp_master="NULL";
$upline="INVALID_".$upline;
$akaun='MEMBER';
}
else if($lp_master=="MASTER"){ $lp_master=$username; $akaun='LP'; }
else { $akaun='MEMBER'; }
// [2] baru register
$fname = $_POST['fname'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$imageData = mysqli_real_escape_string($conn,file_get_contents($_FILES["userkp"]["tmp_name"]));

$sql="INSERT INTO userpro (id,fname,email,pwd,akaun,ipaddress,image) values('$username','$fname','$email','$pwd','$akaun','$ipaddress','$imageData')";

//$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
$result=mysqli_query($conn,$sql) or exit("<span style='padding-left:10px;'>Make sure you upload a smaller size of picture</span>");

if($result){
//echo "<script>alert('Success!');document.location.href='page_register.php';</script>";
$sql2="INSERT INTO wallet (id,walletb,walletc,earning) values ('".$username."','0','0','0')";
$result2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
if($result2){
	
$sql3="INSERT INTO affiliate (upline,userid,leader) values('".$upline."','".$username."','".$lp_master."')";
$result3=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
if($result3){
echo ("<script LANGUAGE='JavaScript'>window.alert('Your Account Registered!');window.location.href='../index.php';</script>");
}
}
}
else 
{
echo "your picture is not uploaded ";
}
?>