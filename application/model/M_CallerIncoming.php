<?php


class M_CallerIncoming extends EUI_Model{
	
	private static $Instance = null;
	var $income_reason = array();

	public static function & Instance(){
		if( is_null(self::$Instance)){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){
		$this->load->model(array('M_ProductForm','M_SysUser'));
		$this->income_reason = array(
			'Fix'=>'Outbound Income Update Recorded',
			'Range'=>'Range',
			'HouseWife'=>'Outbound Recorded - Housewife'
		);
	}

	public function _getDetailCustomer($CustomerId=null){
		// default query by sprintf function on perl.
		$this->row = array();
		$this->sql = sprintf("SELECT a.*, b.Gender, c.Salutation, d.CampaignName, d.CampaignNumber, e.CallReasonDesc, e.CallReasonCategoryId,
					f.TableDetail, f.ViewVerification, f.ViewProductInfo, f.ViewCdd
						FROM t_gn_customer a
						LEFT JOIN t_lk_gender b ON a.GenderId=b.GenderId
						LEFT JOIN t_lk_salutation c ON a.SalutationId=c.SalutationId
						LEFT JOIN t_gn_campaign d ON a.CampaignId=d.CampaignId
						LEFT JOIN t_gn_campaign_ref f ON a.CampaignId=f.CampaignId
						LEFT JOIN t_lk_callreason e ON a.CallReasonId=e.CallReasonId
						WHERE a.CustomerId = '%s'", $CustomerId );
		// echo $this->sql;
		$qry = $this->db->query( $this->sql );
		#var_dump( $this->db->last_query() ); die();

		if( $qry && $qry->num_rows() > 0 ) {
			$this->row = $qry->result_first_assoc();
			
		}
		return (array)$this->row;
	}

	public function _getDetailSecondProduct($CustomerId=null){
		$date_now = date('Y-m-d');

		$this->row = array();
		$this->sql = sprintf("SELECT ctm.*, b.Gender, c.Salutation, d.CampaignName, d.CampaignNumber, e.CallReasonDesc, e.CallReasonCategoryId,
					f.TableDetail, f.ViewVerification, f.ViewProductInfo, f.ViewCdd
			FROM t_gn_customer a
			
			INNER JOIN t_gn_attr_pil_xsell xsel ON a.CustomerId = xsel.CustomerId
			INNER JOIN t_gn_attr_flexi flex ON (xsel.Custno1 = flex.Custno AND xsel.prog_code = flex.prog_code AND xsel.Data_Month = flex.Data_Month)
			INNER JOIN t_gn_customer ctm ON ctm.CustomerId = flex.CustomerId
			
			LEFT JOIN t_lk_gender b ON ctm.GenderId=b.GenderId
			LEFT JOIN t_lk_salutation c ON ctm.SalutationId=c.SalutationId
			LEFT JOIN t_gn_campaign d ON ctm.CampaignId=d.CampaignId
			LEFT JOIN t_gn_campaign_ref f ON ctm.CampaignId=f.CampaignId
			LEFT JOIN t_lk_callreason e ON ctm.CallReasonId=e.CallReasonId

			WHERE a.CustomerId = '%s'
			
			/*AND a.expired_date >= CONVERT(VARCHAR(10), GETDATE(), 23) 
			AND ctm.expired_date >= CONVERT(VARCHAR(10), GETDATE(), 23)
			AND concat(LEFT(xsel.Data_Month, 4),'-',RIGHT(xsel.Data_Month, 2)) = CONVERT(VARCHAR(7), getdate(), 23)*/
			AND CONVERT(VARCHAR(10), a.expired_date, 23)   >= '{$date_now}'
			AND CONVERT(VARCHAR(10), ctm.expired_date, 23) >= '{$date_now}'

			AND xsel.prog_code = 'C01'", $CustomerId);
		
		// echo $this->sql;
		$qry = $this->db->query( $this->sql );
		// var_dump( $this->db->last_query() ); die();

		if( $qry && $qry->num_rows() > 0 ) {
			$this->row = $qry->result_first_assoc();
			
		}
		return (array)$this->row;
	}

	public function _getDetailAttr($table, $CustomerId=null){
		// default query by sprintf function on perl.
		$this->row = array();
		$this->sql = sprintf("SELECT *
						FROM ".$table." a
						WHERE a.CustomerId = '%s'", $CustomerId );
		// echo $this->sql;
		$qry = $this->db->query( $this->sql );
		if( $qry && $qry->num_rows() > 0 ) {
			$this->row = $qry->result_first_assoc();
			
		}
		return (array)$this->row;
	}
 
	/*public function _getVerifStat($CustomerId){
		$sql=$this->db->get_where('t_gn_ver_status',array('cust_id'=>$CustomerId,'ver_result'=>1));
		
		#var_dump( $this->db->last_query() ); die();
		$num=$sql->num_rows();
		if($num>0){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function _getCddStat($CustomerId){
		$sql=$this->db->get_where('t_gn_cdd',array('CustId'=>$CustomerId));

		#var_dump( $this->db->last_query() ); die();
		$num=$sql->num_rows();
		if($num>0){
			return 1;
		}
		else{
			return 0;
		}
	}*/

	function _getCustomerIdfromCallSession($CallSessionId=null){
		// default query by sprintf function on perl.
		$this->row = array();
		// $this->sql = sprintf("SELECT * FROM ".$table." a WHERE a.CustomerId = '%s'", $CallSessionId );
		$this->sql = sprintf("SELECT a.assign_id FROM cc_call_session a WHERE a.session_id = %s", $CallSessionId); // 1571222157784318
		// echo $this->sql;
		$qry = $this->db->query( $this->sql );
		if( $qry && $qry->num_rows() > 0 ) {
			$this->row = $qry->result_first_assoc();
			
		}
		return (array)$this->row;
	}




}

?>