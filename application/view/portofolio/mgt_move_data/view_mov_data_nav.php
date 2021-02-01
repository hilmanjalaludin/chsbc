<?php __(javascript());

$CallResult['NULL'] = 'New Data';
foreach($combo['CallResult'] as $key => $values ){
	$CallResult[$key] = $values;
}	

?>

<script type="text/javascript">

var Privileges = eval('<?php __(json_encode($privileges)); ?>');

/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })(); 
 
 
$(function(){
$('#toolbars').extToolbars({
	extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle : [['Find'],['Move To Level'],[],[]],
	extMenu  : [['Find'],[],[],[]],
	extIcon  : [['find.png'],['user_red.png'],[],[]],
	extText  : true,
	extInput : true,
	extOption: [
	
		/*{
					render : 3,
					type   : 'label',
					label  : '&nbsp;Record(s)&nbsp;:0',
					id     : 'loading_images',
					name   : 'loading_images'
				},{
					render : 4,
					type   : 'label',
					label  : 'Distribute Data',
					id     : 'size_data',
					name   : 'size_data',
				},{
					render : 5,
					type   : 'text',
					id     : 'alloc_data_size',
					value  : 0,
					width  : 90,
					name   : 'alloc_data_size'	
				},**/
				{
					render : 3,
					type   : 'label',
					label  : '.',
					id     : 'waiting_list',
					name   : 'waiting_list',
					
				 },{
				   render  : 2,
				   type    : 'combo',
				   id 	   : 'userLevel',
				   name    : 'userLevel',
				   store   : Privileges,
				   triger  : 'getLevelUser'	
				 }]
			});
	});

// getLevelUser
	
Ext.DOM.getLevelUser = function(UserLevelId){
	Ext.Ajax
	({
		url :Ext.DOM.INDEX+"/MgtTransferData/UserLevel/",
		param :{
			LevelID : UserLevelId
		}
	}).load('ToLevelUser');
	
	Ext.Cmp('labels').setText("To User");
	Ext.Css('ToLevelUser').style({'border' : '1px solid #ddddd'});
	
//alert(UserLevelId);

}

// ClerSwapData

Ext.DOM.ClerSwapData = function(){
	Ext.Cmp('ToLevelUser').setText('');
	Ext.Cmp('labels').setText('');
}

// finding data 
	
Ext.DOM.Find = function(){

Ext.Cmp("waiting_list").setText('Please wait...');
Ext.Css("waiting_list").style({'color':'red'});

var param =[];
	param['CampaignId'] 	= Ext.Cmp('CampaignId').getValue();
 	param['CallReasonId'] 	= Ext.Cmp('CallReasonId').getValue();
	param['FromUserId']		= Ext.Cmp('FromUserId').getValue();
 	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/MgtTransferData/ListMoveData/",
		method 	:'GET',
		param 	: Ext.Join([param]).object()
	}).load('list_move_data');
	
	Ext.Cmp("waiting_list").setText('.');
	Ext.Css("waiting_list").style({'color':'#DDDDDD'});
}

// Ext.DOM.SwapData()

Ext.DOM.SwapData = function() {

Ext.Cmp("waiting_list").setText('Swap in process...');
Ext.Css("waiting_list").style({'color':'red'});

 var UserId = Ext.Cmp('UserId').getValue(), 
	 AssignId = Ext.Cmp('listID').getValue(),
	 UserLevel = Ext.Cmp('userLevel').getValue();
	 
 	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+"/MgtTransferData/SwapData/",
		method 	: 'GET',
		param 	: 
		{ 
			UserId : UserId, 
			AssignId : AssignId,
			UserLevel : UserLevel 
		},
		ERROR : function(e) {
			Ext.Util(e).proc(function(assign){
				if( assign.success ) {
					Ext.Msg("Swap Data With : "+ assign.message+" Data ").Success();
					Ext.Cmp('ToLevelUser').setText('');
					Ext.Cmp('userLevel').setValue('');
					Ext.DOM.Find();
				}
				else{ 
					Ext.Msg("Swap Data").Failed(); 
				}
					
				Ext.Cmp("waiting_list").setText('.');
				Ext.Css("waiting_list").style({'color':'#DDDDDD'});
	
			});
		}
	}).post();

}

</script>
<fieldset class="corner" style="background-color:#FFFFFF;">
<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
	<div class="box-shadow">
	<form name="frmMoveData">
		<table border=0 class=''>
			<tr>
				<td class="text_caption bottom" valign="top" nowrap> Campaign ID</td>
				<td class="bottom"  valign="top"><?php echo form() -> listCombo('CampaignId', 'select long',$combo['Campaign'], null,null);?></td>
				<td class="text_caption bottom" valign="top" nowrap rowspan=2>User</td>
				<td class="bottom"  valign="top" rowspan=2><?php echo form() -> listCombo('FromUserId', 'select long',$combo['User'],$_SESSION['mgr_id'],'onChange="AgentByMgr(this);"',($_SESSION['mgr_id']?1:0));?>  </td>
				<td class="text_caption bottom" valign="top" nowrap> Call Reason</td>
				<td class="bottom"  valign="top" rowspan=2><?php echo form() -> listCombo('CallReasonId', 'select long',$CallResult);?></td>
				<td class="text_caption bottom" valign="top" nowrap rowspan=2><label id="labels" name="labels"></label></td>
				<td class="bottom"  valign="top" rowspan=2>
					<div id="ToLevelUser"></div>
				</tr>
			<!--	
			<tr>
				<td class="text_caption bottom" valign="top" nowrap> CallReasonId</td>
				<td class="bottom"  valign="top"><?php // echo form() -> Combo('CallReasonId1', 'select long',$CallResult);?></td>
			</tr>
			-->
		</table>
		</form>
	</div>
	
	<div id="toolbars" class="toolbars"></div>
	<div class="content_table" id="list_move_data"></div>
</fieldset>