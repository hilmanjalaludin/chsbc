<?php 
// ----------------------------------------------------
get_view(array("mod_chat_with","view_user_chat_header"));
// ----------------------------------------------------

$this->load->helpers("EUI_Object");

echo " <fieldset class=\"corner\" style=\"margin:4px;border-radius:5px;\"> ".
	form()->legend(lang("Chat With"), "fa-comment").
	
"<div class=\"page-wrapper\">".
	"<div class=\"ui-widget-form-table table-body-content\">".
		"<div class=\"ui-widget-form-row ui-widget-header table-row-header\">".
			"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\">". lang("User ID") ."</div>".
			"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\">". lang("User Name") ."</div>".
			"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\">". lang("Privileges") ."</div>".
			"<div class=\"ui-widget-form-cell ui-corner-top table-cell-header left\">". lang("Status") ."</div>".
		"</div>";
if( is_array($row) ) 


			foreach( $row as $key => $val )
			{
			$raw=& new EUI_Object($val);
			
			$style = ( $raw->get_value('IsStatus')==1 ? 
					"<span style=\"color:green;font-weight:bold;\">{$raw->get_value('IsOnline')}</span>" :  
					"<span style=\"color:silver;font-weight:bold;\">{$raw->get_value('IsOnline')}</span>" );
							
			$row_select = ( ( $num %2 == 0 ) ? "table-cell-selcted-one" : "table-cell-selcted-two" );
			echo "<div class=\"ui-widget-form-row $row_select onselect\">".
						"<div class=\"ui-widget-form-cell table-cell-content left\">".
							"<a href=\"javascript:void(0);\" class=\"ui-user-chat\" 
								onclick=\"window.opener.chatWith({
									UserId : '{$val[Username]}',
									UserName : '{$val[Fullname]}'
								});\" title=\"click here for chat with user\">".  $raw->get_value('Username', 'strtoupper') ."</a></div>".
						"<div class=\"ui-widget-form-cell table-cell-content left\">".  $raw->get_value('Fullname', 'strtoupper') ."</div>".
						"<div class=\"ui-widget-form-cell table-cell-content left\">".  $raw->get_value('profileid', 'strtoupper') ."</div>".
						"<div class=\"ui-widget-form-cell table-cell-content left\">".  $raw->get_value('LoginStatus', 'strtoupper') ."</div>".
						
					"</div>";
					$num++;
			}
	

echo "</div>
	</div> </fieldset>";

// -------------------------------------------------------------------
get_view(array("mod_chat_with","view_user_chat_footer"));
//----------------------------------------------------------------------	
?>