<?php

include "../serverdb/server.php";

$SN = $_GET['SN'];
$ID = $_GET['ID'];
$AM = $_GET['AM'];

if (empty($_POST['AMZ'])) {
//echo "Good Try"; 
$AMZ = 0; 

$sql1="INSERT INTO depolog (id,amount,walletb) values('$ID','$AM','$AMZ')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error());
}
else { $AMZ = $_POST['AMZ']; }

// avoid hacker start
$sql71="SELECT count(id) as avoidhacker from wd WHERE sn='".$SN."' AND id='".$ID."'";
$data71 = mysqli_query($conn,$sql71) or die(mysqli_error($conn));
$info71 = mysqli_fetch_array( $data71 );
$avoidhacker = $info71['avoidhacker'];
if($avoidhacker!=0){

$sql70="SELECT typ from wd WHERE sn='".$SN."' AND id='".$ID."'";
$data70 = mysqli_query($conn,$sql70) or die(mysqli_error($conn));
$info70 = mysqli_fetch_array( $data70 );
$typ = $info70['typ'];

if ($typ==null) {
$sql5="SELECT walletb from wallet WHERE id='$ID'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$whichwallet='walletb';
}
else if($typ=="USDT") {
$sql5="SELECT usdt from wallet WHERE id='$ID'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['usdt'];
$whichwallet='usdt';
}
else { echo "Error Occured. CONTACT ADMIN IMMEDIATELY YOUR ACCOUNT HACKED"; }


//$upb = $balance + $AM;
$upb = $balance + $AMZ;

$sql24="DELETE FROM wd  WHERE sn='".$SN."' AND id='".$ID."'";
$result=mysqli_query($conn,$sql24);

if($result){
	
$sqlUP="UPDATE wallet set ".$whichwallet." = '".$upb."' WHERE id='".$ID."' ";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error($conn));
if($whichwallet=='walletb'){ echo ("<script LANGUAGE='JavaScript'>window.location.href='page_withdrawal.php';</script>"); }
if($whichwallet=='usdt'){ echo ("<script LANGUAGE='JavaScript'>window.location.href='page_withdrawal3.php';</script>"); }
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='index.php';</script>"); }

}/*end avoid hacker shit*/else {echo ("<script LANGUAGE='JavaScript'>window.alert('You already cancelled this with Miss Angelina from Johore');window.location.href='index.php';</script>");}
?>