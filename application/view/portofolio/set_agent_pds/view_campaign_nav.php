<?php echo javascript(); ?>
<script type="text/javascript">
	var OUTBOUND = 2;
	var CampaignId_PDS = 0;
 
	Ext.DOM.onload = (function(){
		Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
	})();
 
	var status_campaign = '<?php echo _get_post("status_campaign"); ?>';

	Ext.DOM.datas = { 
		CampaignName 	 : "<?php echo _get_exist_session('CampaignName');?>",
		CampaignStatus	 : "<?php echo _get_exist_session('CampaignStatus');?>",
		Direction		 : "<?php echo _get_exist_session('Direction');?>",
		EndExpiredDate	 : "<?php echo _get_exist_session('EndExpiredDate');?>",
		StartExpiredDate : "<?php echo _get_exist_session('StartExpiredDate');?>",
		order_by  		 : "<?php echo _get_exist_session('order_by');?>",
		type 			 : "<?php echo _get_exist_session('type');?>"
	}

	Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
	Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

	Ext.DOM.navigation = {
		custnav	 : Ext.DOM.INDEX+'/AssignAgentPDS/index/',
		custlist : Ext.DOM.INDEX+'/AssignAgentPDS/Content/',
	}

	Ext.DOM.getDataInbound = function(Campaign)
	{
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/AssignAgentPDS/getDataInbound/',
			method  : 'GET',
			param	: { 
				CampaignId :  Campaign.value
			},
			
			ERROR : function(e){
				Ext.Util(e).proc(function(counter){
					Ext.Cmp('total_data').setValue(counter.data);
					Ext.Cmp('assign_data').setValue(0);
					Ext.Cmp('total_data').disabled(true);
				});
			}
		}).post();
	}
		

	Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
	Ext.EQuery.postContentList();

	Ext.DOM.Search = function(){
		Ext.EQuery.construct(Ext.DOM.navigation,Ext.Join([
			Ext.Serialize('FrmAssignAgentPDSSetup').getElement()
		]).object() );
		Ext.EQuery.postContent();
	}

	Ext.DOM.Clear = function(){
		Ext.Serialize('FrmAssignAgentPDSSetup').Clear()
		Ext.DOM.Search();
	}

	Ext.DOM.assignAgentPDS = function()
	{
		var GroupId =Ext.Cmp('GroupId').getValue();
		var HandlingType = "<?php echo _get_session('HandlingType'); ?>";
		
	  	if( GroupId == '' ){
			Ext.Msg("Please select a Group ").Info();
			return false;
	  	}
		
		// if( HandlingType != 3 ){
			// Ext.Msg("Hanya untuk SPV").Info();
			// return false;
	  	// }
		
	  	Ext.ShowMenu(new Array('AssignAgentPDS','assignAgent2PDS'),
			Ext.System.view_file_name(), {GroupId : GroupId}
		);
	}

	$(document).ready(function()
 	{
		$('#toolbars').extToolbars({
			extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
			// extTitle :[['Refresh'],['Assign Agent']],
			// extMenu  :[['Clear'],['assignAgentPDS']],
			extTitle :[['Assign Agent']],
			extMenu  :[['assignAgentPDS']],
			extIcon  :[['application_form_edit.png']],
			extText  :true,
			extInput :true,
			extOption:[]
		});
		// $('.date').datepicker({  showOn: 'button',  buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif',  buttonImageOnly: true,  dateFormat:'dd-mm-yy', readonly:true, changeYear:true, changeMonth:true  });
		// $('.select').chosen();
		// $("#StartPds").hide(); $("#PausePds").hide(); $("#StopPds").hide(); $("#ResumPds").hide();
	});




</script>
	
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmAssignAgentPDSSetup">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">

			<!--div class="ui-widget-form-cell text_caption"><?#php echo lang(array('Campaign Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?#php echo form()->input("CampaignName", "input_text superlong", _get_exist_session('CampaignName') );?></div>

			<div class="ui-widget-form-cell text_caption"><?#php echo lang(array('Campaign Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?#php echo form()->combo("CampaignStatus", "select superlong", Flags(), _get_exist_session('CampaignStatus') );?></div>

			<!-- <div class="ui-widget-form-cell text_caption"><?php #echo lang(array('Direction'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php #echo form()->combo("Direction", "select superlong", CallDirection(), _get_exist_session('Direction') );?></div> -->
		</div>
		
		<div class="ui-widget-form-row">
			
			<!-- <div class="ui-widget-form-cell text_caption"><?php #echo lang(array('Expired Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell">
				<?php #echo form()->input("StartExpiredDate", "input_text date",_get_exist_session('StartExpiredDate') );?>
				<?php #echo form()->input("EndExpiredDate", "input_text date",_get_exist_session('EndExpiredDate') );?>
			</div> -->
		</div>
		
	</div>
	</form>
 </div>
 
<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
<!-- stop : content -->

<script>
	$( document ).ready(function() {
    	$('input[type=checkbox]').attr('class','test');
    	console.log('checkbox');
	});
</script>