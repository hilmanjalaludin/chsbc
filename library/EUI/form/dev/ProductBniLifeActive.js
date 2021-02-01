// ---------------------------------------------------------------------------------------------------------

/* 
 * @ pakage code  		 0b009
 * @ package 		 	 Product BNI Life Active Modul Java Script Language

 -----------------------------------------------------------------------------------------------------------
 
 * @ author 			 razaki team ( deplovment division )
 * @ date 				 2016-02-05  
 * 
 */
 
var tmp_selected_box = {}; 
var tmp_selected_bnf = {};
var config  = {};
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
(function( ){
   var config_system = Ext.Ajax({ 
		url		: Ext.EventUrl(new Array('ActiveMenu','UserConfig') ).Apply(), 
		method  : 'GET', 
		param	: {	
			time: Ext.Date().getDuration()
		} 
	}).json();
	
   if( typeof(config_system)  == 'object' ) {
	   for( var sfv in config_system ){
			config[sfv] = config_system[sfv];
	   }	   
   }
})();
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */

var INT_DEPEND_CODE = config.INS_CODE_DEPEND;
var INT_MAIN_CODE 	= config.INS_CODE_MAIN;
var INT_RIDER_CODE	= config.INS_CODE_RIDER;
var INT_SPOUSE_CODE = config.INS_CODE_SPOUSE;
var INT_FAMILY_CODE	= config.INS_CODE_FAMILY;
var VAR_MAIN_CODE 	= new Array(config.INS_CODE_MAIN, 1).join('_');
var VAR_SPOUSE_CODE = new Array(config.INS_CODE_SPOUSE, 1).join('_');
var VAR_RIDER_CODE  = new Array(config.INS_CODE_RIDER, 1).join('_');

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
 
 function OpenCheckedBeneficiary() 
{
  var checked = Ext.Cmp("Benefiecery").getValue();
  for( var isz in checked ){
	var classid = new Array('.frmbenef',checked[isz]).join('_');
	$( classid ).each(function(){
		Ext.Cmp($(this).attr('id')).disabled(false);
	});
  }	
}

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method -----------------< comment on here >
 */

function NodeClass( obj ){
 var classList = $(obj).attr('class');
 if( obj.value == 'Y'){
	$('.node-'+ classList).attr('disabled', false);
	$('.node-'+ classList).addClass('yes-required-input');
	$('.node-'+ classList).removeClass('no-required-input');
	
 } else {
	$('.node-'+ classList).addClass('no-required-input');
	$('.node-'+ classList).removeClass('yes-required-input');
	$('.node-'+ classList).attr('disabled', true);
 }
 
}
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method -----------------< comment on here >
 */
 
function ValidateUnderwriting() {
	var underwrite = {};
	var Serialize = Ext.Serialize('frmUnderwriting').getElement();
	for( var node in Serialize  ){
	
		var classList = $( '#'+ node).attr('class').split(/\s+/);
		if( $( '#'+ node).attr('class').split(/\s+/).indexOf('no-required-input') > 0 ){
			underwrite[node] = node;	
		}	
	}	
	
	return Object.keys(underwrite);
	
}
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
function IsUnderwriting() {
 var isunderwriting = Ext.Cmp("isunderwriting").getValue();
 if( isunderwriting == 1) {
	return true;	
 } else {
	 return false;
 }
 
}


// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
function IsBenefiecery() {
 var IsBenefiecery = Ext.Cmp("IsBenefiecery").getValue();
 var BenefieceryBox = Ext.Cmp("Benefiecery").getValue();
 
 if( IsBenefiecery==1 ) {
	if( BenefieceryBox.length == 0 ){
		return false;
	}		
 } 
 return true 
 
}

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
 function OpenCheckedInsured() 
{
  var checked = Ext.Cmp("GroupPremi").getValue();
  for( var isz in checked ){
	var classid = new Array('.form',checked[isz]).join('_');
	$( classid ).each(function(){
		Ext.Cmp($(this).attr('id')).disabled(false);
	});
  }	
}

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */
 
