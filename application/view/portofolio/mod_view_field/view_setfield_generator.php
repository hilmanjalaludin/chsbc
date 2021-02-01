<?php 
/** get order rows ****/
$Order = array();
if( $view_field_size ) for( $ux = 1; $ux<=$view_field_size; $ux++  ) {
	$Order[$ux] = $ux;
}


?>

<fieldset class="corner ui-widget-fieldset" style="width:95%;margin:-10px 2px 2px 10px; padding:9px 15px 8px 15px;">
<?php echo form()->legend(lang("Field"),"fa-table");?>
<form name="frmFieldSetup">

<table width="100%" cellspacing=1>
	<thead>
		<tr height="22">
			<th class="ui-corner-top ui-state-default th-first" width="5%">
				<a href="javascript:void(0);" onclick="Ext.Cmp('field_checkbox').setChecked();">
					<i class="fa fa-check-square"></i></a>
			</th>
			<th class="ui-corner-top ui-state-default th-middle" width="10%"><?php echo lang("Field");?></th>
			<th class="ui-corner-top ui-state-default th-middle" width="60%"><?php echo lang("Label");?></th>
			<th class="ui-corner-top ui-state-default th-middle" width="60%"><?php echo lang("Function");?></th>
			<th class="ui-corner-top ui-state-default th-lasted" width="10%"><?php echo lang("Order");?></th>
		</tr>	
	</thead>	
	
	<tbody>
		<?php if( $view_field_size ) for( $c = 1; $c<=$view_field_size; $c++ ) : ?>
		<tr height="32">
			<td class="content-first"><?php echo form()->checkbox("field_checkbox",null, $c);?></td>
			<td class="content-middle"><?php echo form()->combo("field_name_{$c}",'select tolong', $view_select_field, $view_select_number[$c], null);?></td>
			<td class="content-middle"><?php echo form()->input("field_label_{$c}",'input_text', null, null, array('style' => 'width:99%;'));?></td>
			<td class="content-middle"><?php echo form()->combo("field_funct_{$c}",'select long', $view_select_function);?></td>
			<td class="content-lasted" align="center"><?php echo form()->combo("field_order_{$c}",'select auto',$Order, $c, null);?></td>
		</tr>	
		<?php endfor; ?>	
	</tbody>		
</table>
</form>
</fieldset>
	