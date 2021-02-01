<?php

/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
 
class M_Template extends EUI_Model
{


private static $instance = null;


/*
 * @ def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */

 
public static function & get_instance()
{
	if( is_null(self::$instance) )
	{
		self::$instance = new self();
	}
	
	return self::$instance;
}

/*
 * @ def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
public function __construct()
{
	// run 
}


/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
function _getDetailTemplate($TemplateId = null)
 {	
	$_data = array();
	
	if( !is_null($TemplateId))
	{
		$this -> db -> select('*');
		$this -> db -> from('t_gn_template');
		$this -> db -> where( array('TemplateId'=>$TemplateId) );
		
		$qry = $this->db->get();
		// if( !$qry->EOF() )
		if( $qry->num_rows() > 0 )
		{
			$_data = $qry -> result_first_assoc();
		}
	}
	
	return $_data;
}
/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
 
function _getTemplateRows($TemplateId= null )
{
	$tmp = null;
	
	$this->db->select("a.UploadColsName , a.UploadColsOrder");
	$this->db->from("t_gn_detail_template a ");
	$this->db->where("a.UploadTmpId", $TemplateId);
	$this->db->order_by("a.UploadColsOrder", "ASC");
	
	$i= 0;
	foreach( $this->db-> get() -> result_assoc() as $rows ){
		$tmp[$i] = $rows['UploadColsName'];
		$i++;
	}
	
	return $tmp;

}

/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
public function _select_row_index($TemplateId= null )
{
	$tmp = null;
	$this->db->reset_select();
	$this->db->select("a.UploadColsAlias , a.UploadColsOrder");
	$this->db->from("t_gn_detail_template a ");
	$this->db->where("a.UploadTmpId", $TemplateId);
	$this->db->order_by("a.UploadColsOrder", "ASC");
	
	$qry = $this->db-> get();
	if($qry->num_rows() > 0) 
		foreach( $qry->result_assoc() as $rows ) 
	{
		$tmp[strtoupper($rows['UploadColsAlias'])] = $rows['UploadColsOrder'];
	}
	
	return $tmp;

}
/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
function _getTemplateName($TemplateId= null )
{

    $_template = array();
	
	$this -> db -> select('*');
	$this -> db -> from('t_gn_template');
	$this -> db -> where('TemplateFlags',1);
	
	if( !is_null($TempalateId) ) 
	{
		$this -> db -> where('TemplateId',$TempalateId);	
	}
	
	foreach($this -> db -> get() -> result_assoc() as $rows ) 
	{
		$_template[$rows['TemplateId']] = $rows['TemplateName'];
	}
	
	return $_template;
}

/*
 * @def : get uplaod tempalate name 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
function _getExtension( $FileName=null )
{ 
	$_name = null; $_data = explode('.',$FileName );
	if(is_array($_data) )
	{
		$_name = strtoupper( $_data[count($_data)-1] );
	}
	
	return $_name;
} 

// -----------------------------------------------------------------------------
/*
 * @ pack  : convert array value to upper case 
 * @ notes : this upload not strike 
 * @ out   : will find lable tpl On db 
 */
 
 public function _set_arr_uppercase( $arr_to_uppercase = null )
{
	$arr_map_uppercase  = array_map("strtoupper", $arr_to_uppercase );
	return array_map("trim", $arr_map_uppercase); 
}


// -----------------------------------------------------------------------------
/*
 * @ pack  : matching by label name on db & upload file 
 * @ notes : this upload not strike 
 * @ out   : will find lable tpl On db 
 */
protected function _getMatchLabel( $arr_tpl_header = null, $arr_tpl_database = null )
{

// if is null only 
if( is_null($arr_tpl_header) OR is_null($arr_tpl_header) OR !is_array( $arr_tpl_header )  OR !is_array($arr_tpl_database )  )	
{
	return FALSE;
}
 
// skip data 
 $arr_key_tpl_header = self::_set_arr_uppercase(array_values($arr_tpl_header));
 $arr_key_tpl_database = self::_set_arr_uppercase(array_values($arr_tpl_database));

// on exlude of field check ist get Indek o columns 
 $arr_notification_true = array();
 $arr_notification_unix = array();
 $arr_notification_false = array();
//  var_dump($arr_key_tpl_database);
//  var_dump($arr_key_tpl_header);
//  die();
 //  re index data 
 if(is_array( $arr_key_tpl_header )) 
  foreach( $arr_key_tpl_header as $i => $field )
 {	
	if( self::get_int_template( $field, $arr_key_tpl_database) )
	{
		$arr_notification_unix[$field] = $i;
		$arr_notification_true[$i] = $field;
	} else {
		#var_dump( $field ); var_dump( 'DEBUGING'); var_dump( $arr_key_tpl_database ); die();
	}
 }

  // @pack : then open data array its  ----------------------------------> 
//   var_dump($arr_notification_unix);
//   var_dump(count($arr_notification_unix) );
//   var_dump(count( $arr_key_tpl_database));
//   die;
  if(  count($arr_notification_unix) == count( $arr_key_tpl_database) )
  {
	return TRUE;
  } else {
	return array_diff($arr_key_tpl_database, array_keys($arr_notification_unix)); 
  }
  
} 
// _getMatchLabel ===========================> 

// -----------------------------------------------------------------------------
/*
 * @ pack  : order get inde data on order 
 * @ notes : this upload not strike 
 * @ out   : will find lable tpl On db 
 */
public function _find_arr_value( $arr1 = null, $arr2=null, $Template=null )
{ 
	$arr_label_index = null;
	$arr_id = $Template['TemplateId'];
	
	// on tpl id  asumstion start cols = 1 -------------------------------------------
	$arr_index = null;
	if($arr_id){
		$arr_index = self::_select_row_index( $arr_id );
	}
	
	if(is_array( $arr1 ) AND is_array($arr2) )
		foreach( $arr1 as $key => $field )
	{
		if( self::get_int_template( $field, $arr2)  )
		{
			if( is_array($arr_index) ) {
				$arr_label_index[$arr_index[$field]] = $field;
			}
		}
	}
	return $arr_label_index;
	
 }
 

// -----------------------------------------------------------------------------
/*
 * @ pack  : order get inde data on order 
 * @ notes : this upload not strike 
 * @ out   : will find lable tpl On db 
 */
 
