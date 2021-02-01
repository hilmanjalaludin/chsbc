<?php
/*
 * E.U.I generator form on helper 
 
 * author 	 razaki team 
 * lincese	 under concept 
 * link 	 http://www.razakitechnology.com/eui/helper 
 */

 /* 
	tambahin extra oncopy && onpaste
 */
 
class EUI_Form  
{

/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
private static $Instance;
 
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */
 
var $_extra;

/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */ 
 
protected $_event;
 
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */ 
protected $_javascript;
 
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */ 
 private function __construct()
 {
	$this -> _extra = array('multiple'=>'multiple', 'selected'=>'selected','checked'=>'checked','length'=>'maxlength', 'disabled'=>'disabled','style'=>'style', 'readonly'=> 'readonly','label'=>'','copy'=>'oncopy','paste'=>'onpaste');
	$this -> _event = array('click'=> 'onClick', 'keyup'=>'onKeyup', 'change'=>'onChange' );
	
	$this -> _style = array(
		array('_file' => base_layout_style().'/styles.cores.css', 'eui_' => version(), 'time' => time()),
	);
	
	// --- javascript includer -----------------------------	
	$this->_javascript = array(
		array('_file' => join("/", array(base_spl_plugin(),'extToolbars.js')), 'eui_'=>'1.0.0', 'time'=>time()),
		array('_file' => join("/", array(base_spl_plugin(),'Paging.js')), 'eui_'=>'1.0.0', 'time'=>time())
	);
}
 
/*
 ^ @ def		_get_content_filename
 *
 * @ package 	 helper
 * @ params 	 Content line write
 */ 
 
