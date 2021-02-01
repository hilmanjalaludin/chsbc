<fieldset class="corner " style="width:100%;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang("Agent Available"),"fa-users");?>
<!-- filter -->
	
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:0px 8px 0px 8px;border-radius:5px;">
		<div class='ui-widget-form-table-compact' >
			<form name="frmSetAgent">
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang("Supervisor");?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->combo("key_leader_id", "select superlong xzselect", Leader() );?></div>
					<div class="ui-widget-form-cell"><?php echo form() -> checkbox('agent_state_grid',null,1,array("change" =>"Ext.DOM.OpenAgentGrid(this);"));?><?php echo lang("Open All Grid");?></div>
					
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang("Agent Name");?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell"><?php echo form()->input("key_agent_name", "input_text superlong");?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"> </div>
					<div class="ui-widget-form-cell text_caption center"> </div>
					<div class="ui-widget-form-cell"><?php echo form()->button("button_keyword", "button search",lang("Search"), array("click" => "Ext.DOM.SearchSetAgent();") );?></div>
				</div>
			</form>
		</div>
	</fieldset>
	
	<!-- filter -->
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:8px 8px 8px 8px;border-radius:5px;">	
		<div class="ui-widget-form-table-compact " id="ui-quality-agent-state" style="height:500px;width:99%;margin:0px 5px 0px 5px;">
	</fieldset>
	
	<fieldset class="corner ui-widget-fieldset" style="margin:0px 5px 10px 5px; padding:8px 8px 8px 8px;border-radius:5px;">	
		<div class="ui-widget-table-form-compact"> <?php echo form()->button('import_user','button add', 'Add To Bucket Quality', 
			array("click" =>"Ext.DOM.AddAvailableAgent();" ));?></div>
		
	</fieldset>
	
</fieldset>
