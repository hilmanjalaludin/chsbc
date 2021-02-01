<?php  

class M_Scoring extends EUI_Model {


	public function countCustomer ( $idcustomer = "" , $fetch = "" ) {
		$countcustomers = $this-> db -> query("SELECT *FROM score_result 
			WHERE id_customer='$idcustomer'");
		if ( $countcustomers->num_rows() > 0 ) {
			if ( $fetch == true ) {
				return $countcustomers->row();
			} else {
				return 1;
			}
		} else {
			return 0;
		}
	}	

	public function saveScore ( $value = "" ) 
	{
		$questionValue = json_encode($value["question"]);
		$commentValue  = json_encode($value["comment"]);
		$yornValue  = json_encode($value["yorn"]);
	
		$this-> db -> set("question_value" , $questionValue);
		$this-> db -> set("comment_value"  , $commentValue);
		$this-> db -> set("id_qa"		   , $value["id_qa"]);
		$this-> db -> set("name_qa"		   , $value["name_qa"]);
		$this-> db -> set("id_callhistory" , $value["id_callhistory"]);
		$this-> db -> set("id_customer"	   , $value["id_customer"]);
		$this-> db -> set("id_agent" 	   , $value["id_agent"]);
		$this-> db -> set("name_agent"	   , $value["name_agent"]);
		$this-> db -> set("date_ofcallmon"	 , $value["date_ofcallmon"]);
		$this-> db -> set("datecallmon_history"	 , $value["date_ofcallmon"]);
		$this-> db -> set("date_ofselling"	 , $value["date_ofselling"]);
		$this-> db -> set("sumof_finalvalue" , $value["sumof_finalvalue"]);
		$this-> db -> set("typeofsales"      , $value["typeofsales"]);

		$this-> db -> duplicate("question_value" , $questionValue);
		$this-> db -> duplicate("comment_value"  , $commentValue);
		$this-> db -> duplicate("id_qa"		     , $value["id_qa"]);
		$this-> db -> duplicate("name_qa"		 , $value["name_qa"]);
		$this-> db -> duplicate("id_callhistory" , $value["id_callhistory"]);
		$this-> db -> duplicate("id_customer"	 , $value["id_customer"]);
		$this-> db -> duplicate("id_agent" 	     , $value["id_agent"]);
		$this-> db -> duplicate("name_agent"	 , $value["name_agent"]);
		$this-> db -> duplicate("date_ofcallmon" , $value["date_ofcallmon"]);
		$this-> db -> duplicate("date_ofselling" , $value["date_ofselling"]);
		$this-> db -> duplicate("sumof_finalvalue" , $value["sumof_finalvalue"]);
		$this-> db -> duplicate("typeofsales"      , $value["typeofsales"]);
		$this-> db -> insert_on_duplicate( "score_result" );

		if ( $this->db->affected_rows() == true ) {
			echo "Success , Save Quality Scoring!";
		} else {
			echo "Success , Save Quality Scoring!";		
		}
	}


	public function updateScore () {

	}

	public function checkFetch ( $query = "" ) 
	{
		$qry = $this->db->query( $query );
		$this->fetchScoring = (is_object($qry) ? $qry : false ); 
		if ( $this->fetchScoring != false ) {
			if ( $this->fetchScoring->num_rows() > 0 ) {
				return $this->fetchScoring;
			} else {
				return "error";
			}
		} else {
			return "error";
		}

	}

	public function fetchScoring ( $status = "" , $idcheck = "" ) {
		if ( $status == "group" ) {
			$this->group = $this->checkFetch("SELECT *FROM score_group WHERE active='Y'");
			if ( $this->group != false ) {
				return $this->group;
			} else {
				return "error";
			}
		} elseif ( $status == "param" ) {
			$this->param = $this->checkFetch("SELECT *FROM score_check WHERE grupquestion='$idcheck' ORDER BY id_question");
			if ( $this->param != false ) {
				return $this->param;
			} else {
				return "error";
			}
		}
	}

	public function getValue ( $idvalue = ""  ) {
		$values = $this->checkFetch("SELECT *FROM score_value 
			WHERE id_value='$idvalue'");
		if ( is_object($values) ) {
			return $values;
		} else {
			return "error";
		}
	}

}



?>
