<?
//----------------------------------------------------------------------------------
// get position
//----------------------------------------------------------------------------------
function getposition($id){
	include "../serverdb/server.php";
	
	$sql27="SELECT akaun from userpro WHERE id='$id'";
	$data27 = mysqli_query($conn,$sql27) or die(mysqli_error($conn));
	$info27 = mysqli_fetch_array( $data27 );
	$position = $info27['akaun'];
	//if($position=="LP"){$position='RGM'; $rank="PLATINUM"; $gg="platinum"; }
	
	return $position;
}

//----------------------------------------------------------------------------------
// get special gold
//----------------------------------------------------------------------------------
function getspg($id){
	include "../serverdb/server.php";
	
	$sql50="SELECT aktif from userpro WHERE id='$id'";
	$data50 = mysqli_query($conn,$sql50) or die(mysqli_error($conn));
	$info50 = mysqli_fetch_array( $data50 );
	$spg = $info50['aktif'];
	return $spg;
}

//----------------------------------------------------------------------------------
// get affiliateLV1
//----------------------------------------------------------------------------------
function getAffiliateLV1($id){
	include "../serverdb/server.php";
	$sql12="SELECT upline FROM affiliate WHERE userid='$id'";
	$data12 = mysqli_query($conn,$sql12) or die(mysqli_error());
	$info12 = mysqli_fetch_array( $data12 );
	$affLV1 = $info12['upline'];
	return $affLV1;
}
//----------------------------------------------------------------------------------
// refreshPortf $sql13 sql14 sql15 sql16
//----------------------------------------------------------------------------------
function refreshPortf($id4rp){
include "../serverdb/server.php";

$done = "clean";
$dataRP = mysqli_query($conn,"SELECT * FROM invest WHERE id='$id4rp' ORDER BY created_date ASC") or die(mysqli_error());
while($infoRP = mysqli_fetch_array( $dataRP )) {

date_default_timezone_set('Asia/Kuala_Lumpur');

$dataWALLET = mysqli_query($conn,"SELECT walletb FROM wallet WHERE id='$id4rp'") or die(mysqli_error());
$infoWALLET = mysqli_fetch_array( $dataWALLET );
//$walletb  = $infoWALLET['walletb'];

$SN   	  = $infoRP['sn'];
$planroi  = $infoRP['planroi'];
$planday  = $infoRP['planday'];
$amount   = $infoRP['amount'];
$days     = $planday * 86400;

$income   = (($amount*$planroi)/100);  
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$walletb = $infoWALLET['walletb'] + $income ;

$dateNow  = date("Y-m-d H:i:s");

$current  = strtotime($dateNow);
$start    = strtotime($infoRP['created_date']);
$end      = $start + $days;

$progress = (($current - $start) / ($end - $start)) * 100;
$progress = bcdiv($progress,1,2);


if ($progress >= 100){
	$stat 	  = $infoRP['stat'];
	if($stat!="Completed"){
		$result = mysqli_query($conn,"UPDATE invest set stat = 'Completed', cashback='Y', plantype='STFF'  WHERE id = '$id4rp' AND sn='$SN'"); 
		if($result){
		$resultwalle = mysqli_query($conn,"UPDATE wallet set walletb = '".$walletb."' WHERE id = '$id4rp'"); 
			if($resultwalle){
				$sql1="INSERT INTO investlog (memberid,amount,income,planname,planroi,planday,walletb) values('".$id4rp."','$amount','$income','PLANNAME','$planroi','$planday','$walletb')";
				$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			}
		}
		$done = "updated";
		}
}
}
return $done;
//return $walletb;
}










//----------------------------------------------------------------------------------
// refreshPortfUSDT $sql13 sql14 sql15 sql16
//----------------------------------------------------------------------------------
function refreshPortfUSDT($id4rp){
include "../serverdb/server.php";

$done = "clean";
$data61 = mysqli_query($conn,"SELECT * FROM investusdt WHERE id='$id4rp' ORDER BY created_date ASC") or die(mysqli_error($conn));
while($info61 = mysqli_fetch_array( $data61 )) {

date_default_timezone_set('Asia/Kuala_Lumpur');

$data62 = mysqli_query($conn,"SELECT usdt FROM wallet WHERE id='$id4rp'") or die(mysqli_error($conn));
$info62 = mysqli_fetch_array( $data62 );
//$walletb  = $infoWALLET['walletb'];

$SN   	  = $info61['sn'];
$planroi  = $info61['planroi'];
$planday  = $info61['planday'];
$amount   = $info61['amount'];
$days     = $planday * 86400;

$income   = (($amount*$planroi)/100);  
$income   = bcdiv($income,1,2);
$amount   = bcdiv($amount,1,2);
$walletb = $info62['usdt'] + $income ;

$dateNow  = date("Y-m-d H:i:s");

$current  = strtotime($dateNow);
$start    = strtotime($info61['created_date']);
$end      = $start + $days;

$progress = (($current - $start) / ($end - $start)) * 100;
$progress = bcdiv($progress,1,2);


if ($progress >= 100){
	$stat 	  = $info61['stat'];
	if($stat!="Completed"){
		$result = mysqli_query($conn,"UPDATE investusdt set stat = 'Completed', cashback='Y', plantype='STFU'  WHERE id = '$id4rp' AND sn='$SN'"); 
		if($result){
		$resultwalle = mysqli_query($conn,"UPDATE wallet set usdt = '".$walletb."' WHERE id = '$id4rp'"); 
			if($resultwalle){
				$sql1="INSERT INTO investlog (memberid,amount,income,planname,planroi,planday,walletb) values('".$id4rp."','$amount','$income','PLANUSDT','$planroi','$planday','$walletb')";
				$result=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
			}
		}
		$done = "updated";
		}
}
}
return $done;
//return $walletb;
}





