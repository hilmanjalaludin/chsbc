<!-- start : layout add campaign -->	
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">


<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Manage Campaign</legend>
 <table cellspacing="6px">
	 <tr>
		 <td class="text_caption" >* InBound No. </td>
		 <td> <?php echo form() -> combo('PhoneNo', 'input_text long', $PhoneNo); ?></td>
	 </tr>
	<tr>
		<td class="text_caption" >* Campaign Inbound. </td>
		<td valign="top"> <?php echo form() -> combo('AvailCampaignId', 'input_text long', $AvailIn); ?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap>&nbsp;</td>
		<td><a href="javascript:void(0);" class="sbutton" onclick="SaveAsg();"><span>&nbsp;Save</span></a></td>
	</tr>
</table>
</fieldset>

</div>


