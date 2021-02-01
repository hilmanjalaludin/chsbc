<script>
// $(document).ready(function() {
    // var t = $('#example').DataTable( {
        // "columnDefs": [ {
            // "searchable": false,
            // "orderable": false,
            // "targets": 0
        // } ],
        // "order": [[ 1, 'asc' ]]
    // } );
 
    // t.on( 'order.dt search.dt', function () {
        // t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            // cell.innerHTML = i+1;
        // } );
    // } ).draw();
// });
</script>
<?="<span style='font-size:16pt;margin-bottom:0px;margin-left:2px;'>Daily Dashboard</span>"?><br/>
<?="<span style='font-size:12pt;margin-bottom:10px;margin-left:2px;'>Tanggal : ".date('d-m-Y')."</span>"?><br/>
<?php
	$_user = explode(',',$loops);
	// print_r($datas);
	/* Array (
			[37] => Array (
				[userid] => 37 
				[seller] => A22-DIMAS PERDIANSYAH 
				[TOTCALL] => 3418 
				[TOTCUST] => 988 
				[3005] => 1127 
				[3003] => 2290 
				[INC] => 3 
				[DUR] => 
				[AVGDUR] => 00:00:32 
				[ANS] => 67.00 
			)
		)*/
?>
<!-- tambahan irul -->
<script>
var arr1; // = [['Task', 'Hours per Day']];

function drawChart() {

	
	//console.log('arr1', arr1);
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],
		['Data Size',     50],
		['Utilize',     11],
		['Incoming',      10]
	]);
	//console.log('data', data)

	var options = {
		title: 'My Daily Activities',
		is3D: true,
	};

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);

	/*
	arr1 = [ ['Task', 'Hours per Day'],
		['Data Size',     50],
		['Utilize',     11],
		['Incoming',      10]
	];
	*/
	
	//arr1.push(['data size', 30]);
	console.log('---------------arr1------------');
	console.log(arr1);

	var data2 = google.visualization.arrayToDataTable(arr1);
	//console.log('data2', data2);
	var options2 = {
		title: 'My Daily Call History',
		is3D: true,
	};

	var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

	chart2.draw(data2, options2);
}

google.charts.load('current', {'packages':['corechart']});



</script>
<!-- tutup tambahan irul -->
<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">USER NAME</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Customer</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Call</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Not Answer</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Answer</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Duration</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Avg. Duration</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">% Ans.</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">INC</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($datas as $row) {
		?>
		<tr bgcolor="<?=$back_color?>" class="onselect" height="35">
			<td class="content-first " align="left"  ><?php echo $row['seller']; ?>&nbsp;</td>
			<td class="content-middle" align="center"><?php echo $row['TOTCUST']; ?></td>
			<td class="content-middle" align="center"><?php echo $row['TOTCALL']; ?></td>
			
			<td class="content-middle" align="center"><?php echo $row['3003']; ?></td>
			<td class="content-middle" align="center"><?php echo $row['3005']; ?></td>
			
			
			<td class="content-middle" align="center"><?php echo $row['DUR']; ?></td>
			<td class="content-middle" align="center"><?php echo $row['AVGDUR']; ?></td>
			<td class="content-middle" align="center"><?php echo round(($row['3003']/$row['TOTCALL'])*100,2); ?></td>
			<td class="content-middle" align="center"><?php echo $row['INC']; ?></td>
			<td class="content-lasted" align="center"><?php echo number_format($row['FX']+$row['CIP']+$row['TU']+$row['XS']+$row['Flek_s'], 0, ',','.'); ?></td>
		</tr>
		<?php 
	$_totcust 	+= $row['TOTCUST'];
	$_totcall 	+= $row['TOTCALL'];
	$_3003 		+= $row['3003'];
	$_3005		+= $row['3005'];
	$_dur		+= strtotime($row['DUR']);
	$_avgdur	+= $row['AVGDUR'];
	$_ans		+= ($row['3003']/$row['TOTCALL'])*100;
	$_inc		+= $row['INC'];
	$_amount	+= $row['FX']+$row['CIP']+$row['TU']+$row['XS']+$row['Flek_s'];
	} ?>
<?php
		// $_sol += (isset($touch[$id])?$touch[$id]:0);
		// $_pif += (isset($datas[$id]['PIF'])?$datas[$id]['PIF']:0);
		// $_nos += (isset($datas[$id]['NOS'])?$datas[$id]['NOS']:0);
		// $_anp += (isset($datas[$id]['ANP'])?$datas[$id]['ANP']:0);
		
		// $_pif_run += (isset($datas[$id]['PIF'])?($datas[$id]['PIF']*$batas)/$jam:0);
		// $_nos_run += (isset($datas[$id]['NOS'])?($datas[$id]['NOS']*$batas)/$jam:0);
		// $_anp_run += (isset($datas[$id]['ANP'])?($datas[$id]['ANP']*$batas)/$jam:0);
	// }
	
	$back_color = ( $idx+1%2!=0 ? '#FFFFFF' :'#FFFEEE');
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="ui-corner-bottom ui-state-default right th-middle" align="right" width="15%">TOTAL :</th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php echo $_totcust ?></b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php echo $_totcall ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php echo $_3003 ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php echo $_3005 ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;- <?php //echo date('H:i:s', floor(($_dur/60)/60)) ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;- <?php //echo $_avgdur ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php echo round($_ans,2) ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php echo $_inc ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php echo number_format($_amount,0,',','.') ?>&nbsp;</b></th>
		</tr>
	</tfoot>
</table>