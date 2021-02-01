<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script>
Ext.document().ready(function(){
	Ext.Serialize("frmPayer").procedure(function(item){
		for( var _key in item ) {
			if( Ext.Cmp(_key).getAttribute().NodeValue('class').match(/disabled/g) )
				Ext.Cmp(_key).disabled(true);
			else
				Ext.Cmp(_key).disabled(false);
				
			if( Ext.Cmp(_key).getAttribute().NodeValue('name').match(/Address/g) ){
				Ext.Cmp(_key).getElementId().maxLength = 40;
			}

			if( Ext.Cmp(_key).getAttribute().NodeValue('name').match(/Additional/g) ){
				Ext.Cmp(_key).getElementId().maxLength = 12;
			}	
		}
	});
	
	Ext.query('.date').datepicker({
		changeYear:true, changeMonth:true,
		dateFormat : 'dd-mm-yy',
		changeDays:true
	});
});

</script>
<form name='frmPayer'>
<fieldset class="corner" >
<legend class='icon-customers'>&nbsp;&nbsp;Personal Data</legend>
	<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>	
		<tr>
			<td class="text_caption required bottom">* Title</td>
			<td><?php echo form()->combo("PayerSalutationId",'select enabled long',$Combo['Salutation'], $Payers['SalutationId']);?></td>
			<td class="text_caption required bottom" nowrap>* First Name</td>
			<td><?php echo form()->input("PayerFirstName","select long",$Payers['PayerFirstName']);?></td>
			<td class="text_caption bottom" nowrap>Last Name</td>
			<td><?php echo form()->input("PayerLastName","select long",$Payers['PayerLastName']);?></td>
		</tr>
		<tr>
			<td class="text_caption bottom">Gender</td>
			<td><?php echo form()->combo("PayerGenderId",'select enabled long',$Combo['Gender'],$Payers['GenderId']);?></td>
			<td class="text_caption bottom required">* Place of Birth</td>
			<td><?php echo form()->input("PayerPlaceOfBirth",'input_text long',$Payers['PayerPlaceOfBirth']);?></td>
			<td class="text_caption bottom required">* DOB</td>
			<td>
				<?php echo form()->input("PayerDOB","input_text enabled date",$Payers['PayerDOB']);?>
				<?php echo form()->hidden("PayerAge","input_text disabled ",$Payers['PayerAge']);?>
			</td>
		</tr>
		<tr>
			<td class="text_caption bottom">ID - Type </td>
			<td><?php echo form()->combo("PayerIdentificationTypeId","select long",$Combo['Identification'],$Payers['IdentificationTypeId']);?></td>
			<td class="text_caption bottom required">* ID No</td>
			<td><?php echo form()->input("PayerIdentificationNum","input_text long",$Payers['PayerIdentificationNum']);?></td>
		</tr>
	</table>
		
</fieldset>


<fieldset class="corner" style='margin-top:15px;'>
<legend class="icon-application">&nbsp;&nbsp;Contact</legend>
	<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>	
		<tr>
			<td class="text_caption bottom" nowrap>Mobile Phone</td>
			<td><?php echo form()->input("PayerMobilePhoneNum","input_text long",$Payers['PayerMobilePhoneNum']);?> </td>
			<td class="text_caption bottom">Preferred <br>Communications Channel</td>
			<td><?php echo form()->combo("PayerPreferedComunication", "select long",$Combo['Comunication'], $Payers['PayerPreferedComunication']);?> </td>
			<td class="text_caption bottom">Address1</td>
			<td><?php echo form()->input("PayerAddressLine1","select long city_payer",$Payers['PayerAddressLine1']);?></td>
		</tr>
		<tr>
			<td class="text_caption bottom" nowrap>Home Phone </td>
			<td><?php echo form()->input("PayerHomePhoneNum","input_text long",$Payers['PayerHomePhoneNum']);?> </td>
			<td class="text_caption bottom">Additional Phone1</td>
			<td><?php echo form()->input("PayerAdditionalPhone1","input_text long",$Payers['PayerAdditionalPhone2']);?> </td>
			<td class="text_caption bottom">Address2</td>
			<td> <?php echo form()->input("PayerAddressLine2","select long city_payer",$Payers['PayerAddressLine2']);?></td>
		</tr>
		<tr>
			<td class="text_caption bottom" nowrap>Office Phone </td>
			<td><?php echo form()->input("PayerOfficePhoneNum", "input_text long",$Payers['PayerOfficePhoneNum']);?> </td>
			<td class="text_caption bottom">Additional Phone2</td>
			<td><?php echo form()->input("PayerAdditionalPhone2", "input_text long",$Payers['PayerAdditionalPhone2']);?> </td>
			<td class="text_caption bottom">Address3</td>
			<td><?php echo form()->input("PayerAddressLine3","select long kecamtan_payer",$Payers['PayerAddressLine3']);?></td>
		</tr>
		<tr>
			<td class="text_caption bottom">Email</td>
			<td><?php echo form()->input("PayerEmail", "input_text long",$Payers['PayerEmail']);?></td>
			<td class="text_caption">Address Type</td>
			<td><?php echo form()->combo("PayerAddrType",'select  ',$Combo['BillingAddress'], $Payers['PayerAddrType']);?></td>
			<td class="text_caption bottom">City</td>
			<td><?php echo form()->input("PayerCity","input_text long autocomplte_payer",$Payers['PayerCity']);?>  </td>
		</tr>
		<tr>
			<td class="text_caption bottom">Fax Number </td>
			<td><?php echo form()->input("PayerFaxNum", "input_text  long",$Payers['PayerFaxNum']);?></td>
			<td class="text_caption bottom">Province</td>
			<td><?php echo form()->combo("PayerProvinceId", 'select ',$Combo['Province'],$Payers['ProvinceId']);?></td>
			<td class="text_caption bottom">Zip</td>
			<td><?php echo form()->input("PayerZipCode","input_text long",$Payers['PayerZipCode']);?></td>
		</tr>
	</table>
</fieldset>
	
<fieldset class="corner" style='margin-top:15px;'>
	<legend class="icon-application">&nbsp;&nbsp;Payment</legend>
	<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>	
		<tr>
			<td class="text_caption bottom">Payment Type</td>
			<td><?php echo form()->combo("CreditCardTypeId", 'select disabled long',$PaymentType, $Payers['CreditCardTypeId']);?></td>
			<td class="text_caption bottom">Bank</td>
			<td><?php echo form()->combo("PayersBankId", 'select ',$Combo['Bank'],$Payers['PayersBankId']);?></td>
		</tr>
		<tr>
			<td class="text_caption bottom" valign="top">Card Number</td>
			<td valign="top"><?php echo form()->input("PayerCreditCardNum", "input_text enabled long",$Payers['PayerCreditCardNum']);?>
			<span id="error_message_html"></span></td>
			<td class="text_caption bottom" nowrap>Expiration Date</td>
			<td><?php echo form()->input("PayerCreditCardExpDate", "input_text enabled long",$Payers['PayerCreditCardExpDate']);?><span class="wrap">&nbsp;(mm/yy)</span></td>
		</tr>
	</table>
</fieldset>
</form>
<div style='float:right'><?php __(form()->button('button_update','update button','Update',array('click'=>'Ext.DOM.UpdatePayer();')));?></div>