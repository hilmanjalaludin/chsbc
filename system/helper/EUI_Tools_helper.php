<?php
/* 
 * @ def 	  : helper data from lib EUI_tools 
 * ---------------------------------------
 * @ param 	  : EUI_Tools_helper 
 * @ location : ../system/helpers/EUI_Tools_helper
 */

 if(!function_exists('Spliter') ) 
 {
   function Spliter( $data = null,  $argc=",", $arr_map = null ) 
 {
	$out =& get_instance();
	if( !class_exists('Spliters') ){
		$out->load->helper('EUI_Spliter');	
	}
	$spl =&Spliters::Instance();
	$spl->inialize( $data, $argc, (array)$arr_map );
	return ( is_object($spl)  ? $spl : false );
	
  }
  
}

if( !function_exists('is') )
{
	function is( $data = array(), $field = 0 )
	{
		if( isset( $data[$field] ) ) 
		{
			return $data[$field];
		}
		return null;
	}
} 

/* 
 * @ def 	  : helper data from lib EUI_tools 
 * ---------------------------------------
 * @ param 	  : EUI_Tools_helper 
 * @ location : ../system/helpers/EUI_Tools_helper
 */

 if( !function_exists('evalute') ) 
 {
    function evalute( $val = '' )
	{
		if( strlen($val) == 0 ){ 
			return 0; 
		} else {
			return $val;
		}
    }
} 
 
/* 
 * @ def 	  : helper data from lib EUI_tools 
 * ---------------------------------------
 * @ param 	  : EUI_Tools_helper 
 * @ location : ../system/helpers/EUI_Tools_helper
 */

 if(!function_exists('Objective') ) 
 {
   function & Objective( $data = null ) 
 {
	$out =& get_instance();
	if( !class_exists('EUI_Object') ){
		$out->load->helper(array('EUI_Object'));	
	}
	
	$Objective = new EUI_Object( $data );
	return $Objective;
	
  }
}


/* 
 * @ def : _getVersion of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getVersion') )
 {
	function _getVersion()
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _version();
		}	
	}
}


/* 
 * @ def : _getVersion of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if(!function_exists('_getGender') )
 {
	function _getGender( $code=0 )
	{
		$arr_data = array( 
			1 => lang('MALE'), 
			2 => lang('FEMALE'), 
			3 => lang('UKNOWN') 
		);
		
		if( in_array($code, array_values( $arr_data ) )) 
			return $code;
		else {
			return (strlen( $arr_data[$code]) > 0 ? $arr_data[$code] : lang('UKNOWN'));
		}
	}
}




/* 
 * @ def : get name of month 
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('NameMonth') )
 {
	function NameMonth( $n = null )
	{
	   $UI =& get_instance();
	   if( !is_null($n) )
	   {
		 $n = (int)$n;
		 $month =& $UI->EUI_Tools->_getBulan('in'); // indonesia
		 return $month[$n];
	   }
	   else{
		return null;
	   }
	   
	}
 }
/* 
 * @ def : _getBrowser of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 if(!function_exists('NextMonth') )
 {
	function NextMonth( $date ) {
		$dates = explode("-", $date);
		$yyyy = $dates[0]; 
	$mm   = $dates[1];
	$mm++;
	
	if($mm>12){
		$mm = 1;
		$yyyy++;
	}

	if (strlen($mm)==1)$mm="0".$mm;
	return $yyyy."-".$mm;
	
	}
 }

/**
 * def : _getDateNow
 */

