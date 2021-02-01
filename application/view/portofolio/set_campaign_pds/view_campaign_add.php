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
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Campaign PDS");?> </a>
		</li>
	</ul>	
	
	<!-- content ---------->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	  <fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Add"),"fa-plus");?>
		<form name="frm_add_campaign_pds">
		
			<div class="ui-widget-form-table">

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Number'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("CampaignNumber","input_text superlong",date(ymdis), NULL, array('disabled' => true,'style'=>'color:#dddddd;')); ?></div>
					
					<div class="ui-widget-form-cell text_caption">*<?php echo lang(array('Call Wait'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallWait', 'input_text superlong'); ?>&nbsp;(in second)</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignName', 'input_text superlong'); ?></div>
					
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Limit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("CampaignCallLimit","input_text superlong", NULL, NULL, NULL); ?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Code'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCode','input_text superlong'); ?></div>
					
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Factor'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallFactor','input_text superlong'); ?>&nbsp;(e.g:1; 1.5; 2; etc)</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Campaign Group'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">
						<?php 
							// $group_list = ATMLeader();
							$group_list = AvailalblePDSGroup();
							// if( _get_session('HandlingType') ==  USER_SUPERVISOR ) {
								// $group_list = array(_get_session('UserId')=>$group_list[_get_session('UserId')]);
							// }
							// echo form()->combo('GroupCampaign', 'textarea superlong',$group_list); //,NULL, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); 
							echo form()->combo('ListGroupCampaign', 'textarea superlong',$group_list); //,NULL, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); 
						?>
					</div>
					
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Retry After'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallRetryAfter', 'input_text superlong'); ?></div>
					
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
						<?php echo form() -> input('StartDate', 'input_text box'); ?>&nbsp;<?php echo form() -> combo('StartTime', 'select',defineHour()); ?> to 
						<?php echo form() -> combo('EndTime', 'select',defineHour()); ?>
					</div>
					
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Retry Max'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallRetry', 'input_text superlong'); ?></div>
					<!-- <span style="display:none;">
					<div class="ui-widget-form-cell text_caption">* <?#php echo lang(array('Auto ACW'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?#php echo form()->input('CampaignAutoAcw', 'input_text superlong',0); ?></div>
					</span> -->
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Campaign Status'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("StatusActive","select superlong",Flags(),'1'); ?></div>

					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Max Abandon Rate'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignAbandonRate', 'input_text superlong'); ?>&nbsp;(e.g: 0.1; 0.2; etc)</div>
				</div>
				
					<!-- div class="ui-widget-form-cell text_caption"> <?#php echo lang(array('Campaign Desc'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?#php echo form()->input('CampaignDesc', 'input_text superlong'); ?></div -->
					<!-- div class="ui-widget-form-cell text_caption">* <?#php echo lang(array('Auto ACW'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?#php echo form()->input('CampaignAutoAcw', 'input_text superlong'); ?></div>
				</div-->
				
				<!-- <div class="ui-widget-form-row"> -->
					<!-- <div class="ui-widget-form-cell text_caption"><?php #echo lang(array('Product'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo('ProductId', 'textarea superlong',Product(),NULL, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); ?> </div> -->	
					<!-- <div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.Product().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.Product().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo('ListProduct','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?></div> -->
				<!-- </div> -->
				
				
				
				<!-- <div class="ui-widget-form-row"> -->
					<!-- <div class="ui-widget-form-cell text_caption"> * <?php #echo lang(array('Outbound / Inbound'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo("OutboundGoalsId","select superlong",CallDirection(),null,array('change'=>'getDirect(this);')); ?></div>
					 -->
					<!-- <div class="ui-widget-form-cell text_caption"> * <?php #echo lang(array('Method'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo('DirectMethod', 'select superlong', MethodeAction() ,1,array('change'=>'getMethod(this);'),array('length'=> '12', 'disabled' => true)); ?></div> -->
					
				<!-- </div> -->
				
				<!-- <div class="ui-widget-form-row"> -->
					<!-- <div class="ui-widget-form-cell text_caption"> * <?php #echo lang(array('Source Campaign'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo('AvailCampaignId', 'select superlong', CampaignAvailable(2) , null,null,array('length'=> '12', 'disabled' => true)); ?></div> -->

					<!-- <div class="ui-widget-form-cell text_caption"> * <?php #echo lang(array('Action'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php #echo form() -> combo('DirectAction', 'select superlong',DirectAction(),1, null, array('length'=> '12', 'disabled' => true)); ?></div> -->
					
				<!-- </div> -->
				
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
						),NULL, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); ?> </div>
						
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
					<div class="ui-widget-form-cell"><?php echo form()->listCombo("CampaignSpvPds","select superlong",$ListSPV,'1'); ?></div>

					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">&nbsp;</div>
				</div>
				
				<!-- div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?#php echo lang("SPV List");?></div>
					<div class="ui-widget-form-cell text_caption">:</div>
					<div class="ui-widget-form-cell"><?#php echo form()->combo("CampaignSPVList", "select tolong");?></div>
					
					<div class="ui-widget-form-cell text_caption"><?#php echo lang("TMR List");?></div>
					<div class="ui-widget-form-cell text_caption">:</div>
					<div class="ui-widget-form-cell"><div id="CampaignTMRListBySPV"></div></div>
				</div -->

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"> <?php echo form()->button("btnSave", "button save", lang(array("Save")), array("click" => "Ext.DOM.Submit();") );?></div>
				</div>
				
				<!-- div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"><br></div>
					<div class="ui-widget-form-cell"></div>
				</div>
				
				<div class="ui-widget-form-row">
					Notes: Campaign Group adalah Unique jika sudah digunakan Campaign Group tidak akan tampil dalam list dan tidak bisa create Campaign Baru<br>
					<!--div class="ui-widget-form-cell text_caption center"><br></div>
					<div class="ui-widget-form-cell"></div>
				</div -->
			</div>
		</form>
	 </fieldset>
	</div>
</div>
