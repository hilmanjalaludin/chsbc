<?php 
/*
 * @ def 		:  EUI_helpers 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
class EUI_Flexible
{

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 private static $instance  = null;

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public static function & get_instance()
{
	if( is_null(self::$instance) ) {
		self::$instance = new self();
	}
	return self::$instance;
}

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function _FlexibleCampaignId( $CampaignId = 0 )
{ 
  #echo "_FlexibleCampaignId"; die();

  $UI =& get_instance();
  
  $UI->db->select('*');
  $UI->db->from('t_gn_field_campaign a');
  $UI->db->where("a.CampaignId", $CampaignId);
  $UI->db->where("a.Field_Active", 1);
  
  #$rows = $UI-> db -> get(); var_dump( $UI->db->last_query() ); die();

  if( $rows = $UI-> db -> get() -> result_first_assoc() )  
	return $rows;
  else
	return false;
}

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _FlexibleFiedId( $LayoutId = 0 )
{ 
  $UI =& get_instance();
  
  $UI->db->select('a.*');
  $UI->db->from('t_gn_field_campaign a');
  $UI->db->where("a.Field_Id", $LayoutId);
  $UI->db->where("a.Field_Active", 1);

   if( $rows = $UI -> db -> get() -> result_first_assoc() )  
		return $rows;
	else
		return false;
}


/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _FlexibleLabelLayout( $Field_Id = 0 )
{
	
	$UI =& get_instance(); $Layout = array();
	// var_dump($Field_Id);
	$UI->db->select('*');
	$UI->db->from('t_gn_field_rowset a');
	$UI->db->where("a.Field_Id", $Field_Id);
	$UI->db->order_by("a.Rows_Orders","ASC");

	#$UI ->db -> get(); var_dump( $UI->db->last_query() ); die();
	
	$i = 0;
	foreach( $UI ->db -> get() -> result_assoc() as $rows )
	{
		$Layout['Names'][$i]  = $rows['Rows_Names'];
		$Layout['Labels'][$i] = $rows['Rows_Labels'];
		$Layout['Ordes'][$i]  = $rows['Rows_Orders'];
		$Layout['Function'][$i]  = $rows['Rows_Function'];
		$i++;
	}
	
	return $Layout;
  }
  
}

// END OF OBJECT 

// START OF OBJECT

class _CreateLayout 
{

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 private static $instance = null; 
 private static $LayouLabels = null;
 private static $LayoutHeaders = null;
 
 /*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 private $CustomerId  = null;
 private $Tables  = null;
 private $primarykeys = null;
 
/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
 public function _setLayoutLabels( $labels = null , $headers = null )
 {
	// if( is_null(self::$LayouLabels) )
	// {
		self::$LayouLabels = $labels;
		self::$LayoutHeaders = $headers;
	// }	
 }
 

/*
 * @ def 		:  get by campaign 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public static function & get_instance()
{
	if( is_null(self::$instance) ) {
		self::$instance = new self();
	}
	return self::$instance;
}

/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getLabels() 
 {
	if( !is_null(self::$LayouLabels) ){
		return self::$LayouLabels;
	}
	else
		return false;
 }
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getHeaderLayout() 
 {
	if( !is_null(self::$LayoutHeaders) ){
		// var_dump(self::$LayoutHeaders);
		return self::$LayoutHeaders;
	}
	else
		return false;
 }
  
 
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getHeaderLabels() 
 {
	$match_labels = array();
	if( $labels = $this -> _getLabels() ){
		return $labels['Labels'];
	}
	else
		return false;
 } 
 
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getHeaderFunction() 
 {
	$match_labels = array();
	if( $labels = $this -> _getLabels() ){
		return $labels['Function'];
	}
	else
		return false;
 } 
  
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getFieldsLabels() 
 {
	$match_labels = array();
	
	$fields = $this -> _getFields();
	$labels = $this -> _getLabels();
	
	if( $fields )
	{
		if( $labels ) foreach( $labels['Names'] as $key => $label ) 
		{
			if(in_array($label, array_values($fields) )){	
				$match_labels[] = $label; 
			}
		}
	}
	
	// call back 
	
	if( count($match_labels) >  0 )	
		return $match_labels;
	else
		return false;
 }
   

/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getFields() 
 {
	if($labels = $this->_getLabels() ) 
	{
		$UI = & get_instance();
		$rows = $UI ->db->list_fields( $this -> _getTables() );
		return $rows;
	}
 }
  
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 public function _getCustomerId() 
 {
	return $this -> primarykeys; 
 }
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
 public function _getTables(){
	return $this -> Tables;
 } 
 
 
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 function _setCustomerId( $wheres = null ) 
 {
	if( is_array($wheres)) 
	{
		$this -> primarykeys  = $wheres;
	}
 }
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
  function _setTables( $tables = 't_gn_bucket_customers') {	
	$this -> Tables = $tables;
 }

/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
  
function _getHeader()
{
	$Haders = null;
	$GroupHeader = $this -> _getHeaderLayout(); 
	if( is_array($GroupHeader) ) 
	{
		if(isset($GroupHeader['Field_Header']) ) 
		{
			$Haders = $GroupHeader['Field_Header'];
		}
	}
	
	return $Haders;
} 
 
/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
  
 function _getData()
 {
	$_list_labels = null;
	if( $LayoutFields = $this -> _getFieldsLabels() ) 
	{
		$UI =& get_instance();
		$UI->db->select(array_values($LayoutFields));
		$UI->db->from($this->_getTables());
		$UI->db->where($this->_getCustomerId());
		if( $rows = $UI->db->get()->result_first_assoc() )
		{
			$i = 0;
			$_list_fields = $this -> _getLabels();
			$_list_header = $this ->_getHeaderLabels();
			$_list_function = $this ->_getHeaderFunction();
			
			if(@is_array($_list_fields['Names']))foreach( $_list_fields['Names'] as $key => $value ) 
			{
				$_list_labels[$i]['label']= $_list_header[$i]; 
				$_list_labels[$i]['function']= $_list_function[$i]; 
				$_list_labels[$i]['value']= $rows[$value]; 	
				$i++;
			}
		}
		// no data avaialebale
		else
		{
			$_list_fields = $this -> _getLabels();
			$_list_header = $this -> _getHeaderLabels(); 
			
			$i = 0;			
			if(@is_array($_list_fields['Names']) )foreach( $_list_fields['Names'] as $key => $value ) 
			{
				$_list_labels[$i]['label']= $_list_header[$i]; 
				$_list_labels[$i]['value']= null;	
				$i++;
			}
		}
	}
	
	
	return $_list_labels;
}

 
 /*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
  function _Compile() 
 {
	$UI =& get_instance();
	
	$UI->load->helper('EUI_Object');
	$UI->load->helper('EUI_CustInfo');
	
	if( $Header = $this -> _getHeaderLayout()) 
	{
		// var_dump($Header);
		$Field_Columns = (INT)$Header['Field_Columns'];
		$Field_Size = (INT)$Header['Field_Size'];
		$Group_Size = ceil($Field_Size/$Field_Columns);
		$Field_Data = $this -> _getData();
		
		//var_dump($Field_Data);
		//Edit Rangga resources field

		if( in_array( _get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)))
 		{
		// 	//  // $query="SELECT CampaignId FROM t_gn_customer WHERE CustomerID=$Id";
			$UI -> db -> select('CampaignId');
			$UI -> db -> from("t_gn_customer");
			$UI -> db -> where($this->_getCustomerId());
			$C_id=$UI->db->get()->row();
			// var_dump($Field_Data);die();

			//flexi
			if($C_id->CampaignId == 9){
				$Field_data .= array_splice($Field_Data, 4, 1);
			}elseif($C_id->CampaignId == 5){
				$Field_data .= array_splice($Field_Data, 7, 1);
			}elseif($C_id->CampaignId == 6){
				$Field_data .= array_splice($Field_Data, 5, 1);
			}else{
				$Field_data .= array_splice($Field_Data, 5, 1);
			}

			
			
	}	
		 
		$percent = floor(100/$Field_Columns);
		
		if( !$Group_Size ) die('zero file ');
		else
		{
		// var_dump($Field_Columns);
		 echo "<fieldset class=\"corner\" style=\"margin-top:-8px; padding:5px 0px 10px 0px;\">";
		 echo form()->legend(lang(array($this->_getHeader())), "fa-info"); 
		 echo "<div style='overflow:auto;margin-top:3px;' class='activity-content'>";
			echo "<table border=0 width = '100%' cellpadding='5px'>";
				echo "<tr>";
			for( $p = 0; $p <$Field_Columns; $p++) 
			{
				echo "<td valign='top'>";
				echo "<div style='border:0px solid #ddd;'>";
					/* echo "<pre>";
					var_dump($Field_Data);
					echo "</pre>"; */
					$start = ($p * $Group_Size);
						if( $list_arrays = array_slice($Field_Data, $start, $Group_Size)){
							echo "<table border=0 width = '99%' cellpadding='2px' cellspacing='4px'>";
							foreach( $list_arrays as $field => $rows )
							{
								$out =new EUI_Object( $rows );
								echo "<tr>";
									echo "<td class='text_caption' width='20%' nowrap>{$out->get_value('label')}</td>";
									echo "<td width='5%'>:</td>";
									echo "<td width='75%' class='input_text tolong'>".wordwrap($out->get_value('value',$out->get_value('function')), 35, "<br/>\n")."</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
					echo "</div>";
				echo "</td>";
			}
				echo "</tr>";
			echo "</table>";	
			echo "</fieldset>";
		}
	}
	
 }
 
 

 

}

