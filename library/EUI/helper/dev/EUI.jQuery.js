/*
 * E.U.I vesion 0.0.1
 *
 
 * @ packege 	helper 
 * @ def	    Controller pagging combine Jquery && EUI framework
 * @ author  	Razaki Team
 * @ link		http://www.razakitechnology.com/eui/js/eui_framework 
 */
 
Ext.EQuery = 
{
	TotalRecord		: 0,
	TotalPage		: 0,
	ShowRecord		: true,
	Navigate		: '',
	Content			: '',
	Fields			: {},
	Totals			: '',
	Main			: 'dta_contact_detail.php',
	
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 
 construct:function( p, v )
	{
		this.Navigate  = (p.custnav!=''?p.custnav:'')
		this.Content	 = (p.custlist!=''?p.custlist:'')
		this.Fields  	 = (v!=''?v:'')
	},
	
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 	
 postText:function()
 {
	console.log( this.Fields );
	
	var p ='';
	for( var i in this.Fields){
		p = p+'&'+i+'='+this.Fields[i]
	}
	
	p = p.substring(1,p.length);
	
	return p;
 },
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 	
  postContentList:function()
 {
		if( parseInt(Ext.EQuery.TotalPage) !=0 )
		{
			Ext.query(function()
			{
				Ext.query('#pager').aqPaging({
					current	: 1, 
					pages	: Ext.EQuery.TotalPage, 
					records	: (Ext.EQuery.TotalRecord==''?0:Ext.EQuery.TotalRecord),
					rec		: Ext.EQuery.ShowRecord,
					callfunc: Ext.EQuery,
					flip	: true, 
					cb		: function(p)  {
						Ext.EQuery.Fields.v_page = p;
						$('.ui-widget-load-pager').html("Loading ...");
						$('.ui-widget-load-pager').addClass("pager-loader");
						$('.content_table').load(Ext.EQuery.Content, Ext.EQuery.Fields, function( content, status, xhr ) {
							$('.ui-widget-load-pager').html('');
							$('.ui-widget-load-pager').removeClass("pager-loader");
						});
					} 
				});
			});	
		}
		else
		{
			$(function() {
				$('#pager').aqPaging
				({
					current	: 1, 
					pages	: 1, 
					records : Ext.EQuery.TotalRecord,
					flip	: true, 
					cb      : function(p) 
					{
						$('.ui-widget-load-pager').html("Loading ...");
						$('.ui-widget-load-pager').addClass("pager-loader");
						$('.content_table').load(Ext.EQuery.Content, Ext.EQuery.Fields, function( content, status, xhr ) {
							$('.ui-widget-load-pager').html(''); 
							$('.ui-widget-load-pager').removeClass("pager-loader");
						});
					} 
				});
			})	
		}
	},
	
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 
  pageContent:function( p ) {
	var p = p; $(function(){ 
		$('#pager').aqPaging.flip('aqPaging_1', p, this.TotalPage ); 
	});		
  },

/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 	
 postContent:function() {
	$('#main_content').load(this.Navigate, this.Fields, function(  response, status, xhr  ){
		if( status == 'error'){
			$('#main_content').html(response);
		}	
	});
},
	
	
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 	
 orderBy:function( field , order)
 {
	$.cookie('selected',0); 
	var order_type  = ( this.Fields.type!='' ?( this.Fields.type =='ASC' ? 'DESC' :'ASC' ) : 'ASC' ),
		order_byas  = ( typeof( field ) == 'undefined' ? '' : field );
		
	if( order_byas ) {
		Ext.EQuery.Fields.order_by = order_byas;
		Ext.EQuery.Fields.type = order_type;
	}
	Ext.EQuery.postContent();
},
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 	
 contactDetail:function(customerid,campaignid) 
 {
	try 
	{
		if( customerid.length >0  && campaignid.length >0 ) 
		{
			Ext.query('#main_content').load(this.Main+'?customerid='+customerid+'&campaignid='+campaignid);
			return;
		}
	}
	catch(e){
		alert(e);
	}
 },

/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
 
 verifiedContent:function(CustomerId, CampaignId, VerifiedStatus)
 {
		if( (CustomerId!='') && (CampaignId!='') ){
			Ext.query('#main_content').load(this.Main+'?customerid='+CustomerId+'&campaignid='+CampaignId+'&VerifiedStatus='+VerifiedStatus);
			return;
		}
		else{
			alert('No Customer ID. Please try again..!');
			return false;
		}
	},
/*
 * E.U.I
 *
 * @ method  : Ajax render to JQUERY FUCK 
 * @ def  	 : default content render class
 *
 */
 	
 Ajax : function( data )
 {
	if( typeof(data) =='object' )
	{
		Ext.query('#main_content').load( Ext.Ajax ({
			url 	: data.url,
			method 	: data.method,
			param 	: data.param
		})._ajaxSetup);
	}
 }
 
/*
 * E.U.I
 *
 * @ method  : construct
 * @ def  	 : default content render class
 *
 */
}