<?php 
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
else { echo "You are in secured site"; }
$username=$_SESSION['USERPRO'];
include "cashback.php";
include "cashbackusdt.php";

include "content/header.php"; 
//include "content/preloader.php"; 
include "content/nav.php";

$sql4="SELECT fname,verifymel from userpro WHERE id='$username'";
$data4 = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
$info4 = mysqli_fetch_array( $data4 );
$fullname = $info4['fname'];
$verifyic = $info4['verifymel'];

$sql5="SELECT walletb,usdt from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$usdt = $info5['usdt'];
$balance=number_format((float)$balance, 2, '.', '');
$usdt=number_format((float)$usdt, 2, '.', '');


//penambahan untuk rectify
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

$sql25="SELECT upline from affiliate WHERE userid='$username'";
$data25 = mysqli_query($conn,$sql25) or die(mysqli_error($conn));
$info25 = mysqli_fetch_array( $data25 );
$upline = $info25['upline'];

$sql41="SELECT SUM(amount) AS totdepo from walletlog WHERE memberid='$username' AND trc='Deposit' ";
$data41 = mysqli_query($conn,$sql41) or die(mysqli_error($conn));
$info41 = mysqli_fetch_array( $data41 );
$totdepo = $info41['totdepo'];
$totdepo=number_format((float)$totdepo, 2, '.', '');

$sql43="SELECT SUM(amount) AS totwd from wd WHERE id='$username' AND stat='Completed'"; // and typ!='USDT' ENDGAME PLIS
$data43 = mysqli_query($conn,$sql43) or die(mysqli_error($conn));
$info43 = mysqli_fetch_array( $data43 );
$totwd = $info43['totwd'];
$totwd=number_format((float)$totwd, 2, '.', '');

$sql44="SELECT SUM(amount) AS totpenwd from wd WHERE id='$username' AND stat='Processing'";
$data44 = mysqli_query($conn,$sql44) or die(mysqli_error($conn));
$info44 = mysqli_fetch_array( $data44 );
$totpenwd = $info44['totpenwd'];
$totpenwd=number_format((float)$totpenwd, 2, '.', '');

$sql48="SELECT SUM(amount) AS totalbo from walletlog WHERE memberid='$username' AND (trc='B1' OR trc='B2' OR  trc='B3') ";
$data48 = mysqli_query($conn,$sql48) or die(mysqli_error($conn));
$info48 = mysqli_fetch_array( $data48 );
$totalbo = $info48['totalbo'];
$totalbo=number_format((float)$totalbo, 2, '.', '');
?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h1 STYLE="color:orange;">WELCOME</h1>
		<H3 class="glow4"><?=$username?></H3>
	</div>
	<div class="box-welcome2">
	<?php if($verifyic=="N"){ ?><img src="images/logo_user.png" style="width: 50px;height: 50px;">
	<?php } 
	else {
		if($rank=="GOLD"){ echo '<img src="images/rank/gold.png" style="height: 150px;">'; }
		if($rank=="SILVER"){ echo '<img src="images/rank/silver.png" style="height: 150px;">'; }
		if($rank=="PLATINUM"){ echo '<img src="images/rank/platinum.png" style="height: 150px;">'; }
	}
	?>
	
		<h4 class="glow3"><?=$fullname?></h4>
		
		<?php 
		if($verifyic=="N"){
		$rank = "RANK AVAILABLE AFTER YOUR ACCOUNT IS VERIFIED";
		$gg="glow4";
		}
		else{
		$a="Account Verified";
		}
		?>
		<h2 class="<?=$gg?>"><?=$rank?></h2>

		<!-- Copy -->
		<center><table><tr><td>
		<input type="text" value="https://www.onedayonepip.trade/A8Y0357.php?upline=<?=$username?>" id="myInput" 
		style="color:blacks;
			  border-top-style: hidden;
			  border-right-style: hidden;
			  border-left-style: hidden;
			  border-bottom-style: hidden;
			  color:#fff;background-color:transparent;background-image:none;border:0px solid transparent;" size="30" readonly>
		</td></tr><tr><td align="center">
		<div class="tooltipx">
		<button onclick="myFunction()" onmouseout="outFunc()" class="button button1" >
		  <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
		  Copy Affiliate Link
		  </button>
		</div></td></tr></table></center>
	</div>
	<div class="box-welcome2"><br>
		<img src="images/logo_active.png" style="width: 50px;height: 50px;">
		<h3>ACTIVE HOLDING</h3>
		<?php $totalhokasal=number_format((float)$totalhokasal, 2, '.', ''); ?>
		<?php $totalhokusdt=number_format((float)$totalhokusdt, 2, '.', ''); ?>
		<hr>
		<h3 class="glow2">USD</H3>
		<h2 class="glow6" style="font-family:Aldrich;">$<?=$totalhokasal?></h2>
		<hr>
		<h3 class="glow2">USDT</H3>
		<h2 class="glow6" style="font-family:Aldrich;"><?=$totalhokusdt?> USDT</h2>
		<hr>
	</div>
  </div>
  </div>
