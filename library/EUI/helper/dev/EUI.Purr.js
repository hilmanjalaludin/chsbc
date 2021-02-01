/*
 * jquery.purr.js
 * Copyright (c) 2008 Net Perspective (net-perspective.com)
 * Licensed under the MIT License (http://www.opensource.org/licenses/mit-license.php)
 * 
 * @ author R.A. Ray
 * @ projectDescription	jQuery plugin for dynamically displaying unobtrusive messages in the browser. Mimics the behavior of the MacOS program "Growl."
 * @ version 0.1.0
 *  --------------------------------------------------------------------------------------------------------------------------------------------------------
 * @ requires jquery.js (tested with 1.2.6)
 * @ param fadeInSpeed 					int - Duration of fade in animation in miliseconds
 * @ param fadeOutSpeed  				int - Duration of fade out animationin miliseconds
 * @ param removeTimer  					int - Timeout, in miliseconds, before notice is removed once it is the top non-sticky notice in the list
 * @ param isSticky 						bool - Whether the notice should fade out on its own or wait to be manually closed
 *										default: false
 * @ param usingTransparentPNG 	bool - Whether or not the notice is using transparent .png images in its styling default: false
 * ----------------------------------------------------------------------------------------------------------------------------------------------------------
 * 
 * @ customize by 	: omens < razaki team deplovment >
 * @ email contact 	: jombi_par@yahooo.com
 */
 
//var INIT_GLOBAL_TIMER = 5000;
(function(b) {
    b.purr = function(a, c) {
        function e() {
            jQuery.browser.msie && c.usingTransparentPNG ? a.css({
                opacity: 0
            }).animate({
                height: "0px"
            }, {
                duration: c.fadeOutSpeed,
                complete: function() {
                    a.remove()
                }
            }) : a.animate({
                opacity: "0"
            }, {
                duration: c.fadeOutSpeed,
                complete: function() {
                    a.animate({
                        height: "0px"
                    }, {
                        duration: c.fadeOutSpeed,
                        complete: function() {
                            a.remove()
                        }
                    })
                }
            })
        }
        a = b(a);
        c.isSticky || a.addClass("not-sticky");
        var d = document.getElementById("purr-container");
        d || (d = '<div id="purr-container"></div>');
        d = b(d);
        1 == Ext.Cmp("notification").IsNull() && b(" <div />").attr("id", "notification").appendTo(b("body"));
        b("#notification").append(d);
        (function() {
            var f = document.createElement("a");
            b(f).attr({
                "class": "close",
                href: "#close",
                innerHTML: "Close"
            }).appendTo(a).click(function() {
                console.log(this);
                e();
                return !1
            });
            a.appendTo(d).hide();
            jQuery.browser.msie && c.usingTransparentPNG ? a.show() : a.fadeIn(c.fadeInSpeed);
            if (!c.isSticky) var g = setInterval(function() {
                0 == a.prevAll(".not-sticky").length && (clearInterval(g), setTimeout(function() {
                    e()
                }, c.removeTimer))
            }, 200);
            c.removeMe && e()
        })()
    };
    b.fn.purr = function(a) {
        a = a || {};
        a.fadeInSpeed = a.fadeInSpeed || 500;
        a.fadeOutSpeed = a.fadeOutSpeed || 500;
        a.removeTimer = a.removeTimer || 4E3;
        a.isSticky = a.isSticky || !1;
        a.usingTransparentPNG = a.usingTransparentPNG || !1;
        this.each(function() {
            new b.purr(this, a)
        });
        return this
    }
})(jQuery);

(function(b, a) {
    b.prototype.getPurr = function(b, e) {
        var d = {
            compile: function() {
                var select= Ext.Ajax
				({
                    url: e.read.url,
					method : 'GET',
                    param: {
                        time: Ext.Date().getDuration()
                    }
                }).json();
                0 < select.counter && "function" == typeof e.EVENT && this.html(select, e)
            },
            html: function(b, c) {
                a(document).ready(function() {
                    a('<div class="notice croper_' + b.PrimaryID + '" id="notice_' + b.PrimaryID + "_" + b.CustomerId + '"><div class="notice-body"><img src="' + Ext.DOM.LIBRARY + '/gambar/info.png" alt="" /><p><span>' + c.title + "</span></p><h3>" + ('<a href="javascript:void(0);" id="purr_' + b.PrimaryID + "_" + b.CustomerId + '">' + b.CustomerName + "</a>") + "</h3><p><span> Try Call : " + b.TryCallAgain + '</span></p></div><div class="notice-bottom"> </div></div>').purr({
                        usingTransparentPNG: !0,
                        isSticky: !0
                    });
                    Ext.Cmp("notice_" + b.PrimaryID + "_" + b.CustomerId).getElementId().addEventListener("click", c.EVENT, !1);
                    a.get(c.close.url, {
                        PrimaryID: b.PrimaryID
                    });
                    return !1
                })
            }
        };
        return "object" == typeof d ? d : null
    }
})(E_ui, $);

/* 
 * @ param  : EUI Lib JS Framework integration jquery  ALL Modul
 * @ param  : call reminder function get Notice 
 * @ param	: Global set Interval 

 
// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
 
var SetUpdateFollowup = function( CustomerId )
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
}


// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
 
 
 var DetailContact = function( CustomerId )
{
	if( CustomerId!='') 
	{	
		var response = SetUpdateFollowup(CustomerId);
		 if( response.success == 1) 
		 {
			Ext.ActiveMenu().NotActive();
			Ext.ShowMenu( new Array('SrcCustomerList','ContactDetail'), 
				Ext.System.view_file_name(), 
			{
				CustomerId : CustomerId,
				ControllerId : 'SrcCustomerList'
			}); 
		} else {
			Ext.Msg('Sorry, Data On Followup by other User ').Info();
		}	
	}
	else{ Ext.Msg("No Customers Selected !").Info(); }	
}

// --------------------------------------------------------------
/*
 * @ package 		detail go customer data 
 */
 if( typeof( window.SetTimerCallbackLater ) !='function')  {
 var SetTimerCallbackLater = function( timer ) {
	  window.setInterval(function() 
	 {	
		Ext.getPurr('container',  
		{
			title : '" You Have Call Back Later " :',
			read  : { url : Ext.DOM.INDEX +'/CallReminder/Appoinment/'},
			close : { url : Ext.DOM.INDEX +'/CallReminder/UpdateAppoinment/'},
			
			EVENT : function(e) 
			{
				 Ext.Util(e).proc(function( notice ) 
				{
					var notes = notice.id.split('_'), CustomerId = notes[2];
					if( Ext.Msg('Are you sure?').Confirm() ){
						$(new Array("#",new Array('notice',notes[1], notes[2]).join('_') ).join('')).remove();
						new DetailContact(CustomerId);	
					}	
				});
			}
		}).compile(); // STOP HERE ..
		
	 }, timer );
 }
}

/*
 * --------------------------------------------------------------------------------------------------------------------------------------------------------------|
 * THANK'S BEFORE , GOOD LUCK  **********************************************************************************************************************************|
 * --------------------------------------------------------------------------------------------------------------------------------------------------------------|
 */
 

