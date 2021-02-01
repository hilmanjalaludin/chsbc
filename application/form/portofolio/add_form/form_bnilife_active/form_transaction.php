<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @ def    : include transaction page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
 ?>
 <form name="frmTransactionPlan">
	<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Plan"),"fa-edit");?>
		<?php $this -> load -> form("add_form/{$form}/form_transaction_plan");?>
	</fieldset>
</form>	

 <form name="frmTransactionCard">
	<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Payment"),"fa-edit");?>
		<?php $this -> load -> form("add_form/{$form}/form_transaction_payment");?>
	</fieldset>
</form>