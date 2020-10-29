<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login

$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php"; //$minimum = 0.00000001;

$sql57="SELECT usdt from wallet WHERE id='$username'";
$data57 = mysqli_query($conn,$sql57) or die(mysqli_error($conn));
$info57 = mysqli_fetch_array( $data57 );
$balance = $info57['usdt'];
$balance=number_format((float)$balance, 2, '.', '');
?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow6">USD THETER INVESTMENT</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/usdt.png" style="width: 110px;height: 110px;">
		<h5 class="glow5">YOUR USDT WALLET</h5>
		<h1 class="glow6"><font style="font-family: 'Aldrich';">$ <?=$balance?></font></h1>
	</div>
	<h5 class="glow5">[ <?=$username?> ]</h5>
	
	<?php include "../alert/alert2.php"; ?>
  </div>
  </div>
<?php include "bubble.php"; ?>
</div>

<div id="myaccount" class="bg-home text-center">
<div class="row">
  <div class="col-sm-4 col-xs-12"></div>
  <div class="col-sm-4 col-xs-12">
  <?php $_SESSION['TOKEN']="go";?>
  <?php 
  if($balance>0){
  ?>
  <form action="page_invest4.php" method="POST">
  
  
  <?php 
	$sql9 = "SELECT * FROM masterctrl WHERE plantype='LT' ORDER BY created_date DESC LIMIT 1";
	$data9 = mysqli_query($conn,$sql9) or die(mysqli_error($conn));
	while ($info9 = mysqli_fetch_array( $data9 )){
	$planname = $info9['planname'];
  ?>
		<div class="four col">
		<input type="radio" class="koroi2" name="q1" value="<?=$planname?>" id="r1" required>
		<label for="r1">
		<?=$planname?>
		</label>
		</div>
	<?php } ?>
  <?php 
	$sql9 = "SELECT * FROM masterctrl WHERE plantype='ST' ORDER BY created_date DESC LIMIT 1";
	$data9 = mysqli_query($conn,$sql9) or die(mysqli_error($conn));
	while ($info9 = mysqli_fetch_array( $data9 )){
	$planname = $info9['planname'];
	$planroi = $info9['planroi'];
	$planday  = $info9['planday'];
	$days     = $planday * 86400;
	
	$dateNow  = date("Y-m-d H:i:s");
	$current  = strtotime($dateNow);
	//$datestart= $info9['created_date'];
	$start    = $current;//strtotime($info9['created_date']);
	$end      = $start + $days;

	$start  = date("Y-m-d H:i:s",$start);
	//$end  = date("Y-m-d H:i:s",$end);
	$capback = $end + 86400;
	$end  = date("d M Y",$end);
	$capback  = date("d M Y",$capback);
  ?>
		<div class="four col">
		<input type="radio" class="koroi2" name="q1" value="<?=$planname?>" id="r2" required CHECKED>
		<label for="r2">
		<h4 class="glow6">PLAN <?=$planroi?>%</h4>
		</label>
		</div>
	<?php } ?>
	
    <div class="form-group">
      <label for="amount">CAPITAL:</label>
      <input type="number" name="amount" class="form-control" id="amount" placeholder="Minimum $<?=$minimum?>" step="0.01" min="<?=$minimum?>" max="<?=$balance?>" value="<?=$balance?>" required autocomplete="off"  onChange="checkID(this.value)">
    </div>
	
    <div class="form-group">
      <label for="amount">DIVIDENT:</label>
      <H3 class="glow4"><?=$planroi?>%</H3>
    </div>
    <div class="form-group">
      <label for="amount">CAPITAL BACK PAYDAY:</label>
      <H3 class="glow4"><?=$capback?></H3>
    </div>
    <div class="form-group">
      <label for="amount">PAYMENT:</label>
	  <h5><span class="st" id="txtHint"></span></h5>
      <!--<H3><?=$planroi?>USD</H3>-->
    </div>
	<?php include "tnc.php"; ?>
	<input type="hidden" name="walletb" value="<?=$balance?>">
	<input type="hidden" name="id" value="<?=$_SESSION['USERPRO']?>">
    <input type="submit" class="button buttonfull"  style="width:100%"  value="SUBMIT" >
  </form>
  <?php
  }
  else { echo "<h2 class='glow5'>USDT WALLET EMPTY</h2>"; }
  ?>
 </div>
  <div class="col-sm-4 col-xs-12"></div>
 </div>
