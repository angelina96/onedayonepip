<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); }
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


//penambahan untuk rectify
$sql41="SELECT SUM(amount) AS totdepo from walletlog WHERE memberid='$username' AND trc='Deposit' ";
$data41 = mysqli_query($conn,$sql41) or die(mysqli_error($conn));
$info41 = mysqli_fetch_array( $data41 );
$totdepo = $info41['totdepo'];
$totdepo=number_format((float)$totdepo, 2, '.', '');

$sql48="SELECT SUM(amount) AS totalbo from walletlog WHERE memberid='$username' AND (trc='B1' OR trc='B2' OR  trc='B3') ";
$data48 = mysqli_query($conn,$sql48) or die(mysqli_error($conn));
$info48 = mysqli_fetch_array( $data48 );
$totalbo = $info48['totalbo'];
$totalbo=number_format((float)$totalbo, 2, '.', '');

$tam = 0;
$tam2 = 0;
$piprogress=0;
$total_pip=0;
$data6 = mysqli_query($conn,"SELECT * FROM invest WHERE id='$username' ORDER BY created_date DESC") or die(mysqli_error());
while($info6 = mysqli_fetch_array( $data6 )) {
$amount   = $info6['amount'];
$planroi  = $info6['planroi'];
$planday  = $info6['planday'];
$counter  = $info6['counter'];
$income   = (($amount*$planroi)/100);
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$tam = $tam+ $amount;
$tam2 = $tam2+ $income;


//[NEW.5.1]Kira progress mengikut counter pip
$parsent19  = (($planroi - 100)/$planday);
$pip19 = (($amount*$parsent19)/100);
$piprogress=$pip19*$counter;
$status19 = $info6['cashback'];
if($status19=="DONE"){ $piprogress=$piprogress+$amount; }
//$piprogress=number_format((float)$piprogress, 2, '.', '');
//echo "<br>".$piprogress."<br>";

$total_pip = $total_pip+ $piprogress;
$total_pip=number_format((float)$total_pip, 2, '.', '');
}

$sql2="SELECT SUM(amount) as wawa from wd WHERE id='$username' AND stat!='Declined'";
$data2 = mysqli_query($conn,$sql2) or die(mysqli_error());
$info2 = mysqli_fetch_array( $data2 );
$totalwd=$info2['wawa'];
if($totalwd==null){ $totalwd=0;}
//penambahan untuk rectify tamat
?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">INVEST</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/logo_dollar.png" style="width: 50px;height: 50px;">
		<h5 class="glow4">YOUR BALANCE</h5>
		<?php
		//rectify balance using auto - padan muka kau hacker tak guna
		$baki = $totdepo+$totalbo-$totalwd-$tam+$total_pip;
		$baki=number_format((float)$baki, 2, '.', '');
		?>
		<h1 class="glow3">$ <?=$baki?></h1>
	</div>
	<h5 class="glow4">[ <?=$username?> ]</h5>
	
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
  <form action="page_invest2.php" method="POST">
  SELECT PLAN
  
  <?php 
	$sql9 = "SELECT * FROM masterctrl WHERE plantype='LT' ORDER BY created_date DESC LIMIT 1";
	$data9 = mysqli_query($conn,$sql9) or die(mysqli_error($conn));
	while ($info9 = mysqli_fetch_array( $data9 )){
	$planname = $info9['planname'];
  ?>
		<div class="four col">
		<input type="radio" class="koroi2" name="q1" value="<?=$planname?>" id="r1" required>
		<label for="r1">
		<h4><?=$planname?></h4>
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
		<h4>PLAN <?=$planroi?>%</h4>
		</label>
		</div>
	<?php } ?>
	
    <div class="form-group">
      <label for="amount">CAPITAL:</label>
      <input type="number" name="amount" class="form-control" id="amount" placeholder="Minimum $<?=$minimum?>" step="0.01" min="<?=$minimum?>" max="<?=$baki?>" value="<?=$baki?>" required autocomplete="off"  onChange="checkID(this.value)">
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
 </div>
  <div class="col-sm-4 col-xs-12"></div>
 </div>
</div>


<?php
$sql53="SELECT count(id) as merc FROM invest WHERE id='$_SESSION[USERPRO]'";
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
$sql19="SELECT * FROM invest WHERE id='$_SESSION[USERPRO]' order by created_date DESC LIMIT 30";
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

<script type="text/javascript" src="cekdata.js"></script>
<?php include "content/footer.php"; ?>