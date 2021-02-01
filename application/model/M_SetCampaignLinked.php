<?php
class M_SetCampaignLinked extends EUI_Model
{

// meta table ;

 private static $meta = null; 
 private static $join = array();
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 function M_SetCampaignLinked()
 {
	if( is_null(self::$meta) ) 
	{
		self::$meta = 't_gn_campaign_transaction';
		self::$join = array( 
			0 => array (
				'table' => 't_gn_campaign',
				'primary' => 'CampaignId' ),
			1=> array (
				'table' =>'t_lk_campaign_did', 
				'primary' => 'Id'
			)
		);
	}
 }

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getData( $id = NULL )
{
	$this -> db -> select('*');
	$this -> db -> from(self::$meta);
	$this -> db -> where('Id',$id);
	return $this -> db -> get()->result_first_assoc();
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getFieldName(){
	return $this->db->list_fields(self::$meta);
}

/* get DID Data availabled **/

private function _getResultDID()
{
	$data = array();
	
	$this ->db ->select('*');
	$this ->db ->from( self::$join[1]['table']);
	$this ->db ->where('DIDFlags', 1);
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$data[$rows['Id']] = $rows['DIDName'];
	}
	
return $data;	
}

/* get DID Data availabled **/

private function _getCampaignID()
{
	$data = array();
	
	$this ->db ->select('*');
	$this ->db ->from( self::$join[0]['table']);
	$this ->db ->where('CampaignStatusFlag', 1);
	$this ->db ->where('OutboundGoalsId', 1);
	
	foreach( $this ->db ->get() -> result_assoc() as $rows )
	{
		$data[$rows['CampaignId']] = $rows['CampaignName'];
	}
	
return $data;	
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getMetaJoin()
{
	$meta_join = array('0' => 'Not Active','1'=>'Active');
	
	return $meta_join;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getComponent()
{
	$ResultCampaign = $this -> _getCampaignID();
	$ResultDID = $this ->_getResultDID();
	
	return array
	( 
		'combo'   => array( 
			'CampaignId' => array( 'label'  => 'Campaign Name', 'data' => $ResultCampaign ), 
			'DIDCampaign' => array( 'label' => 'DID Link', 'data' => $ResultDID )
		),
		
		'input'   => array(),
		'primary' => array('Id')
	);
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
	$this -> EUI_Page -> _setQuery(" 
		SELECT a.* FROM " . self::$meta ." a 
		LEFT JOIN ". self::$join[0]['table']." b ON a.CampaignId = b.".self::$join[0]['primary']." 
		LEFT JOIN ". self::$join[1]['table']." c ON a.DIDCampaign = c.".self::$join[1]['primary'] ); 
		
	$flt = '';
	if( $this->URI->_get_have_post('keywords') ) 
	{
		$flt .=" AND (  a.CampaignId LIKE '%{$this->URI->_get_post('keywords')}%'  
				 OR a.DIDCampaign LIKE '%{$this->URI->_get_post('keywords')}%'  
				 OR a.DIDCampaign LIKE '%{$this->URI->_get_post('keywords')}%' 
				 OR b.CampaignName LIKE '%{$this->URI->_get_post('keywords')}%'
				 ) ";
	}				
			
	$this -> EUI_Page -> _setWhere($flt);   
	if( $this -> EUI_Page -> _get_query() ) {
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

  $this -> EUI_Page->_postPage( $this -> URI -> _get_post('v_page') );
  $this -> EUI_Page->_setPage(10);
  
  $sql =" SELECT a.*, b.*, c.*, a.Id as RecordId FROM " . self::$meta ." a 
		LEFT JOIN ". self::$join[0]['table']." b ON a.CampaignId = b.".self::$join[0]['primary']." 
		LEFT JOIN ". self::$join[1]['table']." c ON a.DIDCampaign = c.".self::$join[1]['primary']; 
  
  $this -> EUI_Page ->_setQuery($sql);
  
  if( $this->URI->_get_have_post('keywords') ) 
  {
	$flt .=" AND( a.CampaignId LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.DIDCampaign LIKE '%{$this->URI->_get_post('keywords')}%'  
				OR a.DIDCampaign LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR b.CampaignName LIKE '%{$this->URI->_get_post('keywords')}%'
			) ";
  }
  
  $this -> EUI_Page->_setWhere($flt);
  if( $this -> URI ->_get_have_post('order_by')) {
	$this -> EUI_Page->_setOrderBy($this ->URI->_get_post('order_by'),$this ->URI->_get_post('type'));
  }
  else
		$this -> EUI_Page->_setOrderBy('a.CampaignId');
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
 
 
 function _setSave($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v ) {
		$this -> db -> set($k,$v);
	}
	
	$this -> db -> insert( self::$meta );
	if( $this -> db -> affected_rows()>0 ) {
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
 
  function _setUpdate($params=array())
 {
	$_conds= 0;
	foreach($params  as $k => $v )  
	{
		if( $k=='Id')
			$this -> db -> where($k,$v);
		else
			$this -> db -> set($k,$v);
	}
	
	if($this -> db -> update(self::$meta)) 
	{
		$_conds++;
	}
	
	return $_conds;
 }
 
 /// _setDelete
 
 function _setDelete($params = null )
 {
	$_conds = 0;
	
	$this -> db-> where_in('Id',$params);
	
	if( $this ->db ->delete( self::$meta )){
		$_conds++;
	}
	
	return $_conds;
	
 }
 
 
 
}
?>