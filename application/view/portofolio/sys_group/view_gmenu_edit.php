<?php
/*
 * E.U.I 
 *
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
?>
<form name="frmEditGroupMenu">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Group Menu </legend>
 <?php echo form()->hidden('GroupId',null,$GroupMenu['GroupId']);?>
<table cellspacing="9px;" width="50%" border=0>
	<tr>
		<td class="text_caption" width="12%" nowrap>Group Name.</td>
		<td><?php echo form()->input('GroupName','input_text long',$GroupMenu['GroupName'],NULL);?></td>
	</tr>
	<tr>
		<td class="text_caption">Group Desc.</td>
		<td><?php echo form()->input('GroupDesc','input_text long',$GroupMenu['GroupDesc'],NULL);?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td> 
			<input type="button" class="update button" onclick="UpdateNewGroupMenu();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>
</table>
</fieldset>
</div>
</form>

<?php
	// END OF FILE 
	// LOCATION : ./application/view/group_menu/view_gmenu_add.php
?>