<?php
session_start();
include "../serverdb/server.php";

$lp_id = $_SESSION['USERPRO'];
$sn = $_POST['sn'];
$id = $_POST['id'];
$amount = $_POST['amount'];
$walletpo = $_POST['walletpo'];
$stat = $_POST['stat'];
if($stat=="Processing"){ $completed="Completed"; }
else{ $completed="Completed_Token"; }

$sql="SELECT walletpo from wallet WHERE id='".$lp_id."'";
$data = mysqli_query($conn,$sql);
$info = mysqli_fetch_array( $data );
$walletpo = $info['walletpo'];

$walletpo=$walletpo-$amount;

$sqlUP="UPDATE wallet set walletpo = '".$walletpo."' WHERE id='".$lp_id."'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error($conn));

$sqlUP2="UPDATE wd set stat = '".$completed."' WHERE id='".$id."' AND sn='".$sn."'";
$resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error($conn));

//takyah sebab dah tolak masa request wd
// $sqlUP2="UPDATE wd set stat = 'Completed' WHERE id='".$id."' AND sn='".$sn."'";
// $resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error());

if(($resultUP)&&($resultUP2)){
echo ("<script LANGUAGE='JavaScript'>window.alert('Paid to ".$id."');window.location.href='page_po.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_po.php';</script>"); }

?>