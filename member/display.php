<?php
include "../serverdb/server.php";

$paydate=date("Y-m-d");
$sql48="SELECT SUM(amount) AS totalbo from walletlog WHERE created_date LIKE '$paydate%' AND trc='Deposit' ";
$data48 = mysqli_query($conn,$sql48) or die(mysqli_error($conn));
$info48 = mysqli_fetch_array( $data48 );
$totalbo = $info48['totalbo'];
$totalbo=number_format((float)$totalbo, 2, '.', '');
echo $totalbo;



$begin = new DateTime('2010-05-01');
$end = new DateTime('2010-05-10');

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {
    echo $dt->format("l Y-m-d H:i:s\n");
}
?>