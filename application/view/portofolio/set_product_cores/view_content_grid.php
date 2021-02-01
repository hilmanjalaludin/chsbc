<?php
/*
 * E.U.I 
 *
 * subject	: view_core_nav ( files )
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */

 $_get_premium_group = $data -> _get_select_premi_group();
 $_get_payment_mode  = $data -> _get_select_paymode();
 
 if(!is_array($PayMode)) {
	exit(0);
}
?>

<?php foreach( $PayMode as $_PayId => $_PayValue ){ ?>		
	<fieldset class="corner" style="padding:5px 5px 15px 8px;width:99%;margin:20px 5px 20px 0px">
		<?php echo form()->legend(lang($_get_payment_mode[$_PayValue]), "fa-calendar"); ?>
		
		<div class="ui-widget-form-table-compact" style="width:99%;">
				<?php if( count($GroupPremi) >0  )  { ?>
				
					<?php foreach($GroupPremi as $_GroupId => $_GroupValue ) { ?>
					<fieldset class="corner" style="margin-top:-5px;padding:0px 8px 15px 8px;">
						<?php echo form()->legend(lang($_get_premium_group[$_GroupValue]),"fa-users"); ?>
						<?php if( is_array($Gender)) { ?>
							<?php foreach( $Gender as $ux => $label ) { ?>
							  
								<div class="ui-widget-form-table" style="text-align:center;">
									<fieldset class="corner" style="padding:12px 8px 15px 15px;">
									<?php echo form()->legend(lang($GenderId[$label]),($label==1?"fa-male" : "fa-female")); ?>
									
									<table border=0 cellpadding="1px" cellspacing=1 >
									<tr>
										<th  class='font-standars ui-corner-top ui-state-default first center'>AGE BAND </th>
										<?php for( $header=1; $header <= $ProductPlan; $header++) { ?>
											<th class='font-standars ui-corner-top ui-state-default first center'>PLAN <?php echo $header; ?></th>
										<?php } ?>
									</tr>
									<?php for( $y=1; $y <= $ProductAge; $y++){  ?> <!-- start counter of age --> 
									<tr>
										<td>
											<?php echo form() -> input("start_age_{$_PayValue}_{$_GroupValue}_{$label}_{$y}",'input_text box',null, array(), array('style'=>'text-align:right;height:20px;width:50px;')); ?> - 
											<?php echo form() -> input("end_age_{$_PayValue}_{$_GroupValue}_{$label}_{$y}",'input_text box',null, array(), array('style'=>'text-align:right;height:20px;width:50px;')); ?>
										</td>								
											
										<?php for( $plan =1; $plan <= $ProductPlan; $plan++){ ?> <!-- start counter of plan  --> 
											<td><?php echo form() -> input("plan_premi_{$_PayValue}_{$_GroupValue}_{$label}_{$y}_{$plan}", "input_text box",null, array(), array('style'=>'text-align:right;height:20px;')); ?> </td>
										<?php } ?>
									</tr>
									<?php }  ?>		
									</table>
								</div>
								<!--</fieldset><br>-->
							 <?php } ?>
						<?php } else { ?>	
							<!-- No Gender --> 
								<table cellpadding="1px" cellspacing=1>
										<tr>
											<th  class='font-standars ui-corner-top ui-state-default first center'>AGE BAND </th>
											<?php for( $header=1; $header <= $ProductPlan; $header++) { ?>
												<th class='font-standars ui-corner-top ui-state-default first center'>PLAN <?php echo $header; ?></th>
											<?php } ?>
										</tr>
										<?php for( $y=1; $y <= $ProductAge; $y++){  ?> <!-- start counter of age --> 
										<tr>
											<td>
												<?php echo form() -> input("start_age_{$_PayValue}_{$_GroupValue}_{$y}",'input_text box',null, array(), array('style'=>'text-align:right;height:20px;width:50px;')); ?> - 
												<?php echo form() -> input("end_age_{$_PayValue}_{$_GroupValue}_{$y}",'input_text box',null, array(), array('style'=>'text-align:right;height:20px;width:50px;')); ?>
											</td>								
												
											<?php for( $plan =1; $plan <= $ProductPlan; $plan++){ ?> <!-- start counter of plan  --> 
												<td><?php echo form() -> input("plan_premi_{$_PayValue}_{$_GroupValue}_{$y}_{$plan}", "input_text box",null, array(), array('style'=>'text-align:right;height:20px;')); ?> </td>
											<?php } ?>
										</tr>
										<?php }  ?>		
								</table>
							
						<?php } ?>
					</fieldset><br>
					<?php } ?>
				<?php } else { ?>
				<!-- end :: if not have group premi --> 
					<div>
					
						<?php if( is_array($Gender)) { ?> 
						<?php foreach( $Gender as $ux => $label ) { ?>
							 <fieldset class="corner" style="border:1px solid #dddddd;">
								<legend tyle="color:red;font-weight:bold;"><?php __($GenderId[$label]); ?></legend>
								
							<table cellpadding="4px">
								<!-- header -->
								<tr>
									<th class='font-standars ui-corner-top ui-state-default first center'>AGE BAND </th>
									<?php for( $header=1; $header <= $ProductPlan; $header++) { ?>
										<th class='font-standars ui-corner-top ui-state-default first center'>PLAN <?php echo $header; ?></th>
									<?php } ?>
								</tr>
								
								<?php for( $y=1; $y <= $ProductAge; $y++){  ?> <!-- start counter of age --> 
								<tr>
									<td>
										<?php echo form() -> input("start_age_{$_PayValue}_{$label}_{$y}",'input_text box',null, array(), array('style'=>'height:20px;width:50px;')); ?> - 
										<?php echo form() -> input("end_age_{$_PayValue}_{$label}_{$y}",'input_text box',null, array(), array('style'=>'height:20px;width:50px;')); ?>
									</td>								
									<?php for( $plan =1; $plan <= $ProductPlan; $plan++){ ?> <!-- start counter of plan  --> 
										<td><?php echo form() -> input("plan_premi_{$_PayValue}_{$label}_{$y}_{$plan}", "input_text box"); ?> </td>
									<?php } ?>
								</tr>
								<?php }  ?>		
							</table>
							</fieldset><br>
						<?php } ?>	
						<?php } else  {  ?>
								<table cellpadding="4px">
								<!-- header -->
								<tr>
									<th class='font-standars ui-corner-top ui-state-default first center'>AGE BAND </th>
									<?php for( $header=1; $header <= $ProductPlan; $header++) { ?>
										<th class='font-standars ui-corner-top ui-state-default first center'>PLAN <?php echo $header; ?></th>
									<?php } ?>
								</tr>
								
								<?php for( $y=1; $y <= $ProductAge; $y++){  ?> <!-- start counter of age --> 
								<tr>
									<td>
										<?php echo form() -> input("start_age_{$_PayValue}_{$y}",'input_text box',null, array(), array('style'=>'height:20px;width:50px;')); ?> - 
										<?php echo form() -> input("end_age_{$_PayValue}_{$y}",'input_text box',null, array(), array('style'=>'height:20px;width:50px;')); ?>
									</td>								
									<?php for( $plan =1; $plan <= $ProductPlan; $plan++){ ?> <!-- start counter of plan  --> 
										<td><?php echo form() -> input("plan_premi_{$_PayValue}_{$y}_{$plan}", "input_text box"); ?> </td>
									<?php } ?>
								</tr>
								<?php }  ?>		
							</table>
						<?php } ?>
						
					</div>
				<?php } ?>
				
		</div>
		</fieldset>
	<?php } ?>