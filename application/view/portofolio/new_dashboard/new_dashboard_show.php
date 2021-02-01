<script>
$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>
<?="<span style='font-size:16pt;margin-bottom:0px;margin-left:2px;'>Dashboard Type : <b>".strtoupper(str_replace('-',' ',$param['dsb_type']))."</b></span>"?><br/>
<?="<span style='font-size:12pt;margin-bottom:10px;margin-left:2px;'>Interval : ".($param['dsb_start']?$param['dsb_start']:date('d-m-Y'))." s/d ".($param['dsb_end']?$param['dsb_end']:date('d-m-Y'))."</span>"?><br/>
<?php
	$_user = explode(',',$loops);
?>
<table id="example" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="ui-corner-top ui-state-default center th-first"  width="5%" rowspan="2">#</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="15%" rowspan="2">USER NAME</th>
			<th class="ui-corner-top ui-state-default center th-middle" colspan="3">Actual</th>
			<th class="ui-corner-top ui-state-default center th-middle" colspan="3">Run Rate</th>
			<th class="ui-corner-top ui-state-default center th-lasted" width="10%" rowspan="2">AVG PREMI</th>
		</tr>
		<tr>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">PIF</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">NOS</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">ANP</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">PIF</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">NOS</th>
			<th class="ui-corner-top ui-state-default center th-middle" width="10%">ANP</th>
		</tr>
	</thead>
	<tbody>
		<?php
	$_sol = 0;
	$_pif = 0;
	$_nos = 0;
	$_anp = 0;
	
	$_pif_run = 0;
	$_nos_run = 0;
	$_anp_run = 0;
	
	foreach($_user as $idx => $id)
	{
		$back_color = ( $idx%2!=0 ? '#FFFFFF' :'#FFFEEE');
		$min = (int)date('i');
		
		$jam 	= ($min>30?$times+1:$times);
		$batas 	= ($param['dsb_mode']=='interval'?0:((int)date('N',strtotime(date('Y-m-d')))!=6?8:5));
?>
	<tr bgcolor="<?=$back_color?>" class="onselect" height="35">
		<td class="content-first left" align="left"></td>
		<td class="content-first middle" align="left">&nbsp;<?=$users[$id]?>&nbsp;</td>
		<td class="content-middle" align="center"><?=(isset($datas[$id]['PIF'])?$datas[$id]['PIF']:0)?></td>
		<td class="content-middle" align="center"><?=(isset($datas[$id]['NOS'])?$datas[$id]['NOS']:0)?></td>
		<td class="content-middle" align="right"><?=(isset($datas[$id]['ANP'])?number_format($datas[$id]['ANP']):0)?></td>
		<td class="content-middle" align="center"><?=(isset($datas[$id]['PIF'])?round(($datas[$id]['PIF']*$batas)/$jam,2):0)?></td>
		<td class="content-middle" align="center"><?=(isset($datas[$id]['NOS'])?round(($datas[$id]['NOS']*$batas)/$jam,2):0)?></td>
		<td class="content-middle" align="right"><?=(isset($datas[$id]['ANP'])?number_format(($datas[$id]['ANP']*$batas)/$jam):0)?></td>
		<td class="content-lasted" align="right"><?=(isset($datas[$id]['ANP'])&&isset($datas[$id]['PIF'])?number_format($datas[$id]['ANP']/$datas[$id]['PIF']/12):0)?></td>
	</tr>
<?php
		$_sol += (isset($touch[$id])?$touch[$id]:0);
		$_pif += (isset($datas[$id]['PIF'])?$datas[$id]['PIF']:0);
		$_nos += (isset($datas[$id]['NOS'])?$datas[$id]['NOS']:0);
		$_anp += (isset($datas[$id]['ANP'])?$datas[$id]['ANP']:0);
		
		$_pif_run += (isset($datas[$id]['PIF'])?($datas[$id]['PIF']*$batas)/$jam:0);
		$_nos_run += (isset($datas[$id]['NOS'])?($datas[$id]['NOS']*$batas)/$jam:0);
		$_anp_run += (isset($datas[$id]['ANP'])?($datas[$id]['ANP']*$batas)/$jam:0);
	}
	
	$back_color = ( $idx+1%2!=0 ? '#FFFFFF' :'#FFFEEE');
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="ui-corner-bottom ui-state-default center th-first"  width="5%">#</th>
			<th class="ui-corner-bottom ui-state-default right th-middle" align="right" width="15%">TOTAL :</th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=$_pif?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=$_nos?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=number_format($_anp)?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=round($_pif_run,2)?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=round($_nos_run,2)?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-middle" width="10%"><b>&nbsp;<?=number_format($_anp_run)?>&nbsp;</b></th>
			<th class="ui-corner-bottom ui-state-default center th-lasted" width="10%"><b>&nbsp;<?=number_format($_anp/$_pif/12)?>&nbsp;</b></th>
		</tr>
	</tfoot>
</table>