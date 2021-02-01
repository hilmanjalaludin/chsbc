<div class="ui-welcome-home">
<div class="ui-widget-form-table list_table" style="width:99%;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell ui-widget-default-home"> 
			<span class="fa-stack fa-lg ui-widget-awesome-toolbar">
				<i class="fa fa-circle fa-stack-2x" ></i>
				<i class="fa fa-home fa-stack-1x fa-inverse "></i>
			</span> Instruction 
		</div>
	</div>
	<div class="ui-widget-form-row" style="background-color:#FFFFFF;">
		<div class="ui-widget-form-cell">
		</div>
	</div>
	
<div class="row">
	<div class="container">
	<h3>Daily Dashboard</h3>
		<h3>Tanggal : <?php echo date("Y/m/d")?></h3><br>
		 
		<div class="col-md-12">
			<div id="chartContainer" style="height: 370px; width: 100%;"></div>			
		</div>
		<div class="col-md-1"></div>
		<!-- <div class="col-md-4">
			<div id="chartContainer2" style="height: 370px; width: 500px;"></div>
		</div> -->
	</div>	
</div>
</div>
</div>

<script>
var arr1 = [];

Ext.Ajax({
	url 	: Ext.DOM.INDEX+"/DailyNewDashboard/showDailyCallHistory/",
	method : 'GET',
	ERROR  : function(fn)
	{
		Ext.Util(fn).proc(function(save){
			
			arr1.push(	{'label':'BT','y': save.data.BT},
						{'label':'CB','y': save.data.CB},
						{'label':'D','y': save.data.D},
						{'label':'D (AP)','y': save.data.DAP},
						{'label':'ID','y': save.data.ID},
						{'label':'INC','y': save.data.INC},
						{'label':'MV','y': save.data.MV},
						{'label':'NA','y': save.data.NA},
						{'label':'NEW','y': save.data.NEW},
						{'label':'NP','y': save.data.NP},
						{'label':'PA','y': save.data.PA},
						{'label':'R','y': save.data.R},
						{'label':'ST','y': save.data.ST},
						{'label':'TBO','y': save.data.TBO},
						{'label':'WN','y': save.data.WN}
					)
			
		
		});
	}
}).post();
var arr2 = [];
for (var a=0;a<arr1.length;a++){
	if (arr1[a].y >= 1) {
		arr2.push({'label':arr1[a].label,'y':arr1[a].y})
	}
}
console.log('arr', arr2);
console.log('dataPoints', 'asda')
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "My Daily Activities"
	},
	axisY: {
		// title: "Growth Rate (in)",
	},
	axisX: {
		// title: "Countries"
	},
	data: [{
		type: "column",
		dataPoints: arr2
	}]
});
chart.render();

//02
var chart = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	exportEnabled: false,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		 text: "My Daily Call History"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		dataPoints: [
			{ x: 10, y: 13 , indexLabel: "BT"},
			{ x: 20, y: 13 , indexLabel: "CB"},
			{ x: 30, y: 26 , indexLabel: "D"},
			{ x: 40, y: 13 , indexLabel: "D (AP)"},
			{ x: 50, y: 40 , indexLabel: "ID"}
			// { x: 50, y: 92, indexLabel: "Highest" },
			// { x: 60, y: 68 },
			// { x: 70, y: 38 },
			// { x: 80, y: 71 },
			// { x: 90, y: 54 },
			// { x: 100, y: 60 },
			// { x: 110, y: 36 },
			// { x: 120, y: 49 },
			// { x: 130, y: 21, indexLabel: "Lowest" }
		]
	}]
});
chart.render();


	</script>
</div>
</div>
	