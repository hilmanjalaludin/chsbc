<div>
<table cellspacing=1>
	<tr>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;Hide&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;FIELD&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;TYPE&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;NULL&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;KEY&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;DEFAULT&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;EXTRA&nbsp;</th>
	</tr>
<?php 
	$no = 0;
	foreach($field as $num => $rows ) 
	{
		$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
		<tr bgcolor="<?php echo $color;?>">
			<td class="content-first center"><?php echo form()->checkbox('chk_fields',null, $rows['Field'],array('click'=>'Ext.DOM.SetHide(this);'),(in_array($rows['Field'],array_keys($hide)) ? array('checked'=>true) : '') );?></td>
			<td class="content-first left"><?php echo $rows['Field'];?></td>
			<td class="content-middle"><?php echo $rows['Type'];?></td>
			<td class="content-middle"><?php echo $rows['Null'];?></td>
			<td class="content-middle"><?php echo $rows['Key'];?></td>
			<td class="content-middle"><?php echo $rows['Default'];?></td>
			<td class="content-lasted"><?php echo $rows['Extra'];?></td>
		</tr>
	<?php 
		$no++;
	} ?>	
</table>
</div>
<div style="margin-left:10px;">
	<?php echo form() -> button('close','close button','Close',array('click'=>"Ext.DOM.BackToDatabase();"));?>
	<?php echo form() -> button('close','save button','Backup',array('click'=>"Ext.DOM.BackupTable();"));?>
</div>