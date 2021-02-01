<?php get_view(array("sys_user","view_user_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("User Detail");?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	<?php echo form()->hidden("is_home",null, 1);?>
	<fieldset class="corner ui-widget-fieldset" style="margin-top:10px 0px 10px 0px;padding:10px 20px 25px 5px;border-radius:5px;">
	<?php echo form()->legend(lang( array( strtoupper(_get_session('Username')), "(",  _get_session('Fullname'), ")") ),"fa-user");?>
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">* UserId </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"> <?php echo form()-> input('userid', 'input_text superlong cell-disabled',$row->get_value('Username'));?> </div>
			</div>
					
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Fullname </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->input('fullname','input_text superlong cell-disabled',$row->get_value('full_name'));?></div>
			</div>
					
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Code User </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->input('textAgentcode','input_text superlong cell-disabled',$row->get_value('code_user'));?></div>
			</div>
								
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Password </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->password('password','input_text superlong cell-disabled',$row->get_value('password'));?></div>
			</div>
								
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Re - Type Password </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->password('repassword','input_text superlong cell-disabled',$row->get_value('password'));?></div>
			</div>
					
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Previleges </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('profile','select superlong cell-disabled', $User -> _get_handling_type(), $row->get_value('handling_type'), NULL);?></div>
			</div>
		</div>
				
		<!--- Form detail additional -->
		
		<div class="ui-widget-form-table ">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">System Supervisor</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('team_leader','select superlong cell-disabled', $User -> _get_teamleader(), $row->get_value('tl_id'), NULL);?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">System ATM</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_spv','select superlong cell-disabled', $User -> _get_supervisor(), $row->get_value('spv_id'), NULL);?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">System Manager</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_mgr','select superlong cell-disabled', $User -> _get_manager(), $row->get_value('mgr_id') );?></div>
			</div>
								
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Account Manager</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('account_manager','select superlong cell-disabled', $User -> _get_account_manager(), $row->get_value('act_mgr') );?></div>
			</div>
								
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">System Admin</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_admin','select superlong cell-disabled', $User -> _get_admin(), $row->get_value('admin_id') );?></div>
			</div>
			
		</div>
				
		<!--- Form detail additional -->
		
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Quality Head</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('quality_head','select superlong cell-disabled', $User -> _get_quality_head(), $row->get_value('quality_id') );?></div>
			</div>
			
			<div class="ui-widget-form-row">				
				<div class="ui-widget-form-cell text_caption">CC Group </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('cc_group','select superlong cell-disabled', $User -> _get_agent_group(), $row->get_value('agent_group') );?></div>
			</div>
			
			<div class="ui-widget-form-row">				
				<div class="ui-widget-form-cell text_caption">User Skill </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_skill','select superlong cell-disabled', $User -> _get_agent_group(), $row->get_value('full_name') );?></div>
			</div>

			<div class="ui-widget-form-row">				
				<div class="ui-widget-form-cell text_caption">Telphone</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_telphone','select superlong cell-disabled', $User -> _get_telephone(), $row->get_value('telphone'));?></div>
			</div>
					
			<div class="ui-widget-form-row">				
				<div class="ui-widget-form-cell text_caption">User Active</div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('user_active','select superlong cell-disabled', $User -> _get_telephone(), $row->get_value('user_state'));?></div>
			</div>
		</div>
		
		</fieldset>	
	</div>
</div>


<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php