<?php  $outputs =& new EUI_Object( $SelectPremi );  ?>
<div class="ui-widget-form-table product-box-content" style="width:99%;">	
	
	<div class="ui-widget-form-table product-box-content" >
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* Plan Type</div>
			<div class="ui-widget-form-cell text_caption left">:</div>
			<div class="ui-widget-form-cell" id="trx-select-plan-type"><?php echo form()->combo('InsuredPlanType','select long selectpremi zx-select',$Plan, $outputs->get_value('ProductPlan'), array('change' => 'SetPremiPersonal(this);') ); ?></div>
		</div>
	</div>	
	
	<div class="ui-widget-form-table product-box-content">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* Payment Mode</div>
			<div class="ui-widget-form-cell text_caption left">:</div>
			<div class="ui-widget-form-cell" id="trx-select-payment-type"><?php echo form()->combo('InsuredPayMode','select long selectpremi zx-select',$PayModeByPrd, $outputs->get_value('InsuredPayMode'), array('change' => 'SetPremiPersonal(this);')); ?></div>
		</div>	
	</div>


	<div class="ui-widget-form-table product-box-content">	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">Total Premi</div>
			<div class="ui-widget-form-cell text_caption left">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input('DiscountAfterPremi','input_text long ui-widget-disabled-data', $outputs->get_value('PolicyPremi','_getCurrency')); ?> <span class="wrap"> ( IDR ) </span></div>
		</div>
	</div>
	
	
	<div class="ui-widget-form-row" style="display:none;">	
		<div class="ui-widget-form-cell text_caption required">Total. Premi</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('InsuredPremi','input_text long ui-widget-disabled-data', $outputs->get_value('PolicyTotalPermi','_getCurrency')); ?> <span class="wrap"> ( IDR ) </span></div>
		
		<div class="ui-widget-form-cell text_caption required">Discount Premi</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('DiscountPremi','input_text long ui-widget-disabled-data', $outputs->get_value('PolicyPermiDiscount','_getCurrency')); ?> <span class="wrap"> ( IDR ) </span></div>
	</div>
	
</div>

