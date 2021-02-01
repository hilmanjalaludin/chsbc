<?php echo javascript(); ?>
<script type="text/javascript">
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })(); 
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.datas = 
{ 
	keywords : '<?php echo _get_post('keywords');?>',
	UserId   : '<?php echo _get_post('UserId');?>', 
	order_by : '<?php echo _get_post('order_by'); ?>', 
	type	 : '<?php echo _get_post('type'); ?>'
}

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
 
$(function(){
	$('#toolbars').extToolbars({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Upload'],['Edit'],['Add'],['Delete'],['Release'],[],['Download'],['Restart Service'],[],['Search'],['']],
		extMenu   : [['UploadExtension'],['EditExtension'],['AddExtension'],['DeleteExtension'],['ReleaseExt'],[],['Download'],['RestartService'],[],['SearchWord'],[]],
		extIcon   : [['page_white_excel.png'],['page_edit.png'],['add.png'],['cross.png'],['phone_add.png'],[],['application_link.png'],['cog_go.png'],[],['zoom.png'],[]],
		extText   : true,
		extInput  : true,
		extOption : [{
				render  : 4,
				header  : 'Template&nbsp;',  
				type	: 'combo',
				id		: 'mode_download', 	
				name 	: 'mode_download',
				value	: '',
				triger	: '',
				store 	: [{'extension_tpl':'Ext Upload'},{'extension_xls':'Ext XLS'}, {'extension_cnf':'Ext Config'}],
				width	: 120
			},{
				render 	: 8,
				type 	: 'text',
				name 	: 'keywords',
				id		: 'keywords',
				value   : Ext.DOM.datas.keywords
			},{
				render 	: 10,
				label	: '',	
				type 	: 'label',
				name 	: 'imgloading',
				id		: 'imgloading'
			}]
	});
});

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.Download = function(){
	Ext.Window
	({
		url : Ext.DOM.INDEX+'/CtiExtension/Download',
		method :'POST',
		param : {
			mode : Ext.Cmp('mode_download').Encrypt()
		}
	}).newtab();
	
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.RestartService = function()
{
	if( confirm('Do you want to restart this service'))
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/CtiExtension/Restart',
			method 	: 'POST',
			param 	: {
				duration : Ext.Date().getDuration()
			},
			ERROR : function(fn){
				try{
					Ext.Msg(fn.target.responseText).Info();
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
			
		}).post();
	}		
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.saveExtension = function()
{
	var pbx 		 = Ext.Cmp('pbx').getValue(), 
		ext_number 	 = Ext.Cmp('ext_number').getValue(),  
		ext_desc 	 = Ext.Cmp('ext_desc').getValue(), 
		ext_type 	 = Ext.Cmp('ext_type').getValue(), 
		ext_status	 = Ext.Cmp('ext_status').getValue(), 
		ext_location = Ext.Cmp('ext_location').getValue();
		
	if( Ext.Cmp('ext_number').empty() ){
		Ext.Msg("Extension Number is empty")
	}	
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CtiExtension/SaveExtension/',
			method 	: 'POST',
			param 	: {
				pbx  		 : pbx, 
				ext_number 	 : ext_number,  
				ext_desc 	 : ext_desc, 
				ext_type 	 : ext_type, 
				ext_status 	 : ext_status, 
				ext_location : ext_location
			},
			
			ERROR : function(fn){
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg('Save Extension').Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg('Save Extension').Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
		
	}
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
Ext.DOM.UpdateExtension = function()
{
	var 
		id			 = Ext.Cmp('id').getValue(),
		pbx 		 = Ext.Cmp('pbx').getValue(), 
		ext_number 	 = Ext.Cmp('ext_number').getValue(),  
		ext_desc 	 = Ext.Cmp('ext_desc').getValue(), 
		ext_type 	 = Ext.Cmp('ext_type').getValue(), 
		ext_status	 = Ext.Cmp('ext_status').getValue(), 
		ext_location = Ext.Cmp('ext_location').getValue();
		
	if( Ext.Cmp('ext_number').empty() ){
		Ext.Msg("Extension Number is empty")}	
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CtiExtension/UpdateExtension/',
			method 	: 'POST',
			param 	: {	
				id			 : id,
				pbx  		 : pbx, 
				ext_number 	 : ext_number,  
				ext_desc 	 : ext_desc, 
				ext_type 	 : ext_type, 
				ext_status 	 : ext_status, 
				ext_location : ext_location
			},
			
			ERROR : function(fn){
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg('Update Extension').Success();
						Ext.EQuery.postContent();

					}
					else{
						Ext.Msg('Update Extension').Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
		
	}
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 	
Ext.DOM.DeleteExtension = function(){
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/CtiExtension/DeleteExtension/',
		method 	: 'POST',
		param 	: { ExtensionId : Ext.Cmp('chk_ext').getValue() },
		ERROR : function(fn){
			try
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg('Delete Extension').Success();
					Ext.EQuery.postContent();	
				}
				else{
					Ext.Msg('Delete Extension').Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
			
	}).post();
}	

	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 var navigation = {	
	custnav  : Ext.DOM.INDEX +'/CtiExtension/index/', 
	custlist : Ext.DOM.INDEX +'/CtiExtension/Content/'
};

Ext.EQuery.construct(navigation, datas );
Ext.EQuery.postContentList();

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.EditExtension = function()
{
	var ExtensionId  = Ext.Cmp('chk_ext').getValue();
	if( ExtensionId!='')
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/CtiExtension/ViewUpdateExtension/',
			method 	: 'POST',
			param 	: {
				ExtensionId : ExtensionId
			}
		}).load('tpl_header');
	}
	else{
		alert('Please select rows!')
	}
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.Upload = function()
{	
 var act_file_name = Ext.Cmp('fileToupload').getValue();
 var mode_action = Ext.Cmp('modus_action').getValue();
	if( act_file_name!='')
		{
			if( confirm('Do you want to upload this file ?')){
				Ext.Cmp("imgloading").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='17px;'> <span style='color:red;'>Wait...</span>");
				Ext.Ajax({
					url		: Ext.DOM.INDEX+'/CtiExtension/Upload/',
					method	: 'POST',
					file	: 'fileToupload',
					param 	: {
						filename 	: act_file_name,
						mode 		: mode_action
					},
					complete:function(e)
					{
					  var response = e.target.responseText;
					  try {
							var ERR = JSON.parse(response);
							Ext.Cmp("imgloading").setText("<span style='color:red;'>Done.</span>");
							
							if( ERR.success ){ Ext.Msg(ERR.error).Success(); }	
							else { 
								Ext.Msg(ERR.error).Failed(); 
							}
						}
						catch(e)
						{
							Ext.Cmp("imgloading").setText("<span style='color:red;'>Done.</span>");
							Ext.Msg(response).Failed(); 
							Ext.Error({log:e, name:'complete' })
						}	
					}
				}).upload();
				
			}
			else{ return false; }
		}
		else 
			alert('Please select file!');
		
	}	


