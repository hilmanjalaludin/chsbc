<fieldset class="corner">
<?php echo form()->legend(lang("Add"), "fa-plus"); ?>
	<div id="result_content_add" class="ui-widget-panel-formx"> 	
		<table width="99%" border="0" align="center">
		<tr>
			<td valign="top" width="40%">	
			<div>
				<table cellpadding="5px" align="left">
					<tr>
						<td class="text_caption "> Credit Shield</td>
						<td><?php echo form() -> combo('credit_shield_name', 'select superlong', array('1'=> 'YES', '0'=>'NO'),null,array("change"=>"setProduct(this);") ); ?></td>
					</tr>
					<tr>
						<td class="text_caption "> * Product ID</td>
						<td> <?php echo form() -> input('text_product_id', 'input_text superlong',null, null, array('length'=>30) ); ?> &nbsp;( 30 )</td>
					</tr>
					<tr>
						<td class="text_caption " valign="top"> * Product Paymode</td>
						<td>
							<?php foreach( $data -> _get_select_paymode() as $k => $v ){ ?>
								<?php echo form() -> checkbox('paymode', null ,$k, null, array('label'=> $v) ); ?> <br>
							<? } ?>
						</td>
					</tr>
					<tr>
						<td class="text_caption " > * Campaign Core</td>
						<td><?php echo form() -> combo('select_cmp_core', 'select superlong', $data -> _get_select_cores()); ?></td>
					</tr>
					<tr>
						<td class="text_caption " valign="top"> * Premi Group </td>
						<td>
							<?php foreach( $data -> _get_select_premi_group() as $k => $v ){ ?>
								<?php echo form() -> checkbox('GroupPremi', null,$k, null, array('label'=> $v) ); ?> <br>
							<? } ?>
						</td>
					</tr>		
					<tr>
						<td class="text_caption " > * Product Plan </td>
						<td> <?php echo form() -> input('text_product_plan', 'input_text superlong',null); ?> ( Plan ) </td>
					</tr>
					<tr>
						<td class="text_caption " > * Age Period</th>
						<td> <?php echo form() -> input('text_product_age', 'input_text superlong',null); ?> ( Age )</td>
					</tr>
				</table>
			</div>
			</td>
			<td valign="top">
			<div valign="top">
				<table cellpadding="5px" align="left" border=0>
					<tr>
						<td class="text_caption"> * Product Name</td>
						<td> <?php echo form() -> input('text_product_name', 'input_text superlong',null,null,array('style'=>'height:20px;')); ?> ( 30 ) </td>
					</tr>
					<tr>
						<td class="text_caption"> * Product Type</td>
						<td> <?php echo form() -> combo('select_product_type', 'select superlong', ProductType()); ?></td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'> * Gender</td>
						<td> <?php if(is_array($gender))foreach( $gender as $GenderId => $label ) : ?>
							 <?php echo form() -> checkbox('GenderId', null,$GenderId, null, array('label'=> $label) ); ?> <br>
							 <?php endforeach; ?>
						</td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'>Currency</td>
						<td> <?php echo form() -> combo('text_currency', 'select superlong',ProductCurrency()); ?></td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'>Under Writing</td>
						<td> <?php echo form() -> combo('text_under_writing', 'select superlong',enum()); ?></td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'>Beneficiary</td>
						<td> <?php echo form() -> combo('text_beneficiary', 'select superlong',enum()); ?></td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'>Expired Periode</td>
						<td><?php echo form() -> combo('txt_expired_periode', 'select superlong',ExpiredPeriode() ); ?></td>
					</tr>
					
					<tr>
						<td class=" text_caption top" valign='top'>Sponsor</td>
						<td> <?php echo form() -> combo('text_sponsor', 'select superlong',Sponsor()); ?></td>
					</tr>
					
					<tr>
						<td class="text_caption"> * Product Status </td>
						<td> <?php echo form() -> combo('status', 'select superlong',array('0'=>'Not Active','1'=>'Active')); ?></td>
					</tr>
					
					<tr>
						<td></td>
						<td>
							<?php echo form()->button("BtnShow","button assign",lang("Show Grid"), array("click" => "Ext.DOM.ShowGrid();"));?>
							<?php echo form()->button("BtnClose","button cancel",lang("Hide Grid"), array("click" => "Ext.DOM.HideGrid();"));?>
							<?php echo form()->button("BtnSave","button save",lang("Save Product"),array("click" => "Ext.DOM.SaveProduct();"));?>
						</td>
					</tr>
				</table>
			</div>
			</td>	
	</table>
</div>
</fieldset>
<!--
 Sponsor
:
Age Priode
:
to
Beneficiary
:
Expired. Periode
:-->

