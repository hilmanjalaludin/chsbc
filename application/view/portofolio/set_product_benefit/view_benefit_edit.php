
<!-- start : layout add campaign -->
<?php $row =& new EUI_Object($Data); ?>
<?php get_view(array("set_product_benefit","view_benefit_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Product Benefit");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Edit")),"fa-edit");?>
			<form name="frmEditBenefit">
			<?php echo form()->hidden('ProductPlanBenefitId', null, $row->get_value('ProductPlanBenefitId') );?>
			<table cellpadding="6px;">
			<tr>
				<td class="text_caption">* Product ID</td>
				<td><?php echo form()->combo('ProductId','select superlong', Product(), $row->get_value('ProductId'), array('change'=>"getProductPlan(this);"));?></td>
			</tr>
			<tr>
				<td class="text_caption">* Benefit Description </td>
				<td><?php echo form()->textarea('ProductPlanBenefitDesc','textarea superlong', $row->get_value('ProductPlanBenefitDesc') );?></td>
			</tr>
			<tr>
				<td class="text_caption">* Plan</td>
				<td id="div_product_plan"><?php echo form()->combo('ProductPlan','select superlong',(is_array($ProductPlan)?$ProductPlan:array()), $row->get_value('ProductPlan') );?></td>
			</tr>
			<tr>
				<td class="text_caption">* Benefit Product</td>
				<td><?php echo form()->textarea('ProductPlanBenefit','textarea superlong', $row->get_value('ProductPlanBenefit') );?></td>
			</tr>
			<tr>
				<td class="text_caption">*Active</td>
				<td><?php echo form()->combo('ProductPlanBenefitStatusFlag','select superlong',Flags(),$row->get_value('status'));?></td>
			</tr>
			<tr>
				<td class="text_caption">&nbsp;</td>
				<td><input type="button" class="update button" onclick="Ext.DOM.UpdataBenefit();" value="Update"></td>
			</tr>
		</table>
		</div>
		</fieldset>
	</div>
	
</div>
	
<!--	
<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
 <fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit  Benefit Product </legend>	
	<#?php echo form()->hidden('ProductPlanBenefitId',null, $Data['ProductPlanBenefitId'] );?>	
</legend>	
-->

</div>