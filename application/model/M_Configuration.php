<?php
class M_Configuration extends EUI_Model
{
  private static $instance = null;
  
 // get_instance

 
 public static function &Instance() {
	if( is_null(self::$instance) ){
		self::$instance = new self();
	}
	
	return self::$instance;
  }
  
// get_instance

 public static function &get_instance() {
	if( is_null(self::$instance) ){
		self::$instance = new self();
	}
	
	return self::$instance;
  }
  
  
// aksesor M_Configuration
 
 public function M_Configuration()
  {
	// && run 
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
	$this -> EUI_Page -> _setQuery("SELECT * FROM t_lk_configuration a"); 
	
	// filtering data 
	$flt = NULL;
	
	if(($this ->EUI_Session->_get_session('HandlingType')!=USER_ROOT)){
		#$flt .=" AND a.ConfigCode IN('PRINTER','HIDE') ";
		$flt .=" a.ConfigCode IN('PRINTER', 'PREDICTIVE_CALL') ";
	}
	
	if( $this -> URI -> _get_have_post('keywords') ) {
		$flt.= " AND ( a.ConfigID LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigName LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigCode LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigValue LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigFlags LIKE '%{$this->URI->_get_post('keywords')}%'
			 )";	
	}						
			
	$this -> EUI_Page -> _setWhere( $flt );   
	if( $this -> EUI_Page -> _get_query() ) {

		#echo $this->EUI_Page->_getCompiler();
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
  $this -> EUI_Page ->_setQuery("SELECT * FROM t_lk_configuration a");
  
 // filtering data
 
  $flt = NULL;
 
  if(($this ->EUI_Session->_get_session('HandlingType')!=USER_ROOT)){
		#$flt .=" AND a.ConfigCode IN('PRINTER','HIDE') ";
		$flt .=" a.ConfigCode IN('PRINTER', 'PREDICTIVE_CALL') ";
  }
  
  if( $this -> URI -> _get_have_post('keywords') ) {
	$flt.= " AND ( a.ConfigID LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigName LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigCode LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigValue LIKE '%{$this->URI->_get_post('keywords')}%' 
				OR a.ConfigFlags LIKE '%{$this->URI->_get_post('keywords')}%'
			 )";	
  }				
  		
  $this -> EUI_Page->_setWhere($flt);
  if( $this->URI->_get_have_post('order_by'))
  {
	 $this -> EUI_Page->_setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
  } else {
  	$this -> EUI_Page->_setOrderBy('a.ConfigID');
  }
  #var_dum( $this->db->last_query() ); die();
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
  
  
// _getFTP configuration 

 public function _getFTP()
  {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','FTP_VOICE');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  }
 
 
// _getHiddent Telephone  
  
 public function _getHiddenTelephone()
 {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','HIDE');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  }  
  
// _getPrinter 
  
  public function _getPrinter()
  {
	$_config = array();
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','PRINTER');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  } 
  
// _getConfiguration

function _getConfiguration($ConfigID=null)
{
 $_avail = array();
	if( !is_null($ConfigID) )
	{
		$this ->db ->select("*");
		$this ->db ->from("t_lk_configuration a");
		$this ->db ->where("a.ConfigID", $ConfigID);
		
		$_avail = $this -> db -> get()->result_first_assoc();
	}
	
	return $_avail;
}
  
// _getFTP configuration 

 public function _getUserLimit()
 {
	$_config = array();
	
	$this ->db ->select('*');
	$this ->db ->from('t_lk_configuration a');
	$this ->db ->where('a.ConfigCode','USER');
	$this ->db ->where('a.ConfigFlags',1);
	
	foreach($this->db->get() -> result_assoc() as $rows ) {
		$_config[$rows['ConfigName']] = $rows['ConfigValue'];
	}
	
	return 	$_config;
  } 
  
  
 // _getNameSpace
 
  public function _getNameSpace()
  {
	$_config = array();
	
	$this ->db->select("a.ConfigCode as aKey,a.ConfigCode as aName");
	$this ->db->from("t_lk_configuration a ");
	
	if(($this ->EUI_Session->_get_session('HandlingType')!=USER_ROOT))
	$this ->db->where_in('ConfigCode',array('PRINTER'));
	
	$this ->db->group_by("a.ConfigCode");
	foreach($this->db->get() -> result_assoc() as $rows ) 
	{
		$_config[$rows['aKey']] = $rows['aName'];
	}
	
	return 	$_config;
  }

// _setDeleteConfig

function _setDeleteConfig($ConfigID= null )
{
	$_conds = 0; 
	if(!is_null($ConfigID))
	{
		$this -> db -> where_in('ConfigID',$ConfigID);
		if( $this -> db->delete('t_lk_configuration'))
		{
			$_conds++;
		}
	}
	
	return $_conds;
}

// _setUpdateConfig 

function _setUpdateConfig($params=null)
{
	$_conds = 0;
	if( !is_null($params) )
	{
		$_values = array();
		foreach($params as $field => $values)
		{
			if( $field!='refConfigCode' 
				AND $field!='ConfigCode')
			{
				if( $field=='ConfigID') {
					$this -> db -> where($field, $values);
				}
				else{
					$this -> db -> set($field, $values);
				}
			}	
		}
		if( $this -> db -> update("t_lk_configuration") ){
			$_conds++;
		}
	}
	
	return $_conds;
} 
  
// _setSaveConfig 

function _setSaveConfig($params=null)
{
	$_conds = 0;
	
	if( !is_null($params) )
	{
		$_values = array();
		foreach($params as $field => $values)
		{
			if( $field!='refConfigCode')
			{
				$this -> db -> set($field, $values);
			}
		}
		
		$this -> db -> insert("t_lk_configuration");
		if( $this -> db->affected_rows() > 0 ){
			$_conds++;
		}
	}
	
	return $_conds;
} 

// M_Configuration 

function _getTemplateLayout()
{
	$_config = array();
	
	$this ->db->select("a.ConfigName, a.ConfigValue");
	$this ->db->from("t_lk_configuration a ");
	$this ->db->where("a.ConfigCode","TEMPLATE");
	
	foreach($this->db->get() -> result_assoc() as $rows )
	{
		$_config[$rows['ConfigValue']] = $rows['ConfigName'];
	}
	
	return 	$_config;
	
}
  
}
?>