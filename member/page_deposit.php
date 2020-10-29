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
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$sql23="SELECT akaunb,phone from userpro WHERE id='$username'";
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

$sql5="SELECT walletb,usdt from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$usdt = $info5['usdt'];
$balance=number_format((float)$balance, 2, '.', '');
$usdt=number_format((float)$usdt, 2, '.', '');

/* ?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">BALANCE</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/logo_dollar.png" style="width: 50px;height: 50px;">
		<h5 class="glow4">YOUR BALANCE</h5>
		<h1 class="glow3">$ <?=$balance?></h1>
	</div>
	<h5 class="glow4">[ <?=$username?> ]</h5>
  </div>
  </div>
  <?php //include "bubble.php"; ?>
  </div>  */ ?>


<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
<?php
$sql53="SELECT count(memberid) as merc FROM walletlog WHERE  trc='Deposit' AND memberid='$username' ORDER BY created_date DESC";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];
if($merc>0){
?>
<div class="box-welcome2">
	</div>
<a href="page_invest.php" class="btn btn-danger  btn-sm"><i class="glyphicon glyphicon-gift"></i>&nbsp;REINVEST</a>

<a href="page_deposit2.php"><button  class="bt bt1 glow1">OTHER FUNDING METHOD &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button></a>

<br><br>

<h2 class="glow2">USD DEPOSIT TRANSACTION</h2>

		<h5 class="glow4">YOUR USD BALANCE</h5>
		<h1 class="glow3">$ <?=$balance?></h1>
		
      <div class="outernormalbox text-center">
        <div class="paid-out glow3">
		  <div class="table-responsive"> 
          <table class="table" style="width:100%; text-align:LEFT;" border="1" >
		
<?php 
$sql28="SELECT * FROM walletlog WHERE memberid='$_SESSION[USERPRO]' AND trc='Deposit' ORDER BY created_date DESC";
$data28 = mysqli_query($conn,$sql28) or die(mysqli_error());
while($info28 = mysqli_fetch_array( $data28 )) {
	$dateho = $info28['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);
    
	$SN=$info28['sn'];
	$amount=$info28['amount'];
	
$permitted_chars = '0123456789';
// Output: 54esmdr0qf
$HAHA = substr(str_shuffle($permitted_chars), 0, 3);
?>
		  <tr style="border-bottom: 1px solid #f4511e;">
		  <td style="width:10px;">
		  <font style="color:#7CFC00;">Transaction ID #<?=$HAHA?><?=$SN?></font><br>
		  <font style="color:#0cbfe9;font-size:11px;"><?=$dateho?><br><?=$masaho?></font><br>
		  </td>
		  <td style="width:200px;color:yellow;">$<?=$amount?></td>
		  
		  </tr>
		  <?php } ?>
          </table>
          </div>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
	  <?php } else { 
	  
	  echo "<br><br><br><br><br><h3 class='glow4'>NO DEPOSIT TRANSACTION VIA BANK</h3>"; 
	  echo '<center><a href="page_deposit2.php"><button  class="bt bt1 glow1">OTHER FUNDING METHOD &nbsp; <i class="glyphicon glyphicon-arrow-right"></i></button></a></center><br><br><hr><br><br>';
	  
	  } ?>
	  
	  
	  
	<!-- btc depo transaction history section  --><?php /* start */?>
	  <?php
$data55 = mysqli_query($conn,"SELECT count(sn) as mysn FROM btcdepo WHERE memberid='$_SESSION[USERPRO]'") or die(mysqli_error($conn));
$info55 = mysqli_fetch_array( $data55 );
//$mysn=$info2['mysn'];
if($info55['mysn'] > 0){
?>
<div class="row">
<div class="haha">
<div class="block">
<div class="block-title"><br><Br><hR><hR><br><Br>
<h2 class=glow5>Crypto USDT Deposit Transaction</h2> 

		<h5 class="glow4">YOUR USDT BALANCE</h5>
		<h1 class="glow3">$ <?=$usdt?></h1>
</div>
<div class="table-responsive">
          <table class="table" style="width:100%; text-align:LEFT;" border="1" >
                <thead>
                    <tr style="width:250px;">
                        <th class="text-center">Ref.</th>
                        <th class="text-center">USDT Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$data56 = mysqli_query($conn,"SELECT * FROM btcdepo WHERE memberid='$_SESSION[USERPRO]'") or die(mysqli_error());
					while($info56 = mysqli_fetch_array( $data56 )) {
					$sn56 = $info56['sn']; 
					$stat56 = $info56['stat'];
					$cointype = $info56['cointype'];
					if($cointype=='1'){ $cointype2="Option 1"; }
					if($cointype=='2'){ $cointype2="Option 2"; }
					if($cointype=='3'){ $cointype2="Freewallet"; }
	$dateho = $info56['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);		
	$amount56 = $info56['amount'];	
	//random
	$permitted_chars = '0123456789';
	$HAHA = substr(str_shuffle($permitted_chars), 0, 2);	
					
					
					$num = $info56['sn'];
					//$num = sprintf("%06d", $num);
					?>
                   
<tr style="border-bottom: 1px solid #f4511e;">
<td>
<font style="color:#7CFC00;">Transaction ID #<?=$HAHA?><?=$num?></font><br>
<font style="color:#0cbfe9;font-size:11px;"><?=$dateho?><br><?=$masaho?></font><br>
</td>
<td style="color:yellow;" class="text-center"><?=$amount56?>
<Br>
<!-- STATUS USDT -->
<font style="color:green;font-size:14px;"><?=$stat56?></font>
<font style="color:#7CFC00;font-size:12px;">Via <?=$cointype2?></font>
<br>
<?php
if($stat56=='Paid'){
	$sql34="SELECT amount, created_date FROM walletlog WHERE sender='$num'";
	$data34 = mysqli_query($conn,$sql34) or die(mysqli_error($conn));
	$info34 = mysqli_fetch_array( $data34 );

	$terima = $info34['amount'];
	$tterima = $info34['created_date'];
	echo "<br>",$terima," USDT <br>Recieved at:<br> ",$tterima;
}
?>
<?php
if($stat56=="Processing"){ ?>
<a href="x_delete_btcdepo_request.php?sn=<?=$sn56?>" data-toggle="tooltip" title="Cancel" class="buttonx buttonx1" onclick="return confirm('Cancel');"> Delete Invalid Request</a> 
<?php } ?>
</td>
</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</div>
</div>
<?php  }
$mysn=$info55['mysn']; 
//echo $mysn; 
?>
	  <!-- btc depo transaction history section end --><?php /* end */?>
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>