function SelectDeleteBox() 
{
	var InsuredBox = Ext.Cmp("GroupPremi").getCheckBox().IsUnchecked(),
		BenefitsBox = Ext.Cmp("Benefiecery").getCheckBox().IsUnchecked(), 
	selector = {
		'InsuredBox' : InsuredBox,
		'BenefitBox' : BenefitsBox	 
	};
	
	return selector; 
}

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */

function SelectValidationPercentage() 
{
	var Benefiecery = Ext.Cmp('Benefiecery').getValue(),
		BenefPercentage  = {};
	
	for( var i in Benefiecery ){
		var selector = new Array('frmbenef', Benefiecery[i]).join('_');
		
		$( new Array('.', selector).join('')).each(function( ){
			var arr_class = $(this).attr('class').split(" ");
			if( arr_class.indexOf("ui-self-percentage") > 0 ){
				BenefPercentage[$(this).attr('id')] = $(this).attr('id');
			}
		})
	}
	
  var modulus = 100, total = 0;
  for( var i in BenefPercentage ){
	  total = total + parseInt(Ext.Cmp(BenefPercentage[i]).getValue());
  }  
  
  return ( (total > modulus) ? false : true );
  
}
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */

function SelectValidationBenefiecery() 
{
	var Benefiecery = Ext.Cmp('Benefiecery').getValue(),
		BenefObject  = {};
	if( Benefiecery.length == 0 ){
		return false;
	}
	for( var i in Benefiecery ){
		var selector = new Array('frmbenef', Benefiecery[i]).join('_');
		
		$( new Array('.', selector).join('')).each(function( ){
			BenefObject[$(this).attr('id')] = $(this).attr('id');
		})
	}
	
	var cond = Ext.Serialize('frmBenefiecery').Required( Object.keys(BenefObject) );
	if(  cond ){
		return true;
	}
	
	return false;
}


// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		-----------------< comment on here >
 */

