<?php echo javascript(); ?>
<script type="text/javascript">
var DataUnAssignData = {
	total  : 0
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.RoleBack = function() {
	if( Ext.Msg('Are you sure ?').Confirm() ) {
		new Ext.BackHome();
	}
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 $(document).ready(function () {
	 $("#CallReasonId").toogle();
 });
 
 Ext.document('document').ready(function()
{
	
	
	

Ext.Cmp('ui-title-tabs').setText( Ext.System.view_file_name());
	
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : -
 * @ param : -
 */
 
 Ext.DOM.ViewPanelLeft = function(){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/QualityAssignment/FilterAssignment/',
		method : 'GET',
		param :{ 
			time : Ext.Date().getDuration()
		}	
	}).load("hader-panel-content-left");
 }
 
// loader :  
Ext.DOM.ViewPanelLeft(); 
 
// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * @ def : Ext.DOM.StaffAvailable   
 */
 
 Ext.DOM.ViewDetailData = function( obj)
{
	var filterQualityAssignment = Ext.Serialize('filterQualityAssignment');
	var frmFilterAssingLeft = Ext.Serialize('frmFilterAssingLeft');
	
	$('#result_content_combo').Spiner 
	({
		url 	: new Array('QualityAssignment','ShowDataByChecked'),
		param 	: Ext.Join(new Array( 
					filterQualityAssignment.getElement(), 
					frmFilterAssingLeft.getElement() 
				)).object(), 
		order   : 
		{
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			console.log("total row(s) : "+ $(obj).attr('id') +"/"+ $('#total-agent-state').html());
		}
	});		
}

Ext.DOM.UserShowSpvReportByName = function ()
{
	Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/QualityAssignment/UserShowSpvReportByName/',
			param 	: {
				CustomerName : Ext.Cmp('CustomerName').getValue()
			}
		}).load('spv');
}

/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : -
 * @ param : -
 */
/* new function */
Ext.DOM.UserShowAgentReportBySpv = function (spvid)
{
	// alert(spvid);
	// var SpvId = Ext.Cmp('SPVId').getValue();
	$("#agents").loader ({
		url  : new Array('QualityAssignment','UserShowAgentReportBySpv'),
		param : { 
					SpvId : spvid,
					CustomerName : Ext.Cmp('CustomerName').getValue() 
				},
		complete : function( data ){
			$("#agents").attr("select", "");
			// $("#user_tmr_id").toogle();
		}
	});
}
 
 
 Ext.DOM.DetailData = function( VAR )
{
	var filterQualityAssignment = Ext.Serialize('filterQualityAssignment');
	var frmFilterAssingLeft = Ext.Serialize('frmFilterAssingLeft');
	
	$('#result_content_combo').Spiner 
	({
		url 	: new Array('QualityAssignment',VAR.controller),
		param 	: Ext.Join(new Array( 
					filterQualityAssignment.getElement(), 
					frmFilterAssingLeft.getElement() 
				)).object(), 
		order   : 
		{
			order_type : '',
			order_by   : '',
			order_page : ''	
		}, 
		complete : function( obj ){
			console.log("total row(s) : "+ $(obj).attr('id') +"/"+ $('#view_size_data').val());
		}
	});	
} 
	
	
Ext.DOM.SelectedPage = function( page ){
	Ext.DOM.DetailData({
		controller : 'ShowDataByChecked',
		page : page
	});
}	
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : -
 * @ param : -
 */
 
 Ext.DOM.ViewPanelRight = function(){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/QualityAssignment/ContentFilter/',
		method : 'GET',
		param :{ 
			time : Ext.Date().getDuration()
		}	
	}).load("hader-panel-content-right");
 }
 
// loader :  
Ext.DOM.ViewPanelRight(); 
  
  
// ----------------------------------------------------------------
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */
 
 Ext.DOM.DetailAssignment = function( sel )
{
	if( sel.value == 'CHECKED' ){
		Ext.DOM.ViewDetailData({orderby:'', type : '', page : '' });
	}
	else if( sel.value == 'AMOUNT' ){
		Ext.DOM.DetailData({ controller : 'ShowDataByAmount', page : 0 });
	} 
	else {
		var status_submit_filter = $("#submit_filter").val();
		if ( status_submit_filter == 'CHECKED' ) {
			Ext.DOM.ViewDetailData({orderby:'', type : '', page : '' });
		} else if ( status_submit_filter == 'AMOUNT' ) {
			Ext.DOM.DetailData({ controller : 'ShowDataByAmount', page : 0 });
		}
	}	

	
}
 
