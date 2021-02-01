<!-- start : layout add campaign -->
<?php get_view(array("set_product_benefit","view_benefit_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Product Benefit");?> </a>
		</li>
	</ul>	
	
    <!-- start : div datta content --->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Add")),"fa-plus");?>
		
		<form name="frmAddBenefit">
			<table cellpadding="6px;">
				<tr>
					<td class="text_caption">* <?php echo lang("Product Name");?></td>
					<td><?php echo form()->combo('ProductId','select superlong',Product(),null,array('change'=>"Ext.DOM.SetProductPlan(this);"));?></td>
				</tr>
				
				<tr>
					<td class="text_caption">* <?php echo lang("Benefit Description");?></td>
					<td><?php echo form()->textarea('ProductPlanBenefitDesc','textarea superlong');?></td>
				</tr>
				
				<tr>
					<td class="text_caption">* <?php echo lang("Plan Name");?></td>
					<td id="div_product_plan"><?php echo form()->combo('ProductPlan','select superlong',(is_array($ProductPlan)?$ProductPlan:array()));?></td>
				</tr>
				
				<tr>
					<td class="text_caption">* <?php echo lang("Benefit");?></td>
					<td><?php echo form()->textarea('ProductPlanBenefit','textarea superlong');?></td>
				</tr>
				
				<tr>
					<td class="text_caption">* <?php echo lang("Status");?></td>
					<td><?php echo form()->combo('ProductPlanBenefitStatusFlag','select superlong',$active);?></td>
				</tr>
				
				<tr>
					<td class="text_caption">&nbsp;</td>
					<td> <input type="button" class="save button" onclick="Ext.DOM.saveBenefit();" value="Save"></td>
				</tr>
			</table>
		</form>
	</div>
	<!-- stop : div datta content --->
	
</div>