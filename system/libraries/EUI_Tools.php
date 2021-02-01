<?php
/**
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 ** Licensed under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 ** author < razaki team >
 ** Copyright © 2014-2012 razaki Labs ( http://razakitechnology.com ) 
 **/
 
class EUI_Tools // eui_tools
{

 var $_ver;

/**
 **
 **/

 function EUI_Tools()
 {
	// run  && autoload 
	$this -> _ver = "0.1";
 }
 
/**
 **
 **/
 function _version()
 {
	return $this -> _ver;
 }
 
 
/**
 ** Browser detected 
 **/
  
function _detected()
{
  $_browser = array();
  foreach( $_SERVER as $key => $_val )
  {
	 if (!strncmp($key, 'HTTP_', 5) || !strncmp($key, 'SERVER_', 5)  )    
		$_browser[$key] = $_val;
  }
	return $_browser;
 }
 
 
// set password hidden 
 
public function _setPassword( $password = null, $mod = "X")
{
	$result = '';
	
	if( !is_null($password))
	{
		$pwd = strlen($password);
		for( $i = 0; $i<$pwd; $i++ ){
			$result .= $mod;
		}
	}
	
	return $result;
}
/**
 ** bowser Application 
 ** bowser Application 
 **/ 
 
function _os_browser()
{
	$_browser = 'Uknown';
	$_OS = self::_detected(); // detected OS ( Operating System );
	
	if( strpos($_OS['HTTP_USER_AGENT'], "MSIE") !=false )
		$_browser = 'Internet explorer';
	
	if( strpos($_OS['HTTP_USER_AGENT'], "Firefox") !=false )
		$_browser = 'Mozilla Firefox ';
		
	if( strpos($_OS['HTTP_USER_AGENT'], "Chrome") !=false )
		$_browser = 'Google Chrome';
		
	if( strpos($_OS['HTTP_USER_AGENT'], "centerback") !=false )
		$_browser = 'Centerback Browser';
		
	return $_browser;
}
  
/** 
 ** bowser Os
 **/
 
function _os_detected()
{
	$OS_list = array 
	(
		'Windows 7' => 'windows nt 6.1',
		'Windows Vista' => 'windows nt 6.0',
		'Windows Server 2003' => 'windows nt 5.2',
		'Windows XP' => 'windows nt 5.1',
		'Windows 2000 sp1' => 'windows nt 5.01',
		'Windows 2000' => 'windows nt 5.0',
		'Windows NT 4.0' => 'windows nt 4.0',
		'Windows Me' => 'win 9x 4.9',
		'Windows 98' => 'windows 98',
		'Windows 95' => 'windows 95',
		'Windows CE' => 'windows ce',
		'Windows (version unknown)' => 'windows',
		'OpenBSD' => 'openbsd',
		'SunOS' => 'sunos',
		'Ubuntu' => 'ubuntu',
		'Linux' => '(linux)|(x11)',
		'Mac OSX Beta (Kodiak)' => 'mac os x beta',
		'Mac OSX Cheetah' => 'mac os x 10.0',
		'Mac OSX Puma' => 'mac os x 10.1',
		'Mac OSX Jaguar' => 'mac os x 10.2',
		'Mac OSX Panther' => 'mac os x 10.3',
		'Mac OSX Tiger' => 'mac os x 10.4',
		'Mac OSX Leopard' => 'mac os x 10.5',
		'Mac OSX Snow Leopard' => 'mac os x 10.6',
		'Mac OSX Lion' => 'mac os x 10.7',
		'Mac OSX (version unknown)' => 'mac os x',
		'Mac OS (classic)' => '(mac_powerpc)|(macintosh)',
		'QNX' => 'QNX',
		'BeOS' => 'beos',
		'OS2' => 'os/2',
		'SearchBot'=>'(nuhk)|(googlebot)|(yammybot)|(openbot)|(slurp)|(msnbot)|(ask jeeves/teoma)|(ia_archiver)'
	);
	
	$_OS = self::_detected(); // detected OS ( Operating System );
	if( is_array( $_OS) )
	{
		$_OS_search = strtolower($_OS['HTTP_USER_AGENT'] );
		if( $_OS_search )
		{
			foreach( $OS_list as $_OS_server => $match ) 
			{
				if (preg_match('/' . $match . '/i', $_OS_search) ) break;
				else
					$_OS_server = 'Uknown'; 
				
			}
		}		
	}
	
	return $_OS_server;
  }
 
/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 function _set_float_hour( $seconds ) 
{
   return round(($seconds ? ($seconds/3600) : 0),2);	
}
 
 
/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 function _set_float_minute( $seconds ) 
{
	return round( ($seconds ? ($seconds/60) : 0),2);	
}
 
/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 
function _set_duration($seconds)
{
	$sec = 0;
    $min = 0;
    $hour= 0;
    $sec = $seconds%60;
    $seconds = floor($seconds/60);
    
	if ($seconds){
		$min  = $seconds%60;
        $hour = floor($seconds/60);
    }
	
	if($seconds == 0 && $sec == 0) return sprintf("");
    else
		return sprintf("%02d:%02d:%02d", $hour, $min, $sec);
}
  
/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _get_format_size($val)
{
	$type = array('B','kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'); //8  yotta
    $base = 1024;
    $step = 0;
	
	while($val > $base) {
	  $step++;
      $val = $val / $base;
    }
	
	return number_format($val, 2, ',', '.')." ".$type[$step];
}

/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 function _get_real_ip()
{
  $remote = $_SERVER['REMOTE_ADDR'];
  if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
    $remote = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
  }
  return (string)$remote;
  
}

