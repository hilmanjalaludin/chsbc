<div id="result_content_add" style="margin:8px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add DID Number </legend>	
 <form name="frmAddReasonType">
	<table cellpadding="6px;">
<?php	

	foreach( $FieldName as $key => $label ) 
	{
		if(!in_array($label, $HTML['primary'])) 
		{
		
			// input 
			
			if( in_array($label, array_keys($HTML['input'])) )
			{
				echo "<tr>
						<td class=\"text_caption\">* " . ucfirst($HTML['input'][$label]) . " </td>
						<td>" . form() -> input($label,'input_text long') . " </td>
					</tr> ";
			}	
			
			// input 
			
			if( in_array($label, array_keys($HTML['combo'])) )
			{
				echo "<tr>
						<td class=\"text_caption\">* " . ucfirst($label) . " </td>
						<td>" . form() -> combo($label,'select long', $MetaJoin) . " </td>
					</tr> ";
			}	
		}	
	} 
?>	
<tr>
	<td class="text_caption">&nbsp;</td>
	<td>
		<input type="button" class="save button" onclick="Ext.DOM.Save();" value="Save">
		<input type="button" class="close button" onclick="Ext.Cmp('top-panel').setText('');" value="Close">
	</td>
	</tr>
</table>
</form>
</fieldset>
</div>