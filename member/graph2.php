<html>
<head>
<?php
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
		else { $dateSelection=date("Y-m-d"); }
		//date2
		if(isset($_GET['dt1'])) {
		$dateSelection1 = $_GET['dt1'];
		}
		else { $dateSelection1=date("Y-m-d"); }
		
	if($dateSelection=='' && $dateSelection1==''){
			$dateSelection='tiada';
			$dateSelection='tiada';
			}
?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	title:{
		text: "Sale Analysis"
	},
	axisY:[{
		title: "Order",
		lineColor: "#C24642",
		tickColor: "#C24642",
		labelFontColor: "#C24642",
		titleFontColor: "#C24642",
		suffix: "X"
	},
	{
		title: "Footfall",
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
		name: "Footfall",
		color: "#369EAD",
		showInLegend: true,
		axisYIndex: 1,
		dataPoints: [
			{ x: new Date(2017, 00, 7), y: 85.4 }, 
			{ x: new Date(2017, 00, 14), y: 92.7 },
			{ x: new Date(2017, 00, 21), y: 64.9 },
			{ x: new Date(2017, 00, 28), y: 58.0 },
			{ x: new Date(2017, 01, 4), y: 63.4 },
			{ x: new Date(2017, 01, 11), y: 69.9 },
			{ x: new Date(2017, 01, 18), y: 88.9 },
			{ x: new Date(2017, 01, 25), y: 66.3 },
			{ x: new Date(2017, 02, 4), y: 82.7 },
			{ x: new Date(2017, 02, 11), y: 60.2 },
			{ x: new Date(2017, 02, 18), y: 87.3 },
			{ x: new Date(2017, 02, 25), y: 98.5 }
		]
	},
	{
		type: "line",
		name: "Order",
		color: "#C24642",
		axisYIndex: 0,
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017, 00, 7), y: 32.3 }, 
			{ x: new Date(2017, 00, 14), y: 33.9 },
			{ x: new Date(2017, 00, 21), y: 26.0 },
			{ x: new Date(2017, 00, 28), y: 15.8 },
			{ x: new Date(2017, 01, 4), y: 18.6 },
			{ x: new Date(2017, 01, 11), y: 34.6 },
			{ x: new Date(2017, 01, 18), y: 37.7 },
			{ x: new Date(2017, 01, 25), y: 24.7 },
			{ x: new Date(2017, 02, 4), y: 35.9 },
			{ x: new Date(2017, 02, 11), y: 12.8 },
			{ x: new Date(2017, 02, 18), y: 38.1 },
			{ x: new Date(2017, 02, 25), y: 42.4 }
		]
	},
	{
		type: "line",
		name: "Revenue",
		color: "#7F6084",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017, 00, 7), y: 42.5 }, 
			{ x: new Date(2017, 00, 14), y: 44.3 },
			{ x: new Date(2017, 00, 21), y: 28.7 },
			{ x: new Date(2017, 00, 28), y: 22.5 },
			{ x: new Date(2017, 01, 4), y: 25.6 },
			{ x: new Date(2017, 01, 11), y: 45.7 },
			{ x: new Date(2017, 01, 18), y: 54.6 },
			{ x: new Date(2017, 01, 25), y: 32.0 },
			{ x: new Date(2017, 02, 4), y: 43.9 },
			{ x: new Date(2017, 02, 11), y: 26.4 },
			{ x: new Date(2017, 02, 18), y: 40.3 },
			{ x: new Date(2017, 02, 25), y: 54.2 }
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