function SelectValidationInsured() 
{
	var GroupPremi = Ext.Cmp('GroupPremi').getValue(),
		InusredObject  = {};
	if( GroupPremi.length == 0 ){
		return false;
	}
	
	for( var i in GroupPremi ) 
	{
		if( GroupPremi[i] != VAR_MAIN_CODE ) 
		{
			var selector = new Array('form', GroupPremi[i]).join('_');
			$( new Array('.', selector).join('')).each(function( ){
				var arr_class = $(this).attr('class').split(" ");
				if( arr_class.indexOf("not-required") < 0 ){
					InusredObject[$(this).attr('id')] = $(this).attr('id');
				}
			});
		}	
	}
	
	var cond = Ext.Serialize('frmSpouseInsured').Required( Object.keys(InusredObject) );
	if(  cond ){
		return true;
	} 
	
	var cond = Ext.Serialize('frmDependentInsured').Required( Object.keys(InusredObject) );
	if(  cond ){
		return true;
	}
	
	return false;
}
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		focus tab on selector user 
 */
 
 function SelectedInterfaceTab( index ) 
{
	if( typeof( index ) =='undefined' ){
		$('#result_content_add').mytab().tabs("option", "selected", 0);	
	} else {
		$('#result_content_add').mytab().tabs("option", "selected", index);
	}	
} 
 

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		event user submit entry data on form application 
 */
 
 function SetEventSubmit() 
{
	
   var frmDataProduct = Ext.Serialize('frmDataProduct'),
	  frmDataPayersContact = Ext.Serialize('frmDataPayersContact'),
	  frmDataPayersPersonal = Ext.Serialize('frmDataPayersPersonal'),
	  frmDataPayersZipcode = Ext.Serialize('frmDataPayersZipcode'),
	  frmDependentInsured = Ext.Serialize('frmDependentInsured'),
	  frmSpouseInsured = Ext.Serialize('frmSpouseInsured'),
	  frmMainInsured = Ext.Serialize('frmMainInsured'),
	  frmBenefiecery = Ext.Serialize('frmBenefiecery'),
	  frmTransactionPlan = Ext.Serialize('frmTransactionPlan'),
	  frmTransactionCard = Ext.Serialize('frmTransactionCard'),
	  frmSelectDeleteBox = new SelectDeleteBox(),
	  frmUnderwriting = Ext.Serialize('frmUnderwriting'),
	  formSkipUnderwriting = new ValidateUnderwriting();
	  
 /* 04042016 : handle invalid data premi */
  /* ------------------------------------ */
  
  var TotalPremiPayment	 = Ext.Cmp("InsuredPremi").getValue();
  if( TotalPremiPayment == 0 || TotalPremiPayment == '0' ){
	Ext.Msg("Total Premi Not Valid").Info();
	return false;	
  }
  
  if( !frmDataProduct.Complete(new Array('PolicyNumber'))){
	Ext.Msg("Form Product Not Complete").Info();
	new SelectedInterfaceTab(0);
	return false;	
  }
  if( !frmDataPayersPersonal.Complete( new Array('PayerIdentificationNum')  ) ){
	Ext.Msg("Form Personal Data Not Complete").Info();
	new SelectedInterfaceTab(0);
	return false;	
  }
  
  if( !frmDataPayersContact.Required(new Array('PayerProvinceId','PayerZipCode','PayerMobilePhoneNum') ) ){
	Ext.Msg("Form Contact Not Complete").Info();
	new SelectedInterfaceTab(0);
	return false;	
  }	  
  
  
  if( !frmMainInsured.Complete(new Array('SubmitedPremi_2_1')) ){
	Ext.Msg("Form Main Insured Not Complete").Info();
	new SelectedInterfaceTab(1);
	return false;	
  }
  
  
  
  if( !SelectValidationInsured() ) {
	Ext.Msg("Form Insured Not Complete").Info();
	new SelectedInterfaceTab(1);
	return false;	  
  }
  
  if( !frmTransactionPlan.Complete() ){
	Ext.Msg("Form Plan Insured Not Complete").Info();
	new SelectedInterfaceTab(2);
	return false;	
  }
  
   if( IsUnderwriting() && !frmUnderwriting.Complete( formSkipUnderwriting ) ){
	Ext.Msg("Form Underwriting Not Complete").Info();
	new SelectedInterfaceTab(3);  
	return false;
  }	 
  
 if( !IsBenefiecery()  ){
	Ext.Msg("Please input form benefiecery").Info();
	new SelectedInterfaceTab(4);
	return false;
  }
  
  if( !IsBenefiecery() && !SelectValidationBenefiecery() ){
	  Ext.Msg("Form Beneficiary Not Complete").Info();
	  new SelectedInterfaceTab(4);
	  return false;
  }
  
  if( !SelectValidationPercentage() ){
	  Ext.Msg("Form Beneficiary Percentage Invalid!").Info();
	  new SelectedInterfaceTab(4);
	  return false;
  }
 // ------------- save data policy ---> 
 
  Ext.Ajax   ({
		url 	: Ext.EventUrl(new Array('ProductBniLifeActive','SaveDataEntry')).Apply(),
		method 	: 'POST',
		param 	: Ext.Join(new Array
				(
					frmDataProduct.getElement(),
					frmDataPayersContact.getElement(),
					frmDataPayersPersonal.getElement(),
					frmDataPayersZipcode.getElement(),
					frmDependentInsured.getElement(),
					frmSpouseInsured.getElement(),
					frmMainInsured.getElement(),
					frmBenefiecery.getElement(),
					frmTransactionPlan.getElement(),
					frmTransactionCard.getElement(),
					frmUnderwriting.getElement(),
					frmSelectDeleteBox
				)).object(),	
		 ERROR : function( response )
		{
			Ext.Util( response ).proc(function( data ){
				if( data.success ){
					Ext.Msg("Save Data Entry").Success();
					Ext.Cmp('PolicyNumber').setValue(data. PolicyNumber);	
				} else {
					Ext.Msg("Save Data Entry").Failed();
				}	
			});
		}
	}).post();
}

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
   @ bject = 
	{
		ProductId   : 0,
		PlanId 	    : 0, 
		PayMode 	: 0, 
		GroupPremi  : 0, 
		GenderId 	: 0,
		PersonalAge : 0
	}
 */
 
