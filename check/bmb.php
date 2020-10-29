<?php 
session_start();
if (empty($_SESSION['SU'])) { header('Location: ../index.php'); }  
?>
<?php include 'inc/template_start.php'; ?>
<?php include 'inc/page_head.php'; ?>


<!-- Page content -->
<div id="page-content">
    
    <div class="block full">
        <div class="block-title">
            <h2>Admin System Check</h2>
        </div>
        <div class="table-responsive">
            <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">SN</th>
                        <th>Session</th>
                        <th>Valid Data</th>
                        <th>Invested</th>
                        <th>Total</th>
                        <th>Username</th>
						<th>Pass</th>
                        <!--
                        <th>email</th>
                        <th>Phone</th>
                        <th>Penama</th>
                        <th>Bank</th>
                        <th>Address</th>-->
                        <th style="width: 200px;">Last Login</th>
                        
                    </tr>
                </thead>
                <tbody>
<?php
$i=1;
include "../serverdb/server.php";
include "../member/functions.php";
$i='1';
// $data = mysqli_query($conn,"SELECT * FROM userpro WHERE akaun!='MASTER' AND verifymel='Y' ORDER BY created_date DESC LIMIT 800") or die(mysqli_error($conn));
$data = mysqli_query($conn,"SELECT * FROM userpro U, affiliate A WHERE U.akaun!='MASTER' AND U.verifymel='Y' AND A.userid=U.id AND A.upline='santai10'") or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$id   = $info['id'];
$pwd   = $info['pwd'];
$emel   = $info['email'];
$phone   = $info['phone'];
$penama   = $info['penama'];
$jenisb   = $info['jenisb'];
$address   = $info['address'];
$lastlogin   = $info['lastlogin'];


$data2 = mysqli_query($conn,"SELECT COUNT(id) as cicok FROM invest WHERE id='".$id."'") or die(mysqli_error($conn));
$info2 = mysqli_fetch_array( $data2 );
$cicok   = $info2['cicok'];
$anok=""; if ($cicok > 0) { $anok="invest";}

$data3 = mysqli_query($conn,"SELECT SUM(amount) as tt FROM invest WHERE id='".$id."'") or die(mysqli_error($conn));
$info3 = mysqli_fetch_array( $data3 );
$tt   = $info3['tt'];
$tt=(int)$tt;a
?>
                    <tr>
                        <td><?=$i?></td>
<td> <a href="https://onedayonepip.trade/check/bms.php?id=<?=$id?>" target="blank">Access Account!</a></td>
<!--<td> <a href="http://localhost/oppo/check/bms.php?id=<?=$id?>" target="blank">Lets Go!</a></td>-->
<td> <a href="https://onedayonepip.trade/check/bmk.php?id=<?=$id?>" target="blank">Check out!</a></td>
                        <td><font color="#ff0000"><?=$anok?></font></td>
                        <td><font color="#ff0000"><?=$tt?></font></td>
                        <td><?=$id?></td>
                        <td><?=$pwd?></td>
                        <!--<td><?=$emel?></td>
                        <td><?=$phone?></td>
                        <td><?=$penama?></td>
                        <td><?=$jenisb?></td>
                        <td><?=$address?></td>-->
                        <td><?=$lastlogin?></td>
                    </tr>
                    <?php $i++; }
					
					
					?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->

<?php include 'inc/page_footer.php'; ?>
<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/uiTables.js"></script>
<script>$(function(){ UiTables.init(); });</script>

<?php include 'inc/template_end.php'; ?>