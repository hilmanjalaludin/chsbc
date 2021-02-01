<?php 

$dts =& Objective($Customers);
$outs =& Objective($ItemApprove); 

?>
<!-- start content -->

<fieldset class="corner" style="border-radius:5px;padding:8px;margin:-10px 0px 0px 0px;"> 
<?php echo form()->legend(lang('Customer Information'), "fa-info"); ?>

<div id="quality_default_info" class="box-left-top">
<form name="frmInfoCustomer">

<?php echo form()->hidden("CustomerId", null,$dts->get_value('CustomerId'));?>
<?php echo form()->hidden("CustomerNumber", null, $dts->get_value('CustomerNumber'));?>
<table align="left" cellpadding="2px" cellspacing="4px">
	<tr>
		<td nowrap class="text_caption">Customer Name</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->input('CustomerFirstName','input_text long cell-disabled',$dts->get_value('CustomerFirstName'),NULL,1);?> </td>
		<td class="text_caption" nowrap>Card Type </td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->combo('CardTypeId','select long cell-disabled',CardType(),$dts->get_value('CardTypeId'),NULL,1); ?></td>
	</tr>
	<tr>
		<td class="text_caption" nowrap >Gender</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->combo('GenderId','select long cell-disabled',Gender(), $dts->get_value('GenderId'),NULL,1);?></td>
		<td class="text_caption" nowrap>Address 1</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->textarea('CustomerAddressLine1','textarea long cell-disabled',$dts->get_value('CustomerAddressLine1'),NULL,1);?></td>
		</tr>
	<tr>
		
		<td  style="display:none;" class="text_caption" nowrap >DOB </td>
		<td  style="display:none;" class="text_caption" nowrap>:</td>
		<td  style="display:none;"><?php echo form()->input('CustomerDOB','input_text long cell-disabled',$dts->get_value('CustomerDOB','_getDateIndonesia'),NULL,1);?></td>


		<td class="text_caption" nowrap>Address 2</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->textarea('CustomerAddressLine2','textarea long cell-disabled',$dts->get_value('CustomerAddressLine2'),NULL,1);?></td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>Address3</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->input('CustomerAddressLine3','input_text long cell-disabled',$dts->get_value('CustomerAddressLine3'),NULL,1); ?></td>
		<td class="text_caption" nowrap>City  </td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->input('CustomerCity','input_text long cell-disabled',$dts->get_value('CustomerCity'),NULL,1);?></td>
	</tr>
	
	<tr>
		<td class="text_caption" nowrap>ZIP code</td>
		<td class="text_caption" nowrap>:</td>
		<td><?php echo form()->input('CustomerZipCode','input_text long',$dts->get_value('CustomerZipCode'),NULL,1);?></td>
	</tr>
</table>	
</form>
</div>
</fieldset>	


<fieldset class="corner" style="border-radius:5px;margin:15px 0px 0px 0px;padding:8px;"> 
<?php echo form()->legend(lang('Request Additional Phone'), "fa-info"); ?>
<form name="frmApprovalUser">
<input type="hidden" name="ApproveItemId" id="ApproveItemId" value="<?php echo _get_post("ApproveId"); ?>"/>
<div class="ui-widget-form-table-maximum">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Request By</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('req_ts_agent','input_text tolong cell-disabled',$outs->get_value('full_name','_setCapital'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Create Date</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('req_ts_dates','input_text tolong cell-disabled',$outs->get_value('ApprovalCreatedTs','_getDateTime'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Phone Number</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell" ><?php echo form()->input('req_ts_phone','input_text tolong cell-disabled',$outs->get_value('ApprovalOldValue'));?></div>
	</div>
</div>	

 <div class="ui-widget-form-table-maximum">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Approve Status</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo('ApprovalStatus','select tolong',array('1'=>'Approve','0'=>'Reject'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell"></div>
		<div class="ui-widget-form-cell"><?php echo form()->button('btnSubmit','button update',lang('Submit'), array('click' => 'Ext.DOM.Submit();'));?></div>
	</div>
 </div>
</form>
</fieldset>	