/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.UploadExtension = function()
{
	Ext.Ajax({
		url 	:Ext.DOM.INDEX+'/CtiExtension/PageUpload/',
		method 	: 'POST',
		param 	: {
			action : 'upl_extension_tpl'
		}
	}).load('tpl_header');
}	
	

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.Clear = function(){
	Ext.Cmp('tpl_header').setText('');
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.SearchWord = function()
{
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp('keywords').getValue()
	});
	
	Ext.EQuery.postContent();
}
		

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.Cmp("keywords").listener({
	onKeyup:function( e ){
		if( e.keyCode==13 ){
			Ext.EQuery.construct(navigation,{
				keywords : e.target.value
			});
			Ext.EQuery.postContent();
		}
	}
});

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.ReleaseExt = function()
{
	var ext_number = Ext.Cmp('chk_ext').getValue();
	if( ext_number!='') 
	{
		Ext.Cmp('imgloading').setText('<img src="'+Ext.System.view_library_url()+'/gambar/loading.gif" height="10"> <span style=\"color:red;\"> Wait...</span>');
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/CtiExtension/Release/',
			method 	: 'POST',
			param 	: {
				PbxId : ext_number
			},
			ERROR : function(fn){
				try 
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( typeof(ERR.message) =='object' && ERR.success )
					{
						var replay = "\n";
						for( var r in ERR.message )
						{
							replay += "Ext : "+ ERR.message[r].Ext +" , Status : " + ERR.message[r].status +"\n";
						}
						Ext.Msg(replay).Info();	
					}
					else{
						Ext.Msg("Release Extension").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
				
				Ext.Cmp("imgloading").setText("<span style='color:red;'>Done.</span>");	
			}
			
		}).post()
		
		
	}
	else{
		alert("Please input Or selected Extension Number!");
	}	
}

	
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.AddExtension =function(){
	Ext.Ajax({
		url	: Ext.DOM.INDEX+'/CtiExtension/AddExtensionTpl/',
		method :'POST',
		param : {
			action : Ext.Date().getDuration()
		}
	}).load('tpl_header');
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.searchAgent = function()
{
	Ext.EQuery.construct( navigation, 
		{UserId : Ext.Cmp('v_cmp_user').getValue()});
	Ext.EQuery.postContent();
}
	
</script>
	<fieldset class="corner" style="background-color:white;">
		<legend class="icon-userapplication" >&nbsp;&nbsp;<span id="legend_title"></span></legend>
			<div id="toolbars" class="toolbars"></div>
			<div id="tpl_header"></div>
			<div class="content_table"></div>
			<div id="pager"></div>
			<div id="UserTpl"></div>
	</fieldset>	
	