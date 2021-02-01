(function(Cores){
 Cores.prototype.ViewPort = function( CTI_doc ){
	var contact = {
		ctiParam  : {},
		ctiMax	  : 13, 	
		ctiApplet : null,
		setApplet : function(){
			try {
				if( typeof(CTI_doc)=='object'){
					ExtApplet.ctiApplet = CTI_doc;	
				}
			}
			catch(e){
				Ext.Error({log : e , name : 'setApplet'});
			}
		},
		
		getApplet : function(){
			if( ExtApplet.ctiApplet !=null ){
				return ExtApplet.ctiApplet; 
			}
		},
		
		getValidate : function( phone ){
			if( phone.length > ExtApplet.ctiMax ){
				return false;	
			} else {
				return true;
			}	
		},
		
		setData : function(param){
			if( typeof(param)=='object')
			{
				ExtApplet.ctiParam = param; 
				
				var applet = ExtApplet.getApplet(), event_call = {
					Call : function() {
						try {
							if( ExtApplet.getValidate(param.Phone) ) {
								applet.callDialCustomer('', 
									( param.Phone ? param.Phone :'' ), 
									( param.CustomerId ? param.CustomerId :'' ), 
									( param.CustomerId ? param.CustomerId :''));
								return;
							} else {
								console.log('to long phone to dial');
								return;
							}	
						}
						catch( appletErr ){
							console.log(appletErr);
							Ext.Msg( appletErr ).Error();
						}
					}
				}
			}
			return event_call;
		},
		
		setHangup : function(){
			if( typeof( ExtApplet.getApplet() ) =='object' ){
				ExtApplet.getApplet().callHangup();
				document.ctiapplet.callHangup();
				return false;
			}
		},
		
		getCtiParam : function(){
			if( typeof(ExtApplet.ctiParam) =='object'){
				return ExtApplet.ctiParam;
			}
		},
		
		getPhoneNumber : function(){
			if( typeof(ExtApplet.ctiParam) =='object'){
				return ExtApplet.ctiParam.Phone;
			}
		},
		
		getCustomerId : function(){
			if( typeof(ExtApplet.ctiParam) =='object'){
				return ExtApplet.ctiParam.CustomerId;
			}
			else
				return false;
		},
		
		getCallerId : function(){
			if( typeof(ExtApplet.getApplet()) =='object' ){
				return document.ctiapplet.getCallerId();
			}
			else
				return false;
		},
		
		getDirection: function(){
			try  {
				if( typeof(ExtApplet.getApplet()) =='object' ){
					return document.ctiapplet.getCallDirection()
				}
				else {
					return false;
				}
			} catch( appletErr ) {
				console.log(appletErr);
				return false;
			}	
		},
		
		getCallSessionId : function(){
			
			try {
				if( typeof(ExtApplet.getApplet()) =='object' ){
					return document.ctiapplet.getCallSessionKey();
				}
				else{
					return 0;
				}
			} catch( appletErr ){
				console.log(appletErr);
				return false;
			}
		},
		
		getIvrData : function(){
			if( typeof(ExtApplet.getApplet()) =='object' ){
				document.ctiapplet.getCallerId();
			}
			else
				return false;
		}
	}
	
	return contact;
 }
})(E_ui); 