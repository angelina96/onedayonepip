<?php
$sql26="SELECT sum(amount) as totalho from invest WHERE id='$username' AND stat='Active'";
$data26 = mysqli_query($conn,$sql26) or die(mysqli_error($conn));
$info26 = mysqli_fetch_array( $data26 );
$totalho = $info26['totalho'];
if($totalho==null){ $totalho="n/a"; }
if($totalho==0){ $rank="INACTIVE"; $gg="silver"; }
if(($totalho>=1)&&($totalho<1000)){ $rank="SILVER"; $gg="silver"; }
if(($totalho>999)&&($totalho<5000)){ $rank="GOLD"; $gg="gold"; }
if($totalho>4999){ $rank="PLATINUM"; $gg="platinum"; }

$sql27="SELECT akaun from userpro WHERE id='$username'";
$data27 = mysqli_query($conn,$sql27) or die(mysqli_error($conn));
$info27 = mysqli_fetch_array( $data27 );
$position = $info27['akaun'];
if($position=="LP"){$position='RGM'; $rank="PLATINUM"; $gg="platinum"; }
if($username=="master"){ $rank="-";}
?>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <table><tr><td>&nbsp;
	  <?php
	    if($rank=="GOLD"){ echo '<img src="images/rank/gold.png" style="height: 30px;">'; }
		if($rank=="SILVER"){ echo '<img src="images/rank/silver.png" style="height: 30px;">'; }
		if($rank=="PLATINUM"){ echo '<img src="images/rank/platinum.png" style="height: 30px;">'; }
		?>
	  </td><td><a class="navbar-brand" href="#myPage"> <?=$rank?> <?=$position?></a></td></tr></table>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">MY ACCOUNT</a></li>
        <li><a href="page_invest.php">INVEST</a></li>
        <li><a href="page_withdrawal.php">WITHDRAWAL</a></li>
        <li><a href="page_referral.php">REFERRAL</a></li>
		<?php if($position=="RGM"){ ?>
		<li><a href="page_paywallet.php">PAY-WALLET</a></li>
		<?php } ?>
		<?php if($position=="MASTER"){ ?>
		<li><a href="page_paymaster.php">PAY-MASTER</a></li>
		<?php } ?>
		
        <li><a href="logout.php">SIGN-OUT</a></li>
		
      </ul>
    </div>
  </div>
</nav>