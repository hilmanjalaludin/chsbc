<script type="text/javascript">
var _collection = [];
var _attributes = [];
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
Ext.DOM.handleScore = function(obj)
{
	var total = 0;
	var arr = obj.id.split('_');
	var key = arr[1];
		
 /* is checked di set.value = 1, set.value = 0 **/
 	
	/* var _elem = Ext.Cmp(i).getElementId(); */
	
	var check = Ext.Serialize('frmScoring').getChecked();
	
	for(var i in check)
	{
		var arr_cmp = i.split('_');
		
		if(arr_cmp[1] == key)
		{
			if(Ext.Cmp(i).Checked)
			{
				total += parseInt(Ext.Cmp(i).getValue());
			}
		}
	}
	/* var select = Ext.Cmp("cekscore").getName();
	
	if( obj.checked )  obj.value = 1;
	else
		obj.value = 0;
	
	for( var c = 0; c < select.length; c++ )  
	{
	  _attributes[c]= select[c].id;
	  
		if( select[c].checked ) 
		{
			var arr_cmp = select[c].id.split('_');
			if(arr_cmp[1] == key) {
				_collection[select[c].id] = 1; 
				Ext.Cmp(select[c].id).setValue(1);
				total = (parseInt(total)+1);
			}
		}
		else{
			_collection[select[c].id] = 0;
		}
	} */	
	
	Ext.Cmp('TotalScore_'+key).setValue(total);
	( total > 2 ? Ext.Cmp('TotalScore2_'+key).setValue(2) : Ext.Cmp('TotalScore2_'+key).setValue(total) );
	
	if(Ext.DOM.CheckFatal())
	{
		Ext.Cmp('FinalScore').setValue(40);
	}
	else{
		Ext.DOM.CountFinalScore();
	}
	
	total = 0;
}

Ext.DOM.CheckFatal = function()
{
	var conds = false;
	var check = Ext.Serialize('frmScoring').getChecked();
	
	for(var i in check)
	{
		var cls = Ext.Cmp(i).getElementId();
		
		if(cls.className == 'fatal')
		{
			if(cls.checked)
			{
				conds = true;
				break;
			}
		}
	}
	
	return conds;
}

/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */	
 
Ext.DOM.CountFinalScore = function()
{
	var score = 0;
	var total = 0;
	var input = Ext.Serialize('frmScoring').getInput();
	
	for(var i in input)
	{
		var cmp = i.split('_');
		
		if(cmp[0] == 'TotalScore2')
		{
			if(Ext.Cmp(i).getValue() != '')
			{
				total += parseInt(Ext.Cmp(i).getValue());
			}
		}
	}
	
	score = 100-(10*total);
	
	(score<40?Ext.Cmp('FinalScore').setValue(40):Ext.Cmp('FinalScore').setValue(score));
	
	score = 0;
	total = 0;
}

Ext.document().ready(function()
{
	if(Ext.DOM.CheckFatal())
	{
		Ext.Cmp('FinalScore').setValue(40);
	}
	else{
		Ext.DOM.CountFinalScore();
	}
});
</script>

<div id="div_score">
<fieldset class="corner" style='border:0px solid #000;'>
		
		<form name="frmScoring">
		<?php __(form()->input('FinalScore', null, 100));?>
		<?php
			$no = 0;
			if( isset($QualityScoring['Category'])) 
			foreach($QualityScoring['Category'] as $key => $category)  { $no++; ?>
			
			<table class="custom-grid" style='border:0px solid #dddddd;' 
				cellspacing='0' cellpadding='0' width='99%' align='center'> 
				<tr>
					<td class="ui-corner-top ui-state-default " colspan="3">
						<span color="red" class="icon-product product-title-icon" 
						style="padding:2px 0px 2px 16px;">&nbsp;&nbsp;:: <?php __($no.'. '.$category); ?></span></td>
				</tr>
				<?php 
				foreach($QualityScoring['SubCategory'][$key] as $id => $value) { ?>
				<tr class="onselect">
					<td class="content-first text_caption bottom center" <?php __( ($value['ScoringFatality']?'style="color:red;"':'') ); ?>><?php __($value['ScoringQuestionNo']); ?>.</td>
					<td class="content-middle text_caption bottom" <?php __( ($value['ScoringFatality']?'style="color:red;"':'') ); ?>><div align="left" style="width:550px;"><?php __($value['ScoringQuestion']); ?></div></td>
					<td class="content-lasted bottom">
						<?php __( form()->checkbox("CboScore_".$key."_".$id,($value['ScoringFatality']?'fatal':''),1,array('click'=>"javascript:handleScore(this);"),($QtyScoring[$key]['point'][$id]?array('checked'=>true):null) ) ); /* checkbox */ ?>
						<!--<input 
							type ="checkbox" 
							name ="cekscore"
							class="<#?php __( ($value['ScoringFatality']?'fatal':'') ); ?>"
							id="<#?php __("CboScore_{$key}_{$id}"); ?>"
							value ="1"
							onClick ="javascript:handleScore(this);" 
							<#?php __(($QtyScoring[$key]['point'][$id])?"checked='true'":"");?> >-->
					</td>
				</tr>
				<?php  } ?>
				<tr class="onselect">
					<td class="bottom left" colspan="3">
						<div width="100%" align="right">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td class="text_caption">&nbsp;</td>
									<td></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption">Bruto Score</td>
									<td><?php __(form()->input("TotalScore_".$key,"input_text",(INT)$QtyScoring[$key]['total1'],null,
										array('readonly' => true,'style'=>'width:30px;text-align:center;')));?></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption">Netto</td>
									<td><?php __(form()->input("TotalScore2_".$key,"entahlah input_text",(INT)$QtyScoring[$key]['total2'],null,
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