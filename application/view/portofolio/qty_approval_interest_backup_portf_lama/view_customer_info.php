
<fieldset class="corner" style="margin-top:-3px;"> 
<legend class="icon-menulist"> &nbsp;&nbsp;Customer Information</legend> 
<div id="quality_default_info" class="box-shadow box-left-top">
<form name="frmInfoCustomer">
<table width="99%" align="center" cellpadding="2px" cellspacing="4px">
	<tr>
		<td nowrap class="text_caption bottom">Customer Name</td>
		<td><?php __(form() -> input('CustomerFirstName','input_text long',$Customers['CustomerFirstName'],NULL,1));?> </td>
		<td class="text_caption bottom" nowrap>Card Type </td>
		<td><?php __(form() -> combo('CardTypeId','input_text long',$Combo['CardType'],$Customers['CardTypeId'],NULL,1)); ?></td>
		<td class="text_caption bottom" nowrap>Address3</td>
		<td><?php __(form() -> input('CustomerAddressLine3','input_text long',$Customers['CustomerAddressLine3'],NULL,1)); ?></td>
	</tr>
	<tr>
		<td class="text_caption bottom" nowrap >Gender</td>
		<td><?php __(form() -> combo('GenderId','input_text long',$Combo['Gender'], $Customers['GenderId'],NULL,1));?></td>
		<td class="text_caption bottom" nowrap>Address 1</td>
		<td><?php __(form() -> input('CustomerAddressLine1','input_text long',$Customers['CustomerAddressLine1'],NULL,1));?></td>
		<td class="text_caption bottom" nowrap>City  </td>
		<td><?php __(form() -> input('CustomerCity','input_text long',$Customers['CustomerCity'],NULL,1));?></td>
	</tr>
	<tr>
		<td class="text_caption bottom" nowrap >DOB </td>
		<td><?php __(form() -> input('CustomerDOB','input_text long',$Customers['CustomerDOB'],NULL,1));?></td>
		<td class="text_caption bottom" nowrap>Address 2</td>
		<td><?php __(form() -> input('CustomerAddressLine2','input_text long',$Customers['CustomerAddressLine2'],NULL,1));?></td>
		<td class="text_caption bottom" nowrap>ZIP code</td>
		<td><?php __(form() -> input('CustomerZipCode','input_text long',$Customers['CustomerZipCode'],NULL,1));?></td>
	</tr>
</table>	
</form>
</div>
</fieldset>	
<?php 

/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 * 
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 */

if( $Flexible =& _fldFlexibleLayout(5) ) 
{
	$Flexible -> _setTables('t_gn_bucket_customers'); // rcsorce data 
	$Flexible -> _setCustomerId(array('CustomerId' => $Customers['CustomerId'])); // set conditional array();
	$Flexible -> _Compile();
}
// END OFF