/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _set_rupiah($val) { 
	return number_format($val,0,',','.');
}


/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _date_english($dDate)
{
	$dNewDate = strtotime($dDate);
	if($dDate)
		return date('Y-m-d',$dNewDate);
}


/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _date_time()
{
	return date('Y-m-d H:i:s');
}


/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 function _set_md5( $data ){
	return md5($data);
 }
 /** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _datetime_indonesia($dDate)
{
	$s = '00-00-0000 00:00:00';
	$dNewDate = strtotime($dDate);
	if($dDate){
		$s = date('d-m-Y H:i:s',$dNewDate);
	}
	return $s;
}

/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
function _date_indonesia($dDate)
{
	$s = '00-00-0000';
	$dNewDate = strtotime($dDate);
	if($dDate){
		$s = date('d-m-Y',$dNewDate);
	}
	
	return $s;
}

function _date_indonesia2($dDate)
{
	$s = '00/00/0000';
	$dNewDate = strtotime($dDate);
	if($dDate){
		$s = date('d/m/Y',$dNewDate);
	}
	
	return $s;
}

/** 
 ** EUI < Enigma User interface 0.1 <php> >
 ** Thank's all contribute and support for EUI Framework V.0.1
 ** User interface for application Call Center inbound.
 **/
 
 function _setFormatName( $_str_text='',$type='')
 {
	$this->val = $_str_text;
	if($type=='') $type = 'x';
	// $_last_text = strlen( $_str_text )-6;
	$_last_text = 23;
	
	$this->text = "";
	$this->text .= substr( $_str_text,0,$_last_text);
	
	$fv  = strlen( $this->text )-3;
	// for ( $i=$_last_text+1; $i<strlen($_str_text)-2; $i++) 
	for ( $i=$_last_text; $i<strlen($_str_text); $i++) 
	{
		$this->text .= $type;	
	}
	
 /** load setting data configuration **/
	
	$obClass =& $this->_selected_config();
	if( !$obClass ){
		// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
		$this->val = $this->text;
		return $this->val;
	}
	
	$arr = new EUI_Object( $obClass->_getHiddenTelephone() );
	
	if( $arr->get_value('TELEPHONE') )
	{
		/* $this->val =$this->_selected_all_mask( $_str_text, $type);
		if( $this->val ){
			return $this->val;
		} */
		
		// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
		$this->val = $this->text;
	}	
	else
	{
		if( ($arr->get_value('TELEPHONE','strtoupper') == 'YES') 
			OR ($arr->get_value('TELEPHONE','intval') ==1) ) 
		{
			// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
			$this->val = $this->text;
		}	
	}
	
	return (string)$this->val;
}

  public function _set_masking( $text_to_mask = null, $_prefix ='x' )
 {
 //$_str_text
 
	$_open_in_user = array(USER_ROOT,USER_ADMIN, USER_LEADER, USER_SUPERVISOR);
	$_call_back_user = $text_to_mask;
	$_last_text = strlen( $text_to_mask )-6;
	$_return_text.= substr( $text_to_mask,0,$_last_text);
	
	$fv  = strlen( $_return_text )-3;
	for ( $i=$_last_text+1; $i<strlen($text_to_mask)-2; $i++) 
	{
		$_return_text .= $_prefix;	
	}
	
 /** load setting data configuration **/
	
	if( in_array( _get_session('HandlingType'), $_open_in_user) ) 
	{
		return $text_to_mask;
	}
	
	$UI =& get_instance();
	$UI->load->model('M_Configuration');
	
	if(!class_exists('M_Configuration'))
		$_call_back_user = $_return_text.substr($text_to_mask,-3,strlen($text_to_mask));
	else 
	{
		$conf =& get_class_instance("M_Configuration","get_instance");
		if( ! method_exists( $conf, "_getHiddenTelephone" ) ) 
		{
			return $_call_back_user;
		}
		
		$config_system = $conf->_getHiddenTelephone();
		if(!isset($config_system['TELEPHONE']))
		{
			$_call_back_user = $_return_text.substr($text_to_mask,-3,strlen($text_to_mask));
		
		} 
		else 
		{
			if( in_array( $config_system['TELEPHONE'],  
				array('YES','Y','1','yes','y','true','TRUE')) )
			{
				$_call_back_user = $_return_text.substr($text_to_mask,-3,strlen($text_to_mask));
			 }	
		}	
	}
	
	return $_call_back_user;
}


