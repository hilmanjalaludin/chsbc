<script>
Ext.DOM.load_atm = function(param)
{
	Ext.Ajax  
	({
		url    : Ext.DOM.INDEX+"/NewDashboard/load_atm/",
		method : 'POST',
		param  : param
	}).load('span_atm');
	
	Ext.DOM.load_spv({});
	Ext.DOM.load_tso({});
	
	switch( Ext.Cmp('dsb_type').getValue() )
	{
		case 'detail-per-tso' :
			Ext.Cmp('dsb_atm').listener
			({
				'onChange' : function(e){
					Ext.Util(e).proc(function(obj){
						Ext.DOM.load_spv({
							atm : obj.value,
							form : 'combo'
						});
					});
				}
			});
		break;
		
		case 'detail-per-spv' :
			Ext.Cmp('dsb_atm').listener
			({
				'onChange' : function(e){
					Ext.Util(e).proc(function(obj){
						Ext.DOM.load_spv({
							atm : obj.value,
							form : 'listcombo'
						});
					});
				}
			});
		break;
	}
	
	Ext.DOM.load_spv({});
	Ext.DOM.load_tso({});
}

Ext.DOM.load_spv = function(param)
{
	Ext.Ajax  
	({
		url    : Ext.DOM.INDEX+"/NewDashboard/load_spv/",
		method : 'POST',
		param  : param
	}).load('span_spv');
	
	Ext.DOM.load_tso({});
	
	switch( Ext.Cmp('dsb_type').getValue() )
	{
		case 'detail-per-tso' :
			Ext.Cmp('dsb_spv').listener
			({
				'onChange' : function(e){
					Ext.Util(e).proc(function(obj){
						Ext.DOM.load_tso({
							spv : obj.value,
							form : 'listcombo'
						});
					});
				}
			});
		break;
	}
}

Ext.DOM.load_tso = function(param)
{
	Ext.Ajax  
	({
		url    : Ext.DOM.INDEX+"/NewDashboard/load_tso/",
		method : 'POST',
		param  : param
	}).load('span_tso');
}

$(document).ready( function(){
	$('#legend_title').html( Ext.System.view_file_name());
	$('#loader').html( "<span class=\"ui-icon ui-icon-person\"></span>"+Ext.System.view_file_name());
	
	$('.date').datepicker ({ 
	    /* showOn : 'button', buttonImage : Ext.Image("calendar.gif"),  buttonImageOnly	: true,  */
		dateFormat 	: 'dd-mm-yy', 
		readonly	: true, 
		changeYear	: true, 
		changeMonth	: true, 
		maxDate		: '0'
	}).attr('readonly', 'readonly');
	
	Ext.Cmp('dsb_mode').listener
	({
		'onChange' : function(e){
			Ext.Util(e).proc(function(obj){
				switch(obj.value)
				{
					case 'interval' :
						Ext.Cmp('dsb_start').disabled(false);
						Ext.Cmp('dsb_end').disabled(false);
					break;
					
					default :
						Ext.Cmp('dsb_start').disabled(true);
						Ext.Cmp('dsb_end').disabled(true);
						Ext.Cmp('dsb_start').setValue('');
						Ext.Cmp('dsb_end').setValue('');
					break;
				}
			});
		}
	});
	
	Ext.Cmp('dsb_type').listener
	({
		'onChange' : function(e){
			Ext.Util(e).proc(function(obj){
				var type = Ext.Cmp('dsb_type').getValue();
				
				Ext.Ajax  
				({
					url    : Ext.DOM.INDEX+"/NewDashboard/handle_type_mgr/",
					method : 'POST',
					param  : { 
						type : type 
					}
				}).load('span_mgr');
				
				Ext.Ajax  
				({
					url    : Ext.DOM.INDEX+"/NewDashboard/handle_type_atm/",
					method : 'POST',
					param  : { 
						type : type 
					}
				}).load('span_atm');
				
				Ext.Ajax  
				({
					url    : Ext.DOM.INDEX+"/NewDashboard/handle_type_spv/",
					method : 'POST',
					param  : { 
						type : type 
					}
				}).load('span_spv');
				
				Ext.Ajax  
				({
					url    : Ext.DOM.INDEX+"/NewDashboard/handle_type_tso/",
					method : 'POST',
					param  : { 
						type : type 
					}
				}).load('span_tso');
			});
		}
	});
	
	$("#content-tabular-activity").css({ "width" : new Array($(".ui-widget-fieldset-parental").innerWidth(), "px").join("")});
	$("#ui-widget-tabular-tabs").mytab().tabs();
	$('#ui-widget-tabular-tabs').css({ 'background-color':'#FFFFFF'});
	$('#ui-widget-tabular-content').css({ 'background-color':'#FFFFFF'});
	$("#ui-widget-tabular-tabs").mytab().close({}, true);
});

Ext.DOM.ShowDashboard = function()
{
	if( Ext.Cmp('dsb_mode').getValue() && Ext.Cmp('dsb_type').getValue() )
	{
		Ext.Cmp('loader').setText("<span style='color:red;'><img src='"+Ext.DOM.LIBRARY+"/gambar/loading.gif' height='15'> Please wait...</span>");
		Ext.Cmp('ui-widget-tabular-content').setText("<span style='color:red;'>Generating Rows ...</span>");
		
		Ext.Ajax  
		({
			url    : Ext.DOM.INDEX+"/NewDashboard/ShowDashboard/",
			method : 'POST',
			param  : Ext.Join([
				Ext.Serialize("frmDsbFilter").getElement()
			]).object()
		}).load('ui-widget-tabular-content');
		
		Ext.Cmp('loader').setText("<span class=\"ui-icon ui-icon-person\"></span>Daily Activity Dashboard");
	}
	else{
		alert('Please select Mode and Type Dashboard!');
	}
}
</script>
<div class="ui-widget-form-table-compact" style="width:99%;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell ui-widget-content-top" id="content-dial-activity" style="width:75%;">
			<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:-12px 5px 5px -10px; border-radius:5px;">
				<?php echo form()->legend("&nbsp;&nbsp;<span id=\"legend_title\"></span>","fa-table");?>
				<?php $this->load->view("new_dashboard/new_dashboard_filter"); ?>
			</fieldset>	
		</div>
	</div>
	
	<div class="ui-widget-form-row">
		<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:5px 5px 5px -10px; border-radius:5px;">
		<?php echo form()->legend(lang("User Content"),"fa-bars");?>
			<div class="ui-widget-form-cell ui-widget-content-top" id="content-tabular-activity"> 
				<div id="ui-widget-tabular-tabs" class="tabs corner ">
					<ul>
						<li class="ui-tab-li-lasted">
							<a href="#ui-widget-tabular-content">
							<span id="loader"><span class="ui-icon ui-icon-person"></span>Daily Activity Dashboard</span></a>
						</li>
					</ul>	
					<div id="ui-widget-tabular-content" style="z-index:-1;"></div>
				</div>
			</div>
		</fieldset>
	</div>
</div>