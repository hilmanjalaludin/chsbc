<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include insured page HTML on layout form 
 * ------------------------------------------------------
 */
 
 $out =& new EUI_Object(_get_all_request());
 $ProductGroupPremi =& ProductGroupPremi($out->get_value('ProductId','intval'));
 
?>
<?php $this->load->form("add_form/{$form}/form_insured_content", array('row_content'=> $ProductGroupPremi)); ?>
<?php $this->load->form("add_form/{$form}/form_insured_footer", array('row_content'=> $ProductGroupPremi)); ?>
