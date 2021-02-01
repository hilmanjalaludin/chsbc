<script>
Ext.document(window).ready(function(){

/* list agents-keyword **/

Ext.DOM.ShowAgentByKeyword = function( p ){
	Ext.Cmp('list-agents-keyword').setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'> <span style='color:red;'>Please Wait...</span>");
	
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+'/SetGroupTeam/ShowListAgent/',
		method 	: 'POST',
		param 	: {
			page 	: ( p ? p : 0 ),
			keyword : Ext.Cmp('Keyword').getValue()
		}
	}).load("list-agents-keyword");
}

Ext.DOM.ShowGroupteam = function(){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX+'/SetGroupTeam/ShowUserGroup/',
		method : 'POST',
		param :{
			GroupId : Ext.Cmp('GroupId').getValue()
		}	
	}).load("list-group-team");
}

/* Ext.DOM.AddUserToGroup() **/

Ext.DOM.AddUserToGroup  = function() 
{
	Ext.Ajax 
	({
		url	 : Ext.DOM.INDEX+'/SetGroupTeam/AddUserUserGroup/',
		method : 'POST',
		param :{
			GroupId : Ext.Cmp('GroupId').getValue(),
			UserId : Ext.Cmp('UserId').getValue()
		},
		ERROR : function(e) {
			Ext.Util(e).proc(function(item){
				if( item.success ){
					Ext.Msg("Add User To Group").Success();
					Ext.DOM.ShowGroupteam();
				}
				else{
					Ext.Msg("Add User To Group").Failed();
				}
			})
		}	
	}).post();
} 

/* Remove **/
Ext.Cmp('Remove').listener ({
 onclick: function() {
	Ext.Ajax ({
			url	 	: Ext.DOM.INDEX+'/SetGroupTeam/RemoveUserUserGroup/',
			method 	: 'POST',
			param 	: {
				GroupTeamId : Ext.Cmp('GroupTeamId').getValue()
			},
			ERROR : function(e) {
				Ext.Util(e).proc(function(item){
					if( item.success ){
						Ext.Msg("Remove User from Group").Success();
						Ext.DOM.ShowGroupteam();
					}
					else{
						Ext.Msg("Remove User from Group").Failed();
					}
				})
			}	
		}).post();
	}
})

/*Keyword data listener **/

Ext.Cmp('Keyword').listener
({
	onkeyup : function(e) { if( e.keyCode ==13 ) {
		Ext.DOM.ShowAgentByKeyword(0);
	}}
});

/* find data listener **/

Ext.Cmp('Find').listener 
({
	onclick : function(e) {  
		Ext.DOM.ShowAgentByKeyword(0); 
	}	
})

/* list agents-keyword **/

Ext.DOM.ExitUserToGroup = function() 
{
	Ext.EQuery.Ajax
	({
		url : Ext.Cmp('ControllerId').getValue(),
		param : { time : Ext.Date().getDuration() }
	});
}

/* list agents-keyword **/

Ext.DOM.ShowAgentByKeyword(0);
Ext.DOM.ShowGroupteam();
});

</script>
<input type="hidden" name="GroupId" id="GroupId" value="<?php __(_get_post('GroupId'));?>" />
<input type="hidden" name="ControllerId" id="ControllerId" value="<?php __(_get_post('ControllerId') ); ?>" />
<fieldset class='corner'>
	<legend class='icon-menulist'>&nbsp;&nbsp;User Per Group </legend>
	<div>
		<div id="panel-content-top">
			<table width='100%' border=0 cellpadding=0 cellspacing=0>
				<tr>
					<td class='text_caption bottom' width='10%' valign='top'>User Name&nbsp;&nbsp;</td>
					<td width='40%' valign='top'>
							<?php __(form()->input('Keyword','select long', null,null, array('style' => 'width:320px;') ));?>  
							<input type="button" name="Find" id="Find" value="Find" class='search button'>
					</td>
					
					<td valign='top' rowspan=2>
						<div id="list-group-team"></div>
						<input type="button" name="Remove" id="Remove" value="Remove" class='remove button'>
					</td>
				</tr>
				
				<tr>
					<td class='text_caption'>&nbsp;</td>
					<td valign='top'><div id="list-agents-keyword"></div></td>
				</tr>
				
				
			<table>
		</div>
	</div>
</fieldset>