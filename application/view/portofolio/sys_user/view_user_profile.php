<div class="ui-widget-form-table">
<fieldset class="corner ui-widget-fieldset" style="margin-top:-5px;padding:5px 20px 15px 5px;border-radius:5px;">
<?php echo form()->legend(lang("Profile"),"fa-gear");?>
	<div class="ui-widget-form-table-maximum">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">* UserId </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()-> input('userid', 'input_text superlong',$row->get_value('Username'));?> </div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Fullname </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->input('fullname','input_text superlong',$row->get_value('full_name'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Code User</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->input('textAgentcode','input_text superlong',$row->get_value('code_user'));?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Password </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->password('password','input_text superlong',$row->get_value('password'));?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Re - Type Password </div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->password('repassword','input_text superlong',$row->get_value('password'));?></div>
		</div>
	</div>
</fieldset>
</div>