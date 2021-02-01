<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
<legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit CC IVR </legend>	
<form name="frmEditReasonType">
<table cellpadding="6px;">
<?php	
  foreach( $FieldName as $key => $label ) 
	{
		if(!in_array($label, $HTML['primary'])) 
		{	
		
			// input 
			if( in_array($label, $HTML['input']) ) {
				echo "<tr>
						<td class=\"text_caption\">* " . ucfirst($label) . " </td>
						<td>" . form() -> input($label,'input_text long', $IVR[$label]) . " </td>
					</tr> ";
			}	
			
			// input 
			
			if( in_array($label, $HTML['combo']) )
			{
				echo "<tr>
						<td class=\"text_caption\">* " . ucfirst($label) . " </td>
						<td>" . form() -> combo($label,'select long', $MetaJoin, $IVR[$label]) . " </td>
					</tr> ";
			}	
		}
		// hidden edit Mode
		else
		{
			echo form() -> hidden($label,null, $IVR[$label]);	
		}	
	} 
	
	echo "<tr>
			<td class=\"text_caption\">&nbsp;</td>
			<td>"
				. form() ->button('button', 'update button', 'Update', array("click" => "Ext.DOM.Update();")) .
				  form() ->button('button', 'close button', 'Close', array("click" => "Ext.Cmp('top-panel').setText('');")) .
			"</td>
		 </tr> ";
?>	
</table>
 </form>
</fieldset>
</div>