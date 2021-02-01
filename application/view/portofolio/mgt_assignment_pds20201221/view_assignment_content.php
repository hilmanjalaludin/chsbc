<?php echo javascript(); ?>
<script type="text/javascript">

/* -------------------------------------------------------*/
Ext.DOM.AjaxStart = function()
{
	Ext.Cmp('loading_time').setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'>");
}

/* -------------------------------------------------------*/

Ext.DOM.AjaxStop = function()
{
	Ext.Cmp('loading_time').setText('<span style="color:#DDDDDD;">-</span>');
}

/* -------------------------------------------------------*/

Ext.DOM.Submit = function() 
{
	if(!Ext.Cmp('CampaignId').empty()) {
		Ext.DOM.AjaxStart();
		Ext.Ajax
		({ 
			url 	: Ext.DOM.INDEX +'/MgtAssignment/getAssignContent', 
			method 	: 'GET', 
			param 	: { 
				CampaignId 		: Ext.Cmp('CampaignId').getValue(),
				CustomerCity 	: Ext.Cmp('CustomerCity').getValue(),
				GenderId 		: Ext.Cmp('GenderId').getValue(),
				StartAge 		: Ext.Cmp('StartAge').getValue(),
				EndAge 			: Ext.Cmp('EndAge').getValue()
				
			} 
		}).load('main_content');			
	}	
}

/* -------------------------------------------------- */

Ext.query(function()
{
	Ext.query('.autocomplete').autocomplete(
		Ext.DOM.INDEX +'/AutoComplete/City/', 
		{ 
			max : 100, 
			minChars : 2,
			delay :  8, 
			scrollHeight : 150 
		}
	);
});	

/* -------------------------------------------------------*/

Ext.DOM.clearDistribute = function()
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/MgtAssignment/getAssignContent/',
		method  : 'GET',
		param 	: { CampaignId : Ext.Cmp('CampaignId').getValue() }
	}).load("main_content");
}

/* -------------------------------------------------------*/

Ext.query(function()
{
	Ext.query('#toolbars').extToolbars
	({
		extUrl   :Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle :[['Go Back'],['Distribusi'],['Clear'],[]],
		extMenu  :[['GoBack'],['Distribusi'],['clearDistribute'],[]],
		extIcon  :[['server_go.png'],['server_go.png'],['cancel.png'],[]],
		extText  :true,
		extInput :true,
		extOption:[
			{
				render : 3,
				type : 'label',
				id : 'loading_time',
				name : 'loading_time',
				label : '<span style="color:#DDDDDD;">-</span>',
			}
		]
	});
	
});
	
//////////////////////////////////////////////////////////

Ext.DOM.GoBack = function(){
	Ext.Ajax ({ 
		url : Ext.DOM.INDEX +'/MgtAssignment/index', 
		method:'GET',param: {} 
	}).load("main_content");
}
	
	

/* ------------------------------------------------------------ */
 // load data list agent looking here 
 
Ext.DOM.UserLevelDetail = function()
{
   if( Ext.Cmp('distribusi_level').empty() )
   {
		Ext.Cmp("UserLevelList").setText('');
		Ext.Cmp("UserLevelContent").setText("");
		Ext.Cmp("_header_text_label").setText("");
   }
	else
	{
		Ext.Cmp("_header_text_label").setText(Ext.Cmp('distribusi_level').getText());
		Ext.Cmp("UserLevelList").setText(Ext.Cmp('distribusi_level').getText());
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/MgtAssignment/getUserByLevelLogin/', 
			method 	: 'GET',
			param 	: {
				UserLevel : Ext.Cmp('distribusi_level').getValue()
			}
		}).load('UserLevelContent');
	}
	
}	


