<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include "../serverdb/server.php";
$id = $_GET['id'];
?>
<br><br>
<form action="bmk.php" method="GET">
<input type="text" name="id">
<input type="submit" value="Check">
</form>
<br><br><br>
<?php

// [1] Kira Bonus 821
$bonus = 0;
function getTotal1($siapa) {
include "../serverdb/server.php";
$sql3="SELECT SUM(amount) as haha from invest WHERE id='$siapa'";
//[JAK]$sql3="SELECT SUM(amount) as haha from invest WHERE id='$siapa' AND created_date BETWEEN '2020-09-03%' AND '2020-09-13%' ";
$data3 = mysqli_query($conn,$sql3) or die(mysqli_error($conn));
$info3 = mysqli_fetch_array( $data3 );
$totalinvest=$info3['haha'];
if($totalinvest!=null){
return $totalinvest;
}
else { return 0;}
}

		//TREE 821
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
		$sql  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '$id' AND U.id = A.userid";
		$i=1;
		$data = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($info = mysqli_fetch_array( $data )) {
		$aff_id=$info['userid'];
		$total1 = getTotal1($aff_id);
		$total1 = ($total1*0.08);
		//echo $total1;
		//echo $aff_id;
		//echo "<br>";
		$bonus = $bonus + $total1;
				
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
				$sql2  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id."' AND U.id = A.userid";
				$j=1;
				$data2 = mysqli_query($conn,$sql2) or die(mysqli_error());
				while($info2 = mysqli_fetch_array( $data2 )) {
				$aff_id2=$info2['userid'];
				$total2 = getTotal1($aff_id2);
				$total2 = ($total2*0.02);
				//echo $total2;
				//echo $aff_id2;
				//echo "<br>";
		$bonus = $bonus + $total2;
						
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
						$sql3  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id2."' AND U.id = A.userid";
						$k=1;
						$data3 = mysqli_query($conn,$sql3) or die(mysqli_error());
						while($info3 = mysqli_fetch_array( $data3 )) {
						$aff_id3=$info3['userid'];
						$total3 = getTotal1($aff_id3);
						$total3 = ($total3*0.01);
						//echo $total3;
						//echo $aff_id3;
						//echo "<br>";
		$bonus = $bonus + $total3;
						
						$k++;
						}
						?>
                        </li></ol><?php
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
				$j++;
				}
				?></li><?php
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
		$i++;
		}
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
echo "<font color='green' size='20px'>".$id."</font>";
echo "<br>";
echo "Bonus Referral :". $bonus . "<br>";

// [NEW.1.1] Kira Total Bonus Melalui walletlog (latest 2020)
$sql48="SELECT SUM(amount) AS total_bonus from walletlog WHERE memberid='$id' AND (trc='B1' OR trc='B2' OR  trc='B3') ";
$data48 = mysqli_query($conn,$sql48) or die(mysqli_error($conn));
$info48 = mysqli_fetch_array( $data48 );
$total_bonus = $info48['total_bonus'];
$total_bonus=number_format((float)$total_bonus, 2, '.', '');
echo "<b>Bonus Referral (RECIEVED) :<font color='#9900cc'>". $total_bonus . "</font></b><br>";


// [2] Kira Total Deposit
$sql1="SELECT SUM(amount) as hoho from walletlog WHERE memberid='$id' AND trc='Deposit' ";
$data1 = mysqli_query($conn,$sql1) or die(mysqli_error());
$info1 = mysqli_fetch_array( $data1 );
$totaldepo=$info1['hoho'];
echo "<b>Total Deposit :<font color='#9900cc'>". $totaldepo . "</font></b><br>";


// [3] Kira Total WD
$sql2="SELECT SUM(amount) as wawa from wd WHERE id='$id' AND stat!='Declined'";
$data2 = mysqli_query($conn,$sql2) or die(mysqli_error());
$info2 = mysqli_fetch_array( $data2 );
$totalwd=$info2['wawa'];
if($totalwd==null){ $totalwd=0;}
//echo "Total WD :". $totalwd . "<br>";
echo "<b>Total Withdrawal :<font color='#9900cc'>". $totalwd . "</font></b><br>";

