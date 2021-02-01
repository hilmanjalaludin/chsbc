<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add CC PBX </legend>	
 <form name="frmAddReasonType">
	<table cellpadding="6px;">
<?php	
	foreach( $FieldName as $key => $label ) 
	{
		if(!in_array($label, $HTML['primary'])) 
		{
		
			// input 
			
			if( in_array($label, $HTML['input']) )
			{
				echo "<tr>
						<td class=\"text_caption\">* " . ucfirst($label) . " </td>
						<td>" . form() -> input($label,'input_text long') . " </td>
					</tr> ";
			}	
			
			// input 
			
			if( in_array($label, $HTML['combo']) )
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