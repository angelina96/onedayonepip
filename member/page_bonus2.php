<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";


$sql5="SELECT walletb from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$balance=number_format((float)$balance, 2, '.', '');
?>
<?php /*
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">

	<div class="box-welcome2">
		<img src="images/logo_dollar.png" style="width: 50px;height: 50px;">
		<h5 class="glow4">YOUR BALANCE</h5>
		<h1 class="glow3">$ <?=$balance?></h1>
	</div>
	<h5 class="glow4">[ <?=$username?> ]</h5>
	
	<?php include "../alert/alert2.php"; ?>
  </div>
  </div>
<?php include "bubble.php"; ?>
</div> */ ?>


<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
	<h3 class="glow3">Bonus History</h3>
	<div class="box-welcome2">
		<!--<h5 class="glow4">YOUR BALANCE</h5>
		<h1 class="glow3">$ <?=$balance?></h1>-->
	</div>
	<CENTER><a href="page_invest.php" class="btn btn-danger  btn-sm"><i class="glyphicon glyphicon-gift"></i>&nbsp;REINVEST</a></CENTER><BR>
<?php
$sql53="SELECT count(memberid) as merc FROM walletlog WHERE memberid='$_SESSION[USERPRO]' AND (trc='B1' OR trc='B2' OR trc='B3')";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];
if($merc>0){
?>
      <div class="outernormalbox text-center">

        <div class="paid-out glow3">
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$TART -->
		  <div class="table-responsive"> 
          <table class="table" style="width:100%; text-align:left;" border="1">
		  <!--<tr>
			<td>Amount</td>
			<td>Description</td>
			<td>Date Received</td>
		  </tr>-->
<?php 
$sql49="SELECT * FROM walletlog WHERE memberid='$_SESSION[USERPRO]' AND (trc='B1' OR trc='B2' OR trc='B3' OR trc='B1USDT' OR trc='B2USDT' OR trc='B3USDT')";
$data49 = mysqli_query($conn,$sql49) or die(mysqli_error());
while($info49 = mysqli_fetch_array( $data49 )) {
	$dateho = $info49['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);
	$bxx = $info49['trc'];
	$sender49 = $info49['sender'];
	if ($bxx=="B1"){ $bbl="Bonus Level 1 Received"; }
	if ($bxx=="B2"){ $bbl="Bonus Level 2 Received"; }
	if ($bxx=="B3"){ $bbl="Bonus Level 3 Received"; }
	if ($bxx=="B1USDT"){ $bbl="Bonus USDT Level 1 Received"; }
	if ($bxx=="B2USDT"){ $bbl="Bonus USDT Level 2 Received"; }
	if ($bxx=="B3USDT"){ $bbl="Bonus USDT Level 3 Received"; }
	$amount49=$info49['amount'];
	$amount49=number_format((float)$amount49, 2, '.', '');
?>
		  <tr style="border-bottom: 1px solid #f4511e;">
		  <td style="width:200px;">
		  <font style="color:#7CFC00;"><?=$bbl?></font><br>
		  <font style="color:#0cbfe9;font-size:11px;"><?=$dateho?><br><?=$masaho?></font><br>
		  <font style="color:#FD5F00;font-size:10px;"><?=$sender49?></font><br>
		  </td>
		  <td style="width:200px;color:yellow;">$<?=$amount49?></td>
		  </tr>
		  <?php } ?>
          </table>
          </div>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
	  <?php } else { echo "<h5 class='glow4'>Bonus</h5>"; } ?>
	  
	  
<div class="outernormalbox text-center">
<div class="paid-out glow3">
<div class="table-responsive"> 
<?php include "daily_bonus.php"; ?>
</div></div></div>
	  
    </div>
  </div>
</div>

<script type="text/javascript" src="cekdata.js"></script>
<?php include "content/footer.php"; ?>