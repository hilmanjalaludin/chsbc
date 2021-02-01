<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_SetCores extends EUI_Model
{

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
 
 function M_SetCores() 
 {
	$this -> load -> Model('M_Loger');
	$this -> load -> meta('_t_gn_campaigngroup');
	
 }
 
// @ _get_default

function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery( "SELECT * FROM ". $this -> _t_gn_campaigngroup -> _get_meta_index() ); 
	
	$filter = '';
	
	if( $this->URI->_get_have_post('cbFilter') ) 
	{
		$filter = " AND CampaignGroupStatusFlag IN(0,1) ".
				  " AND ( CampaignGroupCode LIKE '%".$this -> URI -> _get_post('cbFilter')."%' ".
				  " OR CampaignGroupName LIKE '%".$this -> URI -> _get_post('cbFilter')."%' )";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	if( $this -> EUI_Page -> _get_query() ) {
		return $this -> EUI_Page;
	}
}

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
	
function _get_content()
{
//@ create object 
 
 $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
 $this -> EUI_Page->_setPage(10);
 
 $sql = " SELECT campaignGroupId, CampaignGroupCode, CampaignGroupName,  
		  CASE WHEN (CampaignGroupStatusFlag<>1) THEN 'Not Active' ELSE 'Active' END AS campaignStatusCore
		  FROM {$this -> _t_gn_campaigngroup -> _get_meta_index()}";
			
 $this -> EUI_Page ->_setQuery($sql);
 $filter = '';
 
  if( $this -> URI -> _get_have_post('key_words') )
  {
	$filter = " AND CampaignGroupStatusFlag IN(0,1) 
				AND ( CampaignGroupCode LIKE '%".$this -> URI -> _get_post('cbFilter')."%' 
				OR CampaignGroupName LIKE '%".$this -> URI -> _get_post('cbFilter')."%' ) ";	
  }				
		
  $this -> EUI_Page->_setWhere( $filter );
  $this -> EUI_Page->_setOrderBy('campaignGroupId');
  $this -> EUI_Page->_setLimit();
}

/*
 * @ get buffering query from database
 * @ then return by object type ( resource(link) ); 
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ get number record & start of number every page 
 * @ then result ( INT ) type 
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
 
/*&& */

function _get_detail_cores( $CoreId=0 )
{
	$datas = array();
	
	$this -> db -> select( $this -> _t_gn_campaigngroup -> _get_meta_colums() );
	$this -> db -> from( $this -> _t_gn_campaigngroup -> _get_meta_index() );
	$this -> db -> where( $this -> _t_gn_campaigngroup -> _get_cols_post(0), $CoreId );
	
	foreach( $this -> db -> get() -> result_assoc() as $rows ) 
	{
		$datas =  $rows;
	}
	
	return $datas;
}
 
 
  
/*
 * @ get number record & start of number every page 
 * @ then result ( INT ) type 
 */
 
function _set_save_add_cores( $fields = array() )
 {
	$_conds = false;
	
	if( is_array($fields)!=FALSE)
	{	
		$_tables = $this -> _t_gn_campaigngroup -> _get_meta_index();
		if( $this -> db -> insert($_tables,$fields ))
		{
			$this -> M_Loger -> set_activity_log("Add Core ::".implode(',',$fields));
			$_conds = true;
		}
	}
	
	return $_conds;
 }
 
 // @ _set_delete_cores
 function _set_delete_cores( $CoreId )
 {
	if( is_array($CoreId) )
	{
		$tot = 0;
		foreach($CoreId as $k => $v )
		{
			if( $this -> db -> delete( 
				$this -> _t_gn_campaigngroup -> _get_meta_index(), 
				array( $this -> _t_gn_campaigngroup -> _get_cols_post(0) => $v ),
				$limit =1 ) )
			{
				$tot++;
			}
		}
	}
	
	if( $tot > 0 ){
		$this -> M_Loger -> set_activity_log("Delete Core ::".implode(',',$CoreId));
	}
	
	return $tot;
 }
 
 // _set_update_cores
 
 function _set_update_cores($ColsName=array(), $ColsWere=0 )
 {
	$_conds = false;
	
	$this -> db -> where( $this ->_t_gn_campaigngroup->_get_cols_post(0), $ColsWere );
	if( $this -> db -> update( $this ->_t_gn_campaigngroup->_get_meta_index(), $ColsName) )
	{
		$this -> M_Loger -> set_activity_log("Update Core ::".$ColsWere);
		$_conds = true;
	}
	
	return $_conds;
	
 }
 
}

// END OF FILE 
// LOCATION : ./application/model/sysmenu.php
?>