function SelectCalculatorPremi( object )  
{
	var object = object, selector = 
	{
		listener : function() {
			return ( Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('ProductBniLifeActive','SelectPremiPersonal')).Apply(),
				method 	: 'POST',
				param 	: { personal_data : JSON.stringify(object) }
			}).json() );
		},
		
		object : function() {
			try{
				return this.listener();
			} catch (e){
				return {};
			}
		}
	}
	
	return ( typeof( selector ) == 'object' ? selector : {} );
} 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 function MainInsuredCopy( cond )
{
 var out = tmp_selected_box;
 if( cond == VAR_MAIN_CODE )
 {
	var InsuredDOB = new Array('InsuredDOB',cond).join('_'),
		InsuredGenderId = new Array('GenderId',cond).join('_'),
		InsuredSalutation = new Array('SalutationId',cond).join('_'),
		InsuredFirstName = new Array('InsuredFirstName',cond).join('_'),
		InsuredRelationship = new Array('RelationshipTypeId',cond).join('_'),
		InsuredAge = new Array('InsuredAge',cond).join('_');
		InsuredPremi = new Array('SubmitedPremi',cond).join('_');
	
		// --------------- one by one  -------------------------------------------
		
		if( typeof ( out[InsuredDOB] )== 'undefined') {
			Ext.Cmp(InsuredDOB).setValue(Ext.Cmp('PayerDOB').getValue());}  
		else 
		{
			if( Ext.Cmp('PayerDOB').empty() ){
				Ext.Cmp(InsuredDOB).setValue(out[InsuredDOB]);	
			} else{
				Ext.Cmp(InsuredDOB).setValue(Ext.Cmp('PayerDOB').getValue());
			}
		}
		
	// --------------- one by one  -------------------------------------------
	
		if( typeof ( out[InsuredGenderId] )== 'undefined') {
			Ext.Cmp(InsuredGenderId).setValue(Ext.Cmp('PayerGenderId').getValue()); }  
		else 
		{
			if( Ext.Cmp('PayerGenderId').empty() ){
				Ext.Cmp(InsuredGenderId).setValue(out[InsuredGenderId]);
			} else{
				Ext.Cmp(InsuredGenderId).setValue(Ext.Cmp('PayerGenderId').getValue());
			}
			
		}
		
	// --------------- one by one  -------------------------------------------	
		if( typeof ( out[InsuredSalutation] ) == 'undefined') {
			Ext.Cmp(InsuredSalutation).setValue(Ext.Cmp('PayerSalutationId').getValue());} 
		else 
		{
			if( Ext.Cmp('PayerSalutationId').empty() ){
				Ext.Cmp(InsuredSalutation).setValue(out[InsuredSalutation]);
			} else{
				Ext.Cmp(InsuredSalutation).setValue(Ext.Cmp('PayerSalutationId').getValue());
			}
		}
		
	// --------------- one by one  -------------------------------------------	
		if( typeof ( out[InsuredFirstName] ) == 'undefined') {
			Ext.Cmp(InsuredFirstName).setValue(Ext.Cmp('PayerFirstName').getValue());} 
		else
		{
			if( Ext.Cmp('PayerFirstName').empty() ){
				Ext.Cmp(InsuredFirstName).setValue(out[InsuredFirstName]);
			} else{
				Ext.Cmp(InsuredFirstName).setValue( Ext.Cmp('PayerFirstName').getValue());
			}
		}
		
	// --------------- one by one  -------------------------------------------	
		
		if( typeof (out[InsuredAge]) == 'undefined') {
			Ext.Cmp(InsuredAge).setValue( Ext.Cmp('PayerAge').getValue());} 
		else
		{
			if( Ext.Cmp('PayerAge').empty() ){
				Ext.Cmp(InsuredAge).setValue(out[InsuredAge]);
			} else{
				Ext.Cmp(InsuredAge).setValue( Ext.Cmp('PayerAge').getValue());
			}
		}
		
		
	// ----------- on TMP ------------------
		if( typeof(out[InsuredRelationship]) !='undefined' ){
			Ext.Cmp(InsuredRelationship).setValue(out[InsuredRelationship]); } 
		else{
			Ext.Cmp(InsuredRelationship).setValue(0);
		}
		
		
		if( typeof(out[InsuredPremi]) !='undefined' ){
			Ext.Cmp(InsuredPremi).setValue(out[InsuredPremi]); } 
		else{
			Ext.Cmp(InsuredPremi).setValue("");
		}
	}	
 }
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 function InsuredAge( object )
{
	return( Ext.Ajax ({
			url 	: Ext.EventUrl(new Array('ProductBniLifeActive', 'SelectInsuredAge') ).Apply(), // +"/ProductForm/DOB/",
			method 	:'GET',
			param 	: { 
				Date  :  object.Date, 
				GroupPremi : object.GroupPremi,   
				ProductId : object.ProductId 
			},
		}).json() 
	); 	
 }
 
 // --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 function AgeCallculator( Date )
{
	return( Ext.Ajax  ({
			url 	: Ext.EventUrl(new Array('ProductBniLifeActive', 'SelectCalculateAge') ).Apply(), 
			method 	:'GET',
			param 	: { 
				Date  : ( typeof( Date ) !='undefined' ? Date : '' )
			},
		}).json() 
	); 	
 }
 
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
  function SetBenefieceryChecked( object )
 {
	var selector = new Array(".frmbenef", $(object).val()).join('_');
	if( object.checked ) 
	{	
		$( selector ).each(function()  {
			var $field = $(this).attr('id');
				Ext.Cmp($field).disabled(false);
				if( typeof( tmp_selected_bnf[$field] ) != 'undefined' ){
					Ext.Cmp($field).setValue(tmp_selected_bnf[$field]);
				}
		});	
	} 
	else {
		
		$( selector ).each(function(){
			var $field = $(this).attr('id');
				tmp_selected_bnf[$field] =  Ext.Cmp($field).getValue();
				Ext.Cmp($field).setValue('');
				Ext.Cmp($field).disabled(true);
		});	
	}	  
 }
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function RegisterChosenPlugin() 
{
	var updateDatepickerOriginal = $.datepicker._updateDatepicker;
		$.datepicker._updateDatepicker = function() {
			var response = updateDatepickerOriginal.apply(this,arguments);
			this.dpDiv.find('select').chosen();
			return response;
		};
}	
	
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
  function SetInsuredChecked( object )
 {
	var selector = new Array(".form", $(object).val()).join('_');
	if( object.checked )
	{
		new MainInsuredCopy( object.value );
		$( selector ).each(function()
		{
			var $field = $(this).attr('id');
				Ext.Cmp($field).disabled(false);
				if( object.value != VAR_MAIN_CODE && typeof(tmp_selected_box[$field]) != 'undefined' )  {
					Ext.Cmp($field).setValue( tmp_selected_box[$field] );
				}
		});	
	} else {
		
		$( selector ).each(function(){
			var $field = $(this).attr('id');
			tmp_selected_box[$field] =  Ext.Cmp($field).getValue('');
			Ext.Cmp($field).setValue('');
			Ext.Cmp($field).disabled(true);
		});	
	}	 
 }
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 function EventBirthBeneficiary()
 {
	$( '.benefiecery-dob' ).datepicker
	({
		showOn 			: 'button',  
		buttonImage 	: window.opener.Ext.DOM.LIBRARY+'/gambar/calendar.gif',  
		buttonImageOnly	: true,  
		dateFormat 		: 'dd-mm-yy', yearRange: "1945:2030",
		changeYear 		: true, 
		changeMonth		: true,
		onSelect 		: function( date ) {
			
			var selector = $(this).attr('id').split('_');
			var AgeCalculation = new AgeCallculator( $(this).val() );
			var AgeCallId = new Array('BenefAge', selector[1] ).join('_');
			
			if( typeof AgeCalculation  == 'object') {
				Ext.Cmp(AgeCallId).setValue(AgeCalculation.Age);
				Ext.Cmp(AgeCallId).disabled(true);
			} else{
				Ext.Cmp(AgeCallId).disabled(true);
				Ext.Cmp(AgeCallId).setValue('');
			}
		} 
	 });
	 
	$( '.benefiecery-dob' ).click(function(){
		$(this).val('00-00-0000');
		var $ArrSplit = $(this).attr('id').split("_");
		Ext.Cmp( new Array("BenefAge", $ArrSplit[1]).join("_")).setValue(0);
	});
	
 }
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
function Protected(){
	$('.ui-widget-disabled-data').each(function(){
		$(this).attr('readonly', true);
	});
	
	$('.hasDatepicker').each(function(){
		$(this).attr("readonly", true);
	});
} 

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
  function EventBirthInsured()
 {
	$('.insured-dob').datepicker
	({
		showOn : 'button',  
		buttonImage : window.opener.Ext.DOM.LIBRARY+'/gambar/calendar.gif',  
		buttonImageOnly	: true,  
		dateFormat : 'dd-mm-yy', yearRange: "1945:2030",
		changeYear : true, 
		changeMonth	: true,
		onSelect : function( date )
		{
			var selector = $(this).attr('id').split('_');
			if( selector.length == 2 ){
				var InsuredAgeId = new Array('InsuredAge', selector[1]).join('_');
			} else {
				var InsuredAgeId = new Array('InsuredAge', selector[1],selector[2]).join('_');
			}
			
			// --- next  -------------------------
			
			if( typeof( date ) =='string') 
			{
				var vdate = date.split('-');
				var calendar = new Array(vdate[2], vdate[1], vdate[0]).join('-');
				
				if(new Date(calendar.replace(/-/gi,"/")) > new Date()) {
					alert('Invalid Date');
					Ext.Cmp($(this).attr('id')).setValue('');
				}
				else
				{
					var data = new InsuredAge({ 
						GroupPremi : selector[1],
						ProductId : $('#ProductId').val(),
						Date : $(this).val(),
					});
					
					if( typeof (data) == 'object' && data.success  == 1 ){ 
						Ext.Cmp(InsuredAgeId).setValue( data.InsuredAge );
						Ext.Cmp(InsuredAgeId).disabled(true);
						if( selector[1] == INT_MAIN_CODE ){
							Ext.Cmp('PayerAge').setValue( data.InsuredAge );
						}	
					} else{ 
						Ext.Cmp(InsuredAgeId).setValue('');
						Ext.Cmp(InsuredAgeId).disabled(true);
						if( selector[1] ==  INT_MAIN_CODE ){
							Ext.Cmp('PayerAge').setValue(0);
						}
					}	
				}
			}	
		} 
	 });
 }

 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */ 
 
