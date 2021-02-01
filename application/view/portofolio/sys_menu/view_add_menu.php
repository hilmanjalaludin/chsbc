<?php 
/*
 * E.U.I 
 *
 
 * subject	: show menu view 
 * 			  extends under view model
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/view/menu/
 */
 
$orders = array(); 
for($i=0; $i<=100;$i++){ 
	$orders[$i] = $i; 
}

?> 
<form name="frmAddMenu">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Menu</legend>
	
		<table border=0 cellspacing="6">
			<tr>
				<td class="text_caption">Name </td> 
				<td><?php echo form()->input('menu_name_add','input_text long',null); ?></td>
				<td class="text_caption"> Menu Id</td> 
				<td><?php echo form()->input('menu_id_add','input_text long',null); ?></td>
			</tr>	
			<tr>
				<td class="text_caption">Controller</td> 
				<td><?php echo form()->input('menu_filename_add','input_text long',null); ?></td>
				<td class="text_caption"> Order By</td> 
				<td><?php echo form()->combo('menu_order_by','select box',$orders,null); ?></td>
			</tr>
			<tr>
				<td class="text_caption">Group</td> 
				<td><?php echo form()->combo('menu_group_add','select long',$group,null); ?></td>
			</tr>		
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="save button" value="Save" onclick="Ext.DOM.SaveMenu();">
					<input type="button" class="close button" value="Close" onclick="Ext.Cmp('top_header').setText('');">
				</td>
			</tr>
		</table>

</fieldset>
	</div>	
</form>	