if ( !function_exists('_getLocalTime') ) {
	function _getLocalTime () {
		return date("m-d-Y h:i:s");
	}
}	
/* 
 * @ def : _getBrowser of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getBrowser') )
 {
	function _getBrowser()
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _os_browser();
		}	
	}
}
 
/* 
 * @ def :_getOS UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getOS') )
 {
	function _getOS()
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _os_detected();
		}	
	}
} 

/* 
 * @ def : _getToHour instance of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getToHour') )
 {
	function _getToHour($integer = 0 )
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _set_float_hour( $integer );
		}	
	}
} 

/* 
 * @ def : _getToMinute instance of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getToMinute') )
 {
	function _getToMinute($integer = 0 )
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _set_float_minute( $integer );
		}	
	}
} 
/* 
 * @ def : _getDuration instance of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getDuration') )
 {
	function _getDuration($integer = 0 )
	{
		$UI =& get_instance();
		if( $UI ) {
			$duration = $UI->EUI_Tools->_set_duration( $integer );
			return ( $duration  ? $duration : '00:00:00');
		}	
	}
} 

/* 
 * @ def : _getDuration instance of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_setRound') )
 {
	function _setRound($integer = 0, $pos = 2 ){
		return number_format($integer, 1);
	}
} 

/* 
 * @ def : _getDuration instance of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_setPercent') )
 {
	function _setPercent($integer = 0, $pos = 2 ) {
		$percent = number_format( ($integer * 100),1);
		return join("", array($percent, '%'));
	}
} 




/* 
 * @ def : _getFormatSize of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getFormatSize') )
 {
	function _getFormatSize($integer = 0 )
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _get_format_size( $integer );
		}	
	}
} 

/* 
 * @ def : _getIP  of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getIP') )
 {
	function _getIP()
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _get_real_ip();
		}	
	}
} 


/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getCurrency') )
 {
	function _getCurrency($Integer=0)
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _set_rupiah($Integer);
		}	
	}
} 


/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_setDecimal') )
 {
	function _setDecimal( $value ='' )
	{
		return strval( str_replace(".", "", $value) );
	}
} 



/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getDateEnglish') )
 {
	function _getDateEnglish( $Date=0 )
   {
	  if( $Date == 0 ) { 
		return 0; 
	}
	
	if( strlen($Date) < 8 ) { 
		return $Date;
	}
	
	if( in_array( $Date, array('00-00-0000', '0000-00-00') ) ){
		return $Date;
	}	
	
	$UI =& get_instance();
		if( $UI ) {
			return $UI -> EUI_Tools -> _date_english($Date);
		}	
	}
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('StartDate') )
 {
	function StartDate( $Date =0 ) {
		return  join(' ', array(_getDateEnglish($Date), '00:00:00'));	
	}
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('EndDate') )
 {
	function EndDate( $Date =0 ) {
		return join(' ', array(_getDateEnglish($Date),'23:59:59'));	
	}
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getOptionDate') )
 {
	function _getOptionDate( $dates = null, $lang = 'en', $mod ='-')
	{
		$UI =& get_instance(); 
		$_dates = null; 
		if( !is_null($dates) )
		{
			$_lives = explode("{$mod}", $dates);
			switch( $lang ) 
			{
				case 'en' : 
					$_curdate = "{$_lives[0]}-{$_lives[1]}-{$_lives[2]}";
					$_dates = _getDateEnglish($_curdate);
				break;
				
				case 'in' : 
					$_curdate = "{$_lives[0]}-{$_lives[1]}-{$_lives[2]}";
					$_dates = _getDateIndonesia($_curdate);
				break;
			}
		}
		
		return $_dates;
	}
} 


/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getPhoneNumber') )
 {
	function _getPhoneNumber($String='')
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _getPhoneNumber($String);
		}	
	}
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getDateIndonesia') )
 {
	function _getDateIndonesia($Date=0)
	{
		  if( $Date == 0 ) { 
		return 0; 
	}
	
	if( strlen($Date) < 8 ) { 
		return $Date;
	}
	
	if( in_array( $Date, array('00-00-0000', '0000-00-00') ) ){
		return $Date;
	}	
	
		$UI =& get_instance();
		if( $UI AND !is_null($Date) ) {
			return $UI -> EUI_Tools -> _date_indonesia( $Date );
		} else {
			return NULL;
		}	
	}
} 

if(!function_exists('_getDateIndonesia2') )
 {
	function _getDateIndonesia2($Date=0)
	{
		  if( $Date == 0 ) { 
		return 0; 
	}
	
	if( strlen($Date) < 8 ) { 
		return $Date;
	}
	
	if( in_array( $Date, array('00/00/0000', '0000/00/00') ) ){
		return $Date;
	}	
	
		$UI =& get_instance();
		if( $UI AND !is_null($Date) ) {
			return $UI -> EUI_Tools -> _date_indonesia2( $Date );
		} else {
			return NULL;
		}	
	}
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getMasking') )
 {
	function _getMasking( $v=null, $t='x')
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _setToMasking($v,$t);
		}	
	}
}

if(!function_exists('_getFormatName') )
 {
	function _getFormatName( $v=null, $t='x')
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _setFormatName($v,$t);
		}	
	}
}

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if( ! function_exists('_setMasking') )
{
	function _setMasking($v=null, $t='x') 
	{
	    $UI =& get_instance();
		if( $UI ) {
			return $UI->EUI_Tools->_setToMasking($v,$t);
		}	
	}
} 




/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getNextDate') )
 {
	function _getNextDate( $Date = null )
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _NextDate($Date);
		}	
	}
} 


/* 
 * @ def : _getIP of UI // get range in date next 
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getNextCurrDate') )
 {
	function _getNextCurrDate( $Date = null, $n=0 )
	{
		$UI =& get_instance();
		if( $UI ) {
			return $UI -> EUI_Tools -> _NextCurrDate( $Date, $n );
		}	
	}
} 

/* 
 * @ def : _getIP of UI // get range in date next 
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if( !function_exists('_getPrevDate') )
{ 
 function _getPrevDate( $Date=NULL, $n) 
 {
	$UI =& get_instance();
	if( $UI )
	{
		return $UI -> EUI_Tools -> _PrevDate( $Date, $n );
	}	
 }
 
}	

/* 
 * @ def : _getIP of UI // get range in date next 
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if( ! function_exists('_getSizeDayMonth') )
{ 
	function _getSizeDayMonth( $Month = NULL, $Year = NULL ) 
 {
	$UI =& get_instance();
	if( $UI )
	{
		return $UI->EUI_Tools->_getSizeDayMonth( $Month, $Year );
	}	
 }
 
}


/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if(!function_exists('_getDateDiff') )
 {
	function _getDateDiff( $d1, $d2 )
	{
		$UI =& get_instance();
		if( $UI )
		{
			return $UI -> EUI_Tools -> _DateDiff( $d1, $d2 );
		}	
	}
}
/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if( !function_exists('_setDateString') )
 {
	function _setDateString( $value = null)
	{
		
		if( is_null($value) OR strlen( $value ) == 0  ){
			return 0;
		}
		
		$var_date = date('Y-m-d', strtotime($value)); // not nglish format 
		if( in_array( $var_date, array('1970-01-01'))){
			$value = _getDateEnglish( $value );	
		}
		
		$print_date_string = date('d-M-Y', strtotime($value));
		return $print_date_string;
		
	}
}
/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
 if( !function_exists('_getAge') )
 {
	function _getAge( $value = null )
	{
		if( is_null($value) OR strlen( $value ) == 0  ){
			return 0;
		}
		
		$var_date = date('Y-m-d', strtotime($value)); // not nglish format 
		if( in_array( $var_date, array('1970-01-01'))){
			$value = _getDateEnglish( $value );	
		}
		//var_dump($value);
		$arr_age = _getDateDiff( date('Y-m-d'), $value);
		$cond = 0;
		if( isset($arr_age['years']) ){
			$cond = (int)$arr_age['years'];
		}
		
		return $cond;
		
	}
}



/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if(!function_exists('_getSortDate') )
{
	function _getSortDate( $bulan = 0 )
	{
		$_bulan = null;
		
		$UI =& get_instance();
		if( $UI )
		{
			$_list = $UI -> EUI_Tools ->_getBulan();
			$_bulan = $_list[(INT)$bulan];
		}
		
		return $_bulan;
	}
}	


/*
 * @ pack : public instance 
 */
 
