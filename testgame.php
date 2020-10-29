<body bgcolor="black">
<style>
p{color:yellow;
  font-family : Arial} 
table{color: yellow;}</style>
<p align="center">
<table>
<?php
include "serverdb/server.php";
date_default_timezone_set('Asia/Kuala_Lumpur');

$id4rp="ww";

echo "<font color='#7CFC00'>".$id4rp."</font>";

$dataRP = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id4rp' ORDER BY created_date ASC") or die(mysqli_error());
while($infoRP = mysqli_fetch_array( $dataRP )) {

$dataWALLET = mysqli_query($conn,"SELECT walletb FROM wallet WHERE id='$id4rp'") or die(mysqli_error());
$infoWALLET = mysqli_fetch_array( $dataWALLET );
$walletb  = $infoWALLET['walletb'];

$SN   	  = $infoRP['sn'];
$planroi  = $infoRP['planroi'];
$planday  = $infoRP['planday'];
$amount   = $infoRP['amount'];
$counter  = $infoRP['counter'];
$stat 	  = $infoRP['stat'];
$days     = $planday * 86400;

$parsent  = (($planroi - 100)/$planday);
$pip = (($amount*$parsent)/100);

//echo "Invest:".$amount." - Percent:".$parsent."% - Pip".$pip."<br>";
echo "<tr><td><font color='#ff6105'>-----Review plan-----</font>Invest: </td><td>".$amount."</td><td>Percent:</td><td>".$parsent."%</td><td> - Pip</td><td>".$pip."</td><td>Plan day: </td><td>".$planday."</td><td>Plan ROI: 100USD GET</td><td>".$planroi."USD</td></tr>";

$dateNow  = date("Y-m-d H:i:s");
$current  = strtotime($dateNow);
$datestart= $infoRP['created_date'];
$start    = strtotime($infoRP['created_date']);
$end      = $start + $days;

$start  = date("Y-m-d H:i:s",$start);
$end  = date("Y-m-d H:i:s",$end);


$diff = strtotime($dateNow) - strtotime($datestart); 
$dateDiff = abs(round($diff / 86400)); 




if ($dateNow > $end) { $dateNow = $end; }
$bakihari = $planday - $dateDiff;

if ($bakihari<=0){$bakihari="<font color='red'>TAMAT</font>"; }
$kalautunggak = $dateDiff - $counter;
if ($kalautunggak!=0){ $pip=$pip*$kalautunggak; }

$lepasdokagi = "salohkire";
if ($dateNow < $end) { $lepasdokagi="dokagi"; $colorxd = "blue"; } else { $lepasdokagi = "lepasdoh"; $colorxd = "#7cfc00"; }
echo "<br><hr><br><font color='".$colorxd."'>".$lepasdokagi."</font><br>";

if (($lepasdokagi=="dokagi")&&($stat=="Active")){ $piptotal = $pip+$walletb; }
else if (($lepasdokagi=="lepasdoh")&&($stat=="Active")){ $piptotal = $pip+$walletb+$amount; }
else {$piptotal = "<FONT COLOR='RED'>OUT OF RANGE</FONT>"; echo $stat."-----------------------".$lepasdokagi."<BR>"; }

/* ########### UPDATE STATUS AND CASHBACK DAY ########### */
if (($lepasdokagi=="lepasdoh")&&($stat=="Active")){
$toto = $walletb+$amount;
echo $toto."------------------";
$result3 = mysqli_query($conn,"UPDATE invest set stat = 'Completed' WHERE id = '$id4rp' AND sn='$SN'");
//$result4 = mysqli_query($conn,"UPDATE wallet set walletb = '$toto' WHERE id = '$id4rp'"); 
}

/* ########### UPDATE WALLET DAPATHARINI ########### */
if ($lepasdokagi=="lepasdoh"){ $dapatharini = "0";}
if (($lepasdokagi=="dokagi")||(($lepasdokagi=="lepasdoh")&&($kalautunggak>0))){
$dapatharini = $pip;
	if($counter < $dateDiff){
	$result = mysqli_query($conn,"UPDATE wallet set walletb = '$piptotal' WHERE id = '$id4rp'"); 
	}
}

/* ########### UPDATE COUNTER DAY ########### */
$result2 = mysqli_query($conn,"UPDATE invest set counter = '$dateDiff' WHERE id = '$id4rp' AND sn='$SN'"); 

$sekarang = date("Y-m-d H:i:s");
echo "Now:".$sekarang." 
	 <br>start_".$start."
	 <br>end._".$end."<br>";
echo "<br>dapatharini = ".$dapatharini;
echo "<br>[datedif]  = Hari ke-<font size='6px'>".$dateDiff."</font>";
echo "<br>bakihari = ".$bakihari;
echo "<br>planday = ".$planday;
echo "<br>kalautunggak = ".$kalautunggak;
echo "<br>pip = ".$pip;
echo "<br>piptotal = ".$piptotal;
		//<br>current:".$current." 
		


/*$income   = (($amount*$planroi)/100);
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
//$walletb = $infoWALLET['walletb'] + $income ;



$progress = (($current - $start) / ($end - $start)) * 100;
$progress = bcdiv($progress,1,2);
if ($progress >= 100){
	$stat 	  = $infoRP['stat'];
	if($stat!="Completed"){
		$result = mysqli_query($conn,"UPDATE invest set stat = 'Completed' WHERE id = '$id4rp' AND sn='$SN'"); 
		if($result){
		$resultwalle = mysqli_query($conn,"UPDATE wallet set walletb = '".$walletb."' WHERE id = '$id4rp'"); 
			if($resultwalle){
				$sql1="INSERT INTO investlog (memberid,amount,income,planname,planroi,planday,walletb) values('".$id4rp."','$amount','$income','PLANNAME','$planroi','$planday','$walletb')";
				$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			}
		}
		}
} */
}
echo "<br><hr>";
//return $walletb;
?>
</table>
</p>
</body>