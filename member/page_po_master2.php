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

?>



 <!-- Section B (bawah) -->
<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">

      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_po_master2.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">TRANSACTION ON <?=$datetaju?></h3>
	<a href="download_po2.php?paydate=<?=$paydate?>" class="buttonx buttonx1">Download</a> <br><br>
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"> 
	</td></tr></table>
	</div>
	</form>
		  
        </div>
        <div class="paid-out glow3">

	
	<?php
	if($paydate!=""){ ?>
	
<?php
$sql53="SELECT count(id) as merc FROM wd WHERE  created_date LIKE '$paydate%'";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];
if($merc>0){
?>
<div class="table-responsive">
            <table id="example-datatable" class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px;">No.</th>
                        <th class="text-center" style="width: 150px;">Time</th>
                        <th>Member Id</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>TRUST WALLET</th>
                        <th>BTC WALLET</th>
                        <th>Amount USDT</th>
                        <th>Payment Status</th>
                        <!--<th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$numb=0;
//$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE A.leader='$_SESSION[USERPRO]' AND W.id=A.userid AND U.id=A.userid AND W.created_date LIKE '$paydate%'") or die(mysqli_error($conn));
$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE  W.id=A.userid AND U.id=A.userid AND W.id!='' AND W.typ='USDT' AND W.created_date LIKE '$paydate%' ORDER BY U.akaunb ASC") or die(mysqli_error($conn)); //ORDER BY W.created_date
					while($info = mysqli_fetch_array( $data )) {
					$numb++;
					$sn = $info['sn'];
					$id = $info['id'];
					$fname = $info['fname'];
					$phone = $info['phone'];
					$amount = $info['amount'];
					$akaunb = $info['akaunb'];
					$penama = $info['penama'];
					$jenisb = $info['jenisb'];
					$trustwallet = $info['trustwallet'];
					$addressbtc = $info['addressbtc'];
					$stat = $info['stat'];
					
					//$created_date = $info['created_date'];
$data69 = mysqli_query($conn,"SELECT created_date FROM wd WHERE id='".$id."' AND sn='".$sn."'") or die(mysqli_error($conn));
$info69 = mysqli_fetch_array( $data69 );
$created_date = $info69['created_date'];
$TIME = date("h:i:sa", strtotime($created_date));
					if($info['stat'] =='Active' ){ $la="label-success"; }
					if($info['stat'] =='Completed' ){ $la="label-info"; }
					?>
                    <tr>
                        <td class="text-center"><?=$numb?></td>
                        <td class="text-center"><?=$TIME?></td>
                        <td><?=$id?></td>
                        <td><?=$fname?></td>
                        <td><?=$phone?></td>
                        <td><?=$trustwallet?></td>
                        <td><?=$addressbtc?></td>
                        <td><?=$amount?></td>
						<!--< off?php $myr = $amount*3.7; $myr=number_format((float)$myr, 2, '.', ''); ?><td>RM < off?=$myr?></td>-->
                        <td>
						<?php 
						if(($stat=="Processing")||($stat=="Processing_Token")){
						?>
<form action='update_page_po_master.php' method='POST'>
<input type='hidden' name='sn' value='<?=$sn?>'>
<input type='hidden' name='amount' value='<?=$amount?>'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='stat' value='<?=$stat?>'>
<?=$stat?> &nbsp; <button type="submit" title="Paymaster" class="btn btn-effect-ripple btn-xs btn-danger">Pay &nbsp;<i class="fa fa-cc-discover"></i></button>
<!--<a href="x_delete_widthraw_request.php?ID=<?=$id?>&SN=<?=$sn?>&AM=<?=$amount?>" class="bt bt1" onclick="return confirm('Cancel and Notify Member about Invalid or Suspicious Bank Account');">Invalid Acc</a>-->
</form>
						<?php } 
						//buat se lg cancel
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
		 <?php } else { echo "<br><br><h1 class='glow4'>No Withdrawal Transaction Today</h1><br><br>"; } ?>
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