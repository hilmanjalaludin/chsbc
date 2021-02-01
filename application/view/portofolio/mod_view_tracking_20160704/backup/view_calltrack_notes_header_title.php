<?php $out = new EUI_Object($call_title); ?>
<center>
	<p class="ui-report-title-24" style="line-height:8px;font-size:24px;color:#696868;"><?php echo $out->get_value('ReportName'); ?></p>
	<p class="ui-report-title-20" style="line-height:8px;font-size:20px;color:#696868;">Campaign : <?php echo $out->get_value('CampaignName'); ?></p>
	<p class="ui-report-title-16" style="line-height:8px;font-size:16px;color:#696868;">Period : <?php echo $out->get_value('StartDate'); ?> - <?php echo $out->get_value('EndDate'); ?></p>
	<p class="ui-report-title-14" style="line-height:8px;font-size:14px;color:#696868;">Print Date : <?php echo date('d M Y H:i:s');?></p>
</center>