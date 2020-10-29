<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } 
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";


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

<div id="hidDivmini">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<h3 class="glow2">SEARCH</h3>
	</div>
	<div class="box-welcome2">

	<br>
		
<!-- CEK USER -->
<div  <?=$displaycekuser?>>
                <form id="form-validation" action="" method="POST" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-md-3 control-label">User ID </label>
                        <div class="col-md-6">
                            <input type="text" value="<?=$userid?>" name="userid" class="form-control" placeholder="User ID">
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-8 col-md-offset-3">
                            <input type="submit" value="FIND USER" class="btn btn-block btn-primary" name="addAduan">
                        </div>
                    </div>
                </form>
				<?php if($code!=''){ ?>
				<center><code><?=$code?></code></center>
				<?php } ?>
</div>
  <?php
  //--------------------------------------------------------------------------------------------
  //_______________________________[SERVER]_CEK USER___________________________________________
  //--------------------------------------------------------------------------------------------
  if (isset($_POST['addAduan'])) {
		//include "../serverdb/server.php";
		$userid 	 = $_POST['userid'];
		$sql33="SELECT id FROM userpro WHERE id='$userid'";
		$data33 = mysqli_query($conn,$sql33) or die(mysqli_error($conn));
		$info33 = mysqli_fetch_array( $data33 );
		$id = $info33['id'];

		if($id==null){
		$code="Username ".$userid." is not exist";
		echo "<script LANGUAGE='JavaScript'>window.location.href='page_mic.php?userid=".$userid."&code=".$code."';</script>";
		}
		else {
			echo "<script LANGUAGE='JavaScript'>window.location.href='page_mic.php?userid=".$id."&cekuser=ok';</script>";
			}
  }
  ?>
<!-- DONE CEK USER -->
<!-- SEND TOKEN -->
			<div id="santopany" <?=$displaysendtoken?>>
            <div class="block full">
			<div class="block-title">
                    <h2 class="glow4">USER EXIST! SEND USD</h2>
                </div>
           
            </div>
            </div>

<!-- DONE SEND TOKEN -->
	</div>
	
  </div>
  </div>
  </div>
  </div>


<!-- **************FOOTER***************** -->

