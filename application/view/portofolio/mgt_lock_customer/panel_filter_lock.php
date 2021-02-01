<div class="ui-widget-form-table-compact" style="width:99%;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell ui-widget-content-top" style="width:30%;">
            <fieldset class="corner" style="width:auto;padding: 4px 4px 2px 4px;margin:-5px 5px 10px 5px; border-radius:5px;">
            <?php echo form()->legend(lang("Navigasi Setup"), "fa-gear"); ?>
                    <form name="formSetupLock">
                    <div class="ui-widget-form-table" style="margin-top:-5px;">

                            <div class="">
                                <div class="ui-widget-form-cell text_caption"><?php echo lang("From User"); ?></div>
                                <div class="ui-widget-form-cell text_caption">:</div>
                                <div class="ui-widget-form-cell" id="ui-user-pull-list"><?php echo form()->listCombo("lock_user_list", "select tolong", $agent_list, null, array('click' => 'Ext.DOM.Testing();'), array("height" => "200px", "dwidth" => "100%")); ?></div>
                            </div>

                            <div class="">
                                <div class="ui-widget-form-cell text_caption"><?php echo lang("Lock Type"); ?></div>
                                <div class="ui-widget-form-cell text_caption">:</div>
                                <div class="ui-widget-form-cell" id="ui-user-pull-list"><?php echo form()->combo("cmb_lock_type", "select tolong", $lock_type, null, array("change" => "Ext.DOM.getParamInput();")); ?></div>
                            </div>

                            <div class="" id="key_rec">
                                <div class="ui-widget-form-cell text_caption"><?php echo lang("Keyword Recsource"); ?></div>
                                <div class="ui-widget-form-cell text_caption">:</div>
                                <div class="ui-widget-form-cell" id="ui-user-pull-list">
                                    <?php echo form()->input('src_customerspv_keyword', 'input_text long', _get_exist_session('src_customerspv_keyword')); ?>
                                </div>
                                <div class="ui-widget-form-cell text_caption left" style="vertical-align:top;">
                                    <a href="javascript:void(0);" onclick="Ext.DOM.load_Recsource_pull_src();"> <i class="fa search">&nbsp;</i>&nbsp;</a>
                                </div>
                            </div>


                            <div class="" id="loaded_param">

                            </div>

                            <div class="">
                                    <div class="ui-widget-form-cell text_caption"></div>
                                    <div class="ui-widget-form-cell text_caption"></div>
                                    <div class="ui-widget-form-cell">
                                            <?php echo form()->button("BtnSetLock", "button lock", lang("Hide"), array('click' => 'Ext.DOM.SetLock();')); ?>
                                    </div>
                            </div>
                    </div>
                    </form>
            </fieldset>
		</div>

        <div class="ui-widget-form-cell ui-widget-content-top" style="width:70%;">
			<fieldset class="corner ui-widget-fieldset" style="margin:-12px 5px 5px -5px; border-radius:5px;">
                <?php echo form()->legend(lang(array("List", "Setup Lock")), "fa-bars"); ?>
                        <div id="ui-widget-lock-list" class="ui-widget-form-table-compact" style="height:500px;width:99%;margin:0px 5px 0px 5px;"></div>
            </fieldset>
		</div>

	</div>
</div>
