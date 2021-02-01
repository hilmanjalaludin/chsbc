<!-- start : layout add campaign -->
<script>
$(function(){
 var date = new Date();
	$("#ExpiredDate").datepicker
	({
		showOn : 'button',  
		buttonImage	: Ext.DOM.LIBRARY +'/gambar/calendar.gif', 
		buttonImageOnly: true,
		dateFormat	:'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:date.getFullYear()+':3000'
	});
});
</script>		
<?php
	// print_r($Campaign);
	
	// print_r();
?>
<form name="frm_add_campaign">
<?php echo form() -> hidden("CampaignId","select long ", $Campaign['CampaignId']); ?>
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Campaign </legend>
 <table border=0 width="80%" align="center" cellpadding="3px" style="margin-top:-10px;">
 <tr>
	<td valign="top">
		<table cellpadding="6px">
			
			<tr style="display:none;">
				<td class="text_caption" style="display:none;">* Campaign ID. </td>
				<td style="display:none;"><?php echo form() -> combo("CampaignNumber","select long ", $Campaign['CampaignId']); ?></td>
			</tr>
			
			<tr style="display:yes;">
				<td class="text_caption">* Campaign Number. </td>
				<td><?php echo form() -> input("CampaignNumber","select long", $Campaign['CampaignNumber'], NULL, array('disabled' => true,'style'=>'color:#dddddd;')); ?></td>
			</tr>
			
			<tr style="display:none";>
				<td class="text_caption" >* Campaign Type</td>
				<td><?php echo form() -> combo("CampaignTypeId"); ?></td>
			</tr>
								
			<tr style="display:none">
				<td class="text_caption" style="display:none;"> Built Type</td>
				<td style="display:none"><?php echo form() -> combo("BuiltTypeId","select"); ?></td>
			</tr>
								
			<tr style="display:none;">
				<td class="text_caption" style="display:none";>* Re-Upload Campaign</td>
				<td style="display:none;"><?php echo form() -> combo("ReUpload","select"); ?></td>
			</tr>
			
			<tr>
				<td class="text_caption">* Campaign Name</td>
				<td> <?php echo form() -> input('CampaignName', 'input_text long', $Campaign['CampaignName']); ?></td>
			</tr>
			
			<tr>
				<td class="text_caption" valign="top">* Product</td>
				<td > <?php echo form() -> combo('ProductId', 'select_multiple long',$Utility -> _get_product(),NULL, NULL,array('multiple'=>true)); ?> </td>
			</tr>
			
			<tr>
				<td class="text_caption">* Date Expired</td>
				<td><?php echo form() -> input('ExpiredDate', 'input_text box', $this -> EUI_Tools ->_date_indonesia($Campaign['CampaignEndDate'])); ?></td>
			</tr>
			
			<tr style="display:none;">
				<td class="text_caption" >* Date Extends</td>
				<td><?php echo form() -> input('ExtendsDate', 'input_text box'); ?></td>
			</tr>
		</table>
	</td>
	<!-- stop : left layout -->
	<!-- start : right layout -->
	<td valign="top">
		<table cellpadding="6px">
			<tr>
				<td class="text_caption">* Category</td>
				<td> <?php echo form() -> combo('CategoryId', 'input_text long', $Utility->_get_category_product(), $Campaign['CategoryId']); ?></td>
				<td class="text_caption">* Method</td>
				<td> <?php echo form() -> combo('DirectMethod', 'input_text long', $Method ,$Campaign['DirectMethod'],array('change'=>'getMethod(this);')); ?></td>
			</tr>
			<tr>
				<td class="text_caption"> 
					<input type="button" value=">>" Onclick="cbMoveOn();" ><br>
					<input type="button" value="<<" Onclick="cbRemoveOn();">
				</td>
				<td> <?php echo form() -> combo('ListProduct','select_multiple long',$ProductCampaign,null, null,array('multiple'=>true,'disabled'=>true)); ?></td>
				<td class="text_caption" valign="top">* Avail Campaign</td>
				<td valign="top"> <?php echo form() -> combo('AvailCampaignId', 'input_text long', $Avail,$Campaign['AvailCampaignId']); ?></td>
			</tr>
			<tr style="display:none;">
				<td class="text_caption">* CampType</td>
				<td><?php echo form() -> combo("CampaignTypeId"); ?></td>
			</tr>
			<tr style="display:none;">
				<td class="text_caption" >* System</td>
				<td><?php echo form() -> combo("SystemTypeId"); ?></td>
			</tr>
			<tr>
				<td class="text_caption">* status Active</td>
				<td><?php echo form() -> combo("StatusActive","select long",array('1'=>'Active','0'=>'Not Active'),$Campaign['CampaignStatusFlag']); ?></td>
				<td class="text_caption" valign="top">* Action</td>
				<td valign="top"> <?php echo form() -> combo('DirectAction', 'input_text long',$Action,$Campaign['DirectAction']); ?></td>
			</tr>
			<tr>
				<td class="text_caption">* Oubound Goals</td>
				<td><?php echo form() -> combo("OutboundGoalsId","select long",$OutboundGoals,$Campaign['OutboundGoalsId'],array('change'=>'getDirect(this);')); ?></td>
			</tr>
			<tr style="display:none;">
				<td class="text_caption">* Re-Upload Reason</td>
				<td><?php echo form() -> combo('ReUploadReason'); ?></td>
			</tr>
		</table>
	</td>
	</tr>
	<tr>
		<td style="float:left;border:0px solid #000;"> <a href="javascript:void(0);" class="sbutton" onclick="SetUpdate();"><span>&nbsp;Update</span></a> </td>
	</tr>
</table>

</fieldset>
</div>


</form>