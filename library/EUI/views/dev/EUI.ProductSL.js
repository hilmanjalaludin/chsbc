 
/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
  
var getCallPremi = function( e ){
	
	if( Ext.Cmp('ProductId').empty()){ 
		Ext.Msg('Product ID is empty ').Error();}
	else if( Ext.Cmp('InsuredPlanType').empty() ){
		Ext.Msg('Plan Type is empty ').Error();}
	else if( Ext.Cmp('InsuredPayMode').empty() ){
		Ext.Msg('Paymode is empty ').Error();}
	else if( Ext.Cmp('InsuredDOB').empty() ){
		Ext.Msg('DOB is empty ').Error();}
	else
	{	
		Ext.Ajax({
			url 	: window.opener.Ext.DOM.INDEX+"/ProductForm/Premi/",
			method 	:'GET',
			param 	: { 
				ProductId 	: Ext.Cmp('ProductId').getValue(),
				GroupPremi 	: Ext.Cmp('InsuredGroupPremi').getValue(),
				PlanType 	: Ext.Cmp('InsuredPlanType').getValue(), 
				PaymentMode : Ext.Cmp('InsuredPayMode').getValue(),
				date		: Ext.Cmp('InsuredDOB').getValue()
			},
			ERROR :function(e){
				Ext.Util(e).proc(function(JSON){
					Ext.Cmp('InsuredPremi').setValue(JSON.premi)
				});
			}
		}).post();
	}	
}



/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
Ext.document().ready(function(){

/* view css */
$('#tabs').tabs();

 Ext.Css('result_content_add').style
 ({
	'width' : Ext.Layout(window).ResizeWidth(),
	'height' : Ext.Layout(window).ResizeHeight(),
	'overflow' : 'auto',
	'float' : 'center'
 });
	
/* listener */
	
 Ext.Cmp('ProductId').listener
 ({
	'onChange' : function(e){
		Ext.Util(e).proc(function(obj){ 
			Ext.Ajax({
				url : window.opener.Ext.DOM.INDEX+"/ProductForm/Plan/",
				method : 'GET',
				param : {
					ProductId  : Ext.Cmp(obj.id).Encrypt(),
					CustomerId : Ext.Cmp('CustomerId').Encrypt()
				}
			}).load('plan_type');
		});
	}
 });
	
 // get group premi setup 
 Ext.Cmp('InsuredGroupPremi').listener
 ({
		'onChange' : function(e){
			Ext.Util(e).proc(function(obj){
				if( obj.value==2 ){
					Ext.Cmp('InsuredIdentificationTypeId').setValue(Ext.Cmp('PayerIdentificationTypeId').getValue());
					Ext.Cmp('InsuredIdentificationNum').setValue(Ext.Cmp('PayerIdentificationNum').getValue());
					Ext.Cmp('InsuredGenderId').setValue(Ext.Cmp('PayerGenderId').getValue());
					Ext.Cmp('InsuredSalutationId').setValue(Ext.Cmp('PayerSalutationId').getValue());
					Ext.Cmp('InsuredFirstName').setValue(Ext.Cmp('PayerFirstName').getValue());
					Ext.Cmp('InsuredLastName').setValue(Ext.Cmp('PayerLastName').getValue());
					Ext.Cmp('InsuredDOB').setValue(Ext.Cmp('PayerDOB').getValue());
					Ext.Cmp('InsuredDOB').setFocus();
					Ext.Cmp('InsuredRelationshipTypeId').setValue(1);
				}
				else{
					Ext.Cmp('InsuredIdentificationTypeId').setValue('');
					Ext.Cmp('InsuredIdentificationNum').setValue('');
					Ext.Cmp('InsuredGenderId').setValue('');
					Ext.Cmp('InsuredSalutationId').setValue('');
					Ext.Cmp('InsuredFirstName').setValue('');
					Ext.Cmp('InsuredLastName').setValue('');
					Ext.Cmp('InsuredDOB').setValue('');
					Ext.Cmp('InsuredRelationshipTypeId').setValue('');
				}	
			});
		}
	});

 // get premi by plan 	
 
 Ext.Cmp("InsuredPlanType").listener({
	onClick: function(e){
		Ext.DOM.getCallPremi(e.target);
	}
 })
 
 /* buttonExit */
	
  Ext.Cmp('buttonExit').listener({
	'onClick':function(e){
		if( Ext.Msg('Do you wan to close from this session?').Confirm()){
				window.close(this);	
		}
	}
 });
	
 /* buttonExit */
 
	Ext.Cmp('buttonSave').listener({
		'onClick':function(e){
			if( Ext.Msg('Do you wan to save data entry?').Confirm()){
				Ext.Ajax
				({
					url 	: window.opener.Ext.DOM.INDEX+"/ProductForm/Save/",
					method  : 'GET',
					param   : Ext.Join([
								Ext.Serialize("frmDataProduct").getElement(),
								Ext.Serialize("frmDataPayers").getElement(),
								Ext.Serialize("frmInsured").getElement()
							  ]).object(),
							  
					ERROR   : function(fn)
					{
						Ext.Util(fn).proc(function(error)
						{
							Ext.Msg(error.PolicyId +" ---> "+ error.PolicyNumber ).Info();
							if( error.succes ){
								
								Ext.Msg("Save Insured").Success();
							}
							else{
								Ext.Msg("Save Insured ").Failed();
							}
						});
					}
					
				}).post();
			}
		}
	});
	
	// date class attribute data 
	
	$('.date').datepicker({
		dateFormat	: 'dd-mm-yy', yearRange: "1945:2030",
		changeYear	: true, changeMonth	: true,
		onSelect	: function(date){
			if(typeof(date) =='string'){
				if( $(this).attr('id')=='InsuredDOB'){
					Ext.Ajax ({
						url 	: window.opener.Ext.DOM.INDEX+"/ProductForm/DOB/",
						method 	:'GET',
						param 	: { date : date },
						ERROR 	: function(fn){
							Ext.Util(fn).proc(function(data){
								Ext.Cmp('InsuredAge').setAttribute('value',data.age);
								Ext.Cmp('InsuredAge').setAttribute('disabled',1);
							});
						}
					}).post();
				}
			}	
		}
		
	}); 
	
	
});

	
	// get all date by call jquery
	

/*
 * @ def 	: set css on resize document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
Ext.document().resize(function(){
	Ext.Css('result_content_add').style({
		'width' : Ext.Layout(window).ResizeWidth(),
		'height' : Ext.Layout(window).ResizeHeight(),
		'overflow' : 'auto',
		'float' : 'center'
	});
});