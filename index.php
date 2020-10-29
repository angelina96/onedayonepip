<?php
session_start();
$_SESSION['TOKEN']="go";
include "serverdb/server.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>OneDayOnePip</title>
  <link rel="icon" href="images/ico_smta.png" />
  <link rel="stylesheet" type="text/css" href="css/bubble.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 400 15px Lato, sans-serif;
    line-height: 1.8;
    color: #818181;
  }
  h2 {
    font-size: 24px;
    text-transform: uppercase;
    color: #303030;
    font-weight: 600;
    margin-bottom: 30px;
  }
  h4 {
    font-size: 19px;
    line-height: 1.375em;
    color: #303030;
    font-weight: 400;
    margin-bottom: 30px;
  }
  .jumbotron {
    background-color: #FF4500;
    color: #fff;
    padding: 100px 5px;
    font-family: Montserrat, sans-serif;
  }
  .bg-onepip {
    background-color: #FF4500;
	background-image: url("images/div1.png"), url("images/bokeh.png"), url("images/bg1.png");
	background-position: center bottom,center,center; /* Center the image */
	background-repeat: no-repeat,no-repeat,no-repeat; /* Do not repeat the image */
	background-size: 100% 50px, cover , cover;
    color: #fff;
    padding: 200px 5px;
    font-family: 'Aldrich';
  }
  .bg-onepip2 {
    background-color: #FF4500;
	background-image: url("images/div2.png"), url("images/bg2.png");
	background-position: center top,center; /* Center the image */
	background-repeat: no-repeat,no-repeat; /* Do not repeat the image */
	background-size: 100% 50px,cover;
	color: #fff;
    font-family: 'Aldrich';
  }
  .bg-divadar {
  background-image: url("images/div.png");
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover;
  
  }
  .bg-grey {
	background-color: #f6f6f6;
  }
  .bg-theme {
	background-color: #FF0000;
  }
  .bg-theme2 {
	background-color: #FF4500;
  }
  .box-topinvestor {
    color: #f4511e !important;
    background-color: transparent !important;
	background-image:   url("images/glitter2.gif"),url("images/bg2.png");
	background-size: cover;
	background-position: center;
    padding: 1px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .box-topinvestor-footer {
	background-image: url("images/div2.png");
	background-size: 100% 100%;
	background-position: center;
    padding: 15px;
    border-bottom: 0px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .container-fluid {
    padding: 60px 50px;
  }
  .container-foota {
    background-color: #ADADAD;
    padding: 10px 10px;
	background-image: url("images/div3.png");
	background-size: cover;
	background-position: center;
  }
  .carousel-control.right, .carousel-control.left {
    background-image: none;
    color: #f4511e;
  }
  .carousel-indicators li {
    border-color: #f4511e;
  }
  .carousel-indicators li.active {
    background-color: #f4511e;
  }
  .dividar {
  position: absolute;
  bottom: 0px;
  left: 0px;
  }
  .fixed {
  position: fixed;
  bottom: 0;
  right: 0;
  width: 100px;
  height: 100px;
  border: 0px solid #73AD21;
  }
  footer .glyphicon {
    font-size: 20px;
    margin-bottom: 2px;
    color: #f4511e;
  }
  .glow3 {
     color: #fff;
     text-align: center;
     text-shadow: 0 0 10px #fff, 0 0 20px rgb(0, 0, 0), 0 0 30px #e65400, 0 0 40px #e7661b, 0 0 50px #ff5e00, 0 0 60px #e7661b;
    }
  .glow {
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
 }
 @-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
 }
  .logo-small {
    color: #f4511e;
    font-size: 50px;
  }
  .logo {
    color: #f4511e;
    font-size: 200px;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail img {
    width: 100%;
    height: 100%;
    margin-bottom: 10px;
  }
  .item h4 {
    font-size: 19px;
    line-height: 1.375em;
    font-weight: 400;
    font-style: italic;
    margin: 70px 0;
  }
  .item span {
    font-style: normal;
  }
  .outerbox {
    border: 1px solid #f4511e; 
    border-radius:20px ;
    transition: box-shadow 0.5s;
	font-family: 'Aldrich';
  }
  .outerbox-2 {
    border: 1px solid #f4511e; 
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    transition: box-shadow 0.5s;
	font-family: 'Aldrich';
  }
  .panel {
    border: 1px solid #f4511e; 
    border-radius:0 !important;
    transition: box-shadow 0.5s;
  }
  .panel:hover {
    box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
    border: 1px solid #f4511e;
    background-color: #fff !important;
    color: #f4511e;
  }
  .panel-heading {
    color: #fff !important;
    background-color: #f4511e !important;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .player-bg {
	background-color: #000000;
	background-image:  url("images/div3.png"),url("images/div4.png"),url("images/earth.png");
	background-position: center top,center bottom,center;
	background-repeat: no-repeat;
	background-size: 100% 25px,100% 25px,cover;
  }
  .service-bg {
	background-color: #000000;
	background-image:  url("images/div3.png"),url("images/bokeh.gif");
	background-size: 100% 25px,cover;
	background-position: center top,center;
	background-repeat: no-repeat,no-repeat;
  }
  .meta-bg {
	background-color: #000000;
	background-image:  url("images/div4.png"),url("images/meta.gif");
	background-size: 100% 25px,cover;
	background-position: center bottom,center;
	background-repeat: no-repeat,no-repeat;
  }
  .meta-trader {
    color: #fff !important;
    background-color: #f4511e !important;
	background-image:  url("images/meta.gif");
	background-size: cover;
	background-position: center;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
  }
  .meta-trader2 {
    color: #fff !important;
	background-image:  url("images/bg1va.png");
	background-size: cover;
	background-position: center;
    padding: 25px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
  }
  .navbar {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
    font-family: 'Aldrich';
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }
  .panel-footer {
    background-color: white !important;
  }
  .panel-footer h3 {
    font-size: 32px;
  }
  .panel-footer h4 {
    color: #aaa;
    font-size: 14px;
  }
  .panel-footer .btn {
    margin: 15px 0;
    background-color: #f4511e;
    color: #fff;
  }
  .sponsor-bg {
	background-color: #000000;
	background-image:  url("images/bg2.png");
	background-size: cover;
	background-position:center;
	background-repeat: no-repeat;
  }
  .slideanim {visibility:hidden;}
  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
      width: 100%;
      margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
      font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<?php 
$hide="";
if(isset($_GET['logon'])) {
$logon = $_GET['logon'];
$hide='style="display: none;"';
}
 ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">OneDayOnePip</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#meta4">MARKET CAP</a></li>
        <li><a href="#players">TOP INVESTOR</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="index.php?logon=32071356785240397834675">LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="bg-onepip text-center"  <?=$hide?>>
  <h1>WE ARE INVESTING FOR THE FUTURE</h1> 
  <p>INVEST IN PROMISING START-UPS IN THE HIGH-END TECHNOLOGY MARKETS WITH THE INVEST EXPERT COMPANY!
INVEST NOW
</p>
<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
</ul>
<center><img src="images/globe5.gif" height="230px"></center>
</div>
<!--<img src="images/div.png" alt="zigzag design" width="100%" class="dividar">-->
<!-- Container (About Section) -->
<div id="about" class="bg-onepip2 container-fluid bg-theme2">
  <div class="row">
    <div class="col-sm-9" <?=$hide?>>
      <h2 style="color:white">About Company Page</h2><br>
        <p>If you are searching for ways how to invest in the promising startups, fastest-growing, and hottest companies, you have found it. ODOP offers an opportunity to invest in world's top startups. At ODOP you are dealing with a strong and reliable partner, one who delivers premium investment services. We invest in promising startups in the high-end technology markets that may be struggling at present, and in need of assistance. We help startups go above and beyond.
		<br>
		From our many years of practical investing in high-tech startups we uniquely understand what it takes for growing companies to bring pioneering technology products to market. Great companies begin with insightful teams that demonstrate technology, product, and marketing expertise. We maintain our steadfast commitment to help growing companies achieve unprecedented levels of performance that drives long-term success. Invest in the most successful startups with us..
		<br><br>
		Get started investing with OneDayOnePip today!</p>
      <!--<br><button class="btn btn-default btn-lg">Get in Touch</button>-->
    </div>
	<div class="col-sm-1">
    </div>
	
	<!-- Sign In/Up-->
	<div class="onepip2 col-sm-2 ">
	<hr style="border-top: 1px dotted #f4511e;">
	<form action="member/login.php" method="POST">
      <div class="row">
        <div class="col-sm-12 form-group">
		Username
          <input class="form-control" id="id" name="id" placeholder="User ID/Passport" type="text" autocomplete="off" required>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
		Password
          <input class="form-control" id="pwd" name="pwd" placeholder="Password" type="password" required autocomplete="new-password" onfocus="this.removeAttribute('readonly');" readonly> 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="btn btn-primary pull-right" type="submit" value="Log In"> &nbsp;
		  <a href="index.php" class="btn btn-danger  btn-sm pull-left"><i class="glyphicon glyphicon-chevron-left"></i>Back</a>
        </div>
      </div>
      <!--<div class="row">
        <div class="col-sm-12 form-group">
          Not a member? <a href="member/page_reg.php">Sign Up here!</a>
        </div>
      </div>-->
	  </form>
	  <hr style="border-top: 1px dotted #f4511e;">
	  <?php include "alert/alert1.php"; ?>
    </div>
  </div>
</div>

<!--<div class="fixed">
<a href="index.html"><img src="images/cms.png" alt="customer service" width="90%"></a>
</div>-->

<div id="meta4" class="container-fluid meta-bg">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-globe logo slideanim"></span>
    </div>
	<!-- meta trader 4 android -->
    <div class="col-sm-4 col-xs-12">
      <div class="outerbox text-center slideanim">
        <div class="meta-trader">
          <h1>Market Capitalization</h1>
        </div>
        <div class="panel-body meta-trader2 glow3">
		<?php
		include "btc.php";
		?>
          <table style="width:100%; text-align:center;" >
		  <!--<tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Bitcoin Cash XX</td>
		  <td style="width:33%;">BCH</td><td style="width:33%;"><?=$bch?></td></tr>-->
		  <!--<tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">US Dollar XX</td>
		  <td style="width:33%;">USD</td><td style="width:33%;"><?=$usd?></td></tr>-->
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Euro</td>
		  <td style="width:33%;">EUR</td><td style="width:33%;">$<?=$eur?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Pound Sterling</td>
		  <td style="width:33%;">GBP</td><td style="width:33%;">$<?=$gbp?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Japanese Yen</td>
		  <td style="width:33%;">JPY</td><td style="width:33%;">$<?=$jpy?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Canadian Dollar</td>
		  <td style="width:33%;">CAD</td><td style="width:33%;">$<?=$cad?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Australian Dollar</td>
		  <td style="width:33%;">AUD</td><td style="width:33%;">$<?=$aud?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">Chinese Yuan</td>
		  <td style="width:33%;">CNY</td><td style="width:33%;">$<?=$cny?></td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:33%;">New Zealand Dollar</td>
		  <td style="width:33%;">NZD</td><td style="width:33%;">$<?=$nzd?></td></tr>
          </table>
        </div>
      </div>
    </div><!-- ok -->
	<div class="col-sm-4">
      +
    </div>
  </div>
</div>

<div id="players" class="container-fluid player-bg">
<center><h2 class="glow3">TOP INVESTOR</h2></center>
  <br>
  <div class="row">
	<!-- TOP PAID OUT -- >
    <div class="col-sm-6 col-xs-12">
      <div class="outerbox-2 text-center">
        <div class="box-topinvestor">
          <h1 class="glow3">PAID OUT</h1>
        </div>
        <div class="panel-body paid-out glow3">
          <table style="width:100%; text-align:center;" >
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">kareem78</td><td style="width:50%;color:yellow;">$1530.10</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">lakiuzar</td><td style="width:50%;color:yellow;">$1440.00</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">locomita</td><td style="width:50%;color:yellow;">$1220.00</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">sophia39</td><td style="width:50%;color:yellow;">$350.55</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">Ahraf206080</td><td style="width:50%;color:yellow;">$230.00</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">Ahmed62018</td><td style="width:50%;color:yellow;">$150.00</td></tr>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:50%;">Dennis4</td><td style="width:50%;color:yellow;">$110.00</td></tr>
          </table>
        </div>
      </div>
	  <div class="box-topinvestor-footer"></div>
    </div> --><div class="col-sm-4 col-xs-12"></div>
	<!-- TOP HOLDING australia-->
    <div class="col-sm-4 col-xs-12">
      <div class="outerbox-2 text-center">
        <div class="">
<?php 
date_default_timezone_set('Asia/Kuala_Lumpur');
$bolan=date("F");
$yar=date("Y");
//$bolan = date("d/m/Y", strtotime($bolan));
?>
          <h3 class="glow3">TOP HOLDING <?=strtoupper($bolan)?> <?=$yar?></h3>
        </div>
        <div class="panel-body meta-trader2 glow3">
          <table style="width:100%; text-align:left;" >
		  <?php 
		  $data72 = mysqli_query($conn,"SELECT id, SUM(amount) AS tta FROM invest where stat='Active' GROUP BY id ORDER BY tta DESC LIMIT 10") or die(mysqli_error());
		  $ind = 75000;
		  $aus = 140413;
		   while($info72 = mysqli_fetch_array( $data72 )) {
			   $id  = $info72['id'];
			   $tta = $info72['tta'];
			   $tta   = bcdiv($tta,1,2);
			   
			   if (($tta<=$ind)) {
				$ind=5;
			   echo '<tr style="border-bottom: 1px solid #f4511e;"><td style="width:10%;"><img src="images/flag/indonesia.png" height="20px"></td><td style="width:40%;">Mizrina</td><td style="width:50%;">$75000.00</td></tr>';
			   }
			   if (($tta<=$aus)) {
				$aus=5;
			   echo '<tr style="border-bottom: 1px solid #f4511e;"><td style="width:10%;"><img src="images/flag/australia.png" height="20px"></td><td style="width:40%;">Lucas</td><td style="width:50%;">$140413.10</td></tr>';
			   }
		  ?>
		  <tr style="border-bottom: 1px solid #f4511e;"><td style="width:10%;"><img src="images/flag/malaysia.png" height="20px"></td><td style="width:40%;"><?=$id?></td><td style="width:50%;">$<?=$tta?></td></tr>
		  
		<?php } ?>
		  
		  
		  
          </table>
        </div>
      </div>
    </div>
	<div class="col-sm-4 col-xs-12"></div>
  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center service-bg">
  <h2 style="color:white">SERVICES</h2>
  <br>
  <div class="row slideanim">
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-object-align-vertical logo-small"></span>
      <h4>AFFILIATE</h4>
      <p>If you are looking for simple and effective way to increase your capital, use our affiliate program. Making money on an affiliate program from ODOP is easy! Invite other people to participate in our investment project and get a nice bonus to your income.</p>
    </div>
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>DATA SECURITY</h4>
      <p>We do our best to protect clients' funds and guarantee 100% security of all personal information, thanks to the modern systems of data protection.</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-piggy-bank logo-small"></span>
      <h4>STABLE INCOME</h4>
      <p>We are ready to pay good money as interest accruals to all interested clients for participating in ODOP, considering this as amicable, mutually beneficial process of cooperation.</p>
    </div>
    <div class="col-sm-6">
      <span class="glyphicon glyphicon-sunglasses logo-small"></span>
      <h4>JOB DONE</h4>
      <p>The company provides its clients with a user-friendly interface. The personal area is simple and clear, basic information and buttons are placed on the main page.</p>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -- >
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
      <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>-->
<!-- Container (Sponsor Section) -->
<div id="sponsor" class="container-fluid text-center sponsor-bg">
  <h2 style="color:white">COMMUNITY PARTNER</h2>
  <br>
  <div class="row slideanim">
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/3.jpg" style="width:100px;"><br><br>
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/4.jpg" style="width:100px;"><br><br>
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/5.jpg" style="width:100px;">
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/6.jpg" style="width:100px;">
    </div>
  </div>
  <br>
  <div class="row slideanim">
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/2.png" style="width:100px;"><br><br>
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/1.png" style="width:100px;"><br><br>
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/10.png" style="width:100px;">
    </div>
    <div class="col-sm-3 col-xs-6">
      <img src="images/footer/9.png" style="width:100px;">
    </div>
  </div>
</div>

<footer class="container-foota text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>OneDayOnePip copyright <a href="" title="Visit w3schools">2020</a></p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>