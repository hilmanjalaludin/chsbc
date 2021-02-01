<?php echo javascript(); ?>

<script type="text/javascript">

Ext.document('document').ready( function(){

// -----------------------------------------------------------------------------------------
/*
 * -----------------------------------------------------------------------------------------
 * document ready   
 */
 
 Ext.DOM.ViewStaffByGroup = function( obj )
{
	var frmQualityData = Ext.Serialize('frmQualityData');
	$('#content-agent-staff-group').Spiner
	({
		url 	: new Array('QtyStaffGroup','PageStaffGroup'),
		param 	: Ext.Join(new Array( frmQualityData.getElement() )).object(), 
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
 
 
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */
 
Ext.DOM.StaffAvailable = function(){
 Ext.Ajax
 ({
	url 	: Ext.DOM.INDEX+'/QtyStaffGroup/StaffAvailable/',
	method 	: 'GET',
	param 	: {
		time : Ext.Date().getDuration()
		}	
	}).load('content-agent-staff-available');
	$('.xzselect').chosen();
 }

// loader  :
Ext.DOM.StaffAvailable();

	
/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */
 
Ext.DOM.StaffByGroup = function(){
	Ext.DOM.ViewStaffByGroup({orderby: '', type :'', page : 0 });
}

// loader  :



/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param :QualityStaffId
 * @ param : -
 */

Ext.DOM.AddAvailableGroup = function(){
Ext.Ajax
 ({
	url 	: Ext.DOM.INDEX+'/QtyStaffGroup/AddAvailableSkill/',
	method 	: 'POST',
	param 	: {
		time : Ext.Date().getDuration(),
		QualityStaffId : Ext.Cmp('QualityStaffId').getChecked()
	},

	ERROR : function(e){
		Ext.Util(e).proc(function(items){
			if( items.success){
				Ext.Msg("Add Quality Skill").Success();
				Ext.DOM.StaffByGroup();	
			}
			else{
				Ext.Msg("Add Quality Skill").Failed();
			}
		});
	}		
  }).post();
  $('.xzselect').chosen();
}

/* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Quality_Group_Id
 * @ param : Quality_Skill_Id
 */

 Ext.DOM.AssignQualityGroup = function(){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+'/QtyStaffGroup/AssignQualitySkill/',
		method 	: 'POST',
		param 	: {
			time : Ext.Date().getDuration(),
			QualityIndexId : Ext.Cmp('QualityIndexId').getChecked(),
			Quality_Skill_Id : Ext.Cmp('Quality_Skill_Id').getValue(),
		},

		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.success){
					Ext.Msg("Assign Quality Skill").Success();
					Ext.DOM.StaffByGroup();	
				}
				else{
					Ext.Msg("Assign Quality Skill").Failed();
				}
			});
		}		
  }).post();
  
  $('.xzselect').chosen();
 }
 
 
 /* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Quality_Group_Id
 * @ param : -
 */
 
 Ext.DOM.RemoveQualityGroup = function(){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+'/QtyStaffGroup/RemoveQualitySkill/',
		method 	: 'POST',
		param 	: {
			time : Ext.Date().getDuration(),
			QualityIndexId : Ext.Cmp('QualityIndexId').getChecked()
		},

		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.success){
					Ext.Msg("Remove Quality Skill").Success();
					Ext.DOM.StaffByGroup();	
				}
				else{
					Ext.Msg("Remove Quality Skill").Failed();
				}
			});
		}		
  }).post();
  $('.xzselect').chosen();
 }

 /* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Quality_Group_Id
 * @ param : -
 */
 
 Ext.DOM.EmptyQualityGroup = function()
 {
  Ext.Ajax ({
		url 	: Ext.DOM.INDEX+'/QtyStaffGroup/ClearQualitySkill/',
		method 	: 'POST',
		param 	: {
			time : Ext.Date().getDuration(),
			QualityIndexId : Ext.Cmp('QualityIndexId').getChecked()
		},

		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.success){
					Ext.Msg("Clear Quality Skill").Success();
					Ext.DOM.StaffByGroup();	
				}
				else{
					Ext.Msg("Clear Quality Skill").Failed();
				}
			});
		}		
  }).post();
  
  $('.xzselect').chosen();
 }

 
 Ext.DOM.OpenQualityGrid = function( obj ){
	Ext.DOM.StaffByGroup(); 
 }
 Ext.DOM.SearchSetQuality = function(){
	Ext.DOM.StaffByGroup(); 
 } 
 /* 
 * @ def : Ext.DOM.StaffAvailable 
 * ---------------------------------------
 * 
 * @ param : Unit Test
 * @ param : Unit Test
 */


});

 $(document).ready( function() 
 {	
   $('#ui-widget-add-campaign').mytab().tabs();
   $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
   $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
   $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
   $("#ui-widget-add-campaign").mytab().close(function(){Ext.DOM.RoleBack();}, true);
   $('#ui-title-tabs').html(Ext.System.view_file_name());
   
  // ------------ load content  -----------------------------------------------------------
  $('.xzselect').chosen();
  Ext.DOM.StaffByGroup();
  
   
});