// ----------------------------------------------------------------
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */
  
Ext.DOM.OpenAllGrid  = function(){
	if( Ext.Cmp('submit_filter').getValue() =='CHECKED' ){
		Ext.DOM.ViewDetailData({orderby:'', type : '', page : '' });
	}
}

  
// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * @ def : Ext.DOM.StaffAvailable   
 */
 
 
Ext.DOM.AssignByChecked = function()
{
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/QualityAssignment/AssignByChecked/',
		method : 'POST',
		param : {
			CustomerId : Ext.Cmp('CustomerId').getValue(),
			SPVId : Ext.Cmp('SPVId').getValue()
		},
		
		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.success ){
					Ext.Msg("Assign Data").Success();
					Ext.DOM.DetailData({ 
						controller : 'ShowDataByChecked', 
						page : 0 
					});
				}
				else{
					Ext.Msg("Assign Data").Failed();
				}
			});
		}
	}).post();
}
  
  
 

/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */

 
Ext.DOM.AssignByAmount = function(){
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/QualityAssignment/AssignByAmount/',
		method : 'POST',
		param : {
			AssignSizeData : Ext.Cmp('view_size_amount').getValue(),
			AssignTotalData : Ext.Cmp('view_size_data').getValue(),
			QualityStaffId : Ext.Cmp('QualityStaffId').getChecked(),
			CampaignId  : Ext.Cmp('CampaignId').getValue(),
			start_date  : Ext.Cmp('start_date').getValue(),
			end_date 	: Ext.Cmp('end_date').getValue(),
		},
		
		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.success ){
					Ext.Msg("Assign Data").Success();
					Ext.DOM.DetailData({ 
						controller : 'ShowDataByAmount', 
						page : 0 
					});
				}
				else{
					Ext.Msg("Assign Data").Failed();
				}
			});
		}
	}).post();
}
    

/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */

 
Ext.DOM.AssignData = function()
{
	var select_type = Ext.Cmp('submit_filter').getValue();
	var AgentId = $("#AgentId").val();
	if ( AgentId == '' ) {
		alert("Please Choose Agent Before Assign!");
	} else {
		if( Ext.Cmp('submit_filter').empty()!=true ) 
		{
			switch( select_type )
			{
				case 'CHECKED' : Ext.DOM.AssignByChecked();  break;	
				case 'AMOUNT'  : Ext.DOM.AssignByAmount();   break;	
			}	
		}
		else{
			Ext.Msg("Please select Method").Info();
		}
	}
		
}

 
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */


});

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 Ext.DOM.ViewStoreObjectData = function(obj) 
{
    var fltQualityUnAssign = Ext.Serialize('fltQualityUnAssign');
	$('#ui-widget-unassign-list').Spiner({
		url 	: new Array('QualityAssignment','PageQualityUnAssignData'),
		param 	: Ext.Join(new Array( fltQualityUnAssign.getElement() ) ).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		 complete : function( obj )
		{
			DataUnAssignData.total = $('#ui-total-trans-record').text();
			Ext.Cmp('qty_user_quantity').setValue(0);
			Ext.Cmp('qty_user_total').setValue(DataUnAssignData.total);
			Ext.Cmp('qty_user_total').disabled(true);
		}
	});		
 }
 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
