<?php
class M_ChatWith extends EUI_Model
{
	private static $instance = null;
 	// patern 
 
 	public static function &get_instance() 
 	{
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
 	}
 
 	// aksesor 
 	function M_ChatWith() {}
 
 
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */
	protected function _select_user_top_level( $arr_field = array(), $where = '' )
	{
		$arr_result = array();
		if( !is_array( $arr_field ) ){
			$arr_field = array($arr_field);
		}
		$this->db->reset_select();	
		$this->db->select($arr_field, false);
		$this->db->from("tms_agent");
		$this->db->where($where);
		$rs = $this->db->get();
	
		if( $rs->num_rows() > 0 ) {
			foreach( $rs->result_first_assoc()  as $field  => $val )
			{
				$arr_result[$val] = $val;
			}
		}
		return $arr_result;
	} 
 
	// --------------------------------------------------------------------------------------------------------------------------
	/*
	 * @ package  	user searc data .
	 * @ note		eweh note.
	 */
 	public function _getUserReady()
	{
  		$arr_where_in = array();
 		$arr_user_online = array();
  
		 /*asli*/
		//  $arr_where_in = $this->_select_user_top_level(
		// 	array("spv_id", "tl_id", "quality_id", "mgr_id"), 
		// 	array("UserId" => _get_session('UserId'))
		// );

		// --------------------------------------------------------------------------------------------------------------------------
		if(in_array(_get_session('HandlingType'), array( USER_AGENT_OUTBOUND ))){
			$arr_where_in = $this->_select_user_top_level(
				array("spv_id"), 
				array("UserId" => _get_session('UserId'))
			);
		}else if (in_array(_get_session('HandlingType'), array( USER_SUPERVISOR ))){
			$arr_where_in = $this->_select_user_top_level(
				array("tl_id"), 
				array("UserId" => _get_session('UserId'))
			);
		}

		// var_dump($arr_where_in);die();
  		

		// var_dump($arr_where_in);die()
		//16122016 penambahan filter chat agent2mgr
		// --------------------------------------------------------------------------------------------------------------------------
  	$this->db->reset_select();
  	$this->db->select("
		a.UserId as UserId, 
		a.id as Username, 
		a.full_name as Fullname, 
		b.name as profileid , 
		/*IF(a.logged_state=1, 'Login','Logout') as LoginStatus*/
		CASE WHEN (a.logged_state=1) THEN 'Login' ELSE 'Logout' END as LoginStatus", 
  	FALSE);
  
  	$this->db->from("tms_agent a ");
  	$this->db->join("tms_agent_profile b" , "a.profile_id=b.id" , "left");
  	$this->db->where("a.user_state",1);
 	// $this->db->where("a.logged_state",1);
 	// ----- user admin privilege -------------------------------------

 	if( in_array(_get_session('HandlingType'),  array( USER_ROOT )) ) {
    	// select -- ALL --- 	
 	}	
 
  	if( in_array(_get_session('HandlingType'), array( USER_QUALITY_STAFF )) )
 	{
		$this->db->where('a.UserId != ',_get_session('UserId'),FALSE);
    	$this->db->where_in('a.handling_type',array(
			USER_SUPERVISOR,USER_QUALITY_STAFF,USER_QUALITY_HEAD, 
			USER_QUALITY, 
			USER_LEADER));		
 	}	
 
  	if( in_array(_get_session('HandlingType'), array( USER_QUALITY_HEAD )) )
 	{
		$this->db->where('a.UserId != ',_get_session('UserId'),FALSE);
   //  	$this->db->where_in('a.handling_type',array(
			// USER_SUPERVISOR,USER_QUALITY_STAFF,USER_QUALITY_HEAD,
			// USER_QUALITY, 
			// USER_LEADER));		
		if("a.UserId =='45' "){
			$this->db->where("a.admin_id = '3'");
		}else{
			$this->db->where("a.admin_id = '3'");
			// $this->db->where_in('a.handling_type',array(
			// USER_SUPERVISOR,USER_QUALITY_STAFF,USER_QUALITY_HEAD, 
			// USER_QUALITY, 
			// USER_LEADER));
		}
		// end commit 4c6563ee 
 	}
 
	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_ADMIN )) )
 	{
		// start commit 4c6563ee
		if("a.admin_id =='2' "){
			$this->db->where("a.admin_id = '3'");
		}else{
			$this->db->where('a.admin_id',_get_session('UserId'));
		}
		// end commit 4c6563ee 

 	}

	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_ACCOUNT_MANAGER )) )
 	{
		
		$this->db->where('a.act_mgr',_get_session('UserId'));	
 	}
 
	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_MANAGER )) )
 	{
		$this->db->where('a.UserId != ',_get_session('UserId'),FALSE);
		$this->db->where('a.mgr_id',_get_session('UserId'));
		$this->db->or_where('a.handling_type', 5);	
 	}
 
 	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_SUPERVISOR )) )
 	{
		$this->db->where('a.spv_id',_get_session('UserId'));
		$this->db->where('a.UserId <> ',_get_session('UserId'),FALSE);
		$this->db->or_where('a.mgr_id',_get_session('ManagerId'));
		$this->db->where('a.handling_type', 2);	
		$this->db->or_where('a.handling_type', 5);
		$this->db->or_where('a.handling_type', 3);
		// start commit cfd5a444 
		$this->db->or_where('a.handling_type', 1);
		// end commit cfd5a444 
		$this->db->where('a.UserId <> ',_get_session('UserId'),FALSE);
 	}
 
	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_LEADER )) )
 	{
		$this->db->where('a.tl_id',_get_session('UserId'));	
		$this->db->or_where('a.profile_id' , 11);
		$this->db->or_where('a.profile_id' , 5);
 	}
 
 	// ----- user admin privilege -------------------------------------
 	if( in_array(_get_session('HandlingType'), array( USER_AGENT_INBOUND )) )
 	{
		$this ->db ->where_in('a.UserId',$arr_where_in);	
 	}
 
 	// ----- user admin privilege -------------------------------------
  	if( in_array(_get_session('HandlingType'), array( USER_AGENT_OUTBOUND )) )
 	{
		$this ->db ->where_in('a.UserId',$arr_where_in);
 	}
 
 	if( in_array(_get_session('HandlingType'), array( USER_QUALITY_STAFF )) )
 	{
		$this ->db ->where_in('a.handling_type',5);	
 	}
 
 
	 $rs = $this->db->get();
	// var_dump('rs',$this->db->last_query());die();

 	if( $rs->num_rows() > 0 ) 
 	{
		$arr_user_online = (array)$rs->result_assoc();
 	}
 	//echo $this->db->last_query();
 	return $arr_user_online;
 
}
 
	
}
?>