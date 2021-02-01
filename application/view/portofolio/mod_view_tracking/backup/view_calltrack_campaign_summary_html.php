<?php $this->load->view("mod_view_tracking/view_calltrack_header_table_summary_html"); ?>
<?php 

// ------------------- load content ------------------
$css_val = "xl7010476";
$xls_val = 0;
if( is_array($call_content) )  
	foreach( $call_content as $CampaignId => $rows )
{


 $bg_color = ( $xls_val % 2 == 1 ? "#FFFFFF" : "#FFFFEE");
 $row = new EUI_Object($rows);
	

 $campaign_utilize_name  = $row->get_value('CampaignName');
 $tot_new_assigned_data  = $row->get_value('data_not_utilize');
 
//---------------------------------------------------------------------------------------------------
 $tot_de_assigned_data 	= 0;
 $tot_re_assigned_data 	 = 0;
 $tot_solicited_new_assign = 0;
 $tot_solicited_reutilized 	= 0;
 $tot_solicited_per_utilized  = 0;
 
// ----------------------------------------------------------------------	
	
echo "<tr height=28 bgcolor={$bg_color}>
	  <td class={$css_val} style='border-top:none;text-align:left;' nowrap>{$campaign_utilize_name}</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>{$tot_new_assigned_data}</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'> </td>
	  <td class={$css_val} style='border-top:none;border-left:none;'></td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
	  <td class={$css_val} style='border-top:none;border-left:none;'>&nbsp;</td>
 </tr>";
 
 $xls_val++;
}

?>
<!-- load footer table --> 

<?php $this->load->view("mod_view_tracking/view_calltrack_footer_table_summary_html"); ?>