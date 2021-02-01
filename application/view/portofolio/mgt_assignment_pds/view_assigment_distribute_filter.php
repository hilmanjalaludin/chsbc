<fieldset class="corner" style="width:auto;padding: 4px 4px 2px 4px;margin:-12px 5px 5px -20px; border-radius:5px;">
<style>
	#dis_call_reason-selectdown{
		margin:0 !important;
	}
</style>
<?php echo form()->legend(lang("Filter Data"),"fa-search");?>
	<form name="formDisFilter">
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_campaign_name", "select xselect long",CampaignId(),null,array('change'=>'Ext.DOM.load_Recsource(this);'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Upload Date");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("dis_start_upload_date", "input_text date");?>
				<?php echo lang("to"); ?>
				<?php echo form()->input("dis_end_upload_date", "input_text date");?>
			</div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("SPV");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_spv", "select xselect long", getSPV());?></div>
			
			<!-- <div class="ui-widget-form-cell text_caption"><?php// echo lang("Account Status");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php //echo form()->combo("acc_status", "select xselect long",AccStatus());?></div> -->
			
			<!-- <div class="ui-widget-form-cell text_caption"><?php //echo lang("Filter 1");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php //echo form()->combo("dis_field_value1", "select xselect long", FieldValue());?></div>
			<div class="ui-widget-form-cell"><?php //echo form()->combo("dis_field_filter1", "select xselect box", FilterValue(), NULL,NULL, array("style" => "width:100px;"));?></div>
			<div class="ui-widget-form-cell"><?php //echo form()->textarea("dis_field_text1", "textarea long", NULL, NULL, array('style' => "height:22px;"));?></div> -->
			
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Gender");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_gender_id", "select xselect long", Gender());?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Customer Age");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("dis_start_dob", "input_text box");?>
				<span style="margin-left:8px;"><?php echo lang("to"); ?></span>
				<span style="margin-left:8px;"><?php echo form()->input("dis_end_dob", "input_text box");?></span>
			</div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Filter 2");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_field_value2", "select xselect long", FieldValue());?></div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("dis_field_filter2", "select xselect box", FilterValue(), NULL,NULL, array("style" => "width:100px;"));?></div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("dis_field_text2", "textarea long", NULL, NULL, array('style' => "height:22px;"));?></div>
		</div>
		
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("Record/page");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top"><?php echo form()->input("dis_record_page", "input_text long", 20);?></div>
			
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang("Call Atempt");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top ui-widget-content-top">
				<?php echo form()->input("dis_start_atempt", "input_text box");?>
				<span style="margin:0px 8px 0px 8px;"><?php echo lang("to"); ?></span>
				<?php echo form()->input("dis_end_atempt", "input_text box");?>
			</div>
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Mkt Code");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("mkt_code", "input_text long",null);?></div>
			 <div class="ui-widget-form-cell text_caption"><?php echo lang("Customer Name");?> :</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("customer_name", "input_text long",null);?></div> 

		</div>



	
			
	

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top text_caption"><?php echo lang(array('Call Result'));?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption center">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption left"><?php echo form() -> combo('dis_call_reason','select long', CallResultNotInterestPDS(),null,array('change'=>'Ext.DOM.CallStatCheckDis(this)'));?></div>

			<div class="ui-widget-form-cell ui-widget-content-top text_caption">Disagree Codes </div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div id="aading3" class="ui-widget-form-cell">
			<select name="disagree3" id="disagree3" disabled class="select tolong"><option>Choose</option></select>
			</div>
			<div id='disagree-selectdown3' class='toggle-notactive-new ui-down-active-new' onclick='Ext.DOM.CallStatCheckDis(this)'></div>

			<div class="ui-widget-content-top text_caption"><?php echo lang("Last Call <br>Date");?></div>
			<div class="ui-widget-form-cell ui-widget-content-top text_caption">:</div>
			<div class="ui-widget-form-cell ui-widget-content-top">
				<?php echo form()->input("dis_start_last_call_date", "input_text date");?>
				<?php echo lang("to"); ?>
				<?php echo form()->input("dis_end_last_call_date", "input_text date");?>
			</div>

			<div class="ui-widget-content-top text_caption"><?php echo lang("Recsource ");?> :</div>
			<!-- <div class="ui-widget-content-top text_caption">:</div> -->
			<div class="ui-widget-form-cell ui-widget-content-top"><?php echo form()->combo("dis_recsource_name", "select long");?></div>
</div>





		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnDisFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataDist();'));?>
				<?php echo form()->button("BtnDisReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataDist();'));?>	
			</div>
		</div>
	</div>
	</form>
</fieldset>