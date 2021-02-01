<?php get_view(array("set_result_category","view_result_category_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Call Status");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner" style="background-color:white;margin:3px;">
		<?php echo form()->legend(lang("Add"), "fa-plus"); ?>	
		<form name="frmAddCategory">
			<table cellpadding="6px;">
			<tr>
				<td class="text_caption">* Call Type </td>
				<td class="text_caption">:</td>
				<td><?php echo form() -> combo('CallOutboundGoalsId','select superlong',$CallType,2,null,array('disabled'=>true));?></td>
			</tr>
			<tr>
				<td class="text_caption">* Call Status Code</td>
				<td class="text_caption">:</td>
				<td><?php echo form() -> input('CallReasonCategoryCode','input_text superlong');?></td>
			</tr>
			<tr>
				<td class="text_caption">* Call Status Name</td>
				<td class="text_caption">:</td>
				<td><?php echo form() -> input('CallReasonCategoryName','input_text superlong');?></td>
			</tr>
			<tr>
				<td class="text_caption">* Active Flag</td>
				<td class="text_caption">:</td>
				<td><?php echo form() -> combo('CallReasonCategoryFlags','select superlong', array(0=>'Not Active',1=>'Active'));?></td>
			</tr>
			<tr>
				<td class="text_caption">* Order </td>
				<td class="text_caption">:</td>
				<td><?php echo form() -> combo('CallReasonCategoryOrder','select superlong', $OrderId);?></td>
			</tr>
			<tr>
				<td class="text_caption">&nbsp;</td>
				<td class="text_caption"></td>
				<td>
					<input type="button" class="save button" onclick="Ext.DOM.SaveCatgory();" value="Save"></td>
			</tr>
		</table>
		</form>
		</fieldset>
	</div>
</div>
