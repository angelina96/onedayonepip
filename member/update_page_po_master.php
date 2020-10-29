<?php
include "../serverdb/server.php";

$sn = $_POST['sn'];
$id = $_POST['id'];
$amount = $_POST['amount'];
$stat = $_POST['stat'];
if($stat=="Processing"){ $completed="Completed"; }
else{ $completed="Completed_Token"; }


$sqlUP2="UPDATE wd set stat = '".$completed."' WHERE id='".$id."' AND sn='".$sn."'";
$resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error($conn));

$sql70="SELECT typ from wd WHERE sn='".$sn."' AND id='".$id."'";
$data70 = mysqli_query($conn,$sql70) or die(mysqli_error($conn));
$info70 = mysqli_fetch_array( $data70 );
$typ = $info70['typ'];

if($resultUP2){
	
if ($typ==null) { echo ("<script LANGUAGE='JavaScript'>window.alert('Paid to ".$id."');window.location.href='page_po_master.php';</script>"); }
if ($typ=='USDT') { echo ("<script LANGUAGE='JavaScript'>window.alert('Paid to ".$id."');window.location.href='page_po_master2.php';</script>"); }

exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_po_master.php';</script>"); }

?>