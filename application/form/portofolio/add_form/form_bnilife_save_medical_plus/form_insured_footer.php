<!--<#?php if(in_array(INS_CODE_DEPEND, array_keys($row_content))) {  ?>-->

<form name="frmDependentInsured">
<fieldset class="corner" style="margin:10px 5px 10px 5px; padding:5px -5px 15px 8px;border-radius:5px;">
<?php echo form()->legend(lang("Dependant"),"fa-child");?>

<?php 
	for( $INT_CODE_DEPEND = 1; $INT_CODE_DEPEND<=4; $INT_CODE_DEPEND++ ) 
{
	$selector = join("_", array("form", INS_CODE_DEPEND, $INT_CODE_DEPEND));  
	$prefixkey = join("_", array(INS_CODE_DEPEND,$INT_CODE_DEPEND));  
	$outputs =& new EUI_object($Insured[$prefixkey]);
	$checkbox = ( $outputs->fetch_ready() ? array('checked' => true) : null);
	
?>
	<div class="ui-widget-form-table" style="padding:8px 25px 8px 5px;margin:5px -5px 5px 0px;">	
			<div class="ui-widget-form-table">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption required"></div>
				<div class="ui-widget-form-cell left"><?php echo form()->checkbox("GroupPremi","ui-class-widget-box",join("_", array($prefixkey)), array('click'=> 'SetInsuredChecked(this);SetPremiPersonal(this);'), $checkbox);?> </div>
			</div>
		</div>
		
		<div class="ui-widget-form-table">	
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption required">* Relation</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("RelationshipTypeId",$prefixkey)),"select long zx-select dfl-disabled $selector",Realtionship(),$outputs->get_value('RelationshipTypeId')); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Title</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("SalutationId",$prefixkey)),"select long zx-select dfl-disabled $selector",Salutation(),$outputs->get_value('SalutationId')); ?></div>
			</div>	
				
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption required">* First Name</div>
				<div class="ui-widget-form-cell left"> <?php echo form()->input(join("_", array("InsuredFirstName",$prefixkey)), "input_text long dfl-disabled uppercase $selector",$outputs->get_value('InsuredFirstName')); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption required">*Gender</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("GenderId",$prefixkey)), "select long zx-select dfl-disabled $selector", ProductGender(_get_post('ProductId')),$outputs->get_value('GenderId'));?></div>
			</div>
			
			<div class="ui-widget-form-row">	
				<div class="ui-widget-form-cell text_caption">DOB</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("InsuredDOB",$prefixkey)),"input_text long dfl-disabled insured-dob $selector", $outputs->get_value('InsuredDOB'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Age</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("InsuredAge",$prefixkey)),"input_text long dfl-disabled $selector", $outputs->get_value('InsuredAge'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Premi</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("SubmitedPremi",$prefixkey)),"input_text long dfl-disabled $selector", $outputs->get_value('PolicyPremi','_getCurrency'));?></div>
		</div>
		</div>
	</div>	
<?php }  ?>
</fieldset>
</form>
<!-- <#?php }  ?> -->
