<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 //print_r($Payers);
?>
<form name="frmDataPayersPersonal" >
	<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Personal Data"),"fa-user");?>
		<?php $this -> load -> form("add_form/{$form}/form_payers_personal");?>
	</fieldset>
	
</form>	

<form name="frmDataPayersContact">
	<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Contact"),"fa fa-info");?>
		<?php $this -> load -> form("add_form/{$form}/form_payers_contact");?>
	</fieldset>
</form>	

<form name="frmDataPayersZipcode" onsubmit="return false;">
	<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Search Address"),"fa-search");?>
		<?php $this -> load -> form("add_form/{$form}/form_payers_search");?>
	</fieldset>
</form>	