// [4] Kira Total Invest
/*
$sql4="SELECT SUM(amount) as hihi from invest WHERE id='$id'";
$data4 = mysqli_query($conn,$sql4) or die(mysqli_error());
$info4 = mysqli_fetch_array( $data4 );
$totaliv=$info4['hihi'];
if($totaliv==null){ $totaliv=0;}
echo "Total Invest :". $totaliv . "<br>";
*/

// [5] Kira Total GET 
/*
$sql5="SELECT SUM(amount) as hee from invest WHERE id='$id'";
$data5 = mysqli_query($conn,$sql5) or die(mysqli_error());
$info5 = mysqli_fetch_array( $data5 );
$totalget=$info5['hee'];
if($totalget==null){ $totalget=0;}
echo "Total GET :". $totalget . "<br>";
*/
$tam = 0;
$tam2 = 0;
$piprogress=0;
$total_pip=0;
$data6 = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id' ORDER BY created_date DESC") or die(mysqli_error());
while($info6 = mysqli_fetch_array( $data6 )) {
$amount   = $info6['amount'];
$planroi  = $info6['planroi'];
$planday  = $info6['planday'];
$counter  = $info6['counter'];
$income   = (($amount*$planroi)/100);
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$tam = $tam+ $amount;
$tam2 = $tam2+ $income;


//[NEW.5.1]Kira progress mengikut counter pip
$parsent19  = (($planroi - 100)/$planday);
$pip19 = (($amount*$parsent19)/100);
$piprogress=$pip19*$counter;
$status19 = $info6['cashback'];
if($status19=="DONE"){ $piprogress=$piprogress+$amount; }
//$piprogress=number_format((float)$piprogress, 2, '.', '');
//echo "<br>".$piprogress."<br>";

$total_pip = $total_pip+ $piprogress;
$total_pip=number_format((float)$total_pip, 2, '.', '');
}
//echo "Total Invest :". $tam . "<br>";
echo "<b>Total Invest :<font color='#9900cc'>". $tam . "</font></b><br>";
echo "<b>Total PIP iNVEST :<font color='#9900cc'>". $total_pip . "</font></b><br>";

//Pengiraan Baki
$baki = $totaldepo+$total_bonus-$totalwd-$tam+$total_pip;
echo "<b>Balance Wallet :<font color='#9900cc'>". $baki . "</font></b><br>";
echo "Total GET :". $tam2 . "<br>";
/////////////////////////////////////////////////////////////////
$investx = 0;
$getx = 0;
$amountx = 0;
$data6x = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id' AND stat='Completed'") or die(mysqli_error($conn));
while($info6x = mysqli_fetch_array( $data6x )) {
$amountx   = $info6x['amount'];
$planroix  = $info6x['planroi'];
$incomex   = (($amountx*$planroix)/100);
$incomex   = bcdiv($incomex,1,2);
$amountx   = bcdiv($amountx,1,2);
$investx = $investx+ $amountx;
$getx = $getx+ $incomex;
}
//[6] Kira income complete (depo-invest+get)
$kincomex = (($totaldepo - $investx)+$getx);
echo "Income Completed[(depo-invest)+get] :". $kincomex . "<br>";
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
$investy = 0;
$amounty = 0;
$gety = 0;
$data6y = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id' AND stat='Active'") or die(mysqli_error($conn));
while($info6y = mysqli_fetch_array( $data6y )) {
$amounty   = $info6y['amount'];
$planroiy  = $info6y['planroi'];
$incomey   = (($amounty*$planroiy)/100);
$incomey   = bcdiv($incomey,1,2);
$amounty   = bcdiv($amounty,1,2);
$investy = $investy+ $amounty;
$gety = $gety+ $incomey;
}
//[6] Kira income aktif xdpt lg (depo-invest+get)
$kincomey = (($totaldepo - $investy)+$gety);
echo "INVESTMENT AKTIF :". $amounty . "<br>";
echo "Income Aktif Akan Dapat[(depo-invest)+get] :". $kincomey . "<br>";
/////////////////////////////////////////////////////////////////

