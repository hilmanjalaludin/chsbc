<div class="ui-widget-form-table-compact">
<fieldset class="corner ui-widget-fieldset" style="margin-top:-5px;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Additional"),"fa-gear");?>

	<div class="ui-widget-form-table-maximum">
	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Quality Head</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('quality_head','select superlong', $User -> _get_quality_head(), $row->get_value('quality_id') );?></div>
		</div>

		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">CC Group </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('cc_group','select superlong', $User -> _get_agent_group(), $row->get_value('agent_group'), null, array('disabled'=>'disabled') );?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">User Skill </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_skill','select superlong', CtiSkill(), $row->get_value('user_skill') );?></div>
		</div>

		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">Telphone</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_telphone','select superlong', $User -> _get_telephone(), $row->get_value('telphone'));?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption">User Active</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_active','select superlong', $User -> _get_telephone(), $row->get_value('user_state'));?></div>
		</div>
		
		<div class="ui-widget-form-row">				
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"> </div>
			<div class="ui-widget-form-cell"><?php echo $action; ?></div>
		</div>
		
		
	</div>
</fieldset>
</div>