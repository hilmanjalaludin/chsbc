<script>
	Ext.DOM.SaveTarget = function() {
		
		if(Ext.Cmp('listID').getValue() == '') {
			alert('Check your user, Please!');
		} else {
			Ext.Ajax ({
				url 	: Ext.DOM.INDEX+"/Target/SaveTarget/",
				method 	: 'POST',
				param 	: Ext.Join([
									Ext.Serialize("target").getReportElement()
								  ]).object(),
				ERROR : function(e) {
					Ext.Util(e).proc(function(target){
						if( target.success ) {
							Ext.Msg("Save Target").Success();
							Ext.Cmp('listID').getValue('');
						}
						else{ 
							Ext.Msg("Save Target").Failed(); 
						}
					});
				}
			}).post();
		}

	}
	
	Ext.DOM.Disable = function(obj,id)
	{
		if(obj.checked)
		{
			Ext.Cmp('PIFTarget_'+id).disabled(false);
			Ext.Cmp('ANPTarget_'+id).disabled(false);
		}
		else{
			Ext.Cmp('PIFTarget_'+id).disabled(true);
			Ext.Cmp('ANPTarget_'+id).disabled(true);
		}
	}
</script>