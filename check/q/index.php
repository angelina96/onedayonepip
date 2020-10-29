<?php 
session_start();
$_SESSION['SU'] = "ok";
echo"<script>document.location.href='../bmb.php';</script>";
?> 