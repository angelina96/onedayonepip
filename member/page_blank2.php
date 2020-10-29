<?php 
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
?>

<div id="players" class="container-fluid plan-bg" style="min-height:80vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
		<div class="outernormalbox text-center">
			<div class="box-wallet">
				Title
			</div>
			<div class="paid-out glow3">Content</div>
		</div>
    </div>
  </div>

</div>

<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>