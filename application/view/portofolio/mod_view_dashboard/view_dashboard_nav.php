<script>

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
function RoleBack(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		window.clearInterval(Ext.DOM.setTimeOutId);
		Ext.BackHome();
	}
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
function Inialize(){
	$("#example-advanced").treetable({ expandable: true });
	$("#example-advanced tbody").on("mousedown", "tr", function() {
	$(".selected").not(this).removeClass("selected");
		$(this).toggleClass("selected");
	});
			
	$("#example-advanced").css({"width": "99%", "margin" : "-5px 5px 5px 5px"});
	$(".ui-widget-caption").css({"font-size" : "12px"});
}
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */
 
 function ViewDashboard( obj )
{
  var frmDsbFilter = Ext.Serialize('frmDsbFilter');
    $('#ui-widget-tabular-content').waiter 
	({
		url 	: new Array('Dashboard','Content'),
		param 	: Ext.Join(new Array( frmDsbFilter.getElement() ) ).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			$("#ui-widget-tabular-content").css({height : "99%"});
			new Inialize();
		}
	});		
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on distribute part 	
 *  
 */

function ShowDasboard(){
  	ViewDashboard({ type: "",  orderby : "", page : ""});
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 */
 
 $(document).ready( function()
{
  $('#ui-widget-template-tabs').mytab().tabs();
  $('#ui-widget-template-tabs').mytab().tabs("option", "selected", 0);
  $('#ui-widget-template-tabs').css({'background-color':'#FFFFFF'});
  $('#ui-widget-template-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-template-tabs").mytab().close(function(){  Ext.DOM.RoleBack(); }, true);
  
 // -------------- attr CSS ---------------------------------------------------
 
  $('#legend_title').html( Ext.System.view_file_name());
  $('.border-none').css({ "border" :"0px solid #FFFFFF" });
  
  $("#content-tabular-activity").css({ "width" : new Array($(".ui-widget-fieldset-parental").innerWidth(), "px").join("")});
  
  
  
 // ----------------- uui -----------
 $('#dsb_campaign').toogle(); 
 $('#dsb_supervisor').toogle(); 
 $('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true});
 
 $("#ui-widget-tabular-tabs").mytab().tabs();
 $('#ui-widget-tabular-tabs').css({ 'background-color':'#FFFFFF'});
 $('#ui-widget-tabular-content').css({ 'background-color':'#FFFFFF'});
 $("#ui-widget-tabular-tabs").mytab().close({}, true);
 
});
 
</script>

<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-person"></span><span id="legend_title"></span></a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content" style="width:98.4%;">
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" id="content-dial-activity" style="width:75%;">
					<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:-12px 5px 5px -10px; border-radius:5px;">
						<?php echo form()->legend(lang("User Option"),"fa-edit");?>
						<?php $this->load->view("mod_view_dashboard/view_dashboard_filter"); ?>
					</fieldset>	
				</div>
			</div>
			
			<div class="ui-widget-form-row">
				<fieldset class="corner ui-widget-fieldset-parental" style="padding:8px 4px 8px 4px;margin:5px 5px 5px -10px; border-radius:5px;">
				<?php echo form()->legend(lang("User Content"),"fa-bars");?>
					<div class="ui-widget-form-cell ui-widget-content-top" id="content-tabular-activity"> 
					
					 <div id="ui-widget-tabular-tabs" class="tabs corner ">
						<ul>
							<li class="ui-tab-li-lasted">
								<a href="#ui-widget-tabular-content">
								<span class="ui-icon ui-icon-person"></span>Daily Activity Dashboard</a>
							</li>
						</ul>	
						<div id="ui-widget-tabular-content" style="z-index:-1;"></div>
					 </div>
						
				</fieldset>
			</div>
		</div>
	</div>
</div>	
	
