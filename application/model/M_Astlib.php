<?php

/* ExtenSpy Command Setting
 *
 * ref: http://www.voip-info.org/wiki/view/Asterisk+cmd+ExtenSpy
 * --------------------------------------------------------------------------
 
	b				: Only listens to channels which belong to a bridged call. 
	g(grp)	: Only listens to channels where the channel variable ${SPYGROUP} is set to grp. ${SPYGROUP} can contain a : separated list of values. 
	q				: Do not play a tone or say the channel name when listening starts on a channel. 
	r(name)	: Records the listening session to the spool directory. A filename may be specified if desired; chanspy is the default. 
	v(value): Sets the initial volume. The value may be between -4 and 4. 
	w				: Enables "whisper" mode. Lets the spying channel talk to the spyed-on channel. 
	W				: Enables "private whisper mode". The "spying" channel can whisper to the spyed-on channel, but cannot listen. 
	h       : Hangup channel after spying done on target channel.
*/
 
class M_Astlib extends EUI_Model 
{
 private static $instance = null;
 private static $ASTMAN_PORT = null;
 private static $ASTMAN_USER = null;
 private static $ASTMAN_PASS = null;
 private static $ASTMAN_HOST = null;
 private static $EXTENSPY_OPTION = null;
 

 /*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public static function &getInstance()
 {
	if(is_null(self::$instance) )
	{
		self::$instance = new self();
	}
	
	return self::$instance;
 }
 
 /*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
 public function M_Astlib() { }
 
 /*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 public function setAstlib($config = array() )
 {
	if( is_null(self::$ASTMAN_HOST)) 
		self::$ASTMAN_HOST = $config['ASTMAN_HOST'];
		
	if( is_null(self::$ASTMAN_PORT)) 
		self::$ASTMAN_PORT  = $config['ASTMAN_PORT'];
	
	if( is_null(self::$ASTMAN_USER)) 
		self::$ASTMAN_USER  = $config['ASTMAN_USER'];
	
	if( is_null(self::$ASTMAN_PASS)) 
		self::$ASTMAN_PASS  = $config['ASTMAN_PASS'];
 } 
 
 
 /*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function setSpyOptions( $option = 'bqh')
 {
	if( is_null(self::$EXTENSPY_OPTION) )
	{
		if( !is_null($option) )
		{
			self::$EXTENSPY_OPTION = $option;
		}	
	}
 }
 
 
/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
  
private function logDebug($msg)
{
  $logfile = '/tmp/astlib-'.date('Ymd').'.log';
  
  $timestamp = date('Ymd His');
  $handle = fopen($logfile, "a");
  fwrite($handle, $timestamp.': '.$msg);
  fclose($handle);
}


/**
 Send message to asterisk
 return reply as array
 */
 
function mgrSendMsg($fp, $msg){	
	
 if(!$fp)return NULL;
 fwrite($fp, $msg, strlen($msg));
 if (function_exists('stream_set_timeout'))
  	stream_set_timeout ( $fp, 5);
  else
  	socket_set_timeout( $fp, 5);
  	
	self::logDebug("\n".$msg);
  
  /* read reply content */
	$msgReply = array();
	do{
		$line = fgets ( $fp);
		$msgReply[] = $line;
	}while ($line != "\r\n");  
  
	return $msgReply;
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */               
 
public function mgrDisconnect($fp) 
{
  fclose($fp);
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */               
 
function mgrConnect($mgrHost, $mgrPort, $mgrUser, $mgrPasswd)
{
	$fp = fsockopen($mgrHost, $mgrPort, $errno, $errstr, 10);
		
	// echo "mgrhost :{$mgrHost} |mgrport :{$mgrPort} |Err :{$errno}| Err str :{$errstr}";
		
		
	if(!$fp) {
		echo "Server connection error to $mgrHost:$mgrPort";
		return NULL;
	}
  
	$loginMessage = "Action: login\r\n".
               		"Username: $mgrUser\r\n".
               		"Secret: $mgrPasswd\r\n".
               		"Events: off\r\n\r\n";
	
	$reply = self::mgrSendMsg($fp, $loginMessage);
	$n = count($reply);
	
	if($n < 3){
		self::mgrDisconnect($fp);
		return NULL;
	}
	
	if(!strncasecmp($reply[1], "Response:", 9))
	{
		$response = trim(substr($reply[1], 9));
		if(strcasecmp($response, "Success"))
		{
			self::mgrDisconnect($fp);
			return NULL;
		}
	}
  
	return $fp;
}

	

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function mgrWaitMsg($fp)
{
	/* read reply content */
	$msgReply = "";
	do{
		$line = fgets ( $fp);
		$msgReply .= $line;
	}while ($line != "\r\n");  
  
	return $msgReply;
}               	

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function astShowSipPeers()
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	//get channel list
	$msg = "Action:Command\r\n".
				 "Command:sip show peers\r\n\r\n";
	$reply = self::mgrSendMsg($fp, $msg);
	
	$result = array();
	$cnt = count($reply);
	
	//don't include first 2 lines and last 2 lines
	
	
	$_sz = 0;
	for($i=3; $i<($cnt-3); $i++)
	{
		$_sip = preg_split("/\s+/", $reply[$i]);
		$_sip_result = array();
		
		foreach( $_sip  as $k => $_founder ){
			if(trim($_founder)!=''){
				$_sip_result[] = $_founder;
			}
		}
		
		// grep to list 
		list($username, $host, $dyn, $acl, $port, $status ) = $_sip_result; 
		// pus array
		if( $status !='UNKNOWN' ){
			list($a, $b, $c, $d, $e ) = $_sip_result; 
				$result[$_sz]= array( 'username' => $a, 'host' => $b, 'dyn' => '', 'acl' => '', 'port' => $c, 'status' => $d );
		}
		else{
			list($a, $b, $c, $d, $e, $f) = $_sip_result; 
				$result[$_sz]= array( 'username' => $a, 'host' => $b, 'dyn' => $c, 'acl' => $d, 'port' => $e, 'status' => $f );
		}
		
		$_sz++;
	}
	self::mgrDisconnect($fp);
	
	
	return $result;
}
/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function astShowChannels()
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	//get channel list
	$msg = "Action: Command\r\n".
				 "Command: core show channels concise\r\n\r\n";
	$reply = self::mgrSendMsg($fp, $msg);	
	
	$result = array();
	$cnt = count($reply);
	//don't include first 2 lines and last 2 lines
	for($i=2; $i<($cnt-2); $i++){
		if(!preg_match('_Outgoing Line_i',$reply[$i],$match)){
			$result[] = $reply[$i];
		}
	}
	
	//get channel count
	$msg = "Action: Command\r\n".
				 "Command: core show channels count\r\n\r\n";
	$reply = self::mgrSendMsg($fp, $msg);		
	
	$cnt = count($reply);
	//don't include first 2 lines and last 2 lines
	for($i=2; $i<($cnt-2); $i++){
		$result[] = $reply[$i];
	}
	self::mgrDisconnect($fp);
	return $result;
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function astShowChannel($channel)
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	$msg = "Action: Command\r\n".
				 "Command: core show channel $channel\r\n\r\n";
	$reply = self::mgrSendMsg($fp, $msg);	
	
	$result = array();
	$cnt = count($reply);
	//don't include first 2 lines and last 2 lines
	for($i=2; $i<($cnt-2); $i++){
		$result[] = $reply[$i];
	}
	self::mgrDisconnect($fp);
	return $result;
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function astExtenSpy_original($fromext, $channel)
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	$option = self::$EXTENSPY_OPTION;
	if($option)
		$option = ",".$option;
	$msg = "Action: Originate\r\n".
				 "Channel: $fromext\r\n".	
				 "Application: ExtenSpy\r\n".
				 "Data: $channel".$option."\r\n".
				 "CallerID: B2B\r\n".
				 "\r\n";				 
	
	//echo nl2br($msg);
	$reply = self::mgrSendMsg($fp, $msg);	
	
	//var_dump($reply);
	self::mgrDisconnect($fp);
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function astExtenSpy($fromext, $channel, $callerid, $opt)
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	$option = self::$EXTENSPY_OPTION;
	if($option){
		$option = "|".$option;
		// $option = ",".$option;
  }
  
  if($opt == "r"){
		$option = ",q".$opt.'('.$callerid.')';
  }
	$msg = "Action: Originate\r\n".
				 "Channel: $fromext\r\n".	
				 "Application: ExtenSpy\r\n".
				 "Data: $channel".$option."\r\n".
				 "CallerID: $callerid\r\n".
				 "Context: centerback\r\n".
				 "\r\n";				 
	$reply = self::mgrSendMsg($fp, $msg);	
	
	//var_dump($reply);
	self::mgrDisconnect($fp);
}

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function astChanSpy($fromext, $channel, $callerid,$opt)
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	$option = self::$EXTENSPY_OPTION;
	if($option){
		// $option = ",".$option;
		$option = "|".$option;
  }
  if($opt == "r"){
		$option = ",q".$opt.'('.$callerid.')';
  }
	$msg = "Action: Originate\r\n".
				 "Channel: $fromext\r\n".	
				 "Application: ChanSpy\r\n".
				 "Data: $channel".$option."\r\n".
				 "CallerID: $callerid\r\n".
				 "Context: centerback\r\n".
				 "\r\n";				 
	//echo 
	//echo nl2br($msg);
	$reply = self::mgrSendMsg($fp, $msg);	
	
