<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:-12px 5px 5px 5px; border-radius:5px;">
<?php echo form()->legend(lang("Direct Call"),"fa-phone");?>
<div class="ui-widget-form-table" style="padding:4px 8px 8px 8px;margin-right:6px;">
<form name="frmFreeCallDial">
	<table align="left" class="custom-grid"  style="border:0px solid #dddddd;" cellSpacing=0 width="100%">
	<tr>
		<td colspan="3" class="content-first border-none">
		<?php echo form() -> textarea("call_to_number_id","textarea",null,array("keyup"=>'ValidCallNumber(this);'), array("style" => "font-size:14px;color:green;font-weight:bold;height:70px;width:95%;padding-left:2px;")); ?></td>
	</tr>
	<tr>
		<td class="content-first border-none"  align="center"><?php echo form()->button("btnDial","button dial", "&nbsp;Dial&nbsp;", array("click" => "new ButtonDial();"), array("style"=>"width:99%;cursor:pointer;"));?></td>
		<td class="content-middle border-none" align="center"><?php echo form()->button("btnDial","button hangup", "&nbsp;Hangup&nbsp;", array("click" => "new ButtonHangup();"),array("style"=>"width:99%;cursor:pointer;"));?></td>
		<td class="content-lasted border-none" align="center"><?php echo form()->button("btnDial","button remove", "&nbsp;Delete&nbsp;",array("click" => "new ButtonClear();"),array("style"=>"width:99%;cursor:pointer;"));?></td>
	</tr>
	<tr>
		<td class="content-first border-none" align="center"><?php echo form()->button("1",null,1,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-middle border-none" align="center"><?php echo form()->button("2",null,2,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-lasted border-none" align="center"><?php echo form()-> button("3",null,3,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
	</tr>
	<tr>
		<td class="content-first border-none" align="center"><?php echo form()->button("4",null,4,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-middle border-none" align="center"><?php echo form()->button("5",null,5,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-lasted border-none" align="center"><?php echo form()->button("6",null,6,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		</tr>
	<tr>
		<td class="content-first border-none" align="center"><?php echo form() -> button("7",null,7,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-middle border-none" align="center"><?php echo form() -> button("8",null,8,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-lasted border-none" align="center"><?php echo form() -> button("9",null,9,array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
	</tr>
	
	<tr>
		<td class="content-first border-none" align="center"><?php echo form() -> button("0",null,'0',array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-middle border-none" align="center"><?php echo form() -> button("#",null,'#',array("click"=>'SetCallNumber(this);'), array("style"=>"width:99%;cursor:pointer;")); ?></td>
		<td class="content-lasted border-none" align="center">
			<?php echo form() ->button("*",null,'*',array("click"=>'SetCallNumber(this);'), array("style"=>"width:49%;cursor:pointer;")); ?>
			<?php echo form() ->button("C",null,'C',array("click"=>'ClearCallNumber(this);'), array("style"=>"width:46%;cursor:pointer;")); ?>
		</td>
	</tr>
	
	<tr>
		<td colspan="3" class="content-first border-none" align="center"> 
			<span style="color:red;">Remarks</span>
		<td>
	</tr>
	
	<tr>
		<td colspan="3" class="content-first border-none" align="center">
		<?php echo form() -> textarea("call_free_remark","textarea uppercase",null,null, array("style" => "font-size:12px;height:70px;width:95%;padding-left:2px;")); ?></td>
	</tr>
	
	<tr>
		<td colspan="3" class="content-first border-none" align="center">
			<?php echo form()->button("btnSave","button save", "Save Activity", array("click" => "new SaveCallActivity();"), array("style"=>"cursor:pointer;"));?> 
		<td>
	</tr>
	
	</table>	
	</form>
</div>
</fieldset>