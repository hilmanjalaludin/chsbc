<?php

	class Target Extends EUI_Controller
	{
	 
		public function Target()
		{
			parent::__construct();	
			$this -> load -> model(array(base_class_model($this)));
		}
		
		public function index()
		{
			if( $this -> EUI_Session -> _have_get_session('UserId') )
			{	
				if( class_exists(base_class_model($this)) ) 
				{
					$EUI = array( 
						'User' => $this -> {base_class_model($this)} -> _get_user(),
						'Target' => $this -> {base_class_model($this)} -> _get_target()
					);
					
					$this -> load -> view('target/target_nav', $EUI);
				} 
				else
				{
					echo "Class ".base_class_model($this)." does no exist ";
					exit(0);
				}
			}
		}
		
		function SaveTarget()
		{
			$_conds = array('success' => 1);
			
			if( $this -> EUI_Session -> _have_get_session('UserId') ) 
			{
				$result = $this -> {base_class_model($this)} ->Save();
				if( $result )
				{
					$_conds = array('success' => 0,'message' => $result);
				}
			}
			echo json_encode($_conds);
		}
		
	}

?>