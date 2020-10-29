<?php 
//ob_start();
session_start();
include "logintime.php";
include "../serverdb/server.php";
if (empty($_SESSION['USERPRO'])) { header('Location: ../index.php'); } //login
$username=$_SESSION["USERPRO"];

include "content/header.php";
include "content/preloader.php"; 
include "content/nav.php";
include "content/minimum.php";

$sql23="SELECT akaunb from userpro WHERE id='$username'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$akaunbb = $info23['akaunb'];

if($akaunbb==null){ $disabled="buat condition sini"; }
?>
<style>
  .btw {
    background-color: rgb(1, 187, 1); 
    border: none;
    border-radius: 8px;
    color: #ffffff;
    padding: 5px 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
  }
  
.btw1 {
    background-color: transparent; 
    color: #ffffff; 
    border: 2px solid rgb(30, 253, 0);
  }
  
  .btw1:hover {
    background-color: rgb(0, 253, 105);
    color: #ffffff;
  }	
  
  
 

  .btf {
    background-color: rgb(13, 169, 241); 
    border: none;
    border-radius: 5px;
    color: #ffffff;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 1px 1px;
    transition-duration: 0.4s;
    cursor: pointer;
  }
  
.btf1 {
    background-color: transparent; 
    color: #ffffff; 
    border: 2px solid rgb(13, 169, 241); 
  }
  
  .btf1:hover {
    background-color: rgb(177, 221, 241); 
    color: #ffffff;
  }	
</style>
<div id="players" class="container-fluid plan-bg" style="min-height:90vh;">
  <div class="row">
	
	<?php
	$datacek = mysqli_query($conn,"SELECT addressbtc FROM userpro WHERE id='".$_SESSION['USERPRO']."'") or die(mysqli_error($conn));
		$infocek = mysqli_fetch_array( $datacek );
		$addressbtc = $infocek['addressbtc'];
		if($addressbtc==null){
		//echo "<br><br><br><center><font style='color:#ccff00  ;font-size:15px;'><a href='page_profile.php?f3=coming_soon'>VIEW AND UPDATE YOUR USDT WALLET ADDRESS</a></font></center><br><br><br>";
		echo ("<script LANGUAGE='JavaScript'>window.alert('Your crypto information required to activate Crypto Funding.');window.location.href='page_profile.php?f3=all_secure_required';</script>");
		}
		else{
	  ?>
	<div class="col-md-4"></div>
    <div class="col-md-4 col-sm-12 col-xs-12 text-center">
	<button onclick="hidenshow1_off()" type="reset" class="btn-block btw btw1" id="hidDiv1"><img src="images/usdt.png" style="height:25px">&nbsp;Blockchain USD Tether (Option One Offline)</button>
	<button onclick="hidenshow2()" type="reset" class="btn-block btw btw1" id="hidDiv2"><img src="images/usdt.png" style="height:25px">&nbsp;Blockchain USD Tether (Option Two)</button>
	<button onclick="hidenshow3()" type="reset" class="btn-block btw btw1" id="hidDiv3"><img src="images/freewallet3.png" style="height:25px">&nbsp;Freewallet</button>
	</div>
	<div class="col-md-4"></div>
	</div>
	<?php } ?>
    <!--
	<div class="col-sm-12 col-xs-12 text-center" id="done_usdt" style="display: block">
	<center>
	<font style="color:#00d0ba;font-size:15px;">If you have paid between option above, </font><a href="" class="btf btf1">Click here</a>
	</center>
	</div>-->
	
<!-- Option One -->
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4 col-sm-12 col-xs-12 text-center" id="hidDiva" style="display: none">
<center><br><img src="images/usdt01.png" width="230px"></center><br>
<div class="outernormalbox text-center">
<div class="paid-out glow3">
<style>table {table-layout: fixed;white-space: normal!important;}td {word-wrap: break-word;}</style>
<table class="table" style="width:100%; text-align:LEFT;" border="1" >
<tr style="border-bottom: 1px solid #f4511e;">
<td style="text-align:left;">
			<center>	  
			  <textarea id="myInput01" rows="2" cols="25" 
			  style="color:transparent;
			  border-top-style: hidden;
			  border-right-style: hidden;
			  border-left-style: hidden;
			  border-bottom-style: hidden;
			  color:#7CFC00;background-color:transparent;background-image:none;border:0px solid transparent;" readonly>34gBbcBwTqVHL7toNrzfppu58CXsYj7VdP</textarea>
			  <br>
			  <button onclick="myFunction01()" onmouseout="outFunc01()" class="btf btf1" ><span class="tooltiptext" id="myTooltip01">Click to copy</span></button>
			</center>
