<?php
/*
 * E.U.I 
 *
 
 * subject	: M_SetBenefit modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_CtiExtension extends EUI_Model
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function M_CtiExtension()
{
	$this -> load -> model(array('M_Pbx'));
	$this -> load -> helper('EUI_Socket');
	$this -> load -> meta('_cc_extension_agent');
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_default()
{
	$this -> EUI_Page -> _setPage(10); 
	
	$this -> EUI_Page -> _setQuery
			("SELECT a.id as extId
			 FROM cc_extension_agent a left join cc_pbx_settings b on a.pbx=b.id "); 
	
	
	$filter = '';
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$keywords = $this -> URI -> _get_post("keywords");
		
		$filter = " AND ( a.id LIKE '%$keywords%' 
							OR a.ext_number LIKE '%$keywords%' 
							OR b.set_value LIKE '%$keywords%' 
							OR a.ext_desc LIKE '%$keywords%'  
							OR a.ext_type LIKE '%$keywords%' 
							OR a.ext_status LIKE '%$keywords%' 
							OR a.ext_location LIKE '%$keywords%' 
						   )";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	
	if( $this -> EUI_Page -> _get_query() )
	{
		return $this -> EUI_Page;
	}
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{

	$this -> EUI_Page -> _postPage( $this -> URI -> _get_post('v_page') );
	$this -> EUI_Page -> _setPage(10);
 
	$this -> EUI_Page -> _setQuery
			("SELECT 
				a.id as extId, a.ext_number as extNumber,  b.set_value as extPbx, a.ext_desc as extDesc,
				a.ext_type as extType, a.ext_status as extStatus, a.ext_location as extLocation, c.full_name
			 FROM cc_extension_agent a 
			 left join cc_pbx_settings b on a.pbx=b.id
			 left join tms_agent c on a.ext_location=c.ip_address "); 
	
			
	$filter = "";
	
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$keywords = $this -> URI -> _get_post("keywords");
		
		$filter = " AND ( a.id LIKE '%$keywords%' 
							OR a.ext_number LIKE '%$keywords%' 
							OR b.set_value LIKE '%$keywords%' 
							OR a.ext_desc LIKE '%$keywords%'  
							OR a.ext_type LIKE '%$keywords%' 
							OR a.ext_status LIKE '%$keywords%' 
							OR a.ext_location LIKE '%$keywords%' 
						   )";
	}				
			
	$this -> EUI_Page -> _setWhere( $filter );   
	
	if( $this->URI->_get_have_post('order_by') ) 
	{
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'), $this->URI->_get_post('type') );
	}
	$this -> EUI_Page -> _setOrderBy('a.id');
	$this -> EUI_Page->_setLimit();
}


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
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
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_data_download()
{
	$this -> _cc_extension_agent -> meta_select();
	$data = array ( 
		'data' => $this -> _cc_extension_agent -> meta_get_query(), 
		'cols' => $this -> _cc_extension_agent -> _get_meta_colums() 
	);
	
	return $data;
} 


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_data_template()
{
	$data_template = $this -> _cc_extension_agent -> _get_meta_colums();
 	if( $data_template )
	{
		return $data_template;
	}
} 
 
 
 
function _getDataExtension( $ExtensionId=0 )
{
	$this ->db ->select('*');	
	$this ->db ->from('cc_extension_agent');
	$this ->db ->where('id',$ExtensionId);
	
	if( $rows = $this ->db ->get() -> result_first_assoc() ){
		return $rows;
	}
	else{
		return array();
	}
} 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function _cti_extension_upload( $data = null )
 {
	$_totals = 0;
	$_conds = false;
	if( !is_null( $data) )
	{
		if($this -> URI -> _get_post('mode') =='truncate') //empty table if truncate mode  
			$this -> db -> truncate( $this -> _cc_extension_agent-> _get_meta_index() );
			
		// then request 
		
		foreach( $data as $rows ) 
		{
			if( $this -> db -> insert( 
				$this -> _cc_extension_agent-> _get_meta_index(),
				$rows
			)){
				$_totals+=1;
			}
		}
		
		if( $_totals > 1)
			$_conds = true;
		
	}
	
	return $_conds;	
 }


/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function _setUpdateExtension( $Data = array() )
 {
	$_conds = 0; $update = array(); $where = array();
	foreach( $Data as $k => $m ) {
		if( $k=='id')
			$where[$k]= $m;
		else
			$update[$k]= $m;
	}
	
	if( $this -> db->update('cc_extension_agent',$update, $where))
	{
		$_conds++;
	}
	
	return $_conds;
 }
 
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setSaveExtension( $Data = array() )
 {
	$_conds = 0;
	if( $this -> db->insert('cc_extension_agent',$Data) )
	{
		$_conds++;
	}	
	
	return $_conds;
	
 }
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 private function _getExtension( $PbxId=0 )
 {
	$this -> db -> select('ext_number');
	$this -> db -> from('cc_extension_agent');
	$this -> db -> where('id',$PbxId);
	
	if( $rows = $this -> db ->get()->result_first_assoc() ){
		return $rows['ext_number'];
	} 
	else
		return false;
	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _setRelease($datas = array() )
 {
	$_conds = array();
	if( class_exists('EUI_Socket'))
	{
		$Server = $this -> M_Pbx -> _get_pbx_setting();
		
		$i = 0;
		
		foreach( $datas as $k => $m) 
		{
			$rows = $this -> _getExtension($m);
			if( $rows!=false )
			{
				Socket()->set_fp_server( $Server[1]['value'],9800 ); 
				Socket()->set_fp_command( "rel-station\r\n"."ext:{$rows}\r\n\r\n" ); 
				
				if( Socket() -> send_fp_comand() )
				{
					if( Socket()->get_fp_response() )
					{
						$_conds[$i] = array('Ext' =>$rows, 'status' => 'Success' ); 
					}
					else{
						$_conds[$i] = array('Ext' =>$rows, 'status' => 'Failed' );
					}
				}
				else{
					$_conds[$i] = array('Ext' =>$rows, 'status' => 'Failed' );
				}
			}
			
			$i++;
		}
	}

	return $_conds;	
	
 }
 
  
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _setDeleteExtension($ListData = array() )
 {
	$_conds = 0;
	foreach( $ListData as $k => $ExtensionId )
	{
		if( $this -> db-> delete('cc_extension_agent',array( 'id'=> $ExtensionId)) )
		{
			$_conds++;		
		}
	}
	
	return $_conds;
 }
 
}

?>