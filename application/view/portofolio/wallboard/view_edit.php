<?php
/*
 * E.U.I 
 *
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
?>

<form name="frmEditCores">
<div class="box-shadow" style="padding:10px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Campaign Cores </legend>
<table cellpadding="4px;">
<tr>
	<input type="hidden" id="id" name="id" value="<?php echo $qry[0]->id ?>">
	<td class="text_caption">* Daily Today Target</td>
	<td><?php echo form() -> input('daily_today','input_text long',$qry[0]->daily_today,NULL,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
	
</tr>
<tr>
	<td class="text_caption">* MTD H-1</td>
	<td><?php echo form() -> input('mtd_h1','input_text long',  $qry[0]->mtd_h1, NULL ,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
</tr>
<tr>
	<td class="text_caption">* Monthly Target</td>
	<td><?php echo form() -> input('month_target','input_text long',$qry[0]->month_target, NULL ,array('style'=>'height:18px;width:160px;color:#000000;border:1px solid red;') ); ?></td>
</tr>
<tr>
	<td class="text_caption">* Product </td>
	<td> 
	<select name="product" id="product" style="height:21px;width:100px;color:#000000;border:1px solid red;" class="select">
	<?php 
	if($qry[0]->product=='cip') { ?>
	<option value="cip" selected>CIP</option>
	<option value="pil">PIL</option>
	<?php	
	}else { ?>
	<option value="pil" selected>PIL</option>
	<option value="cip">CIP</option>
	<option value="bestbill">BEST BILL</option>
	<?php } ?>
	
	</select>
	</td>
</tr>			
<tr>
	<td>&nbsp;</td>
	<td> 
			<input type="button" class="save button" onclick="UpdateCores();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('panel-content').setText('');" value="Close">
		</td>
	</tr>	
</table>
</fieldset>
</div>
</form>
