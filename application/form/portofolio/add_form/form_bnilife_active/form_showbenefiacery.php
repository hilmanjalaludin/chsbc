<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @ def    : include transaction page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
 ?>

<div id="FrmBenefiaceryList" class="ui-widget-form-table-compact" style="width:99%;">
<table border=1 align="left" cellspacing="1" width="100%" style="margin-top:10px;">
<tr height=24>
	<th class="ui-corner-top ui-state-default first center"  WIDTH="2%">&nbsp;No.</td>
	<th class="ui-corner-top ui-state-default middle left"  WIDTH="15%">&nbsp;Benefiacery Namess</td>
	<th class="ui-corner-top ui-state-default middle left"  WIDTH="15%">&nbsp;Salutation</td>
	<th class="ui-corner-top ui-state-default middle left"  WIDTH="12%">&nbsp;GenderId</td>
	<th class="ui-corner-top ui-state-default middle left"  WIDTH="12%">&nbsp;DOB</td>
	<th class="ui-corner-top ui-state-default middle left"  >&nbsp;Relationship</td>
	<th class="ui-corner-top ui-state-default lasted left"  >&nbsp;Insured Name</td>
</tr>


<?php 
$i = 0; $no = 1;
if(is_array($ViewBenefiacery))
foreach($ViewBenefiacery as $rows ) 
{ 
	$color =( ($i%2)!=0 ? '#FFFEEE' :'#FFFFFF'); 
	$member = ( strlen($i)==1?"0{$no}":"$no");
?>

<tr class='onselect' 
	bgcolor='<?php __($color); ?>' 
	style='cursor:pointer;'>
	<td class="content-first"  WIDTH="12%"><?php __($i+1);?></td>
	<td class="content-middle"  WIDTH="12%"><?php __(strtoupper($rows['BeneficiaryFirstName']));?></td>
	<td class="content-middle" WIDTH="12%"><?php  __($Combo['Salutation'][$rows['SalutationId']]);?></td>
	<td class="content-middle"  WIDTH="12%"><?php __(strtoupper($Combo['Gender'][$rows['GenderId']]));?></td>
	<td class="content-middle"  WIDTH="12%"><?php __(strtoupper($rows['BeneficiaryDOB']));?></td>
	<td class="content-middle" WIDTH="12%"><?php  __(strtoupper($Combo['Realtionship'][$rows['RelationshipTypeId']]));?></td>
	<td class="content-lasted" WIDTH="12%"><?php  __(strtoupper($rows['InsuredFirstName']));?></td>
</tr>	

<?php $i++; $no++; } ?>
</table>
</div>