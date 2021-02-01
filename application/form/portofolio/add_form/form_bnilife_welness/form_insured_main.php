<?php 
if( in_array(INS_CODE_MAIN, array_keys($row_content)))
{  
	$prefixkey 	= join("_", array(INS_CODE_MAIN,1));
	$selector 	= join("_", array("form", $prefixkey)); 
	$outputs 	= new EUI_object($Insured[$prefixkey]);
	$checkbox  	= ($outputs->fetch_ready() ? array('checked' => true) : null);
	
?>
<fieldset class="corner" style="margin:5px 5px 10px -5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Main Insured"),"fa-user");?>
	
	<div class="ui-widget-form-table">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required"></div>
			<div class="ui-widget-form-cell left"><?php echo form()->checkbox("GroupPremi",null,$prefixkey, array('click'=> 'SetInsuredChecked(this);'), $checkbox);?> </div>
		</div>
	</div>
	
	<div class="ui-widget-form-table">	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* Relation</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("RelationshipTypeId",$prefixkey)),"select long  zx-select dfl-disabled $selector", Realtionship(), $outputs->get_value('RelationshipTypeId') ); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Title</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("SalutationId",$prefixkey)),"select long  zx-select dfl-disabled $selector",Salutation(),$outputs->get_value('SalutationId')); ?></div>
		</div>	
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">* First Name</div>
			<div class="ui-widget-form-cell left"> <?php echo form()->input(join("_", array("InsuredFirstName",$prefixkey)), "input_text long dfl-disabled uppercase $selector", $outputs->get_value('InsuredFirstName')); ?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption required">*Gender</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo(join("_", array("GenderId",$prefixkey)), "select long  zx-select dfl-disabled $selector", ProductGender(_get_post('ProductId')), $outputs->get_value('GenderId'));?></div>
		</div>
		
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption">DOB</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input(join("_", array("InsuredDOB",$prefixkey)),"input_text long $selector insured-dob ui-widget-disabled-data",$outputs->get_value('InsuredDOB'),null,array('disabled'=>true));?></div>
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
</fieldset>	
<?php }; ?>