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
	custnav  : Ext.DOM.INDEX+'/Escoring/index',
	custlist : Ext.DOM.INDEX+'/Escoring/Content'			
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
    var CustomerId  = $("#CustomerId:checked").val();
	if( CustomerId == '' ){ Ext.Msg("Please select rows ").Info();  }
	else 
	{	
		Ext.ShowMenu(new Array("QtyApprovalInterest","EscoringQualityDetail"), 
			Ext.System.view_file_name(),
		{
			CustomerId 	 : CustomerId,
			ControllerId : "QtyScoring"
		});
	 }
	// return;
	// Ext.Serialize('FrmUserRegistration').Clear();
	// new Ext.DOM.searchAgent();
}

Ext.DOM.Clear2 = function(){
     Ext.Serialize('FrmUserRegistration').Clear();
     new Ext.DOM.searchAgent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.UserCapacity = function() {
	return Ext.Ajax ({  url : Ext.EventUrl(['Escoring','UserCapacity']).Apply(),  method  : 'POST', param   : {
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
			['Detail'],

			<?php if ( _get_session('HandlingType') == USER_SUPERVISOR ) {
				echo "['Add'],['Remove'],";
			} 
			?>
			['Edit']
		],
		extMenu :[
			['searchAgent'],
			['Clear'],
			
			<?php if ( _get_session('HandlingType') == USER_SUPERVISOR ) {
				echo "['addUser'],['ToolsProcessData.removeData'],";
			} 
			?>

			<?php if( _get_session('HandlingType') == USER_SUPERVISOR ) {
				echo "['ToolsProcessData.editDataSpv']";
			 } else {
				echo "['ToolsProcessData.editDataAgent']";
			 } 
			?>
		],
		extIcon :
		[
			['zoom.png'],
			['zoom_out.png'],

			<?php if ( _get_session('HandlingType') == USER_SUPERVISOR ) {
				echo "['add.png'],['cross.png'],";
			} 
			?>

			
			
			['pencil.png']
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

	/**
	 * [showHideAddCoach description]
	 * @return {[type]} [description]
	 */
	closeAddCoach : function () {
		$(".closeaddcoach").click(function () {
			$(".frmAddCoaching").fadeOut();
			$(".frmAddCoaching").attr("display" ,"none");

		});

		$(".closeeditcoach").click(function () {
			$(".frmEditCoaching").fadeOut();
			$(".frmEditCoaching").attr("display" ,"none");
		});
	} , 

	closeEditCoachSpv : function () {
		$(".closeeditcoachspv").click(function () {
			$(".frmEditCoachingSpv").fadeOut();
			$(".frmEditCoachingSpv").attr("display" ,"none");
		});
	} , 

	reloadData : function () {
		Ext.DOM.Clear();
	} , 

	BaseUrl : Ext.DOM.INDEX + "/" ,

	removeData : function () {
		var IDDelete = $("#ID:checked");
		

		var UrlDeleteData = Ext.DOM.INDEX + "/";
		UrlDeleteData += "Escoring/DeleteCoach/";

		var ValueData = $(IDDelete).val();

		if ( typeof IDDelete == 'undefined' ) {
			alert("Please Select 1 Row!");
			return false;
		} else {
 			// POST Data 
			if ( confirm( "Are you sure for Delete this Coaching ?" ) ) {
				$.ajax({
					url : UrlDeleteData , 
					data : { CoachingId : ValueData } , 
					dataType : "json" , 
					type : "POST" , 
					success : function (data) {
						if ( data.success == 1 ) {
							alert("Success , Delete Coaching!");
							Ext.DOM.Clear();
						} else {
							alert("Failed , Delete Coaching!");
						}
					}
				});
			} else {

			}
		}

	} , 

	saveCoach : function () {
		// AgentId
		// Periode
		// CoachingDate
		// NotePrevCoach
		// DiscussionPoint
		// DevRequired
		 
		var AgentId         = $("#AgentId").val();
		var Periode         = $("#Periode").val();
		var CoachingDate    = $("#CoachingDate").val();
		var NotePrevCoach   = $("#NotePrevCoach").val();
		var DiscussionPoint = $("#DiscussionPoint").val();
		var CoachingType    = $("#CoachingType").val();

		//var DevRequired     = $("#DevRequired").val();

		if ( AgentId         == "" ) {
			alert("AOC is Empty!");
			return false;
		} if ( Periode         == "" ) {
			alert("Periode is Empty!");   
			return false;
		} if ( CoachingDate    == "" ) {
			alert("CoachingDate is Empty!");   
			return false;
		} if ( NotePrevCoach   == "" ) {
			alert("Note Previous Coach is Empty!"); 
			return false;  
		} if ( DiscussionPoint == "" ) {
			alert("Discussion Point(s) is Empty!");   
			return false;
		} if ( CoachingType == "" ) {
			alert("Coaching Type is Empty!");   
			return false;
		}

		var DataSendCoach = {
			AgentId         : AgentId , 
			Periode         : Periode , 
			CoachingDate    : CoachingDate , 
			NotePrevCoach   : NotePrevCoach , 
			DiscussionPoint : DiscussionPoint ,
			CoachingType    : CoachingType 
			//DevRequired     : DevRequired
		};

		$.ajax({
			url : this.BaseUrl + "Escoring/SendCoach/" , 
			type : "POST" , 
			data : DataSendCoach , 
			dataType : "json", 
			success : function (data) {
				if ( data.success == 1 ) {
					alert("Success, Insert Coaching!");
					Ext.DOM.Clear();
				} 
				if ( data.success == 0 ) {
					alert("Failed, Insert Coaching!");
				}
			} 
		});
		//return false;
	} , 

	saveCoachSpv : function () {
		// AgentId
		// Periode
		// CoachingDate
		// NotePrevCoach
		// DiscussionPoint
		// DevRequired
		 
		var AgentId         = $("#AgentId_edit").val();
		var Periode         = $("#Periode_edit").val();
		var CoachingDate    = $("#CoachingDate_edit").val();
		var NotePrevCoach   = $("#NotePrevCoach_edit").val();
		var DiscussionPoint = $("#DiscussionPoint_edit").val();
		var CoachingType    = $("#CoachingType_edit").val();
		var CoachingId      = $("#CoachingId_edit").val();

		//var DevRequired     = $("#DevRequired").val();

		if ( AgentId         == "" ) {
			alert("AOC is Empty!");
			return false;
		} if ( Periode       == "" ) {
			alert("Periode is Empty!");   
			return false;
		} if ( CoachingDate    == "" ) {
			alert("CoachingDate is Empty!");   
			return false;
		} if ( NotePrevCoach   == "" ) {
			alert("Note Previous Coach is Empty!"); 
			return false;  
		} if ( DiscussionPoint == "" ) {
			alert("Discussion Point(s) is Empty!");   
			return false;
		} if ( CoachingType    == "" ) {
			alert("Coaching Type is Empty!");   
			return false;
		} if ( CoachingId      == "" ) {
			alert("CoachingId is Empty!");   
			return false;
		}

		var DataSendCoach = {
			AgentId         : AgentId , 
			Periode         : Periode , 
			CoachingDate    : CoachingDate , 
			NotePrevCoach   : NotePrevCoach , 
			DiscussionPoint : DiscussionPoint ,
			CoachingType    : CoachingType ,
			CoachingId      : CoachingId 
			//DevRequired    : DevRequired
		};

		$.ajax({
			url : this.BaseUrl + "Escoring/SendCoachEdit/" , 
			type : "POST" , 
			data : DataSendCoach , 
			dataType : "json", 
			success : function (data) {
				if ( data.success == 1 ) {
					alert("Success, Edit Coaching!");
					Ext.DOM.Clear();
				} else {
					alert("Failed, Edit Coaching!");
				}
			} 
		});
		//return false;
	} , 

	saveCoachAgent : function () {
		//alert('testing');
		//return false;
		var IDDelete = $("#CustomerId");
		var notes = $("#notes");
		//var cus   = $(IDDelete).val();
		// alert(cus);
		// return false
		var CoachingId = $(".CoachingId");
		var DevRequired = $("#DevRequired");


		var CoachingId         = $(CoachingId).val();
		var DevRequired         = $(DevRequired).val();
		var note                =$(notes).val();
		// alert(CoachingId);
		// return false
        // alert(DevRequired);
        // return false;
		//var DevRequired     = $("#DevRequired").val();

		if ( CoachingId    == "" ) {
			alert("CoachingId is Empty!");
			return false;
		} if ( note == "" ) {
			alert("note is Empty!");   
			return false;
		} 
		
		var SendDataEdit = {
			CoachingId : CoachingId , 
			DevRequired : DevRequired,
			note        : note
		};

		$.ajax({
			url : this.BaseUrl + "Escoring/EditCoachAgent/" , 
			type : "POST" , 
			data : SendDataEdit , 
			dataType : "json", 
			success : function (data) {
				if ( data.success == 1 ) {
					alert("Success, Edit Coaching!");
					Ext.DOM.Clear2();
				} 
				if ( data.success == 0 ) {
					alert("Failed, Edit Coaching!");
				}
			} 
		});

	} , 

	editDataAgent : function () {
		var IDDelete = $("#CustomerId:checked");
         
		var UrlDeleteData = Ext.DOM.INDEX + "/";
		UrlDeleteData += "Escoring/EditCoachAgent/";

		var ValueData = $(IDDelete).val();
		// alert(ValueData);
		// return false
		if ( typeof ValueData == "undefined" ) {
			alert("Please Select 1 Row!");
			//return false;	
		} else {
			$(".CoachingId").attr("value" , ValueData);
			$(".frmEditCoaching").fadeIn();	
		}
	} , 

	editDataSpv : function () {
		var IDDelete = $("#ID:checked");
        
		var UrlViewData = Ext.DOM.INDEX + "/";
		UrlViewData += "Escoring/EditCoachSpv/";

		var ValueData = $(IDDelete).val();
        if ( typeof ValueData == 'undefined' ) {
			alert("Please Select 1 Row sjsjjsjsjj!");
			return false;
		} else {
			// POST Data 
			
			var AppendEditTo = $(".coacheditspv");

			$.ajax({
				url : UrlViewData , 
				data : { CoachingId : ValueData } , 
				dataType : "html" , 
				type : "POST" , 
				success : function (data) {
					$(".coacheditspv").html(data);
				}
			});
			
		}
	}

};

ToolsProcessData.closeAddCoach();


	
</script>


	


<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmUserRegistration">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_id", "input_text long", _get_exist_session('user_id') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_name", "input_text long", _get_exist_session('user_name') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Agent'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_name", "input_text select tolong long", $AOC );?></div>
			
		</div>
		
		<div class="ui-widget-form-row">

			
		</div>
		
	</div>
	</form>




 </div>
 
<div class="ui-widget-toolbars" id="toolbars"></div>

<?php $this->load->view("mod_e_scoring/view_add_coaching" ,  array("AOC" => $AOC) ); ?>
<?php $this->load->view("mod_e_scoring/view_edit_coaching" ,  array("AOC" => $AOC) ); ?>

<div class="coacheditspv">

</div>


<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	




