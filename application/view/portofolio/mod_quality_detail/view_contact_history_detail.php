<div style="overflow:auto;margin-top:15px;" class="contact-history">
	<div id="tabs" class="corner" class="history-tabs">
		<ul>
			<li class="ui-tab-li-lasted"><a href="#tabs-1"><span class="ui-icon ui-icon-person"></span><?php echo lang('Call History');?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-6"><span class="ui-icon ui-icon-person"></span><?php echo lang('Recording');?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-2"><span class="ui-icon ui-icon-person"></span><?php echo lang('Verification');?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-3"><span class="ui-icon ui-icon-person"></span><?php echo lang('Product Info');?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-7"><span class="ui-icon ui-icon-person"></span><?php echo lang('Customer Info');?></a></li>
			<!--<li class="ui-tab-li-lasted"><a href="#tabs-4"><span class="ui-icon ui-icon-person"></span><x?php echo lang('Referral');?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-5"><span class="ui-icon ui-icon-person"></span><x?php echo lang('Best Bill');?></a></li>-->
		</ul>
			
		<div id="tabs-1" style="background-color:#FFFFFF;height:400px;overflow:auto;"></div>
		<div id="tabs-6" style="background-color:#FFFFFF;height:400px;overflow:auto;">
		
		</div>
		<div id="tabs-2" style="background-color:#FFFFFF;height:400px;overflow:auto;"></div>
		<div id="tabs-3" style="background-color:#FFFFFF;height:400px;overflow:auto;"></div>
		<div id="tabs-7" style="background-color:#FFFFFF;height:400px;overflow:auto;">
			<?php $this ->load ->view('mod_quality_detail/view_customer_info');?>
		</div>
		<!--<div id="tabs-4" style="background-color:#FFFFFF;height:400px;overflow:auto;">Under Construction!</div>
		<div id="tabs-5" style="background-color:#FFFFFF;height:400px;overflow:auto;">Under Construction!</div>-->
	</div>
</div>