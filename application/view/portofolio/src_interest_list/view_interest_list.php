<?php
	require(dirname(__FILE__)."/../sisipan/sessions.php");
	require(dirname(__FILE__)."/../fungsi/global.php");
	require(dirname(__FILE__)."/../class/MYSQLConnect.php");
	require(dirname(__FILE__)."/../class/class.list.table.php");
	require(dirname(__FILE__)."/../class/class.query.parameter.php");
	require(dirname(__FILE__).'/../sisipan/parameters.php');
	
	
	SetNoCache();
	
	
/** get all status ***/

	function get_value_status()
	{
		$query = new ParameterQuery();
		if( is_object($query))
		{
			return $query -> ImplodeStatus();
		}
	}
	
/** get info data **/
	
	
	function getLastBySpv($CustomerId='',$spv_id=''){
		global $db;
		
		$V_DATAS = '-';
		
		if( $CustomerId !=''):
			$sql = "SELECT a.CallHistoryNotes, b.id, b.full_name  FROM t_gn_callhistory a 
					left join tms_agent b on a.CreatedById=b.UserId
						where a.CustomerId='".$CustomerId."'
						and b.handling_type NOT IN(4,5,2)
						order by a.CallHistoryId DESC LIMIT 1 ";
						
			$qry = $db ->execute($sql,__FILE__,__LINE__);	
			if( $qry && ($row=$db ->fetchrow($qry))){
				$V_DATAS = 'Re-Confirm ( '.$row->id.' )'; 
			}
			else{
				$sql2 = " select concat(a.id,' - ',a.full_name) as name from tms_agent a where a.UserId='".$spv_id."'";
				$res  = $db->valueSQL($sql2);
			}	if($res!='') $V_DATAS = $res;
		endif;	
		
		return $V_DATAS;
	}

	function getSpvName($spv_id=''){
		global $db;
		if( $spv_id!=''){
			$sql = " select concat(a.id,' - ',a.full_name) as name from tms_agent a where a.UserId='".$spv_id."'";
			$name = $db->valueSQL($sql);
			if( $name !=''){
				return '<span style="color:red;">'.$name.'</span>';
			}
			else return '-'; 	
		}
	}
	
	function getLastHistory($customerId=''){
		global $db;
		$sql = " select a.CallHistoryNotes, a.CallHistoryCreatedTs from t_gn_callhistory a
			where a.CustomerId =".$customerId."
			order by a.CallHistoryCreatedTs DESC LIMIT 1 ";
		$notes = $db -> valueSQl($sql);
		if( $notes!='') return $notes;
		else 
			return '-';
	}
	
	$status = array(16,17);
	
 /** set properties pages records **/
	
	$ListPages -> setPage(15);
	$ListPages -> pages = $db -> escPost('v_page'); 
	
 /** set  genral query SQL  **/
 
	$sql = " select 
				distinct(a.PolicyNumber),
				c.CustomerId, c.CampaignId, c.CustomerNumber,
				c.CustomerFirstName, e.CampaignNumber, f.AproveName,
				e.CampaignName,
				b.PolicySalesDate, h.id, h.full_name,
				IF(f.AproveName is null,'Request Confirm', f.AproveName) as  AproveName
				FROM t_gn_policyautogen a
				 left join t_gn_policy b on a.PolicyNumber=b.PolicyNumber
				 left join t_gn_customer c on a.CustomerId=c.CustomerId
				 left join t_gn_assignment d on a.CustomerId=d.CustomerId
				 left join t_gn_campaign e on c.CampaignId=e.CampaignId
				 left join t_lk_aprove_status f on c.CallReasonQue=f.ApproveId
				 left join tms_agent h on d.AssignSelerId=h.UserId ";
				 
	
	$ListPages -> query($sql);
		
 /** create set filter SQL if found **/	
 
		$filter =  " AND c.CallReasonId IN(".get_value_status().") 
				 AND d.AssignAdmin is not null 
				 AND d.AssignMgr is not null 
				 AND d.AssignSpv is not null
				 AND ( c.CallReasonQue IS NULL OR c.CallReasonQue='".$db -> Entity -> VerifiedConfirm()."')
				 AND d.AssignBlock=0  ";
				 
	
	
	
	if( $db->getSession('handling_type')==3 )			 
		$filter.=" AND d.AssignSpv ='".$db -> getSession('UserId')."' ";
		
	if( $db->getSession('handling_type')==4)
		$filter.=" AND d.AssignSelerId = '".$db->getSession('UserId')."'";
				 