if(!function_exists('getEventDate') )
{ 
  function getEventDate( $date = null ) 
  {
	$dates = NULL;
	
	if(!is_null($date) AND strlen($date) > 1 )
	{
		if( preg_match("/".  preg_quote($date, "/")  ."/", $date)) {
			$date = preg_replace('/\//','-',$date);	
		}
		$dates = date('Y-m-d', strtotime($date));
	}
	
	return $dates;
	
 }
} 

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if(!function_exists('_setPassword') )
{
	function _setPassword( $pwd = '' )
	{
		$_pwd= null;
		
		$UI =& get_instance();
		if( $UI )
		{
			$_pwd = $UI->EUI_Tools->_setPassword($pwd);
			
		}
		
		return $_pwd;
	}
}	

/* 
 * @ def : _getIP of UI
 * ---------------------------------------
 * @ param : EUI_Tools_helper 
 */
 
if(!function_exists('_getDateTime') )
{
  function _getDateTime( $date = null )
  {
	
	if(!is_null($date) and strlen($date) >1 )
	{
		return date('d-m-Y H:i:s', strtotime($date) );
	} else {
		return "-";
	}	
  }
}

/** @ pack : print empty string **/

if(!function_exists('__print') ) 
{ 
  function __print( $argv = null )  
{
	if( is_null($argv) ) {
		return "-";
	}
	else if( strlen($argv)==0 ) {
		return "-";
	}	
	else {
		return $argv;
	}
  } 
}




 
// ----------------------------------------------------------------------------------------------------------------

