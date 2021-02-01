<?php 
class M_CallReminder extends EUI_Model
{

	private static $Instance   = null; 
  	
  	public static function &Instance()
 	{
		if( is_null(self::$Instance) ){
			self::$Instance = new self();
		}	
		return self::$Instance;
 	}
 
	/*  
	 * @ param  : PrimaryID ( INT ) / CustomerId / AppoinmentId / CallVerified ID  
	 * @ param  : - 
	 * ------------------------------------------------------------------------------
	 * @ notes  : - 
	 */ 
	public function _setUpdateAppoinment( $PrimaryID = null )
	{
  		$_conds = 0;
  		if( !is_null($PrimaryID) ) 
  		{
	 		$this->db->set('ApoinmentFlag',1);
	 		$this->db->where('AppoinmentId', $PrimaryID);
	 		$this->db->update('t_gn_appoinment');
	 
	 		if( $this->db->affected_rows() > 0 )
	 		{
				$_conds++;
	 		}
   		}
   		return $_conds;
	}

	/*  
	 * @ param  : PrimaryID ( INT ) / CustomerId / AppoinmentId / CallVerified ID  
	 * @ param  : - 
	 * ------------------------------------------------------------------------------
	 * @ notes  : - 
	 */ 
 	public function _getSelectAppoinment()
 	{
 		#var_dump( "DEBUG"); die();
		$_conds = array();
		$_date  = "'".date("Y-m-d")."'";

		// kondisi appoinment flexi
		$this->db->reset_select();
		$this->db->select("a.AppoinmentId, cs.CustomerId, 
			convert(VARCHAR(5), a.ApoinmentDate, 8) as TryCallAgain,
			cs.CampaignId, cs.CustomerFirstName",FALSE);

		$this->db->from("t_gn_appoinment a");
		$this->db->join("t_gn_customer  b ", "a.CustomerId=b.CustomerId","INNER");
		$this->db->join("t_gn_customer cs","b.CustomerNumber=cs.CustomerNumber AND cs.CampaignId=5 AND CONVERT(VARCHAR, cs.expired_date,23) >= {$_date}","INNER");
		$this->db->where("a.ApoinmentFlag", 0);
		$this->db->where("DATEADD(minute, 5, CONVERT(VARCHAR, GETDATE(),20)) >= CONVERT(VARCHAR, a.ApoinmentDate,20)");
		$this->db->where("CONVERT(VARCHAR, GETDATE(),20) <= a.ApoinmentDate");
		$this->db->where("YEAR(a.ApoinmentDate)>0");
		$this->db->where("b.CampaignId",9);
		$this->db->where_in("b.CallReasonId", array(10,11,12));
		$this->db->where("CONVERT(VARCHAR, b.expired_date,23) >= '".date("Y-m-d")."'");
		#$this->db->print_out();
		$res = $this->db->get();

		if( $res->num_rows() > 0 ) {
			$num_rows = $res->num_rows();
			$vol_rows = $res->row_array();
			$_conds['CustomerId'] 	= $vol_rows['CustomerId'];
			$_conds['CampaignId'] 	= $vol_rows['CampaignId'];
			$_conds['CustomerName'] = $vol_rows['CustomerFirstName'];
			$_conds['PrimaryID'] 	= $vol_rows['AppoinmentId'];
			$_conds['TryCallAgain']	= $vol_rows['TryCallAgain'];
		    $_conds['counter'] 		= (INT)$num_rows;

		    return $_conds;	
		}
		// End kondisi appoinment flexi
		

		$this->db->reset_select();
		$this->db->select("a.AppoinmentId, a.CustomerId, 
			/*date_format(a.ApoinmentDate,'%H:%i') as TryCallAgain,*/
			convert(VARCHAR(5), a.ApoinmentDate, 8) as TryCallAgain,
			b.CampaignId, b.CustomerFirstName",FALSE);
		$this->db->from("t_gn_appoinment a");
		$this->db->join("t_gn_customer  b ", "a.CustomerId=b.CustomerId","INNER");
		$this->db->join("t_gn_assignment c ", "a.CustomerId=c.CustomerId","INNER");
		$this->db->where("c.AssignSelerId", _get_session('UserId'));
		
		#$this->db->where("DATE_ADD(now(), INTERVAL '05:00' minute) >= a.ApoinmentDate");
		$this->db->where("DATEADD(minute, 5, CONVERT(VARCHAR, GETDATE(),20)) >= CONVERT(VARCHAR, a.ApoinmentDate,20)");

		$this->db->where("CONVERT(VARCHAR, GETDATE(),20) <= a.ApoinmentDate");
		#$this->db->where("NOW()<=a.ApoinmentDate");
	
		$this->db->where("YEAR(a.ApoinmentDate)>0");
		$this->db->where("a.ApoinmentFlag", 0);
		$this->db->where("b.expired_date >= '".date("Y-m-d")."'");
	
		// $this->db->where_not_in("b.CallReasonId", array(34,35,36,37));
		$this->db->where_in("b.CallReasonId", array(10,11,12));
	
		#$this->db->print_out();
		if( $rs = $this->db->get() )
		{
			$num_rows = $rs -> num_rows();
			if( $vol_rows = $rs -> result_first_assoc() )
			{
				$_conds['CustomerId'] 	= $vol_rows['CustomerId'];
				$_conds['CampaignId'] 	= $vol_rows['CampaignId'];
				$_conds['CustomerName'] = $vol_rows['CustomerFirstName'];
				$_conds['PrimaryID'] 	= $vol_rows['AppoinmentId'];
				$_conds['TryCallAgain']	= $vol_rows['TryCallAgain'];
				$_conds['counter'] 		= (INT)$num_rows;	
			}
		}
		return $_conds;
 	}



 
}
?>