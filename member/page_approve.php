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



?>
<div id="myPage" class="bg-homerun text-center">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">APPROVE MEMBER</h3>
	</div>
	<div class="box-welcome2">
		<img src="images/logo_user.png" style="width: 50px;height: 50px;">
	</div>
	
  </div>
  </div>
  </div>


<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="outernormalbox text-center">
     
<div class="paid-out glow2">
<!-- #################### START SEMAK MEMBER ############################# -->
<div class="block full">
        <div class="block-title">
            <h2 class="glow4">MEMBER INFORMATION CHECK</h2>
        </div>
        <div class="table-responsive">
<style>
table, th, td {
 
  text-align: center;
}
</style>
            <table id="example-datatable" class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">No.</th>
                        <th>Username</th>
                        <th>Verify Status</th>
                        <th>Phone</th>
                        <th>Full Name</th>
                        <th>upline</th>
                        <th>Bank Holder Name</th>
                        <th>Check IC</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
<?php
$i=1;

$i='1';
//$sql37="SELECT * FROM userpro WHERE akaun!='MASTER' AND ( verifymel='N' OR verifymel='V' ) ORDER BY created_date DESC";
$sql37="SELECT * FROM userpro WHERE akaun!='MASTER' AND verifymel='N' ORDER BY created_date DESC";
$data = mysqli_query($conn,$sql37) or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$id   = $info['id'];
//$pwd   = $info['pwd'];
$verifymel   = $info['verifymel'];
$emel   = $info['email'];
$phone   = $info['phone'];
$fname   = $info['fname'];
$penama   = $info['penama'];
$jenisb   = $info['jenisb'];
$address   = $info['address'];
$lastlogin   = $info['lastlogin'];

if($verifymel=="N"){ $verifymelxx="New Member"; }
if($verifymel=="V"){ $verifymelxx="Account Picture Re-Verify"; }
if($verifymel=="Y"){ $verifymelxx="Account Verified"; }


$sql25="SELECT upline from affiliate WHERE userid='$id'";
$data25 = mysqli_query($conn,$sql25) or die(mysqli_error($conn));
$info25 = mysqli_fetch_array( $data25 );
$upline = $info25['upline'];
?>
                    <tr>
                        <td><?=$i?></td>
                        <td><font color="#7CFC00"><?=$id?></font></td>
                        <td><?=$verifymelxx?></td>
                        <td><?=$phone?></td>
                        <td><?=$fname?></td>
                        <td><font color="#FFFF00"><?=$upline?></font></td>
                        <td><?=$penama?></td>
                        <td>

<a href='showimage.php?id=<?=$id?>' class="btn btn-info" target="_blank">Show image</a>
<!--<img src="showimage.php?id=<?=$id?>" alt="showimage.php?id=<?=$id?>"  width="200px">-->
						
						
						</td>
						<td>
<a href='page_approve1.php?id=<?=$id?>&v=Y' class="btn btn-success"><IMG SRC='images/logo_user.png' WIDTH='16' HEIGHT='16' BORDER='0' ALT='Approve' TITLE='approve'>Approve</A>
<a href='page_approve1.php?id=<?=$id?>&v=V' class="btn btn-danger"><IMG SRC='images/logo_user.png' WIDTH='16' HEIGHT='16' BORDER='0' ALT='Decline' TITLE='Decline'>Decline</A>
						</td>
                    </tr>
                    <?php $i++; }
					?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- #################### END SEMAK MEMBER ############################# -->
        </div>
      </div>
    </div>
  </div>

<?php include "content/footer.php"; ?>