<?php 
ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
//if($_SESSION['USER_TYPER']=="MASTER"){ header('Location:index_master.php');  }
//if($_SESSION['USER_TYPER']=="LP"){ header('Location:index.php');  }
$username=$_SESSION["USERPRO"];

include "content/header.php";
//include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$sql23="SELECT * from userpro WHERE id='$username'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$akaunbb = $info23['akaunb'];
$getPhoneNo  = $info23['phone'];
 //condition 1
 if(is_numeric($getPhoneNo)){ $cekfon = 'Y'; } else { $cekfon = 'X'; }
 //condition 2
 if($akaunbb==null){ $disabled="disabled";}
 else if($cekfon == 'X'){ $disabled="disabled"; }
 else {
	//$timenow = date("H:i:sa");
	$timenow = date("H");
	if(($timenow>7)&&($timenow<15)){ $disabled=null; $wd="on"; }
	else {$disabled="disabled"; $wd="off";} 
  }
 
$sql5="SELECT walletb from wallet WHERE id='$username'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error($conn));
$info5 = mysqli_fetch_array( $data5 );
$balance = $info5['walletb'];
$balance=number_format((float)$balance, 2, '.', '');
?>



<div id="players" class="container-fluid plan-bg" style="min-height:90vh">
  <div class="row">
    <div class="col-sm-12 col-xs-12">
<?php
$sql52  = "SELECT count(upline) as sponsoring FROM affiliate A,userpro U WHERE A.upline = '$_SESSION[USERPRO]' AND U.id = A.userid";
$data52 = mysqli_query($conn,$sql52) or die(mysqli_error($conn));
$info52 = mysqli_fetch_array($data52);
$sponsoring=$info52['sponsoring'];
if($sponsoring>0){
?>
      <div class="outernormalbox text-center">
        <div class="box-wallet">
          <h1 class="glow1">DOWNLINE</h1>
        </div>
        <div class="paid-out glow3">
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
<ul>
<?php //TREE 821
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
		$sql29  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '$_SESSION[USERPRO]' AND U.id = A.userid";
		$i=1;
		$data = mysqli_query($conn,$sql29) or die(mysqli_error());
		while($info = mysqli_fetch_array( $data )) {
		$aff_id=$info['userid'];
		//echo "[".$i."]-".$aff_id."<br>";
				?>
				<li>
                <?=$aff_id?>
                <?php
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
				$sql30  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id."' AND U.id = A.userid";
				$j=1;
				$data2 = mysqli_query($conn,$sql30) or die(mysqli_error());
				while($info2 = mysqli_fetch_array( $data2 )) {
				$aff_id2=$info2['userid'];
				//echo "-------[".$j."]-".$aff_id2."<br>";
						?>
						<ul>
						<li>
                        <?=$aff_id2?>
                        
                        <?php
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
						$sql31  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id2."' AND U.id = A.userid";
						$k=1;
						$data3 = mysqli_query($conn,$sql31) or die(mysqli_error());
						while($info3 = mysqli_fetch_array( $data3 )) {
						$aff_id3=$info3['userid'];
						//echo "+++++++++++++++++[".$k."]-".$aff_id3."<br>";
						?>
						<ul><li><?=$aff_id3?></li></ul><?php
						$k++;
						}
						?>
                        </li></ul><?php
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
				$j++;
				}
				?></li><?php
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
		$i++;
		}
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
?>
</ul>
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
		  <!-- ************************************************************************** -->
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
<?php } else { echo "<br><br><br><br><br><br><br><h1 class='glow4'>You have no referral</h1>"; } ?>
    </div>
  </div>
</div>

<?php include "content/footer.php"; ?>