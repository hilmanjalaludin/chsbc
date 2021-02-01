<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.Shutdown = function()
 {
	 Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/ServerMonitoring/shutdown/',
			method 	: 'GET',
			param 	: {time : Ext.Date().getDuration() },
			ERROR 	: function(object) 
			{
				Ext.Util(object).proc(function(success){
					if( success.error )
					{
						Ext.Msg("Request Command Success!").Info();
					}
				});
				
			}
	}).post();	
}	
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.Reboot = function(){
	 Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/reboot/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) 
		{
			Ext.Util(object).proc(function(success){
				if( success.error ){
					Ext.Msg("Request Command Success!").Info();
				}
			});
		}
	}).post();	
}	
 
  
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.Centerback = function() {
	 Ext.Ajax 
	 ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/restartCenterback/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) 
		{
			Ext.Msg(object.currentTarget.responseText).Info();
		}
	}).post();	
}	

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.Apache = function() {
	 Ext.Ajax 
	 ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/restartHttpd/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) 
		{
			Ext.Util(object).proc(function(success){
					if( success.error )
					{
						Ext.Msg("Request Command Success!").Info();
					}
				});
		}
	}).post();	
}	
 
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.MYSQL = function() {
	 Ext.Ajax
	 ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/restartMYSQL/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) 
		{
			Ext.Util(object).proc(function(success){
					if( success.error )
					{
						Ext.Msg("Request Command Success!").Info();
					}
				});
		}
	}).post();	
}	

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.Network = function() {
	 Ext.Ajax 
	 ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/restartNetwork/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) 
		{
			Ext.Util(object).proc(function(success){
					if( success.error )
					{
						Ext.Msg("Request Command Success!").Info();
					}
				});
		}
	}).post();	
}	
 
 
 
 
$(function(){

if( Ext.Session('HandlingType').getSession() == Ext.DOM.USER_SYSTEM_LEVEL ) {
	var EXT_TITLE  = [['Shutdown'],['Reboot'],['Restart Apache'],['Restart MYSQL'],['Restart Centerback'],[]];
	var EXT_MENU   = [['Shutdown'],['Reboot'],['Apache'],['MYSQL'],['Centerback'],[]];
	var EXT_ICON   = [['database_gear.png'],['computer.png'],['computer.png'],['database_refresh.png'],['connect.png'],[]];
	var EXT_RENDER = 5;
}
else{
	var EXT_TITLE  = [['Shutdown'],['Reboot'],['Restart Apache'],['Restart MYSQL'],['Restart Centerback'],[]];
	var EXT_MENU   = [['Shutdown'],['Reboot'],['Apache'],['MYSQL'],['Centerback'],[]];
	var EXT_ICON   = [['database_gear.png'],['computer.png'],['computer.png'],['database_refresh.png'],['connect.png'],[]];
	var EXT_RENDER = 3;
}

	$('#toolbars').extToolbars({
		extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Shutdown'],['Reboot'],['Restart Centerback'],[]],
		extMenu  :[['Shutdown'],['Reboot'],['Centerback'],[]],
		extIcon  :[['database_gear.png'],['computer.png'],['connect.png'],[]],
		extText :true,
		extInput:true,
		extOption:[{ render:EXT_RENDER,type:'label',label:'..',id:'loading-content',name:'loading-content'} ]
	});
}); 

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.ServerActivity = function()
{
	Ext.Cmp("loading-content").setText("<span style='color:red;'><img src='"+Ext.DOM.LIBRARY+"/gambar/loading.gif' height='10'>&nbsp;wait..</span>");
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/ServerMonitoring/ServerInfo/',
		method 	: 'GET',
		param 	: {time : Ext.Date().getDuration() },
		ERROR 	: function(object) {
			var disk = '', networks = ''; 
			
			Ext.Util(object).proc(function(info)
			{
				Ext.Cmp('system_uptime').setText(info.server.sys_uptime);
				Ext.Cmp('sys_load_avg').setText(parseFloat(info.server.sys_load.sys_load_avg).toFixed(2));
				Ext.Cmp('sys_load_cpu').setText(parseFloat(info.server.sys_load.sys_load_cpu).toFixed(2));
				Ext.Cmp('sys_memory_apps').setText((parseFloat(info.server.sys_memory.sys_memory_apps)/1024).toFixed(2)+'&nbsp;MB&nbsp;<b>Of</b>&nbsp;'+
					(parseFloat(info.server.sys_memory.sys_memory_tot)/1024).toFixed(2)+' MB '+
					(parseFloat(info.server.sys_memory.sys_memory_used)).toFixed(2)+' %');
					
				Ext.Cmp('sys_swap_used').setText((parseFloat(info.server.sys_swap.sys_swap_used)/1024).toFixed(2)+'&nbsp;MB&nbsp;<b>Of</b>&nbsp;'+
					(parseFloat(info.server.sys_swap.sys_swap_tots)/1024).toFixed(2)+' MB ');	
				if( typeof (info.server.sys_disk) =='object') for( var idisk in info.server.sys_disk ){
					disk+="<table cellspacing=1>"+
							"<tr>"+
								"<td class='bottom text_caption'><label class='long' id='disk_name'>"+idisk+"</label></td>"+
								"<td class='bottom'>"+
									"<span class='long label' id='disk_free'>"+(parseFloat(info.server.sys_disk[idisk].disk_free)/1024/1024).toFixed(2)+" GB Of</span> &nbsp; "+
									"<span class='long label' id='disk_size'>"+(parseFloat(info.server.sys_disk[idisk].disk_size)/1024/1024).toFixed(2)+" GB Free</span> &nbsp; "+
									"<span class='long label' id='percent_free'>"+(parseFloat(info.server.sys_disk[idisk].free_disk_size)).toFixed(2)+" %</span><br>"+
								"</td>"+
							"</tr>"+
						"</table> ";
				}
				
				networks+="<table cellspacing=1>";
				if( typeof (info.server.sys_network) =='object') for( var netwoks in info.server.sys_network ){
					for( var inetwork in info.server.sys_network[netwoks] )
					{
						var listnetworks = info.server.sys_network[netwoks];
						if( listnetworks )
						{
							var results = inetwork.split('_');
							if( results )
							{
								networks+= "<tr>"+
										"<td class='bottom text_caption'><strong>"+listnetworks[inetwork].net_name+" ( "+results[0].toUpperCase()+" ) </strong>: </td>"+
										"<td class='bottom'>"+
											"<span class='label' id='disk_free'>"+(parseFloat(listnetworks[inetwork].avg)).toFixed(3)+" KB/s</span> &nbsp;"+
										"</td>"+
									"</tr>";
							}	
						}	
					}	
				}
				
				networks+="<table>";
				Ext.Cmp("disk_system").setText(disk);
				Ext.Cmp("networklist").setText(networks);
			});
			
			Ext.Cmp("loading-content").setText("");	
		}
	}).post();
 }
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 				
 Ext.document().ready(function(){
	Ext.DOM.ServerActivity();
	 Ext.DOM.setTimeOutId = setInterval(function(){
		Ext.DOM.ServerActivity();
	},5000);
 }); 
 	
