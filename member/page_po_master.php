<?php
//line 111
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

		<style>
		label > input{ /* HIDE RADIO */
		  visibility: hidden; /* Makes input not-clickable */
		  position: absolute; /* Remove input from document flow */
		}
		label > input + img{ /* IMAGE STYLES */
		  cursor:pointer;
		  // border:2px solid #00ddff; /* transparent */
		}
		label > input:checked + img{ /* (RADIO CHECKED) IMAGE STYLES */
		  border:5px solid #00FF00;
		}
		</style>
<style>
div.fixed {
  position: fixed;
  bottom: 0;
  left: 0;
  background-color: #00008B;
  width: 300px;
  height: 50px;
  border: 3px solid #00ffff;
}
</style>
<div class="fixed">
<h4 class="glow3" id="result"></h4>
</div>
 <!-- Section B (bawah) -->
<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">

      <div class="outernormalbox text-center">
        <div class="box-wallet">
	<form action="page_po_master.php" method="GET" class="form-inline">
	<div class="form-group">
	<h3 class="glow4">TRANSACTION ON <?=$datetaju?></h3>
	<a href="download_po.php?paydate=<?=$paydate?>" class="buttonx buttonx1">Download</a> <br><br>
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
                        <th>Country Local Bank Name</th>
                        <th>Holder Name</th>
                        <th>Account Number</th>
                        <th>Phone Number</th>
                        <th>Amount USD</th>
                        <th>MYR</th>
                        <th>Payment Status</th>
                        <!--<th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$numb=0;
//$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE A.leader='$_SESSION[USERPRO]' AND W.id=A.userid AND U.id=A.userid AND W.created_date LIKE '$paydate%'") or die(mysqli_error($conn));
$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE  W.id=A.userid AND U.id=A.userid AND W.id!='' AND W.typ is null AND W.created_date LIKE '$paydate%' ORDER BY W.amount ASC") or die(mysqli_error($conn)); //ORDER BY W.created_date
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
                        <td><?=$jenisb?></td>
                        <td><?=$penama?></td>
                        <td><?=$akaunb?></td>
                        <td><?=$phone?></td>
                        <td><?=$amount?></td>
						<?php $myr = $amount*3.7; $myr=number_format((float)$myr, 2, '.', ''); ?>
                        <td>RM <?=$myr?></td>
                        <td>
						<?php 
						if ($amount<300) { ?><button class="btn btn-effect-ripple btn-xs btn-primary">Pay Agent<i class="gi gi-coins"></i></button><?php } 
						/* ?>
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
						*/?>
						<form name="form1" id="form1" action="xxxxupdate_page_po_agent2.php" method="POST">
						<input type="hidden" value="<?=$sn?>" name="sn<?=$numb?>" > 
						<input type="hidden" value="<?=$id?>" name="id<?=$numb?>" >
						<div class="item form-group">
						<table>
						<tr>
						<td><label><input type="radio" name="stat" value="1<?=$numb?>" <?php if ($stat=='Processing'){echo "CHECKED";} ?>> <img src = "images/paid2.png" height="40px" width="80px"></label></td>
						<td><label><input type="radio" name="stat" value="2<?=$numb?>"  <?php if ($stat=='Completed'){echo "CHECKED";} ?>><img src = "images/paid.png" height="40px" width="80px"></label></td>
						</tr></table>
						</div>
						</form>
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
<!-- AUTO UPDATE SCRIPT -->
<script>
$(document).ready(function() {
  $('input[type="radio"][name="stat"]').click(function() {
    
	var stat = $(this).val();
	var status = stat.substring(0, 1);
	var no = stat.substring(1);
	//var hah = "id"+no;
	//var sn = $('input[name="sn"]').val();
	var id = $("input[name='id"+no+"']").val();
	var sn = $("input[name='sn"+no+"']").val();
	
	
	//console.log(no);
	//console.log(status);
	//console.log(id);
	
	
    $.ajax({
      url: "update_page_po_agent2.php",
      type: "POST",
      data: {sn:sn,id:id,status:status},
      success: function(data) {
        $('#result').html(data);
      }
    });
	
  });
});
</script>
<?php include "content/footer.php"; ?>