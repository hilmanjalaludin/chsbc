<?php get_view(array("sys_user","view_user_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Edit User");?> </a>
		</li>
	</ul>	
	
	<!-- start -->
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<?php echo form()->hidden("is_home",null, 0);?>
		<form name="frmEditUser">
			<?php echo form()->hidden("where_id",null,$row->get_value('UserId'));?>
			<?php echo form()->hidden("where_pwd",null,$row->get_value('password'));?>
			<div class="ui-widget-form-table-compact">	
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell ui-widget-content-top left" style="width:1%;">
						<?php get_view(array("sys_user","view_user_profile"));?>
						<?php get_view(array("sys_user","view_user_privileges"));?>
					</div>
					<div class="ui-widget-form-cell ui-widget-content-top left" style="width:50%;">
						<?php get_view(array("sys_user","view_user_additional"));?>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- END OF FILE -->
<!-- location : ./application/view/user/view_add_user.php