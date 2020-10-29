<?php 
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$sql23="SELECT * from userpro WHERE id='$username'";
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
 
$sql5="SELECT walletc from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletc'];
$balance=number_format((float)$balance, 2, '.', '');

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
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">PAY WALLET - SENT POINT TO DOWNLINE</h3>
	</div>
	<div class="box-welcome2">
	
	<center>
	<table style="background: url('https://thumbs.gfycat.com/EcstaticAgreeableIndri-size_restricted.gif'); color: #ffee00; background-size: 100% 100%; border: 1px solid #f4511e; width: 320px;">
	<tr><td>
	<h4 class="glow2">BALANCE</h4>
	<h2 class="glow1">$ <?=$balance?></h2>
	</td></tr>
	</table></center>
	<br>
		
<!-- CEK USER -->
<div id="fallforest" <?=$displaycekuser?>>
				<?php if($balance>0){ ?>
                <form id="form-validation" action="page_paywallet1.php" method="POST" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User ID </label>
                        <div class="col-md-6">
                            <input type="text" value="<?=$userid?>" name="userid" class="form-control" placeholder="User ID">
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" value="FIND USER" class="btn btn-block btn-primary">
                            <!--<input type="reset" value="Reset" class="btn btn-effect-ripple btn-danger">-->
                        </div>
                    </div>
                </form>
				<?php if($code!=''){ ?>
				<center><code><?=$code?></code></center>
				<? } /*close code*/
				   }/*close cek balance*/ else { echo "INSUFFICIENT FUNDS"; } ?>
            </div>
<!-- DONE CEK USER -->
<!-- SEND TOKEN -->
			<div id="santopany" <?=$displaysendtoken?>>
            <div class="block full">
			<div class="block-title">
                    <h2 class="glow4">USER EXIST! SEND USD</h2>
                </div>
                <form id="form-validation" action="page_paywallet2.php" method="POST" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User ID </label>
                        <div class="col-md-6">
                            <input type="HIDDEN" value="<?=$userid?>" name="userid" class="form-control" placeholder="Balance" readonly><H3 CLASS="glow4"><?=$userid?></H3>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="amount">Amount <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                            <input type="number" id="amount" name="amount" class="form-control floatNumberField" placeholder="AMOUNT TOPUP BY USER" min="0.01" max="<?=$balance?>" step="0.01" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" value="SEND USD POINT" class="btn btn-effect-ripple btn-primary">
                            <a href="page_paywallet.php" class="btn btn-effect-ripple btn-danger">CANCEL</a> 
                        </div>
                    </div>
                </form>
            </div>
            </div>
<!-- DONE SEND TOKEN -->
	</div>
	
  </div>
  </div>
  </div>


<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
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
<th>TRANSACTION</th>
</tr>
</thead>
<tbody>
                    <?php 
					$i="1";
					$sql36="SELECT * FROM walletlog WHERE sender='$username' AND created_date LIKE '$paydate%' ORDER BY created_date DESC";
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