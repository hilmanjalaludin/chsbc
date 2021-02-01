<?php  echo javascript(); ?>
<script>


// exit button 

Ext.Cmp("ExitButton").listener({
	onClick : function(e){
		if(Ext.Msg("Do you want to exit?").Confirm() )
		{
			Ext.EQuery.Ajax
			({
				url : Ext.Cmp("ControllId").getValue(),
				method : 'GET',
				param :{
					time : Ext.Date().getDuration()
				}
			});
		}
	}
});	

// update button 
Ext.Cmp("UpdateButton").listener({
	onClick : function(e){
		if(Ext.Msg("Do you want to Update?").Confirm())
		{
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX+"/MgtDetailData/Update/",
				method 	: 'GET',
				param 	: Ext.Join([Ext.Serialize('Customers').getElement()]).object(),
				ERROR 	: function(e){
					Ext.Util(e).proc(function(update){
						if(update.success ){
							Ext.Msg("Update Customer ").Success();
							return false;
						}
						else{
							Ext.Msg("Update Customer ").Failed();
							return false;
						}
					});
				}
			}).post();
		}
	}
});
 
</script>
<fieldset class="corner">
 <legend class="icon-customers">&nbsp;&nbsp;Customer Detail  </legend>
 <div class="contact"> 
 <?php echo form()->hidden('ControllId',null,$this->URI->_get_post('ControllId'));?>
 <table width="100%" border=0>
	<tr>
		<td valign="top">
			<?php $this -> load -> view('mgt_customer_detail/view_top_content'); ?>
		</td>
	</tr>
 </table>
</div>
</fieldset>