<?php include "bubble.php"; ?>
<?php include "../alert/alert2.php"; ?>
</div>

<div id="myaccount" class="bg-home text-center">
 <div class="row">
  <div class="col-sm-4 col-xs-12">
	<!--<div class="box-welcome"><br>
		<img src="images/logo_affiliate.png" style="width: 50px;height: 50px;">
		<h3 style="color:#e65400">YOUR UPLINE</h3>
		<h2 class="glow1"><?=$upline?></h2>
	</div>-->
	<div class="box-welcome"><br>
		<img src="images/logo_dollar.png" style="width: 50px;height: 50px;">
		<h3 style="color:#e65400">BALANCE USD</h3>
		
		<?php
		//rectify balance using auto - padan muka kau hacker tak guna
		$baki = $totdepo+$totalbo-$totalwd-$tam+$total_pip;
		$baki=number_format((float)$baki, 2, '.', '');
		?>
		<h2 class="glow1">$<?=$baki?></h2>
		
		<?php
		echo "<p class='glow5'><br>Total Deposit: ".$totdepo."<br>Total Bonus Recieved: ".$totalbo."<br>Total Withdrawal: ".$totalwd."<br>Total Activated Holding: ".$tam."<br>Total ROI and Capital Back: ".$total_pip."<br></p>Wallet system updated<br><br>";
		?>
		
		<h3 style="color:#e65400">BALANCE USDT</h3>
		<h2 class="glow1">$<?=$usdt?></h2>
		<a href="page_invest.php" class="btn btn-danger  btn-sm"><i class="glyphicon glyphicon-gift"></i>&nbsp;REINVEST</a>
		<?php if($usdt>0){ ?>
		<a href="page_invest3.php" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-gift"></i>&nbsp;REINVEST USDT</a>
		<?php } ?>
	</div>
  </div>
   <div class="col-sm-8 col-xs-12">
   <center><h3 class="glow3">MY ACCOUNT</h3></center>
	<div class="col-sm-6 col-xs-12" style="padding:2px;">
	<a href="page_bonus.php">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">TOTAL BONUS</h4>
	<h2 class="glow1">$<?=$totalbo?></h2>
	</div>
	</a>
	<a href="page_deposit.php">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">TOTAL DEPOSITS</h4>
	<?php if($totdepo==null){ $totdepo="0.00"; } ?>
	<h2 class="glow1">$<?=$totdepo?></h2>
	</div>
	</a>
	</div>
	<div class="col-sm-6 col-xs-12" style="padding:2px;">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">TOTAL WITHDRAWALS</h4>
	<?php if($totwd==null){ $totwd="0.00"; } ?>
	<h2 class="glow1">$<?=$totwd?></h2>
	</div>
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">PENDING WITHDRAWALS</h4>
	<?php if($totpenwd==null){ $totpenwd="0.00"; } ?>
	<h2 class="glow1">$<?=$totpenwd?></h2>
	</div>
	</div>
   </div>
 </div>
</div>

<div id="players" class="container-fluid plan-bg">
<center><h2 class="glow1">INDEX TRADE</h2></center>
  <br>
  <div class="row">
<?php 
$sql32="SELECT * FROM masterctrl ORDER BY created_date DESC LIMIT 1";
$data32 = mysqli_query($conn,$sql32) or die(mysqli_error());
$info32 = mysqli_fetch_array( $data32 );
$planroi = $info32['planroi'];
$planday = $info32['planday'];
$planname = $info32['planname'];
$mininv = $info32['mininv'];

/*KIRA GET MIN INVEST*/
$ki=($mininv*($planroi/100));
$ki=number_format((float)$ki, 2, '.', '');
$mininv=number_format((float)$mininv, 2, '.', '');

/*KIRA PARSENTO UTK DISPLAY PLAN DEKAT DEPAN*/
$parsento  = (($planroi - 100)/$planday);
//$pip = (($mininv*$parsent)/100);
?>
<!--
  <style>
      .barsilona {
    color: #f4511e !important;
    background-color: transparent !important;
    background-image:   url("images/glitter2.gif"),url("images/bg2.png");
    background-size: cover;
    background-position: center;
    padding: 1px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  </style>
  
  <a href="page_invest.php">
	<div class="col-sm-12 col-xs-12 barsilona">
	<center><h1 class="glow1"><?=$planname?></h1></center>
  <center><h2 class="glow1"><?=$mininv?> USD GET <?=$ki?> USD</h2></center>
  <center><h2 class="glow1">One Day <?=$parsento?>%</h2></center>
  <center><h2 class="glow1"><?=$planday?> Days</h2></center>
	</div>
	</a>-->
   <?php include "page_plan_today.php"; ?>
  </div>
</div>



<?php include "content/footer.php"; ?>