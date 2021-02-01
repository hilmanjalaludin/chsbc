<?php 
// $out  = new EUI_Object($content_pages);
// $out->debug_field();

 if(!function_exists('_setWordCut') )
{
  function _setWordCut( $text ){
	return _setBreakWord($text, 30);
  }
}

/*
 * @ pack : load helpers
 */
 
 if(!function_exists('_setEventAction') )
{
  function _setEventAction( $Id ){
	return form()->formtoolbar(array( 
		"Play" => array("class" => "fa fa-play ui-widget-awesome-toolbar", "value" => $Id, "label" => "Play")
	));
  }
}



/*
 * @ pack : load helpers
 */

 $this->load->helpers(array('EUI_Object','EUI_Page'));
 $arr_obj = new EUI_Object($content_pages);
/*
 * @ pack : get all parameters 
 */
 
 $type 	= _get_post('type');
 $orderby = _get_post('orderby');
 $next_order = ($type=='ASC'?'DESC':'ASC');
 
 $arr_header = array
 (
	"start_time" => lang(array("Call Date")),
	"anumber"=> lang("Call Number"),
    "file_voc_name" => lang("File Name"),
    "duration"=> lang(array("Duration")),
    //"file_voc_size" => lang(array("File Size")),
	"agent_name" => lang(array("Agent Id")),
	"PlayId" => lang(array("Option")),
 ); 
 
  $arr_class = array
 (
    "anumber"=> "content-middle",
    "file_voc_name" => "content-middle",
    "start_time" => "content-middle",
    "duration"=> "content-middle",
    "file_voc_size" => "content-middle",
	"agent_name" => "content-middle",
	"PlayId" => "content-lasted"
 ); 
 
   
 $arr_align = array
 (
    "anumber"=> "left",
    "file_voc_name" => "left",
    "start_time" => "center",
    "duration"=> "center",
    "file_voc_size" => "right",
	"agent_name" => "left",
	"PlayId" => "center"
 );
 /*
  * @ pack : get all labels -  array header 
  */
  
 $arr_width = array( );
 
 
/*
 * @ pack : get all labels -  array header 
 */
 $arr_function = array ( 
	"anumber"=> "_getMasking",   
	"start_time" => "_getDateTime",
    "duration"=> "_getDuration",
    "file_voc_size" => "_getFormatSize",
	// "file_voc_name" => "_setWordCut",
	"file_voc_name" => "_getFormatName",
	"agent_name" => "_setCapital",
	"PlayId" => "_setEventAction"
 ); 
/*
 * @ pack : get all labels -  array header 
 */
  
 $arr_wrap = array(
	"anumber"=> "nowrap",   
	"start_time" => "nowrap",
    "duration"=> "nowrap",
	"agent_name" => "nowrap",
    "file_voc_size" => "nowrap",
	"PlayId" => "nowrap"
 ); 
 
// -------------- generate label on grid ----------------> 

