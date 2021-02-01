<?php

?>
<script type="text/javascript">
	Ext.DOM.Validasi = function()
	{
		var conds = false;
		
		if(Ext.Cmp('cbo_product').empty())
		{
			alert('Product is Empty!!');
			conds = false;
		}
		else if(Ext.Cmp('cbo_campaign').empty())
		{
			alert('Campaign is Empty!!');
			conds = false;
		}
		else if(Ext.Cmp('start_date').empty() && Ext.Cmp('end_date').empty())
		{
			alert('Interval Date is Empty!!');
			conds = false;
		}
		else{
			conds = true;
		}
		
		return conds;
	}
	
	Ext.DOM.showHtml = function()
	{
		var start_date 	 = Ext.Cmp('start_date').getValue();
		var end_date 	 = Ext.Cmp('end_date').getValue();
		var cbo_product  = Ext.Cmp('cbo_product').getValue();
		var cbo_campaign = Ext.Cmp('cbo_campaign').getValue();
		
		if(Ext.DOM.Validasi())
		{
			Ext.Window({
				url : Ext.DOM.INDEX +'/DetailSalesReport/showHtml/',
				method : 'GET',
				param :{
					start_date 	 : start_date,
					end_date 	 : end_date,
					cbo_product  : cbo_product,
					cbo_campaign : cbo_campaign
				}
			}).newtab();
		}
	}
	
	Ext.DOM.showExcel = function()
	{
		var start_date 	 = Ext.Cmp('start_date').getValue();
		var end_date 	 = Ext.Cmp('end_date').getValue();
		var cbo_product  = Ext.Cmp('cbo_product').getValue();
		var cbo_campaign = Ext.Cmp('cbo_campaign').getValue();
		
		if(Ext.DOM.Validasi())
		{
			Ext.Window({
				url : Ext.DOM.INDEX +'/DetailSalesReport/showExcel/',
				method : 'GET',
				param :{
					start_date 	 : start_date,
					end_date 	 : end_date,
					cbo_product  : cbo_product,
					cbo_campaign : cbo_campaign
				}
			}).newtab();
		}
	}
	
	var ClearNav = function()
	{
		Ext.Cmp('start_date').setValue('');
		Ext.Cmp('end_date').setValue('');
		Ext.Cmp('cbo_product').setValue('');
		loadCampaign();
	}
	
	var loadCampaign = function()
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/DetailSalesReport/loadCampaignByProduct/',
			param 	: {
				id : Ext.Cmp('cbo_product').getValue()
			}
		}).load('span_load_campaign');
	}
	
	$(function(){
		$('#toolbars').extToolbars({
			extUrl   : Ext.DOM.LIBRARY +'/gambar/icon',
			extTitle : [['Show HTML'],['Show Excel'],['Clear']],
			extMenu  : [['showHtml'],['showExcel'],['ClearNav']],
			extIcon  : [['html.png'],['page_white_excel.png'],['cancel.png']],
			extText  :true,
			extInput :false,
			extOption:[]
		});
		
		$('.date').datepicker({
			dateFormat	: 'dd-mm-yy', yearRange: "1945:2030",
			changeYear	: true, changeMonth	: true,
			onSelect	: function(date){
				if(typeof(date) =='string'){
					// if(new Date(date.replace(/-/gi,"/")) > new Date()) {
						// alert('Invalid Date');

						// Ext.Cmp($(this).attr('id')).setValue('');
					// }
					// else{
						// return false;
					// }
				}	
			}
		}); 
		
		Ext.Cmp('cbo_product').listener
		({
			'onChange' : function(e){
				Ext.Util(e).proc(function(obj){
					loadCampaign();
				});
			}
		});
	});
</script>
<fieldset class="corner" style="width:50%;float:left;">
	<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">Order Report</span></legend>
	<div class="box-shadow">
		<table border=0 width='59%'>
			<tr>
				<td class="text_caption bottom">* Product</td>
				<td style="vertical-align:top;"><?php echo form()->combo('cbo_product','select',$Product,NULL); ?></td>
				</tr>
				<tr>
				<td class="text_caption bottom" rowspan="1">* Campaign</td>
				<td style="vertical-align:top;" rowspan="1"><span id="span_load_campaign"><?php __(form()->listCombo('cbo_campaign',null,array(),NULL,null,array())); ?></span></td>
			</tr>
			<tr>
				<td class="text_caption bottom">* Interval</td>
				<td style="vertical-align:top;"><?php echo form()->input('start_date','date input_text',null,NULL);?>&nbsp;-&nbsp;<?php echo form()->input('end_date','date input_text',null,NULL);?></td>
			</tr>
		</table>
	</div>
	<div id="toolbars" style="margin-top:10px;margin-left:1px;margin-bottom:10px;"></div>
</fieldset>