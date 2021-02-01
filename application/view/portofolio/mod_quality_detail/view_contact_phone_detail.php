<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('QA Activity')), "fa-headphones"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
	<form name="frmActivityCall">
	<?php echo form()->hidden('InputForm',NULL,0);?>
	<?php echo form()->hidden('VerifForm',NULL,0);?>
	<?php echo form()->hidden('CallResult',NULL,$Detail->get_value('CallReasonId'));?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Approve Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('ApproveStatus','select tolong select-chosen',_getApproveStatusQA(), $Detail->get_value('CallReasonQue'),null); ?> </div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks", "textarea tolong uppercase", null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("ButtonUserSave", "button save", lang('Save'), array('click' => 'Ext.DOM.saveActivity();'));?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	