
<?php get_view(array("set_result_category","view_result_category_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Call Status");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	<fieldset class="corner" style="background-color:white;margin:3px;">
	<?php echo form()->legend(lang("Edit"), "fa-edit"); ?>	
	
	<form name="frmEditCategory">
	<?php echo form()->hidden('CallReasonCategoryId',null,$Data['CallReasonCategoryId']); ?>
	<table cellpadding="6px;">
	<tr>
		<td class="text_caption">* Call Type </td>
		<td class="text_caption">:</td>
		<td><?php echo form() -> combo('CallOutboundGoalsId','select superlong',$CallType,$Data['CallOutboundGoalsId'],null,array('disabled'=>true));?></td>
	</tr>
	<tr>
		<td class="text_caption">* Call Status Code</td>
		<td class="text_caption">:</td>
		<td><?php echo form() -> input('CallReasonCategoryCode','input_text superlong',$Data['CallReasonCategoryCode']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Call Status Name</td>
		<td class="text_caption">:</td>
		<td><?php echo form() -> input('CallReasonCategoryName','input_text superlong',$Data['CallReasonCategoryName']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Active Flag</td>
		<td class="text_caption">:</td>
		<td><?php echo form() -> combo('CallReasonCategoryFlags','select superlong', array(0=>'Not Active',1=>'Active'),$Data['CallReasonCategoryFlags']);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Order </td>
		<td class="text_caption">:</td>
		<td><?php echo form() -> combo('CallReasonCategoryOrder','select superlong', $OrderId , $Data['CallReasonCategoryOrder']);?></td>
	</tr>
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td class="text_caption">&nbsp;</td>
		<td><input type="button" class="update button" onclick="Ext.DOM.UpdateCategory();" value="Update"></td>
	</tr>
</table>
</form>
	</div>
	
</div>
	