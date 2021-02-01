<script>
$(document).ready(function(){
	$(".disabled").each(function(){
		var ObjectId = $(this).attr('id');
		Ext.Cmp(ObjectId).disabled(true);	
	});
 });
 </script>
<div id="panel-box-beneficiary" class="ui-widget-form-table-compact">
<form name="frmBenefiecery">
<?php foreach( $Benefiecery as $BeneficiaryId => $rows ) : ?>	
	<div class="ui-widget-form-table" id="panel-content-<?php echo $BeneficiaryId; ?>">
		<fieldset  class="corner" style="border-radius:5px;margin:-10px 0px 0px -20px; padding:5px 12px 5px 12px;">
		<?php echo form()->legend("Benefiecery ". form()->checkbox('BeneficiaryId','box', $BeneficiaryId, null, array('style'=>'margin-top:2px;', 'checked' => true, 'disabled'=>true)), "fa-info"); ?>
			<div class="ui-widget-form-table-compact">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> Salutation </div>
					<div class="ui-widget-form-cell"> <?php echo form()->combo("BenefSalutationId_{$BeneficiaryId}","select xchosen disabled long",Salutation(), $rows['SalutationId'] ); ?></div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> Beneficiary Name</div>
					<div class="ui-widget-form-cell"> <?php echo form()->input("BeneficiaryFirstName_{$BeneficiaryId}","input_text undisabled long",$rows['BeneficiaryFirstName']); ?> </div>
				</div>
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> Relation</div>
					<div class="ui-widget-form-cell">  <?php echo form()->combo("BenefRealtionship_{$BeneficiaryId}","select disabled xchosen long",Realtionship(), $rows['RelationshipTypeId'] ); ?> </div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> Gender </div>
					<div class="ui-widget-form-cell"> <?php echo form()->combo("BenefGender_{$BeneficiaryId}","select xchosen disabled long", Gender(), $rows['GenderId'] ); ?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> DOB </div>
					<div class="ui-widget-form-cell"> <?php echo form()->input("BeneficiaryDOB_{$BeneficiaryId}","input_text date disabled long",_getDateIndonesia($rows['BeneficiaryDOB']) ); ?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell"> Age </div>
					<div class="ui-widget-form-cell"> <?php echo form()->input("BeneficiaryAge_{$BeneficiaryId}","input_text disabled long",$rows['BeneficiaryAge']); ?></div>
				</div>
			</div>
		</fieldset>
	</div>	
<?php endforeach; ?>
</form>
</div>