echo "<table border=0 cellspacing=1 width=\"99%\" style=\"margin-left:-5px;\">".
	"<tr height=\"30\"> ".
		"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
	
	foreach( $arr_header as $field => $value ){
		if( in_array($orderby, array($field) ))
		{
			echo "<th class=\"ui-corner-top ui-state-default th-middle {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order ".strtolower($type)."\" onclick=\"Ext.DOM.PageCallRecording({page:0,  orderby:'{$field}', type:'{$next_order}'});\">&nbsp;{$value}</span></th>";
		} else {
			echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.PageCallRecording({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
		}
	}
	
echo "</tr>";

// ---------------- content ----------------

 if( is_array($content_pages) ) 
{ 
 $no = $start_page+1;
 foreach( $content_pages as $num => $rows )
{
 $row = new EUI_Object( $rows );
// @ pack : of list color 
 $back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
 echo " <tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
		"<td class=\"content-first\" nowrap>{$no}</td>";
		
 foreach( array_keys($arr_header) as $k => $fields )
 {
   if(strcmp( $fields, $orderby )== 0 ){
	  echo  "<td class=\"$arr_class[$fields] ui-widget-select-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields, $arr_function[$fields])}</td>";
   }else{
	  echo  "<td class=\"$arr_class[$fields] ui-widget-unselect-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields,$arr_function[$fields])}</td>";
   }
 }
 
// ---------- on event ------------------------------------------------
	
	
 $arr_num =1; $n = 0;	
   if(is_array($menu_event))
	foreach( $menu_event as $e => $value )
  {
	$ar_ = "content-middle";
		if( count($menu_event) == $arr_num){
			$ar_ = "content-lasted"; 	
		} 
		
	  $arr_event = $event_exits[$rows['MenuId']][$e];
	  $ischeck = (@in_array( $arr_event, _getKey($role_exits[$rows['MenuId']])) ? "checked='true'" : NULL);
	  $arr_avail = ( $arr_event ? "<input type=\"checkbox\"  $ischeck value=\"{$arr_event}:{$rows[MenuId]}\" onClick=\"Ext.DOM.SaveRoleMenu(this);\">Y" : "N");
	  echo "<td class=\"{$ar_} ui-widget-unselect-order center\">". _setBoldColor($arr_avail) ."</td>";
	  
	  $arr_num++; $n++;
  }
   
   
	echo "</tr>";
	$no++;	
 }	
 
}

/* @ pack : -------------------------------------------------------
 * @ pack : # get list off page #----------------------------------
 * @ pack : -------------------------------------------------------
 */

 $max_page = 10;
 
// @ pack : start html  

 $_li_create = " <div class='page-web-voice' style='margin-left:-5px;margin-top:2px;border-top:0px solid #FFFEEE;'><ul>";
 
// @ pack : list 
 
 $start =(int)(!$select_pages ? 1: ((($select_pages%$max_page ==0) ? ($select_pages/$max_page) : intval($select_pages/$max_page)+1)-1)*$max_page+1);
 $end   =(int)((($start+$max_page-1)<=$total_pages) ? ($start+$max_page-1) : $total_pages );
	
// @ pack : like here 

 if( $select_pages > 1) 
 {
	$post = (int)(($select_pages)-1);
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.PageCallRecording({page: 1, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;&lt;</a></li>";
		
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.PageCallRecording({page: ${post}, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;</a></li>";
 }

// @ pack : check its 

 if($start>$max_page){
	$_li_create.="<li cclass=\"page-web-voice-normal\"  onClick=\"Ext.DOM.PageCallRecording({page:(${start}-1), orderby :'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">...</a></li>";
 }

// @ pack : check its 
 
 for( $p = $start; $p<=$end; $p++)
 { 
	if( $p == $select_pages ){ 
		$_li_create .="<li class=\"page-web-voice-current\" id=\"${p}\" onClick=\"Ext.DOM.PageCallRecording({page:${p}, orderby :'${orderby}', type:'${type}'});\"> <a href=\"javascript:void(0);\">{$p}</a></li>";
	 } else {
		$_li_create .=" <li class=\"page-web-voice-normal\" id=\"${p}\" onClick=\"Ext.DOM.PageCallRecording({page:${p}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\">{$p}</a></li>";
	}
 }

// @ pack : check its 
  
 if($end<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.PageCallRecording({page:${end}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" >...</a></li>";
 }

// @ pack : check its 
 
 if($select_pages<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.PageCallRecording({page:(${select_pages}+1),  orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Next page\">&gt;</a></li>";
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.PageCallRecording({page:${total_pages},orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Last page\">&gt;&gt;</a></li>";
 }
		
// @ pack : check its 
	
 $_li_create .="</ul></div>";
 echo "<tr>".
		"<td colspan='5'>{$_li_create}</td> ".
		"<td colspan='2' style='color:brown;' nowrap>". lang('button_record') ."&nbsp;: <span class='input_text' style='padding:2px;'>{$total_records}&nbsp;</span></td>".
	"</tr>	";
 	
?>

</table>