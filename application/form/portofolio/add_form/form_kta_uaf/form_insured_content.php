<fieldset class="corner" style="margin:5px 5px 10px 6px; padding:0px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Premi Type"),"fa-edit");?>
	<form name="frmPremiType">
		<div class="ui-widget-form-table-compact" style="margin:0px 0px 0px 45px;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption required">* Premi Type</div>
				<div class="ui-widget-form-cell" id="trx-select-plan-type"><?php echo form()->combo('InsuredPremiType','select long selectpremi zx-select',PremiType(),
					( $outputs->get_value('PremiTypeId') ? $outputs->get_value('PremiTypeId') : 1), array('change' => 'new SetVisiblePremiGroup(this);SetPremiPersonal(this);') ); ?></div>
			</div>
		</div>
	</form>
</fieldset>

<div class="ui-widget-form-table-compact" style="width:99%;">
	<div class="ui-widget-form-row">	
		<div class="ui-widget-form-cell" style="width:50%;">
			<form name="frmMainInsured"> 
				<?php $this->load->form("add_form/{$form}/form_insured_main");?>
			</form>
		</div>
		
		<div class="ui-widget-form-cell" style="width:50%;">
		<form name="frmSpouseInsured">
			<?php $this->load->form("add_form/{$form}/form_insured_spouse");?>
		</form>
		</div>	
	</div>
</div>