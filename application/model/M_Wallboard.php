<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysMenu  
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysmenu/
 */
 
class M_Wallboard extends EUI_Model
{

/*
 * @ set default query for calculation 
 * @ total record of page 
 * @ then sent to navigation view 
 */
 
 function M_Wallboard() 
 {
	$this -> load -> Model('M_Loger');
	$this -> load -> meta('_t_gn_campaigngroup');
	
 }
 
// @ _get_default

function _get_default()
{
	$this -> EUI_Page -> _setPage(15); 
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
 $this -> EUI_Page->_setPage(15);
 
 $sql = "SELECT * FROM t_gn_wallboard tgw";
			
 $this -> EUI_Page ->_setQuery($sql);
 $filter = '';
 
//   if( $this -> URI -> _get_have_post('key_words') )
//   {
// 	$filter = "";	
//   }				
		
  $this -> EUI_Page->_setWhere( $filter );
  $this -> EUI_Page->_setOrderBy('id');
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

function _get_detail_cores( $Id=0 )
{
	// var_dump('id',$Id);die();
	 $datas = array();
	

	$qry=$this -> db -> get_where('t_gn_wallboard',array('id'=>$Id)) -> result();
	// var_dump('id',$qry);die();
	// foreach( $this -> db -> get() -> result() as $rows ) 
	// {
	// 	$datas =  $rows;
	// }


	//  var_dump('id',$qry);die();
	 return $qry;
}
 
 
  
/*
 * @ get number record & start of number every page 
 * @ then result ( INT ) type 
 */
 
function _set_save_add_cores( $fields = array() )
 {
	$_conds = false;
	// var_dump('field',$fields);die();
	if( is_array($fields)!=FALSE)
	{
        // $this -> db -> where( 'status', 1 );
        // $this -> db -> update( 't_gn_wallboard', array('status'=>0,'updated_at'=>date('Y-m-d H:i:s')));
        // if( $this->db->affected_rows()>0 ) {
        $fields['flag'] = 1;
        $fields['created_by'] = _get_session('UserId');
        $fields['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('t_gn_wallboard',$fields);
        // var_dump($this->db->last_query());die;
        if($this->db->affected_rows()>0){
            $_conds = true;
        }
		// }
		
		return $_conds;
		
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
 
 function _set_update_cores($data=array() )
 {
	$_conds = false;
	$daily=$data['daily_today'];
	$mtd=$data['mtd_h1'];
	$month_target = $data['month_target'];
	$product=$data['product'];

	// var_dump($data);die();
	// var_dump('data',$data['id']);die();
	$this -> db -> where('id',$data['id']);
	$this -> db -> update( 't_gn_wallboard', array(
		'daily_today'=>$daily,
		'mtd_h1'=>$mtd,
		'month_target'=>$month_target,
		'product'=>$product
	
	));
	 
	return $_conds = true;
	
 }
 
}

// END OF FILE 
// LOCATION : ./application/model/sysmenu.php
?>