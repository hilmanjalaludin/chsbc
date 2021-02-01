<?php
/*
 * @ def 	: User Javascript 
 * -----------------------------------
 * @ param 	: layout section
 * @ aksess : public
 * @ author	: razaki team
 */
?>

<script type="text/javascript">
 Ext.DOM.USER_LEVEL_ADMIN 	= 1; 
 Ext.DOM.USER_LEVEL_MANAGER = 2;
 Ext.DOM.USER_LEVEL_SPV 	= 3;
 Ext.DOM.USER_LEVEL_AGENT 	= 4;
 Ext.DOM.USER_LEVEL_INBOUND = 6;
 Ext.DOM.USER_LEVEL_QUALITY = 5;
 Ext.DOM.USER_SYSTEM_LEVEL 	= 8;

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 Ext.Session().getStore();
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 Ext.DOM.INDEX = Ext.System.view_page_index();
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 Ext.DOM.URL = Ext.System.view_app_url(); 
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.DOM.LIBRARY = Ext.System.view_library_url();

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */

Ext.DOM.SYSTEM = Ext.System.view_sytem_url();

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.DOM.V_STATUS_STORE = ( function(){
	return ( 
		Ext.Ajax({
			url		: Ext.DOM.INDEX +'/Callreason/store',
			method 	: 'POST',
			param 	: {
				action :'aux_reason'
			}
		}).json()
	)
})();

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 CTI.init( Ext.Session('HandlingType').getSession(), Ext.Session('HandlingType').getSession() )

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 Ext.DOM.onload = function(){
	CTI.prepareCTIClient();
	CTI.disableAllButton();
 };

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
 Ext.DOM.onUnload =  function(){
	 CTI.prepareDisconnect(); //document.ctiapplet.ctiDisconnect();
 };
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.DOM.ActionModified = function(node){
 if(node.click) {
			
	// logout case 
	if(node.id=='Logout'){
		$.messager.confirm('Confirm','Are you sure you want to exit from this session ?', function(r) {
			if(r){
				document.location= Ext.DOM.INDEX+'/Auth/logout/?login=(false)';
			}
		});
	}
	else if(node.id=='Password') {
		Ext.Cmp('pass').setAttribute('style',"display:yes;");
		Ext.query('#pass').dialog ({
			title	: 'Change Password',
			width	: 350,
			height	: 200,
			closed	: false,
			cache	: false,
			modal	: true,
			buttons	: [{
				text	:'Update',
				iconCls	:'icon-save',
				handler	:function() 
				{
					Ext.Ajax({
						url 	: Ext.DOM.INDEX+'/Auth/UpdatePassword/',
						method 	:'POST',
						param 	: {
							curr_password   : Ext.Cmp('curr_password').getValue(),
							new_password    : Ext.Cmp('new_password').getValue(),
							re_new_password : Ext.Cmp('re_new_password').getValue()
						},
						ERROR : function( e ){
							Ext.Util(e).proc(function(response){
								if( response.success ){
									alert("Success, Update Yours Password");
									Ext.query('#pass').dialog('close');
								}
								else{
									alert("Failed, Update Yours Password");
								}
							});
						}
					}).post()
				}
			},{
				text	: 'Cancel',
				iconCls : 'icon-cancel',
				handler	: function(){
					Ext.query('#pass').dialog('close');
					}
				}]
		}).dialog("open");
	}
	else
	{
		Ext.query('.easyui-tabs').tabs('update', {
			tab 	 : Ext.query('.easyui-tabs').tabs('getSelected'),
			closable : false,
			options	 : { title: node.text }
		});
		
		Ext.ShowMenu(node.id, node.text); 
	}
		
 }};
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.ActiveMenu().setup([
	{id:'cust_closing', name:'src_customer_closing_nav.php'},
	{id:'app_menu', name:'src_appoinment_nav.php',},
	{id:'src_menu',name:'src_customer_nav.php'}
]);

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.DOM.WindowLayout = function(){

 Ext.Css("manu-panel").style({ 
	height: (Ext.query(window).height()-200)
 });
 
 Ext.Css("headers").style({
	"vertical-align" : "middle",
	"text-align" : "center",
	"font-size"	: "12px",
	"color" : "red",
	"background-color":"#dbecfb",
	"height" :"35px"
 });
 
 Ext.Css("main_content").style({
	'padding-top' : '10px',
	'padding-left': '5px', 
	'height ': ( Ext.query(window).height()-(Ext.query("#headers").height()+Ext.query("#footerPanel").height()+65)) 
 });
}

/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
Ext.document(document).resize(function(){
 Ext.DOM.WindowLayout();
});
 
/* 
 * @ def : window dialog action logout/ change password   
 * -------------------------------------------------------
 * 
 * @ param : easy UI functionality 
 * @ author : razakiteam 
 */
 
Ext.document(document).ready(function(){
ExtApplet = new Ext.ViewPort(document.ctiapplet);
ExtApplet.setApplet();

 Ext.DOM.WindowLayout();

 Ext.query('#toolbars-foot').extToolbars({
	 extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
	 extTitle  : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Title(),
	 extMenu   : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Menu(),
	 extIcon   : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Icon(),
	 extText   : true,
	 extInput  : true,
	 extOption : Ext.ActiveBars(Ext.Session('HandlingType').getSession()).Option()
 });
 
 Ext.Cmp("auxReason").setAttribute('class',"input_text");
 Ext.Cmp("auxReason").setAttribute('style',"border:1px solid #7ea3c6;");
 
 
});
</script>
</head>