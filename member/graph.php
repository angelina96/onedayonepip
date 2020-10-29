<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php
 include "functions.php";
 date_default_timezone_set("Asia/Kuala_lumpur");
	$date = new DateTime();
	$current_date=$date->format('Y-m-d');
    $crt_dt = date_format($date,"D d-F-Y");
	$month = date_format($date,"F Y");
    $bulan = date_format($date,"m");
	$tahun = date_format($date,"Y");
		
		//date1
		if(isset($_GET['dt'])) {
		$dateSelection = $_GET['dt'];
		}
		else { 
		$dateSelection=date("Y-m-d"); 
		$dateSelectionx = strtotime($dateSelection)-604800;
		$dateSelection  = date("Y-m-d",$dateSelectionx);
		}
		//date2
		if(isset($_GET['dt1'])) {
		$dateSelection1 = $_GET['dt1'];
		}
		else { $dateSelection1=date("Y-m-d"); }
		
/* TO INCLUDE THE LAST DAY SELECTED */
$dateSelection2 = strtotime($dateSelection1)+86400;
$dateSelection2  = date("Y-m-d",$dateSelection2);

/*
$begin = new DateTime($dateSelection);
$end = new DateTime($dateSelection1);

// $begin = new DateTime('2010-05-01');
// $end = new DateTime('2010-05-10');

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {
    //echo $dt->format("l Y-m-d H:i:s\n");
	echo "<br>".$dt->format("m");
}
*/

?>


<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	title:{
		text: "Sale Analysis"
	},
	axisY:[{
		title: "Withdrawal",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
		suffix: "USD"
	},
	{
		title: "Deposit",
		lineColor: "#369EAD",
		tickColor: "#369EAD",
		labelFontColor: "#369EAD",
		titleFontColor: "#369EAD",
		suffix: "k"
	}],
	axisY2: {
		title: "Revenue",
		lineColor: "#7F6084",
		tickColor: "#7F6084",
		labelFontColor: "#7F6084",
		titleFontColor: "#7F6084",
		prefix: "$",
		suffix: "k"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "line",
		name: "Sale",
		color: "#369EAD",
		showInLegend: true,
		axisYIndex: 0,
		dataPoints: [
<?php
$begin = new DateTime($dateSelection);
$end = new DateTime($dateSelection2);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {
	$y=$dt->format("Y");
	$m=$dt->format("m"); $m=$m-1;
	$d=$dt->format("d");
	$datx=$dt->format("Y-m-d");
	$valx = getRep1($datx);
	$valx=number_format((float)$valx, 2, '.', '');
	if ($valx==null){ $valx=0; }
?>
			{ x: new Date(<?=$y?>, <?=$m?>, <?=$d?>), y: <?=$valx?> },
		<?php } ?>
		]
	},
	{
		type: "line",
		name: "Withdraw",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		dataPoints: [
<?php
$begin = new DateTime($dateSelection);
$end = new DateTime($dateSelection2);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {
	$y=$dt->format("Y");
	$m=$dt->format("m"); $m=$m-1;
	$d=$dt->format("d");
	$datx=$dt->format("Y-m-d");
	$valx = getRep2($datx);
	$valx=number_format((float)$valx, 2, '.', '');
	if ($valx==null){ $valx=0; }
?>
			{ x: new Date(<?=$y?>, <?=$m?>, <?=$d?>), y: <?=$valx?> },
		<?php } ?>
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}

}
</script>
</head>

<body>
				<table>
				<tr>
					<td><input type="date" id="dateSelection" name="dateSelection" value="<?echo $dateSelection;?>"></td>
					<td><h5>&nbsp to &nbsp </h5></td>
					<td><input type="date" id="dateSelection1" name="dateSelection1" value="<?echo $dateSelection1;?>"></td>
				<td><center> <button onclick="submit_cari()" align="right" class="btn btn-warning">Display</button></center></td>
				</tr>
				</table>
<script>
 function submit_cari(){
		var dateSelection=$('#dateSelection').val();
		var dateSelection1=$('#dateSelection1').val();
		location.href='graph.php?dt='+dateSelection+'&dt1='+dateSelection1;
	}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>