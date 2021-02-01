<?php

class UserDistribusi extends EUI_Controller
{
    var $gDistributeRata = 1;
    var $gDistributeAgent = 2;

    function __construct()
    {
        parent::__construct();
        $this->load->model(array(base_class_model($this)));
        $this->load->helper(array('EUI_Object'));
    }

    public function index()
    {
        $out =new EUI_Object( _get_all_request() );
        $cond = array('success' => 0) ;
  
        if( !_have_get_session('UserId') ) 
        {
            echo json_encode( $cond );
            return false;
        }
  
        //--------------- checj parameter ------------------------ 
        if( !$out->fetch_ready()) 
        {
            echo json_encode( $cond );
            return false; 
        } 

        // --------- tes -----------
        // $out->debug_label();
        #var_dump( $out->get_value('dis_user_type') );die();
        $output =& get_class_instance(base_class_model($this)); 
        if( $out->get_value('dis_user_type') == 1 )
        {
            $cond = array(
              'success' => $output->_set_row_distribusi_rata( $out )
            );
        }
 
        if( $out->get_value('dis_user_type') == 2 )
        {
            $cond = array(
              'success' => $output->_set_row_distribusi_agent( $out )
            );
        }  
        echo json_encode( $cond );
    }

    /**
     * (F) distribusiPds [distribusi Data PDS]
     */
    public function distribusiPds()
    {
        $out =new EUI_Object( _get_all_request() );
        // var_dump( $out ); die();

        $cond = array('success' => 0) ;
  
        if( !_have_get_session('UserId') ) 
        {
            echo json_encode( $cond );
            return false;
        }
  
        //--------------- checj parameter ------------------------ 
        if( !$out->fetch_ready()) 
        {
            echo json_encode( $cond );
            return false; 
        } 
        $output =& get_class_instance(base_class_model($this)); 
        $cond = array(
            'success' => $output->_setRowDistribusiRataPds( $out )
        );
        echo json_encode( $cond );
        
        /**** STOP DULU******/
       /* if( $out->get_value('dis_user_type') == 1 )
        {
            $cond = array(
              'success' => $output->_set_row_distribusi_rata( $out )
            );
        }
 
        if( $out->get_value('dis_user_type') == 2 )
        {
            $cond = array(
              'success' => $output->_set_row_distribusi_agent( $out )
            );
        }  
        echo json_encode( $cond );*/
        
    }


// =========== END CLASS ===============================================================

}
?>