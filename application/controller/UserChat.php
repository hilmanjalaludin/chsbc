<?php
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
class UserChat extends EUI_Controller  
{

//---------------------------------------------------------------------------------------
/*
 * @ package		__construct
 * 
 */
function __construct()
{
	session_start();
	parent::__construct();	
}


//---------------------------------------------------------------------------------------
/*
 * @ package		index 
 * 
 */
public function index()
{
	if(_have_get_session('UserId'))
 {
	session_start();
	
	if( _get_post('action') == "chatheartbeat") { $this->chatHeartbeat(); } 
	if( _get_post('action') == "sendchat") { $this->sendChat(); } 
	if( _get_post('action') == "closechat") { $this->closeChat(); } 
	if( _get_post('action') == "startchatsession") { $this->startChatSession(); } 
	
	// --------------------------%---------------------------------------------------------- 
	$chatHistory  = _set_key_session('chatHistory');
	if(!isset($_SESSION[$chatHistory])) 
	{
		_set_session('chatHistory', array());	
	}

	$openChatBoxes = _set_key_session('openChatBoxes');	
	 if (!isset($_SESSION[$openChatBoxes] ) ) 
	{
		_set_session('openChatBoxes', array());	
	}
	
  }
} 
// ==================== END INDEX =======================


//---------------------------------------------------------------------------------------
/*
 * @ package		chatHeartbeat
 * 
 */

public function chatHeartbeat() 
{
	
  session_start();
  $this->db->select("a.*, b.full_name as AliasTo, c.full_name as AliasFrom ");
  $this->db->from("tms_agent_chat a");
  $this->db->join("tms_agent b ","a.[to]=b.id","LEFT");
  $this->db->join("tms_agent c ","a.[from]=c.id","LEFT");
  $this->db->where("a.[to]",_get_session('Username'));
  $this->db->where("a.recd",0);
  $this->db->order_by("a.id","ASC");
 
  $items = '';
  $chatBoxes = array();
  
 // ---------------------------------------------------------------- 
 
 $openChatBoxes = _set_key_session('openChatBoxes'); 
 $chatHistory   = _set_key_session('chatHistory');
 $tsChatBoxes   = _set_key_session('tsChatBoxes');
 
//----------------------------------------------------------------------------
	
  $rs = $this->db->get();
  foreach( $rs->result_assoc() as $chat ) 
  {
	if (!isset($_SESSION[$openChatBoxes][$chat['from']]) 
		AND isset($_SESSION[$chatHistory][$chat['from']])) 
	{
		$items = $_SESSION[$chatHistory][$chat['from']];
	}
	
	// ------------ next --------------------------------------
	
	$chat['message'] = $this->sanitize($chat['message']);
	
		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"g": "{$this->_FirstWord($chat['AliasFrom'])}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION[$chatHistory][$chat['from']])) {
		$_SESSION[$chatHistory][$chat['from']] = '';
	}

	$_SESSION[$chatHistory][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"g": "{$this->_FirstWord($chat['AliasFrom'])}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION[$tsChatBoxes][$chat['from']]);
		$_SESSION[$openChatBoxes][$chat['from']] = array('time' => $chat['sent'], 
			'aliasfrom' => $this->_FirstWord($chat['AliasFrom']));
	}

	if (!empty($_SESSION[$openChatBoxes])) 
	{
		foreach ($_SESSION[$openChatBoxes] as $chatbox => $rows) 
		{
			if (!isset($_SESSION[$tsChatBoxes][$chatbox])) {
				$now = time()-strtotime($rows['time']);
				$time = date('g:iA M dS', strtotime($rows['time']));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
	"s": "2",
	"f": "{$chatbox}",
	"g": "{$this->_FirstWord($rows['aliasfrom'])}",
	"m": "{$message}"
},
EOD;

	if (!isset($_SESSION[$chatHistory][$chatbox])) {
		$_SESSION[$chatHistory][$chatbox] = '';
	}

	$_SESSION[$chatHistory][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "{$chatbox}",
"g": "{$this->_FirstWord($rows['aliasfrom'])}",
"m": "{$message}"
},
EOD;
			$_SESSION[$tsChatBoxes][$chatbox] = 1;
		}
		}
	}
}

