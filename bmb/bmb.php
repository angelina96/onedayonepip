


<!-- Page content -->
<div id="page-content">
    
    <div class="block full">
        <div class="block-title">
            <h2>Manage PO</h2>
        </div>
        <div class="table-responsive">
            <table id="example-datatable" border="1">
                <thead>
                    <tr>
                        <th  style="width: 5%;">Susunan</th>
                        <th>Username</th>
                        <th>Pass</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>Penama</th>
                        <th>Bank</th>
                        <th>Address</th>
                        <th style="width: 5%;">Last Login</th>
                        
                    </tr>
                </thead>
                <tbody>
<?php
$i=1;
include "../serverdb/server.php";
$i='1';
$data = mysqli_query($conn,"SELECT * FROM userpro WHERE akaun='MEMBER' ORDER BY created_date DESC") or die(mysqli_error($conn));
while($info = mysqli_fetch_array( $data )) {
$id   = $info['id'];
$pwd   = $info['pwd'];
$emel   = $info['email'];
$phone   = $info['phone'];
$penama   = $info['penama'];
$jenisb   = $info['jenisb'];
$address   = $info['address'];
$lastlogin   = $info['lastlogin'];
?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$id?></td>
                        <td><?=$pwd?></td>
                        <td><?=$emel?></td>
                        <td><?=$phone?></td>
                        <td><?=$penama?></td>
                        <td><?=$jenisb?></td>
                        <td><?=$address?></td>
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

<script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-2.1.1.min.js"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/app.js"></script>

<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/uiTables.js"></script>
<script>$(function(){ UiTables.init(); });</script>