// END OF OBJECT 

/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
if(!function_exists('_cmpFlexibleLayout') ) 
{
 function _cmpFlexibleLayout($CampaignId= 0 ) 
 {
	$_create_layout = false;
	$flexi =& EUI_Flexible::get_instance();
	
	if( $rows = $flexi -> _FlexibleCampaignId( $CampaignId ) )
	{
		if(is_null($rows['Field_Id'])) die('No Campaign');
		else 
		{
			$labels = $flexi -> _FlexibleLabelLayout($rows['Field_Id']);
			// var_dump($labels);
			if( $labels ) 
			{
				$_create_layout =& _CreateLayout::get_instance();
				$_create_layout -> _setLayoutLabels( $labels, $rows );
			}
		}	
	}
	
	return $_create_layout;
 }
}


/*
 * @ def 		:  get rows filed ID 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
if(!function_exists('_fldFlexibleLayout') ) 
{
 function _fldFlexibleLayout( $Field_Id = 0 ) 
 {
	$_create_layout = false;
	$flexi =& EUI_Flexible::get_instance();
	if( $rows = $flexi->_FlexibleFiedId( $Field_Id ) )
	{
		if(is_null($rows['Field_Id'])) die('No Field_Id');
		else 
		{
			$labels = $flexi -> _FlexibleLabelLayout($rows['Field_Id']);
			if( $labels ) 
			{
				$_create_layout =& _CreateLayout::get_instance();
				$_create_layout -> _setLayoutLabels( $labels, $rows );
			}
		}	
	}
	
	return $_create_layout;
  }
}
 
 ?>