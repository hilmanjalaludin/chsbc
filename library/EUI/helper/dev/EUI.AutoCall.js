// ------------------------------------------------------------------
/* 
 * @ pack .................... : Stream AutoCall for interface of work 
 * @ auth .................... : omens	
 * @ version ................. : v.0.1 
 */
window.Stream = {
	Buffer 	: {}, List 		: {},
	Role	: {}, Value		: '',
	Id		: 0,  Index 	: [],
	callID	: 0,  callValue : ''
};


// call CallDisposition attribute untuk memastikan jika user 
// menekan tombol next harus di cek apakah process penelponan 
// ke nomer tertentu sudah selesai atau masih berlanjut.

window.Stream.CallDisposition = 0;

// --- autocal process class of object   
// --- Utils  prototype on Ext Stream data   
 
window.atCall = function(){
	return new Ext.AutoCall('', {});
}


 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
;(function ( fn ){
	fn.prototype.AutoCall = function( Role, Settings )  {
	console.log("Role");console.log(Role);
	console.log("Settings"); console.log(Settings); //Controller SrcCustmerList

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
		if( typeof( Role ) == 'object' ){
			window.Stream.Role = Role;
		}
		
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
	var protectedUrl = Ext.EventUrl( new Array( window.Stream.Role.Event, 'Order') );
		
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */		
		this.Utils =  {
			Init : function() {
				window.Stream.List  = new Ext.Ajax
				({
					url 	: protectedUrl.Apply(),
					method  : 'POST',
					param  	: Ext.Join( new Array( Settings.param ) ).object(),
					success : function( xhr ){
						Ext.Util( xhr ).proc(function( data ){
							// reset if user select Init data start dial back to 
							// new data first .
							window.Stream.Id = 0;
							console.log( window.sprintf("row data automatic call success\n"));	
						});
					}					
				});
				
				// --- push to global object window  
				
				var lists = window.Stream.List.json();
				if( typeof( lists ) == 'object' && lists.data.length > 0 ){
					window.Stream.Buffer = lists.data;
					window.Stream.Index = Object.keys( window.Stream.Buffer );
				}
				// jika user melakuan star dengan data kosong.
				else {
					window.Stream.Buffer = {};	
					window.Stream.Index = []
				}
			},
			
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
	
			FirstNum : function( CustomerId, Caller ){
				var protectedData = window.Stream.Buffer[window.Stream.Id];
				if( typeof(protectedData) =='undefined'){
					return false;
				}
				if( !Caller ){
					window.Stream.callID = 0;
					window.Stream.callDisposition = 1;
				}
				window.Stream.callValue = protectedData.CallPersentation[window.Stream.callID];
				return window.Stream.callValue;
			},
			
/**
  * [FirstId description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

  
			FirstId : function(){
				var protectedData = window.Stream.Buffer[window.Stream.Id];
				console.log( "protectedData" );
				console.log( protectedData );
				if( typeof(protectedData) =='undefined'){
					return false;
				}
				console.log( window.sprintf("protectedData.CustomerId : %s\n", protectedData.CustomerId ));
				if( protectedData.CustomerId ){
					window.Stream.Value = protectedData.CustomerId;
					return window.Stream.Value;
				}
				return 0;
			},
/**
  * [ NextNum Next No Telpon dari No telpon yang sedang
		 * 				di followup pada customer ID Terpilih ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
		
			NextNum : function( CustomerId, Caller ){
				var protectedData = window.Stream.Buffer[window.Stream.Id];
				var protectedCall = protectedData.CallPersentation;
				
				for( var i in protectedCall ){
					var localStr = protectedCall[i];
					if( localStr.localeCompare(Caller) == 0 ){						
						window.Stream.callID = parseInt(i)+1;
						window.Stream.callDisposition+=1;
					}
				}
				
				if( typeof( protectedData.CallPersentation[window.Stream.callID] ) == 'undefined' ){
					//console.log('this last number caller Number');
					window.Stream.callID = 0;
					window.Stream.callDisposition = 0;
					return false;
				}
				//set untuk process number berikutnya .
				window.Stream.callValue = protectedCall[window.Stream.callID];
				return window.Stream.callValue;
				
			},
			
/**
  * [ NextNum : Next No Telpon dari No telpon yang sedang di followup pada customer ID Terpilih ]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */	
			Next : function( value ){
				
				var protectedDataCurrent = window.Stream.Buffer[window.Stream.Id];
				if( protectedDataCurrent.CustomerId == value ){
					window.Stream.Id = parseInt(window.Stream.Id+1);	
				}
				
				// try save to loger buffer browser .
				console.log(window.sprintf("Current CustomerId ID :%s", window.Stream.Value));
				if( typeof( window.Stream.Buffer[window.Stream.Id] ) == 'undefined' ){	
					
					if( !Ext.Msg("End of record (s). Are you want to back first index ?").Confirm()  ){
						return false;
					}
					
					// overider this my class && 
					// jika user menyetujui kembali ke index pertama 
					
					var AutoCall = window.atCall();
						window.Stream.Id = 0;
						window.Stream.Value = AutoCall.Utils.FirstId();
				} 
				else{
					var protectedDataID = window.Stream.Buffer[window.Stream.Id];
					window.Stream.Value = protectedDataID.CustomerId;	
				} 	
				
				// try save to loger buffer browser .
				console.log(window.sprintf("Next CustomerId ID :%s", window.Stream.Value));
				
				return {
					Value : function(){
						return window.Stream.Value;	
					},
					Triger  : function(){
						return window.Stream.Role.Event;
					}	
				}
			}
		};
		
	   return ( typeof( this ) == 'object' ? this : {} );
	}
})( E_ui );