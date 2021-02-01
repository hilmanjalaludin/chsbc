<?php
/*
 * E.U.I 
 *
 * subject	: view_core_nav ( files )
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */

//echo javascript();
?>

<!-- start : layout add campaign -->
<?php get_view(array("set_campaign","view_campaign_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit Target");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Edit"),"fa-edit");?>
		<form name="frm_campaign_target">
			<?php echo form() -> hidden('CampaignId',"select",$Campaign['CampaignId']) ; ?>
			<div class="ui-widget-form-table">	
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('CampaignName', 'input_text superlong',$Campaign['CampaignName'], null); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Contact Rate'));?> (%) </div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target1', 'input_text superlong',$Target['Target1'], null); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array(' Convertion Rate 1'));?> (%) </div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target4', 'input_text superlong', $Target['Target4'],null ); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Convertion Rate 2'));?> (%) </div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target7', 'input_text superlong',$Target['Target7'],null); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Cases Submit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target2', 'input_text superlong',$Target['Target2'],null ); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('ANP Submit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target5', 'input_text superlong',$Target['Target5'],null); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('AARP Submit'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input('target8', 'input_text superlong', $Target['Target8'],null); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"></div>
					<div class="ui-widget-form-cell text_caption center"></div>
					<div class="ui-widget-form-cell"><?php echo form()->button('btnTarget', 'button update', lang('Update'), array('click'=>'Ext.DOM.SaveTarget();')); ?></div>
				</div>
			</div>
		</fieldset>
	</div>

</div>
