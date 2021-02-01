<?php 
// -------------------------------------------------
 if(!function_exists('_setWordCut') ) {
  function _setWordCut( $text ){
	return _setBreakWord($text, 40);
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
 
 // debug only : $arr_header = $arr_obj->fetch_field();

 
 $arr_header = array
 (
	"ProductName" => lang("Product Name"),
    "PayMode" => lang(array("Payment Mode")),
    "Gender"=> lang(array("Gender")),
    "PremiGroup" => lang(array("Group Premi")),
	"PlanLevel" => lang(array("Level")),
	"PlanName" => lang(array("Plan")),
    "StartAge"=> lang("Start Age"),
	"EndAge"=> lang("End Age"),
	"Premi"=> lang("Premi")
 ); 
 
  $arr_class = array
 (
    "ProductName" => "content-middle",
    "PayMode" => "content-middle",
    "Gender"=> "content-middle",
    "PremiGroup" => "content-middle",
	"PlanName" => "content-middle",
	"PlanLevel" => "content-middle",
    "StartAge"=> "content-middle",
	"EndAge"=> "content-middle",
	"Premi"=> "content-lasted"
	
 ); 
 
   
 $arr_align = array
 (
    "ProductPlanId"=> "left",
    "ProductName" => "left",
    "PayMode" => "left",
    "Gender"=> "left",
    "PremiGroup" => "left",
	"PlanName" => "left",
	"PlanLevel" => "center",
    "StartAge"=> "center",
	"EndAge"=> "center",
	"Premi"=> "left"
 ); 
 
 /*
  * @ pack : get all labels -  array header 
  */
  
 $arr_width = array( );
 
 
/*
 * @ pack : get all labels -  array header 
 */
 $arr_function = array ( 
    "ProductName" => array("_setBoldColor"),
    "StartAge"=> "intval",
	"EndAge"=> "intval",
	"Premi"=> "_getCurrency"
 ); 
/*
 * @ pack : get all labels -  array header 
 */
  
 $arr_wrap = array(); 
 
// -------------- generate label on grid ----------------> 

echo "<table border=0 cellspacing=1 width=\"100%\">".
	"<tr height=\"27\"> ".
		"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
	
	foreach( $arr_header as $field => $value ){
		if( in_array($orderby, array($field) ))
		{
			echo "<th class=\"ui-corner-top ui-state-default th-middle {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order ".strtolower($type)."\" onclick=\"ProductPremiTable({page:0,  orderby:'{$field}', type:'{$next_order}'});\">&nbsp;{$value}</span></th>";
		} else {
			echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"ProductPremiTable({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
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
 echo " <tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"27\" title=\"click row to show benefit on this plan\" style=\"cursor:pointer;\"
		onclick=\"ShowProductBenefit('{$row->get_value('ProductPlanId')}');\">".
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

 $max_page = 5;
 
// @ pack : start html  

 $_li_create = " <div class='page-web-voice' style='margin-left:-5px;margin-top:2px;border-top:0px solid #FFFEEE;'><ul>";
 
// @ pack : list 
 
 $start =(int)(!$select_pages ? 1: ((($select_pages%$max_page ==0) ? ($select_pages/$max_page) : intval($select_pages/$max_page)+1)-1)*$max_page+1);
 $end   =(int)((($start+$max_page-1)<=$total_pages) ? ($start+$max_page-1) : $total_pages );
	
// @ pack : like here 

 if( $select_pages > 1) 
 {
	$post = (int)(($select_pages)-1);
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"ProductPremiTable({page: 1, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;&lt;</a></li>";
		
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"ProductPremiTable({page: ${post}, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;</a></li>";
 }

// @ pack : check its 

 if($start>$max_page){
	$_li_create.="<li cclass=\"page-web-voice-normal\"  onClick=\"ProductPremiTable({page:(${start}-1), orderby :'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">...</a></li>";
 }

// @ pack : check its 
 
 for( $p = $start; $p<=$end; $p++)
 { 
	if( $p == $select_pages ){ 
		$_li_create .="<li class=\"page-web-voice-current\" id=\"${p}\" onClick=\"ProductPremiTable({page:${p}, orderby :'${orderby}', type:'${type}'});\"> <a href=\"javascript:void(0);\">{$p}</a></li>";
	 } else {
		$_li_create .=" <li class=\"page-web-voice-normal\" id=\"${p}\" onClick=\"ProductPremiTable({page:${p}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\">{$p}</a></li>";
	}
 }

// @ pack : check its 
  
 if($end<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"ProductPremiTable({page:${end}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" >...</a></li>";
 }

// @ pack : check its 
 
 if($select_pages<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"ProductPremiTable({page:(${select_pages}+1),  orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Next page\">&gt;</a></li>";
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"ProductPremiTable({page:${total_pages},orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Last page\">&gt;&gt;</a></li>";
 }
		
// @ pack : check its 
	
 $_li_create .="</ul></div>";
 echo "<tr>".
		"<td colspan='6'>{$_li_create}</td> ".
		"<td style='color:brown;' nowrap>". lang('button_record') ."&nbsp;: <span class='input_text' style='padding:2px;'>{$total_records}&nbsp;</span></td>".
	"</tr>	";
 	
?>

</table>