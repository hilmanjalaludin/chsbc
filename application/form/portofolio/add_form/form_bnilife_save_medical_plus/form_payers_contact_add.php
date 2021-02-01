<div class="ui-widget-form-table product-box-content">	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Mobile Phone 1</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerMobilePhoneNum","input_text long",$Payers['PayerMobilePhoneNum']);?> </div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Mobile Phone 2</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerMobilePhoneNum2","input_text long",$Payers['PayerMobilePhoneNum2']);?> </div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Home Phone 1</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerHomePhoneNum","input_text long",$Payers['PayerHomePhoneNum']);?> </div>
	</div>	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Home Phone 2</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerHomePhoneNum2","input_text long",$Payers['PayerHomePhoneNum2']);?> </div>
	</div>	
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Office Phone 1</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerOfficePhoneNum", "input_text long",$Payers['PayerOfficePhoneNum']);?> </div>
	</div>
	
		
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Office Phone 2</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerOfficePhoneNum2", "input_text long",$Payers['PayerOfficePhoneNum2']);?> </div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="text_caption">Fax Number </div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerFaxNum", "input_text long",$Payers['PayerFaxNum']);?></div>
	</div>
</div>
