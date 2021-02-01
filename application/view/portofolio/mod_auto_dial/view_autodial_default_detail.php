<form name="frmInfoCustomer">
	<?php echo form()->hidden('CustomerId',			NULL, $Detail->field('CustomerId') );?>
	<?php echo form()->hidden('Recsource',			NULL, $Detail->field('Recsource') );?>
	<?php echo form()->hidden('CustomerNumber',		NULL, $Detail->field('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerAge',		NULL, $Detail->field('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerDOB',	  	NULL, $Detail->field('CustomerDOB') );?>
	<?php echo form()->hidden('CustomerFirstName',	NULL, $Detail->field('CustomerFirstName') );?>
	<?php echo form()->hidden('GenderId',			NULL, $Detail->field('GenderId') );?>
	<?php echo form()->hidden('PhoneType',			NULL, $PhoneType['type'] );?>
</form>
<?php $this ->load ->view('mod_auto_dial/view_customer_info');?>