/* 
 * @ def : getUserByLevel 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
 
Ext.DOM.AssignPageContent = function(){
	Ext.DOM.getUserByType('');
}
 

/* 
 * @ def : getUserByLevel 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
Ext.DOM.getUserByLevel = function(combo) 
{
	Ext.DOM.AjaxStart();
	
	Ext.Ajax({
		url		: Ext.DOM.INDEX+'/MgtAssignment/getShowByLevel/',
		method  : 'GET',
		param   :  {
			UserLevel 		: Ext.Cmp(combo.id).getValue(),
			CampaignNumber 	: Ext.Cmp('campaign_number').getValue(),
			CampaignId		: Ext.Cmp('CampaignId').getValue(),
			DistribusiType 	: Ext.Cmp('distribusi_type').getValue(),
			ListUserId		: Ext.Cmp('ListUserId').getValue()
		}
   }).load('show_user_by_level');
   
   // load listener 
   
   Ext.DOM.UserLevelDetail();
   Ext.DOM.AjaxStop();
}
	
//////////////////////////////////////////////////////////	

Ext.DOM.getUserByType = function(combo)
{
	Ext.DOM.AjaxStart();
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/MgtAssignment/getShowByLevel/',
			method  : 'GET',
			param   : {
				UserLevel 		: Ext.Cmp("distribusi_level").getValue(),
				CampaignNumber  : Ext.Cmp('campaign_number').getValue(),
				CampaignId		: Ext.Cmp('CampaignId').getValue(),
				DistribusiType  : Ext.Cmp('distribusi_type').getValue(),
				ListUserId		: Ext.Cmp('ListUserId').getValue()	
			}
		}).load('show_user_by_level');
		
		Ext.DOM.AjaxStop();
	}
	
//////////////////////////////////////////////////////////	

Ext.DOM.getSizeByUser = function()
{
		var UserId = Ext.Cmp('chk_user_id').getValue();
		
		if( UserId !='' )
		{
			var SizeDatas  = new Array();
			for( var x in UserId )
			{
				var ByUserSize   = Ext.Cmp('amount_data_'+UserId[x]).getValue();
					SizeDatas[x] = {'userid': UserId[x],'size':ByUserSize};
					
			}
			return JSON.stringify(SizeDatas);
		}
		else
			return false;
	}
	
//////////////////////////////////////////////////////////	
	
Ext.DOM.BalanceUserSize = function(opt)
{
		
		var array_size_datas  = 0;
		var QtyBalance   = 0;
		var array_result_user = Ext.Cmp('chk_user_id').getValue();
		
		var AllocData  = Ext.Cmp('distribusi_assign').getValue();
			if( array_result_user!='' )
			{	
				for( var i in array_result_user )
				{
					array_size_datas = Ext.Cmp('amount_data_'+array_result_user[i]).getElementId();
					
					if( (array_size_datas.value!=='') )
					{
						QtyBalance += parseInt(array_size_datas.value);
					}
				}
				
				if( parseInt(QtyBalance) > parseInt(AllocData) || AllocData=='' )
				{
					opt.value =0;
					opt.style.borderColor ='red';
				}
				else{
					opt.style.borderColor ='blue';
				}
			}	
			else
				opt.value =0;
	}
	
//////////////////////////////////////////////////////////		
Ext.DOM.valid_check_size = function()
{
		var distribusi_jumlah = parseInt(Ext.Cmp('distribusi_jumlah').getValue());
		var distribusi_assign = parseInt(Ext.Cmp('distribusi_assign').getValue());
		if( distribusi_assign >  distribusi_jumlah )
		{
			Ext.Cmp('distribusi_assign').setValue(0);
			return false;
		}
		else{
			return true;
		}
	}
	
//////////////////////////////////////////////////////////		
	
Ext.DOM.UncheckSize = function(opts)
{
		if( Ext.Cmp('distribusi_type').getValue() ==1 )
		{
			if( !opts.checked){
				Ext.Cmp('amount_data_'+opts.value).setValue(0);
				Ext.Css('amount_data_'+opts.value).style({ borderColor :'#dddbbb'});
			}
			else{
				Ext.Css('amount_data_'+opts.value).style({ borderColor : '#FF4321'});
			}
		}
	}
	
//////////////////////////////////////////////////////////	
Ext.DOM.Distribusi = function()
{
 /* additional of distribusi */
	
	var CustomerCity = Ext.Cmp('CustomerCity').getValue();
	var GenderId = Ext.Cmp('GenderId').getValue();
	var StartAge = Ext.Cmp('StartAge').getValue();
	var EndAge = Ext.Cmp('EndAge').getValue();	
	
 /* main of distribusi */
	
	var CampaignId		= Ext.Cmp('CampaignId').getValue();
	var CampaignNumber 	= Ext.Cmp('campaign_number').getValue();
	var JumlahData 		= Ext.Cmp('distribusi_jumlah').getValue();
	var UserLevel 		= Ext.Cmp('distribusi_level').getValue();
	var DistributeType 	= Ext.Cmp('distribusi_type').getValue();
	var DistributeMode 	= Ext.Cmp('distribusi_mode').getValue(); 
	var AssignData 		= Ext.Cmp('distribusi_assign').getValue();
	var UserSelect 		= Ext.Cmp('chk_user_id').getValue();
	var UserSelectId 	= (DistributeType==1?getSizeByUser():'');
	
	if( JumlahData==0){ alert('Data Size Is Zero!'); return false; }
	else if(UserLevel=='') { alert('Please select user level!'); return false;} 
	else if(DistributeType=='') { alert('Please distribute Type!'); return false; }
	else if(DistributeMode=='') { alert('Please distribute Mode!'); return false; }
	else if(AssignData==''|| AssignData==0) { alert('Please input Assign data !'); return false; }
	else if(UserSelect==''){ alert('Please Select User Id By Level !'); return false; }
	else if(!valid_check_size()) { alert('Assign Data > Data Size !'); return false; }
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/MgtAssignment/AgentDistribusi/',
			method  : 'POST',
			param 	: 
			{
				CampaignId : CampaignId, CampaignNumber : CampaignNumber, 
				JumlahData : JumlahData, AssignData : AssignData, 
				UserLevel : UserLevel,  DistribusiType : DistributeType, 
				DistribusiMode 	: DistributeMode, UserSelectId : UserSelectId, 
				UserSelect : UserSelect, CustomerCity : CustomerCity,
				GenderId : GenderId, StartAge : StartAge,
				EndAge : EndAge
			},
			ERROR : function(fn)
			{
				Ext.Util(fn).proc(function(response)
				{
					if( response.success )
					{
						Ext.Msg("Distribusi Data, Size data : "+ response.message.SizeData +", Size Users : "+ response.message.SizeUsers ).Success();
						Ext.Ajax
						({
							url 	: Ext.DOM.INDEX +'/MgtAssignment/getAssignContent/',
							method  : 'GET',
							param 	: 
							{ 
								CampaignId 		: CampaignId,
								CustomerCity 	: CustomerCity,
								GenderId 		: GenderId,
								StartAge 		: StartAge,
								EndAge 			: EndAge								
							}
						}).load("main_content");
					}
					else
					{
						Ext.Msg("Distribusi Data").Failed();
					}
				});
			}	
		}).post();
	}
}

