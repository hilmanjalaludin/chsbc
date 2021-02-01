
<?php if ( _get_session("HandlingType") == USER_SUPERVISOR ): 
$display = "90%";
$display_accurate = "none";
else :
$display = "65%";
$display_accurate = "inline-block";
endif 
?>


<?php echo form()->hidden('ViewVerification',NULL, $Customers->get_value('ViewVerification') );?>
<?php echo form()->hidden('ViewProductInfo',NULL, $Customers->get_value('ViewProductInfo') );?>



<fieldset class="corner" style="display:inline-block;vertical-align:top;width:<?= $display; ?>;margin-top:10px;border-radius:5px;padding:5px 10px 10px 10px;">
<?php echo form()->legend(lang(array('Contact History')), "fa-info"); ?>
	
	<div class="ui-widget-form-cell" style="width:29%;vertical-align:top;">
		<?php $this ->load ->view('qty_approval_interest/view_quality_phone_detail');?>
	</div>

	<div id="tabs" class="history-tabs" style='border:1px solid #dddddd;'>
		<ul>
			<li class="ui-tab-li-none"><a href="#tabs-1"  id="aCallHistory">
				<span class="ui-icon ui-icon-person"></span> <?php echo lang(array('Call History'));?></a>
			</li>
			<li class="ui-tab-li-lasted"><a href="#tabs-2"  id="aRecording">
				<span class="ui-icon ui-icon-video"></span><?php echo lang(array('Recording'));?></a>
			</li>
			<li class="ui-tab-li-lasted"><a href="#tabs-3"  id="aHistoryScoring">
				<span class="ui-icon ui-icon-history"></span><?php echo lang(array('History Scoring'));?></a>
			</li>	
			<li class="ui-tab-li-lasted"><a href="#tabs-4"  id="aVerification">
				<span class="ui-icon ui-icon-person"></span><?php echo lang(array('Verification'));?></a>
			</li>		
			<li class="ui-tab-li-lasted"><a href="#tabs-5"  id="aProductInfo">
				<span class="ui-icon ui-icon-person"></span><?php echo lang(array('Product Information'));?></a>
			</li>		
		</ul>
		
		<div id="tabs-1" style="background-color:#FFFFFF;overflow:auto;"></div>
		<div id="tabs-2" style="background-color:#FFFFFF;overflow:auto;"></div>
		<div id="tabs-3" style="background-color:#FFFFFF;overflow:auto;"></div>
		<div id="tabs-4" style="background-color:#FFFFFF;overflow:auto;"></div>
		<div id="tabs-5" style="background-color:#FFFFFF;overflow:auto;"></div>

		
	</div>
</fieldset>



<form name="frmQualityActivity">
<fieldset class="corner" style="display:<?= $display_accurate; ?>;vertical-align:top;width:30%;margin-top:12px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Status Accurate')), "fa-pencil"); ?>

<input type="hidden" name="CustomerId" value="<?= $Customers->get_value("CustomerId"); ?>">


	<div class="ui-widget-form-table-compact">	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Status'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->combo('QualityStatus',
										 "select tolong xchosen ui-widget-qty-disabled ", 
										 array(
										 	"Is Accurate" => "Is Accurate" , 
										 	"No Accurate"  => "No Accurate"
										 ), 
										 $Accurate->get_value("StatusAccurate") , 
				array() ); ?>				
			</div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Remarks'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->textarea('RemarksAccurate','textarea ui-widget-qty uppercase tolong', $Accurate->get_value("RemarksAccurate") , null,array('style' => 'height:150px;color:#333BBB;'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button('ButtonbSave',"button save {$Disabled}",'Save', array("click" =>"Ext.DOM.SaveAccurate();"));?>
				<?php echo form()->button('ButtonbCancel','button cancel','Cancel', array("click" =>"Ext.DOM.CancelActivity();"));?>
			</div>
		</div>
	</div>
</fieldset>	
</form>