//----------------------------------------------------------------------------------
// get cekAktifTak
//----------------------------------------------------------------------------------
function cekAktifTak($id){
	include "../serverdb/server.php";
	$sql17="SELECT stat FROM invest WHERE id='$id' AND stat='Active' LIMIT 1";
	$data17 = mysqli_query($conn,$sql17) or die(mysqli_error());
	$info17 = mysqli_fetch_array( $data17 );
	$statu = $info17['stat'];

	if ($statu=="Active"){
		return $statu;
	}
	else{
		return null;
	}
}
//----------------------------------------------------------------------------------
// get cekRank
//----------------------------------------------------------------------------------
function cekRank($id){
	include "../serverdb/server.php";
	$sql26="SELECT sum(amount) as totalho from invest WHERE id='$id' AND stat='Active'";
	$data26 = mysqli_query($conn,$sql26) or die(mysqli_error($conn));
	$info26 = mysqli_fetch_array( $data26 );
	$totalho = $info26['totalho'];
	if($totalho==null){ $totalho="NONE"; }
	if($totalho==0){ $rank="INACTIVE";  }
	if(($totalho>=1)&&($totalho<1000)){ $rank="SILVER";  }
	if(($totalho>999)&&($totalho<5000)){ $rank="GOLD"; }
	if($totalho>4999){ $rank="PLATINUM"; }

		return $rank;
	
}



//----------------------------------------------------------------------------------
// get cekAktifTak2
//----------------------------------------------------------------------------------
function cekAktifTak2($id){
	include "../serverdb/server.php";
	$sql17="SELECT stat FROM investusdt WHERE id='$id' AND stat='Active' LIMIT 1";
	$data17 = mysqli_query($conn,$sql17) or die(mysqli_error());
	$info17 = mysqli_fetch_array( $data17 );
	$statu = $info17['stat'];

	if ($statu=="Active"){
		return $statu;
	}
	else{
		return null;
	}
}
//----------------------------------------------------------------------------------
// get cekRank2
//----------------------------------------------------------------------------------
function cekRank2($id){
	include "../serverdb/server.php";
	$sql26="SELECT sum(amount) as totalho from investusdt WHERE id='$id' AND stat='Active'";
	$data26 = mysqli_query($conn,$sql26) or die(mysqli_error($conn));
	$info26 = mysqli_fetch_array( $data26 );
	$totalho = $info26['totalho'];
	if($totalho==null){ $totalho="NONE"; }
	if($totalho==0){ $rank="INACTIVE";  }
	if(($totalho>=1)&&($totalho<1000)){ $rank="SILVER";  }
	if(($totalho>999)&&($totalho<5000)){ $rank="GOLD"; }
	if($totalho>4999){ $rank="PLATINUM"; }

		return $rank;
	
}
//----------------------------------------------------------------------------------
// get getWalletb2
//----------------------------------------------------------------------------------
function getWalletb2($id){
	include "../serverdb/server.php";
	$sql18="SELECT usdt from wallet WHERE id='$id'";
	$result18=mysqli_query($conn,$sql18);
	$row18=mysqli_fetch_row($result18);
	if ($row18[0]!=""){
		return $row18[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// get getWalletb
//----------------------------------------------------------------------------------
function getWalletb($id){
	include "../serverdb/server.php";
	$sql18="SELECT walletb from wallet WHERE id='$id'";
	$result18=mysqli_query($conn,$sql18);
	$row18=mysqli_fetch_row($result18);
	if ($row18[0]!=""){
		return $row18[0];
	}
	else{
		return null;
	}
}

//----------------------------------------------------------------------------------
// get getRep1
//----------------------------------------------------------------------------------
function getRep1($datez){
	include "../serverdb/server.php";
	$sql18="SELECT SUM(amount) AS totalbo from walletlog WHERE created_date LIKE '$datez%' AND trc='Deposit' ";
	$result18=mysqli_query($conn,$sql18);
	$row18=mysqli_fetch_row($result18);
	$rep1=number_format((float)$row18[0], 2, '.', '');
	
	if ($row18[0]!=""){
		return $rep1;
	}
	else{
		return null;
	}
}
//----------------------------------------------------------------------------------
// get getRep2
//----------------------------------------------------------------------------------
function getRep2($datez){
	include "../serverdb/server.php";
	$sql18="SELECT SUM(amount) AS totalwd from wd WHERE created_date LIKE '$datez%' ";
	$result18=mysqli_query($conn,$sql18);
	$row18=mysqli_fetch_row($result18);
	
	$rep2=number_format((float)$row18[0], 2, '.', '');
	
	if ($row18[0]!=""){
		return $rep2;
	}
	else{
		return null;
	}
}
?>