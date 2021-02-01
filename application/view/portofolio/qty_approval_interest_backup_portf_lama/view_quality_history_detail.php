<fieldset class="corner" style="margin-top:10px;border-radius:5px;padding:5px 10px 10px 10px;">
<?php echo form()->legend(lang(array('Contact History')), "fa-info"); ?>
	<div id="tabs" class="history-tabs" style='border:1px solid #dddddd;'>
		<ul>
			<li class="ui-tab-li-none"><a href="#tabs-1"  id="aCallHistory">
				<span class="ui-icon ui-icon-person"></span> <?php echo lang(array('Call History'));?></a></li>
			<li class="ui-tab-li-lasted"><a href="#tabs-2"  id="aRecording">
				<span class="ui-icon ui-icon-video"></span><?php echo lang(array('Recording'));?></a></li>
		</ul>
		
		<div id="tabs-1" style="background-color:#FFFFFF;overflow:auto;"></div>
		<div id="tabs-2" style="background-color:#FFFFFF;overflow:auto;"></div>
		
	</div>
</fieldset>