<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_FormLayout extends EUI_Model
{

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */

function M_FormLayout()
{
	$this -> load->model(array('M_SetPrefix'));
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getFormLayout()
{
  $_conds = array();
  
  $this -> db->select('*');
  $this -> db->from('t_gn_formlayout');
  foreach( $this->db->get()->result_assoc() as $rows )
  {
	$_conds[$rows['PrefixId']] = $rows;
  }
  
  return $_conds;
}

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
function _getProductLayout( $ProductId=0 )
{
	$Source = array();
	$PrefixId = $this -> M_SetPrefix->_getPrefixId($ProductId);
	if( !is_null($PrefixId))
	{
		$LayoutAvail = self::_getFormLayout();
		
		if( is_array($LayoutAvail) )
		{
			$Source = $LayoutAvail[$PrefixId];
		}
	}	
	
	return $Source;
}

}

?>