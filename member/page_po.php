<?php
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); }
$username=$_SESSION['USERPRO'];
include "content/header.php"; 
//include "content/preloader.php"; 
include "content/nav.php";

		/* ********************** */
		if(isset($_GET['paydate'])) {
		$paydate = $_GET['paydate'];
		}
		else { $paydate=date("Y-m-d"); }
		/* ********************** */
		$datetaju = date("d/m/Y", strtotime($paydate));

$sql42="SELECT walletpo from wallet WHERE id='$_SESSION[USERPRO]'";
$data42 = mysqli_query($conn,$sql42) or die(mysqli_error($conn));
$info42 = mysqli_fetch_array( $data42 );
$walletpo = $info42['walletpo'];
$walletpo=number_format((float)$walletpo, 2, '.', '');
?>


 <!-- Section A (atas) -->
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow">PAY OUT</h3>
	</div>
	<div class="box-welcome2">
	
	<center>
	<table style="background: url('https://thumbs.gfycat.com/EcstaticAgreeableIndri-size_restricted.gif'); color: #ffee00; background-size: 100% 100%; border: 1px solid #f4511e; width: 320px;">
	<tr><td>
	<h4 class="glow2">PO Wallet</h4>
	<h2 class="glow1">$ <?=$walletpo?></h2>
	</td></tr>
	</table></center>
	<br>
	</div>
	
  </div>
  </div>
  </div>
 <!-- Done Section A -->


 <!-- Section B (bawah) -->
<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_po.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">TRANSACTION ON <?=$datetaju?></h3>
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"></td></tr></table>
	</div>
	</form>
		  
        </div>
        <div class="paid-out glow3">

	
	<?php
	if($paydate!=""){ ?>
<div class="table-responsive">
            <table id="example-datatable" class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 150px;">Date</th>
                        <th>Member Id</th>
                        <th>Full Name</th>
                        <th>Country Local Bank Name</th>
                        <th>Holder Name</th>
                        <th>Account Number</th>
                        <th>Phone Number</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <!--<th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE A.leader='$_SESSION[USERPRO]' AND W.id=A.userid AND U.id=A.userid AND W.created_date LIKE '$paydate%'") or die(mysqli_error($conn));
					while($info = mysqli_fetch_array( $data )) {
					
					$sn = $info['sn'];
					$id = $info['id'];
					$fname = $info['fname'];
					$phone = $info['phone'];
					$amount = $info['amount'];
					$akaunb = $info['akaunb'];
					$penama = $info['penama'];
					$jenisb = $info['jenisb'];
					$stat = $info['stat'];
					
					//$created_date = $info['created_date'];
$data69 = mysqli_query($conn,"SELECT created_date FROM wd WHERE id='".$id."' AND sn='".$sn."'") or die(mysqli_error($conn));
$info69 = mysqli_fetch_array( $data69 );
$created_date = $info69['created_date'];
						
					if($info['stat'] =='Active' ){ $la="label-success"; }
					if($info['stat'] =='Completed' ){ $la="label-info"; }
					?>
                    <tr>
                        <td class="text-center"><?=$created_date?></td>
                        <td><?=$id?></td>
                        <td><?=$fname?></td>
                        <td><?=$jenisb?></td>
                        <td><?=$penama?></td>
                        <td><?=$akaunb?></td>
                        <td><?=$phone?></td>
                        <td><?=$amount?></td>
                        <td>
						
						<?php 
						if(($stat=="Processing")||($stat=="Processing_Token")){  
						if($walletpo<$amount){ $disabled="disabled"; }
						if($walletpo>=$amount){ $disabled=null; }
						?>
						  <form action='update_page_po.php' method='POST'>
							<input type='hidden' name='sn' value='<?=$sn?>'>
							<input type='hidden' name='walletpo' value='<?=$walletpo?>'>
<input type='hidden' name='amount' value='<?=$amount?>'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='stat' value='<?=$stat?>'>
							<?=$stat?> &nbsp; <button type="submit" title="Paymaster" class="btn btn-effect-ripple btn-xs btn-danger <?=$disabled?>">Pay &nbsp;<i class="fa fa-cc-discover"></i></button>
						  </form>
						<?php } 
						else {
							?><?=$stat?> &nbsp; <button title="Paymaster Completed" class="btn btn-effect-ripple btn-xs btn-success">Completed &nbsp; <i class="gi gi-ok_2"></i></button><?php
							if($stat=="Completed_Token"){
							    ?><button title="Pay Token Paid" class="btn btn-effect-ripple btn-xs btn-warning"><i class="gi gi-coins"></i></button><?php
							}
						}
						?>
						</td>
                    </tr>
                    <?php 
					}
					?>
                </tbody>
            </table>
        </div>
		</div>
      </div>
	  <div class="box-topinvestor-footer"></div>
    </div>
  </div>
</div>
<?php	
}
	else { echo "<code>No Date Selected. Please Select...</code>"; }
	?>
<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>