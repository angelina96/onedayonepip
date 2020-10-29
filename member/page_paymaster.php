<?php 
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";


$userid=""; 
$displaysendtoken = 'style="display: none"';
$displaycekuser   = '';
$code   = '';
if(isset($_GET['cekuser'])) {
$cekuser = $_GET['cekuser'];
$displaycekuser = 'style="display: none"';
}
if(isset($_GET['userid'])) {
$userid = $_GET['userid'];
$displaysendtoken = "";
}
if(isset($_GET['code'])) {
$code = $_GET['code'];
$displaysendtoken = 'style="display: none"';
}

date_default_timezone_set('Asia/Kuala_Lumpur');
if(isset($_GET['paydate'])) {
$paydate = $_GET['paydate'];
}
else { 
$paydate=date("Y-m-d"); 
}

$datetaju = date("d/m/Y", strtotime($paydate));
?>

<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  
  
  <br>
<!--<button onclick="hidenshow()" type="reset" class="btn btn-block btn-effect-ripple btn-success" style="background-color:green;" id="hidDiv2">PAY-WALLET POINT</button>
<button onclick="hidenshow2()" type="reset" class="btn btn-block btn-effect-ripple btn-info" style="background-color:blue;" id="hidDivmini2">USD POINT</button> -->
  
  
  
  
  
  <!-- ############################################################################ -->
  <!-- ############################################################################ -->
  <!-- ############################################################################ -->
  <div id="hidDiv" style="display: none">
  <div class="col-sm-12 col-xs-12">
  <div class="box-welcome2">
		<h3 class="glow2">PAY WALLET - SENT USD POINT TO PAY-WALLET RGM</h3>
	</div>