</script>
<fieldset class="corner">
	<legend class="icon-customers">&nbsp;&nbsp;Content Distribusi </legend>	
	<input type="hidden" name="CampaignId" id="CampaignId" value="<?php echo $Model -> getCampaignId(); ?>"/>
	<!-- start distribute data --> 
	<fieldset class='corner'>
		<legend class='icon-menulist'>&nbsp;&nbsp;Option Filter</legend>
		<div>
			<table cellpadding=2 cellspacing=2>
				<tr>
					<td class="text_caption bottom">City</td>
					<td><?php echo form()->input('CustomerCity','input_text long autocomplete',$params['CustomerCity'],NULL,1);?></td>
					<td class="text_caption bottom">Range of Age</td>
					<td><?php echo form()->input('StartAge','input_text box',$params['StartAge'],NULL,1);?>&nbsp;-&nbsp;<?php echo form()->input('EndAge','input_text box',$params['EndAge'],NULL,1);?></td>
					<td class="text_caption bottom">Gender</td>
					<td><?php echo form()->combo('GenderId','select long',$Combo['Gender'],$params['GenderId'],1);?></td>
					<td class='bottom'><?php echo form()->button('ButtonSave','assign button','Show',array('click' => 'Ext.DOM.Submit();'));?></td>
				</tr>
			</table>
		</div>
		</fieldset>
		
		<!-- start distribute data --> 	
		<fieldset class='corner' style='margin-top:10px;'>
			<legend class='icon-menulist'>&nbsp;&nbsp;Distribute Data </legend>  
		<div>
			
			<table cellpadding=2 cellspacing=2 border=0>
				<tr>
					<td class="text_caption bottom">ID</td>
					<td ><?php echo form()->input('campaign_number','input_text long',$Model -> getCampaignNumber(),NULL,1);?></td>
					<td class="text_caption bottom">Level</td>
					<td><?php echo form()->combo('distribusi_level', 'select long', $Model -> getLevelUser(), NULL,array("change" => "getUserByLevel(this);"),array());?></td>
					<td class="text_caption bottom" valign='middle'>
						<div id="UserLevelList"></div>
					</td>
					<td rowspan='4'>
						<div id="UserLevelContent"></div></td>
				</tr>
				<tr>
				<td class="text_caption bottom">Name</td>
					<td><?php echo form()->input('campaign_name','input_text long',$Model -> getCampaignName(),NULL,1);?></td>
					<td class="text_caption bottom">Type</td>
					<td colspan="2"><?php echo form() -> combo('distribusi_type', 'select long',$Model -> DistribusiType() ,NULL,array("change" => "getUserByType(this);"),array());?></td>
				</tr>
				<tr>
					<td class="text_caption bottom">Data Size</td>
					<td><?php echo form()->input('distribusi_jumlah','input_text long',$Model -> JumlahData(),NULL,array('disabled' => true) );?></td>
					<td class="text_caption bottom" rowspan='2'>Mode</td>
					<td colspan="2" rowspan='2'><?php echo form() -> combo('distribusi_mode', 'select long', $Model -> DistribusiMode());?></td>
				</tr>
				
				<tr>
					<td class="text_caption bottom">Assign Data</td>
					<td><?php echo form()->input('distribusi_assign', 'input_text long','0','onkeyup="valid_check_size();"');?></td>
				</tr>
			</table>
			</div>
			</fieldset>
		<div id="toolbars" style="margin-top:20px;margin-left:1px;"></div>
		<fieldset style="margin-top:20px;border:1px solid #ddd;">
			<legend class="icon-menulist">&nbsp;&nbsp; User By Level&nbsp;<b> <span id="_header_text_label"></span><b></legend>	
			<div id="show_user_by_level" style="background-color:#FFFFFF;"></div>
		</fieldset>
		
</fieldset>	