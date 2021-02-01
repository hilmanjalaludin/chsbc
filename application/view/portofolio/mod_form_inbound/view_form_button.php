<?php
	$Button=& get_instance();
	$Button->load->model('M_Combo');
	$gButton = $Button->M_Combo->_getCallResultInbound();
	if( is_array( $gButton ) )
		foreach( $gButton as $keys => $_button ) {
			echo "<div class=\"ui-widget-form-table\" style=\"margin-top:-2px;margin-left:-2px;\">". form()->button("$keys",'save button',"&nbsp;$_button", array("click" => "Ext.DOM.SaveData(this.id);")) ."</div>";
	}
?>	
