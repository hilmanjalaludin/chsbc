<form name="frmInfoCustomer_2nd">
	<?php echo form()->hidden('CustomerId_2nd',NULL, $SecondDetail->get_value('CustomerId') );?>
	<?php echo form()->hidden('CustomerNumber_2nd',NULL, $SecondDetail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerAge_2nd',NULL, $SecondDetail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerDOB_2nd',NULL, $SecondDetail->get_value('CustomerDOB') );?>
	<?php echo form()->hidden('CustomerFirstName_2nd',NULL, $SecondDetail->get_value('CustomerFirstName') );?>
	<?php echo form()->hidden('GenderId_2nd',NULL, $SecondDetail->get_value('GenderId') );?>
</form>
<?php $this ->load ->view('mod_contact_detail/second_product/view_customer_info');?>