</script>

<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("<span id='ui-title-tabs'></span>");?></a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-table-form-compact"> 
		
		<fieldset class="corner " style="width:99%;margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Quality Staff Available"),"fa-user");?>
			<div id="content-agent-staff-available"> </div>
		</fieldset>


		<fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:10px;border-radius:5px;">
		<?php echo form()->legend(lang("Quality Staff Group"),"fa-users");?>
		
			<fieldset class="corner" style="width:99%;margin-top:10px; padding:5px;border-radius:5px;">
				<form name="frmQualityData">
				<div class="ui-widget-form-table-compact">
					<div class='ui-widget-form-row'>
						<div class='ui-widget-form-cell text_caption'><?php echo lang("Skill");?></div>
						<div class='ui-widget-form-cell text_caption center'>:</div>
						<div class='ui-widget-form-cell'><?php echo form() -> combo('Filter_Skill_Id','select tolong xzselect',QualitySkill() );?> </div>
						<div class="ui-widget-form-cell"><?php echo form() -> checkbox('Filter_Hide_Id',null,1,array("change" =>"Ext.DOM.OpenQualityGrid(this);"));?><?php echo lang("Open All Grid");?></div>
						
					</div>
					
					<div class='ui-widget-form-row'>
						<div class='ui-widget-form-cell text_caption'><?php echo lang("Quality Name");?></div>
						<div class='ui-widget-form-cell text_caption center'>:</div>
						<div class='ui-widget-form-cell'><?php echo form() -> combo('Filter_Quality_Id','select tolong xzselect',QualityAllStaff() );?> </div>
						<div class='ui-widget-form-cell'><?php echo form()->button("button_keyword", "button search",lang("Search"), array("click" => "Ext.DOM.SearchSetQuality();") );?></div>
						
					</div>
				</div>
				</form>
			</fieldset>
			
			<fieldset class="corner" style="width:99%;margin-top:10px; padding:5px;border-radius:5px;">
				<div class="ui-widget-form-table-compact " id="content-agent-staff-group" style="height:500px;width:99%;margin:5px 5px 0px 5px;">
			</fieldset>
			
		</fieldset>
		
		<fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:10px;border-radius:5px;">
			<div class="ui-widget-form-table-compact">
				<div class='ui-widget-form-row'>
					<div class='ui-widget-form-cell text_caption'><?php echo lang("Quality Skill");?></div>
					<div class='ui-widget-form-cell text_caption center'>:</div>
					<div class='ui-widget-form-cell'><?php echo form() -> combo('Quality_Skill_Id','select long xzselect',QualitySkill() );?> </div>
					<div class='ui-widget-form-cell'>
						<?php echo form()->button('AssignQualityStaff','button assign','&nbsp;Assign', array("click" =>"Ext.DOM.AssignQualityGroup();" ));?>
						<?php echo form()->button('RemoveQualityStaff','button remove','&nbsp;Remove', array("click" =>"Ext.DOM.RemoveQualityGroup();" ));?>
						<?php echo form()->button('ClearQualityStaff','button clear','&nbsp;Clear', array("click" =>"Ext.DOM.EmptyQualityGroup();" ));?>
					</div>
				</div>	
			</div>
		</fieldset>	
	</div>
</div>	
