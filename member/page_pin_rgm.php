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
date_default_timezone_set('Asia/Kuala_Lumpur');
if(isset($_GET['paydate'])) {
$paydate = $_GET['paydate'];
}
else { 
$paydate=date("Y-m-d"); 
}
$datetaju = date("d/m/Y", strtotime($paydate));
?>
<style>
     .glow7 {
    color: #fff;
    text-align: center;
    text-shadow: 0 0 10px rgba(255, 0, 0, 0.774), 0 0 20px #ff00dd, 0 0 30px #ff00dd, 0 0 40px #ff00dd;
   }
</style>
<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
		<div class="outernormalbox text-center">
			<div class="box-wallet">
				RGM USD PIN
			</div>
			<div class="paid-out">
			<div class="table-responsive glow3">
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
					$data = mysqli_query($conn,"SELECT * FROM userpro U, wallet W WHERE U.akaun='LP' and W.id=U.id") or die(mysqli_error($conn));
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
			  </div>
			</div>
		</div>
		<br><hr><br>
<!--List Content-->
<div class="table-responsive glow7">
<?php 
$i="1";
//$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND (trc='Deposit' OR trc='Paywallet') AND sender='$username' ORDER BY created_date DESC";
$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='Paywallet' ORDER BY created_date DESC";
$data36 = mysqli_query($conn,$sql36) or die(mysqli_error());
$countrow36 = mysqli_num_rows( $data36 );
if ($countrow36>0){
?>
<table class="table" style="width:100%; text-align:center;" border="1">
<thead>
<tr class="glow4">
<!--<th class="text-center" style="width: 50px;">SN</th>-->
<th>No.</th>
<th>RGM ID</th>
<th>Pin Amount</th>
<th>Time</th>
<th>Transaction</th>
</tr>
</thead>
<tbody>
                    
					<?php
					while($info36 = mysqli_fetch_array( $data36 )) {
						$sn = $info36['sn'];
						$userid = $info36['memberid'];
						$amount = $info36['amount']; $amount=number_format((float)$amount, 2, '.', '');
						$trc = $info36['trc'];
						$created_date = $info36['created_date'];
						
						$TIME = date("h:i:sa", strtotime($created_date));
						$date = date("d-m-Y", strtotime($created_date));
					?>
                    <tr>
                        <td class="text-center" width="2%"><?=$i?></td>
                        <td><strong><?=$userid?></strong></td>
                        <td><font class="glow6" style="color:#FFFF00;"><?=$amount?></font></td>
						<td><?=$TIME?></td>
						<td><font color="#FFFF00"><?=$trc?></font> <br>Ref.No[<?=$sn?>]</td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
</table>
<?php } else { echo "Transaction Empty Today"; } ?>

	<div class="form-group">
	<center><form action="page_pin_rgm.php" method="GET">
	<table><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"></td></tr></table>
	</form></center>
	</div>
</div>
<!--End List Content-->
		
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
echo ("<script LANGUAGE='JavaScript'>window.location.href='page_pin_rgm.php';</script>");
exit();
}
else { echo ("<script LANGUAGE='JavaScript'>window.alert('Try Again');window.location.href='page_pin_rgm.php';</script>"); }
  }
?>

<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>