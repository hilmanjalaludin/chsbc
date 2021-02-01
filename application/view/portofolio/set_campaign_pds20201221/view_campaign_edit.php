<!-- start : layout add campaign -->
<?php get_view(array("set_campaign_pds","view_campaign_jsv"));?>
<?php get_view(array("set_campaign_pds","view_campaign_chosen"));?>

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
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignName', 'input_text superlong', $row->get_value('CampaignName')); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Code'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> input('CampaignCode','input_text superlong', $row->get_value('CampaignCode')); ?></div>
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Desc'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignDesc', 'input_text superlong', $row->get_value('CampaignDesc')); ?></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Group'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">
						<?php 
							$group_list = ATMLeader();
							if( _get_session('HandlingType') ==  USER_SUPERVISOR ) {
								$group_list = array(_get_session('UserId')=>$group_list[_get_session('UserId')]);
							}
							echo form()->combo('GroupCampaign', 'textarea superlong',$group_list, $GroupList, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); 
						?>
					</div>

					<div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.Group().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.Group().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell">
						<?php echo form()->combo('ListGroupCampaign','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?>
					</div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Limit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("CampaignCallLimit","input_text superlong", $row->get_value('CallLimit'), NULL, NULL); ?></div>

					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Auto ACW'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignAutoAcw', 'input_text superlong'); ?></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Factor'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallFactor','input_text superlong', $row->get_value('CallFactor') ); ?></div>

					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Abandon Rate'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignAbandonRate', 'input_text superlong', $row->get_value('CallAbandonRate') ); ?></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Wait'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallWait', 'input_text superlong', $row->get_value('CallWait') ); ?></div>

					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Retry'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignCallRetry', 'input_text superlong'); ?></div>
				</div>

				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Call Prefarance'));?></div>
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
					<div class="ui-widget-form-cell text_caption">* <?php echo lang(array('Status Active'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo("StatusActive","select superlong",Flags(),$row->get_value('CampaignStatusFlag')); ?></div>

					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell text_caption center"></div>
						<div class="ui-widget-form-cell"> <?php echo form()->button("btnUpdate", "button update", lang(array("Update")), array("click" => "Ext.DOM.UpdatePds();") );?></div>
					</div>
				</div>
				
				<!-- 
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('ProductId', 'textarea superlong',Product(), $ProductList, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); ?> </div>	
					<div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.Product().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.Product().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('ListProduct','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Interval'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell">
					<?php echo form()->input('StartDate', 'input_text box', $row->get_value('CampaignStartDate','_getDateIndonesia')); ?> 
					<?php echo lang("to");?> 
					<?php echo form()->input('ExpiredDate', 'input_text box', $row->get_value('CampaignEndDate','_getDateIndonesia')); ?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Payment Chanel'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('PaymentChannel', 'textarea superlong',PaymentType(), $PaymentList, NULL,array('style'=>'height:100px;color:red;','multiple'=>true)); ?> </div>
					<div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.PaymentChannel().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.PaymentChannel().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell">
						<?php echo form() -> combo('ListPaymentChannel','textarea superlong',array(),null, null,array('style'=>'height:100px;color:red;','multiple'=>true)); ?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Outbound / Inbound'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo("OutboundGoalsId","select superlong", CallDirection(), '2', array('change'=>'getDirect(this);')); ?></div>
					
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Method'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('DirectMethod', 'select superlong', MethodeAction(),$row->get_value('DirectMethod'),array('change'=>'getMethod(this);'),array('length'=> '12', 'disabled' => true)); ?></div>
				</div>				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Source Campaign'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('AvailCampaignId', 'select superlong', CampaignAvailable(2) , $row->get_value('AvailCampaignId') ,null,array('length'=> '12', 'disabled' => true)); ?></div>
					<div class="ui-widget-form-cell text_caption"> * <?php echo lang(array('Action'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('DirectAction', 'select superlong',DirectAction(),1, null, array('length'=> '12', 'disabled' => true)); ?></div>
				</div> -->
				
				
			</div>
		</form>
	 </fieldset>
	</div>
</div>