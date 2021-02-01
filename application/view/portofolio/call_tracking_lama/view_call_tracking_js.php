<script>
	
	// $('.date').datepicker({showOn: 'button',  changeYear:true, 
		// changeMonth:true, buttonImage: Ext.Image('calendar.gif'),  
		// buttonImageOnly: true,  dateFormat:'dd-mm-yy',readonly:true
	// });
	
	$('.date').datepicker();
	
	Ext.DOM.DoSomething=function()
	{
		if(Ext.Cmp('group_type').getValue() == 2) {
			Ext.Cmp('TmrId').disabled(true);
		} else if(Ext.Cmp('group_type').getValue() == 1) {
			Ext.Cmp('TmrId').disabled(false);
		} else {
			Ext.Cmp('TmrId').disabled(false);
		}
		
		Ext.Ajax
		(
			{
				url		: Ext.DOM.INDEX +'/CallTracking/Load1/',
				param	:  {
					group_type : Ext.Cmp('group_type').getValue()
				}
			}
		).load('ui-widget-content-row3');
	}
	
	Ext.DOM.LoadRecsource=function()
	{
		Ext.Ajax
		(
			{
				url		: Ext.DOM.INDEX +'/CallTracking/LoadRecsource/',
				param	:  {
					group_type : Ext.Cmp('group_type').getValue(),
					Campaign : Ext.Cmp('Campaign').getValue()
				}
			}
		).load('ui-widget-content-row1');
	}
	
	Ext.DOM.LoadTMO=function()
	{
		var group_type = Ext.Cmp('group_type').getValue();
		var spvId = Ext.Cmp('spvId').getValue();
		
		if(group_type == 1) {
			Ext.Cmp('TmrId').disabled(false);
		} else if(group_type == 2) {
			Ext.Cmp('TmrId').disabled(true);
		} else {
			Ext.Cmp('TmrId').disabled(false);
		}
		Ext.Ajax
		(
			{
				url		: Ext.DOM.INDEX +'/CallTracking/LoadTMO/',
				param	:  {
					group_type : Ext.Cmp('group_type').getValue(),
					Recsource : Ext.Cmp('Recsource').getValue(),
					spvId : Ext.Cmp('spvId').getValue()
				}
			}
		).load('ui-widget-content-row4');
	}
	
	Ext.DOM.DoSomething2=function()
	{
		if(Ext.Cmp('mode').getValue() == 1) {
			Ext.Cmp('start_date').disabled(true);
			Ext.Cmp('end_date').disabled(true);
		} else if(Ext.Cmp('mode').getValue() == 2) {
			Ext.Cmp('start_date').disabled(false);
			Ext.Cmp('end_date').disabled(false);
		} else {
			Ext.Cmp('start_date').disabled(false);
			Ext.Cmp('end_date').disabled(false);
		}
	}
	
	Ext.DOM.ShowReport=function()
	{
		var group_type	= Ext.Cmp('group_type').getValue();
		var Campaign	= Ext.Cmp('Campaign').getValue();
		var Recsource	= Ext.Cmp('Recsource').getValue();
		var spvId		= Ext.Cmp('spvId').getValue();
		var TmrId		= Ext.Cmp('TmrId').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		var mode		= Ext.Cmp('mode').getValue();
		
		
		// if(group_type == '')
		// {
			// alert('Choose Group Type, Please!');
		// } else if(group_type == 1) {
			// if(Recsource == '') {
				// alert('Choose Recsource, Please!');
			// } else if(spvId == '') {
				// alert('Choose Supervisor, Please!');
			// } else if(TmrId == '') {
				// alert('Choose TMR, Please!');
			// } else if(mode == '') {
				// alert('Choose Mode, Please!');
			// } else if(mode == 2 && start_date == '' && end_date =='') {
				// alert('Choose Interval, Please!');
			// }
		// } else if(group_type == 2) {
			// if(Recsource == '') {
				// alert('Choose Recsource, Please!');
			// } else if(spvId == '') {
				// alert('Choose Supervisor, Please!');
			// } else if(mode == '') {
				// alert('Choose Mode, Please!');
			// } else if(mode == 2 && start_date == '' && end_date =='') {
				// alert('Choose Interval, Please!');
			// }
		// } else {
			Ext.Window
			(
				{
					url 	: Ext.DOM.INDEX +'/CallTracking/ShowReport/',
					param	: 	{
									group_type : group_type,
									Campaign : Campaign,
									Recsource : Recsource,
									spvId : spvId,
									TmrId : TmrId,
									start_date : start_date,
									end_date : end_date,
									mode : mode
								}
				}
			).newtab();
		// }
	}
	
	
	Ext.DOM.ShowExcel=function()
	{
		var group_type	= Ext.Cmp('group_type').getValue();
		var Campaign	= Ext.Cmp('Campaign').getValue();
		var Recsource	= Ext.Cmp('Recsource').getValue();
		var spvId		= Ext.Cmp('spvId').getValue();
		var TmrId		= Ext.Cmp('TmrId').getValue();
		var start_date	= Ext.Cmp('start_date').getValue();
		var end_date	= Ext.Cmp('end_date').getValue();
		var mode		= Ext.Cmp('mode').getValue();
		
		
		// if(group_type == '')
		// {
			// alert('Choose Group Type, Please!');
		// } else if(group_type == 1) {
			// if(Recsource == '') {
				// alert('Choose Recsource, Please!');
			// } else if(spvId == '') {
				// alert('Choose Supervisor, Please!');
			// } else if(TmrId == '') {
				// alert('Choose TMR, Please!');
			// } else if(mode == '') {
				// alert('Choose Mode, Please!');
			// } else if(mode == 2 && start_date == '' && end_date =='') {
				// alert('Choose Interval, Please!');
			// }
		// } else if(group_type == 2) {
			// if(Recsource == '') {
				// alert('Choose Recsource, Please!');
			// } else if(spvId == '') {
				// alert('Choose Supervisor, Please!');
			// } else if(mode == '') {
				// alert('Choose Mode, Please!');
			// } else if(mode == 2 && start_date == '' && end_date =='') {
				// alert('Choose Interval, Please!');
			// }
		// } else {
			Ext.Window
			(
				{
					url 	: Ext.DOM.INDEX +'/CallTracking/ShowExcel/',
					param	: 	{
									group_type : group_type,
									Campaign : Campaign,
									Recsource : Recsource,
									spvId : spvId,
									TmrId : TmrId,
									start_date : start_date,
									end_date : end_date,
									mode : mode
								}
				}
			).newtab();
		// }
	}
</script>