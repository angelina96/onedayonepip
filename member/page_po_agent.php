<?php 
//line 41
ob_start();
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav2.php";

date_default_timezone_set('Asia/Kuala_Lumpur');
if(isset($_GET['paydate'])) {
$paydate = $_GET['paydate'];
}
else { $paydate=date("Y-m-d"); }
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
		
<div id="players" class="container-fluid plan-bg-master" style="min-height:90vh;">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
		<div class="blueline text-center">
			<div class="box-master">
	<form action="page_po_agent.php" method="GET" class="form-inline">
	<div class="form-group">
	
	<h3 class="glow7">TRANSACTION ON <?=$datetaju?></h3>
	<!--<a href="download_po.php?paydate=<?=$paydate?>" class="buttonx buttonx1">Download</a> <br><br>-->
	<table width="100%"><tr><td>
	<input type="date" name="paydate" class="form-control" value="<?=$paydate?>"></td><td>
	<input type="submit" value="Display" class="btn btn-effect-ripple btn-info"> 
	</td></tr></table>
	</div>
	</form>
			</div>
			<div class="paid-out glow5">
			<div class="table-responsive">
<?php
$numb=0;
//$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE A.leader='$_SESSION[USERPRO]' AND W.id=A.userid AND U.id=A.userid AND W.created_date LIKE '$paydate%'") or die(mysqli_error($conn));
$data = mysqli_query($conn,"SELECT * FROM wd W,affiliate A, userpro U  WHERE  W.id=A.userid AND U.id=A.userid AND W.id!='' AND W.typ is null AND W.amount<300 AND W.created_date LIKE '$paydate%' ORDER BY W.amount ASC") or die(mysqli_error($conn)); //ORDER BY W.created_date
$countrow = mysqli_num_rows( $data );
if ($countrow>0){
?>
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
                    </tr>
                </thead>
                <tbody>
<?php 
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
                        <td class="text-center">
						
<!--<table border="2"><tr><td width="40px"><input id="<?=$sn?>" value="<?=$sn?>"  name="invite[]" type="checkbox" class="chk"></td><td width="40px"><?=$sn;?>.</td></tr></table> -->
						
						<?=$numb?></td>
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
						<?php /*
						if(($stat=="Processing")||($stat=="Processing_Token")){
						?>
<!--<form action='update_page_po_agent.php' method='POST'>
<input type='hidden' name='sn' value='<?=$sn?>'>
<input type='hidden' name='amount' value='<?=$amount?>'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='stat' value='<?=$stat?>'>
<?=$stat?> &nbsp; <button type="submit" title="Paymaster" class="btn btn-effect-ripple btn-xs btn-danger">Pay &nbsp;<i class="fa fa-cc-discover"></i></button>
<a href="x_delete_widthraw_request.php?ID=<?=$id?>&SN=<?=$sn?>&AM=<?=$amount?>" class="bt bt1" onclick="return confirm('Cancel and Notify Member about Invalid or Suspicious Bank Account');">Invalid Acc</a>
</form>-->
PROCESSING<button title="Paymaster" class="btn btn-effect-ripple btn-xs btn-danger">Pay &nbsp;<i class="fa fa-cc-discover"></i></button>
						<?php } 
						//buat se lg cancel
						else {
							?><?=$stat?> &nbsp; <button title="Paymaster Completed" class="btn btn-effect-ripple btn-xs btn-success">Completed &nbsp; <i class="gi gi-ok_2"></i></button><?php
							if($stat=="Completed_Token"){
							?><button title="Pay Token Paid" class="btn btn-effect-ripple btn-xs btn-warning"><i class="gi gi-coins"></i></button><?php
							}
						} */
						?>
						
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
					} else { echo "No Data"; }
					?>
                </tbody>
            </table>
			

        </div>
			</div>
		</div>
    </div>
  </div>

</div>

      
<!-- **************FOOTER***************** -->
<?php //data: {sn:sn,id:id,stat:stat},
//include "content/footer.php"; 
?>

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
<!--<button target="_blank" class="btn btn-default" type="button" id="getValue"><img src="images/good.gif" width="18" height="18" border="0" alt=""> Paid to Selected</button>Paid To All<input type="checkbox" name="select-all" id="select-all"/>
<script>
$(document).ready(function(){
    $('#getValue').on('click', function(){
        // Declare a checkbox array
        var chkArray = [];
		
        // Look for all checkboxes that have a specific class and was checked
        $(".chk:checked").each(function() {
            chkArray.push($(this).val());
        });
        
        // Join the array separated by the comma
        var selected;
        selected = chkArray.join('&id%5B%5D=') ;

        // Check if there are selected checkboxes
        if(selected.length > 0){
            //alert("Selected checkboxes value: " + selected);
			window.open("page_po_pay_all.php?id%5B%5D="+selected+"&sn%5B%5D="+selected , '_blank');
        }else{
            alert("Please Select Paid Account!");
        }
    });
});
</script>

<script language="JavaScript">
// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});
</script>-->

