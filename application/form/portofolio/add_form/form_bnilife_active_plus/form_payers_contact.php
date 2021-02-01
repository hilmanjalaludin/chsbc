<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
 $vars = new EUI_object(_get_all_request() );
 
?>

<?php if( $vars->get_value('ViewLayout') == 'ADD_FORM') : ?>
<?php $this->load->form("add_form/{$form}/form_payers_contact_add");?>
<?php else : ?>
<?php $this->load->form("add_form/{$form}/form_payers_contact_edit");?>
<?php endif; ?>

<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required"> Communications<br>Channel</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerPreferedComunication", "select long zx-select ",Comunication(), $Payers['PayerPreferedComunication']);?> </div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Email</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerEmail", "input_text long",$Payers['PayerEmail']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Address Type</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerAddrType",'textarea long zx-select', BillingAddress(), $Payers['PayerAddrType']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Province</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerProvinceId", 'select long zx-select',Province(),$Payers['ProvinceId']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Address 1</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine1","textarea long city_payer uppercase ",$Payers['PayerAddressLine1'],null,array("style"=>"height:100%;width:175px;", "length"=>200));?></div>
	</div>
	
	
</div>


<div class="ui-widget-form-table">	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Address 2</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"> <?php echo form()->textarea("PayerAddressLine2","textarea long city_payer uppercase",$Payers['PayerAddressLine2'],null,array("style"=>"height:25px;width:175px;", "length"=>200));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Address 3</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine3","textarea long kecamtan_payer uppercase",$Payers['PayerAddressLine3'],null,array("style"=>"height:25px;width:175px;", "length"=>200));?></div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">City</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerCity","input_text long autocomplte_payer uppercase",$Payers['PayerCity']);?>  </div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Zip</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerZipCode","input_text long",$Payers['PayerZipCode']);?></div>
	</div>
</div>