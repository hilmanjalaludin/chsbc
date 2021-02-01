<?php get_view(array("sys_user","view_user_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-locked"></span><?php echo lang("Change Password");?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	<?php echo form()->hidden("is_home",null, 1);?>
	<fieldset class="corner ui-widget-fieldset" style="margin-top:10px 0px 10px 0px;padding:10px 20px 25px 5px;border-radius:5px;">
	 <?php echo form()->legend(lang( array( strtoupper(_get_session('Username')), "(",  _get_session('Fullname'), ")") ),"fa-user");?>
		<form name="frmChangePassword">
		<div class="ui-widget-form-table-maximum">
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
				<div class="ui-widget-form-cell text_caption">Agent Code </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->input('textAgentcode','input_text superlong cell-disabled',$row->get_value('full_name'));?></div>
			</div>
						
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"> Old Password </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->password('password','input_text superlong cell-disabled',$row->get_value('password'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"> New Password </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->password('new_password','input_text superlong');?></div>
			</div>
						
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Re - Type Password </div>
				<div class="ui-widget-form-cell">:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->password('renew_password','input_text superlong');?></div>
			</div>
			
			<div class="ui-widget-form-row">				
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell"> </div>
				<div class="ui-widget-form-cell"><?php echo $action; ?></div>
			</div>
		</div>
		</form>
	</fieldset>	
 </div>
</div>


<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php