Ext.DOM.SearchUnAssignData = function()
{
	Ext.DOM.ViewStoreObjectData({ orderby : '',  type: '', page: 0	 });	
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 Ext.DOM.ActionCheckData = function( obj ) 
 {
	if( obj.checked && obj.value == 2 )
	{
		var BoxList = Ext.Cmp("QualityAssignId").getValue()
		if( BoxList.length == 0 ){
			Ext.Cmp('QualityAssignId').setChecked();
			BoxList = Ext.Cmp("QualityAssignId").getValue()
		}
		
		Ext.Cmp('qty_user_quantity').setValue(0);
		Ext.Cmp('qty_user_total').setValue(BoxList.length);
		Ext.Cmp('qty_user_total').disabled(true);
			
	} else {
		Ext.Cmp('qty_user_quantity').setValue(0);
		Ext.Cmp('qty_user_total').setValue(DataUnAssignData.total);
		Ext.Cmp('qty_user_total').disabled(true);
	}	
 }
 

 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 

Ext.DOM.ClearUnAssignData = function(){
	Ext.Serialize('fltQualityUnAssign').Clear(new Array('qty_record_page') );
	Ext.DOM.SearchUnAssignData();
}

 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 Ext.DOM.SubmitQualityUnAssignData = function()
{
	var formFilterData = Ext.Serialize('fltQualityUnAssign');
	var formFilterInput = Ext.Serialize('frmUnAssignOption');
	var formListbox = new Array();
	
	formListbox['QualityAssignId'] = Ext.Cmp('QualityAssignId').getValue();
	
	if( !formFilterInput.Complete() ){
		Ext.Msg('Please select option').Info();
		return false;
	}
	
	if( Ext.Cmp('qty_user_quantity').getValue() == 0 ){
		Ext.Msg('Quantity Not Valid').Info();
		return false;
	}

	if( Ext.Cmp('qty_user_quantity').getValue() >  Ext.Cmp('qty_user_total').getValue() ){
		Ext.Msg('Quantity Not Valid').Info();
		return false;
	}
	
   var Msg = Ext.Msg('Are you sure?').Confirm();	
	if( !Msg){ 
		return false; 
	}	
	
// -------------- data un assing Ok  -------------------	
	 Ext.Ajax
	({
		url 	: Ext.EventUrl(new Array('QualityAssignment', 'SubmitUnAssignQualityData')).Apply(),
		method  : 'POST',
		param   : Ext.Join([
			formFilterData.getElement(),
			formFilterInput.getElement(),
			formListbox
		]).object(),
		
		ERROR : function( err ){
			Ext.Util(err).proc(function( data ){
				if( data.success ){	
					Ext.Msg("UnAssignment Quality Data").Success();
					Ext.DOM.SearchUnAssignData();
				} else {
					Ext.Msg("UnAssignment Quality Data").Failed();
				}
			});
		}
		
	}).post();
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 $(document).ready( function() 
 {	
   $('#ui-widget-add-campaign').mytab().tabs();
   $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
   $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
   $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
   $('#ui-widget-unassign-content').css({'background-color':'#FFFFFF'});
   $("#ui-widget-add-campaign").mytab().close(function(){Ext.DOM.RoleBack();}, true);
   $('#ui-title-tabs').html(Ext.System.view_file_name());
   
  // ------------ load content  -----------------------------------------------------------
  $('.xzselect').chosen();
  $('#qty_from_campaign_id').toogle();
  $('#qty_status_id').toogle();
    $('#start_date').datepicker({
	   showOn: 'button', 
	   buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
	   buttonImageOnly: true, 
	   dateFormat:'dd-mm-yy',
	   readonly:true
	});
 
  $('#qty_form_user_list').toogle({
		url:'QualityAssignment/SelectAllStaff',
		param :{ },
	});
});

</script>
<!-- start : content -->


<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("Assignment");?></a>
		</li>
		
		<?php  
		/**
		 * <li class="ui-tab-li-lasted">
			<a href="#ui-widget-unassign-content">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("UnAssignment")?></a>
		</li>
		 */

		?>
		
		
	</ul>	
	
	
	<div id="ui-widget-add-content" class="ui-widget-table-form-compact" style="width:98%;"> 
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;"></div>
			<div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-right" style="width:50%;" ></div>
		</div>
	</div>
	
	
	<div id="ui-widget-unassign-content" class="ui-widget-table-form-compact"> 
		<div class="ui-widget-table-form-compact" style="width:100%;">
			<div class="ui-widget-form-row">

				<?php
/**
 * <div class="ui-widget-form-cell ui-widget-content-top" style="vertical-align:top;width:70%;">
					<?php $this->load->view("qty_view_assignment/view_layout_unassign_page");?>	
				</div>
				<div class="ui-widget-form-cell ui-widget-content-top" style="vertical-align:top;width:30%;">
					<?php $this->load->view("qty_view_assignment/view_layout_unassign_filter");?>	
				</div>
 */
				?>
				
				
			</div>
		</div>
	</div>
	
</div>	