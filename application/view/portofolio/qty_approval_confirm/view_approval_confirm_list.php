<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'CampaignName' 		=> 'left',
	'CustomerNumber'	=> 'left',
	'PolicySalesDate' 	=> 'center',
	'CallReasonDesc' 	=> 'Left',
	'CustomerName' 		=> 'left',
	'AgentId'			=> 'left',
	'AproveName'		=> 'left',
	'CallReasonDesc'    => 'left',
	'PolicyNumber'		=> 'left',
	'Duration'			=> 'center',
	'CustomerDOB'		=> 'center',
	'CustomerAge'		=> 'center'	
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CustomerName' 		=> array('_setCapital','_setBoldColor'),
	'PolicySalesDate' 	=> array('_getDateTime'),
	'CampaignName' 		=> array('showPolicy'),
	'PolicyNumber'		=> array('_setBoldColor'),
	'AgentId'			=> array('_setCapital','_setWordWrap'),
	'Duration'			=> array('_getDuration'),
	'CustomerDOB'		=> array('_getDateIndonesia'),
	'CustomerAge'		=> array('_getAge')
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'showPolicy') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------