<?php
$sql26="SELECT sum(amount) as totalho from invest WHERE id='$username' AND stat='Active'";
$data26 = mysqli_query($conn,$sql26) or die(mysqli_error($conn));
$info26 = mysqli_fetch_array( $data26 );
$totalho = $info26['totalho'];
$totalhokasal = $totalho;

$sql58="SELECT sum(amount) as totalhokusdt from investusdt WHERE id='$username' AND stat='Active'";
$data58 = mysqli_query($conn,$sql58) or die(mysqli_error($conn));
$info58 = mysqli_fetch_array( $data58 );
$totalhokusdt = $info58['totalhokusdt'];

if($totalho==0){ $totalho=$totalho+$totalhokusdt; } //amik hok usdt ar kalu kosong gak
//if($totalhokusdt!=0){ $totalho=$totalho+$totalhokusdt; } //amik hok usdt ar kalu kosong gak

if($totalho==null){ $totalho="n/a"; }
if($totalho==0){ $rank="INACTIVE"; $gg="silver"; }
if(($totalho>=1)&&($totalho<1000)){ $rank="SILVER"; $gg="silver"; }
if(($totalho>999)&&($totalho<5000)){ $rank="GOLD"; $gg="gold"; }
if($totalho>4999){ $rank="PLATINUM"; $gg="platinum"; }

$sql27="SELECT akaun,aktif from userpro WHERE id='$username'";
$data27 = mysqli_query($conn,$sql27) or die(mysqli_error($conn));
$info27 = mysqli_fetch_array( $data27 );
$position = $info27['akaun'];
$spg = $info27['aktif'];

if($position=="LP"){$position='RGM'; $rank="PLATINUM"; $gg="platinum"; }
if($spg=="P"){$position='MEMBER[P]'; $rank="PLATINUM"; $gg="platinum"; }
if($spg=="G"){$position='MEMBER[G]'; $rank="GOLD"; $gg="gold"; }
if($username=="master"){ $rank=null;}
?>
<nav class="navbar navbar-default navbar-fixed-top">

  <div class="container-menu-shahrul">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>               
      </button>
		<div class="animate-box" data-animate-effect="fadeInLeft">
		
		
		 <table><tr><td>&nbsp;
	  <?php
	    if($rank=="GOLD"){ echo '<img src="images/rank/gold.png" style="height: 30px;">'; }
		if($rank=="SILVER"){ echo '<img src="images/rank/silver.png" style="height: 30px;">'; }
		if($rank=="PLATINUM"){ echo '<img src="images/rank/platinum.png" style="height: 30px;">'; }
		?>
	  </td><td><a class="navbar-brand" href="#myPage"> <?=$rank?> <?=$position?></a></td></tr></table>
		
		</div>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="w3-animate-left"><a href="index.php"><IMG SRC='images/menu/home.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:100%">&nbsp;MY ACCOUNT</a></li>

		<!--<li class="w3-animate-right"><a href="page_invest.php"><IMG SRC='images/menu/invest.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;INVESTMENT</a></li>-->
        <!--<li class="w3-animate-left"><a href="page_withdrawal.php"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;WITHDRAWAL</a></li>-->
