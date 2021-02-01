<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include benefiecery page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 * -------------------------------------------------------
 */
?>  
<fieldset class="corner" style="margin:5px -5px 10px -5px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Beneficiary"),"fa-user");?>
<form name="frmBenefiecery">
<?php echo form()->hidden("IsBenefiecery", null, $IsBenefiecery);?>	
<div class="ui-widget-form-table-compact">
<?php 

$maximumsize = 5;
$percentage = number_format( (100/$maximumsize),0, '.', '');
 
for( $cond =1; $cond<=$maximumsize; $cond++) {  
	$selector = join("_", array('frmbenef',$cond));
	$outputs  =& new EUI_Object($SelectBeneficiary[$cond]);
	$checked  = ( $outputs->fetch_ready() ? array( 'checked' => true ) : null ); 
	
?>
 <div class="ui-widget-form-table">	
 <fieldset class="corner" style="margin-left:0px; border:0px solid #ddd;">
	<legend >&nbsp;&nbsp;&nbsp;
		<b>Beneficiary <?php echo $_benefiecery; ?></b>
		<?php echo form()->checkbox("Benefiecery","benefdis",$cond, array('change' => "SetBenefieceryChecked(this);"), $checked);?>
	</legend>	
	<table cellspacing=1> 
		<tr>
			<td class="text_caption required">* Relation</td>
			<td><?php echo form()->combo(join("_", array("BenefRelationshipTypeId", $cond)),"select zx-select dfl-disabled long $selector",Realtionship(), $outputs->get_value('RelationshipTypeId')); ?></td>
		</tr>
		<tr>
			<td class="text_caption">Title</td>
			<td><?php echo form()->combo(join("_", array("BenefSalutationId", $cond)), "select zx-select dfl-disabled long $selector",Salutation(),$outputs->get_value('SalutationId')); ?></td>
		</tr>
		<tr>
			<td class="text_caption required">* First Name</td>
			<td> <?php echo form()->input(join("_", array("BenefFirstName", $cond)),"input_text dfl-disabled long $selector uppercase",$outputs->get_value('BeneficiaryFirstName')); ?></td>
		</tr>
		<tr>
			<td class="text_caption required">*Gender</td>
			<td><?php echo form()->combo(join("_", array("BenefGenderId", $cond)), "select zx-select dfl-disabled long $selector", Gender(), $outputs->get_value('GenderId'));?></td>
		</tr>
		
		<tr>
			<td class="text_caption">DOB</td>
			<td><?php echo form()->input( join("_", array("BenefDOB", $cond)), "input_text dfl-disabled benefiecery-dob $selector", $outputs->get_value('BeneficiaryDOB'));?></td>
		</tr>
		
		<tr>
			<td class="text_caption">Age</td>
			<td><?php echo form()->input(join("_", array("BenefAge", $cond)), "input_text dfl-disabled $selector", $outputs->get_value('BeneficiaryAge'));?></td>
		</tr>
		
		<tr>
			<td class="text_caption">Percentage</td>
			<td><?php echo form()->input(join("_", array("BeneficieryPercentage", $cond)), "input_text dfl-disabled ui-self-percentage $selector", 
				( $outputs->get_value('BeneficieryPercentage') ? $outputs->get_value('BeneficieryPercentage') : $percentage ));?> ( % )</td>
		</tr>
	</table>
  </fieldset>
</div>	
<?php }	 ?>
</div>	
</form>
</fieldset>