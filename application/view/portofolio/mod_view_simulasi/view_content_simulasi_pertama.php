<fieldset class="corner" style="margin:8px;padding:0px 5px 10px 5px;">
<?php echo form()->legend(lang("Simulasi"), "fa-edit"); ?>
<form name="frmSimulasi">
	<div class="ui-widget-form-table ">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Product</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("ProductId", "select long", Product());?></div>	
			<div class="ui-widget-form-cell text_caption">Group Premi</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("GroupPremi", "select long", PremiGroup());?></div>
		</div>
			
		<div class="ui-widget-form-row">	
			<div class="ui-widget-form-cell text_caption">Payment Mode</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("PaymentMode", "select long", PaymentMode());?></div>
			<div class="ui-widget-form-cell text_caption">Gender</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("GenderId", "select long", Gender() );?></div>
		</div>
					
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Age</div>
			<div class="ui-widget-form-cell">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->input("AgeStart", "input_text box", null, null, array('style' => "width:74px;text-align:center;"));?> <span style="font-family:Arial;font-size:11px;font-weight:normal;">to</span> <?php echo form()->input("AgeEnd", "input_text box", null, null, array('style' => "width:74px;text-align:center;"));?> </div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("btnshow", "button search", "&nbsp;Search", array("click" => "ShowProductPremi();" ));?>
				<?php echo form()->button("btnclear", "button clear", "&nbsp;Clear&nbsp;&nbsp;&nbsp;", array("click" => "ClearProductPremi();" ));?></div>			
		</div>
	</div>
</form>
</fieldset>	
		
<fieldset class="corner" style="margin:10px 8px 8px 8px;">
	<?php echo form()->legend(lang("Table Premi"), "fa-bars"); ?>
	<div class="ui-widget-compact" id="ui-widget-pcroduct-premi"></div>
</fieldset>			