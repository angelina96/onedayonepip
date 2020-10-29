<?php
/*
$progress = ((0 - 0) / (0 - 0)) * 100;
$progress = bcdiv($progress,1,2);
echo $progress; */
include "serverdb/server.php";
?>

<ul>
<?php //TREE 821
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
		$sql29  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = 'MALINI' AND U.id = A.userid";
		$i=1;
		$data = mysqli_query($conn,$sql29) or die(mysqli_error());
		while($info = mysqli_fetch_array( $data )) {
		$aff_id=$info['userid'];
		//echo "[".$i."]-".$aff_id."<br>";
				?>
				<li>
                <?=$aff_id?>
                <?php
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
				$sql30  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id."' AND U.id = A.userid";
				$j=1;
				$data2 = mysqli_query($conn,$sql30) or die(mysqli_error());
				while($info2 = mysqli_fetch_array( $data2 )) {
				$aff_id2=$info2['userid'];
				//echo "-------[".$j."]-".$aff_id2."<br>";
						?>
						<ul>
						<li>
                        <?=$aff_id2?>
                        
                        <?php
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
						$sql31  = "SELECT * FROM affiliate A,userpro U WHERE A.upline = '".$aff_id2."' AND U.id = A.userid";
						$k=1;
						$data3 = mysqli_query($conn,$sql31) or die(mysqli_error());
						while($info3 = mysqli_fetch_array( $data3 )) {
						$aff_id3=$info3['userid'];
						//echo "+++++++++++++++++[".$k."]-".$aff_id3."<br>";
						?>
						<ul><li><?=$aff_id3?></li></ul><?php
						$k++;
						}
						?>
                        </li></ul><?php
						//LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3LV3
				$j++;
				}
				?></li><?php
				//LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2LV2
		$i++;
		}
		//LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1LV1
?>
</ul>