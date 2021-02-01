<div>
<table cellspacing=1>
<?php foreach($schema as $fieldname => $fieldvalue ) :?>	
	<tr>
		<th class="ui-state-default ui-corner-top ui-state-focus first left">&nbsp;<?php echo $fieldname; ?>&nbsp;</th>
		<td class="ui-state-default ui-corner-top ui-state-focus first left">&nbsp;<?php echo $fieldvalue; ?>&nbsp;</td>
	</tr>
<?php endforeach;?>	
</table>
</div>