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

<form name="frmEditCores">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Campaign Cores </legend>
<table cellpadding="9px;" border=0 width="50%">

<tr>
	<td class="text_caption">* Campaign Core Code</td>
	<td> 
	<?php echo form() -> hidden('ECampaignGroupId','input_text long', $cores['CampaignGroupId'] ); ?>
	<?php echo form() -> input('ECampaignGroupCode','input_text long', $cores['CampaignGroupCode'], null, array('style'=>'border:1px solid red;','length'=> 30) ); ?> (30) </td>
</tr>
<tr>
	<td class="text_caption" width="15%" nowrap>* Campaign Core Name</td>
	<td> <?php echo form() -> input('ECampaignGroupName','input_text long', $cores['CampaignGroupName'], null, array('style'=>'border:1px solid red;','length'=> 50) ); ?> (50) </td>
</tr>
<tr>
	<td class="text_caption">* Status </td>
	<td> <?php echo form() -> combo('ECampaignGroupStatusFlag','select', array('1'=>'Active','0' => 'Not Active'), $cores['CampaignGroupStatusFlag'], null, array('style'=>'border:1px solid red;','length'=> 50) ); ?> </td>
</tr>		
<tr>
	<td>&nbsp;</td>
	<td> 
			<input type="button" class="update button" onclick="UpdateCores();" value="&nbsp;&nbsp;Update">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>			
</table>
</fieldset>
</div>
</form>
