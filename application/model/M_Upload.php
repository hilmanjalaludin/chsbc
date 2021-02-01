<?php
/* 
 * @ def 	: class Upload Modul ALL DATA 
 * ----------------------------------------
 *
 * @ author : razaki team 
 * @ param  : class properties 
 */

/*
 * @ update : 2014-08-31 optimize logic method constans
 * -------------------------------------------------------------
 */ 
 
/* set memory iniated  &&  set time exexcute 
 * --------------------------------------------
 */

ini_set("memory_limit","1024M");
set_time_limit(3600);

class M_Upload extends EUI_Model 
{

// @private object variable 

 private static $_attributes;
 private static $_request;
 private static $_reportid;
 private static $instance = null;
 private static $prefix_recsource;
 
// @singgleton / public static instance
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 public static function &instance(){
	if( is_null( self::$instance ) ){
		self::$instance = new self();
	}
	return 	self::$instance;
 } 
 
// @ contruct function  
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 function __construct() {
	$this->load->model(array('M_BlackList','M_XDays','M_Tools'));
	
 }

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */

 function _report_log_data( $type='FTP' )
 {
	$_insertid = 0;
	$this -> db -> insert('t_gn_upload_report_ftp',array( 
		'FTP_Recsource' 	=> self::$_request['recsource'],
		'FTP_UploadFilename'=> base_url() . APPPATH . 'temp/'. self::$_attributes['fileToupload']['name'], 
		'FTP_UploadType' 	=>  $type,
		'FTP_UploadDateTs' 	=>  date('Y-m-d H:i:s'),
		'FTP_UploadBy' 		=> _get_session('Username') ));
		
	if( $this->db->affected_rows()>0 )
	{
		$_insertid = $this -> db -> insert_id();	
	}
	
	#var_dump( $this->db->last_query() );die();
	if( $_insertid )
	{
		self::$_reportid = $_insertid; 
	} else {
		echo json_encode(
			array(
				'mesages' => $this->db->_error_message(),
				'result'  => 0
			)
		); die();
	}
	
	return $_insertid;
 }
 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

private function _copy_file()
{
	$_conds = false;
	
	
	if(isset(self::$_attributes['fileToupload']['name']))
	{
		if( copy(self::$_attributes['fileToupload']['tmp_name'], APPPATH . 'temp/'. self::$_attributes['fileToupload']['name']))
		{
			$_conds = true;
		}
	}
	
	return $_conds;
} 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _read_excel_header()
{
	$_conds = self::_copy_file(); $_callback = '';
	if( $_conds )
	{
		// var_dump( "_read_excel_header",self::$_attributes['fileToupload']['name'] );die();
		ExcelImport() -> _ReadData(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']);
		$pos = 1; $num=0; $data = array();
		
		while( $pos <= ExcelImport()->rowcount(0) ) 
		{
			if( $pos==1) 
			{
				for( $i= 1; $i<=ExcelImport()->colcount(0); $i++)
				{
					$data[$i] = ExcelImport() ->val($pos,$i); 
				}
			}
			$pos++;
		}
		
		$_callback = $data;
	}	
	else
		$_callback = "Failed to copy data ";
		
	// var_dump( $_callback );die();
	return $_callback;
} 


/*
 * @ def 		: Upload TXT 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _read_text_header()
{
	$_conds = self::_copy_file(); $_callback = '';
	if( $_conds )
	{
		TextImport() -> ReadText(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']);
		TextImport() -> setDelimiter('|');
		$_callback = TextImport()->getHeader();
	}	
	else
		$_callback = "Failed to copy data ";
		
		
	return $_callback;
} 


/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _read_table_data()
{
	$_tables = null;
	
	if(isset(self::$_request['TemplateId']) ) 
	{
		$this -> db ->select('TemplateTableName');
		$this -> db ->from('t_gn_template');
		$this -> db ->where('TemplateId', self::$_request['TemplateId']);
		$qry = $this ->db ->get();
		// if(!$qry -> EOF() )
		if( $qry->num_rows() > 0 )
		{
			$_tables = $qry->result_singgle_value();
		}
	}	
	
	return $_tables;
}
 
 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _read_column_data()
{
	$_fields = array();
	
	if(isset(self::$_request['TemplateId']) )
	{
		$this->db->reset_select();
		$this -> db ->select('UploadColsName, UploadColsAlias');
		$this -> db ->from('t_gn_detail_template');
		$this -> db ->where('UploadTmpId', self::$_request['TemplateId']);
		$this -> db ->order_by('UploadColsOrder','ASC');
		
		#$this ->db ->get(); var_dump( $this->db->last_query() ); die();
		foreach( $this ->db ->get() ->result_assoc() as $rows )
		{
			$_fields[$rows['UploadColsName']] = $rows['UploadColsAlias'];	
		}
	}	
	
	return $_fields;
}


/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function _read_upload_data( $combine = array(), $add_columns = null, $Template = NULL )
{
	$data = array();
	/// type upload data excel mode 1998 - 2013 
	if( trim(strtolower($Template['TemplateFileType']))=='excel' )
	{
		ExcelImport() -> _ReadData(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']);
		$p = 2; $n=1; $count = ExcelImport()->rowcount(0);
		while( $p <=$count )
		{
			$_c = 1;
			
			foreach( $combine as $k => $v ) {
				$debug[]      = ExcelImport()->val($p,$_c);		
				$data[$n][$v] = ExcelImport()->val($p,$_c);
				$_c++;
			}
			
		    // add columns 
			if( is_array($add_columns) AND count($add_columns)> 0 ) 
			{
				foreach( $add_columns as $field => $value ){
					$data[$n][$field] = $value;  	
				}
			}
				 
			$n++;  $p++; 
		}

		#var_dump( $debug );die();
		
	}	
	
	/// type upload data excel mode 1998 - 2013 
	if( trim(strtolower($Template['TemplateFileType']))=='txt' ) 
	{
		TextImport() -> ReadText(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']);
		TextImport() -> setDelimiter($Template['TemplateSparator']);
		
		$p = 2; $n=1; 
		$count = TextImport()->getCount();
		while( $p <= $count ) 
		{
			$_c = 0; // start index 0 for txt file version 
			foreach( $combine as $k => $v ) {
				$data[$n][$v] = TextImport()->getValue( $p , $_c ); 
				$_c++;
			}
			
			if( is_array($add_columns) AND count($add_columns)> 0 ) 
			{
				foreach( $add_columns as $field => $value ) {
					$data[$n][$field] = $value;  	
				}
			}
				 
			$n++;  $p++; 
		}
	}	
	
	return $data;
}
 
/*
 * @ def 		: UploadDataExcel
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function UploadDataBucket( $param = null )
{	

 ob_start(); // start over buffer
 
 self::$_attributes = $param['file_attribut'];
 self::$_request = $param['request_attribut'];

 $_tables_input = self::_read_table_data();
 if( !is_null(self::$_attributes) ) 
 {
	$Template =& $this -> M_Template -> _getDetailTemplate(self::$_request['TemplateId']);
	$_read_header = ( $Template['TemplateFileType']=='txt' ? self::_read_text_header() : self::_read_excel_header() );
	
	$_read_column = self::_read_column_data();
		
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ if file cant be copy to server directory 
	*	and then will break;
	*/ 
	
	if( !is_array($_read_header) )  { 
		return $_read_header;  break;
	}	
	
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ if templat is not active OR not found on database then must 
	*	be create template ;
	*/ 
	
	else if( !is_array($_read_column) ) {
		return 'Template Not Found.'; break;
	}	
	else 
	{
		$_keys_read_column = array_keys($_read_column);
		$_values_read_columns = array_values($_read_column);
		
		if( count($_read_header) == count($_values_read_columns))
		{
			$_header = array(); $tots = 0; $_totals = 0;
			foreach( $_read_header as $k => $v ) 
			{
				if(in_array(trim($v),$_values_read_columns) ) 
					$tots +=1; 	
				else 
				{
					$_header[$_totals]= array('N'=>$v, 'Y' => $_values_read_columns[$_totals]); 
				}
					
				$_totals++;
			}
			
		
		if(($_totals==$tots) ) {
		
			// then process upload 
			self::_report_log_data('MNL');
				
			// set read class 
			($Template['TemplateFileType']=='txt' ? null : ExcelImport() -> _ReadData(APPPATH .'temp/'.self::$_attributes['fileToupload']['name']));
		
			// then read and process 
			$pos = 2; $num=1; $data = array(); $_numrows = 0; $_success = 0; $_failed = 0;	$_blacklist = 0; $_duplicate = 0; $xdays = 0;
			$count = ( $Template['TemplateFileType']=='txt' ? TextImport() -> getCount() :  ExcelImport()->rowcount(0));
			
			while( $pos<=$count ) 
			{
				
				$_cols = 0;
				foreach( $_keys_read_column as $k => $v )
				{
					$set_text_value = ( $Template['TemplateFileType']=='txt' ? TextImport()->getValue($pos,$_cols) : ExcelImport() ->val($pos,$_cols));
					if(trim($set_text_value)!=''){
						$data[$pos][$v] = $this->M_Tools->__tools_format($v,$set_text_value); 
					}
					
					$_cols++;
				}

			/*	
			 * @ def 	: additional columns 
			 * ------------------------------------------
			 * @ spesific column if not found on section template
			 *	user must be check data validation  && header is unique
			*/ 
				$data[$pos]['CustomerUploadedTs'] = date('Y-m-d H:i:s');
				$data[$pos]['FTP_UploadId'] = self::$_reportid;
				$data[$pos]['UploadedById'] = $this->EUI_Session->_get_session('UserId');
				
			/*	
			 * @ def 	: insert tables 
			 * ------------------------------------------
			 * @ spesific column if not found on section template
			 *	user must be check data validation  && header is unique
			*/ 
				if( !is_null($_tables_input) ) 
				{
				
				/** cek blacklist == FALSE // not found -***/ 
					
					$M_BlackList =& M_BlackList::get_instance();
					$M_XDays =& M_XDays::get_instance();
					
					if( $M_BlackList -> get_count($data[$pos], self::$_reportid )!=TRUE )
					{
						// cek of the days data interval
						$ExistData = $M_XDays -> X_Existing($data[$pos]);
						if( $ExistData )
						{
							$X_ListDays = $M_XDays -> X_ExistListingDays($data[$pos], $Template);
							if( isset($X_ListDays['diffrent_days']) AND $X_ListDays['diffrent_days'] < 0 )
							{
								// add new interval by tempalate 
								$X_ListingDays = $M_XDays ->X_ListingDays($Template);
								
								$data[$pos]['x_days'] = $X_ListingDays['interval_days'];
								$data[$pos]['Expire_DateTs'] = $X_ListingDays['expired_days'];
								
								// then insert 
								if( $this -> db -> insert( $_tables_input, $data[$pos] ))
									$_success++;
								 else 
								 {
									$_error = $this->db->_error_message(); // get error 
									if( preg_match('/\Dup/i', $_error ) ) 
										$_duplicate++;
									 else
										$_failed++;
								  }
							}
							
							/** cek x-day == FALSE // is found -***/ 
							else{
								 $_failed++;  $xdays++; $_blacklist++;
							}
						} 
						
						/*** start :: X- DAYS : if new data not identified by x-days **/
						else  
						{
							// add new interval by tempalate 
							$X_ListingDays = $M_XDays ->X_ListingDays($Template);
							$data[$pos]['x_days'] = $X_ListingDays['interval_days'];
							$data[$pos]['Expire_DateTs'] = $X_ListingDays['expired_days'];
							
							if( $this -> db -> insert($_tables_input,$data[$pos]) ) 
								$_success++;  
							else
							{
								$_error = $this->db->_error_message(); 
								$_failed++; 
							}
						}		
					 }	
					  
					 /** cek blacklist == FALSE // is found -***/ 
					  else 
					  {
						 $_failed++; 
						 $_blacklist++;
					   }
					}
					
					$pos++; $num++;
				}
				
				// save all data to info ***
				$ftp['FTP_UploadRows']  	= $num;
				$ftp['FTP_UploadFailed'] 	= $_failed;
				$ftp['FTP_UploadBlacklist'] = $_blacklist;
				$ftp['FTP_UploadSuccess'] 	= $_success;
				$ftp['FTP_UploadDateTs'] 	= date('Y-m-d H:i:s');
				
				if( $this -> db -> update('t_gn_upload_report_ftp',$ftp, array('FTP_UploadId'=>self::$_reportid) )){
					$_done = "OK";
				}
				
				$_conds = array(0=>array( 'N' => $_failed,  'Y' => $_success, 'B' => $_blacklist,  'D' => $_duplicate, 'X' => $xdays ));
				return $_conds;
			}
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ spesific column if not found on section template
	*	user must be check data validation  && header is unique
	*/ 
			else
			{
				return $_header;
			}	
		}
   /*	
	* @ def 	: return callback to client	
	* ------------------------------------------
	* @ header column on DB not match with Tempalate selected  
	*	data upload Or data source 
	*/ 
			else
			{
				return 'Column identification not match. Please check your file.';
				break;
			}
		}
	}
	else
	{
		return 'No paramater included .';
	}	
	