// ------------ selected config -------------------------
// --------------------------------------------------------------------------

 private function _selected_config()
{
	$UI =& get_instance();
	$UI->load-> model('M_Configuration');
	if(!class_exists('M_Configuration')){
		return FALSE;
	}
	return M_Configuration::get_instance();
}

// ------------ selected config -------------------------
// --------------------------------------------------------------------------
 private function _selected_all_mask( $txt ="", $type = "" )
{
	$this->arrs_val = array();
	$this->text_val = $txt;
	$this->type_val  = $type;
	
	for( $i = 0 ; $i< strlen($this->text_val); $i++ ){
		$this->arrs_val[] = $this->type_val;
	}
	return (string)join("", $this->arrs_val);
}


// ------------ selected config -------------------------
// --------------------------------------------------------------------------
 
 function _setToMasking( $_str_text='',$type='')
 {
	$this->val = $_str_text;
	if($type=='') $type = 'x';
	// $_last_text = strlen( $_str_text )-6;
	$_last_text = 4;
	
	$this->text = "";
	$this->text .= substr( $_str_text,0,$_last_text);
	
	$fv  = strlen( $this->text )-3;
	// for ( $i=$_last_text+1; $i<strlen($_str_text)-2; $i++) 
	for ( $i=$_last_text; $i<strlen($_str_text); $i++) 
	{
		$this->text .= $type;	
	}
	
 /** load setting data configuration **/
	
	$obClass =& $this->_selected_config();
	if( !$obClass ){
		// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
		$this->val = $this->text;
		return $this->val;
	}
	
	$arr = new EUI_Object( $obClass->_getHiddenTelephone() );
	
	if( $arr->get_value('TELEPHONE') )
	{
		/* $this->val =$this->_selected_all_mask( $_str_text, $type);
		if( $this->val ){
			return $this->val;
		} */
		
		// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
		$this->val = $this->text;
	}	
	else
	{
		if( ($arr->get_value('TELEPHONE','strtoupper') == 'YES') 
			OR ($arr->get_value('TELEPHONE','intval') ==1) ) 
		{
			// $this->val = $this->text . substr($_str_text,-3,strlen($_str_text));
			$this->val = $this->text;
		}	
	}
	
	return (string)$this->val;
}

