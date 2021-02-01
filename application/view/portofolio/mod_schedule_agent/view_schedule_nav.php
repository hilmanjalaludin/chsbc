<?php echo javascript(); ?>
<script type="text/javascript">


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()

   $('#CoachingDate').datepicker ({ 
	   	showOn : 'button', 
	    buttonImage : Ext.Image("calendar.gif"),  
	    buttonImageOnly	: true, 
		dateFormat : 'dd-mm-yy ' + "<?php echo date('H:i:s'); ?>", 
		readonly:true, 
		changeYear:true, 
		changeMonth:true 
  });


   $('.date').datepicker ({ 
	   	showOn : 'button', 
	    buttonImage : Ext.Image("calendar.gif"),  
	    buttonImageOnly	: true, 
		dateFormat : 'dd-mm-yy ', 
		readonly:true, 
		changeYear:true, 
		changeMonth:true 
  });

   $('.date_month').datepicker ({ 
	   	showOn : 'button', 
	    buttonImage : Ext.Image("calendar.gif"),  
	    buttonImageOnly	: true, 
		dateFormat : 'mm-yy ', 
		readonly:true, 
		changeYear:true, 
		changeMonth:true 
  });

   $('#Periode').datepicker ({ 
	   	showOn : 'button', 
	    buttonImage : Ext.Image("calendar.gif"),  
	    buttonImageOnly	: true, 
		dateFormat : 'mm-yy', 
		readonly:true, 
		changeYear:true, 
		changeMonth:true 
  });
 	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.datas = 
{
	user_active 	: "<?php echo _get_exist_session('user_active');?>",
	user_address 	: "<?php echo _get_exist_session('user_address');?>",
	user_id 		: "<?php echo _get_exist_session('user_id');?>",
	user_login 		: "<?php echo _get_exist_session('user_login');?>",
	user_name 		: "<?php echo _get_exist_session('user_name');?>",
	user_privileges : "<?php echo _get_exist_session('user_privileges');?>",
	order_by 		: "<?php echo _get_exist_session('order_by');?>",
	type	 		: "<?php echo _get_exist_session('type');?>"
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.EQuery.TotalPage = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.content_page = {
	custnav  : Ext.DOM.INDEX+'/ScheduleAgent/index',
	custlist : Ext.DOM.INDEX+'/ScheduleAgent/Content'			
 }	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.EQuery.construct(Ext.DOM.content_page, Ext.DOM.datas);
Ext.EQuery.postContentList();



// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.searchAgent = function()
{
	$.cookie('selected',0)	
	var FrmUserRegistration = Ext.Serialize('FrmUserRegistration');
	Ext.EQuery.construct( Ext.DOM.content_page, Ext.Join([
		FrmUserRegistration.getElement()
	]).object())
	
	Ext.EQuery.postContent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.Clear = function()
{
	Ext.Serialize('FrmUserRegistration').Clear();
	new Ext.DOM.searchAgent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.UserCapacity = function() {
	return Ext.Ajax ({  url : Ext.EventUrl(['ScheduleAgent','UserCapacity']).Apply(),  method  : 'POST', param   : {
			act : Ext.Date().getDuration()
		}
	}).json();
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.addUser = function() 
{
  	var frmAddCoaching = $(".frmAddCoaching");
  	$(frmAddCoaching).fadeIn();
  	$(frmAddCoaching).attr("display","yes");
}




// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
$(document).ready( function(){
	$(".frmAddCoaching").hide();
	$(".frmEditCoaching").hide();


	$('#toolbars').extToolbars
	({
		extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle:
		[
			['Search'],
			['Clear'],
			['Add Schedule'] 
			//['Generate Schedule']
		],
		extMenu :[
			['searchAgent'],
			['Clear'],
			['ToolsProcessData.showParameter'] 
			//['GenerateSchedule'] 
		],
		extIcon :
		[
			['zoom.png'],
			['zoom_out.png'],
			['pencil.png']  
			//['user.png'] 
		],
		extText :true,
		extInput:true,
		extOption: [

		]
	});
	
	$('.select').chosen();
});
	


/**
 * [ToolsData description]
 * @type {Object}
 */
var ToolsProcessData = {

	baseUrl : Ext.DOM.INDEX +  "/" , 

	showParameter : function () {
		var AgentId  = $("#UserId:checked");
		var AgentIds = $(AgentId).val();

		if ( AgentIds != undefined ) {
			$(".addScheduleAgentdiv").fadeIn();
			$(".UserIdAgent").attr('value',AgentIds);
			$.ajax({
				type : "POST" ,
				url : Ext.DOM.INDEX + "/ScheduleAgent/getAgent/" + AgentIds ,
				dataType : "json" , 
				success : function (data) {
					// UserId , full_name
					//console.log(data);
					if ( data.UserId != '' && data.full_name != '' && data.ID != '' ) {
						$("#AgentId").attr("value",data.ID);
						$("#FullName").attr("value",data.full_name);
					} else {
						alert( "Failed take agent!" );
					}
				} 
			});
		} else {
			alert("Choose one row!");
		}

		//alert(AgentIds);
		return false;
	} , 

	/**
	 * we are goto save schedule for adding to t_gn_setschedule_agent
	 * goto right this way
	 */
	ResetData : function () {
		$(".UserIdAgent").attr("value" , "");
		$("#AgentId").attr("value" , "");
		$("#FullName").attr("value" , "");
		$("#DateSchedule").attr("value" , "");
		$("#DayName").attr("value" , "");
		$("#starttime_att").attr("value" , "");
		$("#endtime_att").attr("value" , "");
		$("#ReasonId").val("");
		$(".selectMonthPeriode").val("");
		$(".content_generate_month").html("");
		$(".addScheduleAgentdiv").fadeOut();
	} , 

	SaveSchedule : function () {
		// getting all data setting param to insert databases 
		/**
		 * AgentId , FullName, SpvId , DateSchedule , ReasonId , DayName , StartTime , EndTime , DateCreated
		 */
		var AgentId      = $(".UserIdAgent").val();
		var Username     = $("#AgentId").val();
		var FullName     = $("#FullName").val();
		var DateSchedule = $("#DateSchedule").val();
		var DayName 	 = $("#DayName").val();
		var StartTime    = $("#starttime_att").val();
		var EndTime      = $("#endtime_att").val();
		var ReasonId     = $("#ReasonId").val();

		// check if content send is empty
		if ( AgentId == "" && 
			 Username == "" && 
			 FullName == "" && 
			 DateSchedule == "" &&
			 DayName == "" && 
			 StartTime == "" &&
			 EndTime == "" &&
			 ReasonId == ""  ) {
			alert("Information not complete!");
		} else {
			var SendData = {
				AgentId : AgentId , 
				Username : Username , 
				FullName : FullName , 
				DateSchedule : DateSchedule , 
				DayName : DayName , 
				StartTime : StartTime ,
				EndTime : EndTime , 
				ReasonId : ReasonId 
			};	

			var UrlSendSchedule = Ext.DOM.INDEX + "/ScheduleAgent/SetSchedule/";
			var ParamSend = {
				url : UrlSendSchedule , 
				type : "POST" , 
				data : SendData , 
				dataType : "json" , 
				success : function ( data ) {
					if ( data.success == "1" ) {
						alert(data.message);
						// clear all data content input
						ToolsProcessData.ResetData();						
					} 	
					else if ( data.success == "0" ) {
						alert(data.message);
					}
				}
			};
			$.ajax(ParamSend);
		}




	}, 


	Ready : function () {
		$(".closesendschedule").click(function () {
			ToolsProcessData.ResetData();
		});

		Ext.Cmp("Agent").disabled(true);
		Ext.Cmp("DateSchedule").disabled(true);

	}

	
};

ToolsProcessData.Ready();

function setTime ( class_es ) {
	var class_data = $("#"+class_es);
	$(class_data).attr('maxlength','5');
	$(class_data).keyup(function () {
		var value_data = $(this).val();
		if ( !isNaN(value_data) ) {
			var checkLength = parseInt(value_data.length);
			if ( checkLength >= 4 ) {
				var char_time = value_data[0];
				char_time += value_data[1];
				char_time += ":";
				char_time += value_data[2];
				char_time += value_data[3];
				$(this).attr('value',char_time);
			}
		} else {
			//alert("This is not number!");
			return false;
		}
	});
}

setTime('starttime_att');
setTime('endtime_att');


$(function () {
	$("#selectMonthPeriode").change(function (e) {
		var thisMonthPeriode = $(this).val();
		if ( thisMonthPeriode == '' ) {
			//alert('Month cannot be Empty!');
		} else {
			//alert(thisMonthPeriode);
			var AgentId      = $(".UserIdAgent").val();
			$.ajax({
				url : Ext.DOM.INDEX + "/ScheduleAgent/generateDate/"+thisMonthPeriode+"/"+AgentId , 
				type : "POST" , 
				data : { status_send : '1' } , 
				dataType : "html" , 
				success : function (data) {
					$('.content_generate_month').html(data);
					getValueParamAddSchedule();
				}
			});
		}
	});

	$(".closeaddcoach").click(function () {
		ToolsProcessData.ResetData();
	});
});

function getValueParamAddSchedule () {
	$(".param_value_addschedule").click(function () {
		var all_value_content = {};
		var no = 0;
		$('td' , this).each(function () {
			all_value_content[no++] = $(this).html();
		});
		
		// DateSchedule
		// DayName
		// starttime_att
		// endtime_att
		// ReasonId
		
		/**
		 * 
		0 "2016-01-02"
		1 "Sabtu"
		2 "Reason"
		3 "09:00"
		4 "15.00"
		 */
		
		$("#DateSchedule").attr( 'value' , all_value_content[0]);
		//$("#FullName").html(all_value_content[0]);
		$("#starttime_att").attr(  'value' , all_value_content[3]);
		$("#DayName").attr(  'value' , all_value_content[1]);
		$("#endtime_att").attr( 'value' , all_value_content[4]);

	});
}

</script>


	


<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmUserRegistration">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tanggal Absen'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("date_absen", "input_text long date", _get_exist_session('date_absen') );?></div>

			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption center"></div>
			<div class="ui-widget-form-cell"></div>

			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Agent'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("agentid", "input_text select tolong long", $AOC , _get_exist_session("agentid") );?></div>

			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption center"></div>
			<div class="ui-widget-form-cell"></div>
			
			<div class="ui-widget-form-cell text_caption">Interval</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->input('startdate','input_text box startdate date' , _get_exist_session('startdate') );?> &nbsp - <?php echo form()->input('enddate','input_text box enddate date' , _get_exist_session('enddate'));?>
				
			</div>

		</div>
		
		<div class="ui-widget-form-row">

			
		</div>
		
	</div>
	</form>


 </div>
 
<div class="ui-widget-toolbars" id="toolbars"></div>


<div style="display:none;" class="addScheduleAgentdiv">
<?php $this->load->view("mod_schedule_agent/view_add_schedule_spv"); ?>

</div>


<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>



</fieldset>	




