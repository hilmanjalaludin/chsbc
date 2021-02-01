<?php
/*
 * E.U.I
 *

 * subject    : Set lock customer modul
 *               extends under EUI_Controller class
 */
class MgtLockCustomer extends EUI_Controller
{

    /*
     * @def : QualityAssignment aksesor
     * ----------------------------------
     *
     * @param : -
     * @param : -
     */
    private $limit_default_page = 10;
    private static $view_layout = null;
    private $filter_by = "";

    /*
     * @def : QualityAssignment aksesor
     * ----------------------------------
     *
     * @param : -
     * @param : -
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(base_class_model($this), 'M_SysUser'));
        $this->load->helper(array('EUI_Object'));

        if (is_null(self::$view_layout)) {
            self::$view_layout = "mgt_lock_customer";
        }
    }

/*
 * @def : getViewLayout
 * ----------------------------------
 *
 * @param : Unit Test
 * @param : Unit Test
 */
    public function ViewLayout()
    {
        return self::$view_layout;
    }

/*
 * @def : default page
 * ----------------------------------
 *
 * @param : Unit Test
 * @param : Unit Test
 */
    public function index()
    {
        if ($this->EUI_Session->_have_get_session('UserId') and class_exists(base_class_model($this))) {
            $lock_type = $this->{base_class_model($this)}->_getLockType();
            $UI['agent_list'] = $this->M_SysUser->_getUserLevelGroup(array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND), 1);
            $UI['lock_type'] = $lock_type['combo'];
            $this->load->view("{$this->ViewLayout()}/view_panel_lock", $UI);
        }
    }

    public function getParamForm()
    {
        $out = new EUI_Object(_get_all_request());
        $choice = $out->get_value('lock_type');
        $lock_type = $this->{base_class_model($this)}->_getLockType();

        $this->filter_by = $out->get_value('filter_by');

        // $lock_type['call_func'][$choice] = LockParamRecsource
        if (isset($lock_type['call_func'][$choice]) && method_exists($this, $lock_type['call_func'][$choice])) {
            $this->$lock_type['call_func'][$choice]();
        }
    }

    private function LockParamRecsource()
    {
        echo '<div class="ui-widget-form-cell text_caption">' . lang("Recsource") . '</div>
            <div class="ui-widget-form-cell text_caption">:</div>
            <div class="ui-widget-form-cell">' .
        form()->listCombo("lock_recsource", "select tolong", $this->{base_class_model($this)}->_getUserRecsource(_get_array_post('user_id'), $this->filter_by),
            null, null, array("height" => "200px", "dwidth" => "100%")) .
            '</div>';
    }

    private function LockTwoParam()
    {

       echo '<div class="ui-widget-form-row" style="display:table !important"><div class="ui-widget-form-cell text_caption">'.lang("Recsource").'</div>
            <div class="ui-widget-form-cell text_caption">:</div>
            <div class="ui-widget-form-cell">'.
            form()->listCombo("lock_two_param","select tolong", $this->{base_class_model($this)}->_getUserRecsource(_get_array_post('user_id'), $this->filter_by),
             null,null, array("height" => "200px","dwidth" => "100%")).
            '</div>
           </div>

            <div class="ui-widget-form-row" style="display:table !important"><div       class="ui-widget-form-cell text_caption">'.lang("Call Result").'</div>
                <div class="ui-widget-form-cell text_caption">:</div>
                <div class="ui-widget-form-cell">'.
                form()->listCombo("lock_two_call_result_id","select tolong", CallResultNotInterestBadlead(), null, null, array("height" => "200px","dwidth" => "100%")).
            '</div></div>';

        //  echo '<div class="ui-widget-form-cell text_caption">'.lang("Call Result").'</div>
        //         <div class="ui-widget-form-cell text_caption">:</div>
        //         <div class="ui-widget-form-cell">'.
        //         form()->listCombo("lock_call_result_id","select tolong", CallResultNotInterestBadlead(), null, null, array("height" => "200px","dwidth" => "100%")).
        //         '</div>';

        //  echo '<div class="ui-widget-form-cell text_caption">'.lang("Recsource").'</div>
        //         <div class="ui-widget-form-cell text_caption">:</div>
        //         <div class="ui-widget-form-cell">'.
        //         form()->listCombo("lock_recsource","select tolong", $this->{base_class_model($this)}->_getUserRecsource(_get_array_post('user_id'), $this->filter_by),
        //           null,null, array("height" => "200px","dwidth" => "100%")).
        //         '</div>';

    }

    private function LockParamCallreason()
    {
        echo '<div class="ui-widget-form-cell text_caption">' . lang("Call Result") . '</div>
            <div class="ui-widget-form-cell text_caption">:</div>
            <div class="ui-widget-form-cell">' .
        form()->listCombo("lock_call_result_id", "select tolong", CallResultNotInterestBadlead(), null, null, array("height" => "200px", "dwidth" => "100%")) .
            '</div>';

    }

    public function LockNow()
    {
        $cond = array('success' => 0);
        if (!_have_get_session('UserId')) {
            echo json_encode($cond);
            return false;
        }

        $out = new EUI_Object(_get_all_request());
        //  print_r($out);
        /*
         *  [lock_recsource] => yuuuuuu
        [lock_user_list] => 16
        [cmb_lock_type] => 1
         */
        //--------------- checj parameter ------------------------

        if (!$out->fetch_ready()) {
            echo json_encode($cond);
            return false;
        }

        $cond['success'] = $this->{base_class_model($this)}->setLockNow($out);
        echo json_encode($cond);
    }

    public function UnlockNow()
    {
        $cond = array('success' => 0);

        if (!_have_get_session('UserId')) {
            echo json_encode($cond);
            return false;
        }

        $out = new EUI_Object(_get_all_request());
        //--------------- checj parameter ------------------------

        if (!$out->fetch_ready()) {
            echo json_encode($cond);
            return false;
        }

        $cond['success'] = $this->{base_class_model($this)}->_unlockNow($out);

        echo json_encode($cond);
    }

// ---------------------------------------------------------------------------------------------------------------
    /*
     * @ package         view data on distribute part
     *
     */
    public function PageLockFilter()
    {
        $this->start_page = 0;
        $this->per_page = 10;

        // ---------- customize page data ------------------------
        //   if( _get_have_post('dis_record_page') ){
        //       $this->per_page = _get_post('dis_record_page');
        // }
        // ------------- then result data ---------------------------------

        $this->post_page = (int) _get_post('page');
        $this->arr_result = array();
        $this->arr_content = $this->{base_class_model($this)}->_select_page_lock(new EUI_Object(_get_all_request()));
        $this->tot_result = count($this->arr_content);

        if ($this->post_page) {
            $this->start_page = (($this->post_page - 1) * $this->per_page);
        } else {
            $this->start_page = 0;
        }
        // @ pack : set result on array
        if ((is_array($this->arr_result)) and ($this->tot_result > 0)) {
            $this->arr_result = array_slice($this->arr_content, $this->start_page, $this->per_page);
        }
        $this->page_counter = ceil($this->tot_result / $this->per_page);

        // @ pack : then set it to view
        $arr_page_address = array
            (
            'content_pages' => $this->arr_result,
            'total_records' => $this->tot_result,
            'total_pages' => $this->page_counter,
            'select_pages' => $this->post_page,
            'start_page' => $this->start_page,
        );
        // var_dump($arr_page_address);
        $this->load->view("{$this->ViewLayout()}/view_lock_page", $arr_page_address);

    }

}
//End od class
