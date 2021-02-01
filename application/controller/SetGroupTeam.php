<?php 
class SetGroupTeam extends EUI_Controller 
{

/* void :: super user 	**/

 public function SetGroupTeam()
 {
	parent::__construct();
		$this->load->model(array(base_class_model($this)));
 }
 
 
/** void:: index of page class attribute handle **/
function index()
{
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$UI = array('page' => $this ->{base_class_model($this)} ->_get_default());
		$this->load->view("mod_group_team/view_group_team_nav.php", $UI);
	}
}

/** void:: index of page class attribute handle **/


 public function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array(
			'page' => $this->{base_class_model($this)} ->_get_resource(),
			'num' => $this->{base_class_model($this)} ->_get_page_number()
		);
		
		// sent to view data 
		$this->load->view('mod_group_team/view_group_team_list',$UI);	
	}
	
 }
 
 /* AddGroupTeam **/
 
 public function AddGroupTeam()
 {
	if( $this -> EUI_Session->_have_get_session('UserId') ) 
	{
		$this -> load -> view("mod_group_team/view_add_group_team");
	}	
 }
 
 
 /* http://localhost:8080/AIA/index.php/SetGroupTeam/SaveAddGroupTeam/ **/
 
 public function SaveAddGroupTeam()
 {
	$_conds = array('success' => 0 );
	if( $param = $this -> URI->_get_all_request() )
	{
		if( $this->{base_class_model($this)} ->_setSaveAddGroupTeam( $param ) ) {
			$_conds = array('success' => 1);	
		}
		
	}
	
	__(json_encode($_conds));
	
 }
 
/* http://localhost:8080/AIA/index.php/SetGroupTeam/EditGroupTeam/?GroupId=1 **/

public function EditGroupTeam()
{
	
	if( $GroupId= $this -> URI->_get_post('GroupId') )
	{
		if( $rows_select = $this ->{base_class_model($this)}->_getGroupCall( $GroupId ) )
		{	
			if( $Out = array( 'rows' => $rows_select ) )
			{
				$this -> load -> view("mod_group_team/view_edit_group_team", $Out);
			}
		}
	}
}	


/* http://localhost:8080/AIA/index.php/SetGroupTeam/SaveEditGroupTeam/ */

public function SaveEditGroupTeam()
{
	$_conds = array('success' => 0 );
	if( $param = $this -> URI->_get_all_request() )
	{
		if( $this->{base_class_model($this)} ->_setSaveEditGroupTeam( $param ) ) {
			$_conds = array('success' => 1);	
		}
		
	}
	
	__(json_encode($_conds));

}

/* http://localhost:8080/AIA/index.php/SetGroupTeam/DeleteGroupTeam/  */
public function DeleteGroupTeam()
{
	$_conds = array('success' => 0 );
	if( $param = $this -> URI->_get_array_post('GroupId') )
	{
		if( $this->{base_class_model($this)} ->_setDeleteGroupTeam( $param ) ) {
			$_conds = array('success' => 1);	
		}
		
	}
	
	__(json_encode($_conds));
}


/* http://localhost:8080/AIA/index.php/SetGroupTeam/ViewGroupTeam/?GroupId=4 */
public function ViewGroupTeam()
{
	$UI = array(
		'UserTeam' => $this ->{base_class_model($this)}->_getUserTeam($this ->URI->_get_post('GroupId'))
	);
	$this -> load -> view("mod_group_team/view_layout_group_team",$UI);
}

/* http://localhost:8080/AIA/index.php/SetGroupTeam/UserCapacity/?GroupId=4&_=1410279760638*/

public function UserCapacity()
{
	if( $param = $this -> URI->_get_array_post('GroupId') )
	{
		$this -> load -> view("mod_group_team/view_usercapacity_group",$UI);
	}	
}
 

/* http://localhost:8080/AIA/index.php/SetGroupTeam/ShowListAgent/?page=0 **/

 public function ShowListAgent()
{
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		$OUT = array(
			'content'  => $this->{base_class_model($this)}->_getRecordAgentList(),
			'selpages' => $this->{base_class_model($this)}->_getPage(),
			'records'  => $this->{base_class_model($this)}->_getRecords(),
			'current'  => $this->URI->_get_post('page')	
		);
		$this -> load -> view("mod_group_team/view_showagentlist_group",$OUT);
	}	
}
 
 
/* http://localhost:8080/AIA/index.php/SetGroupTeam/ShowUserGroup/?GroupId=4 */

 public function ShowUserGroup()
 {
	if( $this ->EUI_Session->_have_get_session('UserId') )
	{
		$OUT = array( 
			'content' => $this->{base_class_model($this)}->_getUserGroupTeam(), 
			'label' => $this->{base_class_model($this)}->_getLabelGroupTeam()
		);
		
		$this -> load ->view("mod_group_team/view_user_on_group", $OUT);
	}	
 }
 
 
 // AddUserUserGroup
 
public function AddUserUserGroup()
 {
	$_conds = array('success' => 0 );
	
	if( $this ->EUI_Session->_have_get_session('UserId') )
	{
		if( $rs = $this ->{base_class_model($this)}->_setAddUserUserGroup() ){
			$_conds = array('success' => 1 );	
		}
	}

	__(json_encode($_conds));	
 }
 
// RemoveUserUserGroup 

public function RemoveUserUserGroup()
{
	$_conds = array('success' => 0 );
	
	if( $this ->EUI_Session->_have_get_session('UserId') )
	{
		if( $rs = $this ->{base_class_model($this)}->_setRemoveUserUserGroup() ){
			$_conds = array('success' => 1 );	
		}
	}

	__(json_encode($_conds));
}

 
}

?>