	// end buffer 
	ob_end_clean();
}


/*
 * @ def : Global Upload By Template Create By UserId
 * ------------------------------------------------------
 * @ param : attribute data && file 
 * @ param : M_Template Class / under model class 
 */
 
public function setInsertUpload($_array =null, $add_columns=null )
{
	ob_start();
	// echo "test";
	// die;
	self::$_attributes =& $_array['file_attribut'];
	self::$_request =& $_array['request_attribut'];
	self::$prefix_recsource = "REC-".date("YmdHis");
	
	$TemplateName =& self::_read_table_data();
	$TemplateId =& self::$_request['TemplateId'];
	$is_conds	= FALSE;
	
	if(!is_null( self::$_attributes ) )
	{
		
		$Template =&M_Template::_getDetailTemplate($TemplateId);
		$UploadClass = &M_Template::_getTemplateModul($TemplateId); 
		
	 	// @ pack : select modul class -------------------------------------------
		if( isset($UploadClass)) {
			$this->load->upload($UploadClass);
		}
	// 	echo "ini test";
	// die;
	 	// @ pack :  included class  -------------------------------------------
		if( !class_exists($UploadClass) ) {
			self::_rename_file_upload();
			return "\n\rmodul class not_found.";
			break;
		}
		
		 // @ pack :  of header & columns args -------------------------------------------
		//  var_dump( strtoupper($Template['TemplateFileType']);
		//  die;
		$this->ExcelHeader = array_map("trim", ( strtoupper($Template['TemplateFileType'])=='TXT' ? self::_read_text_header() : self::_read_excel_header() ));
	    #var_dump( "DEBUG"); die(); 
		$this->TemplColumn  = array_map("trim", self::_read_column_data());
		#var_dump( $this->TemplColumn ); die();
        // echo "ini test";
		// die;
	 	// @ pack : content template is ok
		if( !is_array($this->TemplColumn) OR is_null($this->TemplColumn) )  {
			self::_rename_file_upload();	
			return 'Template not found.';
			break;
		}
		
		// @ pack :  of header & columns args -------------------------------------------
	    if( is_string($this->ExcelHeader) )
	    {
			self::_rename_file_upload();
			return $this->ExcelHeader;
			break;
	    }  
	 	// @ pack : is match of upload with exist templates -------------------------------------------
		
		 $tmp = strtoupper($Template['TemplateFileType']);
		if( count($this->ExcelHeader) < count($this->TemplColumn) ) 
		{
			#var_dump( count($this->ExcelHeader) ."==". count($this->TemplColumn) ); die();
			self::_rename_file_upload();
			return "\n\rColumn on $tmp { ". count($this->ExcelHeader). " } --> template { ". count($this->TemplColumn). " }.\n\r".
				   "Identification not match. Please check your file.";
			break;
		}
		// echo "ini test";
		
		// var_dump($this->ExcelHeader); die();
		$LabelMatch =& M_Template::_getMatch( $this->ExcelHeader, $this->TemplColumn , TRUE );
		// var_dump($LabelMatch);
		//  die();
		if( !is_bool($LabelMatch) ) 
		{
			self::_rename_file_upload();
			
			$filename = self::$_attributes['fileToupload']['name'];
			
			// callback to user client 
			$msg= "\n\rYou $tmp not have ( ". count( $LabelMatch ) ." )  label in file : [ $filename ] :\n\r";
			$msg.="\n\r";
			
			$num = 1;
			foreach( $LabelMatch as $key => $labels )
			{ 
			  $msg .= " $num # $labels\n\r";
			  $num++;
			}
			
			$msg.="\n\r";
			$msg.="minimum ". count($this->TemplColumn) ." label must match.\n\rPlease chek you file";
			return $msg;
			
			break;
		}
		 
		$LabelOrder =&M_Template::_getOrder( $this->ExcelHeader, $this->TemplColumn, TRUE );
		if( $LabelOrder == FALSE ) 
		{
			self::_rename_file_upload();
			return $LabelOrder;
			break;
		 }
		
	  	// @ pack : result of rows content -------------------------------------------
		$args_vars =& self::_read_upload_data( array_keys($this->TemplColumn), array(), $Template );
		if( count($args_vars)==0 )
		{
			self::_rename_file_upload();
			return '\n\rData empty .';
			break;
		}	
		
		// call function  in class $UploadClass | LOCATION application/upload/
		$IsClass = call_user_func(array($UploadClass, "Instance"));

		if(!is_object($IsClass) )
		{
			self::_rename_file_upload();
			return "\n\rNo call_user_func {$UploadClass}::Instance.";
			break;
		}
		
		self::$_request['recsource'] = self::$prefix_recsource;
		$UploadId = self::_report_log_data('IGT'); // generate upload ID
		// self::$_request['recsource'] = @$args_vars[1]['Recsource'];
	    #$UploadId = self::_report_log_data('IGT', $args_vars); // generate upload ID
	    
		// @ pack : NEXT process  -------------------------------------------
		if( !self::$_reportid )
		{
			self::_rename_file_upload();
			return "Failed !\n\rPlease input other Recsource No";
			break;
		}
		#var_dump( $args_vars );die();
		// LOCATION application/upload/
		$IsClass->_set_uploadId($UploadId); 
		$IsClass->_set_recsource(_get_post('recsource')); 

		$IsClass->_set_recsource_ftp(
			array(
				'recsource_ftp' => self::$_request['recsource'],
				'uploadid_ftp'	=> $UploadId
			)
		);

		$IsClass->_set_campaignId(_get_post('CampaignId'));
		$IsClass->_set_table($TemplateName);
		$IsClass->_set_content($args_vars);

		if( $IsClass->_get_is_complete() ) {
			$IsClass->_set_process($args_vars);
		}
		
	 	// @ pack : result object ------------------------------------------- 
		$stdClass = $IsClass->_get_class_callback();
		if( is_object($stdClass) )
		{
			$this->db->set('FTP_UploadRows',$stdClass->TOTAL_UPLOAD );
			$this->db->set('FTP_UploadSuccess',$stdClass->TOTAL_SUCCES);
			$this->db->set('FTP_UploadFailed',$stdClass->TOTAL_FAILED);
			$this->db->set('FTP_UploadDuplicate',$stdClass->TOTAL_DUPLICATE);
			$this->db->set('FTP_UploadEndDateTs',date('Y-m-d H:i:s'));
			$this->db->where('FTP_UploadId', self::$_reportid);
			$this->db->update('t_gn_upload_report_ftp');
			
			// @ pack : rename file with name not failed  ------------>
			if(($this->db->affected_rows() > 0)) {
				self::_rename_file_upload(TRUE);
				$is_conds = TRUE;
			}
		}
		
	 	// @ pack : if not read and insert to table.  	
		$_conds = array();
		if( ($is_conds = FALSE) OR ($is_conds=TRUE ) )
		{
			$_conds = array(
				'R' => $stdClass->TOTAL_UPLOAD, 
				'N' => $stdClass->TOTAL_FAILED, 
				'Y' => $stdClass->TOTAL_SUCCES, 
				'D' => $stdClass->TOTAL_DUPLICATE,
				'B' => $stdClass->TOTAL_BLACKLIST, 
				'X' => $stdClass->TOTAL_EXPIRED 
			);
		}
		
		return array($_conds);
	}
	
	ob_end_clean();
}
 
 // stop global upload 
 
 /*
 * @ def : Global Upload By Template Create By UserId
 * ------------------------------------------------------
 * @ param : attribute data && file 
 * @ param : M_Template Class / under model class 
 */
 
