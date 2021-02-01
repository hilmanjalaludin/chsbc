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
		extTitle  : [['Edit'],['Add Skill'],['Delete'],[],['Search']],
		extMenu   : [['EditAgentSkill'],['AgentSkill'],['DeleteAgentSkill'],[],['SearchSkillWord']],
		extIcon   : [['page_edit.png'],['add.png'],['cross.png'],[],['zoom.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
				render 	: 3,
				type 	: 'text',
				name 	: 'keywords',
				id		: 'keywords',
				value   : datas.keywords
			}]
	});
});

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.EditAgentSkill = function(){
	Ext.Ajax({
		url : Ext.DOM.INDEX +'/CtiUserSkill/EditAgentSkill/',
		method :'GET',
		param:{
			SkillId  : Ext.Cmp('chk_ext').getValue()
		}
	}).load('tpl_header');
	
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.AgentSkill = function()
{
	Ext.Ajax
	({
		url  : Ext.DOM.INDEX +'/CtiUserSkill/ViewAgentSkill/',
		method : 'GET',
		param : {
			duration : Ext.Date().getDuration()
		}
	}).load('tpl_header');		
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.SaveSkill = function()
{

 var agent = Ext.Cmp('agent').getValue(), 
	 skill = Ext.Cmp('skill').getValue(), 
	 score = Ext.Cmp('score').getValue();
	
	if( Ext.Cmp('agent').empty() ){ 
		Ext.Msg("Agent ID Is empty !").Info();}
	else if(Ext.Cmp('skill').empty() ){
		Ext.Msg("Skill is empty!").Info();}
	else if( Ext.Cmp('score').empty() ){
		Ext.Msg("Score Is empty !").Info();}
	else{
	
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CtiUserSkill/SaveUserSkill/',
			method 	: 'POST',
			param 	: {
				agent : agent, 
				skill : skill, 
				score : score
			},
			ERROR : function(fn){
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Save user skill").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Save user skill").Failed();
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
 	
Ext.DOM.UpdateSkill = function()
{
var id	= Ext.Cmp('id').getValue(),
	agent = Ext.Cmp('agent').getValue(), 
	skill = Ext.Cmp('skill').getValue(), 
	score = Ext.Cmp('score').getValue();
	
	if( Ext.Cmp('agent').empty() ){ 
		Ext.Msg("Agent ID Is empty !").Info();}
	else if(Ext.Cmp('skill').empty() ){
		Ext.Msg("Skill is empty!").Info();}
	else if( Ext.Cmp('score').empty() ){
		Ext.Msg("Score Is empty !").Info();}
	else{
	
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CtiUserSkill/UpdateUserSkill/',
			method 	: 'POST',
			param 	: {
				id : id,
				agent : agent, 
				skill : skill, 
				score : score
			},
			ERROR : function(fn){
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Update user skill").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Update user skill").Failed();
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
 	
Ext.DOM.DeleteAgentSkill = function()
{
  if( Ext.Msg("Do you want delete this rows") )
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CtiUserSkill/DeleteUserSkill/',
			method 	: 'POST',
			param 	: { id : Ext.Cmp('chk_ext').getValue() },
			ERROR : function(fn){
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Delete user skill").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete user skill").Failed();
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
 var navigation = {
	custnav  : Ext.DOM.INDEX +'/CtiUserSkill/index/', 
	custlist : Ext.DOM.INDEX +'/CtiUserSkill/Content/', 
};

Ext.EQuery.construct(navigation, datas );
Ext.EQuery.postContentList();

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.ClearSkill = function(){
	Ext.Cmp('tpl_header').setText("");
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
 
Ext.DOM.AddExtension =function(){
	Ext.Ajax({
		url	: Ext.DOM.SYSTEM+'/controller/class.extension.system.php',
		method :'POST',
		param :{
			action : 'add_extension_tpl' 
		}
	}).load('tpl_header');
}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.SearchSkillWord = function()
{
	Ext.EQuery.construct( navigation, {
		keywords : Ext.Cmp('keywords').getValue()
	});
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
	