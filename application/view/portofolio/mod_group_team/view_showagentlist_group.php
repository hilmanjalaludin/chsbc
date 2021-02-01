<table width='400px' align='left' border=0 cellspacing=1 cellpadding=0 style="margin-left:-8px;">
	<tr height='22px'>
		<td class="font-standars ui-corner-top ui-state-default first center" width='5%'><a href="javascript:void(0);" onclick="Ext.Cmp('UserId').setChecked();">#</a></td>
		<td class="font-standars ui-corner-top ui-state-default first center" width='5%'>No</td>
		<td class="font-standars ui-corner-top ui-state-default first center" width='40%'>User Name</td>
	</tr>
<?php if(is_array($content) ) foreach( $content as $num => $rows  )  : ?>	
<?php $color = ($num%2!=0?'#FFFEEE':'#FFFFFF');  ?>
	<tr bgcolor="<?php __($color);?>" class='onselect' >
		<td class="content-first" width='5%'><?php __(form()->checkbox('UserId', null, $rows['UserId']) ); ?></td>
		<td class="content-middle"><?php __($num); ?></td>
		<td class="content-lasted"><?php __($rows['full_name']); ?></td>
	</tr>
<?php endforeach; ?>	

</table>
<br>
<div class="page-web-voice"> <?php $this -> load->view("mod_group_team/view_capacity_pages.php");?> </div>
<div>
	<input type="button" name="XSS" id="XSS" value="&nbsp;Add&nbsp;&nbsp;&nbsp" class='add button' onclick="Ext.DOM.AddUserToGroup();">&nbsp;
	<input type="button" name="XSS" id="XSS" value="&nbsp;Close&nbsp;&nbsp;&nbsp" class='close button' onclick="Ext.DOM.ExitUserToGroup();">&nbsp;
 </div>

