<form name="frmDsbFilter">
<div class="ui-widget-form-table-compact" style="margin-top:-10px;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">* Mode</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;"><?php echo form()->combo('dsb_mode','select long', array('daily'=>'Daily','interval'=>'Interval Summary'),'daily');?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">Interval</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;">
			<?php echo form()->input('dsb_start','input_text box date', null, null, array('disabled' => true));?>&nbsp;-&nbsp;<?php echo form()->input('dsb_end','input_text box date', null, null, array('disabled' => true));?>
		</div>
	</div>
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">* Type</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;"><?php echo form()->combo('dsb_type','select long', $type);?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">MGR</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;" id="span_mgr"><?php echo form() -> combo('dsb_mgr','select long',array(),null,null,array('disabled'=>true));?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">ATM</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;" id="span_atm"><?php echo form() -> combo('dsb_atm','select long', array(),null,null,array('disabled'=>true));?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">SPV</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;" id="span_spv"><?php echo form() -> combo('dsb_spv','select long', array(),null,null,array('disabled'=>true));?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		
		<div class="ui-widget-form-cell text_caption" style="vertical-align:top;">TSO</div>
		<div class="ui-widget-form-cell text_caption center" style="vertical-align:top;">:</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;" id="span_tso"><?php echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));?></div>
		
		<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
		<div class="ui-widget-form-cell left" style="vertical-align:top;">
			<?php echo form()->button('dsb_button_data','button search',"Show", array("click" => "new ShowDashboard();"),array('style'=>'margin:0px;'));?>
		</div>
	</div>
</div>
<div style="float:right;margin-right:5px;"><span style='font-size:9px;color:red;'>* Required Input!</span></div>
</form>