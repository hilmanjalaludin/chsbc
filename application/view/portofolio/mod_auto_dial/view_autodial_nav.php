<?php echo javascript(); ?>
<script type="text/javascript">
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
	$('.select-chosen').chosen();
})(); 

/* Ext.DOM.SetFollowUp = function( CustomerId )
{
	var data = Ext.Ajax
	({
		url 	: Ext.EventUrl(['SrcCustomerList','SetFollowup']).Apply(),
		method  : 'POST',
		param	: {
			CustomerId : CustomerId
		}	
	}).json();
	
	return ( typeof ( data ) == 'object' ? data : {});
} */

Ext.DOM.startCall = function(){
	var recs = Ext.Cmp('auto_recsource').getValue();
	
	if(recs!='')
	{
		var CustomerId = 0;
		
		Ext.Cmp('contact-detail').setText('<span style="padding:5px;color:red;font-weight:bold;"><img src="'+Ext.DOM.LIBRARY+'/gambar/loading.gif" alt="Loading" style="padding:5px;"/> LOADING...</span>');
		
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/CallAutoDial/get_customer_id/',
			method 	: 'POST',
			param 	: {
				recsource : recs
			},
			ERROR  	: function(fn){
				Ext.Util(fn).proc(function(save){
					if( save.success ) {
						CustomerId = save.cust_id;
						Ext.ActiveMenu().NotActive();
						$('#contact-detail').load( Ext.EventUrl(["CallAutoDial","start_dial"]).Apply(), {
							CustomerId : CustomerId,
							PhoneType : 1
						}, function( response, status, xhr ) {
							if( status == 'error') { 
								$('#contact-detail').html(response);	 
							}else{
								Ext.Cmp('auto_recsource').disabled(true);
								Ext.Css('ButtonStartDial').style({
									'pointer-events' : 'none',
									'cursor' : 'default',
								});
							}
						});
					}
					else{
						alert('There\'s no data to be follow up!');
						Ext.Cmp('contact-detail').setText('');
						return false;
					}
				});
			}
		}).post();
	}
	else{
		alert('Please, choose recsource!');
	}
}
</script>
<fieldset class="corner">
	<?php echo form()->legend(lang(""), "fa-phone"); ?>
	<div id="result_content_add" class="ui-widget-panel-form"> 
		<form name="FrmCustomerCall">
			<div class="ui-widget-form-table-compact">
				<div class="ui-widget-form-row baris-2">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell text_caption left"><?php echo form() -> combo('auto_recsource','select-chosen tolong',  $recsource);?></div>
					
					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption center">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption left"><?php echo form()->button("ButtonStartDial", "button icon-phone", lang('Start'), array('click' => 'Ext.DOM.startCall();'));?></div>
				</div>
				
			</div>
		</form>
	</div>
	<div id="contact-detail"></div>
</fieldset>	