</td>
</tr></table>
</div>
</div>
<div class="box-topinvestor-footer"></div>
<?php $w=1; include "form_paid.php"; ?>
</div>
<div class="col-md-4"></div>
</div>
<!-- Option Two -->
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4 col-sm-12 col-xs-12 text-center" id="hidDivb" style="display: none">
<center><br><img src="images/usdt02.png" width="230px"></center><br>
<div class="outernormalbox text-center">
<div class="paid-out glow3">
<style>table {table-layout: fixed;white-space: normal!important;}td {word-wrap: break-word;}</style>
<table class="table" style="width:100%; text-align:LEFT;" border="1" >
<tr style="border-bottom: 1px solid #f4511e;">
<td style="text-align:left;">
			<center>	  
			  <textarea id="myInput02" rows="2" cols="25" 
			  style="color:transparent;
			  border-top-style: hidden;
			  border-right-style: hidden;
			  border-left-style: hidden;
			  border-bottom-style: hidden;
			  color:#7CFC00;background-color:transparent;background-image:none;border:0px solid transparent;" readonly>0x1CBD0A3153cCe3DECB0bF47009eE3Ab8bE278088</textarea>
			  <br>
			  <button onclick="myFunction02()" onmouseout="outFunc02()" class="btf btf1" ><span class="tooltiptext" id="myTooltip02">Click to copy</span></button>
			</center>
</td>
</tr></table>
</div>
</div>
<div class="box-topinvestor-footer"></div>
<?php $w=2; include "form_paid.php"; ?>
</div>
<div class="col-md-4"></div>
</div>
	<!-- Option Three -->
	<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4 col-sm-12 col-xs-12 text-center" id="hidDivc" style="display: none">
	<center>
	<br>
	<font style="color:#00d0ba;font-size:19px;">
	FreeWallet User :
	</font><br><br>
	<font style="color:#00d0ba;font-size:15px;">
	Send USDT instantly to this ID,
	<br><br>
	</font>
	<font style="color:#fff;font-size:21px;">
	danny_odop
	</font>
	<br><br>
	<font style="color:#00d0ba;font-size:15px;">
	or
	<br>
	<br>
	<a href="https://freewallet.org/id/danny_odop/usdt" target="blank"><button class="btf btf1">Click here&nbsp;<i class="glyphicon glyphicon-hand-up" style="font-size:14px;"></i></button> to Deposit any Cryptocurrency<br><u>https://freewallet.org/id/danny_odop/usdt</u></a></font>
	</center>
	<?php $w=3; include "form_paid.php"; ?>
	</div>
	<div class="col-md-4"></div>
  </div>
</div>
						<script type="text/javascript">
							function myFunction01() {
							  /* Get the text field */
							  var copyText01 = document.getElementById("myInput01");

							  /* Select the text field */
							  copyText01.select();
							  copyText01.setSelectionRange(0, 99999); /*For mobile devices*/

							  /* Copy the text inside the text field */
							  document.execCommand("copy");

							  /* Alert the copied text */
							  var tooltip = document.getElementById("myTooltip01");
							  tooltip.innerHTML = "Copied!";
							}
							function myFunction02() {
							  var copyText02 = document.getElementById("myInput02");
							  copyText02.select();
							  copyText02.setSelectionRange(0, 99999);
							  document.execCommand("copy");
							  var tooltip = document.getElementById("myTooltip02");
							  tooltip.innerHTML = "Copied!";
							}
							
  function outFunc01() {
  var tooltip = document.getElementById("myTooltip01");
  tooltip.innerHTML = "Copy Address";
}			
  function outFunc02() {
  var tooltip = document.getElementById("myTooltip02");
  tooltip.innerHTML = "Copy Address";
}
							</script>
