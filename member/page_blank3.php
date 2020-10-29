<?php 
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav2.php";
include "content/minimum.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
?>

<div id="players" class="container-fluid plan-bg-master" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
		<div class="blueline text-center">
			<div class="box-master">
				Title
			</div>
			<div class="paid-out glow3">Content</div>
		</div>
    </div>
  </div>

</div>

<!-- **************FOOTER***************** -->
<?php 
//include "content/footer.php"; 
?>