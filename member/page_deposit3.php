<?php
include "../serverdb/server.php";


$id = $_POST['id'];
$amount = $_POST['amountx'];
$cointype = $_POST['cointype'];


$sql1="INSERT INTO btcdepo (memberid,amount,stat,cointype) values('$id','$amount','Processing','$cointype')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));

if($result){
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_deposit.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Network error.. Please Try Again.');window.location.href='page_deposit2.php';</script>"); }

?>