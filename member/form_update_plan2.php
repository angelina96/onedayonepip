<?php
include "../serverdb/server.php";

$planname = $_POST['planname'];
$planroi = $_POST['planroi'];
$planday = $_POST['planday'];
$mininv = $_POST['mininv'];
$minwd = $_POST['minwd'];;
$plantype = $_POST['plantype'];;





$sql1="INSERT INTO masterctrl (planname,mininv,minwd,planroi,planday,plantype) values('$planname','$mininv','$minwd','$planroi','$planday','$plantype')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error());

if($result){
echo ("<script LANGUAGE='JavaScript'>window.location.href='index_master.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Network error.. Please Try Again.');window.location.href='index_master.php';</script>"); }

?>