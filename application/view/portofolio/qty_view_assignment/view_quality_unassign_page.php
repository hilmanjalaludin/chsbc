<?php 
// -------------------------------------------------
 if(!function_exists('_setWordCut') ) {
  function _setWordCut( $text ){
	return _setBreakWord($text, 20);
  }
}

// -------------------------------------------------
 if(!function_exists('_setAgentCut') ) {
  function _setAgentCut( $text ){
	return _setBreakWord($text, 12);
  }
}


// -------------------------------------------------
 if(!function_exists('_setCheckBox') ) {
  function _setCheckBox( $CustomerId ='' ){
	$arr = "<a href=\"javascript:void(0);\" ". 
			" onclick=\"Ext.Cmp('$CustomerId').setChecked();\" style=\"cursor:pointer;\">".
			"<i class=\"fa fa-check-square\"></i></a>";	
	return (string)$arr;
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
	"CampaignName"=> lang(array("Campaign Name")),
    "CustomerFirstName" => lang(array("Customer Name")),
    "CustomerDOB" => lang(array("Age")),
	"AgentId"=> lang(array("Agent Id")),
	"Supervisor" => lang(array('Supervisor')),
	"CallResultId" => lang(array("Call Result")),
	"QualityStaff" => lang(array("Quality Staff")),
	"QualityStatus" => lang(array("Quality Status")),
	"Duration" => lang(array("Duration")),
	"SalesDate" => lang(array("Sales Date"))
 ); 
 
  $arr_class = array
 (
    "CampaignName"=> "content-middle",
    "CustomerFirstName" => "content-middle",
	"CustomerAddress" => "content-middle",
    "CustomerDOB" => "content-middle",
    "AgentId"=> "content-middle",
	"Supervisor" => "content-middle",
	"CallResultId" => "content-middle",
	"QualityStaff" => "content-middle",
	"QualityStatus" => "content-middle",
	"QualityUpdateTs" => "content-middle",
	"Duration" => "content-middle",
	"SalesDate" => "content-lasted"
	
 ); 
 
   
 $arr_align = array
 (
	"CampaignName"=> "left",
    "CustomerFirstName" => "left",
	"CustomerAddress" => "left",
    "CustomerDOB" => "center",
    "AgentId"=> "left",
	"Supervisor" => "left",
	"CallResultId" => "left",
	"QualityStaff" => "left",
	"QualityStatus" => "left",
	"QualityUpdateTs" => "left",
	"Duration" => "center",
	"SalesDate" => "center"
 ); 
 
 /*
  * @ pack : get all labels -  array header 
  */
  
 $arr_width = array( 
	"CampaignName"=> "12%",
    "CustomerFirstName" => "12%",
	"CustomerAddress" => "12%",
    "CustomerDOB" => "12%",
    "AgentId"=> "12%",
	"Supervisor" => "12%",
	"CallResultId" => "12%",
	"QualityStaff" => "12%",
	"QualityStatus" => "12%",
	"QualityUpdateTs" => "12%",
	"Duration" => "12%",
	"SalesDate" => "12%"
	
 );
 
 
/*
 * @ pack : get all labels -  array header 
 */
 $arr_function = array ( 
	'CustomerFirstName' => array('_setAgentCut','strtoupper'),
	'CustomerDOB' => array("_getAge"),
	'CampaignName' => array("_setAgentCut"),
	'QualityStaff' => array("_setAgentCut","strtoupper"),
	'AgentId'=> array("_setAgentCut","strtoupper"),
	'Supervisor'=> array("_setAgentCut","strtoupper"),
	'Duration'	=> array("_getDuration"),
	'CallReasonId' => array("_setAgentCut"),
	'SalesDate' => array("_getDateIndonesia")
 ); 
 
/*
 * @ pack : get all labels -  array header 
 */
  
 $arr_wrap = array(); 
 
// -------------- generate label on grid ----------------> 

echo "<table border=0 cellspacing=1 width=\"100%\">".
	"<tr height=\"30\"> ";
		
		
		echo "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". _setCheckBox('QualityAssignId')."</th>";
		echo "<th class=\"ui-corner-top ui-state-default center th-middle\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
		
		
	foreach( $arr_header as $field => $value ){
		if( in_array($orderby, array($field) ))
		{
			echo "<th class=\"ui-corner-top ui-state-default th-middle ". is($arr_align,$field) ."\" width=\"". is($arr_width,$field) ."\"><span class=\"header_order ".strtolower($type)."\" onclick=\"Ext.DOM.ViewStoreObjectData({page:0,  orderby:'{$field}', type:'{$next_order}'});\">&nbsp;{$value}</span></th>";
		} else {
		echo "<th class=\"ui-corner-top ui-state-default th-lasted ". is($arr_align,$field) ."\" width=\"". is($arr_width,$field)."\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.ViewStoreObjectData({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
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
 echo " <tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">";
 echo "<td class=\"content-first\" align=\"center\" nowrap >&nbsp;". form()->checkbox("QualityAssignId", null, $row->get_value('QualityAssignId'))."</td>";	
 echo "<td class=\"content-middle\" nowrap>{$no}</td>";
  
 	
 foreach( array_keys($arr_header) as $k => $fields )
 {
   if(strcmp( $fields, $orderby )== 0 ){
	  echo  "<td class=\"$arr_class[$fields] ui-widget-select-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields, $arr_function[$fields])}</td>";
   }else{
	  echo  "<td class=\"$arr_class[$fields] ui-widget-unselect-order {$arr_align[$fields]}\" ${arr_wrap[$fields]}>{$row->get_value($fields,$arr_function[$fields])}</td>";
   }
 }
 
// ---------- on event ------------------------------------------------
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
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ViewStoreObjectData({page: 1, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;&lt;</a></li>";
		
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ViewStoreObjectData({page: ${post}, orderby:'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">&lt;</a></li>";
 }

// @ pack : check its 

 if($start>$max_page){
	$_li_create.="<li cclass=\"page-web-voice-normal\"  onClick=\"Ext.DOM.ViewStoreObjectData({page:(${start}-1), orderby :'${orderby}', type:'${type}'});\" ><a href=\"javascript:void(0);\">...</a></li>";
 }

// @ pack : check its 
 
 for( $p = $start; $p<=$end; $p++)
 { 
	if( $p == $select_pages ){ 
		$_li_create .="<li class=\"page-web-voice-current\" id=\"${p}\" onClick=\"Ext.DOM.ViewStoreObjectData({page:${p}, orderby :'${orderby}', type:'${type}'});\"> <a href=\"javascript:void(0);\">{$p}</a></li>";
	 } else {
		$_li_create .=" <li class=\"page-web-voice-normal\" id=\"${p}\" onClick=\"Ext.DOM.ViewStoreObjectData({page:${p}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\">{$p}</a></li>";
	}
 }

// @ pack : check its 
  
 if($end<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ViewStoreObjectData({page:${end}, orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" >...</a></li>";
 }

// @ pack : check its 
 
 if($select_pages<$total_pages){
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ViewStoreObjectData({page:(${select_pages}+1),  orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Next page\">&gt;</a></li>";
	$_li_create .="<li class=\"page-web-voice-normal\" onClick=\"Ext.DOM.ViewStoreObjectData({page:${total_pages},orderby :'${orderby}', type:'${type}'});\"><a href=\"javascript:void(0);\" title=\"Last page\">&gt;&gt;</a></li>";
 }
		
// @ pack : check its 
	
 $_li_create .="</ul></div>";
 echo "<tr>".
		"<td colspan='6'>{$_li_create}</td> ".
		"<td colspan='2'style='color:brown;' nowrap>". lang('button_record') ."&nbsp;: <span class='input_text' style='padding:2px;' id='ui-total-trans-record'>{$total_records}</span></td>".
	"</tr>	";
?>

</table>