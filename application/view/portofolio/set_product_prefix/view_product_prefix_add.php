<?php get_view(array("set_product_prefix","view_product_prefix_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Product Prefix");?> </a>
		</li>
	</ul>
	
	<!-- start : tpl -->
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Add")),"fa-plus");?>
			<form name="frmProductPrefix">
			<table>
				<tr>
					<td class="text_caption">* <?php echo lang("Product");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('result_head_level','select superlong',Product());?></td>
				</tr>
				<tr>
					<td class="text_caption">* <?php echo lang("Method");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('result_method','select superlong', $Method );?></td>
				</tr>
				<tr>
					<td class="text_caption">* <?php echo lang("Code");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('result_code','input_text superlong', null, null );?></td>
				</tr>
				
				<tr>
					<td class="text_caption">* <?php echo lang("Length");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> input('result_length','input_text superlong', null, null);?></td>
				</tr>
				<tr>
					<td class="text_caption"><?php echo lang("Form Input");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('form_input','select superlong',$AddForm);?></td>
				</tr>
				<tr>
					<td class="text_caption"><?php echo lang("Form Edit");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('form_edit','select superlong',$EditForm);?></td>
				</tr>
				<tr>
					<td class="text_caption"><?php echo lang("Status");?> </td>
					<td class="text_caption">:</td>
					<td><?php echo form() -> combo('status_active','select superlong',Flags(), 0);?></td>
				</tr>
				<tr>
					<td class="text_caption">&nbsp;</td>
					<td class="text_caption">&nbsp;</td>
					<td><input type="button" class="save button" onclick="Ext.DOM.savePrefix();" value="Save"></td>
				</tr>
			</table>
			</form>
		</fieldset>			
	</div>
	
</div>	
