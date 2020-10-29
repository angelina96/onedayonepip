<?php
session_start();

if(isset($_GET['id'])) {
$getje = $_GET['id'];
$_SESSION['USERPRO'] = $getje;
$_SESSION['USER_TYPER'] = "MEMBER";
}
else {
	echo"<script>document.location.href='bms.php?id=shahrul8k';</script>";
}

?>
<a href="https://onedayonepip.trade/member/index.php" target="blank"><button>Lets Go!</button></a><br>
<a href="http://localhost/oppo/member/" target="blank"><button>localhost</button></a>