<div class="paid-out glow3">
<div class="table-responsive">
  <table id="example-datatable" class="table  table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No.</th>
                        <th>RGM ID</th>
                        <th>Wallet</th>
                        <th>Balance</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
					$i="1";
					$data = mysqli_query($conn,"SELECT * FROM userpro U, wallet W WHERE U.akaun='LP' and W.id=U.id") or die(mysqli_error());
					while($info = mysqli_fetch_array( $data )) {
						$memberid = $info['id'];
						$fname = $info['fname']; if($fname==null){$fname="Anonymous";}
						$walletb = $info['walletb'];
						$walletc = $info['walletc'];
						$akaun = $info['akaun'];
					?>
                    <tr>
                        <td class="text-center"><?=$i?></td>
                        <td><strong><?=$memberid?></strong></td>
						<!-- PAY WALLET -->
                        <td><?php if($akaun=="LP"){ ?>
										<div id="zio2<?=$i?>">
										<button onclick="hnsPzio<?=$i?>()" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-pencil"></i>Send PayWallet Point</button>
										</div>
										
										<div id="zio<?=$i?>" style="display: none">
										<form action="" method="POST">
										<input type="hidden" name="memberid" value="<?=$memberid?>" required>
										<input type="hidden" name="walletc" value="<?=$walletc?>" required>
										<input type="number" min="1" name="point"  class="form-control floatNumberField" required>
										<input type="submit" value="SEND PAYWALLET POINT" class="btn btn-effect-ripple btn-primary" name="sendpw">
										<button onclick="hnsPzio<?=$i?>()" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i>Cancel</button>
										</form>
										</div> <?php } ?>
						</td>
						
                        <td><?=$walletc?></td>
                    </tr>
<script>
function hnsP<?=$i?>() {
  var x = document.getElementById("P<?=$i?>");
  var y = document.getElementById("P2<?=$i?>");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
//zio
function hnsPzio<?=$i?>() {
  var x = document.getElementById("zio<?=$i?>");
  var y = document.getElementById("zio2<?=$i?>");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
</script>	
                    <?php $i++; } ?>


                </tbody>
            </table>
			
			<button  onclick="hidenshow()" type="reset" class="btn btn-effect-ripple btn-danger">BACK</button>
			  </div>
			  </div>
			  </div>
			  </div>
  <?php
  if (isset($_POST['sendpw'])) {
$userid = $_POST['memberid'];
$walletc = $_POST['walletc'];
$amount = $_POST['point'];

$topup = $walletc+$amount;

$sqlUP="UPDATE wallet set walletc = '$topup' WHERE id='$userid'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

if($resultUP){
$sql1="INSERT INTO walletlog (memberid,amount, walletc, sender, trc) values('$userid','$amount','$topup','$username', 'PayWallet')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error());
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_paymaster.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_paymaster.php';</script>"); }
  }
  ?>
  <!-- ############################################################################ -->
  <!-- ############################################################################ -->
  <!-- ############################################################################ -->
<div id="hidDivmini" style="display: block">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">PAY WALLET - SENT USD POINT TO WALLET MEMBER</h3>
	</div>
	<div class="box-welcome2">

	<br>
		
<!-- CEK USER -->
<div id="fallforest" <?=$displaycekuser?>>
                <form id="form-validation" action="" method="POST" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User ID </label>
                        <div class="col-md-6">
                            <input type="text" value="<?=$userid?>" name="userid" class="form-control" placeholder="User ID">
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" value="FIND USER" class="btn btn-block btn-primary" name="addAduan">
                        </div>
                    </div>
                </form>
				<!--<button  onclick="hidenshow2()" type="reset" class="btn btn-effect-ripple btn-danger">BACK</button>-->
				<?php if($code!=''){ ?>
				<center><code><?=$code?></code></center>
				<?php } ?>
</div>
  <?php
  //--------------------------------------------------------------------------------------------
  //_______________________________[SERVER]_CEK USER___________________________________________
  //--------------------------------------------------------------------------------------------
  if (isset($_POST['addAduan'])) {
		//include "../serverdb/server.php";
		$userid 	 = $_POST['userid'];
		$sql33="SELECT id FROM userpro WHERE id='$userid'";
		$data33 = mysqli_query($conn,$sql33) or die(mysqli_error($conn));
		$info33 = mysqli_fetch_array( $data33 );
		$id = $info33['id'];

		if($id==null){
		$code="Username ".$userid." is not exist";
		echo "<script LANGUAGE='JavaScript'>window.location.href='page_paymaster.php?userid=".$userid."&code=".$code."';</script>";
		}
		else {
			echo "<script LANGUAGE='JavaScript'>window.location.href='page_paymaster.php?userid=".$id."&cekuser=ok';</script>";
			}
  }
  ?>
<!-- DONE CEK USER -->
<!-- SEND TOKEN -->
			<div id="santopany" <?=$displaysendtoken?>>
            <div class="block full">
			<div class="block-title">
                    <h2 class="glow4">USER EXIST! SEND USD</h2>
                </div>
                <form id="form-validation" action="" method="POST" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User ID </label>
                        <div class="col-md-6">
                            <input type="HIDDEN" value="<?=$userid?>" name="userid" class="form-control" placeholder="Balance" readonly><H3 CLASS="glow4"><?=$userid?></H3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="amount">Amount <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" id="amount" name="amount" class="form-control floatNumberField" placeholder="AMOUNT TOPUP BY USER" min="0.01" step="0.01" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" value="SEND USD POINT" class="btn btn-effect-ripple btn-primary" name="sendusd">
                            <a href="page_paymaster.php" class="btn btn-effect-ripple btn-danger">CANCEL</a> 
                        </div>
                    </div>
                </form>
            </div>
            </div>
<?php
if (isset($_POST['sendusd'])) {
	
$userid = $_POST['userid'];
$amount = $_POST['amount'];

$sql34="SELECT walletb FROM wallet WHERE id='$userid'";
$data34 = mysqli_query($conn,$sql34) or die(mysqli_error($conn));
$info34 = mysqli_fetch_array( $data34 );

$walletb = $info34['walletb'];
$topup = $walletb+$amount;

$sqlUP="UPDATE wallet set walletb = '$topup' WHERE id='$userid'";
$resultUP=mysqli_query($conn,$sqlUP) or die(mysqli_error());

if($resultUP){
$sql1="INSERT INTO walletlog (memberid,amount, walletb, sender, trc) values('$userid','$amount','$walletb','$username', 'Deposit')";
$result=mysqli_query($conn,$sql1) or die(mysqli_error());
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_paymaster.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_paymaster.php';</script>"); }
}
?>
<!-- DONE SEND TOKEN -->
	</div>
	
  </div>
  </div>
  </div>
  </div>


<div id="players" class="container-fluid plan-bg" style="height:80vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
	
<?php
$sql53="SELECT count(memberid) as merc FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='Deposit'  AND sender='$username' ORDER BY created_date DESC";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];

?>
      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_paywallet.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">TRANSACTION ON <?=$datetaju?></h3>
	
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"></td></tr></table>
	</div>
	</form>
		  
        </div>
        <div class="paid-out glow3">
		<?php if($merc>0){ ?>
<div class="table-responsive">
<table class="table" style="width:100%; text-align:center;" border="1">
<thead>
<tr class="glow4">
<!--<th class="text-center" style="width: 50px;">SN</th>-->
<th>Ref.No.</th>
<th>User ID</th>
<th>Amount Sent</th>
<th>Time</th>
<th>Date</th>
<th>Transaction</th>
</tr>
</thead>
<tbody>
                    <?php 
					$i="1";
					$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='Deposit' AND sender='$username' ORDER BY created_date DESC";
					$data36 = mysqli_query($conn,$sql36) or die(mysqli_error());
					while($info36 = mysqli_fetch_array( $data36 )) {
						$sn = $info36['sn'];
						$userid = $info36['memberid'];
						$amount = $info36['amount'];
						$trc = $info36['trc'];
						$created_date = $info36['created_date'];
						
						$TIME = date("h:i:sa", strtotime($created_date));
						$date = date("d-m-Y", strtotime($created_date));
					?>
                    <tr>
                        <!--<td class="text-center"><?=$i?></td>-->
                        <td class="text-center"><?=$sn?></td>
                        <td><strong><?=$userid?></strong></td>
                        <td><?=$amount?></td>
						<td><?=$TIME?></td>
						<td><?=$date?></td>
						<td><?=$trc?></td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
</table>
</div>
<?php } else { echo "<h1 class='glow4'>No Transaction Today</h1>"; } ?>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
	  
    </div>
  </div>
</div>

<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>

<script>
function hidenshow() {
  var x = document.getElementById("hidDiv");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDivmini2");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "block";
  }
}
</script>
<script>
function hidenshow2() {
  var x = document.getElementById("hidDivmini");
  var y = document.getElementById("hidDivmini2");
  var z = document.getElementById("hidDiv2");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "block";
  }
}
</script>



<?php if(isset($_GET['userid'])) { ?>
<iframe onload="hidenshowx3()" style="display: none"></iframe>
<script>document.addEventListener("load", hidenshowx3);
function hidenshowx3() {
	
  
  var x = document.getElementById("hidDiv");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDivmini2");
  var w = document.getElementById("hidDivmini");

    x.style.display = "none";
    y.style.display = "none";
    z.style.display = "none";
    w.style.display = "block";
	 
	//alert("Page is loaded");

}
</script>
<?php } ?>