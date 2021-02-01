<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang("Option"),"fa-gear");?>
	<form name="frmDistOption">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Action");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("dis_user_action", DistribusiAction(), null, array("change" =>"Ext.Cmp('dis_user_action').oneChecked(this);ActionCheckDist(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Total Data");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("dis_user_total", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Quantity");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("dis_user_quantity", "input_text tolong");?></div>
		</div>
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Type");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_type", "select tolong", DistribusiType(), null);?></div>
		</div> -->
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("User Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_group", "select tolong", DitributeUserLevel(), null, array("change" => "Ext.DOM.SelectUserDistByGroup(this);") );?></div>
		</div> -->
		
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("User List");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_list", "select tolong");?></div>
		</div> -->
		
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Dist. Mode");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_user_mode", "select tolong", DitributeMode());?></div>
		</div> -->
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnDistData", "button assign",lang("Submit To PDS"), array("click" => "Ext.DOM.SubmitDistribute();"));?></div>
		</div>
	</div>
	</form>
</fieldset>