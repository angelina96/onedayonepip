<?php
include "../serverdb/server.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

if(isset($_GET['paydate'])) {
$paydate = $_GET['paydate'];
}
else { $paydate=date("Y-m-d"); }

//Header CSV
$list = array (
  array($paydate),
  array("No.","Time", "Member ID", "Full Name", "Bank Holder Name", "Bank", "Account Number", "Amount", "MYR")
);
$i = 0;
//ambik data PO
$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE  W.id=A.userid AND U.id=A.userid AND W.created_date LIKE '$paydate%' AND W.id!='' AND W.typ is NULL ORDER BY U.akaunb ASC") or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$i++;
		$sn = $info['sn'];
		$id = $info['id'];
		$fname = $info['fname'];
		$phone = $info['phone'];
		$amount = $info['amount'];
		$akaunb = $info['akaunb'];
		$penama = $info['penama'];
		$jenisb = $info['jenisb'];
		$stat = $info['stat'];
		$data69 = mysqli_query($conn,"SELECT created_date FROM wd WHERE id='".$id."' AND sn='".$sn."'") or die(mysqli_error($conn));
		$info69 = mysqli_fetch_array( $data69 );
		$time = $info69['created_date'];
		
		$time = strtotime($time);
		$time = date('h:i:sa', $time);
		$myr=$amount*3.7;
		$amount=number_format((float)$amount, 2, '.', '');
		$myr=number_format((float)$myr, 2, '.', '');
	  
array_push ($list ,
  array($i,$time, $id, $fname,$penama,$jenisb,"'".$akaunb,"$ ".$amount,"RM ".$myr)
);

	  
}

//lukis
array_push ($list ,
  
  array("Summary")
); 

$file = fopen("payout.csv","w");

foreach ($list as $line) {
  fputcsv($file, $line);
}

fclose($file);

$filename = "payout.csv";


// Let the browser know that a PDF file is coming.
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="payout '.$paydate.'.csv"');

// Send the file to the browser.
readfile($filename);
exit;
?>