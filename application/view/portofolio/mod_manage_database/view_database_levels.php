<div>
<table cellspacing=1>
	<tr>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;User Level&nbsp;</th>
		<th class="ui-state-default ui-corner-top ui-state-focus first center">&nbsp;Hide&nbsp;</th>
	</tr>
	<?php foreach($privileges as $k => $Username ) :
		$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
	?>
		<tr bgcolor="<?php echo $color;?>">
			<td class="content-first left"><?php __($Username);?></td>
			<td class="content-lasted center">
			<?php 
				echo form()->checkbox('chk_fields',null, $k,array('click'=>'Ext.DOM.SetHideOnLevel(this);'),
					( @in_array( ( isset($param['database']) ? $param['database']:null), ( isset($hideprivileges[$k]) ?$hideprivileges[$k]:null) ) ? array('checked'=>true) : '') );?>
			
			
			</td>
		</tr>
	<?php endforeach; ?>
</table>	