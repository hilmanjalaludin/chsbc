<?php

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
class M_MgtLockCustomer extends EUI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function _getLockType()
    {
        $data=array();
        $this->db->reset_select();
        $this->db->select("*", false);
        $this->db->from("t_lk_lock_type");

        $rs = $this->db->get();
        if( $rs->num_rows() > 0 )
        {		
                foreach( $rs ->result_assoc() as $rows )
                {
                        $data['combo'][$rows['id_lock_type']] =  $rows['column_label'];
                        $data['db_column'][$rows['id_lock_type']] =  $rows['lock_column'];
                        $data['call_func'][$rows['id_lock_type']] =  $rows['func_form'];
                        $data['query_method'][$rows['id_lock_type']] =  $rows['query_method'];
                        $data['tag'][$rows['id_lock_type']] =  $rows['tag_id'];
                }
        }
        return $data;
    }
    
    public function getLockWhere()
    {
        $conds = NULL;
 
        if(in_array(_get_session('HandlingType'), 
            array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND) ) )
        {
            $this->db->reset_select();	
            $this->db->select('*', FALSE);
            $this->db->from('t_gn_lock_filter a ');
            $this->db->join('t_lk_lock_type b','a.id_lock_type=b.id_lock_type','INNER');
            $this->db->where('a.lock_tmr_id',_get_session('UserId'));
            $rs = $this->db->get();
            if( $rs->num_rows() > 0 )
            {
                $conds = $rs ->result_assoc();
            }
        }
        return $conds;
    }
    
    public function setLockNow($out)
    {
        $status = false;
		$counter = 0;
        $lock_type = $this->_getLockType();
		$arr_user  = explode(',',$out->get_value('lock_user_list'));
        $param_tag =  $lock_type['tag'][$out->get_value('cmb_lock_type')];
        
		foreach($arr_user as $key=>$val)
		{
			$this->db->reset_write();
			$this->db->set("lock_tmr_id", $val);
			$this->db->set("id_lock_type", $out->get_value('cmb_lock_type'));
			$this->db->set( "lock_parameter", $out->get_value($param_tag));
			$this->db->insert("t_gn_lock_filter");
			
			if($this->db->affected_rows() > 0)
			{
				$counter++;
			}
			else
			{
				$this->db->reset_write();
				
				$this->db->set( "lock_parameter", $out->get_value($param_tag));
				$this->db->where("id_lock_type", $out->get_value('cmb_lock_type'));
				$this->db->where("lock_tmr_id", $val);
				$this->db->update("t_gn_lock_filter");
				$counter++;
			}
		}
		
		if($counter>0)
		{
			$status = true;
		}
		
        return $status;
    }
    
    public function _unlockNow($out)
    {
        $status = false;
        $LockId = $out->get_array_value('LockId');
        if(count($LockId)>0)
        {
            foreach ($LockId as $key => $id) {
                $this->db->where('id_lock_filter', $id);
                $this->db->delete('t_gn_lock_filter');
            }
            $status = true;
        }
        return $status;
    }
    
    public function _select_page_lock($out)
    {
        $call_status = CallResultNotInterestBadlead();
        $arr_lock_data=array();
        $this->db->select("a.id_lock_filter as id,
			b.lock_column,
            a.lock_parameter,
            b.param_to_format,
            b.column_label,
            c.id as user_id,c.full_name", 
        FALSE);
        
        $this->db->from("t_gn_lock_filter a");
        $this->db->join("t_lk_lock_type b "," a.id_lock_type=b.id_lock_type", "INNER");
        $this->db->join("tms_agent c "," a.lock_tmr_id=c.UserId ","INNER");
 
        if( _have_get_session('UserId') 
            AND _get_session('HandlingType') ==USER_SUPERVISOR )
        {
            $this->db->where("c.spv_id", _get_session('UserId'));
        }
        
        // ----------- set order -------------------------
	
        if( _get_have_post("orderby") ){
               $this->db->order_by($out->get_value("orderby"), $out->get_value("type") );
        } else {
               $this->db->order_by("a.id_lock_filter", "DESC");
        }
        
        // $this->db->print_out();
 
        $rs = $this->db->get();
        if( $rs->num_rows() > 0 )
        {
            foreach ($rs->result_assoc() as $rows => $cols) 
            {
                if(in_array($cols['param_to_format'],array("array")))
                {
					if( in_array($cols['lock_column'],array("CallReasonId")) )
					{
						$arr_lock_data[$rows]['lock_parameter'] = $this->convert_value($cols['lock_parameter'],$call_status);
					}
					else{
						$arr_lock_data[$rows]['lock_parameter'] = implode(', ',explode(',',$cols['lock_parameter']));
					}
                    
                }
                else 
                {
                    $arr_lock_data[$rows]['lock_parameter'] =$cols['lock_parameter'];
                }
				
                $arr_lock_data[$rows]['id'] =$cols['id'];
                $arr_lock_data[$rows]['column_label'] =$cols['column_label'];
                $arr_lock_data[$rows]['user_id'] =$cols['user_id'];
            }
        }

         return $arr_lock_data;
    }
    
    private function convert_value($string_id,$array_value)
    {
        $temp=array();
        $array_id = explode(",",$string_id);
        foreach ( $array_id as $index => $id) 
        {
            $temp[$index] = $array_value[$id];
        }
        return implode(", ",$temp);
    }
	
	public function _getUserRecsource($UserId=null, $like_recsource="") 
	{
		 $ar_recsource = array();
		 //var_dump($UserId);
		 $this->db->reset_select();
		 $this->db->select("a.Recsource", false);
		 $this->db->from("t_gn_customer a");
		 $this->db->join("t_gn_assignment b "," a.CustomerId=b.CustomerId", "INNER");
		 
		 
		if( _have_get_session('UserId') 
            AND _get_session('HandlingType') ==USER_MANAGER )
        {
            $this->db->where("b.AssignMgr", _get_session('UserId'));
        }
		
		if( _have_get_session('UserId') 
            AND _get_session('HandlingType') ==USER_SUPERVISOR )
        {
            $this->db->where("b.AssignSpv", _get_session('UserId'));
        }
		 
		if( _have_get_session('UserId') 
            AND _get_session('HandlingType') ==USER_AGENT_OUTBOUND )
        {
            $this->db->where_in("b.AssignSelerId", _get_session('UserId'));
        } 
		 
        $date = " date(now())"; // mysql
        if( QUERY == 'mssql') {
            $date = " CONVERT(date,GETDATE())";
        }
        $this->db->where("a.expired_date >= {$date}");
        
        // ADD LIKE | OPTIONAL
        if( $like_recsource != "" ) {
            $this->db->or_like('LOWER(a.Recsource)', strtolower($like_recsource));
        }
        // END ADD LIKE | OPTIONAL

		$this->db->group_by("a.Recsource");
		#$this->db->print_out(); 
		if( QUERY == 'mysql' ) {
            if( mysql_errno() ){
                return $ar_recsource();
            }
        }
		 
		$rs = $this->db->get();
		if( $rs->num_rows()>  0  ) {
            foreach( $rs->result_assoc() as $rows )
		    {
                $ar_recsource[$rows['Recsource']] = $rows['Recsource'];
		    }
        }
		return (array)@$ar_recsource;
	 
	}
}

