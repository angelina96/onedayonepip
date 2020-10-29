<?php
include "../serverdb/server.php";
//include "functions.php";

$sn = $_GET['sn'];

$sql="DELETE FROM btcdepo WHERE sn='".$sn."'";
$result=mysqli_query($conn,$sql);

if($result){
	
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_deposit.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_deposit2.php';</script>"); }

?>