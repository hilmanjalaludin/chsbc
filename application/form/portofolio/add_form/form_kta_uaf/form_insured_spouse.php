<?php 
  $prefixkey = join("_", array(INS_CODE_SPOUSE,1));
  $selector  = join("_", array("form", INS_CODE_SPOUSE,1)); 
  $spouse   = new EUI_object($Insured[$prefixkey]);
  $checkbox  = ($spouse->fetch_ready() ? array('checked' => true) : null);
  ?>
<fieldset class="corner" style="margin:5px 5px 10px 5px; padding:5px 8px 15px 8px;border-radius:5px;">
<?php echo form()->legend(lang("Spouse"),"fa-user");?>
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required"></div>
			<div class="ui-widget-form-cell left"><?php echo form()->checkbox("GroupPremi","ui-class-widget-box",$prefixkey, array('click'=> 'SetInsuredChecked(this);SetPremiPersonal(this);'), $checkbox);?> </div>
		</div>
	</div>
	
	<div class="ui-widget-form-table">	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* Relation</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("RelationshipTypeId",$prefixkey)),"select long $selector dfl-disabled zx-select",Realtionship(),  $spouse->get_value('RelationshipTypeId')); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Title</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("SalutationId",$prefixkey)),"select long $selector dfl-disabled zx-select",Salutation(),$spouse->get_value('SalutationId')); ?></div>
		</div>	
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* First Name</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->input(join("_", array("InsuredFirstName",$prefixkey)), "input_text $selector long dfl-disabled uppercase", $spouse->get_value('InsuredFirstName')); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">*Gender</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("GenderId",$prefixkey)), "select long $selector dfl-disabled zx-select", ProductGender(_get_post('ProductId')),$spouse->get_value('GenderId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption">DOB</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("InsuredDOB",$prefixkey)),"input_text long $selector dfl-disabled insured-dob",$spouse->get_value('InsuredDOB'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Age</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("InsuredAge",$prefixkey)),"input_text $selector long dfl-disabled", $spouse->get_value('InsuredAge'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Premi</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("SubmitedPremi",$prefixkey)),"input_text long dfl-disabled $selector", $spouse->get_value('PolicyPremi','_getCurrency'));?></div>
		</div>
	</div>
</fieldset>	