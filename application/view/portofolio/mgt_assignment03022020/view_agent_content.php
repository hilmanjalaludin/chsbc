<script>

/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
Ext.DOM.ShowDetail = function()
{
	Ext.Window
	   ({
			url : Ext.DOM.INDEX +'/MgtAssignment/ShowDataDetail/', 
			param :{
				UserId 	: Ext.Cmp("agent_name").getValue(),
				CallResult : Ext.Cmp("call_result").getValue(),
				CampaignId : Ext.Cmp("CampaignId").getValue()
			}
	   }).newtab();
	
} 
 
Ext.document().ready(function(){

 Ext.query('#toolbars').extToolbars
 ({
	extUrl   :Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle :[['Go Back'],['Distribusi'],['Clear']],
	extMenu  :[['GoBack'],['Distribusi'],['clearDistribute']],
	extIcon  :[['server_go.png'],['server_go.png'],['cancel.png']],
	extText  :true,
	extInput :false,
	extOption:[]
 });
			
 Ext.query('#MyBars').extToolbars
 ({
	extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle : [['Show Data'],[],[],[],[],['Show Detail'],[]], 
	extMenu  : [['ShowDatas'],[],[],[],[],['ShowDetail'],[]],
	extIcon  : [['page_find.png'],[],[],[],[],['page_go.png'],[]],
	extText  : true,
	extInput : true,
	extOption: [{
			type  	: 'label',
			name  	: 'label_text',
			id 	  	: 'label_text',
			label 	: '<span style="color:#FF4321;"># Size Data</span>',
			render	: 1 },
		{
			type  	: 'label',
			name  	: 'label_asign',
			id 	  	: 'label_asign',
			label 	: '<psan style="color:#FF4321;"># Assign Data</span>',
			render	: 3
		},{
			render : 2,
			type   : 'text',
			id 	   : 'size_data_show',
			name   : 'size_data_show',
			value  : 0,
		},{
			render : 4,
			type   : 'text',
			id 	   : 'size_asign_data',
			name   : 'size_asign_data',
			value  : 0,
		},{
			render : 6,
			type   : 'label',
			label  : '<span style="color:#dddddd;">-</span>',	
			id 	   : 'ajaxload',
			name   : 'ajaxload',
			value  : 0,
		}
	]
	
  });
	
	Ext.Cmp('size_data_show').disabled(true);
	
	Ext.Cmp("size_asign_data").listener
	({
		onKeyup : function(e){
			Ext.Util(e).proc(function(obj){
				var AssgData = parseInt(Ext.Cmp('size_data_show').getValue()); 
				if( parseInt(obj.value) <= AssgData ) {
					Ext.Cmp('distribusi_assign').setValue(obj.value);
					Ext.Cmp('distribusi_assign').disabled(true);
				}
				else{
					Ext.Cmp('distribusi_assign').setValue(0);
					Ext.Cmp('distribusi_assign').disabled(true);
				}
			});
		} 
	})
});


	
//////////////////////////////////////////////////////////	
	
