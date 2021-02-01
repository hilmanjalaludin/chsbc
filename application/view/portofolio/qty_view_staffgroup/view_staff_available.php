<div style='margin:5px 5px 5px 5px;' >
	<?php foreach($view_staff_available as $UserId => $quality_staff ) : ?>
		<div class="ui-widget-form-table" style="color:red;width:200px;border-radius:5px;background-color:#fffcfd;border:1px solid #ddd;height:20px;margin:6px 4px 6px 4px; padding:8px 8px 8px 8px;float:left;">
			<span><?php __(form() -> checkbox('QualityStaffId',null,$UserId))?></span>
			<span><?php __($quality_staff); ?></span>
		</div>
	<?php endforeach; ?>	
</div>


<fieldset class="corner " style="width:98%;margin:20px 0px 10px 3px; padding-left:8px; border-radius:5px;">
	<?php __(form() -> button('import_user','button assign', '&nbsp;Check All', array("click" =>"Ext.Cmp('QualityStaffId').setChecked();")))?>
	<?php __(form() -> button('import_user','button add', '&nbsp;Add Staff', array("click" =>"Ext.DOM.AddAvailableGroup();" )))?>		
</fieldset>
