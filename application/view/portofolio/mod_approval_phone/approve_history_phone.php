	
<fieldset class="corner" style="border-radius:5px;padding:8px 8px 8px 8px;margin:-10px 0px 0px 0px;">
<?php echo form()->legend(lang('Customer History'), "fa-user"); ?>
	<div id="ui-content-tabs-history">
		<ul>
			<li class='ui-tab-li-none'><a href="#tabs-1" id="aCallHistory">
				<span class="ui-icon ui-icon-person"></span> Call History</a></li>
			<li class='ui-tab-li-lasted'><a href="#tabs-2" id="aRecording">
				<span class="ui-icon ui-icon-person"></span> Recording</a></li>
		</ul>
		
		<div id="tabs-1" style="background-color:#FFFFFF;width:300ppx;"></div>
		<div id="tabs-2" style="background-color:#FFFFFF;width:300ppx;"></div>
	</div>
</fieldset>	
	