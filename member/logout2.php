<?php
session_start();


$_SESSION['myusername'] = "";
session_destroy();
echo"<script>alert('You have been logged out due to inactivity in 5 MINUTES');document.location.href='../index.php';</script>"; //login.php
?>