/*
 * @pack		 set data capital
 * @param		 array 
 * @param		 string
 * @return 		 string
 */
 
if(!function_exists('_setCapital') ) 
{ 
  function _setCapital( $arr_capital  = null )  
 {
	if( is_null($arr_capital) ){
		return __print($arr_capital);
	}	
	
	if( !is_array($arr_capital) 
		AND strlen($arr_capital) == 0 )
	{
		return __print($arr_capital);
	}
	 
	if( !is_array($arr_capital) )
	{
		return strtoupper($arr_capital);
	} 
	else
	{
		if( function_exists('array_map') ){
			return array_map('strtoupper', $arr_capital);
		} else{
			return $arr_capital;
		}
	}
	
  } 
}


// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( ! function_exists('_label') ) 
{ 
  function _label( $print = null )  
 {
	$arr_print =(string)$print;
	echo ( $arr_print ? $arr_print : "-");
  } 
}



// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( ! function_exists('_setBoldColor') ) 
{ 
  function _setBoldColor( $bold = null, $id= null)  
 {
	$arr_bold = null;
	$arr_id = (is_null($id) ? date('YmdHis') : $id );
	
	if( !is_null($bold) ) 
	{
		$arr_bold = "<span id=\"{$arr_id}\" class=\"text_caption left\" style=\"font-size:11px;\">{$bold}</span>";	
	}
	return $arr_bold;
	
  } 
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( ! function_exists('_setBreakWord') ) 
{ 
  function _setBreakWord( $text = null, $int = 75 )  
 {
	return "<div class=\"ui-widget-label-textmessage\">". wordwrap ( $text, $int, "<br>", false)."</div>";
  }
  
}


// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( ! function_exists('_setWordWrap') ) 
{ 
  function _setWordWrap( $text = null, $id= null)  
 {
	if( is_null($text) )  {
		return NULL;	
	}
	return "<div class=\"ui-widget-label-textmessage\">{$text}</div>";
	
  }
  
}





// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( ! function_exists('_image') ) 
{ 
  function _image( $image = NULL, $setting = NULL )  
 {
	$img_cetak_photo = null;
	if( is_null($image) OR  $image==FALSE ){
		return "3cm x 4cm";
	}
	
	 if( is_null($setting) )
	{
		$setting = array("type" => "data:image/jpeg;base64", "height" => "140", "width" => "110");
	 }
	if( !is_null($image) ){ 
		$img_cetak_photo = "<img src=\"{$setting[type]},". base64_encode($image) ."\" width=\"{$setting[width]}\" height=\"{$setting[height]}\"/>";
	}
	return $img_cetak_photo;
 }
 
}

// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 */
 
if( !function_exists('get_view') )
 {
   function get_view( $arr_view = array() )
   {
     $UI =& get_instance(); 
	  if(!is_array($arr_view) )
	 {
		$arr_view = array($arr_view);
	 }
	 $UI->load->view( implode("/", $arr_view) );
   }
}


// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 *
 * @ notes		get key array attrribute 
 */
 
if( !function_exists('_getKey') )
 {
   function _getKey( $arr = null )
  {
    if( is_array( $arr ) AND count($arr)!=0 ) {
		return array_keys($arr);
	} else {
		return null;
	}	
  }
  
}


// ----------------------------------------------------------------------------------------------------------------
/*
 * @ please print with its be convert to language 
 *
 * @ notes		get key array attrribute 
 */
 
if( !function_exists('first') )
 {
   function first( $arr = null )
  {
    if( is_array( $arr ) AND count($arr)!=0 ) 
	{
		return reset($arr);
	} else {
		return null;
	}	
  }
  
}

// --------------------------------------------------------------------------------

if( !function_exists('_setCallerMRN') )
{
	function _setCallerMRN( $MRN = '' )
 {
	$arr_mrn = array();
	if(strlen($MRN)> 3 ) 
	{
		$ln_sisa = ( DEFAULT_MRN_PREFIX_LENGTH - strlen($MRN) );
		for( $i=0; $i<$ln_sisa; $i++ ) {
			$arr_mrn[$i] = '0';	
		}
		
		$Zero = join("",$arr_mrn);
		$MRN = join("", array($Zero,$MRN));
	}
	
	return _setCapital($MRN);
 }  
 
 
}


// --------------------------------------------------------------------------------


 if( !function_exists('_setMaskingRecording') ) 
{ 
  function _setMaskingRecording( $filename  = '' )
 {
	$UI =& get_instance();
	return $UI->EUI_Tools->_setMaskingRecording( $filename );	
 }
}  

// ------------------------------------------------------------------------

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

 if( !function_exists('debug') )
{
	 function debug(  $arr = null )  {
		printf("%s", "<pre>");
			print_r( $arr );
		printf("%s", "</pre>");
	}
}
// ------------------------------------------------------------------------

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

if( !function_exists('SetAddressLine') )
{
	function SetAddressLine( $val = '' )
	{
		if( strlen($val) == 0 ){
			return "-";
		}
		$val = preg_replace('/\s+/S', " ", $val);
		return wordwrap($val, 30, "<br>");
	}
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

 if(!function_exists('SetDate') ) 
 {
	function SetDate( $date = "" ) 
	{
		//var_dump($date);
		if( strlen( $date ) <10){
			return "";
		}	
		
		if( strcmp( $date, "00-00-0000") == 0 ){
			return "";
		}
		
		if( strcmp( $date, "0000-00-00") == 0 ){
			return "";
		}
		
		$val = explode('-', $date );
		if( strlen( $val[0] ) == 4   ){ 
			return _getDateIndonesia( $date );
		}
		
		if( strlen( $val[0] ) == 2){ 
			return  _getDateEnglish( $date );
		}
		return " ";
	}
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if( !function_exists('SetCapital') )
{
	function SetCapital( $val = '' )
	{
		if( !is_array($val) ){
			if( strlen($val) == 0 ){
				return "-";
			}			
			if( !strcmp($val, "0") ){
				return "-";
			}
			return strtoupper($val);
		}
		else{
			return array_map('strtoupper', 	$val);
		}
	}
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if(!function_exists('SetDateTime') )
{
  function SetDateTime( $date = null )
  {
	
	if(!is_null($date) and strlen($date) >1 )
	{
		return date('d-m-Y H:i:s', strtotime($date) );
	} else {
		return "-";
	}	
  }
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
if( !function_exists('ArrImplode') ){
 function ArrImplode( $val = null ) {
	if( is_null( $val ) ){
		return 0;
	 }
	return sprintf("'%s'", implode("','", $val));
 }
	
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
 if( function_exists('CallAtempt') ){
	 function CallAtempt( $CustomerId  = 0 ){
		 return $CustomerId;
	 }
 }
/// ==============================================================>