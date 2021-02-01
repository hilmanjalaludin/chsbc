<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */

if( !function_exists('disabled') ) 
{
	function disabled()  
 {
	$arr_hwndle = (int)_get_session('HandlingType');
	$arr_except = array( USER_ROOT, USER_AGENT_INBOUND, USER_AGENT_OUTBOUND, USER_LEADER, USER_SUPERVISOR,QUALITY_APPROVE,QUALITY_SCORES);
	if( !in_array($arr_hwndle, $arr_except) ) {
		$arr_style = "button_disabled";
	}
	return (string)$arr_style;	
 }
 
}

//$class_disabled = disabled();
$class_disabled = '';
?>
<div class="ui-widget-form-table-compact">
	<?php echo form()->button("button_exit","button cancel", lang("Exit Data Entry"), array("click" => "SetEventExit();") );?>
	<?php echo form()->button("button_save","button save $class_disabled", lang("Save Data Entry"), array("click" => "SetEventSubmit();") );?>
</div>