<script>
function hidenshow() {
  var x = document.getElementById("hidDiv");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDiv3");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "block";
  }
}
</script>

<script>

function hidenshow1() {
  var x = document.getElementById("hidDiv1");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDiv3");
  var a = document.getElementById("hidDiva");
  var b = document.getElementById("hidDivb");
  var c = document.getElementById("hidDivc");
  
  if (a.style.display === "none") {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "block";
    b.style.display = "none";
    c.style.display = "none";
  } else {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }
}
function hidenshow2() {
  var x = document.getElementById("hidDiv1");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDiv3");
  var a = document.getElementById("hidDiva");
  var b = document.getElementById("hidDivb");
  var c = document.getElementById("hidDivc");
  
  if (b.style.display === "none") {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
    b.style.display = "block";
    c.style.display = "none";
  } else {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }
}
function hidenshow3() {
  var x = document.getElementById("hidDiv1");
  var y = document.getElementById("hidDiv2");
  var z = document.getElementById("hidDiv3");
  var a = document.getElementById("hidDiva");
  var b = document.getElementById("hidDivb");
  var c = document.getElementById("hidDivc");
  
  if (c.style.display === "none") {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "block";
  } else {
    x.style.display = "block";
    y.style.display = "block";
    z.style.display = "block";
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
  }
}
</script>


<?php include "content/footer.php"; ?>

 <?php /* ?>
	<br>
	<!-- btc depo transaction history section  -->
	  <?php
$data55 = mysqli_query($conn,"SELECT count(sn) as mysn FROM btcdepo WHERE memberid='$_SESSION[USERPRO]'") or die(mysqli_error($conn));
$info55 = mysqli_fetch_array( $data55 );
//$mysn=$info2['mysn'];
if($info55['mysn'] > 0){
?>
<div class="row">
<div class="haha">
<div class="block">
<div class="block-title">
<h2 class=glow4>Crypto Deposit Transaction</h2> 
</div>
<div class="table-responsive">
          <table class="table" style="width:100%; text-align:LEFT;" border="1" >
                <thead>
                    <tr style="width:250px;">
                        <th class="text-center">Ref.</th>
                        <th class="text-center">USDT Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$data56 = mysqli_query($conn,"SELECT * FROM btcdepo WHERE memberid='$_SESSION[USERPRO]'") or die(mysqli_error());
					while($info56 = mysqli_fetch_array( $data56 )) {
					$sn56 = $info56['sn']; 
					$stat56 = $info56['stat'];
	$dateho = $info56['created_date']; 
	$dateho = strtotime($dateho);
	$masaho = date('h:i:sa', $dateho);
	$dateho = date('d/m/Y', $dateho);		
	$amount56 = $info56['amount'];	
	//random
	$permitted_chars = '0123456789';
	$HAHA = substr(str_shuffle($permitted_chars), 0, 2);	
					
					
					$num = $info56['sn'];
					//$num = sprintf("%06d", $num);
					?>
                   
<tr style="border-bottom: 1px solid #f4511e;">
<td>
<font style="color:#7CFC00;">Transaction ID #<?=$HAHA?><?=$num?></font><br>
<font style="color:#0cbfe9;font-size:11px;"><?=$dateho?><br><?=$masaho?></font><br>
</td>
<td style="color:yellow;" class="text-center"><?=$amount56?>
<Br>
<!-- STATUS USDT -->
<font style="color:blue;"><?=$stat56?></font>
<br>
<?php
if($stat56=="Processing"){ ?>
<a href="x_delete_btcdepo_request.php?sn=<?=$sn56?>" data-toggle="tooltip" title="Cancel" class="buttonx buttonx1" onclick="return confirm('Cancel');">Delete</a> 
<?php } ?>
</td>
</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
</div>
</div>
<?php  }
$mysn=$info55['mysn']; 
//echo $mysn; 
?>
	  <!-- btc depo transaction history section end --> 
	<br><?php */ ?>