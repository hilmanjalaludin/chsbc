<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetProductScript extends EUI_Controller
{
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function __construct()
 {
	parent::__construct();
	$this->load->model( array( base_class_model($this)) );
	$this->load->helper(array('EUI_Object'));
	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_product_script/view_product_script_nav',$_EUI);
		}	
	}	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this->{base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this->{base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) 
		   AND is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_product_script/view_product_script_list',$_EUI);
		}	
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

private function _getProductName()
{
	$Data = $this ->M_SetProduct->_getProductId();
	if( is_array($Data) )
	{
		foreach( $Data as $k => $p )
		{
			$_conds[$k] = $p['name']; 
		}
	}
	
	return $_conds;
}
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

 function AddScript()
 {
	$UI  = array
	(
		'ProductName' => $this->_getProductName(),
		'Active'=> $this ->M_SetPrefix->_get_status_prefix()
	);
	
	$this -> load -> view("set_product_script/view_product_script_add",$UI);
 }


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _is_type( $t )
{
	$_conds = false;
	
	$_type = explode('.', $t);
	$_array = array ('txt','pdf','doc', 'docs');
	
	if( in_array( strtolower($_type[count($_type)-1]), $_array )) 
		$_conds = true;
		
	return $_conds;	
} 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Upload()
{
	$_result = array('success'=>0);
	if( isset($_FILES['ScriptFileName'])) 
	{
		$_Data = $this -> URI -> _get_all_request();
		// var_dump($_Data,'testUpload');
		// die;
		if( $this -> _is_type($_FILES['ScriptFileName']['name']) ) 
		{
			if( move_uploaded_file($_FILES['ScriptFileName']['tmp_name'], APPPATH .'script/'.$_FILES['ScriptFileName']['name']))
			{
				if( $this->{base_class_model($this)}->_setUpload( array('post_data' => $_Data, 'post_files' => $_FILES ) )) 
				{
					$_result = array( 'success' => 1 );
				}
			}
		}	
	}
	// var_dump($_result);
	// die;
	
	echo json_encode($_result);
	
}

function Uploadtnc()
{
	// $_Data = $this -> URI -> _get_all_request();
	// var_dump($_Data);
	// die;
	$_result = array('success'=>0);
	if( isset($_FILES['ScriptFileNameTnc'])) 
	{
		$_Data = $this -> URI -> _get_all_request();
		// var_dump($_Data);
		// die();
		if( $this -> _is_type($_FILES['ScriptFileNameTnc']['name']) ) 
		{
			if( move_uploaded_file($_FILES['ScriptFileNameTnc']['tmp_name'], APPPATH .'script/'.$_FILES['ScriptFileNameTnc']['name']))
			{
				if( $this->{base_class_model($this)}->_setUploadtnc( array('post_data' => $_Data, 'post_files' => $_FILES ) )) 
				{
					$_result = array( 'success' => 1 );
				}
			}
		}	
	}
	
	echo json_encode($_result);
	
}
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SetActive()
{
	$_result = array('success'=>0); $_Data = array();
	if( $this -> URI->_get_have_post('ScriptId') ) 
	{
		$_Data['ScriptId'] = $this -> URI -> _get_array_post('ScriptId');
		$_Data['Flags'] = $this -> URI -> _get_post('Active');
		if( isset($_Data['ScriptId']))
		{
			if( $this ->{base_class_model($this)}->_setActive($_Data) )
			{
				$_result = array('success'=>1);
			}
		}
	}
	
	echo json_encode($_result);
	
} 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Delete()
{
	$_result = array('success'=>0); $_Data = array();
	if( $this -> URI->_get_have_post('ScriptId') ) 
	{
		$_Data['ScriptId'] = $this -> URI -> _get_array_post('ScriptId');
		if( isset($_Data['ScriptId']))
		{
			if( $this ->{base_class_model($this)}->_setDelete($_Data) )
			{
				$_result = array('success'=>1);
			}
		}
	}
	
	echo json_encode($_result);
	
} 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function getScript()
{
// ---------------------- test data -----------------------
 $obScr =& get_class_instance(base_class_model($this));
 $arr_agent_script = array();
 
 if( _have_get_session('UserId') )
 {
	$CampaignId = null;
	 if( _get_have_post('CampaignId') )
	{
		$CampaignId = _get_post('CampaignId'); 
	 }else{
		$CampaignId = 7;
	 }
	 // echo $CampaignId;
	$arr_agent_script = $obScr->_getScript( $CampaignId );
	// print_r( $arr_agent_script );
	if( is_array($arr_agent_script) 
		AND count($arr_agent_script) > 0  )
	{
		echo json_encode($arr_agent_script);
		return FALSE;
	}
 }
 echo json_encode($arr_agent_script);
 return false;
 
}

// ---------------------------------------------------------------------------------------------------------------------
/*
 * @ package 		ShowProductScript
 * -----------------------------------------
 * @ return 	: void(0)
 */
 

  public function ShowProductScript()
 {

 	// var_dump(_get_have_post('ScriptId'));
 	// die();
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScript(_get_64post('ScriptId'))
		));
	}
}

 public function ShowProductScripttnc()
 {

 	$scriptId=$_GET['ScriptId'];
 	// var_dump('flexi',$scriptId);
 	// die();
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScripttnc($scriptId)
		));
	}
}


public function ShowProductScriptpilx()
 {

 	$scriptId=$_GET['ScriptId'];
	// var_dump('pilx',$scriptId);
 // 	die();
 
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScriptpilx($scriptId)
		));
	}
}


public function ShowProductScripttncflexisingle()
 {

 	$scriptId=$_GET['ScriptId'];
	// var_dump('pilx',$scriptId);
 // 	die();
 
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScriptFlexiSingle($scriptId)
		));
	}
}

public function ShowProductScripttncPiltopUp()
 {

 	$scriptId=$_GET['ScriptId'];
	// var_dump('pilx',$scriptId);
 // 	die();
 
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScriptPiltopUp($scriptId)
		));
	}
}

public function ShowProductScripttncCipReguler()
 {

 	$scriptId=$_GET['ScriptId'];
	// var_dump('pilx',$scriptId);
 // 	die();
	if( _get_have_post('ScriptId') ) 
	{
		$obScr =& get_class_instance(base_class_model($this));
		// print_r($obScr->_getDataScriptCipReguler($scriptId));
		// print_r($scriptId);
 	// 	die();
		$this->load->view("set_product_script/view_product_show",array (
			 'Data' => $obScr->_getDataScriptCipReguler($scriptId)
		));
	}
}

 // ========================================================= END CLASS =========================================================
 
}
?>