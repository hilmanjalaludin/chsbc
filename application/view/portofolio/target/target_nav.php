<?php
	$this->load->view('target/target_js');
?>
<form name="target">
	<fieldset class="corner" style='margin-top:-10px;'>
	<legend class="icon-menulist">&nbsp;&nbsp; Daily Target</legend>
		<table cellspacing=0 width='80%' align="center">
			<tr>
				<th class='ui-corner-top ui-state-default center th-first' rowspan=2>&nbsp;<b><a href="javascript:void(0);" onclick="Ext.Cmp('listID').setChecked();"> #</a></b></th>
				<th class='ui-corner-top ui-state-default center th-middle' rowspan=2>&nbsp;<b>No.</b></th>
				<th class='ui-corner-top ui-state-default center th-middle' rowspan=2>&nbsp;<b>User</b></th>
				<th class='ui-corner-top ui-state-default center th-middle' rowspan=2>&nbsp;<b>Online Name</b></th>
				<th class='ui-corner-top ui-state-default center th-middle' colspan=2>&nbsp;<b>PIF Target</b></th>
				<th class='ui-corner-top ui-state-default center th-lasted' colspan=2>&nbsp;<b>ANP Target</b></th>
			</tr>
			<tr>
				<th class='ui-corner-top ui-state-default center th-middle'>&nbsp;<b>Current Target</b></th>
				<th class='ui-corner-top ui-state-default center th-middle'>&nbsp;<b>Next Target</b></th>
				<th class='ui-corner-top ui-state-default center th-middle'>&nbsp;<b>Current Target</b></th>
				<th class='ui-corner-top ui-state-default center th-middle'>&nbsp;<b>Next Target</b></th>
			</tr>
			<?php
				$no = 1;
				foreach($User as $UserId => $rows) {
			?>
			<tr>
				<td class='content-first center' width="10%">&nbsp;<?php __( form()->checkbox('listID',null,$rows['UserId'],array('click'=>'Ext.DOM.Disable(this,'. $rows['UserId'] .');')) ); ?></th>
				<td class='content-middle center' width="10%"><?php echo $no; ?></td>
				<td class='content-middle left' width="40%">&nbsp;<?php echo $rows['full_name']; ?></td>
				<td class='content-middle left' width="40%">&nbsp;<?php echo $rows['init_name']; ?></td>
				<td class='content-lasted center'><?php echo form()->input('CurrPIFTarget','input_text',$Target[$UserId]['PIF'],null,array('disabled' => true));?></td>
				<td class='content-lasted center'><?php echo form()->input('PIFTarget_'.$rows['UserId'],'input_text',null,null,array('disabled' => true));?></td>
				<td class='content-lasted right'><?php echo form()->input('CurrANPTarget','input_text',$Target[$UserId]['ANP'],null,array('disabled' => true));?></td>
				<td class='content-lasted right'><?php echo form()->input('ANPTarget_'.$rows['UserId'],'input_text',null,null,array('disabled' => true));?></td>
			</tr>
			<?php
					$no++;
				}
			?>
			<tr>
				<td>
					<?php __(form()->button('','page-go button','Save',array("click"=>"Ext.DOM.SaveTarget();") ));?>
				</td>
			</tr>
		</table>
	</fieldset>
</form>