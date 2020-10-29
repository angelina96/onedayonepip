<?php


// [1] Kira Bonus 821
$bonus = 0;


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

echo "Bonus 821 :". $bonus . "<br>";



// [2] Kira Total Deposit
$sql1="SELECT SUM(amount) as hoho from walletlog WHERE memberid='$id'";
$data1 = mysqli_query($conn,$sql1) or die(mysqli_error());
$info1 = mysqli_fetch_array( $data1 );
$totaldepo=$info1['hoho'];
echo "Total Deposit :". $totaldepo . "<br>";


// [3] Kira Total WD
$sql2="SELECT SUM(amount) as wawa from wd WHERE id='$id'";
$data2 = mysqli_query($conn,$sql2) or die(mysqli_error());
$info2 = mysqli_fetch_array( $data2 );
$totalwd=$info2['wawa'];
if($totalwd==null){ $totalwd=0;}
echo "Total WD :". $totalwd . "<br>";


$tam = 0;
$tam2 = 0;
$data6 = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id' ORDER BY created_date DESC") or die(mysqli_error());
while($info6 = mysqli_fetch_array( $data6 )) {
$amount   = $info6['amount'];
$planroi  = $info6['planroi'];
$income   = (($amount*$planroi)/100);
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$tam = $tam+ $amount;
$tam2 = $tam2+ $income;
}
echo "Total Invest :". $tam . "<br>";
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
?>