/*
 * E.U.I
 *
 
 * @ params   dirname 
 * @ aksess   public function
 * @ packeg   librarry 
 */
 
 function _ls_get_dir( $_ls=array(), $_path = false ){
	
	$_list_drive = array();
	if( is_array($_ls) )
	{
		foreach( $_ls as $k  => $drive ) 
		{
			$_ls_dir = scandir( APPPATH .$drive);
			
			if( is_array($_ls_dir) )
			{
				foreach( $_ls_dir as $_i => $_filename )
				{
					if( is_dir( $_filename)!=true) 
					{
						if( $_path ) {
							$_paths = APPPATH.$drive.'/'.$_filename;
							$_list_drive[$_paths] = $_filename;
						}	
						else{
							$_list_drive[$_filename] = $_filename;
						}	
					}	
				}
			}
		}
	}	
	return $_list_drive; 	
 }

 
/*
 * E.U.I
 *
 
 * @ params   : date must be english format  
 * @ aksess   public function
 * @ packeg   librarry 
 */
 
function _NextCurrDate($date = null , $n = 0)
{
	if( is_null($date) OR empty($date) )
		$_currdate = date('Y-m-d');
	else
	{	
		$_currdate  = $date;
		for($d = 0; $d < $n ; $d++) { 
			$_currdate  = $this -> _NextDate( $_currdate );
		}
	}	
	
	return $_currdate;
}
 
/*
 * E.U.I
 *
 
 * @ params   dirname 
 * @ aksess   public function
 * @ packeg   librarry 
 */
 
function _NextDate( $date = null )
{

	$dates = EXPLODE("-", $date);
	
	
	$yyyy = $dates[0];
	$mm   = $dates[1];
	$dd   = $dates[2];
	
	$currdate = mktime(0, 0, 0, $mm, $dd, $yyyy);
	$dd++;
		
	/* ambil jumlah hari utk bulan ini */
	
	$nd = date("t", $currdate);
	if($dd>$nd)
	{
		$mm++; $dd = 1;
		if($mm>12) 
		{
			$mm = 1; $yyyy++;
		}
	}
			
	if (strlen($dd)==1) $dd="0".$dd;
	if (strlen($mm)==1) $mm="0".$mm;
			
	return $yyyy."-".$mm."-".$dd;
}

/** Past Ooption data **/

 public function _PrevDate( $date=NULL, $n)
{

 $prev_date = date( 'Y-m-d'); 
 $past_date = NULL;
 
 if( !is_null($date)) {
	$past_date = date('Y-m-d', strtotime($date)); 
 }	
 
 if( $n ) {
	$past_date = date('Y-m-d', strtotime("$n days"));
 }
 
 return $past_date;
	
}

/**
 ** _getPhoneNumber
 **/
  
 function _getPhoneNumber( $phoneNumber='' )
{
 
 $result = null;
 if( $phoneNumber!='')
{
  $lens  = array(7,8,9,10,11,12,13);
  $phone = preg_replace('/[^\da-z]/i','',$phoneNumber);
  if( $phone && in_array( strlen($phone), $lens ))
  {
	 if( substr($phone,0,2) == 62 )
	{
		$result = '0'.substr($phone,2,strlen($phone));
	}
	else
	{
	   if( (strlen($phone) > 5) AND  (strlen($phone)<=8) )
	   {	
			if( substr($phone,0,1)!=0 )
				$result = '021'.substr($phone,0,strlen($phone));
			else
				$result = $phone;
			
	   } else {
		   if( substr($phone,0,1)!=0 )
			 $result = '0'.substr($phone,0,strlen($phone));
		   else 
			 $result = $phone;
	   }
	   
	}	
  }
}

 return $result;
	
 // if( in_array( strlen($result), $lens ) ){
	// return substr( $result, 0, strlen($result));
 // } else {
	// return NULL;
 // }
	
// END 	
}
	
 
/*
 * E.U.I
 *
 
 * @ params   dirname 
 * @ aksess   public function
 * @ packeg   librarry 
 */
 
