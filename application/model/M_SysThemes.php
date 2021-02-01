<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
 
class M_SysThemes extends EUI_Model
{

function __construct()
{
	//run && execute
}

// @ get default list content 
	
function _get_default()
{
	$datas = array();
	$sql = " select a.id, a.name from tms_application_themes a ";
	$qry = $this -> db -> query($sql);
	foreach( $qry -> result_assoc() as $rows ) {
		$datas[$rows['id']] = $rows['name'];	
	}
	
	return $datas;
  
}

// @ _set_save_webthemes 

function _set_save_webthemes( $themes )
{
	$_conds= false;
	if( $themes!='' )
	{
		$sql = " UPDATE tms_application_config a  SET a.description ='$themes', a.param_value='$themes'  
				 WHERE a.module_name='CONFIG' 
				 AND a.param_name='THEME' ";
		
		if( $this -> db ->query($sql) )
		{
			$_conds = true;
		}
	}		

  return $_conds;	
}
 
/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getUserThemes()
{
	$_conds = array();
	$this -> db ->reset_select();
	$this -> db ->select('*');
	$this -> db ->from('tms_application_themes');
	
	foreach( $this -> db ->get() -> result_assoc() as $rows ) {
		$_conds[$rows['id']] = $rows['name'];
	}
	
	return $_conds;
	
}
/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getUserLayout()
{
	$_conds = array();
	$this -> db ->select('*');
	$this -> db ->from('t_gn_layout');
	$this -> db ->where('Flags',1);
	
	foreach( $this -> db ->get() -> result_assoc() as $rows ) {
		$_conds[$rows['Id']] = $rows['Name'];
	}
	
	return $_conds;
	
}

/*
 * @ def 		: _getUserThemes
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _getLayout()
{
	$_conds = array();
	
	$this -> db ->select('*');
	$this -> db ->from('t_gn_layout');
	$this -> db ->where_in('Flags',array(1,0));
	$this -> db ->order_by('Id','DESC');
	
	foreach( $this -> db ->get() -> result_assoc() as $rows )
	{
		$_conds[$rows['Id']] = array
		(	
			'Name' => $rows['Name'],
			'Images' => $this -> Layout -> base_style() .'/'. $rows['Name'] .'/images/'.$rows['Images'],
			'Author' => $rows['Author'],
			'Description' => $rows['Description'],
			'Flags' => $rows['Flags'] 
		); 
	}
	
	return $_conds;
}


// _setActive

function _setActive($LayoutId =null, $Active = 0)
{
	$_conds = 0;
	if( is_array($LayoutId) )
	{
		foreach($LayoutId as $k => $ID )
		{
			if( $this -> db -> update('t_gn_layout',array( 'Flags'=>$Active ), array('id'=> $ID) ) )
			{
				$_conds++;
			}
			
		}
	}
	
	return $_conds;
}

// _setDelete
function _setDelete($LayoutId =null)
{
	$_conds = 0;
	if( is_array($LayoutId) )
	{
		foreach($LayoutId as $k => $ID )
		{
			if( $this -> db -> delete('t_gn_layout', array('id'=> $ID) ) )
			{
				$_conds++;
			}
			
		}
	}
	
	return $_conds;
}

//_setUpdateLayout

function _setUpdateLayout($Update=null)
{
	$_conds = 0;
	if(!is_null($Update) )
	{
		foreach($Update as $fieldname => $fieldvalue )
		{
			if($fieldname=='Id'){
				$this -> db -> where($fieldname,$fieldvalue);
			}
			else{
				$this -> db -> set($fieldname,$fieldvalue);
			}
			
			$this -> db -> update('t_gn_layout');
			if( $this->db->affected_rows() > 0)
			{
				$_conds++;
			}
		}
	}
	
	return $_conds;
}

//

function _setSaveLayout($Layout=null){
	$_conds = 0;
	if( is_array($Layout) )
	{
		if( $this -> db->insert('t_gn_layout',$Layout) ){
			$_conds++;
		}
	}
	
	return $_conds;
	
	
}

}

?>