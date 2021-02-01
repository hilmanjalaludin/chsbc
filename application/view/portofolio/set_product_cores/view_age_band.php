<?php
/*
 * E.U.I 
 *
 * subject	: view_core_nav ( files )
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
?>

<fieldset class="corner" style="padding-bottom:15px;">
<?php echo form()->legend(lang("Age Band"), "fa-plus"); ?>
	<?php for( $i=1; $i<= $ProductAge; $i++) { ?> 
		<div class="ui-widget-form-table">
			<div class="ui-widget-form-caption-top text_caption center">Range Age ( <?php echo $i; ?> )</div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-corner-top ui-state-default ui-hidden-border-right center">Start</div>
				<div class="ui-widget-form-cell ui-corner-top ui-state-default center">End</div>	
			</div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content ui-hidden-border-right ui-hidden-border-top"><?php echo form() -> input("start_range_{$i}", 'input_text box center', null, array("keyup"=>"setInsert('start',this);"), array("style"=>"width:60px;border:1px solid red;") ); ?></div>
				<div class="ui-widget-form-cell ui-widget-content ui-hidden-border-left ui-hidden-border-top"><?php echo form() -> input("end_range_{$i}", 'input_text box center', null, array("keyup"=>"setInsert('end',this);"),array("style"=>"width:60px;border:1px solid red;")); ?></div>	
			</div>
		</div>
	<?php } ?>	
</fieldset>