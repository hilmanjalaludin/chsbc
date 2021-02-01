<script>
// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
 Ext.DOM.RoleBack =function() {
	 if( Ext.Msg("Are you sure to exit from this session").Confirm() ){
		Ext.BackHome(); 
	 }
 }
 
// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * document ready   
 */
 
 Ext.DOM.ViewAgentState = function( obj )
{
	var frmSetAgent = Ext.Serialize('frmSetAgent');
	$('#ui-quality-agent-state').Spiner
	({
		url 	: new Array('QtySetAgent','PageAgentState'),
		param 	: Ext.Join(new Array( frmSetAgent.getElement() )).object(), 
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			console.log("total row(s) : "+ $(obj).attr('id') +"/"+ $('#total-agent-state').html());
		}
	});		
}
// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * document ready   
 */
 
 Ext.DOM.ViewQualityState = function( obj )
{
	var frmSetQuality = Ext.Serialize('frmSetQuality');
	$('#ui-widget-quality-staff').Spiner
	({
		url 	: new Array('QtySetAgent','PageQualityState'),
		param 	: Ext.Join(new Array( frmSetQuality.getElement() )).object(), 
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			
			console.log("total row(s) : "+ $(obj).attr('id') +"/"+ $('#total-quality-state').html());
		}
	});		
}



// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * document ready   
 */
 
 Ext.DOM.SearchSetAgent = function() {
	Ext.DOM.ViewAgentState({orderby:'', type:'', page: 0});
}

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
Ext.DOM.SearchSetQuality = function(){
	Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
}

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 

Ext.DOM.OpenQualityGrid = function( obj ){
	if( obj.checked ){
		Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
	} else{
		Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
	}	
}

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
 Ext.DOM.OpenAgentGrid = function( obj  )
{
	if( obj.checked ){
		Ext.DOM.SearchSetAgent({orderby:'', type:'', page:0});
	} else{
		Ext.DOM.SearchSetAgent({orderby:'', type:'', page:0});
	}
}


// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
 Ext.DOM.IsHide = function( obj )
{
	if( obj.checked ){
		Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
	} else{
		Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
	}	
}


// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		move agent to bucket quakity by user add 
 * @ notes 			please select checkbox data .
 * 
 */
 
 Ext.DOM.AddAvailableAgent = function()
{
	
 var UserId  = Ext.Cmp('UserId').getValue();
 if( UserId.length==0 ){ 
	Ext.Msg("Please select Agent").Info(); 
	return false;
 }	
	
  Ext.Ajax 
 ({
	url  	: Ext.EventUrl(new Array('QtySetAgent','AddAvailableAgent')).Apply(), 
	method  : 'POST',
	param 	: {
		UserId : UserId
	},
	ERROR : function(e){
		Ext.Util(e).proc(function(response) {
			if( response.success ){
				Ext.Msg("Add User To Bucket Quality").Success();
				Ext.DOM.SearchSetAgent();
				Ext.DOM.SearchSetQuality();
			} else {
				Ext.Msg("Add User To Bucket Quality").Failed();
			}	
		});
	}	
	}).post();
 }
 
// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		empty bukcet quality agent on selected check 
 * @ notes 			-
 * 
 */
 
 Ext.DOM.EmptyQualityAgent = function()
{

 var QualityAgentId = Ext.Cmp('QualityAgentId').getChecked();
 if( QualityAgentId.length==0 ){ 
	Ext.Msg("Please select Quality Agent Ready").Info();
	return false;
 }

 // --------- run of process ----------------------------------------------
 
	Ext.Ajax 
	({
		url  	: Ext.EventUrl(new Array('QtySetAgent','EmptyQualityAgent')).Apply(), 
		method  : 'POST',
		param 	: {
			QualityAgentId : QualityAgentId
		},
		ERROR : function(e)
		{
			Ext.Util(e).proc(function(err){
				 if(err.success ) 
				{
					Ext.Msg("Empty Quality Staff").Success();
					Ext.DOM.SearchSetQuality();
					
				}	
				else {
					Ext.Msg("Empty Quality Staff").Failed();
				}
			});
		}
	}).post();
} 

// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		empty bukcet quality agent on selected check 
 * @ notes 			-
 * 
 */
 
 Ext.DOM.RemoveQualityAgent = function()
{	
  var QualityAgentId = Ext.Cmp('QualityAgentId').getChecked();
  if( QualityAgentId.length==0 )
 { 
	Ext.Msg("Please select Quality Agent Ready").Info();
	return false;
 }
 
	Ext.Ajax 
	({
		url  	: Ext.DOM.INDEX+"/QtySetAgent/RemoveQualityAgent/",
		method  : 'POST',
		param 	: {
			QualityAgentId : QualityAgentId
		},
		
		ERROR : function(e) {
			Ext.Util(e).proc(function(err){
				if( err.success ) {
					Ext.Msg("Delete Quality Agent").Success();
					Ext.DOM.SearchSetQuality();
					Ext.DOM.SearchSetAgent();
				}
				else {
					Ext.Msg("Delete Quality Agent").Failed();
				}
			});
		}
			
	}).post();
} 
  

  
// -----------------------------------------------------------------------------------------
/*
 * @ pakage 		empty bukcet quality agent on selected check 
 * @ notes 			-
 * 
 */
 
  Ext.DOM.UpdateQualityAgent = function()
{
	var QualityAgentId = Ext.Cmp('QualityAgentId').getChecked();
	var QulaityStaffId = Ext.Cmp('QulaityStaffId').getValue();
	
	if( Ext.Cmp('QualityAgentId').getChecked().length==0 ){ 
		Ext.Msg("Please select Quality Agent Ready").Info();}
	else if( Ext.Cmp('QulaityStaffId').empty()){ 
		Ext.Msg("Quality Staff").Info();}
	else
	{
		Ext.Ajax ({
			url  	: Ext.DOM.INDEX+"/QtySetAgent/UpdateQualityAgent/",
			method  : 'POST',
			param 	: {
				QualityAgentId : QualityAgentId,
				QulaityStaffId : QulaityStaffId
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(err){
					if((typeof(err)=='object') && (err.success) ) {
						Ext.Msg("Update Quality Agent").Success();
						Ext.DOM.SearchSetQuality();
					}
					else
					{
						Ext.Msg("Update Quality Agent").Failed();
					}
				});
			}
		}).post();
   }
} 
  
// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * document ready   
 */
  $(document).ready( function() 
 {	
   $('#ui-widget-add-campaign').mytab().tabs();
   $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
   $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
   $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
   $("#ui-widget-add-campaign").mytab().close(function(){Ext.DOM.RoleBack();}, true);
   $('#ui-title-tabs').html(Ext.System.view_file_name());
   
  // ------------ load content  -----------------------------------------------------------
   Ext.DOM.ViewAgentState ({orderby:'', type:'', page:0});	
   Ext.DOM.ViewQualityState({orderby:'', type:'', page:0});
   $('.xzselect').chosen();
   
});
</script>