<div id="Polling" class="block" style="background-color: #fff;">
	<div class="title text-shadow">
	    	<div class="ariwa_inner_judul">
	        	Performance
		</div>
	</div>
	tes
	<div id="chartContainer" style="height: 300px; width: 70%;"></div>
</div>

<script>
window.onload = function () {

var options = {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Monthly Sales Data"
	},
	axisX: {
		valueFormatString: "YYYY"
	},
	axisY: {
		title: "Rp"
	},
	axisY2: {
		title: "Employee",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "column",
			name: "Employee",
			axisYType: "secondary",
			showInLegend: true,
			xValueFormatString: "YYYY",
			yValueFormatString: "#,##0",
			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 1002 },
				{ x: new Date(2014, 0), y: 904 },
				{ x: new Date(2015, 0), y: 706 },
				{ x: new Date(2016, 0), y: 478 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 387 },
				{ x: new Date(2018, 0), y: 322 },
				{ x: new Date(2019, 0), y: 268 }
			]
		},
		{
			type: "line",
			name: "Printed Directory",
			showInLegend: true,
			yValueFormatString: "#,##0",
//			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 244 },
				{ x: new Date(2014, 0), y: 160 },
				{ x: new Date(2015, 0), y: 124 },
				{ x: new Date(2016, 0), y: 73 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 28 },
				{ x: new Date(2018, 0), y: 0 },
				{ x: new Date(2019, 0), y: 0 }
			]
		},
		{
			type: "line",
			name: "New Digital Business",
			showInLegend: true,
			yValueFormatString: "#,##0",
//			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 246 },
				{ x: new Date(2014, 0), y: 501 },
				{ x: new Date(2015, 0), y: 515 },
				{ x: new Date(2016, 0), y: 745 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 1376 },
				{ x: new Date(2018, 0), y: 1706 },
				{ x: new Date(2019, 0), y: 2205 }
			]
		},
		{
			type: "line",
			name: "Total Revenue",
			showInLegend: true,
			yValueFormatString: "#,##0",
//			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 490 },
				{ x: new Date(2014, 0), y: 661 },
				{ x: new Date(2015, 0), y: 639 },
				{ x: new Date(2016, 0), y: 818 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 1404 },
				{ x: new Date(2018, 0), y: 1706 },
				{ x: new Date(2019, 0), y: 2205 }
			]
		},
		{
			type: "line",
			name: "Recurring",
			showInLegend: true,
			yValueFormatString: "#,##0",
//			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 15 },
				{ x: new Date(2014, 0), y: 25 },
				{ x: new Date(2015, 0), y: 56 },
				{ x: new Date(2016, 0), y: 115 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 215 },
				{ x: new Date(2018, 0), y: 400 },
				{ x: new Date(2019, 0), y: 570 }
			]
		},
		{
			type: "line",
			name: "Rev DOOH",
			showInLegend: true,
			yValueFormatString: "#,##0",
//			indexLabel: "{y}",
	         	indexLabelPlacement: "outside",  
	         	indexLabelOrientation: "horizontal",
			dataPoints: [
				{ x: new Date(2013, 0), y: 0 },
				{ x: new Date(2014, 0), y: 0 },
				{ x: new Date(2015, 0), y: 68 },
				{ x: new Date(2016, 0), y: 87 }, //, indexLabel: "High Renewals" },
				{ x: new Date(2017, 0), y: 60 },
				{ x: new Date(2018, 0), y: 62 },
				{ x: new Date(2019, 0), y: 21 }
			]
		},
		
		
		
//		{
//			type: "area",
//			name: "Profit",
//			markerBorderColor: "white",
//			markerBorderThickness: 2,
//			showInLegend: true,
//			yValueFormatString: "#,##0",
//			dataPoints: [
//				{ x: new Date(2013, 0), y: 1002 },
//				{ x: new Date(2014, 1), y: 904 },
//				{ x: new Date(2015, 2), y: 706 },
//				{ x: new Date(2016, 3), y: 478 }, //, indexLabel: "High Renewals" },
//				{ x: new Date(2017, 4), y: 387 },
//				{ x: new Date(2018, 5), y: 322 },
//				{ x: new Date(2019, 6), y: 268 }
//			]
//		}
		]
};
$("#chartContainer").CanvasJSChart(options);

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B"];
	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

	if (order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

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
<script src="ariwa/np_js/jquery.canvasjs.min.js"></script>