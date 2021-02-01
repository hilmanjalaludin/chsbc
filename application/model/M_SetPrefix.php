<?php
/*
 * E.U.I 
 * --------------------------------------------------------------
 * 
 * subject	: get model data for M_SetPrefix modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class M_SetPrefix extends EUI_Model 
{
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 function __construct(){ }
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 function _get_default() 
 {
  
	$this->EUI_Page->_setPage(20); 
	$this->EUI_Page->_setSelect("a.PrefixNumberId");
	$this->EUI_Page->_setFrom("t_gn_productprefixnumber a");
	$this->EUI_Page->_setJoin("t_gn_product b "," a.ProductId=b.ProductId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_formlayout c "," a.PrefixNumberId=c.PrefixId","LEFT",true);
	
// ------ set filter -------------------------
	$this->EUI_Page->_setAndCache("a.PrefixChar","prefix_kode_number", true);
	$this->EUI_Page->_setAndCache("a.ProductId","prefix_product_id", true);
	$this->EUI_Page->_setAndCache("a.PrefixFlagStatus","prefix_status", true);
	$this->EUI_Page->_setLikeCache("c.ProductName","prefix_product_name", true);
	
	return $this -> EUI_Page;
 }
 
 // ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 function _get_content()
 {
	// No		 Product Code 	 Product Name 	 Prefix 	
	// Max Length 	 Method 	 Form Input 	 Form Edit 	 
	// Prefix Status 
	
	$this->EUI_Page->_postPage(_get_post('v_page') ); 
	$this->EUI_Page->_setPage(20); 
	$this->EUI_Page->_setArraySelect(array(
		"a.PrefixNumberId as PrefixNumberId " => array("PrefixNumberId", "PrefixNumberId","primary"),  
		"b.ProductCode  as ProductCode" => array("ProductCode","Product Code"),  
		"b.ProductName as ProductName" => array("ProductName", "Product Name"), 
		"a.PrefixChar as PrefixChar" => array("PrefixChar", "Prefix"), 
		"a.PrefixLength as PrefixLength" => array("PrefixLength","Max Length"), 
		"c.AddView as AddView" => array("AddView","Form Input"), 
		"c.EditView as EditView" => array("EditView","Form Edit"),  
		"c.Handler as Handler" => array("Handler", "Handler"), 
		"c.Model as Model" => array("Model","Model"),
		"a.PrefixMethod as PrefixMethod" => array("PrefixMethod","Methode"),
		"IF( a.PrefixFlagStatus<>1, 'Not Active','Active') as Status" => array("Status","Status")
	));

	$this->EUI_Page->_setFrom("t_gn_productprefixnumber a");
	$this->EUI_Page->_setJoin("t_gn_product b "," a.ProductId=b.ProductId", "LEFT");
	$this->EUI_Page->_setJoin("t_gn_formlayout c "," a.PrefixNumberId=c.PrefixId","LEFT",true);
	
// ------ set filter ------------
	
	$this->EUI_Page->_setAndCache("a.PrefixChar","prefix_kode_number", true);
	$this->EUI_Page->_setAndCache("a.ProductId","prefix_product_id", true);
	$this->EUI_Page->_setAndCache("a.PrefixFlagStatus","prefix_status", true);
	$this->EUI_Page->_setLikeCache("c.ProductName","prefix_product_name", true);
	
	
// ---------- set order by -------------------
	
	if(_get_have_post('order_by') )  {
		$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type') );
	} else {
		$this->EUI_Page->_setOrderBy("a.PrefixNumberId","DESC");
	}
	
	$this -> EUI_Page ->  _setLimit();
} 


/*
 * EUI :: _get_resource_query() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_resource_query()
 {
	$res = false;
	
	self::_get_content();
	
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		$res = $this -> EUI_Page -> _result();
		if($res) return $res;
		else
		{
			exit("Error :". mysql_error());
		}
	}	
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_page_number()
  {
	if( $this -> EUI_Page -> _get_query()!='' )
	{
		return $this -> EUI_Page -> _getNo();
	}	
  }
  
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _get_avail_product()
 {
	$datas = array();
	$sql = "select a.ProductId, a.ProductName FROM t_gn_product a";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows )
	{
		$datas[$rows['ProductId']] = $rows['ProductName'];
	}
	return $datas;
 }
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _get_method_prefix()
 {
	return array
	(
		'one-to-one' => 'One to One ',
		'one-to-many' => 'One to Many',
		'take-customize' => 'Customize'
	);
 } 
 
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _getPrefixId($ProductId=0 )
{
	$PrefixId = null;
	
	$this -> db->select('a.PrefixNumberId');
	$this -> db->from('t_gn_productprefixnumber a');
	$this -> db->where('a.ProductId',$ProductId);
	
	if( $avail = $this -> db->get()->result_first_assoc() ){
		$PrefixId = $avail['PrefixNumberId'];
	}
	
	return $PrefixId;
} 
 
/*
 * EUI :: _get_page_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _get_status_prefix()
 {
	return array(
		'0' => 'Not Active',
		'1' => 'Active'
	);
 }
 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 function _get_avail_form( $prefix = null )
 {
	$form = array();
	$form_avail_list = array();
	$_list_strips = array();
	
	if( isset($form_avail_list) )
	{
		if( !is_null($prefix) )
		{
			$form_avail_list = $this -> EUI_Tools -> _ls_get_dir(array("form/$prefix"), true);
			foreach( $form_avail_list as $k => $v ) 
			{
				$_list_strips = explode('.', $v);
				if(is_array($_list_strips) ) 
				{
					$form[$_list_strips[0]] = $_list_strips[0];
				}	
			}
		}
	}

	return $form;
 }
 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
 public function _seDelete() 
{
  $_conds = 0;
	if($this -> URI->_get_array_post('PrefixId'))foreach( 
		$this -> URI->_get_array_post('PrefixId') as  $key => $PrefixId ) 
	{
		$this ->db ->select('*');
		$this ->db ->from('t_gn_productprefixnumber a ');
		$this ->db ->where('a.PrefixNumberId', $PrefixId);
		if( $rows = $this ->db -> get() -> result_first_assoc() )
		{
			$this -> db->where('PrefixId', $rows['PrefixNumberId']);
			if( $this -> db->delete('t_gn_formlayout') )
			{
				$this -> db->where('PrefixNumberId', $rows['PrefixNumberId']);
				if( $this -> db->delete('t_gn_productprefixnumber') )
				{
					$_conds++;
				}
			}
		}
	}

	return $_conds;	
} 


 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
 
  private function _save_product_form($_post=null, $_insertid=0 )
 {
	$_conds = false;
	if( (!is_null($_post)) && ($_insertid!=0)) 
	{
		if( $this -> db -> insert("t_gn_formlayout", 
		array(
			'PrefixId' => $_insertid, 
			'EditView' => $_post['form_edit'], 
			'AddView' => $_post['form_input'], 
			'UrlView' => base_url()
			)
		)){
			$_conds = true;
		}
	}
	
	return $_conds;
}
   
 
 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
 private function _get_char_prefix($_code=null, $_length=0)
 {
	$_ret = null;
	if( (!is_null($_code)) && ($_length!=0))
	{
		$P = null;
		for( $n=1; $n<=$_length; $n++ ){
			$P.='0'; 
		}
		
		$L = null;
		if(!is_null($P) ){
			$L = $_code.substr($P,strlen($_code), strlen($P)); 	
		}
		
		if( !is_null($L)) 
			$_ret = $L;
	}
	
	return $_ret;
}
   
/*
 * EUI :: _set_save_prefix_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 function _set_save_prefix_number( $_prefix_post=null )
 {
	$tot = 0;
	$_get_chars = null;
	if(!is_null($_prefix_post) )
	{
		$_get_chars = self::_get_char_prefix( $_prefix_post['result_code'],  $_prefix_post['result_length'] );
		
		if( !is_null($_get_chars) )
		{
			//----------- reset write -----------
			
			$this->db->reset_write();
			$this->db->set("PrefixChar",$_get_chars);
			$this->db->set("PrefixMethod",$_prefix_post['result_method']);
			$this->db->set("ProductId", $_prefix_post['result_head_level']);
			$this->db->set("PrefixLength",$_prefix_post['result_length']);
			$this->db->set("PrefixFlagStatus", $_prefix_post['status_active']);
			
			$this->db->insert("t_gn_productprefixnumber");
			$prefixId = $this->db->insert_id();
			
		// ----------- set prefix data ----------------------
		
			if(($prefixId) 
				AND $this->_save_product_form($_prefix_post, $prefixId ) )
			{
				$tot++;		
			}
		}
	}
	
	return $tot;
 } 
 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
 public function _getPrefix()
{
 

 $arr_product_prefix = array();
 
 $out = new EUI_Object(_get_all_request());
 if(!$out->fetch_ready() ){
	return $arr_product_prefix;
 }
 
 // ------- reset select ---------------
 $this->db->reset_select();
 
 $this->db->select("*");
 $this->db->from("t_gn_productprefixnumber a ");
 $this->db->join("t_gn_formlayout b ","a.PrefixNumberId=b.PrefixId","LEFT");
 $this->db->join("t_gn_product c ","a.ProductId=c.ProductId","LEFT");
 $this->db->where("a.PrefixNumberId", $out->get_value('PrefixId'));

 $rs = $this->db->get();
  if( $rs->num_rows() >  0 )
 {
	 $arr_product_prefix = (array)$rs->result_first_assoc();
 }
 
 return $arr_product_prefix;
 
}

 
// -------------------------------------------------------------------

/*
 * @ package		_getPrefix() 
 * -------------------------------------------------------------------
 *
 * @ def			 
 * @ param			 
 */
 
function _setUpdate( $_prefix_post = null )
{
	$_conds = false;
	$_get_chars = self::_get_char_prefix( $_prefix_post['result_code'],  $_prefix_post['result_name'] );
	if( $this -> db ->update("t_gn_productprefixnumber",
	array
	(
		'PrefixChar' => $_get_chars,
		'ProductId' => $_prefix_post['result_head_level'],
		'PrefixLength' => $_prefix_post['result_name'], 
		'PrefixFlagStatus' => $_prefix_post['status_active'], 
					
	), array("PrefixNumberId"=>$_prefix_post['PrefixNumberId'])))
	{
		$_conds = true;
	}
	
	return $_conds;
}

// _setActive

function _setActive($_params = null )
{
	$_conds = 0;
	if( !is_null($_params) 
		AND is_array($_params) )
	{
		foreach($_params['PrefixId'] as $PrefixNumberId )
		{
			if( $this -> db -> update("t_gn_productprefixnumber",
				array("PrefixFlagStatus"=> $_params['Active']), 
				array("PrefixNumberId"=> $PrefixNumberId)
			))
			{
				$_conds+=1;
			}
		}
	}
	
	return $_conds;
}


}
?>