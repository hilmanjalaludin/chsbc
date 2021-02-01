<?php
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
class M_QtyPoint extends EUI_Model
{


// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 

 
private static $Instance  = null;	
	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */ 
 function __construct() { }

	
// -----------------------------------------------------------

/* 
 * Method 		AddUser 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 public static function &Instance()
{
	if( is_null(self::$Instance) )
 {
	self::$Instance = new self();
 }
  return  self::$Instance;
 
}
	
	
public function _getAssesment()
{
 
 $approval = array();
 if( $this -> EUI_Session -> _get_session('UserId') )
 {
	$this->db->select('a.Id, a.ApprovalQuestion, a.ApprovalQuestionDesc,
		a.ApprovalQuestionHint, a.ApprovalIsFailed');
		
	$this->db->from('t_lk_approval_question a');
	$this->db->order_by('a.ApprovalQuestionOrder','ASC');
	foreach( $this->db->get()->result_assoc() as $rows ) 
	{
		$approval[$rows['Id']] = $rows; 
	}
 }
 return $approval;
}

// get _jsonAssesment

public function _jsonAssesment()
{
 
 $approval = array();
 if( $this -> EUI_Session -> _get_session('UserId') )
 {
	$this->db->select('a.Id, a.ApprovalIsFailed');
	$this->db->from('t_lk_approval_question a');
	$this->db->order_by('a.ApprovalQuestionOrder','ASC');
	foreach( $this->db->get()->result_assoc() as $rows ) 
	{
		$approval[$rows['Id']] = array('value' => $rows['ApprovalIsFailed']); 
	}
 }
 return $approval;
}


// get approval Point 

public function _getApprovalPoint( $CustomerId = null )
{
	$results = array();
	
	if( !is_null($CustomerId))
	{
		$this ->db ->select("a.*");
		$this ->db ->from("t_gn_qa_approval a");
		$this ->db ->where("a.CustomerId", $CustomerId);
	
		if( $rows  = $this->db->get()->result_first_assoc() )
		{ 
			if( $point_values = explode(',',$rows['ApprovalPoints']) )
			{
				$i = 1;
				foreach( $point_values as $k => $values ) {
					$results['ApprovalPoints'][$i] = $values;
					$i++;
				}	
				
				$results['ApprovalById'] 	 = explode(',',$rows['ApprovalById']);
				$results['CustomerId'] 		 = $rows['CustomerId'];
				$results['ApprovalUserId'] 	 = $rows['ApprovalUserId'];
				$results['ApprovalUserName'] = $rows['ApprovalUserName'];
				$results['ApprovalStatus'] 	 = $rows['ApprovalStatus'];	
				$results['ApprovalTs'] 		 = $rows['ApprovalTs'];	
				$results['ApprovalRemark'] 	 = $rows['ApprovalRemark'];	
			}	
		}
	}
	
	return $results;
}

// get point on score quality 

public function _getQualityScoring( $CustomerId=0 )
{
	$this->db->select("b.*, a.ScoringRemark");
	$this->db->from("t_gn_qa_scoring a ");
	$this->db->join("t_gn_scoring_point b", "a.Id=b.ScoringId","LEFT" );
	$this->db->where("a.CustomerId",$CustomerId);
	
	$QtyLeaves = array();
	foreach( $this -> db -> get() -> result_assoc() as $rows )
	{
		if( $rows['ScoringQuestionId']) 
		{
			$_values = EXPLODE(',', $rows['ScoringQuestionValue']);
			foreach( EXPLODE(',', $rows['ScoringQuestionId']) as $idxID =>  $pointID ) 
			{
				$QtyLeaves[$rows['ScoringCategoryId']]['point'][$pointID] = (INT)$_values[$idxID];	
			}
			
			$QtyLeaves['remarks'] = $rows['ScoringRemark'];
			$QtyLeaves[$rows['ScoringCategoryId']]['total1'] = (INT)$rows['ScoringTotalScore1'];
			$QtyLeaves[$rows['ScoringCategoryId']]['total2'] = (INT)$rows['ScoringTotalScore2'];
			
		}
	}
	
	return $QtyLeaves;
	
}

 
 /* START OF CHECKLIST B */
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function _getContentScoring()
 {
	$datas = array(
		'Category'=>$this->_getQuestion(),
		'SubCategory'=>$this->_getSubQuestion()
	);
	
	return $datas;
 }
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
private function _getSubQuestion()
 {
	$arr = array();
	
	$sql = "select * from t_lk_scoring_question a";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$arr[$rows['ScoringCategoryNo']][$rows['Id']] = $rows;
		}
	}
	
	return $arr;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
private function _getQuestion()
 {
	$arr = array();
	
	$sql = "select * from t_lk_scoring_category a";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows() > 0)
	{
		foreach($qry->result_assoc() as $rows)
		{
			$arr[$rows['Id']] = $rows['QuestionCategory'];
		}
	}
	
	return $arr;
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */ 
 
public function _comboScoring()
 {
	return array(
		'0'=>'0',
		'1'=>'1'
	);
 }
 
 /* END OF CHECKLIST B */


}

?>