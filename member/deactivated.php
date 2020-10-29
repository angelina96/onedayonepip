<?php 
ob_start();
session_start();
include "../serverdb/server.php";

include "content/header.php";
//include "content/preloader.php"; 
//include "content/nav.php";
//include "content/minimum.php";
$id=$_GET["id"];
?>
<div class="container-fluid plan-bg" style="height: 100vh;">
  <div class="row">
  <div class="col-sm-12 col-xs-12">
	<div class="box-welcome2">
		<br><br><br><h3 class="glow4">Your account <?=$id?> is suspended</h3>
		
</div>	
<style>
.glowWARNING {
    color: #fff;
    text-shadow: 0 0 10px rgba(255, 230, 0, 0.774), 0 0 20px #ff0000, 0 0 30px #ff0000, 0 0 40px #ff0000;
   }
   
   .btred {
    background-color: rgb(255, 0, 0); 
    border: none;
    border-radius: 8px;
    color: #ffffff;
    padding: 5px 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
  }
  
.bt1red {
    background-color: transparent; 
    color: #ffffff; 
    border: 2px solid rgb(255, 0, 0);
  }
  
  .bt1red:hover {
    background-color: rgb(255, 0, 0);
    color: #fff000;
  }

</style>
<div class="col-sm-4 col-xs-12"></div>
<div class="col-sm-4 col-xs-12">
<table><tr><td style="text-align: left">
<H3 class="glowWARNING">
Your account had been banned because of violation of our regulation.<BR>
Please contact your immediate superior. <Br>
Thank you
</H3>
</td></tr></table>

<center><a href="../index.php"><button  class="btred bt1red glow1">Back &nbsp; <i class="glyphicon glyphicon-arrow-left"></i></button></a></center>
</div>
<div class="col-sm-4 col-xs-12"></div>
  </div>
  </div>
  </div>