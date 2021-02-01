<?php 
/*
 * E.U.I 
 *
 
 * subject	: show menu view 
 * 			  extends under view model
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/view/menu/
 */
 
 //print_r($menu);
 // Array ( [id] => 1 [group_menu] => 1 [menu] => Cutoff Dates [file_name] => set_efectivedate_nav.php 
 // [el_id] => [description] => [flag] => 0 [updated_by] => [last_update] => [OrderId] => 9 
 // [GroupId] => 1 [GroupName] => SETTINGS [GroupShow] => 1 [GroupDesc] => Settings 
 // [CreateDate] => 2012-10-10 11:57:28 [UserCreate] => superuser [GroupOrder] => 0 ) 
$orders = array(); 
for($i=0; $i<=100;$i++){ $orders[$i] = $i;}
 
?> 
<form name="frmEditMenu">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Edit Menu</legend>
	<?php echo form()->hidden('menu_edit_id',null,$menu['id']); ?>
		<table border=0 cellspacing="6" >
			<tr>
				<td class="text_caption"> * Name </td> 
				<td><?php echo form()->input('menu_name_edit','input_text long',$menu['menu']); ?></td>
				<td class="text_caption"> Menu Id</td> 
				<td><?php echo form()->input('menu_id_edit','input_text long',$menu['el_id']); ?><span class="wrap" style="color:red;font-size:9px;"> *) Controller</span></td>
			</tr>	
			<tr>
				<td class="text_caption">* Controller</td> 
				<td><?php echo form()->input('menu_filename_edit','input_text long',$menu['file_name']); ?></td>
				<td class="text_caption"> Order By</td> 
				<td><?php echo form()->combo('menu_order_by','select box',$orders,$menu['OrderId']); ?></td>
			</tr>
			<tr>
				<td class="text_caption">* Group</td> 
				<td><?php echo form()->combo('menu_group_edit','select long',$group,$menu['group_menu']); ?></td>
			</tr>			
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="update button" value="Update" onclick="Ext.DOM.UpdateMenu();">
					<input type="button" class="close button" value="Close" onclick="Ext.Cmp('top_header').setText('');">
					</td>
			</tr>
		</table>
</fieldset>
	
	</div>	
</form>		