<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
//  $pager ->select_row_field();
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
  // [CustomerId] => CustomerId
    // [CampaignName] => CampaignName
    // [CustomerNumber] => CustomerNumber
    // [CustomerFirstName] => CustomerFirstName
    // [full_name] => full_name
    // [AgentId] => AgentId
    // [CallReasonDesc] => CallReasonDesc
    // [PolicySalesDate] => PolicySalesDate
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'CampaignName' 		=> 'left',
	'CustomerNumber'	=> 'left',
	'PolicySalesDate' 	=> 'center',
	'CallReasonDesc' 	=> 'left',
	'CustomerFirstName' => 'left',
	'full_name'			=> 'left',
	'AgentId'			=> 'left',
	'AproveName'		=> 'left',
	'PolicyNumber'		=> 'left',
	'ApproveStatus'		=> 'left',
    'Duration'			=> 'center',
	'CustomerDOB'		=> 'center',
	'CustomerAge'		=> 'center'		
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CustomerFirstName' => array('_setCapital','_setBoldColor'),
	'PolicySalesDate' 	=> array('_getDateTime'),
	'CampaignName' 		=> array('showPolicy'),
	'full_name'			=> array('_setCapital','_setWordWrap'),
	'AgentId'			=> array('_setCapital','_setWordWrap'),
	'PolicyNumber'		=> array('_setBoldColor'),
	'Duration'			=> array('_getDuration'),
	'CustomerDOB'		=> array('_getDateIndonesia'),
	'CustomerAge'		=> array('_getAge')
	
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'showPolicy') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------

?>


<!-- <table width="100%" class="custom-grid" cellspacing="1">
<thead>
	<tr height="24"> 
		<th nowrap class="font-standars ui-corner-top ui-state-default first center" >&nbsp;<a href="javascript:void(0);">#</a></th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;No</th>			
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('e.CampaignName');">Campaign Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('e.CustomerNumber');">CIF</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('c.CustomerFirstName');">Customer Name</span></th>     
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('h.AproveName');">Approve Status</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('e.full_name');">Agent Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('b.PolicySalesDate');">Sales Date</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left">&nbsp;<span class="header_order" onclick="Ext.EQuery.orderBy('g.PolicySalesDate');">Days</span></th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $Approval = $quality[$rows['CallReasonQue']]['name'];
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
  $daysize = _getDateDiff(date('Y-m-d H:i:s'),$rows['PolicySalesDate']); 
?>
			<tr class="onselect" bgcolor="<?php echo $color;?>" style='cursor:pointer;'>
				<td class="content-first">
				<input type="checkbox" value="<?php echo $rows['CustomerId']; ?>" id="chk_cust_call" name="chk_cust_call" onclick="Ext.DOM.showPolicy(this.value)"></td>
				<td class="content-middle"><?php  echo $no; ?></td>
				<td class="content-middle"><?php  echo $rows['CampaignName']; ?></td>
				<td class="content-middle"><?php  echo $rows['CustomerNumber']; ?></td>
				
				<td class="content-middle" nowrap><?php echo $rows['CustomerFirstName']; ?></td>
				<td class="content-middle" nowrap><span style="color:#b14a06;font-weight:bold;"><?php echo strtoupper($Approval); ?></span></td>
				<td class="content-middle" nowrap><?php echo $rows['full_name']; ?></td>
				<td class="content-middle" nowrap><?php echo date('d-m-Y H:i:s',strtotime($rows['PolicySalesDate'])); ?></td>
				<td class="content-lasted center" style="color:red;">&plusmn;&nbsp;<?php echo $daysize['days_total'];?></td>
			</tr>
</tbody>
<?php
//echo $row -> CustomerId;
$no++;
};
?>
</table> -->



