<?php 
class M_ProductInfo extends EUI_Model
{
	private static $Instance = null;
	public static function & Instance(){
		if( is_null(self::$Instance)){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){
		$this->load->model(array('M_ProductForm','M_SysUser'));
	}
	
	function _get_data_form($_cust_id)
	{
		$_datas = array();
		
		$sql = "SELECT * FROM t_gn_frm_hospin a
				WHERE a.CustomerId = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _select_personal_premi( $arr_cond = array() ){
		$out = new EUI_Object( $arr_cond );
		$totals = array( 'ProductPlanId' => 0, 'ProductPlanPremium' => 0);
		
		$this->db->reset_select();
		$this->db->select('a.ProductPlanId, a.ProductPlanPremium');
		$this->db->from('t_gn_productplan a');
		
	// --------- ProductId  --------------		
		// $this->db->where('a.ProductId', $out->get_value('ProductId','intval'), FALSE);
		$this->db->where('a.PremiumGroupId', $out->get_value('Coverage','intval'), FALSE);
		// $this->db->where('a.PayModeId', $out->get_value('PayMode','intval'), FALSE);
		$this->db->where('a.ProductPlan', $out->get_value('Plan','intval'), FALSE);
		// $this->db->where('a.GenderId', $out->get_value('GenderId','intval'), FALSE);
		// $this->db->where('a.PremiTypeId', $out->get_value('PremiTypeId','intval'), FALSE);
		if($out->get_value('premiAge','intval')!="child"){
			$this->db->where("{$out->get_value('premiAge','intval')} BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd", NULL , FALSE);
		}
		
		
		$rs = $this->db->get();
		// echo $this->db->last_query();
		 if( $rs->num_rows() == 1 )
		{
			return (array)$rs->result_first_assoc();
		} 	
		
		return new EUI_Object($totals);
	}
	
	public function _set_row_save_premi($out=null){
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
 
		$obOut   =& get_class_instance('M_SysUser');
		$obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));

		$this->db->reset_write();
		$this->db->set('CustomerId'	,$out->get_value('CustomerId','intval'));
		$this->db->set('name_main'	,$out->get_value('name_main','strtoupper')); 
		$this->db->set('dob_main'	,$out->get_value('dob_main','_getOptionDate'));
		$this->db->set('age_main'	,$out->get_value('age_main','intval')); 
		$this->db->set('sex_main'	,$out->get_value('sex_main','intval')); 
		$this->db->set('name_spouse',$out->get_value('name_spouse','strtoupper'));
		$this->db->set('dob_spouse'	,$out->get_value('dob_spouse','_getOptionDate'));
		$this->db->set('age_spouse'	,$out->get_value('age_spouse','intval'));
		$this->db->set('sex_spouse'	,$out->get_value('sex_spouse','intval'));
		$this->db->set('name_c1'	,$out->get_value('name_c1','strtoupper'));
		$this->db->set('dob_c1'		,$out->get_value('dob_c1','_getOptionDate'));
		$this->db->set('age_c1'		,$out->get_value('age_c1','intval'));
		$this->db->set('sex_c1'		,$out->get_value('sex_c1','intval'));
		$this->db->set('name_c2'	,$out->get_value('name_c2','strtoupper'));
		$this->db->set('dob_c2'		,$out->get_value('dob_c2','_getOptionDate'));
		$this->db->set('age_c2'		,$out->get_value('age_c2','intval'));
		$this->db->set('sex_c2'		,$out->get_value('sex_c2','intval'));
		$this->db->set('name_c3'	,$out->get_value('name_c3','strtoupper'));
		$this->db->set('dob_c3'		,$out->get_value('dob_c3','_getOptionDate'));
		$this->db->set("age_c3"		,$out->get_value('age_c3','intval')); 
		$this->db->set('sex_c3'		,$out->get_value('sex_c3','intval'));
		$this->db->set('monthly_premium',$out->get_value('monthly_premium','intval'));
		$this->db->set('coverage'	,$out->get_value('coverage','intval'));
		$this->db->set("plan"		,$out->get_value('plan','intval'));
		// $this->db->set('create_date',date('Y-m-d H:i:s'));
		$this->db->set('create_by'	,$obUsr->get_value('UserId','intval'));

		$this->db->insert('t_gn_frm_hospin');
		if( $this->db->affected_rows() > 0 ){
			$hospinid = $this->db->insert_id();
			return true;
		}else{
			$this->db->set('name_main'	,$out->get_value('name_main','strtoupper')); 
			$this->db->set('dob_main'	,$out->get_value('dob_main','_getOptionDate'));
			$this->db->set('age_main'	,$out->get_value('age_main','intval')); 
			$this->db->set('sex_main'	,$out->get_value('sex_main','intval')); 
			$this->db->set('name_spouse',$out->get_value('name_spouse','strtoupper'));
			$this->db->set('dob_spouse'	,$out->get_value('dob_spouse','_getOptionDate'));
			$this->db->set('age_spouse'	,$out->get_value('age_spouse','intval'));
			$this->db->set('sex_spouse'	,$out->get_value('sex_spouse','intval'));
			$this->db->set('name_c1'	,$out->get_value('name_c1','strtoupper'));
			$this->db->set('dob_c1'		,$out->get_value('dob_c1','_getOptionDate'));
			$this->db->set('age_c1'		,$out->get_value('age_c1','intval'));
			$this->db->set('sex_c1'		,$out->get_value('sex_c1','intval'));
			$this->db->set('name_c2'	,$out->get_value('name_c2','strtoupper'));
			$this->db->set('dob_c2'		,$out->get_value('dob_c2','_getOptionDate'));
			$this->db->set('age_c2'		,$out->get_value('age_c2','intval'));
			$this->db->set('sex_c2'		,$out->get_value('sex_c2','intval'));
			$this->db->set('name_c3'	,$out->get_value('name_c3','strtoupper'));
			$this->db->set('dob_c3'		,$out->get_value('dob_c3','_getOptionDate'));
			$this->db->set("age_c3"		,$out->get_value('age_c3','intval')); 
			$this->db->set('sex_c3'		,$out->get_value('sex_c3','intval'));
			$this->db->set('monthly_premium',$out->get_value('monthly_premium','intval'));
			$this->db->set('coverage'	,$out->get_value('coverage','intval'));
			$this->db->set("plan"		,$out->get_value('plan','intval'));
			$this->db->set('update_date',date('Y-m-d H:i:s'));
			$this->db->set('create_by'	,$obUsr->get_value('UserId','intval'));

			$this->db->where('CustomerId',$out->get_value('CustomerId'));
			$this->db->update('t_gn_frm_hospin');
			
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
		}
	}
}


?>