<?php 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
class EUI_Spiner
{


var $spiner_field_order 	= null;
var $spiner_field_label 	= null;
var $ar_row_source_table 	= array();
var $ar_checkbox_table 		= array();
var $ar_field_width 		= array();
var $ar_field_add_call_back = array();
var $ar_field_add_header 	= array();
var $ar_class_cell_head 	= null;
var $ar_class_row_head		= null; 
var $var_name_table			= null;


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 private static $Instance = null;
 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public static function &Instance(){
	if( is_null(self::$Instance) ){
		self::$Instance = new self();
	} 
	return self::$Instance;
 }
 
function __construct() {
	$this->ar_class_cell_head = "ui-corner-top";
	$this->ar_class_row_head  = "ui-widget-header";

}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function set_reset_spiner_page()
{
	$this->ar_attribute = array ( 
		"ar_field_order"  	=> array(),
		"ar_field_header" 	=> array(),
		"ar_field_class"  	=> array(),
		"ar_field_width"  	=> array(),
		"ar_field_align"  	=> array(),
		"ar_header_align"  	=> array(),
		"ar_checkbox_table" => array(),
		"btn_pager_action"  => null,
		"ar_field_create" 	=> null
	);
	
	foreach( $this->ar_attribute as $key => $val ){
		$this->$key = $val;
	}	
	
	return TRUE;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function set_content_row_table( $arr_source ){
	$this->ar_content_table = $arr_source;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function set_row_debug_field()
{ 
	$out = new EUI_Object( $this->ar_content_table );
	return $out;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function set_row_func_click( $key='', $values='' )
{
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	$this->ar_row_func_click = $key;
	
}
 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function set_total_row_record( $record = 0  ){
	$this->int_total_record = $record;
}

public function set_total_row_page( $page = 0 ){
	$this->int_total_page  = $page;
}

public function set_select_row_page( $page = 0  ){
	$this->int_select_page = $page;
}

public function set_start_row_page( $page = 0  ){
	$this->int_start_page = $page;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public function set_field_header_wrap( $key=NULL, $values = '') 
{
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	foreach( $key as $k => $v ){
		$this->ar_field_header_wrap[$k]= $v;
	}
}
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public function set_field_wrap( $key=NULL, $values = '') 
{
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	foreach( $key as $k => $v ){
		$this->ar_field_wrap[$k]= $v;
	}
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public function set_field_order( $key=NULL, $values = '') 
{
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	$this->ar_field_order  = (array)$key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function set_field_header( $key=NULL, $values = '') 
{
  if( !is_array( $key ) ) {
	$key = array( $key => $values );
  }
  foreach( $key as $k => $v ){
	$this->ar_field_header[$k]= $v;
  }
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

 public function set_field_add_header( $key= NULL, $values = '') 
{
  if( !is_array( $key ) ) {
	$key = array( $key => $values );
  }
  

  $this->ar_field_add_header = $key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function set_field_class( $key= NULL, $values = '' ) 
{
  if( !is_array( $key ) ) {
	$key = array( $key => $values );
  }
   $this->ar_field_class = $key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


public function set_field_width( $key= NULL, $values = '' ) {
	if( !is_array( $key ) ) {
	$key = array( $key => $values );
  }
   $this->ar_field_width = $key;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function set_header_align( $key= NULL, $values = '' ) {
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	
	foreach( $key as $k => $v ){
		$this->ar_header_align[$k]= $v;
	}
}


public function set_field_align( $key= NULL, $values = '' ) {
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	
	foreach( $key as $k => $v ){
		$this->ar_field_align[$k]= $v;
	}
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


public function set_field_add_call_back( $out = null ) 
{
	$out = new EUI_Object( $out );
	$this->ar_field_add_call_back = array( 
		'field' => $out->get_value('field'),
		'callback' => $out->get_value('callback')
	);
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */


public function set_field_call_back( $key= NULL, $values = '' ) {
	if( !is_array( $key ) ) {
		$key = array( $key => $values );
	}
	foreach( $key as $k => $v ){
		$this->ar_field_call_back[$k]= $v;
	}
}




//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

public function set_bottom_left_colspan( $values = 0 ) {
	$this->ar_bottom_left_colspan = $values;
}

public function set_bottom_right_colspan( $values = 0 ) {
	$this->ar_bottom_right_colspan = $values;
}

public  function set_max_adjust( $values = 5 ) {
	$this->ar_max_adjust = $values;
}


public function set_height_row_body( $values = 30 ) {
	$this->int_height_row_body = $values;
}

public function set_height_row_header( $values = 30 ) {
	$this->int_height_row_header = $values;
}

public function set_name_table( $values = '' ) {
	$this->var_name_table = $values;
}

public function set_width_table( $values = 100 ) {
	$this->int_width_table = $values;
}

public function set_func_page_table( $values = "") {

	$this->arr_func_page_table = $values;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function select_name_table(){
	return 	$this->var_name_table;
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public  function select_func_page_table() {
	if( strlen($this->arr_func_page_table) ==0 ){
		return "Spinertable";
	}	
	return (string)$this->arr_func_page_table;
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 /*
	$val = array('field' => 'primary','event' => 'test');
 */

public function set_checkbox_table( $val = null )
{
	if( !is_null($val) ){
		$this->ar_checkbox_table  = $val;
	}
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function select_pager_action() 
{
	if( !is_null($this->btn_pager_action) ){
		return $this->btn_pager_action;
	}
	return null;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function set_pager_action( $ar_button = null ) {
	$this->btn_pager_action = form()->navbar($ar_button);
}
	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

public  function select_width_table() {
	return (int)$this->int_width_table;
}
 
public  function select_height_row_body() {
	return (int)$this->int_height_row_body;
}

public  function select_height_row_header() {
	return (int)$this->int_height_row_header;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function select_checkbox_table()
{
	if( is_array($this->ar_checkbox_table ) 
		and count( $this->ar_checkbox_table) > 0 )
{	
	return Objective( $this->ar_checkbox_table); 
 }
	return null;	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function select_row_func_click()
{
	if( is_array($this->ar_row_func_click ) 
		and count($this->ar_row_func_click) > 0 )
{	
	return Objective($this->ar_row_func_click ); 
 }
	return null;	
}

		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public  function select_field_header() {
	return (array)$this->ar_field_header;
}


public function select_field_add_call_back(){
	if( is_array($this->ar_field_add_call_back) ){ 
		return new EUI_Object( $this->ar_field_add_call_back); 
	}
	return NULL;
}

public  function select_field_add_header() {
	return (array)$this->ar_field_add_header;
}

public function select_content_row_table() {
	return (array)$this->ar_content_table;
}
 
public function select_total_row_record(){
	return (int)$this->int_total_record;
}

public function select_total_row_page(){
	return (int)$this->int_total_page;
}

public function select_select_row_page(){
	return (int)$this->int_select_page;
}


public function select_start_row_page(){
	return  (int)$this->int_start_page;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_field_order_by()
{
 if( !is_array($this->ar_field_order) ){
	return NULL;
 }
 $this->ar_select_order_field_order_by = array_keys($this->ar_field_order);
 return reset($this->ar_select_order_field_order_by);
 
}




//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

public function select_field_order_type()
{
	$order_key = $this->select_field_order_by();
	if( isset( $this->ar_field_order[$order_key] ) ) {
		$this->ar_select_order_field_order_type = $this->ar_field_order[$order_key];
	}
	return $this->ar_select_order_field_order_type;
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

public function select_field_order_style()
{	
	$this->ar_select_order_field_order_style = $this->select_field_order_type();
	return call_user_func('strtolower', $this->ar_select_order_field_order_style);
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
public function select_field_order_next(){
	$this->ar_select_order_field_next = ( $this->select_field_order_type() == 'ASC' ? 'DESC' : 'ASC' );
	return $this->ar_select_order_field_next;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function select_field_row_class( $field = null )
{
	$out = new EUI_Object( $this->ar_field_class );
	if( !$out->find_value( $field ) ){
		return NULL;
	}	
	return $out->get_value( $field );
}
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function select_field_row_width( $field = null )
{
	$out = new EUI_Object( $this->ar_field_width );
	if( !$out->find_value( $field ) ){
		return NULL;
	}	
	return $out->get_value( $field );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function select_field_row_align( $field = null )
{
	$out = Objective( $this->ar_field_align );
	if( !$out->find_value( $field ) ){
		return NULL;
	}	
	return $out->get_value( $field );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function select_field_header_align( $field = null  )
{
	$out = Objective( $this->ar_header_align );
	if( !$out->find_value( $field ) ){
		return NULL;
	}	
	return ( $out->find_value( $field ) ?
			$out->get_value( $field ) : null );
}	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function select_field_row_func( $field = null )
{
	$out = new EUI_Object( $this->ar_field_call_back );
	if( !$out->find_value( $field ) ){
		return NULL;
	}	
	return $out->get_value( $field );
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function set_nowrap_class( $class='' )
{
	$ar_class  = array(
		'wrap' 		=> 'table-white-space-ys-wrap', 'nowrap' 	=> 'table-white-space-no-wrap',
		'yes' 		=> 'table-white-space-ys-wrap', 'no' 		=> 'table-white-space-no-wrap'
	);
	
	if( isset( $ar_class[$class] )  ){
		return $ar_class[$class];
	}
	return $ar_class['wrap'];
} 

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function select_field_row_wrap( $val='' ){
	$ar_wrap = ( isset( $this->ar_field_wrap[$val]) ? $this->ar_field_wrap[$val] : null );
	return self::set_nowrap_class( $ar_wrap );
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function select_field_header_wrap( $val='' ){
	$ar_wrap = ( isset( $this->ar_field_header_wrap[$val]) ? $this->ar_field_header_wrap[$val] : null );
	return self::set_nowrap_class( $ar_wrap );
}



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
public function select_adjust_page() {
	return (int)$this->ar_max_adjust;
}

 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  function select_pager_debug()
{ 
	return $this->set_row_debug_field()->debug_field();
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
protected function _set_header_checkbox_table( $field = null ) 
{
	$this->event = null;
	if( $field->find_value('field') ){
		
		if($field->find_value('event') ){
			$this->event = sprintf( "window.%s('%s');", $field->get_value('event'), $field->get_value('field'));
		}
		
		return sprintf( "<a href=\"javascript:void(0);\" onclick=\"Ext.Cmp('%s').setChecked();%s\" style=\"cursor:pointer;\">". 
						"<i class=\"fa fa-check-square\"></i></a>", $field->get_value('field'), $this->event);					
	}
	return null;
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function set_header_class_cell_head( $class = null ){
	
	if( is_null( $class ) ){
		$this->ar_class_cell_head = "ui-corner-top";
	} else {
		$this->ar_class_cell_head = $class;
	}
} 


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
function set_header_class_row_head( $class = "" ){
	if( is_null( $class ) ){
		$this->ar_class_row_head = "ui-widget-header";
	} else {
		$this->ar_class_row_head = $class;
	}
} 

 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function select_header_class_cell_head(){
	return $this->ar_class_cell_head;
}


 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function select_header_class_row_head(){
	return $this->ar_class_row_head;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function select_spiner_table_header()
{
	
  $this->bl_checkbox_table = $this->select_checkbox_table();	
  $this->ar_spiner_header = $this->select_field_header();
  $this->ar_spiner_add_header = $this->select_field_add_header();
  
  printf("<div id=\"%s\" class=\"%s\" style=\"margin:-1px 0px 0px 0px;width:%s;\">\n", 
		   (is_null($this->var_name_table) ? "ui-content-extends-pager" : $this->var_name_table),
		   sprintf("ui-widget-form-table-compact table-body-content %s", ( is_null($this->var_name_table) == false ? sprintf("%s-headers", $this->var_name_table) : null)),
		   sprintf("%s%s", $this->select_width_table(), "%"));

 $arr_class_row_head = self::select_header_class_row_head();
 $arr_class_cell_head = self::select_header_class_cell_head();
 
 printf("<div class=\"%s\">\n", sprintf( "table-row-extend %s table-row-header",  $arr_class_row_head));
	
  
  if( !is_null( $this->bl_checkbox_table ) 
	  and is_object($this->bl_checkbox_table) )
  {
	printf("<div class='table-cell-header-extend %s table-cell-header center'>%s</div>", $arr_class_cell_head, $this->_set_header_checkbox_table( $this->bl_checkbox_table ));
	}
  
printf("<div class='table-cell-header-extend %s table-cell-header center'>%s</div>", $arr_class_cell_head, lang("GM_Label_No"));
  		
// ---------- set header ------------------------------------------------------
  
   if(is_array( $this->ar_spiner_header ) )
		foreach(  $this->ar_spiner_header as $key => $val )
	{
		//var_dump( $key);
		$this->ar_hlign = $this->select_field_header_align($key);
		$this->ar_align = $this->select_field_row_align($key);
		
		
		$this->ar_align = (!is_null($this->ar_hlign) ? $this->ar_hlign : $this->ar_align);
		$this->ar_width = $this->select_field_row_width($key);
		$this->ar_funct = $this->select_func_page_table();
		$this->ar_wrap  = $this->select_field_header_wrap($key);
		//var_dump( $this->ar_wrap );
		
		$this->ar_value = $val;
		$this->ar_field = $key;
		$this->ar_page 	= 0;
		
		
		if( in_array( $this->select_field_order_by(), array($key) )) 
		{
			$this->ar_ostyl = $this->select_field_order_style();
			$this->ar_next	= $this->select_field_order_next();
			printf("<div class='table-cell-header-extend %s table-cell-header %s'>
				<span class=\"ui-widget-tooltip header_order %s $this->ar_wrap\" ui-extend-title=\"Sort By %s\" onclick=\"new %s({page:'%s',  orderby:'%s', type:'%s'});\">%s
				</span></div>", 
				$arr_class_cell_head,
				(!is_null($this->ar_align) ? $this->ar_align : "left"),
				$this->ar_ostyl,
				$this->ar_value,
				$this->ar_funct,
				$this->ar_page,
				$this->ar_field,
				$this->ar_next,
				$this->ar_value
			);
			
			
		} 
		else {
			$this->ar_ostyl = NULL;
			$this->ar_next	= $this->select_field_order_next();
			printf("<div class='table-cell-header-extend %s table-cell-header %s'>
				<span class=\"ui-widget-tooltip header_order %s $this->ar_wrap\" ui-extend-title=\"Sort By %s\"  onclick=\"new %s({page:'%s',  orderby:'%s', type:'%s'});\">%s</span></div>", 
				$arr_class_cell_head,
				(!is_null($this->ar_align) ? $this->ar_align : "left"),
				$this->ar_ostyl,
				$this->ar_value,
				$this->ar_funct,
				$this->ar_page,
				$this->ar_field,
				$this->ar_next,
				$this->ar_value
			);
			
		}
	}
	
// ---------- set additional ------------------------------
	$num_field = count($this->ar_spiner_add_header);
	
	if( is_array($this->ar_spiner_add_header) AND  $num_field > 0 ) 
		foreach( $this->ar_spiner_add_header as $key => $val ) {		
			printf("<div class='table-cell-header-extend %s table-cell-header %s'>%s</div>",$arr_class_cell_head, "left",$val );
	}
	
	printf( "</div>" );
	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 public function select_spiner_table_body()
{	
	if( !is_array( $this->select_content_row_table()  ) )  { 
		printf("", null);
	}
	
	$obChek = $this->select_checkbox_table();
	$obCall = $this->select_field_add_call_back();
	$obClik = $this->select_row_func_click();
	
	$this->no = $this->select_start_row_page() + 1;
	foreach( $this->select_content_row_table() as $num => $rows )
	{
		$row = new EUI_Object( $rows );
		$this->back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
		$color = ( ( $num %2 == 0 ) ? "table-cell-selcted-one" : "table-cell-selcted-two" );
		
		$ar_row_click = null;
		if( is_object($obClik) && $obClik->find_value('event') ){
			
			if( !$obClik->find_value('type')){
				$ar_row_click = sprintf("onClick=\"window.%s('%s');\" style=\"cursor:pointer;\" ", $obClik->get_value('event'),$row->get_value($obClik->get_value('field')));
			} 
			else {
				
				$this->jsn = array(); $this->scl = $obClik->field('field');
				if( IsCount($this->scl) ) 
				foreach( $this->scl as $key => $val ) {	
					$this->jsn[] = sprintf("%s:'%s'", $key, $row->field( $val, 'strtoupper'));
				}
				$ar_row_click = sprintf("onClick=\"window.%s(%s);\" title=\"select row for open to chat\" style=\"cursor:pointer;\"", $obClik->get_value('event'), sprintf("{%s}", join(",", $this->jsn)) );
			}
		}
		
		printf("<div class=\"table-row-extend ui-extend-pager-row-%s %s onselect\" $ar_row_click>\n",$num, $color);
		
		if( !is_null($obChek)  and is_object($obChek) )
		{
			$this->arr_value = null;
			if( $obChek->find_value('field') ){
				$this->arr_value = $obChek->get_value('field');
			}
			
			$this->event = null;
			if( $obChek->find_value('event') ){
				$this->event = array("click" => sprintf( "window.%s('%s');", $obChek->get_value('event'), $obChek->get_value('field')));
			}
			$this->Primary = $obChek->get_value('field');
			printf( "\t<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", form()->checkbox($this->Primary, NULL, $row->get_value($this->Primary), $this->event));	
			
		}
		
		printf("\t<div class=\"table-cell-content-extend table-cell-content center\">%s</div>\n", $this->no);
		 
		
		// ----------- convert content - ------------------ :)	
		
		$this->ar_spiner_header = $this->select_field_header();
		$num_add_field = count($this->ar_spiner_add_header);
		$num_xls_val = count($this->ar_spiner_header);
		
		$num_xls_val = ($num_xls_val+$num_add_field);
		$num = 1;
		foreach( array_keys( $this->ar_spiner_header ) as $key => $val )
		{
			if( $num_xls_val != $num ){
				$class_row_xls_val = $this->select_field_row_class($val);
			} else {
				$class_row_xls_val = "content-lasted";
			}
			
			$align_row_xls_val = $this->select_field_row_align($val);
			$wrap_row_xls_val  = $this->select_field_row_wrap($val);
			$value_row_xls_val = $row->get_value($val, $this->select_field_row_func($val));
			$value_row_cel_val = ( is_array($value_row_xls_val) ? ( $row->get_value($val)?$row->get_value($val) : '-' ) : $value_row_xls_val );
			
			if( strcmp( $val, $this->select_field_order_by() ) == 0 ) {
				printf("\t<div class=\"ui-widget-select-order table-cell-content-extend table-cell-content %s %s\">%s</div>",$align_row_xls_val, $wrap_row_xls_val, $value_row_cel_val);
			 } else{
				printf("\t<div class=\"ui-widget-unselect-order table-cell-content-extend table-cell-content %s %s\">%s</div>", $align_row_xls_val, $wrap_row_xls_val, $value_row_cel_val);
			}
			
		   $num++;
		}
		 
		 
		// ---------- additional 
		 if( is_array($this->ar_spiner_add_header ) 
			AND $num_add_field > 0)
		 { 
			$num = $num;
			
			foreach( $this->ar_spiner_add_header as $key => $label )
			{
				if( $num_xls_val != $num ){
					$class_row_xls_val = "content-middle";
				} else {
					$class_row_xls_val = "content-lasted";
				}
				
				if( is_object($obCall) ){
					$spiner_call_back = ( function_exists($obCall->get_value('callback')) ? call_user_func_array($obCall->get_value('callback'), array($key, $row->get_value($obCall->get_value('field'))) ) : null );
					printf("\t<div class=\"%s table-cell-content-extend table-cell-content center\">%s</div>",$class_row_xls_val, $spiner_call_back);
				}	
				$num++;
			}
			
		 }	
		print("</div>");
		$this->no++;	
	 }	


}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function select_spiner_table_bottom()
{
	$this->max_page  	= $this->select_adjust_page();
	$this->select_page  = $this->select_select_row_page();
	$this->total_page 	= $this->select_total_row_page();
	$this->total_record = $this->select_total_row_record();
	$this->ar_funct 	= $this->select_func_page_table();
	
	
	print("</div>");
	 
	$this->ar_field_create .= " <div class='page-web-voice' style='margin-left:-7px;margin-top:0px;border-top:0px solid #FFFEEE;'><ul>";
	
	$this->start =(int)( $this->select_page==0 ? 1 : ((($this->select_page%$this->max_page == 0 ) ? ($this->select_page/$this->max_page) : intval($this->select_page/$this->max_page)+1)-1)*$this->max_page+1);
	$this->end   =(int)((($this->start+$this->max_page-1)<=$this->total_page) ? ($this->start+$this->max_page-1) : $this->total_page );
		
	// @ pack : like here 

	 if( $this->select_page > 1) 
	 {
		$this->post = (int)(($this->select_page )-1);
		$this->ar_field_create .= sprintf("<li class=\"page-web-voice-normal\" onClick=\"new %s({page:'%s', orderby:'%s', type:'%s'});\" ><a href=\"javascript:void(0);\">
			<i class=\"fa fa-fast-backward\" aria-hidden=\"true\"></i></a></li>", $this->ar_funct, 1, $this->select_field_order_by(), $this->select_field_order_type());
		$this->ar_field_create .= sprintf("<li class=\"page-web-voice-normal\" onClick=\"new %s({page:'%s', orderby:'%s', type:'%s'});\" ><a href=\"javascript:void(0);\">
			<i class=\"fa fa-step-backward\" aria-hidden=\"true\"></i> </a></li>", $this->ar_funct, $this->post, $this->select_field_order_by(), $this->select_field_order_type());
	 }
	 
	// @ pack : check its 

	 if( $this->start > $this->max_page ){
		$this->ar_field_create .= sprintf("<li class=\"page-web-voice-normal\"  onClick=\"new %s({page:'%s', orderby :'%s', type:'%s'});\" ><a href=\"javascript:void(0);\">...</a></li>", $this->ar_funct, ($this->start-1), $this->select_field_order_by(), $this->select_field_order_type() );
	 }

	// @ pack : check its 
	 
	 for( $p = $this->start; $p<= $this->end; $p++)
	 { 
		if( $p == $this->select_page ) { 
			$this->ar_field_create .= sprintf("<li class=\"page-web-voice-current\" id=\"%s\" onClick=\"new %s({page:'%s', orderby :'%s', type:'%s'});\" ><a href=\"javascript:void(0);\">%s</a></li>", $p, $this->ar_funct, $p, $this->select_field_order_by(), $this->select_field_order_type(), $p);
		} 
		else {
			$this->ar_field_create .= sprintf("<li cclass=\"page-web-voice-normal\" id=\"%s\" onClick=\"new %s({page:'%s', orderby :'%s', type:'%s'});\" ><a href=\"javascript:void(0);\">%s</a></li>", $p, $this->ar_funct, $p, $this->select_field_order_by(), $this->select_field_order_type(), $p);
		}
	 }

	// @ pack : check its 
	 if( $this->end < $this->total_page ){
		$this->end = ($this->end+$this->max_page);
		$this->ar_field_create .= sprintf( "<li class=\"page-web-voice-normal\" onClick=\"new %s({page:'%s', orderby :'%s', type:'%s'});\"><a href=\"javascript:void(0);\" >...</a></li>", 
									   $this->ar_funct, $this->end, $this->select_field_order_by(), $this->select_field_order_type() );
									  
	 }

	// @ pack : check its 
	 
	 if( $this->select_page < $this->total_page )
	 {
		$this->ar_field_create .= sprintf("<li class=\"page-web-voice-normal\" onClick=\"new %s({page:%d,  orderby :'%s', type:'%s'});\">
									  <a href=\"javascript:void(0);\" title=\"Next page\"><i class=\"fa fa-step-forward\" aria-hidden=\"true\"></i></a></li>",
									 $this->ar_funct, ($this->select_page+1), $this->select_field_order_by(), $this->select_field_order_type() );
										
		$this->ar_field_create .= sprintf("<li class=\"page-web-voice-normal\" onClick=\"new %s({page:%s,orderby :'%s', type:'%s'});\">
									 <a href=\"javascript:void(0);\" title=\"Last page\"><i class=\"fa fa-fast-forward\" aria-hidden=\"true\"></i></a></li>",
									 $this->ar_funct, $this->total_page , $this->select_field_order_by(), $this->select_field_order_type() );
	 }
			
	// @ pack : check its 
		
	 $this->ar_field_create .= "</ul></div>";
	 
//$this->set_action_pager();

	
	 printf("<div class='ui-widget-form-table' id=\"%s\" style='margin:-3px 0px 0px 0px;padding-left:2px;'>
				<div class='ui-widget-form-cell' style='margin-left:1px;'>%s</div>
				<div class='ui-widget-form-cell'></div>
				<div class='ui-widget-form-cell' style='padding-left:10px;'>%s&nbsp;:<span class='input_text' style='padding:2px;' id='ui-total-%s-record'>%s</span></div>
				<div class='ui-widget-form-cell' style='padding-left:30px;'>%s</div>
				
	 </div>",  
		( is_null( $this->var_name_table ) ? "ui-content-extends-pager-bottom" : sprintf("%s-bottom", $this->var_name_table)),  
		$this->ar_field_create, 
		lang('GM_Label_Record'), 
		$this->select_name_table(), 
		$this->total_record,
		$this->select_pager_action()
		);
	 		
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function select_spiner_table_page()
{
  $this->select_spiner_table_header();
  $this->select_spiner_table_body();
  $this->select_spiner_table_bottom();
  $this->set_reset_spiner_page();
  
}

// ================================== END CLASS ==================================
	
} 