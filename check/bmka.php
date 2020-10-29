
<?php
$i=1;
include "../serverdb/server.php";
include "../member/functions.php";
$i='1';
$data = mysqli_query($conn,"SELECT * FROM userpro WHERE akaun!='MASTER' AND verifymel='Y' ORDER BY created_date DESC") or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$id   = $info['id'];

include "bmka2.php";
//include "bmka2.php?id=".$id."";

$i++; 
echo $id;
}
	
function getTotal1($siapa) {
include "../serverdb/server.php";
$sql3="SELECT SUM(amount) as haha from invest WHERE id='$siapa'";
$data3 = mysqli_query($conn,$sql3) or die(mysqli_error());
$info3 = mysqli_fetch_array( $data3 );
$totalinvest=$info3['haha'];
if($totalinvest!=null){
return $totalinvest;
}
else { return 0;}
}	
?>