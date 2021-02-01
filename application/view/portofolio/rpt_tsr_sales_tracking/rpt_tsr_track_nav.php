<form name="frmReport">
<script>
	Ext.DOM.ListAtm=function()
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/TsrSalesTrackingReport/GroupFilterBy/',
			param 	: {
				FilterId : Ext.Cmp('FilterBy').getValue()
			}
		}).load('list_spv');
		Ext.DOM.ListTL('');
	}
	
	Ext.DOM.ListTL=function()
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/TsrSalesTrackingReport/GroupFilterTL/',
			param 	: {
				FilterId : Ext.Cmp('spvname').getValue()
			}
		}).load('list_tl');
	}
	
	Ext.DOM.ListCmp=function()
	{
		Ext.Ajax
		(
			{
				url		: Ext.DOM.INDEX +'/TsrSalesTrackingReport/GroupFilterCmp/',
				param	: 	{
								FilterId : Ext.Cmp('tlname').getValue()
							}
			}
		).load('list_cmp');
	}
	
	Ext.DOM.ShowReport=function()
	{
		if(Ext.Cmp('FilterBy').getValue()=='')
		{
			alert('Please Choose Filter!');
		}
		else if(Ext.Cmp('spvname').getValue()=='')
		{
			alert('Please Choose Supervisor!');
		}
		else if(Ext.Cmp('tlname').getValue()=='')
		{
			alert('Please Choose Team Leader!');
		}
		else if(Ext.Cmp('cmpname').getValue()=='')
		{
			alert('Please Choose Campaign!');
		}
		else if(Ext.Cmp('start_date').getValue()=='' && Ext.Cmp('end_date').getValue()=='')
		{
			alert('Please Choose Interval!');
		}
		else if(Ext.Cmp('ModeBy').getValue()=='')
		{
			alert('Please Choose Mode!');
		}
		else
		{
			Ext.Window
			(
				{
					url 	: Ext.DOM.INDEX +'/TsrSalesTrackingReport/ShowReport/',
					param	: 	{
									filter_by : Ext.Cmp('FilterBy').getValue(),
									spv_id : Ext.Cmp('spvname').getValue(),
									tl_id : Ext.Cmp('tlname').getValue(),
									cmp_id : Ext.Cmp('cmpname').getValue(),
									start_date : Ext.Cmp('start_date').getValue(),
									end_date : Ext.Cmp('end_date').getValue(),
									mode : Ext.Cmp('ModeBy').getValue()
								}
				}
			).newtab();
		}
	}
	
	Ext.DOM.ShowExcel = function()
	{
		Ext.Window
		({
			url 	: Ext.DOM.INDEX +'/TsrSalesTrackingReport/ShowExcel/',
			param 	: { 
				filter_by : Ext.Cmp('FilterBy').getValue(),
				spv_id : Ext.Cmp('spvname').getValue(),
				tl_id : Ext.Cmp('tlname').getValue(),
				cmp_id : Ext.Cmp('cmpname').getValue(),
				start_date : Ext.Cmp('start_date').getValue(),
				end_date : Ext.Cmp('end_date').getValue(),
				mode : Ext.Cmp('ModeBy').getValue()
			}
		}).newtab();
	}
	
	Ext.query('.date').datepicker({
			showOn : 'button', 
			buttonImage : Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
			buttonImageOnly	: true, 
			dateFormat : 'dd-mm-yy',
			readonly:true		
		});
</script>
<fieldset class="corner" style='margin-top:-10px;'>
<legend class="icon-menulist">&nbsp;&nbsp;Group Filter </legend>
<div>
	<table cellpadding='4' cellspacing=4>
		<tr>
			<td class="text_caption bottom">Filter By </td>
			<td><?php __(form()->combo('FilterBy','select long', $filterby, null, array("change" => "Ext.DOM.ListAtm(this)") ));?></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">ATM</td>
			<td><span id="list_spv"><?php __(form()->combo('spvname','select long', array(), null ));?></span></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Supervisor</td>
			<td><span id="list_tl"><?php __(form()->combo('tlname','select long', array(), null ));?></span></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Campaign</td>
			<td><span id="list_cmp"><?php __(form()->combo('cmpname','select long', array(), null ));?></span></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Interval </td>
			<td class='bottom'>
				<?php __(form()->input('start_date','input_text box date'));?> &nbsp-
				<?php __(form()->input('end_date','input_text box date'));?>
			</td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Mode</td>
			<td><?php __(form()->combo('ModeBy','select long', $modeby, null, null));?></td>
		</tr>
		
		<tr>
			<td class="text_caption"> &nbsp;</td>
			<td class='bottom'>
				<?php __(form()->button('','page-go button','Show',array("click"=>"Ext.DOM.ShowReport();") ));?>
				<?php __(form()->button('','excel button','Export',array("click"=>"Ext.DOM.ShowExcel();") ));?>
			</td>
		</tr>
	</table>
</div>
</fieldset>
</form>