<?php if($position!="MASTER"){ ?>

<!-- START SUB MENU PROSAVING -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;PRO-SAVING</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- INVEST -->
<li class="w3-animate-left"><a href="page_invest.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/invest.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;INVESTMENT</font></a></li>
<!-- DEPOSIT -->
<li class="w3-animate-left"><a href="page_deposit.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USD DEPOSIT</font></a></li>
<!-- BONUS -->
<li class="w3-animate-right"><a href="page_bonus.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;BONUS</font></a></li>
<!-- WITHDRAW -->
<li class="w3-animate-right"><a href="page_withdrawal.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;WITHDRAW</font></a></li>
</ul>
</li>
<!-- END SUB MENU PROSAVING -->
<!-- START SUB MENU SMARTSAVING -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;CRYPTO SMART SAVING</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- INVEST USDT -->
<li class="w3-animate-right"><a href="page_invest3.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/usdt.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;CRYPTO INVESTMENT</font></a></li>
<!-- DEPOSIT -->
<li class="w3-animate-left"><a href="page_deposit2.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT DEPOSIT</font></a></li>
<!-- BONUS usdt COMING SOON -- >
<li class="w3-animate-right"><a href="page_bonus.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;BONUS</font></a></li>-->
<!-- USDT WITHDRAW -->
<li class="w3-animate-right"><a href="page_withdrawal3.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT WITHDRAW</font></a></li>
</ul>
</li>
<!-- END SUB MENU PROSAVING -->




<?php /*
		
<!-- START SUB MENU INVESTMENT -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;INVESTMENT</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- INVEST -->
<li class="w3-animate-left"><a href="page_invest.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/invest.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;INVESTMENT</font></a></li>
<!-- INVEST USDT -->
<li class="w3-animate-right"><a href="page_invest3.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/usdt.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;CRYPTO INVESTMENT</font></a></li>

</ul>
</li>
<!-- END SUB MENU INVESTMENT -->
<!-- START SUB MENU WALLET -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;WALLET</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- INVEST -- >
<li class="w3-animate-left"><a href="page_invest.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/invest.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;INVEST</font></a></li>-->
<!-- WITHDRAW -->
<li class="w3-animate-right"><a href="page_withdrawal.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;WITHDRAW</font></a></li>
<!-- USDT WITHDRAW -->
<li class="w3-animate-right"><a href="page_withdrawal3.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT WITHDRAW</font></a></li>
<!-- DEPOSIT -->
<li class="w3-animate-left"><a href="page_deposit.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;DEPOSIT</font></a></li>
<!-- BONUS -->
<li class="w3-animate-right"><a href="page_bonus.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;BONUS</font></a></li>
</ul>
</li>
<!-- END SUB MENU WALLET --> 
*/ ?>

<li class="w3-animate-right"><a href="page_referral.php"><IMG SRC='images/menu/referral.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;REFERRAL</a></li>
<?php } ?>
		
		<?php if($position=="RGM"){ ?>
		<li class="w3-animate-left"><a href="page_paywallet.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;SEND USD POINT</a></li>
		<?php } ?>
		<?php if($position=="RGMTAKDEDAH"){ ?>
		<li class="dropdown w3-animate-zoom">
          <a class="dropdown-toggle" data-toggle="dropdown" href="profile.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;PAY-WALLET</a>
          <ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;"> 
            <!--<li><a href="page_paywallet.php"><font style="color: #ff0000;">SEND USD POINT</font></a></li>-->
<li class="w3-animate-left"><a href="page_paywallet.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;SEND USD POINT</font></a></li>
<li class="w3-animate-right"><a href="page_po.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/pay3.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;PAY OUT</font></a></li>
          </ul>
        </li>
		
		<?php } ?>
		


		<?php if($position=="MASTER"){ ?>
<!--<li class="w3-animate-zoom"><a href="page_paymaster.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;PAY-MASTER</a></li>-->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;PAY-MASTER</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- RGM PIN -->
<li class="w3-animate-right"><a href="page_pin_rgm.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;RGM PIN</font></a></li>
<!-- report2 -->
<li class="w3-animate-left"><a href="page_paymaster.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;MEMBER USD</font></a></li>

</ul>
</li>
		
		<li class="w3-animate-zoom"><a href="page_po_master.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;PAY-OUT [PO]</a></li>


<!--<li class="w3-animate-zoom"><a href="page_report3.php"><IMG SRC='images/menu/pay1.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;USDT DEPOSIT</a></li>-->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- USDT DEPOSIT -->
<li class="w3-animate-right"><a href="page_report3.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT DEPOSIT</font></a></li>
<!-- report2 -->
<li class="w3-animate-left"><a href="page_po_master2.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;USDT PO</font></a></li>

</ul>
</li>

		
		
		
		<li class="w3-animate-zoom"><a href="page_members.php"><IMG SRC='images/menu/garl.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;MEMBERS</a></li>
		
		
		
		<!-- START SUB MENU REPORT -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;REPORT</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<!-- report1 -->
<li class="w3-animate-right"><a href="page_report.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;Daily Sale Report</font></a></li>
<!-- report2 -->
<li class="w3-animate-left"><a href="page_report2.php"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;Daily Deposit Report</font></a></li>
<!-- report3 -->
<li class="w3-animate-left"><a href="graph.php" target="blank"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;Graph Report</font></a></li>
<!-- report4 -->
<li class="w3-animate-left"><a href="page_report4_c.php" target="blank"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/wd.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;PO Report</font></a></li>
</ul>
</li>
<!-- END SUB MENU REPORT -->
		
		
		
		<?php } ?>
		
<!-- START SUB MENU -->
<li class="dropdown w3-animate-zoom">
<a class="dropdown-toggle" data-toggle="dropdown" href="profile.php"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;SETTING</a>
<ul class="dropdown-menu"  style="background:#FF4500; animation: fadeMe 2s;">
<li class="w3-animate-left"><a href="page_profile.php?f1=verify1659a54myaccount"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;UPDATE PROFILE</font></a></li>
<li class="w3-animate-left"><a href="page_profile.php?f3=sdfgkjgh98fghnrt6ty5oighnyunujgifgnodf8gndfgi76fgmogh8yhf98vnmfgjhno98ghpoihbfo7y6hbfo9"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;UPDATE CRYPTO WALLET</font></a></li>
<li class="w3-animate-right"><a href="page_profile.php?f2=change6765security67896my567account"><font style="color: #fff;" onmouseover="this.style.color='#ff0000';" onmouseout="this.style.color='#fff';"><IMG SRC='images/menu/pay2.png' WIDTH='16' HEIGHT='16' BORDER='0' style="border-radius:90%">&nbsp;CHANGE PASSWORD</font></a></li>
</ul>
</li>
<!-- END SUB MENU -->
		
        <li class="w3-animate-zoom"><a href="logout.php"><IMG SRC='images/menu/signout.png' WIDTH='16' HEIGHT='16' BORDER='0'>&nbsp;SIGN-OUT</a></li>
		
        
      </ul>
	
    </div>
		
  </div>
</nav>
<br><br>