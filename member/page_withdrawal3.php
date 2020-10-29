<?php 
ob_start();
session_start();
$_SESSION['TOKEN']="go";
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
//date_default_timezone_set('Asia/Kuala_Lumpur');
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$paydate=date("Y-m-d");
$sql60="SELECT count(id) as rona from wd WHERE id='$username' AND typ='USDT' AND created_date LIKE '$paydate%'";
$data60 = mysqli_query($conn,$sql60) or die(mysqli_error($conn));
$info60 = mysqli_fetch_array( $data60 );
$rona = $info60['rona'];

$sql23="SELECT akaunb,addressbtc,phone from userpro WHERE id='$username'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$addressbtc = $info23['addressbtc'];
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
	if(($timenow>8)&&($timenow<12)){ $disabled=null; $wd="on"; }
	else {$disabled="disabled"; $wd="off";} 
  }
//echo $timenow;
//$disabled=null; $wd="on"; //wd_on
if($username=="oyo") { $disabled=null; $wd="on"; }

$sql5="SELECT usdt from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['usdt'];
$balance=number_format((float)$balance, 2, '.', '');
?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">USDT WITHDRAWAL</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/usdt.png" style="width: 110px;height: 110px;">
		<h5 class="glow4">YOUR USDT BALANCE</h5>
		<h1 class="glow3">$ <?=$balance?></h1>
	</div>
	<h5 class="glow4">[ <?=$username?> ]</h5>
	<?php include "../alert/alert2.php"; ?>
  </div>
  </div>
  <?php //include "bubble.php"; ?>
  </div>


<div id="myaccount" class="bg-home text-center">
<div class="row">
  <div class="col-sm-4 col-xs-12"></div>
  
<!-- start -->
  <div class="col-sm-4 col-xs-12">
  <?php if($addressbtc==null){?>
  <!--<center><h3 class='glow'><a href="page_profile.php?f1=verify1659a54myaccount">You need to update your Bank Account Information</a></h3></center>-->
  <center><h3 class='glow'><a href="page_profile.php?f3=johore_angelina">Blockchain Address Empty</a></h3></center>
  <?php 
  }
  else if($cekfon=='X'){ echo "<center><h3 class='glow'><a href='page_profile.php?f1=verify1659a54myaccount'>Please confirm your phone number</a> : ".$getPhoneNo."</h3></center>"; }
  else {
  if($wd=="on"){
	if(($balance>=$minimum2)&&($rona==0)){
?>
  <form action="page_withdrawal4.php" method="POST">
    <div class="form-group">
      <label for="amount">ENTER AMOUNT:</label>
      <input type="number" name="amount" class="form-control" id="amount" placeholder="Minimum $<?=$minimum2?>" step="0.01" min="<?=$minimum2?>" max="<?=$balance?>" required autocomplete="off">
    </div>
	<input type="hidden" name="id" value="<?=$username?>">
	<input type="hidden" name="walletb" value="<?=$balance?>">
    <input type="submit" class="button buttonfull"  style="width:100%" value="WITHDRAW">
  </form>

<?php
  }
  else if($balance<$minimum2) { echo "<h2 class='glow4'>INSUFFICIENT BALANCE</h2>"; }
  else if($rona!=0){  echo "<h2 class='glow4'>PROCESSING YOUR WITHDRAWAL</h2>"; }
  else { echo "<h2 class='glow4'>INSUFFICIENT BALANCE</h2>"; }
  }
  else {
  //echo "<center><code>Widthrawal is open on office hour only. now:".$timenow."</code></center>"; 
  echo "<center><h3 class='glow4'>System Withdrawal Offline <Br> <BR>Operating Time</h3>
		
		<h4 class='glow4'> 
		Indonesia Zone 08:00 to 12:30
		<BR>Thailand Zone 09:00 to 11:30
		<BR>Malaysia Zone 09:00 to 12:00
		<BR>Philippines Zone 10:00 to 13:00
		<BR>Australia Zone 14:00 to 16:00</h4>
		"; 
  }
  } ?>
  </div>
  <!-- end -->
  <div class="col-sm-4 col-xs-12"></div>
 </div>
</div>

<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="outernormalbox text-center">
        <div class="box-wallet">
          <h1 class="glow1">USDT WITHDRAWAL</h1>
        </div>
        <div class="paid-out glow3">
		  <div class="table-responsive"> 
          <table class="table" style="width:100%; text-align:left;" border="1" >
<?php 
$sql19="SELECT * FROM wd WHERE id='$_SESSION[USERPRO]' AND typ='USDT'";
$data19 = mysqli_query($conn,$sql19) or die(mysqli_error());
while($info19 = mysqli_fetch_array( $data19 )) {
	$dateho = $info19['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);
    
	$SN=$info19['sn'];
	$amount=$info19['amount'];
	$stat = $info19['stat'];
	if($stat=="Completed"){ $completed="Completed"; }
    if($stat=="Processing"){ $completed="NO"; }
    if($stat=="Processing_Token"){ $completed="NO"; }
    if($stat=="Declined"){ $completed="<font color='#ff0000'>Invalid transaction</font>"; }
	
	//random generator
	$permitted_chars = '0123456789';
	$HAHA = substr(str_shuffle($permitted_chars), 0, 3);
?>
		  <tr style="border-bottom: 1px solid #f4511e;">
		  <!--<td style="width:10px;"><?=$SN?></td>-->
		  <td style="width:200px;">
		  <font style="color:#7CFC00;">Transaction ID #<?=$HAHA?><?=$SN?></font><br>
		  <font style="color:#0cbfe9;font-size:11px;"><?=$dateho?><br><?=$masaho?></font><br>
		  
		  <? if($stat=="Declined"){ echo $completed; }?><br>
		  <? if($completed=="NO"){ echo $stat; ?>
		  <br>
		  
		  <!--<a href="x_delete_widthraw_request.php?ID=<?=$username?>&SN=<?=$SN?>&AM=<?=$amount?>" class="buttonx buttonx1" onclick="return confirm('Are you sure to cancel?');">Cancel <?=$stat?></a>-->
		  <form action="x_delete_widthraw_request.php?ID=<?=$username?>&SN=<?=$SN?>&AM=<?=$amount?>" method="POST">
			<input type="hidden" value="<?=$amount?>" name="AMZ">
			<!--<input type="hidden" value="USDT" name="USDT">-->
			<input type="submit" value="Cancel <?=$stat?>" onclick="return confirm('are you sure to cancel?');" class="buttonx buttonx1" >
		  </form>
		  
		  
		  <?php }
			 else echo $stat;
		  ?>
		  
		  </td>
		  <td style="width:200px;color:yellow;">$<?=$amount?></td>
		  </tr>
		  <?php } ?>
          </table>
          </div>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>