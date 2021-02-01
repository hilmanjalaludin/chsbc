<?php
/*
 * @ def 	: E.U.I layout of my web 
 * ----------------------------------------------------
 *
 * @ param  : core autoload first time 
 * @ akses 	: akses from helper only recomended
 * @ author : omens / razaki team
 */
 
class EUI_Layout 
{
 
 private $_layout = array();
 private $_config_paths = array(APPPATH);
 private $_base_web_editor = array("library/pustaka/tinymcpuk");
 private $_base_datatables_layout = array('library/pustaka/datatables');
 private $_base_jquery_layout = array('library/pustaka/jquery');
 private $_base_enigma_layout  = array('library/EUI');
 private $_base_style_layout = array('library/styles');
 private $_base_library = array('library');
  	

 
/*
 * @ def	: default of the base layout if not define 
 * ----------------------------------------------------
 * 
 * @ param	: construct
 * @ author	: razaki team 
 */
 
function __construct()
{
 
  $this -> _layout =& get_config();
 
 // load debug class config data
 
 log_message('debug', "Config Class Initialized");
 $base_layout='';
 if( !isset($this -> _layout['base_layout']) && 
	$this -> _layout['base_layout']=='' )
 {
	$base_layout = 'standar';		
  }
	$this -> _set_layout('base_layout', $base_layout );
 }
 
 
/*
 * @ def	: set get_base_url 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
function base_library()
{
	$URI = null;
	$_library = array_values($this ->_base_library);
	if( is_array($_library)) 
	{
		$URI = $this ->get_base_url() . $_library[0]; 
	}
	return $URI;
}	
 

/*
 * @ def	: set get_base_url 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */

private static $_base_db_layout = null;
  
/*
 * @ def	: set get_base_url 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
  
 private function _get_layout_db() 
{
  $out= & get_instance();
  if(_have_get_session('HandlingType') )
  {	
	$out->db->reset_select();
	$out->db->select('a.Themes, b.Name', false);
	$out->db->from('t_gn_grouplayout a');
	$out->db->join('t_gn_layout b', 'a.LayoutId=b.Id');
	$out->db->where('a.GroupId',_get_session('HandlingType'));
	$out->db->limit(1);
	
	if(is_null(self::$_base_db_layout) )
	{
		$rs = $out->db->get();
		if( $rs->num_rows() > 0) 
			foreach($rs->result_assoc() as $rows )
		{
			self::$_base_db_layout = array('layout' => $rows['Name'], 'themes' => $rows['Themes']);
		}
	}	
  }
  
  return self::$_base_db_layout;
}


/*
 * @ def	: set get_base_url 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
  public function base_image_system() 
{
	return join("/", array(base_library(), 'gambar')); 
 }
  
/*
 * @ def	: SET USER_DEFINE_ATTRIBUTE 
 * ----------------------------
 *
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 public function UserDefinition()
{
 $out= & get_instance();
// ----------- select all configuration data -------------------------

 $out->db->reset_select();
 $out->db->select("a.ConfigName,a.ConfigValue", false);
 $out->db->from("t_lk_configuration a");
 $out->db->where("a.ConfigFlags",1);
 $out->db->where_in("a.ConfigCode",array (
	"QUALITY_SKILL",
	"STATUS_POLICY",
	"USER_LEVEL",
	"FTP_VOICE",
	"VOICE_MAIL",
	"CALL_DIRECTION",
	"APPROVE_ITEM",
	"HISTORY_TYPE",
	"CHANGE_STATUS",
	"FORBIDEN_STATUS",
	"TIMER_SYSTEM",
	"GROUP_PREMI",
	"LANGS_SYSTEM",
	"QUALITY_INTEREST",
	"EXP_LIMIT_DATA",
	"PDS_CALL"
 ));
 
// ------------ select data get recsource ---------------------------
 
 $rs = $out->db->get(); 
 if( $rs->num_rows() > 0)
	foreach( $rs->result_assoc() as $rows )  
{
	// test 
	if(!@defined($rows['ConfigName'], $rows['ConfigValue']) ) {
		define($rows['ConfigName'], $rows['ConfigValue']);
	}	
 }
 // ini adalah query untuk mengambil semua user dengan level ADMIN 
 
 $sql = sprintf("select a.UserId from tms_agent a  
				 left join tms_agent_profile b on a.handling_type=b.id 
				 where b.id IN(%d,%d)", USER_ROOT, USER_ADMIN);
		  
		  
 $qry = $out->db->query( $sql );
 if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$out->Config->config['default_admin'][$row['UserId']] = $row['UserId'];	
 }
 
 
 // ini adalah query untuk mengambil semua user dengan level ADMIN 
 
 $sql = sprintf("select a.CallReasonId, a.CallReasonCode from t_lk_callreason a where a.CallReasonStatusFlag=%d", 1);
 $qry = $out->db->query( $sql );
 if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		
		if( !strcmp($row['CallReasonCode'], 'NEW' ) ){
			if(!@defined('NW', $row['CallReasonId']) ) {
				define('NW', $row['CallReasonId']);
			}
		} else {
			if(!@defined($row['CallReasonCode'], $row['CallReasonId']) ) {
				define($row['CallReasonCode'], $row['CallReasonId']);
			}	
		}
 }
 
}


  
/*
 * @ def	: SET USER_DEFINE_ATTRIBUTE 
 * ----------------------------
 *
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 public function QulitySkill() 
{
	return true;
}


/*
 * @ def	: set get_base_url 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function get_base_url($uri='')
 {
	$URI = null;
	$CFG =& get_instance();
	if( is_object($CFG)){
		$URI = $CFG -> Config ->base_url($uri);
	}	
	
	return ( $URI ? $URI : null );
 }
 
/*
 * @ def	: set base_layout_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
function base_web_editor()
{
	$URI = null;
	
	$_tinymce = array_values($this ->_base_web_editor);
	if( is_array($_tinymce) )
	{
		$URI = $this ->get_base_url() . $_tinymce[0]; 
	}
	
	return $URI;
}
 
/*
 * @ def	: set base_layout_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function base_layout_style()
 {
	$_URI = null;
	if( !is_null( $this ->_base_style_layout[0] ))
	{
		$_URI = $this ->get_base_url() .'/'. $this ->_base_style_layout[0].'/'.$this ->base_layout() .'/default';
	}
	return ( $_URI ? $_URI : null );
 }
 
 /*
 * @ def	: base_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function _get_db_layout()
 {
	$_db_layout = null;
	$_db_layout = $this->_get_layout_db(); 
	return ( !is_null($_db_layout) ? $_db_layout : null);
 }
  
/*
 * @ def	: base_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function base_style()
 {
	$_URI = null;
	if( !is_null( $this ->_base_style_layout[0] ) )
	{
		$_URI = $this ->get_base_url() .''. $this ->_base_style_layout[0];
	}
	
	return ( $_URI ? $_URI : null );
 }
 
/*
 * @ def	: set base_themes_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function base_themes_style($style=null)
 {
	$UI = null; $UI = self::_get_db_layout();
	if( isset($UI['themes']) 
		AND !is_null($UI['themes']))
	{
		$_URI = $this ->base_style().'/themes/'.$UI['themes'];
	}
	else 
	{
		if(!is_null($style) )
			$_URI = $this ->base_style().'/themes/'.$style;
		else
			$_URI = $this -> base_style();
	}	
	
	return ( $_URI ? $_URI : null );
 }
 
 
 /*
 * @ def	: set base_themes_style 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function base_fonts_style()
 {
	$arr_themes = $this ->base_style() ."/themes/fonts";
	return ( $arr_themes ? $arr_themes : null );
 }
  
 
/*
 * @ def	: base_image_layout
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
  
function base_image_layout() 
{
	$_URI = $this ->base_style().'/'. $this ->base_layout() .'/images';
	return ( $_URI ? $_URI : null );
}

/*
 * @ def	: base_js_layout
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
function base_js_layout()
{
	$_URI = $this ->base_style() .'/'. $this ->base_layout() .'/js';	
	return ( $_URI ? $_URI : null );
}

/*
 * @ def	: base_layout_enigma
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
function base_layout_enigma()
 {
	$_URI = $this ->get_base_url() .''. $this ->_base_enigma_layout[0];
	return ( $_URI ? $_URI : null ); 
 }
 
 /*
 * @ def	: base_layout_jquery
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 function base_layout_jquery()
 {
	$_URI = $this ->get_base_url() .''. $this ->_base_jquery_layout[0];
	return ( $_URI ? $_URI : null ); 
 } 
 
 /*
 * @ def	: base_layout_jquery
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 function base_layout_datatables()
 {
	$_URI = $this ->get_base_url() .''. $this ->_base_datatables_layout[0];
	return ( $_URI ? $_URI : null ); 
 }
 
/*
 * @ def	: set _layout 
 * ----------------------------
 * @ param 	: keys , values 
 * @ return : procedure 
 */
 
 function _set_layout($item, $value)
 {
	if( !is_null($item) && ($value!='') ) 
	{
		$this->_layout[$item] = $value;
	}		
 }
 
 
/*
 * @ def 		: base_layout
 * ------------------------------------
 * 
 * @ access 	: public
 * @ param 		: null
 * @ return  	: string
 */
	 
function base_layout()
{
  $_URI_layout = null;	$_db_layout = null;
  
  $_db_layout = $this->_get_layout_db(); // get layout on db & tehems
  
  if( isset($_db_layout['layout']) 
	AND !is_null($_db_layout) )
  {
		$_URI_layout = trim($_db_layout['layout']);
  }
  else
  { 
	if( isset( $this->_layout['base_layout'] ) ) 
	{
		if( $this -> _layout['base_layout']) {
			$_URI_layout = trim($this ->_layout['base_layout']);
		}
	}
  }
  
  return $_URI_layout;	
}

/*
 * @def 	: base_layout
 * ------------------------------------
 * 
 * @access 	: public
 * @param 	: null
 * @return  : string
 */
	 
}

?>