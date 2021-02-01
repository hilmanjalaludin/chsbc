<div class="ui-widget-form-table">	
<fieldset class="corner ui-widget-fieldset" style="margin-top:5px;width:95%;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Privilege"),"fa-key");?>

	<div class="ui-widget-form-table-maximum">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Previleges </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('profile','select superlong disable_user', $User -> _get_handling_type(), $row->get_value('handling_type'), array('change'=>"changePrevileges($(this));") );?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">System Supervisor</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('team_leader','select superlong disable_user', $User -> _get_teamleader(), $row->get_value('tl_id'), NULL);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">System ATM</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_spv','select superlong disable_user', $User -> _get_supervisor(), $row->get_value('spv_id'), NULL);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell">System Manager</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_mgr','select superlong disable_user', $User -> _get_manager(), $row->get_value('mgr_id') );?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Account Manager</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('account_manager','select superlong disable_user', $User -> _get_account_manager(), $row->get_value('act_mgr') );?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">System Admin</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_admin','select superlong disable_user', $User -> _get_admin(), $row->get_value('admin_id') );?></div>
		</div>
	</div>
</fieldset>
</div>