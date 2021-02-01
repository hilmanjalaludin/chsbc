<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @ def    : include benefit of product 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
echo javascript(array( 
	array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time())
));
?>

<?php get_view(array('mod_approval_phone','approve_content_javascript'));?>
<?php echo form()->hidden("ControllerId", null, _get_post("ControllerId"));?>
<div id="ui-content-tab-data">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-content-detail">
				<span class="ui-icon ui-icon-person"></span> <?php echo lang("Approval Detail")?>
			</a>
		</li>
	</ul>
	
	<div id="ui-widget-content-detail">
		<table width="100%" cellspacing="0">
			<tr>
				<td width="40%" class="ui-widget-content-top" align="left" style="padding-right:5px;"><?php get_view(array('mod_approval_phone','approve_default_phone'));?></td>
				<td width="60%" class="ui-widget-content-top" align="left" style="padding-left:5px;"><?php get_view(array('mod_approval_phone','approve_history_phone'));?></td>
			</tr>
		</table>
	</div>
</div>
	
