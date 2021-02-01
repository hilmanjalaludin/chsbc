<?php
class SrcAppoinmentFlexi extends EUI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_SrcAppoinmentFlexi');
        $this->load->helper(array('EUI_Object'));
    }


    function index()
    {
        if( $this ->EUI_Session ->_have_get_session('UserId') )
        {
            $_EUI  = array('page' => $this->M_SrcAppoinmentFlexi->_get_default());
            if( is_array($_EUI))
            {
                $this->load->view('src_appointment_list_flexi/view_appoinment_nav',$_EUI);
            }
        }   
    }
 
    function Content()
    {
        if( $this -> EUI_Session -> _have_get_session('UserId') )
        {
            $_EUI['page'] = $this->M_SrcAppoinmentFlexi->_get_resource();    // load content data by pages 
            $_EUI['num']  = $this->M_SrcAppoinmentFlexi->_get_page_number(); // load content data by pages 
            
            // sent to view data        
            if( is_array($_EUI) && is_object($_EUI['page']) )  
            {
                $this->load->view('src_appointment_list_flexi/view_appoinment_list',$_EUI);
            }   
        }   
    }
 

    public function Update()
    {
        $callback = array('success' => 0);
        if(_get_have_post('AppoinmentId') )
        {
            $this->db->set('ApoinmentFlag', 1);
            $this->db->where('AppoinmentId', _get_post('AppoinmentId') , FALSE);
            $this->db->where('UserId',_get_session('UserId') , FALSE);
            
            if( $this->db->update('t_gn_appoinment') )
            {
                $this->db->reset_write();
                $this->db->select("CustomerId", FALSE);
                $this->db->from("t_gn_appoinment");
                $this->db->where("AppoinmentId", _get_post('AppoinmentId'));
                
                $rs = $this->db->get();
                if( $rs->num_rows() > 0 ){
                    $CustomerId = $rs->result_singgle_value();
                }
                $callback = array( 'success' => 1,  'CustomerId' => $CustomerId );
            }
        }
        echo json_encode( $callback );
    } 

    public function UpdateNew()
    {
        $callback = array('success' => 0);
        if(_get_have_post('AppoinmentId') )
        {
            $this->db->set('ApoinmentFlag', 1);
            $this->db->where('AppoinmentId', _get_post('AppoinmentId') , FALSE);
            $this->db->where('UserId',_get_session('UserId') , FALSE);
            $res = $this->db->update('t_gn_appoinment');
            #var_dump( $this->db->last_query() ); die();
            if( $res )
            {
                $this->db->reset_write();
                $this->db->select("cs.CustomerId", FALSE);
                $this->db->from("t_gn_customer a");
                $this->db->join("t_gn_appoinment ap","a.CustomerId=ap.CustomerId","INNER");
                $this->db->join("t_gn_customer cs","a.CustomerNumber=cs.CustomerNumber AND cs.CampaignId=5 AND cs.expired_date >= convert(varchar, getdate(), 23)","INNER");
                $this->db->where('ap.AppoinmentId', _get_post('AppoinmentId'));
                $this->db->limit(1);
                $rs = $this->db->get();
                #var_dump( $this->db->last_query() ); die();
                if( $rs->num_rows() > 0 ){
                    $CustomerId = $rs->row_array();
                }
                $callback = array( 'success' => 1,  'CustomerId' => $CustomerId["CustomerId"] );
            }
        }
        echo json_encode( $callback );
    }   
 
}
?>