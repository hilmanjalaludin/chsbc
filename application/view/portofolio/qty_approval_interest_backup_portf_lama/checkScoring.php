<script type="text/javascript">
Ext.document('document').ready(function()
{
  Ext.Serialize('frmScoring').prop(function(items){
	for( var component in items ) {
		Ext.Cmp(component).setAttribute('disabled',true);
	}	
  });
  
  var element = Ext.Cmp('cekscore').getName();
  for( var i = 0; i<element.length; i++ ){
	element[i].disabled = true;	
  }
  
});

</script>

<div id="div_score">
<fieldset class="corner" style='border:0px solid #000;'>
		<?php echo form()->hidden('FinalScore', null, 100);?>
		<form name="frmScoring">
			<?php
			$no = 0;
			if( isset($QualityScoring['Category'])) 
			foreach($QualityScoring['Category'] as $key => $category)  { $no++; ?>
			
			<table class="custom-grid" style='border:0px solid #dddddd;' 
				cellspacing='0' cellpadding='0' width='99%' align='center'> 
				<tr>
					<td class="ui-corner-top ui-state-default " style="padding:5px;" colspan="3">
						<span color="red" 
						style="padding:2px 0px 2px 0px;border-top:0px solid #000000;"><?php __($no.' . '.$category); ?></span></td>
				</tr>
				<?php 
				foreach($QualityScoring['SubCategory'][$key] as $id => $value) { ?>
				<tr class="onselect">
					<td class="content-first text_caption bottom center"><?php __($value['ScoringQuestionNo']); ?>.</td>
					<td class="content-middle text_caption bottom"><div align="left" style="width:550px;"><?php echo _setBreakWord( $value['ScoringQuestion'] ); ?></div></td>
					<td class="content-lasted bottom" align="center">
						<input 
							type ="checkbox" 
							name ="cekscore"
							id="<?php __("CboScore_{$key}_{$id}"); ?>"
							value ="<?php __((isset($ComboScoring,$QtyScoring[$key]['point'][$id])?$QtyScoring[$key]['point'][$id]:'0'));?>"
							onClick ="javascript:handleScore(this);" 
							<?php __(($QtyScoring[$key]['point'][$id])?"checked='true'":"");?> >
					</td>
				</tr>
				<?php  } ?>
				<tr class="onselect">
					<td class=" left" colspan="3">
						
						<div width="100%" align="right" style="margin:5px 0px 5px 0px;">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td class="text_caption">&nbsp;</td>
									<td></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption">Total Score</td>
									<td><?php __(form()->input("TotalScore_".$key,"input_text",(INT)$QtyScoring[$key]['total1'],null,
										array('readonly' => true,'style'=>'width:30px;text-align:center;')));?></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption">Entahlah</td>
									<td><?php __(form()->input("TotalScore2_".$key,"input_text",(INT)$QtyScoring[$key]['total1'],null,
										array('readonly' => true,'style'=>'width:30px;text-align:center;')));?></td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
			
			<?php } ?>
	
		<div> 
			<table>
				<tr>
					<td class="text_caption">Remarks</td>
					<td><?php __(form()->textarea('remarks', 'textarea',$QtyScoring['remarks'], 
						array("keyup" =>"Ext.Cmp('call_remarksb').setValue(this.value);"), array('style'=>'color:blue;height:70px;width:750px;')));?>  </td>
				</tr>	
			</table>
		</div>
		
			</form>
	</fieldset>
</div>