Ext.DOM.BalanceUserSize = function(opt) 
{		
	var array_size_datas  = 0;
	var QtyBalance   = 0;
	var array_result_user = Ext.Cmp('chk_user_id').getValue();
	
	var AllocData  = Ext.Cmp('distribusi_assign').getValue();
	if( array_result_user!='' )
	{	
		for( var i in array_result_user ){
			array_size_datas = Ext.Cmp('amount_data_'+array_result_user[i]).getElementId();
			if( (array_size_datas.value!=='') ){
				QtyBalance += parseInt(array_size_datas.value);
			}
		}
				
		if( parseInt(QtyBalance) > parseInt(AllocData) || AllocData=='' ){
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
	
/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 	
Ext.DOM.UncheckSize = function(opts)
{
	if( Ext.Cmp('distribusi_type').getValue() ==1 )
	{
		if( !opts.checked){
			Ext.Cmp('amount_data_'+opts.value).setValue(0);
			Ext.Cmp('amount_data_'+opts.value).disabled(true);
			Ext.Css('amount_data_'+opts.value).addClass('input_text date');
			Ext.Css('amount_data_'+opts.value).style({'border':'1px solid silver'});
		}
		else{
			Ext.Css('amount_data_'+opts.value).addClass('input_text date');
			Ext.Css('amount_data_'+opts.value).style({'border':'1px solid red'});
			Ext.Cmp('amount_data_'+opts.value).disabled(false);
		}
	}
}
	
/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 	
Ext.DOM.ShowDatas = function(){

  var UserListId = Ext.Cmp("agent_name").getValue(),
	  CallResult = Ext.Cmp("call_result").getValue(),
	  CampaignId = Ext.Cmp("CampaignId").getValue();
		
	if(Ext.Cmp("agent_name").empty() ){
		Ext.Msg("Agent Name is empty").Info();
		return false;
	}
	// else if(Ext.Cmp("call_result").empty()){
		// Ext.Msg("Call Result is empty").Info();
		// return false;
	// }	
	else
	{
		Ext.Cmp("ajaxload").setText("<span style='color:red;'><img src='"+Ext.DOM.LIBRARY+"/gambar/loading.gif' height='10'> Please Wait...</span>");
		Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/MgtAssignment/ShowData/',
			method 	: 'POST',
			param 	: {
				CampaignId   : CampaignId,
				UserId 		 : UserListId,
				CallResultId : CallResult
			},
			ERROR : function(e)
			{
				Ext.Util(e).proc(function(data)
				{
					if( data.success ) {
						if( parseInt(data.counter) > 0 ){
							Ext.Cmp('size_data_show').setValue(data.counter);
						}
						else{
							Ext.Msg("No data in Campaign "+Ext.Cmp("campaign_name").getValue()).Info();
							Ext.Cmp('size_data_show').setValue(0);
						}
					}
					else{
						Ext.Msg("No data in Campaign "+Ext.Cmp("campaign_name").getValue()).Info();
						Ext.Cmp('size_data_show').setValue(0);
					}
					Ext.Cmp("ajaxload").setText("<span style='color:#DDDDDD;'>done.</span>");
				});
			}
			
		}).post();	
	}
	
}
	

/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
Ext.DOM.GoBack = function()
{
	if( Ext.Msg('Do you want back to Campaign List ?').Confirm() ) 
	{
		Ext.EQuery.Ajax({
			url : Ext.DOM.INDEX +'/MgtAssignment/index/',
			method : 'GET',
			param : {
				time : Ext.Date().getDuration()
			}
		});
	}	
}
	
/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
Ext.DOM.getUserByLevel = function(combo)
{
 var UserLevel = combo.value;
 var DistribusiType = Ext.Cmp('distribusi_type').getValue();
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/MgtAssignment/getShowByLevel/',
		method 	: 'GET',
		param 	: {
			UserLevel 	: UserLevel,
			CampaignNumber : Ext.Cmp('CampaignId').getValue(),
			CampaignId: Ext.Cmp('CampaignId').getValue(),
			DistribusiType : DistribusiType	
		}
	}).load('show_user_by_level');
}	

	
/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
Ext.DOM.getUserByType = function(combo)
{
	Ext.Ajax
	({
		url		: Ext.DOM.INDEX+'/MgtAssignment/getShowByLevel/',
		method  : 'GET',
		param   : {
			UserLevel : Ext.Cmp("distribusi_level").getValue(),
			CampaignNumber : Ext.Cmp('CampaignId').getValue(),
			CampaignId: Ext.Cmp('CampaignId').getValue(),
			DistribusiType : Ext.Cmp('distribusi_type').getValue()	
		}
	}).load('show_user_by_level');
}

/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
var getSizeByUser = function()
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

/* 
 * @ def : back to home 
 * ----------------------------
 *
 * @ aksess : public
 * @ param	: Ext,
 */
 
