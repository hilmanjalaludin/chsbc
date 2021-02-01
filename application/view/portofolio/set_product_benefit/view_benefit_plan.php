<?php
/* 
 * @ def 	: view combo of the plan by product 
 * --------------------------------------------
 *
 * @ param 	: product Id
 * @ aksess : public
 */
 
echo form() -> combo(
	'ProductPlan',
	'select long',
	$ProductPlan
);
?>