</script>
<style>
.label{font-size:11px;font-family:Consolas;padding-left:2px;color:#8b3f07;margin:4px 2px 4px 2px;padding:4px 2px 4px 2px;}
</style>
<fieldset class="corner" style="background-color:white;">
<legend class="icon-userapplication">&nbsp;&nbsp;<span id="legend_title"></span></legend>
<div id="toolbars" class="toolbars"></div>
<div id="content_table" class="content_table">
<table cellspacing=1 cellpadding=3 border=0 width='100%' align="left">
	<tr>
		<td class="text_caption bottom" nowrap width="10%"><strong>System Uptime</strong> : </td>
		<td class="bottom" width="70%"><label class="long label" id="system_uptime">&nbsp;</div></td>
	</tr>
	<tr>
		<td class="text_caption bottom"><strong>Processor</strong></td>
		<td class="bottom">
			<table cellspacing=1>
				<tr>
					<td class="text_caption bottom"><strong>Load AVG</strong> : </td>
					<td class="bottom"><label class="long label" id="sys_load_avg">&nbsp;</label></td>
				</tr>
				<tr>
					<td class="text_caption bottom"><strong>CPU</strong> : </td>
					<td class="bottom"><label class="long label" id="sys_load_cpu">&nbsp;</label></td>
				</tr>
			</table> 
		</td>
	</tr>
	<tr>
        <td class="text_caption bottom"><strong>Memory Used</strong></td>
        <td class="bottom">
        	<table cellspacing=1>
        		<tr>
			        <td class="text_caption bottom"><strong>App</strong> : </td>
			        <td class="bottom"><label class="long label" id="sys_memory_apps">&nbsp;</label><br></td>
			      </tr>
			      <tr>
			        <td class="text_caption bottom top"><strong>Swap</strong> : </td>
			        <td class="bottom"> <label class="long label" id="sys_swap_used">&nbsp;</label> </td>
			      </tr>
        	</table> 
        </td>
      </tr>
      <tr>
        <td class="text_caption bottom"><strong>Disk</strong> : </td>
        <td class="bottom"> <div id="disk_system"></div></td>
      </tr>
      <tr>
			<td class="text_caption bottom"><strong>Network</strong></td>
			<td class="bottom"><div id="networklist">&nbsp;</div></td>
      </tr>
</table>
</div>
</fieldset>	
	