<?php
/*
 * @ def : create dropdown by Category 
 */
	echo form() -> combo
	(
		'CallResult',
		'select tolong select-chosen',
		 $setCallResult,
		 null,
		 array('change'=>'getEventSale(this);')
	); 
?>