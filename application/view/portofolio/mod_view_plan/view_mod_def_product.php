 <fieldset class="corner" style="padding:10px 5px 20px 5px;border-radius:5px;">
	<?php echo form()->legend(lang(array( call_product_name() )),"fa-edit");?>
	
<div class="ui-widget-form-table">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Product Code</div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("ProductCode", "input_text superlong disabled", def()->ProductCode() );?></div>
	</div>
		
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Product Name</div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("ProductName", "input_text superlong disabled",  def()->ProductName() );?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Product Prefix</div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("ProductPrefix", "input_text superlong disabled", def()->ProductPrefix() );?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Sponsor</div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("Sponsor", "select superlong disabled", Sponsor(), def()->Sponsor());?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Age Priode</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"> <?php echo form()->input("AgeStartPeriode", "input_text box disabled", def()->AgeStart());?> to <?php echo form()->input("AgeEndPeriode", "input_text box disabled", def()->AgeEnd());?> </div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Underwriting</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("Underwriting", "select superlong disabled", Enum(), def()->Underwriting());?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Beneficiary</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("Beneficiary", "select superlong disabled", Enum(), def()->Benfiecery());?></div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Expired. Periode</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("ExpiredPeriode", "select superlong disabled",ExpiredPeriode(), def()->ExpiredPeriode());?></div>
	</div>
	
		<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Currency</div>
		<div class="ui-widget-form-cell">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("ProductCurrency", "select superlong disabled",ProductCurrency(), def()->Currency());?></div>
	</div>
	
	
	
</div>

<div class="ui-widget-form-table">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">Product Type</div>
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->DropListBox("ProductType",ProductType(), _getKey(def()->ProductType()));?></div>
	</div>
</div>

<div class="ui-widget-form-table">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">Group Premi</div>
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->DropListBox("GroupPremi", PremiGroup(), _getKey(def()->GroupPremi()));?></div>
	</div>
</div>

<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">Payment Mode</div>
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->DropListBox("PayMode",PaymentMode(), _getKey(def()->PayMode()) );?></div>
	</div>
</div>

	
<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">Gender</div>
		<div class="ui-widget-form-cell text_caption ui-widget-content-top ">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->DropListBox("Gender", Gender(), _getKey(def()->Gender()));?></div>
	</div>
</div>
</fieldset>