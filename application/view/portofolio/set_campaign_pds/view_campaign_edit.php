<!-- start : layout add campaign -->
<?php get_view(array("set_campaign_pds","view_campaign_jsv"));?>
<?php get_view(array("set_campaign_pds","view_campaign_chosen"));?>
<?php
	function defineHour(){
		$i=7;
		for($i;$i<=21;$i++){
			if($i<=9){
				$hour["0".$i.":00"] = "0".$i.":00";
				$hour["0".$i.":30"] = "0".$i.":30";
			}else{
				$hour[$i.":00"] = $i.":00";
				$hour[$i.":30"] = $i.":30";
			}
		}
		
		return $hour;
	}
?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Campaign PDS");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	 <fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Edit"),"fa-edit");?>
		<form name="frm_edit_campaign_pds">
			<?php echo form()->hidden('CampaignId', null ,$row->get_value('CampaignId') );?>
			<div class="ui-widget-form-table">	
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Number'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> input("CampaignNumber","input_text superlong", $row->get_value('CampaignNumber'), NULL, array('disabled' => true) ); ?></div>
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Wait (sec)'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallWait', 'input_text superlong', $row->get_value('CallWait') ); ?>(in second)</div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignName', 'input_text superlong', $row->get_value('CampaignName')); ?></div>
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Limit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("CampaignCallLimit","input_text superlong", $row->get_value('CallLimit'), NULL, NULL); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Code'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> input('CampaignCode','input_text superlong', $row->get_value('CampaignCode')); ?></div>
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Factor'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallFactor','input_text superlong', $row->get_value('CallFactor') ); ?>(e.g:1; 1.5; 2; etc)</div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Campaign Group'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">
						<?php 
							// $group_list = ATMLeader();
							$group_list = AvailalblePDSGroup($row->get_value('CcGroup'));
							// if( _get_session('HandlingType') ==  USER_SUPERVISOR ) {
								// $group_list = array(_get_session('UserId')=>$group_list[_get_session('UserId')]);
							// }
							// echo form()->combo('GroupCampaign', 'textarea superlong',$group_list, $GroupList, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); 
							echo form()->combo('ListGroupCampaign', 'textarea superlong',$group_list, $row->get_value('CcGroup')); 
						?>
					</div>
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Retry After'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallRetryAfter', 'input_text superlong',  $row->get_value('CallRetryAfter')); ?></div>
					
					<div class="ui-widget-form-cell text_caption">
						<!-- input type="button" value=">>" Onclick="Ext.DOM.Group().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.Group().Delete();" -->
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell">
						<?php //echo form()->combo('ListGroupCampaign','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?>
					</div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Interval'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">
					<?php	$startDate = explode(" ",$row->get_value('CampaignStartDate'));
							$endDate = explode(" ",$row->get_value('CampaignEndDate'));
							
							$StartDate = explode("-",$startDate[0]);
							$StartDate = $StartDate[2]."-".$StartDate[1]."-".$StartDate[0];
							$StartTime = explode(":",$startDate[1]);
							$StartTime = $StartTime[0].":".$StartTime[1];
							$EndTime = explode(":",$endDate[1]);
							$EndTime = $EndTime[0].":".$EndTime[1];
							
					?>
						<?php echo form() -> input('StartDate', 'input_text box', $StartDate); ?>&nbsp;<?php echo form() -> combo('StartTime', 'select',defineHour(),$StartTime); ?> to 
						<?php echo form() -> combo('EndTime', 'select',defineHour(),$EndTime); ?>
					</div>
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Retry Max'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallRetry', 'input_text superlong', $row->get_value('CallRetryMax')); ?></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Status'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo("StatusActive","select superlong",Flags(),$row->get_value('CampaignStatusFlag')); ?></div>
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Max Abandon Rate'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignAbandonRate', 'input_text superlong', $row->get_value('CallAbandonRate') ); ?>(e.g: 0.1; 0.2; etc)</div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"><br></div>
					<div class="ui-widget-form-cell"></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Preference'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('CampaignCallPrefarance', 'textarea superlong',array(
							'1' => 'Mobile Phone',
							'2' => 'Home Phone',
							'3' => 'Work Phone'
						),$CallPreList, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); ?> </div>
					<!-- <?php #print_r($CallPreList); ?> -->
						
					<div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.CampaignCallPrefarances().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.CampaignCallPrefarances().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell">
						<?php echo form() -> combo('ListCampaignCallPrefarance','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('SPV'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->listCombo("CampaignSpvPds","select superlong",$ListSPV,$ListedSPV); ?></div>

					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">&nbsp;</div>
				</div>
				
				<!-- div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?#php echo lang("SPV List");?></div>
					<div class="ui-widget-form-cell text_caption">:</div>
					<div class="ui-widget-form-cell"><?#php echo form()->combo("CampaignSPVList", "select tolong",null,$row->get_value('SPVGroup'));?></div>
					
					<div class="ui-widget-form-cell text_caption"><?#php echo lang("TMR List");?></div>
					<div class="ui-widget-form-cell text_caption">:</div>
					<div class="ui-widget-form-cell"><div id="CampaignTMRListBySPV"></div></div>
				</div -->
				
				<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell text_caption center"></div>
						<div class="ui-widget-form-cell"> <?php echo form()->button("btnUpdate", "button update", lang(array("Update")), array("click" => "Ext.DOM.UpdatePds();") );?></div>
				</div>
			</div>
		</form>
	 </fieldset>
	</div>
</div>
