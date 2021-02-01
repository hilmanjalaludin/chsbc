<script>
	Ext.document(document).ready(function(){
		Ext.query('.date').datepicker ({
			showOn : 'button', 
			buttonImage : Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
			buttonImageOnly	: true, 
			dateFormat : 'dd-mm-yy',
			readonly:true		
		});
	});
	
	Ext.DOM.ShowReport = function()
	{
		Ext.Window
		({
			url 	: Ext.DOM.INDEX +'/RptQaStaffProductivity/ShowReport/',
			param 	: {
				user_a : Ext.Cmp('UserA').getValue(),
				user_b : Ext.Cmp('UserB').getValue(),
				user_h : Ext.Cmp('UserHead').getValue(),
				start_date : Ext.Cmp('start_date').getValue(),
				end_date : Ext.Cmp('end_date').getValue()
			}
		}).newtab();
	}
	
	Ext.DOM.ShowExcel = function()
	{
		Ext.Window
		({
			url 	: Ext.DOM.INDEX +'/RptQaStaffProductivity/ShowExcel/',
			param 	: {
				user_a : Ext.Cmp('UserA').getValue(),
				user_b : Ext.Cmp('UserB').getValue(),
				user_h : Ext.Cmp('UserHead').getValue(),
				start_date : Ext.Cmp('start_date').getValue(),
				end_date : Ext.Cmp('end_date').getValue()
				}
		}).newtab();
	}
</script>
<fieldset class="corner" style='width:50%;float:left;'>
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title">QA Staff Productivity Report</span></legend>
<div id="panel-main-content">
	<table border=0 width="100%">
		<tr>
			<td valign="top">
				<div style="margin-top:-20px;">
					<table cellpadding='4' cellspacing=4>
						<tr>
							<td class="text_caption bottom">User QA A </td>
							<td><?php __(form()->listCombo('UserA','select long', $UserStaff[1], null ));?></td>
							<td class="text_caption bottom">User QA B </td>
							<td> <span id="DivAgent"><?php __(form()->listCombo('UserB','select long', $UserStaff[2] ));?></span></td>
						</tr>
						<tr>
							<td class="text_caption bottom" rowspan="2">User QA Head </td>
							<td rowspan="2"><?php __(form()->listCombo('UserHead','select long', $UserHead ));?></td>
							<td class="text_caption bottom">Interval </td>
							<td class='bottom'>
								<?php __(form()->input('start_date','input_text box date'));?> &nbsp-
								<?php __(form()->input('end_date','input_text box date'));?>
							</td>
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
			</td>
		</tr>
	</table>
</div>