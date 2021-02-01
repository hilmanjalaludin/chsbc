<?php
	Class M_Target Extends EUI_Model
	{
		function M_Target()
		{
		
		}
		
		function _get_user() 
		{
			$_data = array();
			$this -> db -> select('UserId, full_name, init_name');
			$this -> db -> from('tms_agent');
			
			if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ADMIN ){
				$this -> db -> where('handling_type', 9);
				$this -> db -> where('admin_id', $this ->EUI_Session ->_get_session('UserId'));
			}
			
			if( $this ->EUI_Session ->_get_session('HandlingType')==USER_ACCOUNT_MANAGER ) {
				$this -> db -> where('handling_type', 3);
				$this -> db -> where('act_mgr', $this ->EUI_Session ->_get_session('UserId') );
			}
			
			if( $this ->EUI_Session ->_get_session('HandlingType')==USER_SUPERVISOR ) {
				$this -> db -> where('handling_type', 13);
				$this -> db -> where('spv_id', $this ->EUI_Session ->_get_session('UserId') );
			}
			
			if( $this ->EUI_Session ->_get_session('HandlingType')==USER_LEADER ) {
				$this -> db -> where('handling_type', 4);
				$this -> db -> where('tl_id', $this ->EUI_Session ->_get_session('UserId') );
			}
			
			$this -> db -> where('user_state', 1);
			
			$this -> db -> order_by('full_name', 'ASC' );
			// echo $this->db->_get_var_dump();
			foreach( $this -> db -> get() -> result_assoc() as $rows ) 
			{
				$_data[$rows['UserId']] = $rows;
			}
			
			return $_data;
		}
		
		function _get_target() 
		{
			$_data = array();
			$this -> db -> select('a.ForUserId, MAX(a.TargetCreatedDate) Tgl, MAX(a.PIFTarget) PIF, MAX(a.ANPTarget) ANP');
			$this -> db -> from('t_gn_target a');
			$this -> db -> where('DATE(a.TargetCreatedDate) != CURDATE()');
			$this -> db -> group_by('a.ForUserId');
			// echo $this->db->_get_var_dump();
			foreach( $this -> db -> get() -> result_assoc() as $rows ) 
			{
				$_data[$rows['ForUserId']] = $rows;
			}
			
			return $_data;
		}
		
		function Save()
		{
			$List	= $this -> URI -> _get_post('listID');
			$UserId	= explode(",",$List);
			
			// print_r($UserId);
			foreach($UserId as $List => $rows) {
				$this->db->set('ForUserId', $rows);
				$this->db->set('PIFTarget', $this -> URI -> _get_post('PIFTarget_'.$rows));
				$this->db->set('ANPTarget', $this -> URI -> _get_post('ANPTarget_'.$rows));
				$this->db->set('CreatedBy', $this ->EUI_Session ->_get_session('UserId'));
				$this->db->insert('t_gn_target'); 
			}
		}
	}
?>