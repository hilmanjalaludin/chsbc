<div id="panel-box-beneficiary">
<?php foreach( $Benefiecery as $BeneficiaryId  => $rows ) : ?>	
	<div class="bottom" id="panel-content-<?php __($BeneficiaryId); ?>" 
		style='border:1px solid #dddddd;margin:6px 3px 6px 3px; width:400px;float:left;'>
		&nbsp;<?php __(form()->checkbox('BeneficiaryId','box', $BeneficiaryId, null, array('style'=>'margin-top:2px;', 'checked' => true, 'disabled'=>true)));?>&nbsp;
		<table width='100%'>
			<tr>
				<td class="text_caption bottom" width='10%' nowrap> Salutation </td>
				<td class=" bottom" ><?php __(form()->combo("BenefSalutationId_{$BeneficiaryId}","select long",$Combo['Salutation'], $rows['SalutationId'] )); ?></td>
			</tr>
			<tr>
				<td class="text_caption bottom" nowrap> Beneficiary Name</td>
				<td class="bottom"> <?php __(form()->input("BeneficiaryFirstName_{$BeneficiaryId}","input_text long",$rows['BeneficiaryFirstName'])); ?> </td>
			</tr>
			<tr>
				<td class="text_caption bottom"> Relation</td>
				<td class="bottom">  <?php __(form()->combo("BenefRealtionship_{$BeneficiaryId}","select long",$Combo['Realtionship'], $rows['RelationshipTypeId'] )); ?> </td>
			</tr>
			<tr>
				<td class="text_caption bottom"> Gender </td>
				<td class="bottom" > <?php __(form()->combo("BenefGender_{$BeneficiaryId}","select long",$Combo['Gender'], $rows['GenderId'] )); ?></td>
			</tr>
			<tr>
				<td class="text_caption bottom"> DOB </td>
				<td class=" bottom"> <?php __(form()->input("BeneficiaryDOB_{$BeneficiaryId}","input_text date long",date('d-m-Y', strtotime($rows['BeneficiaryDOB'])))); ?></td>
			</tr>
			<tr>
				<td class="text_caption bottom"> Age </td>
				<td class=" bottom"> <?php __(form()->input("BeneficiaryAge_{$BeneficiaryId}","input_text",$rows['BeneficiaryAge'])); ?></td>
			</tr>
		</table>
	</div>
<?php endforeach; ?>
</div>