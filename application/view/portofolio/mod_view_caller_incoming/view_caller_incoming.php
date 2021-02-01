<?php get_view( array("mod_view_caller_incoming", "view_caller_javascript") );?>

<div id="ui-widget-role-tabs" class="corner">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-role-tabs">
				<span class="ui-icon ui-icon-person"></span> <?php echo lang("Incoming Call");?> </a></li>
	</ul>
	<div id="ui-widget-role-tabs" class="ui-widget-user-tabs ui-tabs-customize">
		<div class="ui-widget-awesome-corner">
			<fieldset class="corner ui-widget-fieldset">
			<?php echo form()->legend(lang("Incoming Call"),"fa-phone");?>
				<form name="frmCallIncoming">
					<?php echo form()->hidden("caller_mrn_bak", null, $objCaller->get_value('caller_mrn'));?>
					<?php echo form()->hidden("caller_id", null, $objCaller->get_value('id'));?>
					<?php echo form()->hidden("caller_source", null, DEFAULT_CALLER_CALLTRACK);?>
					<?php echo form()->hidden("callsessionid", null, $objCall->get_value('callsessionid'));?>
					<?php echo form()->hidden("caller_project", null, '');?>
					<?php echo form()->hidden("save_track_code");?>
					<!-- table --> 
					<div class="ui-widget-form-table">
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Call ID")?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_number","input_text superlong", $objCaller->get_value('caller_number')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("MRN");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell">
								<?php echo form()->input("caller_mrn","input_text superlong mrn-autocomplete", $objCaller->get_value('caller_mrn')); ?>
								<?php echo form()->copy("copy-text", "btn-clipboard", "caller_mrn");?>	
							</div>
						</div>
							
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Customer Name");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_name","input_text superlong caller-displaytable", $objCaller->get_value('caller_name')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo "DOB";?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_dob","input_text superlong dob-autocomplete spelling", $objCaller->get_value('caller_dob', '_getDateIndonesia')); ?></div>
						</div>
						
						<!--
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("POB");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_pob","input_text superlong caller-displaytable", $objCaller->get_value('caller_pob')); ?></div>
						</div>
						-->
						
						<div class="ui-widget-form-row ui-display-block">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Customer Age");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_age","input_text superlong", $objCaller->get_value('caller_age')); ?></div>
						</div>
							
						<div class="ui-widget-form-row ui-display-block">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Gender");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->combo("caller_gender","select x-select superlong", Gender(), $objCaller->get_value('caller_gender') ); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Product");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_product_name","input_text superlong", $objCaller->get_value('caller_product')); ?></div>
						</div>

						
					</div>

					<!-- table 2 -->
					<div class="ui-widget-form-table">
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right ui-widget-wraper-yes"><?php echo lang("Address");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->textarea("caller_address","textarea superlong uppercase", $objCaller->get_value('caller_address'), NULL, array("style" => "height:60px;") ); ?></div>
						</div> 
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Other Phone");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_other_phone","input_text superlong", $objCaller->get_value('caller_other_phone')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Contact Name");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_contact_name","input_text superlong", $objCaller->get_value('caller_contact')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Customer Email");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("caller_email","input_text superlong email", $objCaller->get_value('caller_email')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Mother Name");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->input("mother_name","input_text superlong email", $objCaller->get_value('caller_email')); ?></div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Caller Type");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->combo("caller_type","select x-select superlong", CallerType(),  
								( !is_null($objCaller->get_value('caller_type'))? $objCaller->get_value('caller_type') : DEFAULT_CALLER_TYPE), array("change" => "ChangeCallerType(this);" ) ); ?></div>
						</div>
						
						
						<!-- d iv class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?#php echo lang("Status");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?#php echo form()->input("caller_status","input_text superlong", $objCaller->get_value('caller_status')); ?></div>
						</di v -->

					</div>

					<!-- table 3 -->
					<div class="ui-widget-form-table">
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Category");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->combo("caller_tracker","select superlong", CallTrack(),null, array("change" => "SelectCatgory(this);" )); ?></div>
						</div>
							
						<div class="ui-widget-form-row">
							<div id="isdisabled" class="ui-widget-form-cell text_caption right"><?php echo lang("Sub Category");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell">
								<span id="lbl_caller_sub_tracker"><?php echo form()->combo("caller_sub_tracker","select superlong", array()); ?></span>
							</div>
						</div>
						
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right"><?php echo lang("Remarks");?></div>
							<div class="ui-widget-form-cell text_caption center">:</div>
							<div class="ui-widget-form-cell"><?php echo form()->textarea("caller_remark","textarea uppercase superlong ui-widget-remark", NULL, NULL); ?> </div>
						</div>
					
						<!-- table ajax & button -->
						<!-- d iv class="ui-widget-form-row"></di v -->	
						<div class="ui-widget-form-row">
							<div class="ui-widget-form-cell text_caption right">&nbsp;</div>
							<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
							<div class="ui-widget-form-table">
								<div class="ui-widget-form-row">
									<div class="ui-widget-form-cell"><?php echo form()->button("submit_caller_new","button save", lang("Save"), array("click" => "Ext.DOM.SaveCaller();" ) ); ?></div>
									<div class="ui-widget-form-cell"><?php echo form()->button("submit_update_role","button cancel", lang("Cancel"), array("click" => "Ext.DOM.CancelCaller();" ) ); ?></div>
								</div>
							</div>
						</div>
						
					</div>
				</form>
				
			</fieldset>
		</div>
	</div>
</div> 


<div id="ui-widget-call-history" class="corner">
	<?php get_view( array("mod_view_caller_incoming", "view_caller_modulation") );?>
</div>
	