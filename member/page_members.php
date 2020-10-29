<?php 
session_start();
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); }
$username=$_SESSION["USERPRO"];
include "content/header.php";
//include "content/preloader.php"; 
include "content/nav.php";
?>
<div id="players" class="container-fluid plan-bg">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
      <div class="outernormalbox text-center">
     
<div class="paid-out glow2">
<div class="block full">
        <div class="block-title">
            <h2 class="glow4">MEMBER INFORMATION CHECK</h2>
        </div>
        <div class="table-responsive">
<style>
table, th, td {
  border: 1px solid yellow;
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
                        <th>Bank Holder Name</th>
                        <th>Check IC</th>
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
<?php
$i=1;

$i='1';
$sql37="SELECT * FROM userpro WHERE akaun!='MASTER' ORDER BY created_date DESC";
$data = mysqli_query($conn,$sql37) or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$id   = $info['id'];
$verifymel   = $info['verifymel'];
$emel   = $info['email'];
$phone   = $info['phone'];
$fname   = $info['fname'];
$penama   = $info['penama'];
$jenisb   = $info['jenisb'];
$address   = $info['address'];
$lastlogin   = $info['lastlogin'];

if($verifymel=="N"){ $verifymelxx="New Register and need verify Image"; }
if($verifymel=="V"){ $verifymelxx="Registered before but the Image is reupload to reverify"; }
if($verifymel=="Y"){ $verifymelxx="Account Verified"; }
?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$id?></td>
                        <td><?=$verifymelxx?></td>
                        <td><?=$phone?></td>
                        <td><?=$fname?></td>
                        <td><?=$penama?></td>
                        <td>
						<img src="showimage.php?id=<?=$id?>" alt="showimage.php?id=<?=$id?>"  width="150px">
						</td>
						<td>
<?php if($verifymel!="Y"){?>
<a href='page_approve1.php?id=<?=$id?>&v=Y' class="btn btn-success"><IMG SRC='images/logo_user.png' WIDTH='16' HEIGHT='16' BORDER='0' ALT='Approve' TITLE='approve'>Approve</A>
<?php } ?>
<a href='page_approve1.php?id=<?=$id?>&v=V' class="btn btn-danger"><IMG SRC='images/logo_user.png' WIDTH='16' HEIGHT='16' BORDER='0' ALT='Decline' TITLE='Decline'>Ban</A>
						</td>
                    </tr>
                    <?php $i++; }
					?>
                </tbody>
            </table>
        </div>
    </div>

</div>
        </div>
      </div>
    </div>
  </div>

<?php include "content/footer.php"; ?>