//[6] Kira income (depo-invest+get)
$kincome = (($totaldepo - $tam)+$tam2);
echo "Income All [(depo-invest)+get] :". $kincome . "<br>";

//[7] Kira balance wallet (income+bonus)-wd
$wow = (($kincome+$bonus)-$totalwd);
echo "Wallet [(income+bonus)-wd] :". $wow . "<br>";


//[8] Kira betul x Invest(depo+bonus)-invest
$wow2 = (($totaldepo+$bonus)-$tam);
if($wow2<0){ $color='red'; } else { $color='blue'; }
echo "Validation Invest [(depo+bonus)-invest] :<font color='".$color."'>". $wow2 . "</font><br>";

//[9] Kira betul x WD (income+bonus)-wd
$wow3 = (($kincome+$bonus)-$totalwd);
if($wow3<0){ $color2='red'; } else { $color2='blue'; }
echo "Validation WD [(income+bonus)-wd] :<font color='".$color2."'>". $wow3 . "</font><br>";

// [10] Valid Wallet
$sql10="SELECT walletb from wallet WHERE id='$id'";
$data10 = mysqli_query($conn,$sql10) or die(mysqli_error($conn));
$info10 = mysqli_fetch_array( $data10 );
$balwallet=$info10['walletb'];
echo "BALANCE WALLET :". $balwallet . "<br>";

$wow4 = (($kincomex+$bonus)-$totalwd);
//$wow4 = floatval($wow4);

$wow4   = bcdiv($wow4,1,2);
$wow4 = $wow4 - $amounty;
if($wow4<0){ $color4='red'; } else { $color4='blue'; }
echo "VALIDATION BALANCE WALLET [(income complete+bonus)-wd - invst active] :<font color='".$color4."'>". $wow4 . "</font><br>";

// [11] Total Active Holding
$sql26="SELECT sum(amount) as totalho from invest WHERE id='$id' AND stat='Active'";
$data26 = mysqli_query($conn,$sql26) or die(mysqli_error($conn));
$info26 = mysqli_fetch_array( $data26 );
$totalho = $info26['totalho'];
$totaldepo=number_format((float)$totaldepo, 2, '.', '');
$totalho=number_format((float)$totalho, 2, '.', '');
$total_bonus=number_format((float)$total_bonus, 2, '.', '');
$totalwd=number_format((float)$totalwd, 2, '.', '');
$tam=number_format((float)$tam, 2, '.', '');
$balwallet=number_format((float)$balwallet, 2, '.', '');

//[12] GET USER INFO
$sql23="SELECT * from userpro WHERE id='$id'";
$data23 = mysqli_query($conn,$sql23) or die(mysqli_error($conn));
$info23 = mysqli_fetch_array( $data23 );
$phone  = $info23['phone'];
?>

<hr>

<?php 
echo "<b>*".$id."*</b> &nbsp;  ".$phone."<br>";
echo "<b>Total Deposit :<font color='#9900cc'>". $totaldepo . "</font></b><br>";
echo "<b>Bonus Referral :". $total_bonus . "</b><br>";
echo "<b>Total Withdrawal :<font color='#9900cc'>". $totalwd . "</font></b><br>";
echo "<b>Total Activated Holding :<font color='#9900cc'>". $tam . "</font></b><br>";
echo "<b>Total ROI Already Recieved :<font color='#9900cc'>". $total_pip . "</font></b><br>";
echo "<b>Total Active Holding [ongoing] :<font color='#9900cc'>". $totalho . "</font></b><br><br>";
//echo "Total Deposit - Total Activated Holding + Total ROI Already Recieved + Bonus Referral - Total Withdrawal = Balance Wallet<br><br>";
echo "*<b>BALANCE AUDITED WALLET :<font color='#189100'>". $baki . "</font></b>*<br>";
echo "Invalid account with balance :". $balwallet . "<br>";
$CEK = $baki - $balwallet;
if($CEK<0){ $color2='red'; } else { $color2='green'; }
echo "Rectify :<font color='".$color2."'>". $CEK . "</font><br>";
?>