<?php

$sql6="SELECT mininv from masterctrl ORDER BY created_date DESC LIMIT 1";
$data6 = mysqli_query($conn,$sql6) or die(mysqli_error($conn));
$info6 = mysqli_fetch_array( $data6 );
$minimum = $info6['mininv'];

$sql7="SELECT minwd from masterctrl ORDER BY created_date DESC LIMIT 1";
$data7 = mysqli_query($conn,$sql7) or die(mysqli_error($conn));
$info7 = mysqli_fetch_array( $data7 );
$minimum2 = $info7['minwd'];

?>