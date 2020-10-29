<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$sql23="SELECT * from userpro WHERE id='$username'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$akaunbb = $info23['akaunb'];
$getPhoneNo  = $info23['phone'];
 //condition 1
 if(is_numeric($getPhoneNo)){ $cekfon = 'Y'; } else { $cekfon = 'X'; }
 //condition 2
 if($akaunbb==null){ $disabled="disabled";}
 else if($cekfon == 'X'){ $disabled="disabled"; }
 else {
	//$timenow = date("H:i:sa");
	$timenow = date("H");
	if(($timenow>7)&&($timenow<15)){ $disabled=null; $wd="on"; }
	else {$disabled="disabled"; $wd="off";} 
  }
 
$sql5="SELECT walletb from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$balance=number_format((float)$balance, 2, '.', '');
?>


<?php

$f1='style="display: none"';
$f2='style="display: none"';

if(isset($_GET['f1'])) {
$f1='';
$f2='style="display: none"';
$f3='style="display: none"';
}
if(isset($_GET['f2'])) {
$f2='';
$f1='style="display: none"';
$f3='style="display: none"';
}
if(isset($_GET['f3'])) {
$f3='';
$f1='style="display: none"';
$f2='style="display: none"';
}

?>

<div id="players" class="container-fluid plan-bg" style="height:90vh">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="paid-out glow3">
		<div <?=$f1?> >
		<?php include "form_update_profile.php"; ?>
		</div>
		<div <?=$f2?> >
		<?php include "form_change_password.php"; ?>
	    </div>
		<div <?=$f3?> >
		<?php include "form_trustwallet.php"; ?>
	    </div>
        </div>
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>