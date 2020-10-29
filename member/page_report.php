<?php
session_start();
//include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); }
$username=$_SESSION['USERPRO'];
include "content/header.php"; 
//include "content/preloader.php"; 
include "content/nav.php";

//DECLARE
$totalamount='0';
$kiBASIC='0';
$totalkiBASIC='0';

		/* ********************** */
		if(isset($_GET['paydate'])) {
		$paydate = $_GET['paydate'];
		}
		else { $paydate=date("Y-m-d"); }
		/* ********************** */
		$datetaju = date("d/m/Y", strtotime($paydate));
//echo $paydate;
?>
 <!-- Section B (bawah) -->
<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">

      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_report.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">SALE REPORT ON <?=$datetaju?></h3>
	<!--<a href="download_po.php?paydate=<?=$paydate?>" class="buttonx buttonx1">Download</a> <br><br>-->
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"> 
	</td></tr></table>
	</div>
	</form>
		  
        </div>
        <div class="paid-out glow3">

	
<?php
$sql53="SELECT count(id) as merc FROM invest WHERE  created_date LIKE '$paydate%'";
$data53 = mysqli_query($conn,$sql53) or die(mysqli_error());
$info53 = mysqli_fetch_array($data53);
$merc = $info53['merc'];
if($merc>0){
?>
<div class="table-responsive">
            <table id="example-datatable" class="table table-bordered table-vcenter">
                <thead>
                    <tr>
						<th>No.</th>
                        <th class="text-center" style="width: 150px;">Clock</th>
                        <th>Member Id</th>
                        <th>Amount USD</th>
                        <th>MYR</th>
                        <th>Upline</th>
                        <th>RGM</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
/* sql54 */
$data = mysqli_query($conn,"
SELECT 
invest.sn,
invest.id,
invest.planroi,
invest.planday,
invest.stat,
userpro.fname,
invest.created_date,
invest.amount ,
invest.planname

FROM invest, userpro 

WHERE invest.id=userpro.id 
AND invest.created_date LIKE '$paydate%' 
ORDER BY invest.created_date ASC
") or die(mysqli_error($conn));
$counter=0;
while($info = mysqli_fetch_array( $data )) {
$counter++;
	$sn = $info['sn'];
	$id = $info['id'];
	$stat = $info['stat'];
	$fname = $info['fname'];
	$amount = $info['amount'];
	$planroi = $info['planroi'];
	$planday = $info['planday'];
	$planname = $info['planname'];
	$created_date = $info['created_date'];
	$TIME = date("h:i:sa", strtotime($created_date));
	$date = date("d-m-Y", strtotime($created_date));
	
	$totalamount=$totalamount+$amount;
	$kiBASIC=($amount*($planroi/100));
	$kiBASIC=number_format((float)$kiBASIC, 2, '.', '');
	$totalkiBASIC = $totalkiBASIC+$kiBASIC;

/* $data69 = mysqli_query($conn,"SELECT created_date FROM invest WHERE id='".$id."' AND sn='".$sn."'") or die(mysqli_error($conn));
$info69 = mysqli_fetch_array( $data69 );
$created_date = $info69['created_date']; */
$sql25="SELECT upline,leader from affiliate WHERE userid='$id'";
$data25 = mysqli_query($conn,$sql25) or die(mysqli_error($conn));
$info25 = mysqli_fetch_array( $data25 );
$upline = $info25['upline'];
$rgm = $info25['leader'];
?>
                    <tr>
						<td><?=$counter?></td>
                        <td class="text-center"><?=$TIME?></td>
                        <td><?=$id?></td>
                        <td><?=$amount?></td>
						<?php $myr = $amount*3.7; $myr=number_format((float)$myr, 2, '.', ''); ?>
                        <td>RM <?=$myr?></td>
                        <td><?=$upline?></td>
                        <td><?=$rgm?></td>
                    </tr>
                    <?php 
					}
					?>
                </tbody>
            </table>
        </div>
		 <?php } else { echo "<br><br><h1 class='glow4'>No Sale Today</h1><br><br>"; } ?>
		</div>
      </div>
	  <div class="box-topinvestor-footer"></div>
	
		<br><br>
		<?php
		$current  = strtotime($paydate);
		$days     = $planday * 86400;
		$payday      = $current + $days;
		$payday = date('d/m/Y', $payday);
		?>
            
<table class="table table-bordered table-vcenter" style="background:url('https://www.cdnsol.com/blog/wp-content/uploads/2017/11/Blockchain-Technology-Solutions.gif'); background-size: 100% auto; color: yellow;">
				<tr>
					<td>TOTAL AMOUNT</td>
					<td><?=$totalamount?>USD</td>
				</tr>
				<tr>
					<td>ROI PAYOUT</td>
					<td><?=$totalkiBASIC?>USD</td>
				</tr>
				<tr>
					<td>PAYOUT DATE</td>
					<td><?=$payday?></td>
				</tr>
				
			</table>
    </div>
  </div>
</div>

<!-- **************FOOTER***************** -->
<?php include "content/footer.php"; ?>