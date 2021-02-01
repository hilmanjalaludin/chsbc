<!-- start : layout add campaign -->	
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">

<form name="frm_add_campaign">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Manage Campaign</legend>
 <table cellspacing="6px">
	<tr>
		<td class="text_caption" >* Campaign Inbound. </td>
		<td valign="top"> <?php echo form() -> combo('InboundCampaignId', 'input_text long', $AvailIn,null, array("change"=>"Ext.DOM.getDataInbound(this);")); ?></td>
	</tr>
	
	<tr>
		<td class="text_caption" >* Total Data. </td>
		<td valign="top"> <?php echo form() -> input('total_data', 'input_text box'); ?></td>
	</tr>
	
	<tr>
		<td class="text_caption" >* Assign Data. </td>
		<td valign="top"> <?php echo form() -> input('assign_data', 'input_text box'); ?></td>
	</tr>
	
	<tr>
		<td class="text_caption" >* Campaign Outbound. </td>
		<td valign="top"> <?php echo form() -> combo('OutboundCampaignId', 'input_text long', $AvailOut); ?></td>
	</tr>
	<tr>
		<td class="text_caption" >* Type. </td>
		<td><?php echo form() -> combo("ActionType",'select long',array(2 =>'Replace',1 => 'Duplicate')); ?></td>
	</tr>
	<!--
	<tr>
		<td class="text_caption" >* Methode. </td>
		<td> <#?php echo form() -> combo('DirectMethod', 'input_text long', $Method); ?></td>
	</tr>-->
	
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td>
			<input type="button" class="assign button" onclick="Ext.DOM.SaveProcess();" value="Process">
			<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">
		</td>
	</tr>
</table>
</fieldset>
</form>
</div>


