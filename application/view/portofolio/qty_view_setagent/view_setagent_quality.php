<fieldset class="corner " style="width:99%;margin:5px 5px 5px 25px; border-radius:5px;">
<?php echo form()->legend(lang("Quality Staff Ready"),"fa-users");?>
	
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:0px 8px 0px 8px;border-radius:5px;">
		<form name="frmSetQuality">
				<div class='ui-widget-form-table-compact'>
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Quality Staff");?></div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo("quality_staff_id", "select tolong xzselect",QualityAllStaff() );?></div>
						<div class="ui-widget-form-cell"><?php echo form() -> checkbox('hidden_ready',null,1,array("change" =>"Ext.DOM.IsHide(this);"));?><?php echo lang("Hide Staff Is Ready");?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Agent Name");?></div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->input("key_agent_name", "input_text tolong");?></div>
						<div class="ui-widget-form-cell"><?php echo form() -> checkbox('open_quality_grid',null,1,array("change" =>"Ext.DOM.OpenQualityGrid(this);"));?><?php echo lang("Open All Grid");?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"> </div>
						<div class="ui-widget-form-cell text_caption center"> </div>
						<div class="ui-widget-form-cell"> <?php echo form()->button("button_keyword", "button search",lang("Search"), array("click" => "Ext.DOM.SearchSetQuality();") );?></div>
					</div>	
				</div>
			</form>
		
	</fieldset>
	
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:8px 8px 8px 8px;border-radius:5px;">
		<div class="ui-widget-form-table-compact" id="ui-widget-quality-staff" style="height:500px;width:99%;margin:0px 5px 0px 5px;"></div>
	</fieldset>
	
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:8px 8px 8px 8px;border-radius:5px;">
	<div class="ui-widget-form-table-compact">
		<table>
			<tr>
				<td class="text_caption"><?php echo lang(array('Scoring','Staff')); ?>: </td>
				<td><?php echo form() -> combo('QulaityStaffId','select long xzselect', QualityStaffScoreReg());?> </td>
				<td>
					<?php echo form() -> button('UpdateQualityStaff','button add','&nbsp;Update', array("click" =>"Ext.DOM.UpdateQualityAgent();" ));?>
					<?php echo form() -> button('UpdateQualityStaff','button remove','&nbsp;Remove', array("click" =>"Ext.DOM.RemoveQualityAgent();"));?>
					<?php echo form() -> button('UpdateQualityStaff','button clear','&nbsp;Clear', array("click" =>"Ext.DOM.EmptyQualityAgent();" ));?>
				</td>
			</tr>
		</table>
	</div>
	</fieldset>
</fieldset>
