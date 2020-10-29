<?php
session_start();


$_SESSION['myusername'] = "";
session_destroy();
echo"<script>document.location.href='../index.php';</script>"; //login.php
?>