function SetPremiPersonal( object )
{
	var GroupPremi = Ext.Cmp('GroupPremi').getValue();
	var GroupPremiObject = {}; 
	
	for( var n in GroupPremi )   {
		
		var GenderId = new Array('GenderId', GroupPremi[n]);
		var PersonalAge = new Array('InsuredAge', GroupPremi[n]);
		
		GroupPremiObject[GroupPremi[n]] = {
			'GroupPremi': parseInt(GroupPremi[n]),
			'ProductId': parseInt(Ext.Cmp('ProductId').getValue()),
			'PlanId': parseInt(Ext.Cmp('InsuredPlanType').getValue()), 
			'PayMode': parseInt(Ext.Cmp('InsuredPayMode').getValue()), 
			'GenderId': parseInt(Ext.Cmp(GenderId.join('_')).getValue()),
			'PersonalAge': parseInt(Ext.Cmp(PersonalAge.join('_')).getValue())
		}	
	}	
	
// ---------- set to server request  ---------------------------------------
	var total_premi = 0;
	if( typeof GroupPremiObject  == 'object') 
	{
		var obClass = new SelectCalculatorPremi(GroupPremiObject);
		var PersonalObject = obClass.object();
		
		if( typeof(PersonalObject) =='object' ) 
			for( var n in PersonalObject )
		{
			if( typeof PersonalObject[n].PremiPerson != 'undefined' )
			{
				var $SubmitedIds = new Array('SubmitedPremi', n).join('_');
				var $SubmitedIdr = Ext.Format(PersonalObject[n].PremiPerson).IDR();
					Ext.Cmp($SubmitedIds).setValue($SubmitedIdr);
					Ext.Cmp($SubmitedIds).disabled(true);
					total_premi += parseInt(PersonalObject[n].PremiPerson);
			}	
		}
	}	
	
	Ext.Cmp('InsuredPremi').disabled(true);
	Ext.Cmp('InsuredPremi').setValue( Ext.Format(total_premi).IDR());
	
} 

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 function SearchByKeyword ( object ) 
{
	object.ProvinceId 	= Ext.Cmp('PayerProvinceId').getValue();
	object.ProductId  	= Ext.Cmp('ProductId').getValue();
	object.Keyword 		= Ext.Cmp('AddressKeywords').getValue();
	object.Limit	 	= 20;
	object.Event		= 1; 	
	Ext.Ajax  
	({
		url    : Ext.EventUrl([ 'ModCallHistory', 'PageAddress' ]).Apply(),
		method : 'POST',
		param  : {
			keyword 	: object.Keyword,
			ProvinceId 	: object.ProvinceId,
			ProductId 	: object.ProductId,
			limit 		: object.Limit,
			event		: object.Event,
			orderby   	: object.orderby,
			type 		: object.type,
			page 		: object.page	
		}
	}).load('product_list_preview');
 }
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function SearchZip() {
	var xxx = [];
	if(!Ext.Cmp('PayerProvinceId').empty()) {
		xxx = (Ext.Ajax ({
			url 	: window.opener.Ext.DOM.INDEX+"/ProductForm/GetZip/",
			method 	: 'POST',
			param 	: {
				time : Ext.Date().getDuration(),
				province : Ext.Cmp('PayerProvinceId').getValue()
			}
		}).json());
	}
	
	return xxx;
 }
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function WindowLayout() {
  $('#result_content_add').mytab().tabs();
  $('#result_content_add').mytab().tabs("option", "selected", 0);
  $("#result_content_add").mytab().close({}, true);
  $('#result_content_add').css ({ 'margin' : '10px 10px 20px 10px', 'float' : 'center' });
  $('#product-footer-button').css ({  'margin-top' : '-10px',  'margin-left' : '10px' });
  $('.zx-select').chosen();
} 

// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function WindowSelector() {
	$('.dfl-disabled').each(function(){
		Ext.Cmp($(this).attr('id')).disabled(true);
	});
} 


// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function WindowEvent() {
   $('#PayerProvinceId').bind('change', function(){ new SearchByKeyword({ orderby :'', type : '' }); });
   $('#AddressKeywords').bind('keyup', function(){ new SearchByKeyword({ orderby :'', type : '' }); });
}
 
// --------------------------------------------------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
function InitDatePicker() {			
	$('.date').datepicker 
	({
		showOn: 'button',  buttonImage: window.opener.Ext.DOM.LIBRARY+'/gambar/calendar.gif',  buttonImageOnly: true,  
		dateFormat	: 'dd-mm-yy', yearRange: "1945:2030",
		changeYear	: true, changeMonth	: true,
		onSelect	: function(date){
			if(typeof(date) =='string'){
				if(new Date(date.replace(/-/gi,"/")) > new Date()) {
					alert('Invalid Date');
					Ext.Cmp($(this).attr('id')).setValue('');
				}
				else{
					if( $(this).attr('id')=='InsuredDOB'){
						Ext.CountDOB('InsuredDOB','InsuredAge');
					}
					else if( $(this).attr('id')=='PayerDOB' )
					{
						Ext.CountDOB('PayerDOB','PayerAge');
					}
				}
			}	
		}
	}); 
	
}
// -------------------------------------------------------------
/* 
 * Method 		search data by keyword procedure by page 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
function EnableWindowParent(){
	try{
		window.opener.Ext.Cmp('CallStatus').disabled(false);
		window.opener.Ext.Cmp('CallResult').disabled(false);
		window.opener.Ext.Cmp('ProductForm').disabled(false);
		window.opener.Ext.Cmp('ButtonUserCancel').disabled(false);
		window.opener.Ext.Cmp('ButtonUserSave').disabled(false);	
	} catch( e ){
		console.log(e);
	}
} 


// -------------------------------------------------------------
/* 
 * Method 		search data by keyword procedure by page 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function SetEventExit() 
{
	if( Ext.Msg('Do you want to close from this session?').Confirm()) {
		new EnableWindowParent();
		window.close(this);	
	}
}


// -------------------------------------------------------------
/* 
 * Method 		search data by keyword procedure by page 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
function ButtonDisabled(){
	$('.button_disabled').each(function(){ 
		$(this).attr('disabled', true); 
		$(this).css({ 'color'  : "#DDDFFF" });
	});
} 

// -------------------------------------------------------------
/* 
 * Method 		search data by keyword procedure by page 
 *
 * @pack 		wellcome on eui first page 
 * @param		testing all 
 */
 
 Ext.DOM.SelectSearch = function( data )
{
 if( typeof(data) == 'object' ){
	Ext.Cmp('PayerCity').setValue(data.ZipKotaKab);
	Ext.Cmp('PayerZipCode').setValue(data.ZipCode);
 }	 
  Ext.DOM.SearchByKeyword({ orderby  : '', type : '' });	 
 }
 
