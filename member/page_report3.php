<?php 
ob_start();
session_start();
//include "logintime.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

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
//$sql53="SELECT count(memberid) as merc FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='USDT' ORDER BY created_date DESC";
$sql53="SELECT count(memberid) as merc FROM btcdepo WHERE created_date LIKE '$paydate%' ORDER BY created_date DESC";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];

?>
      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_report3.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">DEPO REPORT <?=$datetaju?></h3>
	
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info55"></td></tr></table>
	</div>
	</form>
		  
        </div>
        <div class="paid-out glow3">
		<?php if($merc>0){ ?>
<div class="table-responsive">
<table class="table" style="width:100%; text-align:center;color:yellow;" border="1">
<thead>
<tr class="glow4">
<!--<th class="text-center" style="width: 50px;">SN</th>-->
	<th class="text-center" style="width: 50px;">No.</th>
	<th>Member ID</th>
	<th>Wallet</th>
	<th>Amount Request (BTC)</th>
	<th>Time</th>
	<th>Status</th>
</tr>
</thead>
<tbody>

<!-- start coffee -->
                    <?php 
					$i="1"; $totaldepo='0';
					//$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND (trc='Deposit' OR trc='Paywallet') ORDER BY created_date DESC";
					//$sql36="SELECT * FROM walletlog WHERE created_date LIKE '$paydate%' AND trc='Deposit' ORDER BY created_date DESC";
					//$data36 = mysqli_query($conn,$sql36) or die(mysqli_error());
					
					$data55 = mysqli_query($conn,"SELECT * FROM userpro, btcdepo , wallet WHERE userpro.id=btcdepo.memberid and wallet.id=btcdepo.memberid AND btcdepo.created_date LIKE '$paydate%' ORDER BY btcdepo.created_date DESC") or die(mysqli_error());
					while($info55 = mysqli_fetch_array( $data55 )) {
						$sn = $info55['sn'];
						$memberid = $info55['memberid'];
						$fname = $info55['fname']; if($fname==null){$fname="Anonymous";}
						$emel = $info55['email'];
						$phone = $info55['phone'];
						$addressbtc = $info55['addressbtc'];
						$amount = $info55['amount'];
						$stat = $info55['stat'];
						$walletb = $info55['walletb'];
						$addressbtc = $info55['addressbtc'];
						$cointype = $info55['cointype'];
					if($cointype=='1'){ $cointype2="Option 1"; }
					if($cointype=='2'){ $cointype2="Option 2"; }
					if($cointype=='3'){ $cointype2="Freewallet"; }
						
						$data56 = mysqli_query($conn,"SELECT created_date FROM btcdepo WHERE sn='$sn'") or die(mysqli_error());
						$info56 = mysqli_fetch_array( $data56 );
						$created_date56 = $info56['created_date'];
						
						$TIME56 = date("h:i:sa", strtotime($created_date56));
						//$TIME = date("h:i:sa", strtotime($created_date));
						//$date = date("d-m-Y", strtotime($created_date));
					?>
                    <tr>
                        <td class="text-center"><?=$i?></td>
                        <td><strong><?=$memberid?></strong></td>
						<!-- WALLET -->
                        <td>
						<?php if($stat=="Processing"){ ?>
										<div id="P2<?=$i?>">
										<button onclick="hnsP<?=$i?>()" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-pencil"></i>Send Point</button>
										</div>
										
										<div id="P<?=$i?>" style="display: none;color:black;">
										<form action="page_report3_sendusdt.php" method="POST">
										<input type="hidden" name="memberid" value="<?=$memberid?>" required>
										<input type="hidden" name="sn" value="<?=$sn?>" required>
										<input type="hidden" name="walletb" value="<?=$walletb?>" required>
										<input type="number" min="0" step="0.01" name="point" class="floatNumberField" required>
										<button type="submit" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-pencil"></i>Send</button>
										</form>
										<button onclick="hnsP<?=$i?>()" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i>Cancel</button>
										</div>

										
						<font style="color:#7CFC00;font-size:12px;">Via <?=$cointype2?></font>
						<!--<div class="form-group">
                                  <div class="input-group mb-md">
                                    <input type="text" class="form-control" id="myInput" value="<?=$addressbtc?>" readonly>
									
                                    <div class="input-group-btn">
                                      <button type="button" class="btn btn-primary copy-to-clipboard" tabindex="-1" onclick="myFunction()">Copy Address</button>
                                    </div>
                                  </div>
                                  <div class='copied'></div>
                              </div>-->
							  
							  
						<?php } else { echo "USDT Sent"; } ?>
						</td>
						<?php $TIME = date("h:i:sa", strtotime($created_date56));
						//$date = date("d-m-Y", strtotime($created_date56)); 
						?>
                        <td><?=$amount?></td>
						<!--<td><?=$date?></td>--><td><?=$TIME?></td>
                        <!--<td><?=$emel?></td>
                        <td><?=$phone?></td>
                        <td><?=$addressbtc?></td>
                        <td><?=$lastlogin?></td>
                        <td><?=$ipaddress?></td>-->
                        <td><?=$stat?><!-- OFFDULU
						<?php 
						if($akaun=="MEMBER"){ $update_akaun="LP"; }
						if($akaun=="LP"){ $update_akaun="MEMBER"; } 
						?>
						  <form action='update_page_players.php' method='POST'>
							<input type='hidden' name='memberid' value='<?=$memberid?>'>
							<input type='hidden' name='akaun' value='<?=$update_akaun?>'>
							<button type="submit" title="Promote/Demote User" class="btn btn-effect-ripple btn-xs btn-danger"><i class="gi gi-transfer"></i></button> <?=$akaun?>
						  </form> -->
						</td>
                        <!--<td class="text-center">
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Edit User" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" data-toggle="tooltip" title="Delete User" class="btn btn-effect-ripple btn-xs btn-danger"><i class="fa fa-times"></i></a>
                        </td> -->
						
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
<!-- end coffee -->
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
USDT</h1></td></tr></table>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".floatNumberField").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });
    });
</script>
<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>