/** filtering session **/
					
	if( $db->havepost('cust_name') ) 
		$filter.=" AND c.CustomerFirstName LIKE '%".$db->escPost('cust_name')."%'"; 
	
	if( $db->havepost('cust_number') ) 
		$filter.=" AND c.CustomerNumber LIKE '%".$db->escPost('cust_number')."%'"; 
		
	
	if( $db->havepost('campaign_id') )
		$filter.=" AND c.CampaignId =".$db->escPost('campaign_id');	
	
	if( $db->havepost('category_id') )
		$filter.=" AND e.CategoryId =".$db->escPost('category_id');	

	if( $db->havepost('start_date') && $db->havepost('end_date') )
		$filter .= " AND date(b.PolicySalesDate)>= '".$db->formatDateEng($_REQUEST['start_date'])."' 
					 AND date(b.PolicySalesDate)<= '".$db->formatDateEng($_REQUEST['end_date'])."' "; 
	
	
	if($db->havepost('user_id'))
		$filter.=" AND d.AssignSelerId = '".$db->escPost('user_id')."'";
		

    if( $db->havepost('call_result'))
		$filter .=" AND c.CallReasonId ='".$db->escPost('call_result')."'"; 
	
	
	$ListPages -> setWhere($filter);
	
 /* order by ****/
	$ListPages -> OrderBy($db-> escPost('order_by'),$db -> escPost('type'));
	$ListPages -> setLimit();
	$ListPages -> result();
	//echo $ListPages -> query;
	
	SetNoCache();
	
	

?>			
<style>
	.wraptext{color:green;font-size:11px;padding:3px;width:120px;}
	.wraptext:hover{color:blue;}
</style>
<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" >&nbsp;<a href="javascript:void(0);" onclick="doJava.checkedAll('chk_cust_call');">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>			
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('e.CampaignName');">Campaign Name</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('c.CustomerFirstName');">Customer Name</span></th>     
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('h.AproveName');">Approve Status</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('e.full_name');">Agent Name</span></th>
		<th nowrap class="custom-grid th-middle" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('b.PolicySalesDate');">Sales Date</span></th>
		<th nowrap class="custom-grid th-lasted" style="text-align:left;">&nbsp;<span class="header_order" onclick="extendsJQuery.orderBy('g.PolicySalesDate');">Days</span></th>
	</tr>
</thead>	
<tbody>
	<?php
		$no = (($ListPages -> start) + 1);
		while($row = $db ->fetchrow($ListPages->result))
		{
			$diff_days = $db -> Date -> get_date_diff(date('Y-m-d'),$row -> PolicySalesDate);
			$color= ($no%2!=0?'#FAFFF9':'#FFFFFF');
	?>
			<tr class="onselect" bgcolor="<?php echo $color;?>">
				<td class="content-first">
				<input type="checkbox" value="<?php echo $row -> CustomerId; ?>" name="chk_cust_call" name="chk_cust_call"></td>
				<td class="content-middle"><?php  echo $no; ?></td>
				<td class="content-middle"><div style="width:100px;"><?php  echo $row -> CampaignName; ?></div></td>
				<td class="content-middle" nowrap><?php echo $row -> CustomerFirstName; ?></td>
				<td class="content-middle" nowrap><span style="color:#b14a06;font-weight:bold;"><?php echo strtoupper($row -> AproveName); ?></span></td>
				<td class="content-middle" nowrap><?php echo $row -> full_name; ?></td>
				<td class="content-middle" nowrap><?php echo $row -> PolicySalesDate; ?></td>
				<td class="content-lasted" style="color:red;">+<?php echo $diff_days -> days();?></td>
			</tr>
</tbody>
	<?php
		//echo $row -> CustomerId;
		$no++;
		};
		
	?>
</table>