 public static function &get_instance()
 {
	if( is_null( self::$Instance ) ) 
	{
		self::$Instance = new self();
	}
	return self::$Instance;
 }
 
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 
 public function _get_javascript( $_javascript=null )
 {
	$_compile = '';
	
	if( !is_null( $_javascript) )  
		$this -> _javascript = $_javascript;
		
	foreach( $this -> _javascript as $_k_java => $_k_value )
	{
		$_compile.= "<script type=\"text/javascript\"  src=\"".$_k_value['_file']."?version=".$_k_value['eui_']."&time=".$_k_value['time']."\"></script>\n";
	}	
	
	return $_compile;
 }
 
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 public function _get_styles( $styles = null )
 {
	$_compile = '';
	
	if( !is_null( $styles ))  
		$this -> _style = $styles;

	foreach( $this -> _style as $_k_style => $_k_value )
	{
		$_compile.= "<link type=\"text/css\" rel=\"stylesheet\" href=\"".$_k_value['_file']."?ver=".$_k_value['eui_'] ."&time=". $_k_value['time'] ."\">\n";
	}	
	
	return $_compile;
 }
  
  
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('select'=>'selected', 'length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 private function _extra( $_extra=null )
 {
	$_compile = '';
	if( is_array($_extra) !=FALSE ) 
	{
		
		foreach( $_extra as $_exist_keys => $_exist_value ) 
		{
			if( isset($this -> _extra[$_exist_keys]) 
				AND  ($this -> _extra[$_exist_keys]!='') )
			{
				if( $_exist_keys!='label')
				{
					$_compile.= " {$this -> _extra[$_exist_keys]}=\"{$_exist_value}\" ";
				}
			}
		}
	}
	
	return $_compile;
 }
 
 /*
 * E.U.I test data 
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 private function _events( $_events=null )
 {
	$_compile = '';
	
	if( is_array( $_events )!=FALSE ) 
	{
		foreach( $_events as $_exist_keys => $_exist_value ) 
		{
			if( isset($this -> _event[$_exist_keys]) 
				AND $this -> _event[$_exist_keys] !=FALSE && isset($this -> _event[$_exist_keys]))
			{
				$_compile.= " {$this -> _event[$_exist_keys]}=\"{$_exist_value}\" ";
			}
		}
	}	
	
	return $_compile;
	
 }
 
/*
 * E.U.I  input type text
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 
function input( $_name=null, $_style=null, $_value=null, $_events=array(), $_extra=array() )
{
	
	$_compile = " <input type=\"text\" name=\"$_name\" id=\"$_name\" class=\"$_style\" value=\"$_value\" ";
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	$_compile.= "/>";
	return $_compile;
}

/*
 * E.U.I  input type hidden
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
  
function hidden( $_name='', $_style='', $_value ='', $_events = array(), $_extra = array() )
{
	$_compile = " <input type=\"hidden\" name=\"$_name\" id=\"$_name\" class=\"$_style\" value=\"$_value\" ";
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	$_compile.= "/>";
	
	return $_compile;
}		

/*
 * E.U.I  input type password
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
  
function password( $_name='', $_style='', $_value ='', $_events = array(), $_extra = array() )
{
	$_compile = " <input type=\"password\" name=\"$_name\" id=\"$_name\" class=\"$_style\" value=\"$_value\" ";
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	$_compile.= "/>";
	
	return $_compile;
}		
 
/*
 * E.U.I  input type password
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
  
public function button( $_name='', $_style='', $_value ='', $_events = array(), $_extra = array() )
{
	$_compile = " <input type=\"button\" name=\"$_name\" id=\"$_name\" value=\"$_value\" ";
	$_compile.= ( !is_null($_style)?"class=\"$_style\"":"" );
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	$_compile.= "/>";
	
	return $_compile;
 }	
 
 
 // --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
public function chooseall( $_name='', $_style=null, $_data= array(), $_value=null, $_events = array(), $_extra = array() )
{

	$_compile = " <select type=\"combo\" name=\"$_name\" id=\"$_name\" class=\"$_style\" ";
	
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
	
	$_compile.= " >";
	
	if( is_array($_data)!=FALSE )
	{
		if( !isset($_extra['multiple']) ){
			$_compile .= "<option value=\"all\"> --ALL --</option>";
		}
		
		 if( is_array($_value) AND count($_value)!=0  )
		{
			if( !isset($_extra['multiple']) ){
				$_value = array_keys(reset($_value));	
			} else{
				$_value = array_keys($_value);
			}	
		} 
		else
		{
			// NULL NOT empty 
			if( !is_null($_value) AND strlen($_value)>0 ){
				$_value = array($_value);
			}			
		}
		//var_dump($_value);
		foreach( $_data as $_option_value => $_option_select )
		{
			if( !is_array($_value) AND strlen($_value) >0 
				AND ( in_array( $_option_value, $_value) ) 
				AND !is_null($_value) )
			{
				
				$_compile.= "<option value=\"{$_option_value}\" selected >{$_option_select}</option>";
			
			}
			else if( is_array($_value) AND count($_value) >0
				AND ( in_array( $_option_value, $_value) ) 
				AND !is_null($_value) )
			{	
				$_compile.= "<option value=\"{$_option_value}\" selected >{$_option_select}</option>";
			}	
			else {
				$_compile.= "<option value=\"{$_option_value}\">{$_option_select}</option>";
			}
		}
	}
	
	$_compile.= "</select>";
	
	return $_compile;
}
/*
 * E.U.I  ListCheckbox
 
 * @ name 	: strict
 * @ style 	: css class
 * @ events : javascript  = array( 'click'=>'', 'change' => '', 'keyup' => '', etc);
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 // $exlude = array('name'=> , 'code' => , 'type' => '', 'class' => '', 'value' )
 
 public function DropListBox( $name='', $data = array(), $select = array(), $event = null, $exlude = array() )  
{
	
	$arr_list_check = array();
	$arr_list_divs = array();
	if( is_array($data) and count($data) ) 
		foreach( $data as $value => $label )
	{
		if( isset($exlude['code']) AND $value == $exlude['code'] ){
			
			$ar_checked = null;
			if( @in_array($value, $select) ){ 
				$ar_checked = array('checked' => true, 'disabled' => true); 
			}	
			$arr_list_check[] ="\n<li>". $this->checkbox($name,null, $value, $event, $ar_checked ) ."<span class='ui-widget-label-span'>{$label}</span></li>\n";
		} 
		else {
			$ar_checked = null;
			if( @in_array($value, $select) ){ 
			
				$ar_checked = array('checked' => true, 'disabled' => true); 
			}
			
			$arr_list_check[] ="\n<li>". $this->checkbox($name, null, $value, $event, $ar_checked ) ."<span class='ui-widget-label-span'>{$label}</span></li>\n";
		}
		
		
		
		 if( is_array($exlude) and isset($exlude['code']) )
		{
			if( $value == $exlude['code'] ){
				$arr_name_check = array($name, $exlude['code']);
				$arr_list_divs[] = $this->{$exlude['type']}(join("",$arr_name_check), $exlude['class'], $exlude['value'], null, array('disabled' => true));
			}
		}	
	}
	
	$arr_list = array_chunk($arr_list_check, 4, true);
	$arr_pval = array();
	foreach($arr_list as $k => $vals ){
		$arr_pval[] = join("", $vals);
	}	
	$arr_join_check = join("",$arr_pval);
	return 	"<ul class=\"ui-widget-drop-box-list\">". join("",array($arr_join_check, join("", $arr_list_divs)))."</ul>";
} 
/*
 * E.U.I  ListCheckbox
 
 * @ name 	: strict
 * @ style 	: css class
 * @ events : javascript  = array( 'click'=>'', 'change' => '', 'keyup' => '', etc);
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 // $exlude = array('name'=> , 'code' => , 'type' => '', 'class' => '', 'value' )
 
 public function ListCheckbox( $name='', $data = array(), $select = array(), $event = null, $exlude = array() )  
{
	
	$arr_list_check = array();
	$arr_list_divs = array();
	if( is_array($data) and count($data) ) 
		foreach( $data as $value => $label )
	{
		if( isset($exlude['code']) AND $value == $exlude['code'] ){
			
			$ar_checked = null;
			if( @in_array($value, $select) ){ 
				$ar_checked = array('checked' => true, 'disabled' => true); 
			}	
			$arr_list_check[] ="\n". $this->checkbox($name,null, $value, $event, $ar_checked ) ."<span class='ui-widget-label-span'>{$label}</span>&nbsp;\n";
		} 
		else {
			$ar_checked = null;
			if( @in_array($value, $select) ){ 
			
				$ar_checked = array('checked' => true, 'disabled' => true); 
			}
			
			$arr_list_check[] ="\n". $this->checkbox($name, null, $value, $event, $ar_checked ) ."<span class='ui-widget-label-span'>{$label}</span>&nbsp;\n";
		}
		
		
		
		 if( is_array($exlude) and isset($exlude['code']) )
		{
			if( $value == $exlude['code'] ){
				$arr_name_check = array($name, $exlude['code']);
				$arr_list_divs[] = $this->{$exlude['type']}(join("",$arr_name_check), $exlude['class'], $exlude['value'], null, array('disabled' => true));
			}
		}	
	}
	
	$arr_list = array_chunk($arr_list_check, 4, true);
	$arr_pval = array();
	foreach($arr_list as $k => $vals ){
		$arr_pval[] = join("", $vals);
	}	
	$arr_join_check = join("<br>",$arr_pval);
	return 	join("<br>",array($arr_join_check, join("", $arr_list_divs)));
} 

/*
 * E.U.I  input type radio
 
 * @ name 	: strict
 * @ style 	: css class
 * @ events : javascript  = array( 'click'=>'', 'change' => '', 'keyup' => '', etc);
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 
 public function radio( $_name='', $_style='', $_value ='', $_events = array(), $_extra = array() )
 {
	$_compile = " <input type=\"radio\" name=\"$_name\" id=\"$_name\" value=\"$_value\" ";
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	$_compile.= "/> ";
	
	if( isset($_extra['label']) ){
		$_compile .=$_extra['label'];
	}	
		
	return $_compile;
}
		
/*
 * E.U.I  input type password
 
 * @ name 	: strict
 * @ style 	: css class
 * @ js 	: javascript 
 * @ extra  : array('length'=> '', 'disabled' => true, 'style => ''); 
 */
 
public function checkbox( $_name='', $_style='', $_value ='', $_events = array(), $_extra = array()  )
{
	
	
	$_compile = " <input type=\"checkbox\" class=\"$_style\" name=\"$_name\" id=\"$_name\" value=\"$_value\" ";
	
	if( is_array( $_extra ) !=FALSE )  {
		$_compile .= self::_extra( $_extra );
	}
	
	if( is_array( $_events )!=FALSE )  {
		$_compile .= self::_events( $_events );
	}
	
	$_compile.= "/>";
	
	if( is_array( $_extra ) AND  (isset($_extra['label']) ) ){
		$_compile.=" ". $_extra['label']; 	
	}
	
	return $_compile;
 }
 
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 public function combo( $_name='', $_style=null, $_data= array(), $_value=null, $_events = array(), $_extra = array() )
{

	$_compile = " <select type=\"combo\" name=\"$_name\" id=\"$_name\" class=\"$_style\" ";
	
	if( is_array( $_events )!=FALSE )  
		$_compile .= self::_events( $_events );
	
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
	
	$_compile.= " >";
	
	if( is_array($_data)!=FALSE )
	{
		if( !isset($_extra['multiple']) ){
			$_compile .= "<option value=\"\"> --choose --</option>";
		}
		
		 if( is_array($_value) AND count($_value)!=0  )
		{
			if( !isset($_extra['multiple']) ){
				$_value = array_keys(reset($_value));	
			} else{
				$_value = array_keys($_value);
			}	
		} 
		else
		{
			// NULL NOT empty 
			if( !is_null($_value) AND strlen($_value)>0 ){
				$_value = array($_value);
			}			
		}
		//var_dump($_value);
		foreach( $_data as $_option_value => $_option_select )
		{
			if( !is_array($_value) AND strlen($_value) >0 
				AND ( in_array( $_option_value, $_value) ) 
				AND !is_null($_value) )
			{
				
				$_compile.= "<option value=\"{$_option_value}\" selected >{$_option_select}</option>";
			
			}
			else if( is_array($_value) AND count($_value) >0
				AND ( in_array( $_option_value, $_value) ) 
				AND !is_null($_value) )
			{	
				$_compile.= "<option value=\"{$_option_value}\" selected >{$_option_select}</option>";
			}	
			else {
				$_compile.= "<option value=\"{$_option_value}\">{$_option_select}</option>";
			}
		}
	}
	
	$_compile.= "</select>";
	
	return $_compile;
}

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
public function listInputBox( $_name='', $_style='', $_value ='', $_select='', $_events = array(), $_extra = array() )
{
	$arr_fieldset_style = null;
	$arr_fieldset = array ( "background-color"=> "#fffcfd", "border" => "1px solid #dddddd", "width" => "160px");
	 
	if( isset($_extra['dwidth']) ){
		$arr_fieldset["width"] = $_extra['dwidth'];
	}
	if(is_array($arr_fieldset))
		foreach( $arr_fieldset as $k => $v )
	{
		$arr_fieldset_style[$k] = "{$k}:{$v}";
	}
	
	
	$arr_class = join(";", $arr_fieldset_style);
	$arr_compile = " <fieldset class=\"textarea\" id=\"field_{$_name}\" style=\"{$arr_class}\">";
	
	
// --------------- create elem button --->
	
	$arr_button = null;
	
	if( isset($_extra['button']) AND count($_value)!=0 )
	{
		$arr_set = $_extra['button'];
		$arr_button = "<div class=\"widget-list-button\">";
		
		if(is_array( $arr_set ) ) 
			foreach( $arr_set as $rows )
		{	
			$arr_button .=" <a href=\"javascript:void(0);\" style=\"margin:0px 5px 0px 0px\" ";
			 if( isset($rows['event']) ) {
				$arr_button .= ' onclick="Ext.DOM.'. $rows['event'] .'();"'; 
			} 
			$arr_button.="><span><i class=\"{$rows['class']}\"></i>&nbsp;{$rows['label']}</span></a>";
			
		}
		
		$arr_button .= "</div>";
	}
	
// -------- cek modification event ---------------------------------------------------------------------------------
	$label_default = "<label style=\"cursor:pointer;\" class=\"ui-widget-field-select\"># ALL</label>";
	if(@in_array('label',array_keys($_extra)) ) {
		$label_default = "<label style=\"cursor:pointer;\" class=\"ui-widget-field-select\">{$_extra['label']}</label>";
	}	
	
	$event_default = " onClick=\"Ext.Cmp('{$_name}').setChecked();\" ";
	if(isset($_extra['event']))
	{
		if( $_extra['event'] !=FALSE ) {
			$event_default =" onClick=\"Ext.DOM.{$_extra['event']}('{$_name}');\" ";
		} else {
			$label_default = "";
			$event_default = "";
		}
	}	
	
	$arr_compile .= " <legend style=\"cursor:pointer;\"><a href=\"javascript:void(0);\" $event_default 
	title=\"select here\" style=\"text-decoration:none;\">$label_default</a></legend>";
		
// --------- default of content ---------------------------
	
	if( count($_value)==0 OR !is_array($_value) ){
		$_extra['height'] = '100%';
	}
	
// -------- default style ----------------------------	
	 $arr_style = array ( 'resize' =>'both',  'overflow' => 'auto', 'height' =>'150px', 'overflow'=> 'auto', 'border' =>'0px solid #eeeeee', 'background-color' =>'#fffcfd' );
	 
// ---------- on style -----------------------------------

	$arr_setting = array();
	if( is_array($_extra) )
		foreach( $arr_style as $key => $val )
	{
		if( in_array($key, array_keys($_extra) )){
			$arr_setting[$key] = "${key}:${_extra[$key]}";
		} else{
			$arr_setting[$key] = "${key}:${val}";
		}
	}
	
	if( is_array($arr_setting)){
		$arr_join = join(";",$arr_setting);
	}
	
	$arr_compile.= " <div id=\"div_{$_name}\" style=\"{$arr_join}\">";
	$arr_compile.= " <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"90%\">";
	
	if(is_array($_value))
		foreach( $_value as $key => $v )
	{
		$arr_compile .= " <tr>";
		$arr_compile .= " <td style=\"border-bottom:1px solid #eeeeee;\" width=\"5%\">";
		if( is_array($_select) 
			AND in_array($key,$_select))
		{
			
			$_extra['checked'] = 'checked';
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}
		else{
			unset($_extra['checked']);
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}	
		
		$arr_compile .= " </td>";
		$arr_compile .= " <td style=\"border-bottom:1px solid #eeeeee;\">". wordwrap($v,15,"</br>") ."</td>";
	$arr_compile .= " <td style=\"border-bottom:1px solid #eeeeee;text-align:center;\">". $this->input("{$_name}_{$key}","input_text small", 0)."</td>";
		$arr_compile .= " </tr>";
	}
	
	$arr_compile.= " </table>";
	$arr_compile.= " </div>";
	$arr_compile.= " {$arr_button}</fieldset> ";		
	
	return $arr_compile;
}

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
public function listCombo( $_name='', $_style='', $_value ='', $_select='', $_events = array(), $_extra = array() )
{
	
	if( count($_value) < 5 ){
		$_extra['height'] = '100%';
	} else {
		$_extra['height'] = "120px";
	}
	
	$arr_fieldset_style = null;
	$arr_fieldset = array ( "background-color"=> "#fffcfd", "border" => "1px solid #dddddd", "width" => "160px");
	 
	if( isset($_extra['dwidth']) ){
		$arr_fieldset["width"] = $_extra['dwidth'];
	}
	if(is_array($arr_fieldset))
		foreach( $arr_fieldset as $k => $v )
	{
		$arr_fieldset_style[$k] = sprintf('%s:%s', $k, $v); //"{$k}:{$v}";
	}
	
	
	$arr_class = join(";", $arr_fieldset_style);
	$arr_compile = " <fieldset class=\"textarea\" id=\"field_{$_name}\" style=\"{$arr_class}\">";
	
	
// --------------- create elem button --->
	
	$arr_button = null;
	
	if( isset($_extra['button']) AND count($_value)!=0 )
	{
		$arr_set = $_extra['button'];
		$arr_button = "<div class=\"widget-list-button\">";
		
		if(is_array( $arr_set ) ) 
			foreach( $arr_set as $rows )
		{	
			$arr_button .=" <a href=\"javascript:void(0);\" style=\"margin:0px 5px 0px 0px\" ";
			 if( isset($rows['event']) ) {
				$arr_button .= ' onclick="Ext.DOM.'. $rows['event'] .'();"'; 
			} 
			$arr_button.="><span><i class=\"{$rows['class']}\"></i>&nbsp;{$rows['label']}</span></a>";
			
		}
		
		$arr_button .= "</div>";
	}
	
// -------- cek modification event ---------------------------------------------------------------------------------
	$label_default = "<label style=\"cursor:pointer;margin-left:-7px;\" class=\"ui-widget-field-select\">
				<i class='fa fa-check-square-o' aria-hidden='true'></i> ALL</label>";
	if(@in_array('label',array_keys($_extra)) ) {
		$label_default = "<label style=\"cursor:pointer;margin-left:-7px;\" class=\"ui-widget-field-select\">
						<i class='fa fa-check-square-o' aria-hidden='true'></i>{$_extra['label']}</label>";
	}	
	
	$event_default = " onClick=\"Ext.Cmp('{$_name}').setChecked();\" ";
	if(isset($_extra['event']))
	{
		if( $_extra['event'] !=FALSE ) {
			if( !is_array($_extra['event']) ){
				$event_default =" onClick=\"Ext.DOM.{$_extra['event']}('{$_name}', this);\" ";
			} else {
				$arr_vent_key = $_extra['event'];
				$arr_label = ( isset($arr_vent_key['func_label']) ? $arr_vent_key['func_label'] : 'default' );
				$arr_value = ( isset($arr_vent_key['func_value']) ? join("','", $arr_vent_key['func_value']) : $_name);
				$event_default =" onClick=\"Ext.DOM.${arr_label}('{$arr_value}');\" ";
			}
			
		} else {
			$label_default = "";
			$event_default = "";
		}
	}	
	
	$arr_compile .= " <legend style=\"cursor:pointer;\"><a href=\"javascript:void(0);\" $event_default 
	title=\"select here\" style=\"text-decoration:none;\">$label_default</a></legend>";
		
// --------- default of content ---------------------------
	
	if( count($_value)==0 OR !is_array($_value) ){
		$_extra['height'] = '100%';
	}
	
// -------- default style ----------------------------	
	 $arr_style = array ( 'resize' =>'both',  'overflow' => 'auto', 'height' =>'150px', 'overflow'=> 'auto', 'border' =>'0px solid #eeeeee', 'background-color' =>'#fffcfd' );
	 
// ---------- on style -----------------------------------

	$arr_setting = array();
	if( is_array($_extra) )
		foreach( $arr_style as $key => $val )
	{
		if( in_array($key, array_keys($_extra) )){
			$arr_setting[$key] = "${key}:${_extra[$key]}";
		} else{
			$arr_setting[$key] = "${key}:${val}";
		}
	}
	
	if( is_array($arr_setting)){
		$arr_join = join(";",$arr_setting);
	}
	
	$arr_compile.= " <div id=\"div_{$_name}\" style=\"{$arr_join}\">";
	$arr_compile.= "<div class='ui-widget-form-table-compact ui-widget-list-box-table' >";// <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"90%\">";
	
	$num = 0;
	if(is_array($_value))
		foreach( $_value as $key => $v )
	{
		$class = ( ($num%2)!=1 ? 'ui-widget-list-box-cell-one' : 'ui-widget-list-box-cell-two');
		$arr_compile .= "<div class='ui-widget-form-row ui-widget-list-box-row $class' >";//" <tr>";
		$arr_compile .= "<div class='ui-widget-form-cell ui-widget-list-box-cell table-white-space-ys-wrap left' style='width:10%;'>"; //" <td style=\"border-bottom:1px solid #eeeeee;\" width=\"5%\">";
		if( is_array($_select) 
			AND in_array($key,$_select))
		{
			
			$_extra['checked'] = 'checked';
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}
		else{
			unset($_extra['checked']);
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}	
		
		$arr_compile .= "</div>"; //" </td>";
		$arr_compile .= sprintf("<div class='ui-widget-form-cell ui-widget-list-box-cell table-white-space-ys-wrap left' style='width:89%%;'>%s</div>", $v); //" <td style=\"border-bottom:1px solid #eeeeee;\">". wordwrap($v,30,"</br>") ."</td>";
		$arr_compile .= "</div>"; //" </tr>";
		$num++;
	}
	
	$arr_compile.= "</div>";//" </table>";
	$arr_compile.= " </div>";
	$arr_compile.= " {$arr_button}</fieldset> ";		
	
	return $arr_compile;
}
 
 /*
public function listCombo( $_name='', $_style='', $_value ='', $_select='', $_events = array(), $_extra = array() )
{
	
	$arr_fieldset_style = null;
	$arr_fieldset = array ( "background-color"=> "#fffcfd", "border" => "1px solid #dddddd", "width" => "160px");
	 
	if( isset($_extra['dwidth']) ){
		$arr_fieldset["width"] = $_extra['dwidth'];
	}
	if(is_array($arr_fieldset))
		foreach( $arr_fieldset as $k => $v )
	{
		$arr_fieldset_style[$k] = "{$k}:{$v}";
	}
	
	
	$arr_class = join(";", $arr_fieldset_style);
	$arr_compile = " <fieldset class=\"textarea\" id=\"field_{$_name}\" style=\"{$arr_class}\">";
	
	
// --------------- create elem button --->
	
	$arr_button = null;
	
	if( isset($_extra['button']) AND count($_value)!=0 )
	{
		$arr_set = $_extra['button'];
		$arr_button = "<div class=\"widget-list-button\">";
		
		if(is_array( $arr_set ) ) 
			foreach( $arr_set as $rows )
		{	
			$arr_button .=" <a href=\"javascript:void(0);\" style=\"margin:0px 5px 0px 0px\" ";
			 if( isset($rows['event']) ) {
				$arr_button .= ' onclick="Ext.DOM.'. $rows['event'] .'();"'; 
			} 
			$arr_button.="><span><i class=\"{$rows['class']}\"></i>&nbsp;{$rows['label']}</span></a>";
			
		}
		
		$arr_button .= "</div>";
	}
	
// -------- cek modification event ---------------------------------------------------------------------------------
	$label_default = "<label style=\"cursor:pointer;\" class=\"ui-widget-field-select\"># ALL</label>";
	if(@in_array('label',array_keys($_extra)) ) {
		$label_default = "<label style=\"cursor:pointer;\" class=\"ui-widget-field-select\">{$_extra['label']}</label>";
	}	
	
	$event_default = " onClick=\"Ext.Cmp('{$_name}').setChecked();\" ";
	if(isset($_extra['event']))
	{
		if( $_extra['event'] !=FALSE ) {
			if( !is_array($_extra['event']) ){
				$event_default =" onClick=\"Ext.DOM.{$_extra['event']}('{$_name}', this);\" ";
			} else {
				$arr_vent_key = $_extra['event'];
				$arr_label = ( isset($arr_vent_key['func_label']) ? $arr_vent_key['func_label'] : 'default' );
				$arr_value = ( isset($arr_vent_key['func_value']) ? join("','", $arr_vent_key['func_value']) : $_name);
				$event_default =" onClick=\"Ext.DOM.${arr_label}('{$arr_value}');\" ";
			}
			
		} else {
			$label_default = "";
			$event_default = "";
		}
	}	
	
	$arr_compile .= " <legend style=\"cursor:pointer;\"><a href=\"javascript:void(0);\" $event_default 
	title=\"select here\" style=\"text-decoration:none;\">$label_default</a></legend>";
		
// --------- default of content ---------------------------
	
	if( count($_value)==0 OR !is_array($_value) ){
		$_extra['height'] = '100%';
	}
	
// -------- default style ----------------------------	
	 $arr_style = array ( 'resize' =>'both',  'overflow' => 'auto', 'height' =>'150px', 'overflow'=> 'auto', 'border' =>'0px solid #eeeeee', 'background-color' =>'#fffcfd' );
	 
// ---------- on style -----------------------------------

	$arr_setting = array();
	if( is_array($_extra) )
		foreach( $arr_style as $key => $val )
	{
		if( in_array($key, array_keys($_extra) )){
			$arr_setting[$key] = "${key}:${_extra[$key]}";
		} else{
			$arr_setting[$key] = "${key}:${val}";
		}
	}
	
	if( is_array($arr_setting)){
		$arr_join = join(";",$arr_setting);
	}
	
	$arr_compile.= " <div id=\"div_{$_name}\" style=\"{$arr_join}\">";
	$arr_compile.= " <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"90%\">";
	
	if(is_array($_value))
		foreach( $_value as $key => $v )
	{
		$arr_compile .= " <tr>";
		$arr_compile .= " <td style=\"border-bottom:1px solid #eeeeee;\" width=\"5%\">";
		if( is_array($_select) 
			AND in_array($key,$_select))
		{
			
			$_extra['checked'] = 'checked';
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}
		else{
			unset($_extra['checked']);
			$arr_compile .=  self::checkbox($_name,NULL, $key, $_events, $_extra);
		}	
		
		$arr_compile .= " </td>";
		$arr_compile .= " <td style=\"border-bottom:1px solid #eeeeee;\">". wordwrap($v,50,"</br>") ."</td>";
		$arr_compile .= " </tr>";
	}
	
	$arr_compile.= " </table>";
	$arr_compile.= " </div>";
	$arr_compile.= " {$arr_button}</fieldset> ";		
	
	return $arr_compile;
}
*/

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 public function copy( $name='copy-text', $class="btn-clipboard", $target=null, $text=null )
{
  if( !is_null($target) )
 {
	return "<span class=\"ui-state-focus\" style=\"padding:1px;cursor:copy;font-size:12px;\" title=\"Copy to clipboard\">
				<span style=\"margin:3px;\" class=\"${class}\" data-clipboard-target=\"#${target}\"><i class=\"fa fa-clipboard\"></i>{$text}</span>
			</span>";	
 } else {
	 return null;
 }	 

}							
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
public function textarea( $_name='', $_style='', $_value =null, $_events = array(), $_extra = array() )
{
	$_compile = " <textarea spellcheck='false' name=\"$_name\" id=\"$_name\"";
	
	$_compile.= ( !is_null($_style)?" class=\"$_style\"" : "" );
	if( is_array( $_extra )!=FALSE )  
		$_compile .= self::_extra( $_extra );
		
	if( is_array( $_events )!=FALSE ) { 
		$_compile .= self::_events( $_events );
	}
	
	$_compile.= ">" . $_value . "</textarea>";
	
	return $_compile;
}
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 public function upload( $_name='fileToupload', $_style=null, $_events = array(), $_extra = array() ) 
 {
	$on_event = null;
	if( is_array( $_events ) ) 
		foreach( $_events as $ky  => $val )  
	{
		$arr_event = array('click' => 'onClick', 'change' => 'onChange' );
		if( in_array($ky, array_keys($arr_event))) 
		{
			$on_event = "$arr_event[$ky]=\"$val;\"";
		}	
	}	
	
	$_compile = "<form action=\"javascript:void(0);\" method=\"post\" enctype=\"multipart/form-data\">  
					<div class=\"browse\">
					<input type=\"file\" name=\"{$_name}[]\" id=\"$_name\" $on_event>
					</div>
				</form>";
				
	return $_compile;
  }

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 
 public function label_array(  $data = null, $class=null,  $id="label", $callback = null ) 
{	
 $arr_content = NULL;
 $arr_compile = "<div id=\"{$id}\" class=\"{$class}\">";
 
 if( is_null($data) OR count($data)==0 ){
	$arr_content = "-";
 }
 
 if( !is_array($data) )
 {
	if( function_exists( $callback ) ){
		$arr_content = call_user_func( $callback, $data ); 
	} else {
		$arr_content = $data;
	}
 }
 
 if(is_array($data) AND count($data) > 0 )
 {
	$arr_content = "<ul id=\"widget-ul-$id\" class=\"widget-label-ul-content\" >";
	
	$i = 1;
	foreach( $data as $k => $li )
	{
		$li_class = ( $i==1 ? 'li-first' : 'li-middle');
		$li_od = ( $i%2==0 ? 'li-genap' : 'li-ganjil');
		
		if( function_exists( $callback ) )
		{
			$arr_content .= "<li class=\"{$li_class} {$li_od}\">". call_user_func( $callback, $li )."</li>"; 
		} else{
			$arr_content .= "<li class=\"{$li_class} {$li_od}\">{$li}</li>"; 
		}
		$i++;
	}
	
	$arr_content .= "</ul>";
 }
 
 
  $arr_compile .="{$arr_content}</div>";
  return $arr_compile;
}
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
public function label( $data = null, $class=null,  $id="label", $callback = null ) 
{	
 $arr_content = NULL;
 $arr_compile = "<div id=\"{$id}\" class=\"input_text {$class} tolong\">";
 if( !is_array($data) )
 {
	if( function_exists( $callback ) ){
		$arr_content = call_user_func( $callback, $data ); 
	} else {
		$arr_content = $data;
	}
 }
 $arr_compile .="{$arr_content}</div>";
  return $arr_compile;
}


// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 public function navbar( $arr_button  = null ) 
{
  $arr_bars = "<div class=\"ui-widget-button-navbar\"><ul>";
  if( is_array($arr_button) ) 
	foreach( $arr_button as $button => $rows )  
  {
		$arr_bars .= "<li class=\"ui-state-focus\">".
						"<a href=\"javascript:void(0);\" onclick=\"Ext.DOM.{$button}('{$rows[value]}');\" title=\"{$rows[title]}\" style=\"text-decoration:none;\"><i class=\"{$rows['class']}\"></i>&nbsp;". lang($rows['label'])."</a>".
					"</li>";
  }
	$arr_bars.= "</ul></div>";
  return $arr_bars;
}

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 public function formtoolbar( $arr_button  = null ) 
{
  $arr_bars = "<div class=\"ui-widget-button-li\"><ul>";
  if( is_array($arr_button) ) 
	foreach( $arr_button as $button => $rows )  
  {
		$arr_bars .= "<li class=\"ui-state-focus\">".
						"<a href=\"javascript:void(0);\" onclick=\"Ext.DOM.{$button}('{$rows[value]}');\" style=\"text-decoration:none;\"><i class=\"{$rows['class']}\"></i>&nbsp;". lang($rows['label'])."</a>".
					"</li>";
  }
	$arr_bars.= "</ul></div>";
  return $arr_bars;
}

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 
 public function legend( $arr_label = null, $class= null ) 
{
 $arr_class = array( 'class' => 'fa-user-plus', 'label' => 'Text legend' );
 
 if( is_array($arr_label) ) {
	$arr_class['class'] = $class['class'];
	$arr_class['label'] = $class['label'];
 }
 
 if(!is_array($arr_label) ) 
 {
	$arr_class['label'] = $arr_label;
	 if(!is_null($class) )
	{
		$arr_class['class'] = $class;
	}
 }
 
  $arr_text = 
	"<legend class=\"ui-widget-awesome-context\">".
		"<span class=\"fa-stack fa-lg ui-widget-awesome-legend\">".
				"<i class=\"fa fa-circle fa-stack-2x\"></i>".
				"<i class=\"fa {$arr_class['class']} fa-stack-1x fa-inverse\"></i>".
		"</span> <label id=\"ui-widget-title\">{$arr_class['label']} </label>".
	"</legend>";
    return $arr_text;
}



// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 
 public function link( $arr_label = null, $class= null, $button = null ) 
{
 $arr_class = array( 'class' => 'fa-user-plus', 'label' => 'Text legend', "button" => "" );
 
 if( is_array($arr_label) ) {
	
	$arr_class['class']  = $arr_label['class'];
	
	if( isset($arr_class['label']) ){
		$arr_class['label']  = $arr_label['label'];
	}
	
	if( isset($arr_class['button']) ) {
		$arr_class['button'] = " onClick=\"Ext.DOM.{$arr_label['button']}(this);\"";
	}
 }
 
 if(!is_array($arr_label) ) 
 {
	$arr_class['label'] = $arr_label;
	if(!is_null($class) ){
		$arr_class['class'] = $class;
	}
	
	if(!is_null($button) ){
		$arr_class['button'] = "onClick=\"Ext.DOM.{$button}(this);\"";
	}
	
 }
 
  $arr_text = 
	"<div class=\"ui-widget-button-link\">".
		"<a href=\"javascript:void(0);\" style=\"text-decoration:none;\"
			title=\"{$arr_class['label']}\"
			{$arr_class['button']}> <span class=\"fa-stack fa-lg ui-widget-awesome-legend\">".
				"<i class=\"fa fa-circle fa-stack-2x\"></i>".
				"<i class=\"fa {$arr_class['class']} fa-stack-1x fa-inverse\"></i>".
		"</span>  </a>".
	"</div>";
    return $arr_text;
}



// END CLASS 

}

// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
if( !function_exists('form') ) 
{
  function form()
  {
	$EUI =& EUI_Form::get_instance();
	if(is_object( $EUI ) ) {
		return $EUI;
	}
	else{
		return $EUI;
	}
  }
}
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
if( !function_exists('javascript') ) 
{
  function javascript( $array = null )
  {
	$EUI =& EUI_Form::get_instance();
	if(is_object($EUI) ) {
		
		return $EUI -> _get_javascript($array);
	}
  }
}
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
if(!function_exists('styles'))
{
	function styles($array=null)
	{
		$EUI =& EUI_Form::get_instance();
		if(is_object($EUI) ) 
		{
			return $EUI -> _get_styles($array);
		}
	}	
}
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
 
if(!function_exists('WorkProjectName')){
function WorkProjectName()
 {
	$WorkName = '';
	
	$UI =& get_instance();
	$UI->load->model('M_ProjectWorkForm');
	if( $UI->EUI_Session->_have_get_session('ProjectId') )
	{
		if( !in_array($UI->EUI_Session->_get_session('HandlingType'),array(USER_ROOT, USER_ADMIN)))
		{
			$UI->db->reset_select(); // reset active record *** 
			// then reopen the database.
			if( $rows = $UI->M_ProjectWorkForm->_getWorkProject( $UI->EUI_Session->_get_session('ProjectId')))
			{
				$WorkName = $rows['ProjectName'];
			}	
		}	
	}
	
	return $WorkName;
 }
} 
// --------------------------------------------------------------------------------

/*
 * helper     Form Helper attribute 
 *
 * @ pack  		 form
 * @ param		 array()
 */
if( ! function_exists( '__' ))
{
   function __( $string = '' )
 {
		echo $string;
  }
}

// END OF FILE 
// @omens 
