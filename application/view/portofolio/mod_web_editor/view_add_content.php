<?php echo javascript(); ?>


<script>

/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();


Ext.DOM.CancelQuality = function(){
 if(Ext.Msg('Do you want exit from this session ?' ).Confirm() )
 {
	Ext.EQuery.Ajax
	({
		url 	: Ext.DOM.INDEX+"/MgtViewFaqContent/index/",
		method 	: 'GET',
		param 	: {
			act: 'back'
		}
	});
  }	
}
/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
 var onloadTinyMCE = function()
{	

	var editor = window.frames[0].tinyMCE;

	if( typeof(editor)=='object' ||  
		typeof(editor)=='function')
	{
	
		if(editor.isLoaded)
		{
			//editor.setContent('<span>some</span> html');
			Ext.DOM.WebResizer(editor);
			editor.addEvent(editor.getInstanceById("web_editor").getWin(), "resize", function(){
				var allowHeight = parseInt(getCookie('TinyMCE_mce_editor_0_height'));
				var allowWidth = parseInt(getCookie('TinyMCE_mce_editor_0_width'));
				if( parseInt(allowWidth) > 0 ){
					Ext.Cmp("web_editor_1").setAttribute('height',parseInt(allowHeight)+20);
					Ext.Cmp("web_editor_1").setAttribute('width',parseInt(allowWidth)+25);
				}	
			});
		}	
	}
}
 
/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */ 
Ext.document().ready(function(){
	var WindowFrame = Ext.Cmp("web_editor_1").getElementId();
		WindowFrame.src = Ext.DOM.LIBRARY+"/pustaka/tinymcpuk/index.php?time="+Ext.Date().getDuration();
		WindowFrame.frameborder=1; 
		WindowFrame.height = '100%';
		WindowFrame.scrolling="no"
	
/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
 
	$('#toolbars').extToolbars
	({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Cancel']],
		extMenu  :[['CancelQuality']],
		extIcon  :[['cancel.png']],
		extText  :true,
		extInput :false,
		extOption: []
	});
});


/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
 
var getCookie=function(cname)
{
	var name = cname + "=";
	var ca = window.frames[0].document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
	  {
	  var c = ca[i].trim();
	  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	  }
	return "";
} 


/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
 
Ext.DOM.SaveWebEditor = function()
{
	var Content = window.frames[0].tinyMCE.getContent('web_editor'),
		CategoryId  = Ext.Cmp('CategoryId').getValue(),
		SubCategoryId = Ext.Cmp('SubCategoryId').getValue(), 
		Title = Ext.Cmp('Title').getValue(),
		Keywords = Ext.Cmp('Keywords').getValue(),
		Publish = Ext.Cmp('Publish').getValue()
	
	Ext.Ajax
	({
		url : Ext.DOM.INDEX+"/MgtAddFaqContent/SaveContent/",
		method :'POST',
		param :{
			Content : escape(Content), 
			CategoryId : CategoryId, 
			SubCategoryId : SubCategoryId, 
			Title : Title,
			Keywords : Keywords, 
			Publish :  Publish 
		},
		
		
		
		ERROR :function(e){
			Ext.Util(e).proc(function(save){
				if( save.success){
					Ext.Msg("Save New Content").Success();
				}
				else{
					Ext.Msg("Save New Content").Failed();
				}
			});
		}
	}).post();
	
}

/*
 * @ def : waduk 
 * -----------------------------
 * @ param : string 
 * @ akses : public 
 */
Ext.DOM.WebResizer  = function(editor){
	var allowHeight = parseInt(getCookie('TinyMCE_mce_editor_0_height'));
	var allowWidth = parseInt(getCookie('TinyMCE_mce_editor_0_width'));
	if( typeof(allowWidth)=='number' && parseInt(allowWidth) > 0 )
	{
		Ext.Cmp("web_editor_1").setAttribute('height',parseInt(allowHeight)+20);
		Ext.Cmp("web_editor_1").setAttribute('width',parseInt(allowWidth)+25);
	}	
}

Ext.DOM.getSubCategory = function(object){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX+'/MgtAddFaqContent/getSubCategoryId/', 
		param:{ 
			CategoryId: object.value 
		}
	}).load("divSubCategory");
}

</script>

<fieldset class="corner" style="background-color:white;margin:3px;">
	<legend class="icon-application">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
	<div id="toolbars"></div>
	<div class ="box-shadow" style="resize:both;overflow:auto;margin:10px;border:0px solid #000;">
	<table border=0 width="100%" align="left" cellspacing=1 cellpadding=0>
		<tr>
			<td class="text_caption" width="8%">* Category</td>
			<td><?php echo form()->combo('CategoryId','select long',$Category,null,array("click"=>"Ext.DOM.getSubCategory(this);"));?></td>
		</tr>
		<tr>
			<td class="text_caption" width="8%">* Sub Category</td>
			<td colspan=3><span id="divSubCategory"><?php echo form()->combo('SubCategoryId','select long',$SubCategory,null,array('style'=>'width:815px;'));?></span></td>
		</tr>
		
		<tr>
			<td class="text_caption" width="8%">* Title</td>
			<td><?php echo form()->textarea('Title','textarea long',null,null,array('style'=>'width:780px;height:25px;resize:both;overflow:auto;'));?></td>
		</tr>
		
		<tr>
			<td class="text_caption">Content</td>
			<td valign="middle" style="padding-left:-10px;"> 
				<iframe onload="onloadTinyMCE();" name="iframe_web_editor" id="web_editor_1" style="text-align:left;margin:0px;border:0px solid #000;"></iframe>
			</td>
		</tr>
		<tr>
			<td class="text_caption" width="8%">Tags</td>
			<td><?php echo form()->textarea('Keywords','textarea long',null,null,array('style'=>'width:780px;height:25px;resize:both;overflow:auto;'));?></td>
			
		</tr>
		<tr>	
			<td class="text_caption" width="8%">Publish</td>
			<td><?php echo form()->combo('Publish','select long',$Publish,null);?></td>
		</tr>
		
		<tr>	
		<td class="text_caption" width="8%">&nbsp;</td>
			<td>
				<input type="button" class="save button" onclick="Ext.DOM.SaveWebEditor();" value="Save"> 
			</td>
		</tr>
		
		
	<table>	
</div>	
</fieldset>			