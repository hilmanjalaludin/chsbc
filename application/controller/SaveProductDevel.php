<?php

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
class SaveProductDevel extends EUI_Controller
{



/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function SaveProductDevel() 
{
	parent::__construct();
	$this -> load -> model(array(base_class_model($this),'M_ProductForm','M_ValidPayment'));
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function index()
{
	$this->Save();
}


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
public function Save()
{
	$conds = array('PolicyNumber'=>'');
	
	if( $this -> URI -> _get_have_post('PecahPolicy') )
	{
		if($this -> URI -> _get_post('PecahPolicy')==0 ){
			$conds = $this->M_ProductForm->_setNoPecah( $this ->URI->_get_all_request() );
			// $conds = $this->{base_class_model($this)}->_setNoPecah( $this ->URI->_get_all_request() );
		}
		
		if($this -> URI -> _get_post('PecahPolicy')==1 ){
			$conds = $this->M_ProductForm->_setYesPecah( $this ->URI->_get_all_request() );
		}
	}
	
	__(json_encode($conds));
}

function SavePayment()
{
	$conds = array('success'=>0);
	
	$conds = $this->M_ValidPayment->StartSavePayment( $this ->URI->_get_all_request() );
	
	__(json_encode($conds));
}

}
?>