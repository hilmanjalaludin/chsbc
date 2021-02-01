<?php
/*
 * E.U.I 
 *
 
 * subject	: M_Utility modul 
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Utility/
 */
 
class M_Utility extends EUI_Model
{
	
/*
 * EUI :: _get_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 private static $Instance   = null; 
 public static function &Instance()
{
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	}	
	return self::$Instance;
}

/*
 * EUI :: _get_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_product()
{
	$datas = array();
	$qry = $this -> db -> query
	   (
			" SELECT a.ProductId, a.ProductName, a.ProductCode from t_gn_product a 
			  LEFT JOIN t_gn_productprefixnumber b on a.ProductId=b.ProductId 
			  WHERE a.ProductStatusFlag=1"
		);
	foreach( $qry -> result_assoc() as $rows )
	{
		$datas[$rows['ProductId']] = $rows['ProductName'];
	}
	
	return $datas;
}

function _get_paychannel()
{
	$datas = array();
	$qry = $this -> db -> query
	   (
			" SELECT a.PaymentTypeId,a.PaymentTypeCode,a.PaymentTypeDesc,a.Active
				from t_lk_paymenttype a 
				WHERE a.Active=1"
		);
	foreach( $qry -> result_assoc() as $rows )
	{
		$datas[$rows['PaymentTypeId']] = $rows['PaymentTypeDesc'];
	}
	
	return $datas;
}

/*
 * EUI :: _get_category_product() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_category_product()
{
	$qry = $this -> db -> query("select a.CategoryId, a.Description from t_lk_category a");
	foreach( $qry -> result_assoc() as $rows )
	{
		$datas[$rows['CategoryId']] = $rows['Description'];
	}
	
	return $datas;
	
}	

/*
 * EUI :: _get_campaign_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_campaign_number()
{
	$_number = 0;
	$qry = $this->db->query("select a.CampaignId from t_gn_campaign a ORDER BY a.CampaignId DESC ");
	if( $qry-> num_rows() > 0){
		$_number = ( (INT)$qry -> result_singgle_value()+1);
	}
	else{
		$_number = ($_number+1);
	}
	
	return $_number;
}	



/*
 * EUI :: _get_campaign_code_number() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
function _get_campaign_code_number()
{
	$_a = null;
	$_b = null;
	$_c = null;
	$_d = 7;
	
	for( $i=1; $i<=$_d; $i++){
		$_b.= '0'; 
	}
	
	$_e = substr( date('Y'),2,strlen(date('Y')));
	
  // set char concate && years now  = 14XXXXX;	
 
	if(!is_null($_b)){
		$_c = $_e.substr($_b,strlen($_e), strlen($_b));
	}
	
	
  // Set by number limit 
  
	$_f = self::_get_campaign_number();
	
	if(!is_null($_c) && ( $_f!=FALSE ))
	{
		$_a  = substr($_c,0, - (strlen($_f)));
		$_a .= $_f;  
	}
	
	return $_a;
}



	
}


?>