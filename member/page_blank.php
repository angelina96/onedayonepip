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
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">TITLE</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/logo_user.png" style="width: 50px;height: 50px;">
	</div>
	
  </div>
  </div>
  </div>


<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="outernormalbox text-center">
        <div class="box-wallet">
          <h1 class="glow1">DOWNLINE</h1>
        </div>
        <div class="paid-out glow3">
DATA KOTAK EXAMPLE
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>