  public function get_int_template($field=null, $arr_find = null  )
 { 
	if( !is_array($arr_find) )
	{
		return FALSE;
	}
	
	if( in_array($field, $arr_find ) )
	{
		return TRUE;
	}
	
 }
 
 
/*
 * @def : match columns  
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
 public function _getMatch( $Excel = null, $Database= null , $is_strict = FALSE )
{
	// echo "test";
	// die;

// if get on strict mode -------------------------------> 

 if( $is_strict) {
	return self::_getMatchLabel($Excel, $Database);
 }
// echo "test";
// die; 
  
 // if get on no strict mode -------------------------------> 
 $array_result = TRUE;
 $_keyups = array_keys($Database);
 $_values = array_values($Database); 
 $_conds = array(); $tots = 0; $totals = 0;
 
 foreach( $Excel as $k => $v ) 
 {
	if(in_array(trim($v), $_values)) {
		$tots+=1; 	
	} else  {
		$_conds[$totals]= array('N'=>$v, 'Y' => $_values[$totals]); 
	}
	
	$totals++;
 }


 if( $tots != $totals ) {
	$array_result = $_conds;
 }	

 return $array_result;
	
 }
 
 /*
 * @def : get validate order set then edit by User  
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
 public function _getOrder( $Excel = null, $Database= null, $is_strict = FALSE )
{

// --------------------------------------------------------
// @ pack : mode strict upload template 

 if( $is_strict ) {
	return TRUE;
 }

// @ pack : not strict  ------------------------------> 
 $UrutData = array();
 $_values  = array_values($Database);

 // urutkan kembali datanya 	
	$i = 0;
	foreach($Excel as $kdb => $Data ){
		$UrutData[$i] = $Data;	
		$i++;
	}
	
	// cek posisi table && excel 
	
	$j = 0; $n = 1; $_not_ok = 0; $position = '';
	while(true)
	{
		if( strtoupper(trim($_values[$j])) != strtoupper(trim($UrutData[$j])) ) 
		{
			$position[$_not_ok]=  array(
				"N" => " pos : {$n}, Excel : {$UrutData[$j]}", 
				"Y" => " pos : {$n}, Database : {$_values[$j]} " 
			); 
			$_not_ok++;
		}
		
		if( $j==count($_values)) break;
		$n++; $j++;
	}
	
	// kembalikan hasilnya
	
	if($_not_ok ==0 ) return true;
	else
	{
		return $position;
	}
	
 }
 
 
 /*
 * @def : _getKeys * update mode 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
public function _getKeys( $TemplateId=null )
{
	$_conds = false;
	if( !is_null($TemplateId) ) 
	{
		$this -> db -> select("a.UploadColsName");
		$this -> db -> from("t_gn_detail_template a");
		$this -> db -> where("a.UploadTmpId",$TemplateId);
		$this -> db -> where("a.UploadKeys",1);
		
		$num = 0;
		foreach($this -> db ->get() -> result_assoc() as $rows ) {
			$_conds[$num] = $rows['UploadColsName']; 
			$num++;
		}
		
	}
	return $_conds;
} 
 
 
 
 /*
 * @def : _getKeys * update mode 
 * --------------------------------------------
 * @ aksess : public on model only  
 * @ param  : no available 
 */
 
public function _getTemplateModul( $TemplateId=null )
{
 $_conds = FALSE;
 if( !is_null($TemplateId) ) 
 {
	$this->db->reset_select();
	// $this->db->select("b.ConfigValue AS ClassModul", FALSE);
	$this->db->select("a.TemplateModul AS ClassModul", FALSE);
	$this->db->from("t_gn_template a ");
	// $this->db->join("t_lk_configuration b ", "a.TemplateModul=b.ConfigName","LEFT");
	$this->db->where("a.TemplateId", $TemplateId);
	
	// process query 
	$result = $this->db->get();
	// var_dump($this->db->last_query());
	if( $result->num_rows() > 0 )
	{
		if( $rows = $result->result_first_assoc() )
		{
			$_conds = $rows['ClassModul'];
		}
	}
 }
 
 return $_conds;
 
}

 public function _get_template_by_campaign($cmp_id=null)
 {
	 $_datas = null;
	 
	 if( !is_null($cmp_id) )
	 {
		 $sql = "select b.* from t_gn_campaign_ref a
					inner join t_gn_template b on a.TemplateId = b.TemplateId
				 where 1=1
				 and a.CampaignId = '".$cmp_id."'";
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		if( $qry->num_rows()>0 )
		{
			$_datas = $qry->result_first_assoc();
		}
	 }
	 return $_datas;
 }

 

} 

// END class 


?>