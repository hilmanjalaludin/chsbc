<?php 

/**
 *
 * @ def 	: form generate voice 
 * ---------------------------------------------------------- 
 
 * @ param 	: --
 * @ param 	: --
 *
 */
 
__("<fieldset class='corner'>");
__("<legend class=\"icon-customers\">&nbsp;&nbsp;Form Voice Data </legend>");
__("<div class='box-shadow' style='padding-top:5px;padding-bottom:10px;'>");
__("<form name=\"frmEditData\">");
		
if( is_array($frmVoiceData) ) 
{
__("<table width='99%' align='center' cellspacing='2px' cellpadding='5px'>");

	$frm_size_cols = 2;
	$frm_size_bars =& ceil(count($frmVoiceData)/$frm_size_cols); 
	
	$start = 0;	 $q = 1;
	while( $q <= $frm_size_bars )  
	{
		__("<tr>");
		
			$start++;
			$n = ($start-1)*$frm_size_cols;
			foreach( array_slice($frmVoiceData, $n, $frm_size_cols ) as $k => $labels) 
			{
				__("<td class='text_caption bottom'>" . $labels['label'] ."&nbsp;&nbsp;:</td>");
				__("<td>" . form()->$labels['type']($labels['name'],$labels['style'], $frmVoiceContent[$labels['name']],NULL, $labels['extra']). "</td>");
			}
			
		__("</tr>\n");
		
		$q++;		
	}
	
__("</table>"); 
}

		__("</form>");
	__("</div>");
__("</fieldset>");	




/**
 *
 * @ def : form Customer blank methode  
 * ----------------------------------------------------------
 * 
 * @ param 	: --
 * @ param 	: --
 *
 */
/////////////////////: LOAD DATA :\\\\\\\\\\\\\\\\\\\\\\\ 
$EUI=& get_instance(); 
$EUI->load->model('M_SrcCustomerList');
/////////////////////: LOAD DATA :\\\\\\\\\\\\\\\\\\\\\\\
 
__("<fieldset class='corner' style='margin-top:10px;'>");
__("<legend class=\"icon-customers\">&nbsp;&nbsp;Form Customer Data </legend>");
__("<div class='box-shadow' style='padding-top:5px;padding-bottom:10px;'>");
__("<form name=\"frmCustomerData\">");
		
if( is_array($frmCustomer) ) 
{
__("<table width='99%' align='center'>");

	
	$frm_size_cols = 2;
	$frm_size_bars =& ceil(count($frmCustomer)/$frm_size_cols); 
	$frm_data_bars =& $EUI->M_SrcCustomerList->_getDetailCustomer($frmVoiceContent['assignment_data']);
	$frm_flds_fltr = array('GenderId' => $frmCombo['Gender']);
  
	$start = 0;	 $q = 1;
	while( $q <= $frm_size_bars )  
	{
		__("<tr>");
		
			$start++;
			$n = ($start-1)*$frm_size_cols;
			foreach( array_slice($frmCustomer, $n, $frm_size_cols ) as $k => $labels) 
			{
				if($labels['type']=='combo'){
					__("<td class='text_caption bottom'>" . $labels['label'] ."&nbsp;:</td>");
					__("<td>" . form()->$labels['type']($labels['name'],$labels['style'], $frm_flds_fltr[$labels['name']], $frm_data_bars[$labels['name']], NULL, $labels['extra']). "</td>");
				}
				else {
					__("<td class='text_caption bottom'>" . $labels['label'] ."&nbsp;:</td>");
					__("<td>" . form()->$labels['type']($labels['name'],$labels['style'], $frm_data_bars[$labels['name']], NULL, $labels['extra']). "</td>");
				}	
			}
			
		__("</tr>\n");
		
		$q++;		
	}
	
__("</table>");
__("</form>");
__("</div>");
__("</fieldset>");	
}
 
 
?> 