public function setUpdateUpload($_array =null, $add_columns=null )
{

  self::$_attributes = $_array['file_attribut'];
  self::$_request = $_array['request_attribut'];
	
  $template_name_table = self::_read_table_data();
  
  if( !is_null(self::$_attributes) )
  {
	$_read_excel_header = self::_read_excel_header();
	$_read_column_data  = self::_read_column_data();
	
	if( is_array($_read_excel_header) AND is_array($_read_column_data) ) 
	{
		if( (count($_read_excel_header) == count($_read_column_data))  )
		{
			$is_match =& M_Template::_getMatch($_read_excel_header, $_read_column_data);
			if( !is_array($is_match) AND $is_match!=FALSE )
			{
				$is_order =& M_Template::_getOrder($_read_excel_header, $_read_column_data);
				$is_keys  =& M_Template::_getKeys(self::$_request['TemplateId']);
				
				if( !is_array($is_order) AND $is_order!=FALSE ) 
				{
					$result =& self::_read_upload_data( array_keys($_read_column_data), $add_columns);
					if(count($result) > 0 ) 
					{
						self::_report_log_data('UGT'); // insert global tables;
						
						$_success = 0; $_failed = 0; $_duplicate = 0;  $num =1; 
						foreach( $result as $k => $data)
						{
							foreach($data as $cols => $value) {
								if(in_array($cols, $is_keys))
									$this -> db -> where($cols, $value);
								else
									$this -> db -> set($cols, $value);
							}
							
							$this->db->update($template_name_table);
							
							if( $this->db->affected_rows() > 0)
							{
								if( $this -> db -> update('t_gn_upload_report_ftp',array(
									'FTP_UploadRows' 	=> $num,
									'FTP_UploadSuccess' => ($_success+1),
									'FTP_UploadDateTs' 	=> date('Y-m-d H:i:s')
									), 
									array('FTP_UploadId'=>self::$_reportid )))
								{
									$_success++; 
								}
							}
							else
							{
								$_error = $this->db->_error_message(); // get error 
								if( $this -> db -> update('t_gn_upload_report_ftp',array(
									'FTP_UploadRows' 	=> $num,
									'FTP_UploadFailed' 	=> ($_failed+1),
									'FTP_UploadDateTs' 	=> date('Y-m-d H:i:s')
									), 
									array('FTP_UploadId'=>self::$_reportid )))
								{
									if( preg_match('/\Dup/i',$_error ) ) $_duplicate++;
									else
										$_failed++;
								}
							}
							
							$num++;
						}
						
						$_conds = array(0=>array('N' => $_failed, 'Y' => $_success));
						return $_conds;
					}
					else { return 'Data empty .'; }
				}
				else { return $is_order; }
			}
			else { return $is_match; }
		}
		// column not match 
		else 
		{	 
			return 'Column identification not match. Please check your file.'; 
			break;
		}
	}
	
	// cek avail template 
	else
	{
		return 'Tempalate not found.';
		break;
	}
	
  }
  
}

 /* FROM BNILIFE AMAR <COPAS> :D */
 public function FileExploits( $file_name  = null, $strict = null )
{
	$arrs_filename = null;
	$arr_files_process = explode(".", $file_name);
	
	if( is_array($arr_files_process))
	{
		if( is_null($strict) ){
			$arrs_filename = date('Y-m-dHi') ."_". $arr_files_process[0] . "." .$arr_files_process[count($arr_files_process)-1];
		} else {
			$arrs_filename = date('Y-m-dHi') ."_". $strict ."_". $arr_files_process[0] . "." .$arr_files_process[count($arr_files_process)-1];
		}	
	}
	
	$this->_FileExploits =  $arrs_filename;
	return $this->_FileExploits;
 }
 
protected function _rename_file_upload( $conds = FALSE )
{
  
  $file_upload = self::$_attributes['fileToupload']['name'];
  if( $conds ) 
  {
	 $file_restruct = self::FileExploits( $file_upload );
	 $file_original = APPPATH . "temp/$file_upload";
	 $file_destination = APPPATH . "temp/$file_restruct";
	 
	 // cek file exist 
	 
	 if( file_exists($file_original) ) 
	 {
		rename( $file_original, $file_destination);
	 }
	 
  } else {
	$file_restruct = self::FileExploits( $file_upload, "failed");
	$file_original = APPPATH . "temp/$file_upload";
	$file_destination = APPPATH . "temp/$file_restruct";
	
	if( file_exists($file_original) ) 
	{
		rename( $file_original, $file_destination);
	}
	 
  }
   
   
} 
 
}	
?>