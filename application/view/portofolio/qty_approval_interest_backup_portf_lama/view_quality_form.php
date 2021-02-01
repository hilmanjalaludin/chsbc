<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

			
 
?>
<script type="text/javascript">
var QUALITY_APPROVE= <?php echo json_encode($JsonAssesment); ?>; 
Ext.document('document').ready(function(){
 
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.FormStatus = function() {
	
	var failed = 0; followup = 0; var ux = Ext.Cmp('assesment').getName();
// hitung yang di pilih saja  
	for( var i = 0; i<ux.length; i++){  
		if( ux[i].checked ) {
			if( QUALITY_APPROVE[ux[i].value].value == 0 ) 
				followup+=1
			if( QUALITY_APPROVE[ux[i].value].value== 1 )
				failed+=1;
		}
	}
	
	/* reject approve-form **/
	
	if( parseInt(failed) > 0 ){
		Ext.Cmp('SatatusApprove').setValue(3); }
	else {
		if( parseInt(followup) > 0 ){ 
			Ext.Cmp('SatatusApprove').setValue(2); }
		else
			Ext.Cmp('SatatusApprove').setValue(1);
	}
	console.log(failed);
}

 
 Ext.DOM.FormStatus();
});

</script>
<div id="frmAssessment">
  <form name='frmApproval'>
	<table class="custom-grid"  
		style='overflow:auto;border:0px solid #dddddd;' cellspacing=1 cellpadding='0' width='99%' align='center'> 
	 <tr class="onselect" >
		<td class='text_caption bottom left'>TRS Name </td>
		<td class='bottom left'><?php __(form()->input('SellerId','input_text long',$Policy->get_value('full_name'),null,array('readonly' => true) ));?> </td>
		<td class='text_caption bottom left'>Date / Time</td>
		<td class='bottom' colspan='2'><?php __(form()->input('PolicySalesDate','input_text long',$Policy->get_value('PolicySalesDate'),null,array('readonly' => true) ));?></td>
	 </tr>
	 
	 <tr class="onselect" >
		
		<td class='text_caption bottom left'>Campaign</td>
		<td class='bottom'><?php __(form()->input('CampaignName','input_text long',$Policy->get_value('CampaignName'),null,array('readonly' => true) ));?></td>
		<td class='text_caption bottom left'>Venue</td>
		<td class='bottom' colspan='2'><?php __(form()->input('Venue','input_text long',null));?></td>
	 </tr>
		<tr>
			<td colspan='5' class='bottom'>&nbsp;</td>
		</tr>
	  <tr height='22px;'>
		<td class='font-standars ui-corner-top ui-state-default center'>&nbsp;#</td>
		<td class='font-standars ui-corner-top ui-state-default center'>&nbsp;</td>
		<td class='font-standars ui-corner-top ui-state-default center'>&nbsp;</td>
		<td class='font-standars ui-corner-top ui-state-default center'>&nbsp;</td>
		<td class='font-standars ui-corner-top ui-state-default center' nowrap>Poin 'X'</td>
	  </tr>

	   <tr> <td colspan='5'></td></tr>
	   
	  <?php  
		$Assesment =& Assesment($Customers->get_value('CustomerId'));
		$i = 1; foreach( $Assesment as $ux => $rows ) :  $color = ($i%2!=0?'#FFFEEE':'#FFFFFF'); ?>
	  <tr class="onselect" bgcolor='<?php __($color);?>'>
			<td class="content-middle bottom center"><?php __($i);?></td>
			<td class="content-middle bottom left"><?php __($rows['ApprovalQuestion']);?></td>
			<td class="content-middle bottom left"><?php __($rows['ApprovalQuestionDesc']);?></td>
			<td class="content-middle bottom left"><?php __($rows['ApprovalQuestionHint']);?></td>
			<td class="content-middle bottom center"> 
				<?php __(form()->checkbox("assesment",null,$ux,array("click" => "Ext.DOM.FormStatus(this);"), ($ResultPoints['ApprovalPoints'][$ux]?array('checked'=>TRUE):NULL)));?>
			</td>
		</tr>
	  <?php $i++; endforeach; ?>
		<tr>
			<td colspan='5' class='font-standars ui-corner-top ui-state-default center'>&nbsp;</td>
		</tr>
		
		<tr>
			<td class='text_caption bottom left' nowrap>&nbsp;</td>
			<td class='text_caption bottom left' nowrap>Remarks</td>
			<td colspan="3"><?php __(form()->textarea('AssesmentRemarks','textarea', $ResultPoints['ApprovalRemark'], null, array('style'=>'width:100%;height:70px;') ));?></td>
		</tr>
		
		<tr>
			<td class='text_caption bottom left' nowrap>&nbsp;</td>
			<td class='text_caption bottom left' nowrap>Status</td>
			<td colspan="3"><?php __(form()->combo("SatatusApprove",'select long', $QualityApprove,( $ResultPoints['ApprovalStatus'] ? $ResultPoints['ApprovalStatus']:1), null, array('disabled'=>true) ));?></td>
		</tr>
		
		<tr>
			<td class='text_caption bottom left' nowrap>&nbsp;</td>
			<td class='text_caption bottom left' nowrap>QA Call Monitoring By</td>
			<td colspan="3"><?php __(form()->input("UserQualityId",'input_text long',( $ResultPoints['ApprovalUserName'] ? $ResultPoints['ApprovalUserName'] : $_SESSION['Fullname'])));?></td>
		</tr>
		
		<tr>
			<td class='text_caption bottom left' nowrap>&nbsp;</td>
			<td class='text_caption bottom left' nowrap>Date / Month / Year</td>
			<td colspan="3"><?php __(form()->input("DateQuality",'input_text long', ( $ResultPoints['ApprovalTs']? $ResultPoints['ApprovalTs'] :  date('d/m/Y'))));?></td>
		</tr>
	</table>
	
</form>	
	</div>