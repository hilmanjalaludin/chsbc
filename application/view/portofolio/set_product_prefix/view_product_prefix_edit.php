<?php

// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
if( !function_exists('_selectPrefixCode') )
{
function & _selectPrefixCode( $row  ) 
 {
	preg_match_all('![0]+!', $row->get_value('PrefixChar'), $matches);
	$PrefixCode = substr($row->get_value('PrefixChar'), 0, (strlen($row->get_value('PrefixChar'))-strlen($matches[0][0])) );
	return (string)$PrefixCode;
 }
 
}
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 $row =& new EUI_object( $data );
 $PrefixCode =& _selectPrefixCode( $row ) ;
 
//$row->debug_label();
	
?>


<?php get_view(array("set_product_prefix","view_product_prefix_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Product Prefix");?> </a>
		</li>
	</ul>
	
	<!-- start : edit -->
	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Edit")),"fa-edit");?>
		<form name="frmEditPrefix">
		<?php echo form()->hidden('PrefixNumberId',null,$row->get_value('PrefixNumberId'));?>
			<table cellpadding="4px;">
				<tr>
					<td class="text_caption">* <?php echo lang("Product");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('result_head_level','select superlong',Product(), $row->get_value('ProductId'),null,array('disabled'=>true));?></td>
				</tr>
				<tr>
					<td class="text_caption">* <?php echo lang("Prefix Code");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('result_code','input_text superlong', $PrefixCode, null );?></td>
				</tr>
				<tr>
					<td class="text_caption">* <?php echo lang("Prefix Length");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('result_name','input_text superlong', $row->get_value('PrefixLength'), null );?></td>
				</tr>
				<tr>
					<td class="text_caption"><?php echo lang("Form Input");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('form_input','select superlong',$AddForm, $row->get_value('AddView'));?></td>
				</tr>
				<tr>
					<td class="text_caption"><?php echo lang("Form Edit");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('form_edit','select superlong',$EditForm, $row->get_value('EditView'));?></td>
				</tr>
								
				<tr>
					<td class="text_caption"><?php echo lang("Status");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('status_active','select superlong',Flags(), $row->get_value('PrefixFlagStatus') );?></td>
				</tr>
				<tr>
					<td class="text_caption">&nbsp;</td>
					<td class="text_caption">&nbsp;</td>
					<td><input type="button" class="update button" onclick="Ext.DOM.UpdatePrefix();" value="Update"></td>
				</tr>
			</table>
		</form>
		</fieldset>
	</div>
	<!-- end -->
	
</div>	
