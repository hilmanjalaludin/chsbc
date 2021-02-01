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