function _DateDiff($d1,$d2)
{  
	$d1 = (is_string($d1) ? strtotime($d1) : $d1);  
	$d2 = (is_string($d2) ? strtotime($d2) : $d2);  
	$diff_secs = abs($d1 - $d2);  
	$base_year = min(date("Y", $d1), date("Y", $d2));  
	$diff_date = mktime(0, 0, $diff_secs, 1, 1, $base_year);  
	return array( 
		"years"=> date("Y", $diff_date) - $base_year, 
		"months_total"=>(date("Y", $diff_date) - $base_year) * 12 + date("n", $diff_date) - 1, 
		"months"=>date("n", $diff_date) - 1, "days_total" =>floor($diff_secs / (3600 * 24)),  
		"days"=>date("j", $diff_date) - 1, "hours_total" =>floor($diff_secs / 3600),  
		"hours"=>date("G", $diff_date), "minutes_total" =>floor($diff_secs / 60), 
		"minutes"=> (int) date("i", $diff_date), "seconds_total"=>$diff_secs, "seconds"=> (int) date("s", $diff_date)
	);  
}

// _tanggal_indonesia

public function _getBulan( $lang = 'in')
{
 static $config = array();
 
 $config['in'] = array('1' =>'Januari', '2'=> 'Februari', '3'=> 'Maret', '4'=> 'April', '5'=> 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', '9'=> 'September', '10'=> 'Oktober', '11'=> 'November', '12'=> 'Desember');
 $config['en'] = array('1' =>'January', '2'=> 'February', '3'=> 'March', '4'=> 'April', '5'=> 'May', '6' => 'Juny', '7' => 'July', '8' => 'Augustus', '9'=> 'September', '10'=> 'Oktober', '11'=> 'November', '12'=> 'Desember');
   
   if( !is_null($lang) ) 
   {
	  return $config[$lang];
   }
   else{
		return $config['in'];
   }
}


/*
 * @ pack : get size of day in month 
 */
 
public function _getSizeDayMonth( $bulan = null, $year = null )
{

 /* pack : get bulan date **/
 
	if( is_null($bulan) ){ $bulan = date('m'); }

/* pack : get bulan date **/
 
	if( is_null($year) ){ $bulan = date('Y');  }	

	
	$size_day = 0;
	if(function_exists('cal_days_in_month') )
	{
		$size_day = cal_days_in_month(CAL_GREGORIAN, $bulan, $year); // 31
	}
	
	return $size_day;

}

// -----------------------------------------------------------------------
/*
 * @ pakage setmaskng Data Recording By Spliter 
 */
  public function _setMaskingRecording( $filename = '' )
 {
	$this->arr_result = $filename; 
	$this->arr_on_mask_privilege = array(USER_ROOT, USER_UPLOADER);
	$this->arr_call_masking = array();
	
	
// ---------- open parse ------------------------------------------------------------------------------------	
	$outCls = Spliter($filename, '_', array('CallSessionId', 'AgentName', 'Callernumber', 'CustomerId'));
	$this->cond = in_array(_get_session('HandlingType'), $this->arr_on_mask_privilege);
	
	 if( !$this->cond ) 
	{
		$this->arr_call_masking = array(
			$outCls->get_value('CallSessionId', 'strtoupper'),
			$outCls->get_value('AgentName', 'strtoupper'),
			$outCls->get_value('Callernumber','_setMasking'),
			$outCls->get_value('CustomerId','strtoupper')
		);
		
		$this->arr_result = join("_", $this->arr_call_masking);
	}
	
	return (string)$this->arr_result;
	
 }


}

?>