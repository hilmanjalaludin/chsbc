<form name="frmInfoCustomer">
	<?php echo form()->hidden('CustomerId',NULL, $Detail->get_value('CustomerId') );?>
	<?php echo form()->hidden('CustomerNumber',NULL, $Detail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerAge',NULL, $Detail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerDOB',NULL, $Detail->get_value('CustomerDOB') );?>
	<?php echo form()->hidden('CustomerFirstName',NULL, $Detail->get_value('CustomerFirstName') );?>
	<?php echo form()->hidden('GenderId',NULL, $Detail->get_value('GenderId') );?>
</form>
<?php $this ->load ->view('mod_reconfirm_detail/view_customer_info');?>