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
<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">USER NAME</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Customer</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Call</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">Total Answer</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Not Answer</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Duration</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Total Avg. Duration</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">% Ans.</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">INC</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%">Amount</th>
		</tr>
	</thead>
	<tbody>
		<tr bgcolor="<?=$back_color?>" class="onselect" height="35">
			<td class="content-first " align="left"  ><?php echo $datas['seller']; ?>&nbsp;</td>
			<td class="content-middle" align="center"><?php echo $datas['TOTCUST']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['TOTCALL']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['3003']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['3005']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['DUR']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['AVGDUR']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['ANS']; ?></td>
			<td class="content-middle" align="center"><?php echo $datas['INC']; ?></td>
			<td class="content-lasted" align="center"><?php echo $datas['Amount']; ?></td>
		</tr>
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
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?></b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?php ?>&nbsp;</b></th>
		</tr>
	</tfoot>
</table>