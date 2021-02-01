<?php 

/*
 * @ def : Insured view Detail handle by Clik 
 * ----------------------------------------------------
 
 * @ param : Insured ID ( INT )
 * @ param : - 
 **/
 
?>
<script>
Ext.document().ready(function(){
	Ext.Serialize("InsuredDetailForm").procedure(function(item){
		for( var _key in item ){
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
		}
	});
	
	Ext.query('.date').datepicker({
		changeYear:true, changeMonth:true,
		dateFormat : 'dd-mm-yy',
		changeDays:true
	});
});

</script>
<!-- START : Div 1 -->

<?php echo form()->hidden('InsuredId','input_text disabled long', $Insured['InsuredId']); ?> 
<form name="InsuredDetailForm">
<fieldset class='corner' style='margin-top:5px;'>
 <legend class='icon-application'>&nbsp;&nbsp;Product</legend>
<div id="product-insured">
<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>
	<tr>
		<td class="text_caption bottom required">* Policy Number</td>
		<td class='bottom'><span id="policy_number"><?php echo form()->input('InsuredPolicyNumber','input_text disabled long', $Insured['PolicyNumber']); ?> </span></td>
		<td class="text_caption bottom required">* Payment Mode</td>
		<td class='bottom'><span id="pay_plan"><?php echo form()->combo('InsuredPayMode','select disabled long',$Combo['PaymentMode'],$Insured['PayModeId']); ?></span> </td>
		<td class="text_caption bottom sunah">Premi</td>
		<td class='bottom'><?php echo form()->input('InsuredPremi','input_text disabled box',$Insured['ProductPlanPremium']); ?> <span class="wrap"> ( IDR ) </span></td>
	</tr>
	<tr>
		<td class="text_caption bottom required">* Group Premi</td>
		<td class='bottom'><span id="group_premi"><?php echo form()->combo('InsuredGroupPremi','select disabled long',$Combo['PremiGroup'],$Insured['PremiumGroupId']); ?> </span></td>
		<td class="text_caption bottom required ">* Plan Type</td>
		<td class='bottom'><span id="plan_type"><?php echo form()->input('InsuredPlanType','input_text disabled long',$Insured['ProductPlanName']); ?></span> </td>
	</tr>
</table>
</div>
</fieldset>
<!-- STOP : Div 1 -->

<!-- START : Div 2 -->
<fieldset class='corner' style='margin-top:15px;'>
<legend class='icon-customers'>&nbsp;&nbsp;Personal Data</legend>
<div id="personal-insured" >
<table class="product-box-content" align="center" width="100%" cellspacing=0 border=0>
	<tr>
		<td class="text_caption bottom sunah">Title</td>
		<td class='bottom'><?php echo form()->combo('InsuredSalutationId','select long',$Combo['Salutation'],$Insured['SalutationId']); ?></td>
		<td class="text_caption bottom required">* First Name</td>
		<td class='bottom'><?php echo form()->input('InsuredFirstName','input_text long',$Insured['InsuredFirstName'],null); ?></td>
		<td class="text_caption bottom sunah">Last Name</td>
		<td class='bottom'><?php echo form()->input('InsuredLastName','input_text long',$Insured['InsuredLastName']); ?></td>
	</tr>
	<tr>
		<td class="text_caption bottom required">* Place Of Birth </td>
		<td class='bottom'><?php echo form()->input('Place_of_Birth','input_text long',$Insured['Place_of_Birth']); ?></td>
		<td class="text_caption bottom sunah">DOB</td>
		<td class='bottom'><?php echo form()->input('InsuredDOB','input_text enabled date',date('d-m-Y',strtotime($Insured['InsuredDOB']))); ?></td>
		<td class="text_caption bottom sunah">Age</td>
		<td class='bottom'><?php echo form()->input('InsuredAge','input_text disabled box',$Insured['InsuredAge']); ?></td>
	</tr>
	<tr>
		<td class="text_caption bottom required">* Gender </td>
		<td class='bottom'><?php echo form()->combo('InsuredGenderId','select enabled long',$Combo['Gender'],$Insured['GenderId']); ?></td>
		<td class="text_caption bottom sunah">Marital Status</td>
		<td class='bottom'><?php echo form()->combo('Marital_Status','select long',$Combo['Maried'],$Insured['Marital_Status']); ?></td>
	</tr>
