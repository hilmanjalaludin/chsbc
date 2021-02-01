<?php
	$_order = array();
	for($i=1; $i<=count($fields); $i++)
	$_order[$i] = $i;
?>
<fieldset class="corner ui-widget-fieldset" style="margin:-5px 2px 2px -5px; padding:8px 15px 8px 15px;">
<?php echo form()->legend(lang("Layout Upload / Update"),"fa-pencil");?>
		<form name="layout_template">
		<table cellspacing="1" width='99%'>
		<tr height="28">
			<th class="ui-state-default ui-corner-top ui-state-focus first center" >&nbsp;<?php echo form() -> checkbox('CheckAll',null,null,array("click"=>"Ext.Cmp('columns').setChecked();")); ?></th>
			<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;<b> Name </b></th>
			<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;&nbsp;<span style="text-decoration:none;cursor:pointer;" onclick="Ext.Cmp('columns_keys').setChecked();"><b>(*) key</b></span>&nbsp;&nbsp;</th>
			<th class="ui-state-default ui-corner-top ui-state-focus first center">Order</th>
			
		</tr>	
		<?php 
			$n = 1;
			foreach( $fields as $k => $v ) { ?>
			<tr class="onselect">
				<td class="content-first center" valign="middle"  width='10%'>&nbsp;<?php echo form() -> checkbox('columns',null,$v); ?></td>
				<td class="content-middle center" valign="middle" width='70%'><?php echo form() -> input($v,'input_text long',$v,null,array('style'=>'width:100%;')); ?></td>
				<td class="content-middle center" valign="middle" width='10%'>&nbsp;<?php echo form() -> checkbox('columns_keys',null,$v); ?></td>
				<td class="content-lasted center" valign="middle" width='10%'><?php echo form() -> combo('order_by','select box tpl-$v',$_order,$n); ?></td>
			</tr>
		<?php $n++; } ?>
		</table>
	 </form>
	</fieldset>
