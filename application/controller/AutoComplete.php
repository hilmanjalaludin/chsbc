<?php 
class AutoComplete extends EUI_Controller
{


/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
  public function AutoComplete()
  {
	 parent::__construct();
	 $this -> load->model(array(base_class_model($this)));
  }
  
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */  
function index(){}	

/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 public function ZipCode()
 {
    $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getZipCode($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
  }
  
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function City()
 {
	 $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getKota($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
 }
 
   
/*
 * @ def 	: index / default page on this controller
 * ----------------------------------------------------
 * @ param  : $_POST
 * @ author : razaki team
 * 
 */
 
 function Kecamatan()
 {
	 $_zip_code_values = "";
	
	$keyword= strtolower( $this -> URI->_get_post("q") );
	
	if( $items = $this -> {base_class_model($this)} -> _getKecamatan($keyword) )
	{
	
		foreach ($items as $key=>$value) 
		{	
			if (strpos(strtolower($key), $keyword) !== false)
			{
				 $_zip_code_values .="{$key}|{$value}\n";
			}
		}
	}
	
	__( $_zip_code_values);
 }
 
 
  
}

?>
