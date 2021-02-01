<fieldset class='corner'>
<legend class='icon-menulist'>&nbsp;&nbsp;Group ( <?php __($label); ?> )</legend>
<div style="height:350px;overflow:auto;margin-top:-10px;margin-bottom:-10px;">
<table width='99%' align='center' border=0 cellspacing=1 cellpadding=0 style="margin-left:2px;">
	<tr height='22px'>
		<td class="font-standars ui-corner-top ui-state-default first center" width='5%'><a href="javascript:void(0);" onclick="Ext.Cmp('GroupTeamId').setChecked();">#</a></td>
		<td class="font-standars ui-corner-top ui-state-default first center" width='5%'>No</td>
		<td class="font-standars ui-corner-top ui-state-default first center" width='40%'>User Name</td>
	</tr>
<?php if(is_array($content) ) foreach( $content as $num => $rows  )  : ?>	
<?php $color = ($num%2!=0?'#FFFEEE':'#FFFFFF');  ?>
	<tr bgcolor="<?php __($color);?>" class='onselect' >
		<td class="content-first" width='5%'><?php __(form()->checkbox('GroupTeamId', null, $rows['GroupTeamId']) ); ?></td>
		<td class="content-middle"><?php __($num); ?></td>
		<td class="content-lasted"><?php __($rows['full_name']); ?></td>
	</tr>
<?php endforeach; ?>	

</table>
</div>
</fieldset>
