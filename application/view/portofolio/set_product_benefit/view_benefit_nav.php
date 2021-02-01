<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.datas = {
	benef_plan_id		: "<?php echo _get_exist_session('benef_plan_id');?>",
	benef_product_id	: "<?php echo _get_exist_session('benef_product_id');?>",
	benef_product_name	: "<?php echo _get_exist_session('benef_product_name');?>",
	benef_status		: "<?php echo _get_exist_session('benef_status');?>",
	order_by 			: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type');?>' 
}

 /**
 ** javscript prototype system
 ** version v.0.1
 **/

$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Add'],['Edit'],['Delete'],['Clear'], ['Search']],
		extMenu  :[['AddBenefit'],['EditBenefit'],['DeleteBenefit'],['Clear'],['SearchBenfit']],
		extIcon  :[['add.png'],['application_edit.png'],['delete.png'],['zoom_out.png'],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption:[]
	});
	
	$('.select').chosen();
});



/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.navigation = {
		custnav : Ext.DOM.INDEX +'/SetBenefit/index/',
		custlist: Ext.DOM.INDEX +'/SetBenefit/Content/',
	}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
		
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.SearchBenfit = function()
{ $.cookie('selected',0)
 var frmBenfit = Ext.Serialize('FrmBenefit').getElement();
	Ext.EQuery.construct(navigation, Ext.Join([frmBenfit]).object() );
	Ext.EQuery.postContent();
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 

 Ext.DOM.Clear = function()
{
	Ext.Serialize('FrmBenefit').Clear();
	new Ext.DOM.SearchBenfit();
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

 Ext.DOM.DeleteBenefit = function()
 {
	var chk_benfit = Ext.Cmp('BenefitId').getValue();
	
	if( chk_benfit!='' )
	{
		if( Ext.Msg('Do you want deleted this rows ').Confirm() )
		{
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +'/SetBenefit/Delete/',
				method 	: 'POST',
				param 	: {
					BenefitId : chk_benfit
				},
				ERROR : function(fn){
					try
					{
						var ERR = JSON.parse(fn.target.responseText)
						if( ERR.success )
						{
							Ext.Msg('Delete Benefit rows').Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg('Delete Benefit rows').Failed();
						}	
					}
					catch(e){ Ext.Msg(e).Error(); }
				}
			}).post();
		}	
	}		
		
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : Ext.DOM.AddBenefit 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.AddBenefit = function()
{

	Ext.ShowMenu(new Array('SetBenefit','AddBenefit'),
	Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()	
	});
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : Ext.DOM.AddBenefit 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.EditBenefit = function()
{	
   if(Ext.Cmp('BenefitId').getValue().length == 1 ) {
	 Ext.ShowMenu(new Array('SetBenefit','EditBenefit'),
	 Ext.System.view_file_name(), 
	{
		BenefitId : Ext.Cmp('BenefitId').getValue(),
		Duration  : Ext.Date().getDuration()
	});
	
  } else {
	  Ext.Msg('Please select a rows ').Info();
	  return false;
  }	 
  
}

		

</script>

<fieldset class="corner">
 <?php echo form()->legend(lang(""), "fa-bars"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
<form name="FrmBenefit">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product','Code'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('benef_product_id','select superlong',Product(), _get_exist_session('benef_product_id'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Plan');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('benef_plan_id','select superlong',ProductPlanName(), _get_exist_session('benef_plan_id'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product','Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('benef_product_name','input_text superlong',_get_exist_session('benef_product_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('benef_status','select superlong',Flags(),_get_exist_session('benef_status') );?></div>
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
	
	