</table>
</div>
</fieldset>
<!-- STOP: Div 2 -->


<!-- START : Div 3 -->

<fieldset class='corner' style='margin-top:15px;'>
<legend class='icon-menulist'>&nbsp;&nbsp;Underwriting</legend>
<div >
<table  class="product-box-content" align="center" width="100%" cellspacing=0 border=0>
	<tr>
		<td class="text_caption bottom sunah">Contact Height</td>
		<td class='bottom' nowrap><?php echo form()->input("Contact_Height","input_text box",(INT)$Insured['Contact_Height']);?><span class="wrap">&nbsp;(Cm/Km)</span></td>
		<td class="text_caption bottom sunah">Contact Height Unit </td>
		<td class='bottom' nowrap><?php echo form()->input("Contact_Height_Unit","input_text box",$Insured['Contact_Height_Unit']);?></td>
	</tr>
	<tr>
		<td class="text_caption bottom">Contact Weight</td>
		<td class='bottom' nowrap><?php echo form()->input('Contact_Weight','input_text box',(INT)$Insured['Contact_Weight']); ?><span>(Kg)</span></td>
		<td class="text_caption bottom">Contact Wight Unit</td>
		<td class='bottom' nowrap><?php echo form()->input('Contact_Weight_Unit','input_text box',$Insured['Contact_Weight_Unit']); ?></td>		
	</tr>
	
	
	<tr>
		<td class="text_caption bottom sunah">Occupational Category</td>
		<td><?php echo form()->combo("Occupational_Category","select long",$Combo['WorkType'],$Insured['Occupational_Category']);?></td>
		<td class="text_caption bottom">Smoking Status</td>
		<td><?php echo form()->combo('Smoking_Status','select long',$Combo['Smoking'],$Insured['Smoking_Status']); ?></td>	
	</tr>
</table>
</div>
<br>
<div id="underwriting" >
	<table class="product-box-content" cellspacing="1" cellpadding="0" width="100%"> 
		<tr height=24>
			<th class="ui-corner-top ui-state-default first center" width="5%">No</th>
			<th class="ui-corner-top ui-state-default first left">&nbsp;Question</th>
			<th class="ui-corner-top ui-state-default first left">&nbsp;Answer</th>
			<th class="ui-corner-top ui-state-default first left">&nbsp;Comments</th>
		</tr>
	<?php if(is_array($Question))foreach( $Question as $key => $rows)
	{ 
		$no++;
		$i = (INT) $rows['QuestionOrder'];
		
	?>
		<tr>
			<td class="content-first center" width="5%"><?php __($no); ?></td>
			<td class="content-middle left"><?php __($rows['QuestionText']); ?></td>
			<td class="content-middle left"><?php __( form()->combo("Dec_Q0{$i}_Answer",'select',array('Y' => 'Yes','N' => 'No'), $Insured["Dec_Q0{$i}_Answer"]) ); ?></td>
			<td class="content-lasted left"><?php __( form()->textarea("Dec_Q0{$i}_Comments",'textarea',$Insured["Dec_Q0{$i}_Comments"],null,array('style'=>'width:150px;height:50px;')) ); ?></td>
		</tr>
	<?php } ?>
	</table>
</div>
</fieldset>

</form>
<!-- STOP: Div 3 -->

<!-- START : Div 4 -->
<form name="frmBenefiecery">
<fieldset class='corner' style='margin-top:15px;'>
	<legend class='icon-customers'> &nbsp;&nbsp;Benefiacery</legend>
	<?php $this -> load->view("qty_approval_interest/view_quality_benefiecery");?>
</fieldset>
</form>
<div style="float:right;">
<?php __(form()->button('button_update','update button','Update', array('click' =>'Ext.DOM.UpdateInsured();' ) ));?>
<div>
<!-- STOP : Div 4 -->