// -------------------------------------------------------------
/* 
 * @ Method 		document ready handle jquery function 
 */
 
function EmailAddress(){
	var EmailAddress = window.opener.Ext.Cmp('CustomerEmail').getValue();
	Ext.Cmp("PayerEmail").setValue(EmailAddress);
} 
 
// -------------------------------------------------------------
/* 
 * @ Method 		document ready handle jquery function 
 */
 
  $(document).ready(function() 
 {
 	new WindowLayout();
	new WindowSelector();
	new WindowEvent();
	new RegisterChosenPlugin();
	new EventBirthInsured();
	new EventBirthBeneficiary();
	new OpenCheckedInsured();
	new OpenCheckedBeneficiary();
	new ButtonDisabled();
	new EmailAddress();
	new Protected();
	new SearchByKeyword({ orderby:'', type : '' });
	
// ----------- disabled if not required --------------------
	
	var IsBenefiecery = Ext.Cmp("IsBenefiecery").getValue();
	if( IsBenefiecery == 0 ){
		$('.benefdis').each(function(){
			console.log($(this));	
			$(this).attr("disabled", true);
		});	
	}
	
 });

// -------------------------------------------------------------
/* 
 * @ Method 		resize on window selected by user 
 */
 
$(window).bind('resize', function(){
	$('#result_content_add').css ({  'margin' 	: '10px 10px 20px 10px','float' : 'center' });
	$('#product-footer-button').css({'margin-top':'-10px', 'margin-left': '10px' }); 
	$(".box-content-data").css ({ }); 	
 });	

 

// -------------------------------------------------------------
/* 
 * @ Method 		--- < comment on here > --- 
 */
 
 $(window).bind('beforeunload', function(e) 
{ 
	new EnableWindowParent();
	try {
		window.opener.Ext.DOM.initFunc.validParam = Ext.DOM.init.ValidPrefix;
	} catch( e ){
		console.log(e);
	}
});

// ======================== END CLASS JS ========================== 