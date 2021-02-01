<div id="contact_default_info" class="box-shadow top-content box-left-top" style="margin-bottom:8px;">
	<form name="Customers">
	<table>
	<?php
		foreach( $field as $fields => $labels ) :
		?>
	
		<?php if(in_array($fields, $input['hidden']) ){ ?>
			<?php echo form()->hidden($fields, 'input_text long ', $data[$fields] );?>
		<?php } else if(in_array($fields, array_keys($input['combo']))) { ?>
		<tr>
			<td class="text_caption bottom ui-state-default ui-corner-top ui-state-focus first left">&nbsp;<?php echo $labels;?></td>
			<td class="bottom">
			<?php 
				echo form()->combo($fields, 'select long ',$combo[$input['combo'][$fields]],$data[$fields] );
			?>
			</td>
		</tr>	
		<?php  } else { ?>
		<tr>
			<td class="text_caption bottom ui-state-default ui-corner-top ui-state-focus first left">&nbsp;<?php echo $labels;?></td>
			<td class="bottom"><?php echo form()->input($fields, 'select long ', $data[$fields] );?></td>
		</tr>	
		<?php } ?>	
	<?php endforeach; ?>	
	<tr>
		<td>&nbsp;</td>
		<td>
			<?php echo form()->button('ExitButton','close button','Exit');?>
			<?php //echo form()->button('UpdateButton','update button','Update');?></td>
	</tr>	
	</table>
	</form>
</div>