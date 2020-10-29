<?php
include "../serverdb/server.php";
$status = $_POST['status'];
$sn = $_POST['sn'];
$id = $_POST['id'];

if ($status=="1"){ $stat="Processing"; }
if ($status=="2"){ $stat="Completed"; }
//echo $status."-".$sn."-".$id;

//if($stat=="Processing"){ $completed="Completed"; }
//else{ $completed="Completed_Token"; }


$sqlUP2="UPDATE wd set stat = '".$stat."' WHERE id='".$id."' AND sn='".$sn."'";
$resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error($conn));

$sql70="SELECT typ from wd WHERE sn='".$sn."' AND id='".$id."'";
$data70 = mysqli_query($conn,$sql70) or die(mysqli_error($conn));
$info70 = mysqli_fetch_array( $data70 );
$typ = $info70['typ'];

if($resultUP2){
	
	if($status=="2"){
	echo "Paid to ".$id."!"; 
	}
	if($status=="1"){
	echo "UNPAID to ".$id."!!"; 
	}
	//if ($typ==null) { echo ("<script LANGUAGE='JavaScript'>window.alert('Paid to ".$id."');window.location.href='page_po_agent.php';</script>"); }
	//if ($typ=='USDT') { echo ("<script LANGUAGE='JavaScript'>window.alert('Paid to ".$id."');window.location.href='page_po_agent.php';</script>"); }
exit();
}
else { 
	echo "Error : UnPaid to ".$id."!"; 
}

?>