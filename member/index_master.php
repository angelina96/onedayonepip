<?php 
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
else { echo "You are in secured site"; }
$username=$_SESSION["USERPRO"];
include "content/header.php"; 
//include "content/preloader.php"; 
include "content/nav.php";

$sql4="SELECT fname,verifymel from userpro WHERE id='$username'";
$data4 = mysqli_query($conn,$sql4) or die(mysqli_error($conn));
$info4 = mysqli_fetch_array( $data4 );
$fullname = $info4['fname'];
$verifyic = $info4['verifymel'];

$sql5="SELECT walletb from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$balance=number_format((float)$balance, 2, '.', '');

$sql25="SELECT upline from affiliate WHERE userid='$username'";
$data25 = mysqli_query($conn,$sql25) or die(mysqli_error($conn));
$info25 = mysqli_fetch_array( $data25 );
$upline = $info25['upline'];

$sql32="SELECT * FROM masterctrl ORDER BY created_date DESC LIMIT 1";
$data32 = mysqli_query($conn,$sql32) or die(mysqli_error());
$info32 = mysqli_fetch_array( $data32 );
$planroi = $info32['planroi'];
$planday = $info32['planday'];
$planname = $info32['planname'];
$mininv = $info32['mininv'];
$minwd = $info32['minwd'];
$plantype = $info32['plantype'];

$sql40="SELECT count(id) as newuser FROM userpro WHERE verifymel='N'";
$data40 = mysqli_query($conn,$sql40) or die(mysqli_error($conn));
$info40 = mysqli_fetch_array( $data40 );
$newuser = $info40['newuser'];

?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h1 STYLE="color:orange;">WELCOME</h1>
		<H3 class="glow4"><?=$username?></H3>
	</div>
	<div class="box-welcome2">
		<img src="images/logo_user.png" style="width: 50px;height: 50px;">
		<h4 class="glow3"><?=$fullname?></h4>
		
<!-- ############# MASTER EDIT PLAN START################### -->
<button onclick="hidenshow()" type="reset" class="btn btn-block btn-effect-ripple btn-success" style="background-color:green;" id="hidDiv2">Update Plan</button>

		<div id="hidDiv" style="display: none">
		<?php include "form_update_plan.php"; ?>
		</div>
<!-- ############# MASTER EDIT PLAN END################### -->
<br>
<!-- ############# MASTER APPROVE USER START################### -->
<?php if($newuser!='0'){?>
	<center>
	<table style="background: url('https://thumbs.gfycat.com/EcstaticAgreeableIndri-size_restricted.gif'); color: #ffee00; background-size: 100% 100%; border: 1px solid #f4511e; width: 320px; border-radius:10px;">
	<tr><td>
	<a href="page_approve.php">
	<h4 class="glow2">New Member Register</h4>
	<h2 class="glow1"><?=$newuser?> New Member(s)</h2></a>
	</td></tr>
	</table></center> <?php } ?>
<!-- ############# MASTER APPROVE USER END################### -->

		
		
		<?php 
		if($verifyic=="N"){
		$rank = "-";
		$gg="glow4";
		}
		else{
		$a="Account Verified";
		}
		?>
		<!--<h2 class="<?=$gg?>"><?=$rank?></h2> -->

		<!-- Copy -->
		<center><table><tr><td>
		<input type="text" value="https://www.onedayonepip.trade/A8Y0357.php?upline=<?=$username?>" id="myInput" 
		style="color:blacks;
			  border-top-style: hidden;
			  border-right-style: hidden;
			  border-left-style: hidden;
			  border-bottom-style: hidden;
			  color:#fff;background-color:transparent;background-image:none;border:0px solid transparent;" size="32" readonly>
		</td></tr><tr><td align="center">
		<div class="tooltipx">
		<button onclick="myFunction()" onmouseout="outFunc()" class="button button1" >
		  <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
		  Copy Affiliate Link
		  </button>
		</div></td></tr></table></center>
		
			
	</div>
	<!--<div class="box-welcome2"><br>
		<img src="images/logo_active.png" style="width: 50px;height: 50px;">
		<h3>ACTIVE HOLDING</h3>
		<h2 class="glow1">$<?=$totalho?></h2>
	</div> -->
  </div>
  </div>
<?php include "bubble.php"; ?>
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
		<h3 style="color:#e65400">BALANCE</h3>
		<h2 class="glow1">$<?=$balance?></h2>
	</div>
  </div>
   <div class="col-sm-8 col-xs-12">
   <center><h3 class="glow3">MY ACCOUNT</h3></center>
	<div class="col-sm-6 col-xs-12" style="padding:2px;">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">HOLDING VALUE</h4>
	<h2 class="glow1">$<?=$totalho?></h2>
	</div>
	<a href="page_deposit.php">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">TOTAL DEPOSITS</h4>
	<h2 class="glow1">$0.00</h2>
	</div>
	</a>
	</div>
	<div class="col-sm-6 col-xs-12" style="padding:2px;">
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">TOTAL WITHDRAWALS</h4>
	<h2 class="glow1">$0.00</h2>
	</div>
	<div class="col-sm-12 col-xs-12 box-plan slideanim">
	<h4 class="glow2">PENDING WITHDRAWALS</h4>
	<h2 class="glow1">$0.00</h2>
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


/*KIRA GET MIN INVEST*/
$ki=($mininv*($planroi/100));
$ki=number_format((float)$ki, 2, '.', '');
$mininv=number_format((float)$mininv, 2, '.', '');

/*KIRA PARSENTO UTK DISPLAY PLAN DEKAT DEPAN*/
$parsento  = (($planroi - 100)/$planday);
//$pip = (($mininv*$parsent)/100);
?>
 <!-- <center><h1 class="glow1"><?=$planname?></h1></center>
  <center><h2 class="glow1"><?=$mininv?> USD GET <?=$ki?> USD</h2></center>
  <center><h2 class="glow1">One Day <?=$parsento?>%</h2></center>
  <center><h2 class="glow1"><?=$planday?> Days</h2></center> -->
  
  
 <?php include "page_plan_today.php"; ?> 
  
  
  </div>
</div>



<?php include "content/footer.php"; ?>
<script>
function hidenshow() {
  var x = document.getElementById("hidDiv");
  var y = document.getElementById("hidDiv2");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
</script>