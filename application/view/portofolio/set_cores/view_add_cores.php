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

<form name="frmAddCores">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Campaign Cores </legend>
<table cellpadding="4px;">
<tr>
	<td class="text_caption">* Campaign Core Code</td>
	<td><?php echo form() -> input('text_cmp_id','input_text long', NULL, array("keyup"=> "Ext.Cmp('text_cmp_name').setValue(this.value);"),array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;','length'=>30) ); ?> (30)</td>
</tr>
<tr>
	<td class="text_caption">* Campaign Core Name</td>
	<td><?php echo form() -> input('text_cmp_name','input_text long', NULL, NULL ,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;','length'=>30) ); ?> (30)</td>
</tr>
<tr>
	<td class="text_caption">* Status </td>
	<td><?php echo form() -> combo('select_cmp_status', 'select', array('1'=>'Active','0' => 'Not Active'),null,null,array('style'=>'height:21px;width:100px;color:#000000;border:1px solid red;')); ?></td>
</tr>			
<tr>
	<td>&nbsp;</td>
	<td> 
			<input type="button" class="save button" onclick="SaveNewGroupMenu();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>	
</table>
</fieldset>
</div>
</form>

<?php

 // END OF FILE 
?>