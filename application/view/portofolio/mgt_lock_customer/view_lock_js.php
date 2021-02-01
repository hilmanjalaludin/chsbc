<script>

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.ready
 *
 * @ params	 : method on ready pages
 * @ package : bucket datas
 */

 Ext.DOM.Testing = function()
 {
	 Ext.DOM.getParamInput();
 }

 Ext.DOM.getParamInput = function()
 {
    $("#key_rec").hide();

    if( Ext.Cmp('cmb_lock_type').getValue() == "1" ) {
      $("#key_rec").show();
    }

    if( Ext.Cmp('cmb_lock_type').getValue() == "3" ) {
        $("#key_rec").show();
    }

  	Ext.Ajax ({
      url	  : Ext.DOM.INDEX +'/MgtLockCustomer/getParamForm/',
      param : {
          time : Ext.Date().getDuration(),
          lock_type : Ext.Cmp('cmb_lock_type').getValue(),
  	      user_id : Ext.Cmp('lock_user_list').getValue()
      }
    }).load("loaded_param");
 };

 // ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.ready
 *
 * @ params	 : method on ready pages
 * @ package : lock datas
 */
 Ext.DOM.SetLock = function()
 {
    var formSetupLock = Ext.Serialize("formSetupLock");

	// if( !formSetupLock.Complete() )	{
	// 	Ext.Msg('Navigasi Setup Not Complete !').Info();
	// 	return false;
	//  }
	// --------- set lock customer ---->
    Ext.Ajax
   ({
        url 	: Ext.EventUrl(['MgtLockCustomer', 'LockNow']).Apply(),
        method : 'POST',
        param 	: formSetupLock.getElement(),
        ERROR 	: function( e )
        {
            Ext.Util( e ).proc(function( response )
            {
                if(  response.success )
                {
                       Ext.Msg("Lock Data ").Success();
                       Ext.DOM.ViewLockData ({orderby : '',type: '', page: 0});

                } else {
                        Ext.Msg("Lock Data ").Failed();
                }
            });
        }
    }).post();
 };

 // ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.ready
 *
 * @ params	 : method on ready pages
 * @ package : bucket datas
 */
 Ext.DOM.ReleaseLock = function()
 {
    var LockGrid = new Array();

    if(Ext.Cmp('LockId').empty())
    {
        alert("Please Select From List Setup Lock");
        return false;
    }
    LockGrid['LockId'] = Ext.Cmp('LockId').getValue();
     // --------- unlock customer ---->
    Ext.Ajax
   ({
        url 	: Ext.EventUrl(['MgtLockCustomer', 'UnlockNow']).Apply(),
        method : 'POST',
        param 	: LockGrid,
        ERROR 	: function( e )
        {
            Ext.Util( e ).proc(function( response )
            {
                if(  response.success )
                {
                       Ext.Msg("Unlock Data ").Success();
                       Ext.DOM.ViewLockData ({orderby : '',type: '', page: 0});

                } else {
                        Ext.Msg("Unlock Data ").Failed();
                }
            });
        }
    }).post();
 };
 // ---------------------------------------------------------------------------------------------------------------
/*
 * @ package	 	view data on lock
 *
 */

 Ext.DOM.ViewLockData = function( obj )
{
    $('#ui-widget-lock-list').Spiner
    ({
        url 	: new Array('MgtLockCustomer','PageLockFilter'),
        param 	: {},
        order   : {
                order_type : obj.type,
                order_by   : obj.orderby,
                order_page : obj.page
        }
    });
};

Ext.DOM.load_Recsource_pull_src = function(obj){
    Ext.Ajax ({
      url   : Ext.DOM.INDEX +'/MgtLockCustomer/getParamForm/',
      param : {
        time : Ext.Date().getDuration(),
        lock_type : Ext.Cmp('cmb_lock_type').getValue(),
        user_id : Ext.Cmp('lock_user_list').getValue(),
        filter_by : Ext.Cmp('src_customerspv_keyword').getValue()
      }
    }).load("loaded_param");
};

$(document).ready( function()
{
  $('#ui-widget-user-lock').mytab().tabs();
  $('#ui-widget-user-lock').mytab().tabs("option", "selected", 0);
  $('#ui-widget-user-lock').css({'background-color':'#FFFFFF'});
  $("#ui-widget-user-lock").mytab().close(function(){
	  Ext.DOM.RoleBack();
  }, true);

  $('#ui-widget-lock-set').css({'background-color':'#FFFFFF'});
  $('.xselect').chosen();
  $('.date').datepicker({showOn: 'button',  changeYear:true,
		changeMonth:true, buttonImage: Ext.Image('calendar.gif'),
		buttonImageOnly: true,  dateFormat:'dd-mm-yy',readonly:true
  });
  Ext.DOM.ViewLockData ({orderby : '',type: '', page: 0});
  $("#key_rec").hide();
});


</script>