</div>

<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
	<!-- btc depo transaction history section  --><?php /* start * /?>
	  <?php
$data55 = mysqli_query($conn,"SELECT count(sn) as mysn FROM btcdepo WHERE memberid='$_SESSION[USERPRO]'") or die(mysqli_error($conn));
$info55 = mysqli_fetch_array( $data55 );
if($info55['mysn'] > 0){
?>
<div class="row">
<div class="haha">
<div class="block">
<div class="block-title">
<h2 class="glow5">Crypto Deposit Transaction</h2> 
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
<br>
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
?>
	  <!-- btc depo transaction history section end --><?php /* end */?>
	  
	  <!-- list usdt invest start -->
	  <?php
$sql53="SELECT count(id) as merc FROM investusdt WHERE id='$_SESSION[USERPRO]'";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];
if($merc>0){
?>
  <div style="width:100vw; background-color: #000000;">
      <div class="outernormalbox text-center">
        <div class="box-wallet">
          <h5 class="glow1">Transaction History</h5>
        </div>
        <div class="paid-out glow3">
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$TART -->
		  <div class="table-responsive"> 
          <table class="table" style="width:100%;" border="1">
<?php 
$sql19="SELECT * FROM investusdt WHERE id='$_SESSION[USERPRO]'";
$data19 = mysqli_query($conn,$sql19) or die(mysqli_error());
while($info19 = mysqli_fetch_array( $data19 )) {
	$dateho = $info19['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);
    //if($info19['stat'] =='Active' ){ $la="label-success";} 
	//if($info['stat'] =='Completed' ){ $la="label-info";}
	$planroi19  = $info19['planroi'];
	$planday19  = $info19['planday'];
	$amount19  = $info19['amount'];
	$counter  = $info19['counter'];
	$parsent19  = (($planroi19 - 100)/$planday19);
	$pip19 = (($amount19*$parsent19)/100);
	$piprogress=$pip19*$counter;
	//planroi * amount / 100
	$dapat=(($planroi19*$amount19)/100);
	$dapat=number_format((float)$dapat, 2, '.', '');
	$piprogress=number_format((float)$piprogress, 2, '.', '');
	$amount19=number_format((float)$amount19, 2, '.', '');
	$status19 = $info19['cashback'];
	if($status19=="DONE"){ $piprogress=$dapat; }
?>
		  <tr style="border-bottom: 1px solid #f4511e;">
		  <!--<td style="width:5px;"><?=$info19['sn']?></td>-->
		  <td style="width:200px; text-align:left;">
		  <font style="color:yellow;">
		  Capital Value: $<?=$amount19?>
		  </font>
		  <br>
		  <?=$dateho?><!--&nbsp;<?=$masaho?>-->
		  <br>
		  <font style="color:#0cbfe9; font-size:11px;">Transaction#<?=$info19['sn']?></font>
		  </td>
		  <td style="width:200px;">
		  <font style="width:200px;color:yellow;">$<?=$piprogress?> / $<?=$dapat?></font>
		  <br>
		  <font style="color:#7CFC00;">Plan <?=$planroi19?>% <?=$info19['stat']?></font>
		  </td>
		  <!--<td style="width:200px;color:#7CFC00;">Plan <?=$planroi19?>% <?=$info19['stat']?></td>-->
		  </tr>
		  <?php } ?>
          </table>
          </div>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
  </div>
<?php } ?>
	  <!-- list usdt invest section end --><?php /* end */?>
	  
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>