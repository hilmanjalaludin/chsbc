 /*
 * @ def : Ext.Applet --> Timer every User
 * -------------------------------------------
 *
 * @ param  : object data { } 
 * @ type   : helpers 
 * @ author : razaki team 
 * @ link 	: http://razakitechnology.com/siteraztech/product/web-application/eui-framework
 */
 
var IntervalTime = null;
(function(c, b) {
    c.prototype.Timer = function(c) {
        var a = {
            Active: function(a) {
                "undefined" != typeof document.ctiapplet && (IntervalTime = window.setInterval(function() {
                    b.Ajax({
                        url: b.DOM.INDEX + "/MonAgentActivity/UserActivity/",
                        param: {},
                        ERROR: function(a) {
                            try {
                                b.Util(a).proc(function(a) {
                                    b.Cmp(c).setText(a.time)
                                })
                            } catch (d) {
                                console.log(d)
                            }
                        }
                    }).post()
                }, a))
            },
            IntervalID: function() {
                return null != typeof IntervalTime ? IntervalTime : null
            }
        };
        return "object" == typeof a ? a : !1
    }
})(E_ui, Ext);