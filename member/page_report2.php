<?php 
ob_start();
session_start();
//include "logintime.php";
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

<div id="players" class="container-fluid plan-bg" style="min-height:80vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
	
<?php
$sql53="SELECT count(memberid) as merc FROM walletlog WHERE created_date LIKE '$paydate%' AND (trc='Deposit' OR trc='Paywallet') ORDER BY created_date DESC";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];

?>
      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_report2.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">DEPO REPORT <?=$datetaju?></h3>
	
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
<th>Sender Transaction</th>
</tr>
</thead>
<tbody>
                    <?php 
					$i="1"; $totaldepo='0';
					//$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND (trc='Deposit' OR trc='Paywallet') ORDER BY created_date DESC";
					$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='Deposit' ORDER BY created_date DESC";
					$data36 = mysqli_query($conn,$sql36) or die(mysqli_error());
					while($info36 = mysqli_fetch_array( $data36 )) {
						$sn = $info36['sn'];
						$userid = $info36['memberid'];
						$sender = $info36['sender'];
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
						<td><?=$sender?> -- <?=$trc?></td>
                    </tr>
                    <?php $i++;
						$totaldepo = $totaldepo+$amount;
					} ?>
                </tbody>
</table>
</div>
<?php } else { echo "<h1 class='glow4'>No Transaction Today</h1>"; } ?>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
	  
    </div>
  </div>
<table class="table table-bordered table-vcenter" style="background:url('https://www.cdnsol.com/blog/wp-content/uploads/2017/11/Blockchain-Technology-Solutions.gif'); background-size:100% auto; color: yellow;">
<tr>
<th>Summary</th>
<th>Total Deposited Today <h3><b><?=$datetaju?></b></h3></th>
</tr>
<tr>
<td>TOTAL AMOUNT</td>
<td><h1>
<?php 
echo number_format($totaldepo,2)." ";
?>
USD</h1></td></tr></table>
</div>

<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>