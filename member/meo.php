<?php
//[1]cek siapa affiliate level 1 dia dapat 7% bonus
	//$821
	$lapan  = getAffiliateLV1($id);
	
	/*$bonus8 = ($amount*(7/100)); */$bonussilver8 = ($amount*(7/100));$bonusgold8 = ($amount*(8/100));$bonusplatinum8 = ($amount*(9/100));
	$bonus2 = ($amount*(1/100));//$bonussilver2 = ($amount*(1/100));$bonusgold2 = ($amount*(1/100));$bonusplatinum2 = ($amount*(1/100)); /* tak buat sbb semua 1 */
	/*$bonus1 = ($amount*(3/100)); */$bonussilver1 = ($amount*(1/100));$bonusgold1 = ($amount*(2/100));$bonusplatinum1 = ($amount*(3/100));
	
	if($lapan!=""){
		//[2]cek dulu lapan aktif tak,tp refresh dulu
		$refr = refreshPortfUSDT($lapan);
		//[3]pastu cek
		$statu8 = cekAktifTak2($lapan);
		$rank8 = cekRank2($lapan);
		/*****************************************************************************************/
		//[NEW] RGM IS ACTIVE PLATINUM
		$pslapan  = getposition($lapan); if($pslapan=="LP"){ $rank8="PLATINUM"; $statu8 ="Active"; }
		//SPG
		$spg8  = getspg($lapan); 
		if($spg8=="G"){ $rank8="GOLD"; $statu8 ="Active"; }
		if($spg8=="P"){ $rank8="PLATINUM"; $statu8 ="Active"; }
		/*****************************************************************************************/
		
		if ($statu8 =="Active"){
		//[4] kalau aktif baru amik value wallet kalau ada org atas utk bagi bonus
		$wallet8 = getWalletb2($lapan);
		//$wallet8 = $wallet8 + $bonus8;
		if ($rank8=='SILVER'){$wallet8 = $wallet8 + $bonussilver8;     $b1=$bonussilver8;  }
		if ($rank8=='GOLD'){$wallet8 = $wallet8 + $bonusgold8;         $b1=$bonusgold8;    }
		if ($rank8=='PLATINUM'){$wallet8 = $wallet8 + $bonusplatinum8; $b1=$bonusplatinum8;}
		
		$sqlUP8="UPDATE wallet 
		set usdt = '$wallet8'
		WHERE id = '$lapan'";
		$resultUP8=mysqli_query($conn,$sqlUP8) or die(mysqli_error());
		
		if ($resultUP8){
		//walletlog bonus lv1
		$sql45="INSERT INTO walletlog (memberid,amount, walletb, sender, trc) values('$lapan','$b1','$wallet8','$id', 'B1USDT')";
		$result45=mysqli_query($conn,$sql45) or die(mysqli_error());

			
			$dua = getAffiliateLV1($lapan); //[1] cek siapa affiliate level 1(2) utk org 8% bonus
			if($dua!=""){					//[ ] Kalau ada baru proceed 2-3-4
			$refr2 = refreshPortfUSDT($dua); 	//[2] cek dulu dua aktif tak,tp refresh dulu
			$statu2 = cekAktifTak2($dua); 	//[3] pastu cek
			/*****************************************************************************************/
			//[NEW] RGM IS ACTIVE PLATINUM
			$psdua  = getposition($dua); if($psdua=="LP"){ /*$rank2="PLATINUM";*/ $statu2 ="Active"; }
			//SPG
			$spg2  = getspg($dua); 
			if($spg2=="G"){ $rank2="GOLD"; $statu2 ="Active"; }
			if($spg2=="P"){ $rank2="PLATINUM"; $statu2 ="Active"; }
			/*****************************************************************************************/
			if ($statu2 =="Active"){		//[ ] kalau aktif dulu baru proceed 4
			$wallet2 = getWalletb2($dua);	//[4] kalau aktif baru amik value wallet kalau ada org atas utk bagi bonus. tapi ni atas kena aktif dulu baru dia terima
			$wallet2 = $wallet2 + $bonus2;
			$sqlUP2="UPDATE wallet 
			set usdt = '$wallet2'
			WHERE id = '$dua'";
			$resultUP2=mysqli_query($conn,$sqlUP2) or die(mysqli_error());
			
			if ($resultUP2){
			//walletlog bonus lv2
			$sql46="INSERT INTO walletlog (memberid,amount, walletb, sender, trc) values('$dua','$bonus2','$wallet2','$id', 'B2USDT')";
			$result46=mysqli_query($conn,$sql46) or die(mysqli_error());
			
			$satu = getAffiliateLV1($dua);  //[1] cek siapa affiliate level 1(2) utk org 8% bonus
			if($satu!=""){					//[ ] Kalau ada baru proceed 2-3-4
			$refr1 = refreshPortfUSDT($satu); 	//[2] cek dulu lapan aktif tak,tp refresh dulu
			$statu1 = cekAktifTak2($satu); 	//[3] pastu cek
			$rank1 = cekRank2($satu);
			/*****************************************************************************************/
			//[NEW] RGM IS ACTIVE PLATINUM
			$ps1  = getposition($satu); if($ps1=="LP"){ $rank1="PLATINUM"; $statu1 ="Active"; }
			//SPG
			$spg1  = getspg($satu); 
			if($spg1=="G"){ $rank1="GOLD"; $statu1 ="Active"; }
			if($spg1=="P"){ $rank1="PLATINUM"; $statu1 ="Active"; }
			/*****************************************************************************************/
			if ($statu1 =="Active"){		//[ ] kalau aktif dulu baru proceed 4
			$wallet1 = getWalletb2($satu);	//[4] kalau aktif baru amik value wallet kalau ada org atas utk bagi bonus. tapi ni atas kena aktif dulu baru dia terima
			//$wallet1 = $wallet1 + $bonus1;
			if ($rank1=='SILVER')	{$wallet1 = $wallet1 + $bonussilver1;   $b3=$bonussilver1;  }
			if ($rank1=='GOLD')		{$wallet1 = $wallet1 + $bonusgold1;     $b3=$bonusgold1;    }
			if ($rank1=='PLATINUM')	{$wallet1 = $wallet1 + $bonusplatinum1; $b3=$bonusplatinum1;}

			$sqlUP1="UPDATE wallet 
			set usdt = '$wallet1'
			WHERE id = '$satu'";
			$resultUP1=mysqli_query($conn,$sqlUP1) or die(mysqli_error());
			
			if ($resultUP1){
			//walletlog bonus lv3
			$sql47="INSERT INTO walletlog (memberid,amount, walletb, sender, trc) values('$satu','$b3','$wallet2','$id', 'B3USDT')";
			$result47=mysqli_query($conn,$sql47) or die(mysqli_error());
				if ($result47){
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
				}
			}
			/* #kalau resultUP1 error */
			else {
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
			}
			}
			/* #kalau org level 1 tak aktif portfolio */
			else {
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
			}
			}
			/* #kalau xde org level 3 dpt bonus 1# */
			else {
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
			}
			}
			/* #kalau resultUP2 error :  xde org level 2 dpt bonus 2# */
			else {
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
			}
		}
		/* #kalau org level 2 xaktif portfolio*/
			else {
				echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
				exit();
			}
		}
		/* #kalau xde org level 2 */
		else {
			echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
			exit();
		}
	}
		/* #kalau resultUP8 error */
		else {
			echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
			exit();
		}
	}
	/* #kalau org level 1 yang dapat bonus 8 tak aktif portfolio*/
	else {
		echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
		exit();
	}
	}
	/* #kalau org level 1 xde*/
	else {
		echo ("<script LANGUAGE='JavaScript'>window.location.href='page_invest3.php?contract=approve';</script>");
		exit();
	}
?>