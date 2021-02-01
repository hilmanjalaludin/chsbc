<script>
$(document).ready(function(){
	$(".disabled").each(function(){
		var ObjectId = $(this).attr('id');
		Ext.Cmp(ObjectId).disabled(true);	
	});
 });
 </script>

 



<?php  
/**
 *  	EUI_Object Object
(
    [arr_val:EUI_Object:private] => 
    [find_vals_args] => 
    [arr_rows:protected] => Array
        (
            [CustomerId] => 400
            [CustomerNumber] => MGMREF-20160630_2-001
            [CampaignId] => 28
            [Recsource] => MGMREF
            [SalutationId] => 
            [GenderId] => 
            [CardTypeId] => 
            [IdentificationTypeId] => 
            [ProvinceId] => 
            [SponsorId] => 1
            [CallReasonCode] => SA
            [CallCategoryCode] => 400
            [CallReasonId] => 39
            [CallCategoryId] => 12
            [CallReasonQue] => 99
            [QueueId] => 
            [SellerId] => 33
            [UploadedById] => 29
            [CustomerStatus] => 12
            [UpdatedById] => 1
            [CustomerPolicyNumber] => 
            [CustomerPolicyEffectiveDate] => 
            [CustomerFirstName] => BAPAK 15
            [CustomerLastName] => 
            [CustomerDOB] => 
            [CustomerIdentificationNum] => 
            [CustomerAddressLine1] => 
            [CustomerAddressLine2] => 
            [CustomerAddressLine3] => 
            [CustomerAddressLine4] => 
            [CustomerCity] => 
            [CustomerZipCode] => 
            [CustomerHomePhoneNum] => 
            [CustomerMobilePhoneNum] => 08161414709
            [CustomerWorkPhoneNum] => 
            [CustomerWorkFaxNum] => 
            [CustomerWorkExtPhoneNum] => 
            [CustomerFaxNum] => 
            [CustomerEmail] => 
            [CustomerOfficeName] => 
            [CustomerOfficeLine1] => 
            [CustomerOfficeLine2] => 
            [CustomerOfficeLine3] => 
            [CustomerOfficeLine4] => 
            [CustomerOfficeCity] => 
            [CustomerOfficeZipCode] => 
            [CustomerArea] => 
            [CustomerCardType] => 
            [CustomerUploadedTs] => 2016-06-30 20:26:46
            [CustomerUpdatedTs] => 2016-06-30 20:57:46
            [CustomerCallDateTs] => 2016-06-30 20:57:46
            [CustomerRejectedDate] => 
            [InitDays] => 0
            [QaProsess] => 0
            [CustomerCcNumber] => 0
            [CustomerExpiredCard] => 0
            [Marital_Status] => 0
            [Religion] => 0
            [Campaign_Master_Code] => 0
            [Field_1] => 0
            [Field_2] => 0
            [Field_3] => 0
            [Field_4] => 0
            [Field_5] => 0
            [Field_6] => 0
            [Field_7] => 0
            [Field_8] => 0
            [Field_9] => 0
            [Field_10] => 0
            [Flag_Followup] => 1
            [SPV_Id] => 
            [SPV_UpdateTs] => 
            [SPV_CallReasonId] => 99
            [QA_UpdateTs] => 
            [Adm_Id] => 
            [Adm_CallReasonId] => 99
            [Adm_UpdateTs] => 
            [UploadId] => 0
            [HirarcyCallReason] => 0
            [HirarcyAgentCode] => 0
            [HirarcyTs] => 
            [Refferer_Name] => LIANNAH .
            [Income] => 0
            [Meet_Advance_TRB] => 
            [Mkt_Code] => 
            [Loan_Amount] => 0
            [Loan_Tenor] => 0
            [Unique_ID_Aturduit] => 
            [Age] => 0
            [Monthly_Salary] => 0
            [Have_Other_Card] => 
            [Ekisting_Bank] => 
            [STP] => R60203
            [Agent] => TELE1_1
            [ProductId] => 24
            [POD] => 4
            [EmailStatus] => 0
            [Gender] => 
            [Salutation] => 
            [CampaignName] => Campaign NTB
            [CampaignNumber] => 1600028
            [CallReasonDesc] => SA - Process
            [CallReasonCategoryId] => 12
        )

    [arr_func_arg:protected] => Array
        (
        )

)
 */
?>

	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PProductName", "input_text disabled tolong", $Customers->get_value('Recsource'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PCampaignName", "input_text disabled tolong", $Customers->get_value('CustomerNumber') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PCampaignName", "input_text disabled tolong", $Customers->get_value('CustomerFirstName') );?></div>
			
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('DOB'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PPolicyNumber", "input_text disabled tolong", $Customers->get_value('CustomerDOB'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sales Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PPolicySalesDate", "input_text disabled tolong", $Customers->get_value('Sales','_getDateTime'));?></div>
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Address1'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("City", "input_text disabled tolong", $Customers->get_value('CustomerAddressLine1') );?></div>
			
		</div>	

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('City'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PPolicyEffectiveDate", "input_text disabled tolong", $Customers->get_value('CustomerCity'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Zip Code'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PPolicyEffectiveDate", "input_text disabled tolong", $Customers->get_value('CustomerZipCode'));?></div>
				
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Last Call Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PCampaignName", "input_text disabled tolong", $Callhistory["CallHistoryCreatedTs"] );?></div>
			
		</div>	

            <div class="ui-widget-form-row">
                  
                  <div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product'));?></div>
                  <div class="ui-widget-form-cell text_caption center">:</div>
                  <div class="ui-widget-form-cell left"><?php echo form()->combo("s", "select disabled tolong", CampaignId() , $Customers->get_value('CampaignId'));?></div>
                        
                  <div class="ui-widget-form-cell text_caption"><?php echo lang(array('Table Detail'));?></div>
                  <div class="ui-widget-form-cell text_caption center">:</div>
                  <div class="ui-widget-form-cell left"><?php echo form()->input("v", "input_text disabled tolong", $Customers->get_value('-') );?></div>
                  
            </div> 

            <div class="ui-widget-form-row">
                  <div class="ui-widget-form-cell text_caption"><?php echo lang(array('Gender'));?></div>
                  <div class="ui-widget-form-cell text_caption center">:</div>
                  <div class="ui-widget-form-cell left"><?php echo form()->input("m", "input_text disabled tolong", $Customers->get_value('Gender'));?></div>
                  
            </div>     
	
	</div>

