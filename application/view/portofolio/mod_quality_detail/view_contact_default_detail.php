<form name="frmInfoCustomer">
	<?php echo form()->hidden('CustomerId',NULL, $Detail->get_value('CustomerId') );?>
	<?php echo form()->hidden('CustomerNumber',NULL, $Detail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerAge',NULL, $Detail->get_value('CustomerNumber') );?>
	<?php echo form()->hidden('CustomerDOB',NULL, $Detail->get_value('CustomerDOB') );?>
	<?php echo form()->hidden('CustomerFirstName',NULL, $Detail->get_value('CustomerFirstName') );?>
	<?php echo form()->hidden('GenderId',NULL, $Detail->get_value('GenderId') );?>
</form>
<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
	<?php echo form()->legend(lang(array('Approval','Parameter')), "fa-comments"); ?>
	<form name="frmApprovalParam">
		<div class="ui-widget-form-table-compact">
			<?php
			foreach(_getApprovalParam($Detail->get_value('CampaignId')) as $rows)
			{
				$styles = ($Result[$rows['ParamCode']]?array('checked'=>true):null);
			?>
			<div class="ui-widget-form-row baris1">
				<div class="ui-widget-form-cell center"><?php echo form()->checkbox($rows['ParamCode'],null,1,array('click'=>'Ext.DOM.SaveParam(this);'),$styles);?> </td></div>
				<div class="ui-widget-form-cell"><?=$rows['ParamLabel']?></div>
			</div>
			<?php
			}
			?>
		</div>
	</form>
</fieldset>