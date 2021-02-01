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

<div id="PaymentTransaction">
<div class="ui-widget-form-table product-box-content">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Payment Type</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("CreditCardTypeId", 'select superlong zx-select',$PaymentType, $Payers['CreditCardTypeId']);?></div>
	</div>
</div>

<div class="ui-widget-form-table product-box-content">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Bank</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayersBankId", 'select superlong zx-select',Bank(),$Payers['PayersBankId']);?></div>
	</div>
</div>
</div>
