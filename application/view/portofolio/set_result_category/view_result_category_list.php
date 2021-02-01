<?php 

 $this->load->helpers("EUI_Object");

 $rs = new EUI_Object( $page -> result_assoc() );
// -------------------------------------------------------------
 page_background_color('#FFFCCC');
 page_font_color('#8a1b08');

// --------------------------------------------------------------
/* 
	'CallReasonCategoryCode' => 'left',
	'CallReasonCategoryName' => 'left',
	'CallReasonInterest' => 'left',
	'CallDirection' => 'left',
	'Sorter' => 'center',
	'Flags' => 'left'
 */
 page_set_align('CallReasonCategoryCode', 'left');
 page_set_align('CallReasonCategoryName', 'left');
 page_set_align('CallReasonInterest', 'left');
 page_set_align('CallDirection', 'left');
 page_set_align('Sorter', 'center');
 page_set_align('Flags', 'left');
 
 
// --------------------------------------------------------------
 $arr_func = array 
 (	
    'CallReasonCategoryCode' => array('_setBoldColor')
 );
 
// --------------------------------------------------------------
 $arr_width = array( ); 
// --------------------------------------------------------------
 $arr_wrap = array (	
	'CallReasonCategoryCode' => 'nowrap',
	'CallReasonCategoryName' => 'nowrap',
	'CallDirection' => 'nowrap',
	'Sorter' => 'nowrap',
	'Flags' => 'nowrap',	
 );
 
// ----------------------------------------

$labels	 =&page_labels();
$primary =&page_primary();
$aligns	 =&page_get_align();
$border  =&page_border();

// --------------------------chekced grid argument -------------------
/* $rsRole =& new EUI_Object($role);
$IsRole =& page_set_role(
	$rsRole->get_value('event'), $primary
); */

//----------------- header grid -----------------------------------
echo " <table width=\"100%\" class=\"custom-grid\" cellspacing=\"0\">".
	"<thead>".
	"<tr height=\"26\"> ".
		"<th nowrap class=\"font-standars ui-corner-top ui-state-default th-first center\" width=\"3%\"><a href=\"javaScript:void(0);\"><i class=\"fa fa-check-square\"></i></a></th>".	
		"<th nowrap class=\"font-standars ui-corner-top ui-state-default th-middle center\">&nbsp;No</th>";
		
		if( is_array($labels) )
			foreach( $labels as $Field => $LabelName) {
			$class =& page_header($Field); 
			echo "<th nowrap class=\"font-standars ui-corner-top ui-state-default th-$border[$Field] $border[$Field] $aligns[$Field]\" $arr_width[$Field]>".
					"<span class=\"header_order $class\"  onclick=\"Ext.EQuery.orderBy('$Field');\">&nbsp;$LabelName</span>".
				 "</th>";
		}
		
	echo "</tr>".
			"</thead>".	
		"<tbody>";

// --------------- on content -----------------------
$_new = explode(',',_getConfigValue('CALL_STATUS','STATUS_NEW'));
		
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
	$row =& new EUI_Object($rows); 
	
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
	echo "<tr class=\"onselect\" bgcolor=\"${color}\">".
		 "<td class=\"content-first center\">". form()->checkbox($primary, NULL, $row->get_value($primary),array('change'=>"Ext.Cmp('{$primary}').oneChecked(this);"),(in_array($row->get_value($primary),$_new)?array('disabled'=>true):null))."</td>".
		 "<td class=\"content-middle center\">${no}</td>";
			
// ----------------- label on the grid -------------------------------------------
	
	if(is_array( $labels ) ) 
		foreach( $labels as $Field => $LabelName )
	{
		$arr_color=& page_column($Field); 
		echo "<td class=\"content-$border[$Field] $aligns[$Field]\" $arr_color $arr_wrap[$Field]>". $row->get_value($Field,$arr_func[$Field])."</td>";
	}	
	
	echo "</tr>	\n".
			"</tbody>";
	$no++;
}


echo "</table>";


