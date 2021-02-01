<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

$Payer  =new EUI_Object(PayerReady($Customers->get_value('CustomerId'))); 
	 
?>
<script>
$(document).ready(function(){
	$(".disabled").each(function(){
		var ObjectId = $(this).attr('id');
		Ext.Cmp(ObjectId).disabled(true);	
	});
 });

</script>


<form name='frmDataUpload' >
<?php echo form()->hidden("PayerId", "undisabled",$Payer->get_value('PayerId')) ?>
<fieldset class="corner" style="border-radius:5px;padding:5px 5px 10px 5px;">
<?php echo form()->legend(lang('Comparison'), "fa-edit"); ?>
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Customer Name</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerName",'input_text disabled superlong',$Customers->get_value('CustomerFirstName'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">DOB</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerDOB","input_text undisabled superlong",$Customers->get_value('CustomerDOB'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Phone 1</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerMobilePhoneNum","input_text disabled superlong",$Customers->get_value('CustomerMobilePhoneNum'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Phone 2</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerWorkPhoneNum","input_text disabled superlong",$Customers->get_value('CustomerWorkPhoneNum'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Religion</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("Religion","input_text disabled superlong",$Customers->get_value('Religion'));?></div>
		</div>
		
	</div>
	
	<div class="ui-widget-form-table">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Address 1</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("CustomerAddressLine1","textarea disabled superlong",$Customers->get_value('CustomerAddressLine1','strtoupper') );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Address 2</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerAddressLine2","input_text disabled superlong",$Customers->get_value('CustomerAddressLine2','strtoupper'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Address 3</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerAddressLine3","input_text disabled superlong",$Customers->get_value('CustomerAddressLine3','strtoupper'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">City</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerCity","input_text disabled superlong",$Customers->get_value('CustomerCity','strtoupper'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Zip Code</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerZipCode","input_text disabled superlong",$Customers->get_value('CustomerZipCode','strtoupper'));?></div>
		</div>
		
	</div>
</fieldset>
</form>


<form name='frmPayer' >
<?php echo form()->hidden("PayerId", "undisabled",$Payer->get_value('PayerId')) ?>
<fieldset class="corner" style="border-radius:5px;margin-top:10px;padding:5px 5px 10px 5px;">
<?php echo form()->legend(lang('Personal Data'), "fa-edit"); ?>

	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">* Title</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerSalutationId",'select xchosen disabled long',Salutation(), $Payer->get_value('SalutationId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">* First Name</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerFirstName","input_text undisabled long",$Payer->get_value('PayerFirstName'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Age</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerAge","input_text disabled long",$Payer->get_value('PayerAge','intval'));?></div>
		</div>
		
	</div>
	
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Gender</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerGenderId",'select xchosen disabled long',Gender(),$Payer->get_value('GenderId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">* DOB</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerDOB","input_text disabled long date",$Payer->get_value('PayerDOB', '_getDateIndonesia'));?></div>
		</div>
		
	</div>
	
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">ID - Type </div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerIdentificationTypeId","select xchosen disabled long",Identification(),$Payer->get_value('IdentificationTypeId'));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">* ID No</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerIdentificationNum","input_text disabled long",$Payer->get_value('PayerIdentificationNum'));?></div>
		</div>
	</div>
	
</fieldset>


<fieldset class="corner" style='margin-top:15px;border-radius:5px;padding:5px 5px 10px 5px;'>
<?php echo form()->legend(lang('Contact'), "fa-edit"); ?>

	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Mobile Phone 1</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerMobilePhoneNum","input_text long disabled",$Payer->get_value('PayerMobilePhoneNum'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Mobile Phone 2</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerMobilePhoneNum2","input_text long disabled",$Payer->get_value('PayerMobilePhoneNum2'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Home Phone 1</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerHomePhoneNum","input_text long disabled",$Payer->get_value('PayerHomePhoneNum'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Home Phone 2</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerHomePhoneNum2","input_text long disabled",$Payer->get_value('PayerHomePhoneNum2'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Office Phone 1</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerOfficePhoneNum","input_text long disabled",$Payer->get_value('PayerOfficePhoneNum'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Office Phone 2</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerOfficePhoneNum2","input_text long disabled",$Payer->get_value('PayerOfficePhoneNum2'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Fax Number</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerFaxNum","input_text long disabled",$Payer->get_value('PayerFaxNum'));?></div>
		</div>
	</div>
	
	
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Comunication<br>Chanel</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerPreferedComunication", "select  xchosen disabled long",Comunication(), $Payer->get_value('PayerPreferedComunication'));?> </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Email</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerEmail", "input_text long disabled",$Payer->get_value('PayerEmail'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Address Type</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerAddrType",'select  xchosen undisabled long',BillingAddress(), $Payer->get_value('PayerAddrType'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Province</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayerProvinceId", 'select  xchosen undisabled long',Province(),$Payer->get_value('ProvinceId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Jalan /<br>Perumahan<br>( RT/RW+No )</div>

			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine1","textarea long undisabled city_payer",$Payer->get_value('PayerAddressLine1'));?></div>
		</div>
	</div>

	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Patokan</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine4","input_text long undisabled city_payer",$Payer->get_value('PayerAddressLine4'), null, array("style" => "width:100%;") );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Kelurahan</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine3","input_text long undisabled kecamtan_payer",$Payer->get_value('PayerAddressLine3'), null, array("style" => "width:100%;") );?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Kecamatan</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine2","input_text long undisabled city_payer",$Payer->get_value('PayerAddressLine2'), null, array("style" => "width:100%;") );?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Kabupaten/Kota</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerCity","input_text long undisabled autocomplte_payer",$Payer->get_value('PayerCity'), null, array("style" => "width:100%;") );?>  </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Kode Pos</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PayerZipCode","input_text undisabled box",$Payer->get_value('PayerZipCode'));?></div>
		</div>
	</div>
	
</fieldset>
	
<fieldset class="corner" style='margin-top:15px;border-radius:5px;padding:5px 5px 10px 5px;'>
	<?php echo form()->legend(lang('Payment'), "fa-edit"); ?>
	
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Payment Type</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("CreditCardTypeId", 'select  xchosen disabled long',PaymentType(), $Payer->get_value('CreditCardTypeId'));?></div>
			
			<div class="ui-widget-form-cell text_caption">Bank</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PayersBankId", 'select xchosen disabled long', Bank() ,$Payer->get_value('PayersBankId'));?></div>
			
		</div>
	</div>
</fieldset>

<fieldset class="corner" style='border:0px solid #000;margin-top:15px;border-radius:5px;padding:5px 5px 10px 5px;'>
	<div style='float:right;display:none;'><?php __(form()->button('button_update',"update button {$Disabled}",'Update',array('click'=>'Ext.DOM.UpdatePayer();')));?></div>
</fieldset>
</form>
