<!-- start : layout add campaign -->
<?php get_view(array("set_agent_pds","view_campaign_jsv"));?>
<?php get_view(array("set_agent_pds","view_campaign_chosen"));?>

<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Assign Agent to PDS Group");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	 <fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Form"),"fa-edit");?>
		<form name="frm_assign_agent_pds">
			<?php echo form()->hidden('GroupId', null ,$row->get_value('GroupId') );?>
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell text_caption center">Assign Agent</div>
						
					<div class="ui-widget-form-cell text_caption center">To</div>
					<div class="ui-widget-form-cell "></div>
					<div class="ui-widget-form-cell text_caption center">PDS <?php echo $row->get_value('GroupCode'); ?> (<?php echo $row->get_value('CampaignName'); ?>)
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php echo form() -> combo('CampaignCallPrefarance', 'textarea superlong',$GroupList,$CallPreList, NULL,array('style'=>'height:500px;color:red;','multiple'=>true)); ?> </div>
					<!-- ? #php print_r($CallPreList); ? -->
						
					<div class="ui-widget-form-cell text_caption">
						<input type="button" value=">>" Onclick="Ext.DOM.CampaignCallPrefarances().Entry();" ><br>
						<input type="button" value="<<" Onclick="Ext.DOM.CampaignCallPrefarances().Delete();">	
					</div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell">
						<?php echo form() -> combo('ListCampaignCallPrefarance','textarea superlong',array(),null, null,array('style'=>'height:500px;color:red;','multiple'=>true)); ?>
					</div>
				</div>

				<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell text_caption center"></div>
						<div class="ui-widget-form-cell"> <?php echo form()->button("btnUpdate", "button update", lang(array("Assign Agent")), array("click" => "Ext.DOM.AssignAgentToPDSGRoup();") );?></div>
				</div>
			</div>
		</form>
	 </fieldset>
	</div>
</div>