	//var_dump($reply);
	self::logDebug($reply);
	self::mgrDisconnect($fp);
}



/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function showPeersAsXML()
{  	
	$lines = self::astShowSipPeers();
	if( is_array($lines)) { 
		return $lines;
	}
	else	
		return array();
		
  }
  

/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function showChannelsAsXML()
{  	
  	$output = '<?xml version="1.0" encoding="ISO-8859-1"?>';
  	
  	$lines = self::astShowChannels();
  	$output .= "<Channels>";
  	if(count($lines) == 0){
  		$output .= "<Item><ChannelData>Empty Channels</ChannelData></Item>";
  	}else{  	
		  foreach ($lines as $line){
		  	$chan = explode("!", $line);
		  	if(count($chan) > 12){		  		
		  		$output .= "<Item><ChannelData>";
		  		$output .= "<Channel>".$chan[0]."</Channel>".
  		               "<Context>".$chan[1]."</Context>".
  		               "<Callerid>".$chan[7]."</Callerid>".
  		               "<Extension>".$chan[2]."</Extension>";
					$output .= "</ChannelData></Item>";
		  	}
		  }
		}  
  	$output .= "</Channels>";
  	return $output;
  }
  
/*
 * @ def 		: options / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function astChanSpyWhisper($fromext, $channel,$callerid,$opt)
{
	$fp = self::mgrConnect(self::$ASTMAN_HOST, self::$ASTMAN_PORT, self::$ASTMAN_USER, self::$ASTMAN_PASS);
	
	$option = self::$EXTENSPY_OPTION . "w";
	
	if($option) {
		// $option = ",".$option;
		$option = "|".$option;
		
	}	
		
    if($opt == "r") $option = ",q".$opt.'('.$callerid.')';
    
        $msg = "Action: Originate\r\n".
				"Channel: $fromext\r\n".
                "Application: ChanSpy\r\n".
                "Data: $channel".$option."\r\n".
                "CallerID: $callerid\r\n".
                "Context: centerback\r\n".
                "\r\n";

   $reply = self::mgrSendMsg($fp, $msg);
   self::mgrDisconnect($fp);
}
 
 
}