Ext.DOM.Distribusi = function()
{
	var CallResultId = Ext.Cmp('call_result').getValue();
	var UserId = Ext.Cmp('agent_name').getValue();
	var CampaignId = Ext.Cmp('CampaignId').getValue();
	var CampaignNumber = Ext.Cmp('campaign_number').getValue();
	var JumlahData = Ext.Cmp('size_asign_data').getValue();
	var UserLevel = Ext.Cmp('distribusi_level').getValue();
	var DistributeType = Ext.Cmp('distribusi_type').getValue();
	var DistributeMode = Ext.Cmp('distribusi_mode').getValue(); 
	var AssignData = Ext.Cmp('distribusi_assign').getValue();
	var UserSelect = Ext.Cmp('chk_user_id').getValue();
	var UserSizeData = (DistributeType==1?getSizeByUser():'');
	
// run && execute of process 
	
	if( JumlahData==0){ 
		Ext.Msg('Data Size Is Zero!').Info();}
	else if(UserLevel=='') { 
		Ext.Msg('Please select user level!').Info();} 
	else if(DistributeType=='') { 
		Ext.Msg('Please distribute Type!').Info();}
	else if(DistributeMode=='') { 
		Ext.Msg('Please distribute Mode!').Info();}
	else if(AssignData==''|| AssignData==0) { 
		Ext.Msg('Please input Assign data !').Info(); }
	else if(UserSelect==''){ 
		Ext.Msg('Please Select User Id By Level !').Info();}
	else
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/MgtAssignment/AgentReAssignment/',
			method  : 'POST',
			param 	: {
					CampaignId : CampaignId, CampaignNumber : CampaignNumber, 
					AssignData : AssignData, DistribusiType : DistributeType, 
					DistribusiMode : DistributeMode, UserLevel : UserLevel, 	
					UserSizeData : UserSizeData, UserSelect : UserSelect,
					CallResultId : CallResultId, UserId : UserId
			},
			ERROR : function(fn){
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Distribusi Data, Size data : "+ ERR.message.SizeData +", Size Users : "+ ERR.message.SizeUsers ).Success();
						Ext.Ajax
						({
							url 	: Ext.DOM.INDEX +'/MgtAssignment/ViewAgentData/',
							method  : 'GET',
							param 	: { CampaignId : CampaignId }
						}).load("main_content");
					}
					else{
						Ext.Msg("Distribusi Data").Failed();
					}
				}
				catch(e){
					alert(e);
				}
			}	
		}).post();
	}
}
	
</script>
	
<fieldset class="corner" style="background-color:#FFFFFF;">
	<legend class="icon-customers" style="margin-top:-8px;">&nbsp;&nbsp;Get Agent Data </legend>		
		
		<?php echo form()->hidden('CampaignId','input_text long',_get_post('CampaignId') );?>
		<?php echo form()->hidden('campaign_number','input_text long',$Model -> getCampaignNumber(),NULL,1);?>
		<?php echo form()->hidden('campaign_name','input_text long',$Model -> getCampaignName(),NULL,1);?>
		<fieldset  style="margin-top:6px;border:1px solid #ddd;">
			<legend class="icon-menulist">&nbsp;&nbsp;Campaign - <?php echo $Model -> getCampaignName(); ?> </legend>	
			<table cellpadding="7" style="margin-top:-10px;" width="70%">
				<tr>
					<td class="text_caption" valign="top">Agent Name</td>
					<td><?php echo form()->listcombo('agent_name','Select',$Users,NULL,1);?></td>
					<td class="text_caption" valign="top">Call Result</td>
					<td><?php echo form()->listcombo('call_result','Select',$CallResult,NULL,1);?></td>
				</tr>
			</table>
		</fieldset>
		<!-- button data --->
		<div id="MyBars" class="toolbars" style="margin-left:3px;margin-top:5px;"></div>
		<!-- content data reasign -->
		
		<fieldset  style="margin-top:6px;border:1px solid #ddd;">
			<table cellpadding='7px'>
				<tr>
					<td class="text_caption">Assign Data</td>
					<td><?php echo form()->input('distribusi_assign', 'input_text long',null, null,array("disabled"=>true) );?></td>
					<td class="text_caption">Mode</td>
					<td colspan="2"><?php echo form()->combo('distribusi_mode', 'select long',$Model -> DistribusiMode());?></td>	
				</tr>
				<tr>
					<td class="text_caption">Level</td>
					<td><?php echo form()->combo('distribusi_level', 'select long', $Model -> getLevelUser(),NULL, array('change'=>'Ext.DOM.getUserByLevel(this);') );?></td>
				</tr>
				<tr>
					<td class="text_caption">Type</td>
					<td colspan="2"><?php echo form()->combo('distribusi_type', 'select long', $Model -> DistribusiType(),NULL,array('change'=>'Ext.DOM.getUserByType(this);') );?></td>
				</tr>
			</table>
		</fieldset>
		<div id="toolbars" style="margin-top:20px;margin-left:1px;"></div>
		<fieldset style="margin-top:20px;border:1px solid #dddddd;">
			<legend class="icon-menulist">&nbsp;&nbsp; User By Level </legend>	
			<div id="show_user_by_level" style="background-color:#FFFFFF;"></div>
		</fieldset>
		
</fieldset>	