// update flags if isread 

	$this->db->set('recd',1);
	$this->db->where('[to]',trim(_get_session('Username')));
	$this->db->where('recd',0);
	$this->db->update('tms_agent_chat');
	
	if ($items != '') 
	{
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}
<?php
exit(0);
}


//-------------------------------------------------------
// chatBoxSession


function chatBoxSession($chatbox) 
{
  $items = '';
  $chatHistory = _set_key_session('chatHistory');
   if (isset($_SESSION[$chatHistory][$chatbox])) 
  {
	 $items = $_SESSION[$chatHistory][$chatbox];
  }
  return $items;	
}

//---------------------------------------------------------------------------------------
/*
 * @ package		startChatSession
 * 
 */

public function startChatSession() 
{
 session_start();
 $openChatBoxes = _set_key_session('openChatBoxes');

 $items = '';
  if (!empty($_SESSION[$openChatBoxes])) 
	  foreach ($_SESSION[$openChatBoxes] as $chatbox => $void) 
  {
		$items.= $this->chatBoxSession($chatbox);
  }
 
// --------------- next step 
 
	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json'); ?>
{
	"username"	: "<?php echo _get_session('Username');?>",
	"codeuser" 	: "<?php echo self::_FirstWord( _get_session('Username') );?>",
	"items"		: [<?php echo $items; ?>]
}
<?php exit(0);
}

//---------------------------------------------------------------------------------------
/*
 * @ package		sendChat
 * 
 */
function _FirstWord( $Words = null )
{
 $_Words = null;
  if( !is_null($Words) ) 
  {
	if( $_array_list = explode(" ", $Words) ) {
		$_Words = strtoupper($_array_list[0]);
	 }
  }
	return $_Words;
}

//---------------------------------------------------------------------------------------
/*
 * @ package		sendChat
 * 
 */
public function sendChat()
{
	session_start();	

 	#-------------------------------------------------------------
 	$aliasname =& $this->_FirstWord(_get_post('aliasname'));
 	$message = _get_post('message');
 	$from = _get_session('Username');
 	$to = _get_post('to');
 	#$to = _get_post('[to]');
 	#-------------------------------------------------------------
 	$openChatBoxes = _set_key_session('openChatBoxes'); 
 	$_SESSION[$openChatBoxes][$to] = array( 'time' => date('Y-m-d H:i:s', time()), 'aliasto' => $aliasname );
 
 	#-------------------------------------------------------------
 	$messagesan = $this->sanitize($message);
 
 	#-------------------------------------------------------------
 	$chatHistory = _set_key_session('chatHistory'); 
 	if (!isset($_SESSION[$chatHistory][$to])) {
		$_SESSION[$chatHistory][$to] = '';
 	}	
 
 	#-------------------------------------------------------------
 	#-------------------------------------------------------------
 	$_SESSION[$chatHistory][$to] .= <<<EOD
   	{
		"s": "1",
		"f": "{$to}",
		"g": "{$aliasname}",
		"m": "{$messagesan}"
  	},
EOD;

	# --------------------------------------------------------------------------------------------------------
	$tsChatBoxes = _set_key_session('tsChatBoxes'); 
	unset($_SESSION[$tsChatBoxes][$to]);
	
	# ----------------- insert db ----------------------------
	$this->db->set('[from]',$from);
	$this->db->set('[to]',$to);
	$this->db->set('message',$message);
	$this->db->set('sent',date('Y-m-d H:i:s'));
	$this->db->insert('tms_agent_chat');
	#var_dump( $this->db->last_query() ); die();
	echo "1";
	exit(0);
	
}


//---------------------------------------------------------------------------------------
/*
 * @ package		sendChat
 * 
 */
public function closeChat() 
{
	$openChatBoxes=_set_key_session('openChatBoxes');
	unset($_SESSION[$openChatBoxes][_get_post('chatbox')]);
	echo "1";
	exit(0);
}

//---------------------------------------------------------------------------------------
/*
 * @ package		sanitize
 * 
 */
public function sanitize($text) 
{
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}


// ================ END CLASS ==========================
}

?> 