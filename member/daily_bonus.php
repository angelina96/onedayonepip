
<?php
//session_start();
//include "../serverdb/server.php";
//$_SESSION['USERPRO'] = "yy";
//date_default_timezone_set('Asia/Kuala_Lumpur');

?>
 <table class="table" style="width:100%;" border="1">
<?php 
$sql19="SELECT * FROM invest WHERE id='$_SESSION[USERPRO]'";
$data19 = mysqli_query($conn,$sql19) or die(mysqli_error());
while($info19 = mysqli_fetch_array( $data19 )) {
	$created_date = $info19['created_date']; 
	$created_date = strtotime($created_date);
	$date1 = date('Y-m-d', $created_date);
	
	//end
	$end      = strtotime($info19['created_date']) + ($info19['planday']* 86400);
	$end  	  = date("Y-m-d",$end);
	
	//start
	$start    = strtotime($info19['created_date']);
	$start    = date("Y-m-d",$start);
	$masabon  = date("h:ia",strtotime($info19['created_date']));
	
	$planroi19  = $info19['planroi'];
	$planday19  = $info19['planday'];
	$amount19  = $info19['amount'];
	$counter  = $info19['counter'];
	$parsent19  = (($planroi19 - 100)/$planday19);
	$pip19 = (($amount19*$parsent19)/100);
	$piprogress=$pip19*$counter;
	$dapat=(($planroi19*$amount19)/100);
	$dapat=number_format((float)$dapat, 2, '.', '');
	$piprogress=number_format((float)$piprogress, 2, '.', '');
	$amount19=number_format((float)$amount19, 2, '.', '');
	$status19 = $info19['cashback'];
	if($status19=="DONE"){ $piprogress=$dapat; }
?>
		  <tr style="border-bottom: 1px solid #f4511e;">
		  <td style="width:200px; text-align:left;">
		  <font style="color:yellow;">
		  Capital Value: $<?=$amount19?>
		  </font>
		  <br>
		  <br>
<font style="color:#0cbfe9; font-size:11px;">Transaction#<?=$info19['sn']?></font><br>
<?php
echo '<font style="color:#0cbfe9; font-size:11px;">'.$start.' to '.$end.'<br> in every '.$masabon.'</font><br>';
$date2 = date('Y-m-d');

if ($date2 > $end)  { $date2=$end; }

$pip19=number_format((float)$pip19, 2, '.', '');
echo '<table style="width:100%;"><tr style="border-bottom: 1px solid #f4511e;"><td></td><td><font style="color:#0cbfe9; font-size:11px;">#float</font></td></tr>';
//$date2 = date('Y-m-d');
while (strtotime($date1) < strtotime($date2)) {
	
//echo $date1;
$date1 = date ("Y-m-d", strtotime("+1 day", strtotime($date1)));
$date3 = strtotime($date1);
$date4 = date('d/m/Y', $date3);
echo '<tr style="border-bottom: 1px solid #f4511e;">';
echo "<td>".$date4."</td>";
echo "<td>$".$pip19."</td>";
echo "</tr>";

}
if($status19=="DONE"){ 
$lastdate=strtotime($end) + 86400;
$lastdate = date('d/m/Y', $lastdate);
echo '<tr style="border-bottom: 1px solid #f4511e;">';
echo "<td>".$lastdate." <font style='color:#ff0000;'>[Capital Back]</td>";
echo "<td>$".$amount19."</td>";
echo "</tr>";
} 
echo '</table>';
?>
		  </td>
		  </tr>
		  <?php } ?>
          </table>