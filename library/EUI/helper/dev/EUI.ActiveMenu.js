/*
 * @ def  	 	: class active && not active && add methode 
				  to E_ui prototype JS Libs 	
 * 
 * @ Package 	: E.U.I::helper JS Libs   
 * @ Author  	: omens < jombi_par@yahoo.com > 
 * @ Method		: public 
 * @ Licensed	: under the MIT ( http://razakitechnology.com/siteraztech/product/web-application ) license.
 */

/*
  try{
	  // comment 
  } catch( e ){
	  window.location="http://stackoverflow.com/search?q=[js]"+ e.messages;
  }
 
 */



var _Cookies = [];

var _SetActiveMenu = [{
		id: "SrcAppoinment"
	},
	{
		id: "SrcWritePod"
	},
	{
		id: "SrcCustomerList"
	},
	{
		id: "SrcCustomerClosing"
	},
	{
		id: "ModFormInbound"
	},
	{
		id: "ModDashboard"
	},
	{
		id: "user-widget-profile"
	},
	{
		id: "user-widget-password"
	},
	{
		id: "user-widget-logout"
	}
];

var _SetTmpActiveMenu = {};
var _Usergroup = {};
var _Toolbars = {};

//----------- will store its ----------------------------------

Ext.DOM.LEVEL = {};
Ext.DOM.CONFIG = {};
//----------- will store its ----------------------------------

;
(function (Core, $) {

	Core.prototype.ActiveMenu = function () {
		var ActiveMenu = {
			menu: _SetActiveMenu,
			aksess: false,
			messages: function () {
				Ext.Msg('Please save call activity Or Press Button Close!').Info();
			},

			NotActive: function () {
				if ((Ext.Session('HandlingType').getSession() == Ext.DOM.LEVEL.USER_AGENT_INBOUND) ||
					(Ext.Session('HandlingType').getSession() == Ext.DOM.LEVEL.USER_AGENT_OUTBOUND)) {
					for (var a in this.menu) {
						var $id = new Array('#', this.menu[a].id).join('');
						_SetTmpActiveMenu[$id] = $($id).attr('onclick');
						$($id).attr('href', 'javascript:void(0);');
						$($id).attr('onclick', 'Ext.ActiveMenu().messages();');
					}
					this.aksess = true;
				}
			},

			Active: function () {
				var menu = _SetTmpActiveMenu;
				for (var $id in menu) {
					$($id).attr('href', 'javascript:void(0);');
					$($id).attr('onclick', menu[$id]);
				}
				this.aksess = false;
			},

			Home: function () {
				if (!this.aksess) {
					$('#main_content').load(Ext.DOM.INDEX + '/Welcome');
				} else {
					this.messages();
				}
			},

			setup: function (array_id) {
				_SetActiveMenu = _SetActiveMenu;
				if (_SetActiveMenu != '') {
					Ext.ActiveMenu().menu = _SetActiveMenu;
				}

				this.aksess = false;
			}

		}

		return (ActiveMenu ? ActiveMenu : null);
	}

	/*
	 * @ def 		:  Session
	 * ***********************************************
	 * @ param  	: get handle session by JAVASCRIPT 
	 * @ Author  	: omens < jombi_par@yahoo.com > 
	 * @ Method		: public 
	 */

	Core.prototype.Session = function (fn) {
		var Session = {
			Cokie: {},
			Cokies: [],
			getStore: function () {
				if (_Cookies.length < 1) {
					this.Cokie = (Ext.Ajax({
						url: Ext.EventUrl(new Array('ActiveMenu', 'UserSession')).Apply(),
						method: 'GET',
						param: {}
					}).json());
					this.Usergroup = (Ext.Ajax({
						url: Ext.EventUrl(new Array('ActiveMenu', 'UserPrivilege')).Apply(),
						method: 'GET',
						param: {}
					}).json());
					this.Config = (Ext.Ajax({
						url: Ext.EventUrl(new Array('ActiveMenu', 'UserConfig')).Apply(),
						method: 'GET',
						param: {}
					}).json());
				}

				for (var i in this.Cokie)
					_Cookies[i] = this.Cokie[i];

				for (var User in this.Usergroup)
					Ext.DOM.LEVEL[User] = this.Usergroup[User];

				for (var cnfg in this.Config)
					Ext.DOM.CONFIG[cnfg] = eval(this.Config[cnfg]);
			},

			// get spesific data 

			getSession: function () {
				if (fn) {
					return (_Cookies[Ext.BASE64.encode(fn)] ? Ext.BASE64.decode(_Cookies[Ext.BASE64.encode(fn)]) : '');
				} else
					return null;
			}
		}
		return (Session ? Session : null);

	}

	/*
	 * @ def 		:  detect Browser type 
	 * 
	 * @ param  	: get handle ActiveBars by JAVASCRIPT 
	 * @ Author  	: omens < jombi_par@yahoo.com > 
	 * @ Method		: public 
	 */

	Core.prototype.Browser = function (window) {
		var window = (window ? window : Ext.DOM),
			a = {
				getName: function () {
					try {
						return (window.navigator.appName ? window.navigator.appName : null);
					} catch (e) {
						Ext.Error({
							log: e,
							name: window.navigator,
							lineNumber: e.lineNumber
						});
					}
				},

				getCode: function () {
					try {
						return (window.navigator.appCodeName ? window.navigator.appCodeName : null);
					} catch (e) {
						Ext.Error({
							log: e,
							name: window.navigator,
							lineNumber: e.lineNumber
						});
					}
				},

				getVersion: function () {
					try {
						return (window.navigator.appVersion ? window.navigator.appVersion : null);
					} catch (e) {
						Ext.Error({
							log: e,
							name: window.navigator,
							lineNumber: e.lineNumber
						});
					}
				},

				getBuildID: function () {
					try {
						return (window.navigator.buildID ? window.navigator.buildID : null);
					} catch (e) {
						Ext.Error({
							log: e,
							name: window.navigator,
							lineNumber: e.lineNumber
						});
					}

				},

				getPlatform: function () {
					try {
						return (window.navigator.platform ? window.navigator.platform : null);
					} catch (e) {
						Ext.Error({
							log: e,
							name: window.navigator,
							lineNumber: e.lineNumber
						});
					}
				}

			};
		return (a ? a : Ext.Error({
			log: 'Not found of property',
			name: 'Ext.Browser() '
		}));
	}




	/*
	 * @ def 		:  Active Bars 
	 * 
	 * @ param  	: get handle ActiveBars by JAVASCRIPT 
	 * @ Author  	: omens < jombi_par@yahoo.com > 
	 * @ Method		: public 
	 */

	Core.prototype.ActiveBars = function (level) {
		var Bars = {
			title: [],
			menu: [],
			icon: [],
			option: [],
			USER_LEVEL: parseInt(level),
			Toolbars: {},
			fnToolbar: function () {
				_Toolbars = Ext.Ajax({
					url: Ext.DOM.INDEX + '/ActiveMenu/Toolbars/',
					method: 'GET',
					param: {}
				}).json();
				if (typeof (_Toolbars) == 'object') {
					this.Toolbars = _Toolbars;
				}
			},

			Title: function () {
				try {
					this.fnToolbar();
					if (typeof (this.Toolbars.title) == 'undefined') {
						this.fnToolbar();
					}



					var arr_obj_title = new Array(),
						arr_obj_store = this.Toolbars.title,
						title = arr_obj_store.map(function (item) {
							arr_obj_title.push(new Array(item));
						});
					return arr_obj_title;
				} catch (e) {
					return new Array();
				}
			},

			Menu: function () {
				try {
					var arr_obj_event = new Array(),
						arr_obj_store = _Toolbars.event,
						event = arr_obj_store.map(function (item) {
							arr_obj_event.push(new Array(item));
						});

					//console.log(arr_obj_event);

					return arr_obj_event;
				} catch (e) {
					return new Array();
				}
			},

			Icon: function () {
				try {
					var arr_obj_icon = new Array(),
						arr_obj_store = _Toolbars.icons,
						icons = arr_obj_store.map(function (item) {
							arr_obj_icon.push(new Array(item));
						});

					return arr_obj_icon;
				} catch (e) {
					return new Array();
				}
			},

			Option: function () {
				try {
					var arr_obj_option = new Array(),
						arr_obj_store = _Toolbars.option,
						arr_other = {};
					var val_no = 0;
					// console.log(arr_obj_store);
					if (typeof (arr_obj_store) == 'object')
						for (var obj in arr_obj_store) {
							val_no++;

							var arr_test = Object.keys(arr_obj_store[obj]);
							var arr_val_obj = arr_obj_store[obj];

							if (arr_test.length > 0)
								for (var val in arr_val_obj) {
									val_no++;
									//console.log( arr_val_obj[val].type );
									if (arr_val_obj[val].type == 'combo') {

										var $arr_list = arr_val_obj[val],
											$arr_nobj = {},
											arr_select = {};
										for (var value in $arr_list) {
											val_no++;
											//console.log(value);
											if (value == 'store') {
												$arr_nobj[value] = [eval($arr_list[value])];
											} else {
												$arr_nobj[value] = $arr_list[value];
											}
										}

										arr_other[val_no] = $arr_nobj;
									} else {
										arr_other[val_no] = arr_val_obj[val];

									}

								}
							//val_no++;
						}

					for (var opt in arr_other) {
						arr_obj_option.push(arr_other[opt]);
					}
					return arr_obj_option;

				} catch (e) {
					return new Array()
				}
			}
		}
		return (Bars ? Bars : {});

	}
})(E_ui, jQuery);

// --------------------------------------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------------

/*
 * Additional menu popup 
 */

(function ($If) {

	if (typeof ($If.prototype.QualitySkill) !== 'function') {
		$If.prototype.QualitySkill = function () {
			try {
				var QualitySkill = Ext.Ajax({
					url: Ext.EventUrl(new Array('QtyStaffGroup', 'QualitySkill')).Apply(),
					method: 'GET',
				}).json();
				return QualitySkill;
			} catch (e) {
				return {};
			}
		}
	}
	// --------------------------------------------------------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------

	if (typeof ($If.prototype.ChatWith) !== 'function') {
		$If.prototype.ChatWith = function () {
			if (typeof (Ext) != 'object') {
				return false;
			}
			var dialog = new Ext.Window({
				url: Ext.EventUrl(["ChatWith", "UserReady"]).Apply(),
				left: ($(window).width() / 2),
				height: 400,
				width: 400,
				top: $(window).height(),
				name: 'WinChat',
				scrollbars: 1,
				resizable: 1,
				param: {
					time: Ext.Date().getDuration()
				}
			});
			dialog.popup();
		}
	}

	// --------------------------------------------------------------------------------------------------------
	// --------------------------------------------------------------------------------------------------------

	if (typeof ($If.prototype.Knowledge) !== 'function') {
		$If.prototype.Knowledge = function () {
			if (typeof (Ext) != 'object') {
				return false;
			}
			var objDialog = new Ext.Window({
				url: Ext.EventUrl(["Helper", "index"]).Apply(),
				height: ($(window).height() - ($(window).height() / 8)),
				width: ($(window).width() - ($(window).width() / 4)),
				left: $(window).width(),
				top: 10,
				scrollbars: 1,
				resizable: 1,
				name: 'Knowledge',
				param: {
					time: Ext.Date().getDuration()
				}
			});
			if (!Ext.Msg('Open in New Tab?').Confirm()) {
				objDialog.popup();
			} else {
				objDialog.newtab();
			}
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.CallerScript) !== 'function') {
		$If.prototype.CallerScript = function () {
			var WinAgent = new Ext.Window({
				name: 'WinAgent999',
				url: Ext.EventUrl(['AgentScript', 'ShowScriptByCode']).Apply(),
				left: $(window).innerWidth(),
				top: 0,
				width: ($(window).innerWidth() / 2),
				height: $(window).height(),
				scrollbars: 1,
				resizable: 1,
				param: {
					code: '999'
				}
			});

			WinAgent.popup();
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.NewCall) !== 'function') {
		$If.prototype.NewCall = function () {
			// Ext.CallerScript();

			// Ext.ShowMenu("CallerIncoming", "New Call", {
			// callerid : "081298765432", 
			// callsessionid: '6162626626621',
			// ivrdata : ""			
			// });

			// this testing data callerIncoming : 
			var timeSession = Date.now(),
				timeString = timeSession.toString();

			// this fo test only : 
			var callSessionID = window.sprintf('%s%s', '209', timeString.substr(4, timeString.length)),
				callCallerID = window.sprintf('%s%s', '08130412', timeString.substr(-4, timeString.length));
			//alert(callSessionID);
			//alert(callCallerID);
			// alert('Ringing');
			//return false;
			var CustId = Ext.getCustomerIdfromCallSession('1571222157784318');
			// alert(CustId);
			Ext.ShowMenu('CallerIncoming', 'New Call', {
				// callerid : callCallerID, //'081804129180',
				CustomerId: CustId, //869915
				// callerid : '0614531036', //'081804129180', 
				// callsessionid: callSessionID,
				ivrdata: ''
			});
		}
	}

	if (typeof ($If.prototype.getCustomerIdfromCallSession) !== 'function') {
		$If.prototype.getCustomerIdfromCallSession = function (callsession = null) {
			var CustomerId = Ext.Ajax({
				url: Ext.DOM.INDEX + '/CallerIncoming/getCustomerIdfromCallSession/',
				method: 'POST',
				param: {
					callsessionid: callsession
				}
			}).json();
			// alert(CustomerId['assign_data']);
			console.log(CustomerId);
			return CustomerId['assign_data'];
		}
	}
	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.MyProfile) !== 'function') {
		$If.prototype.MyProfile = function () {
			Ext.ShowMenu(new Array("SysUser", "UserDetail"), "User Detail", {
				UserId: Ext.Session('UserId').getSession(),
				IsHome: 1
			});
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.ChangeMyPassword) !== 'function') {
		$If.prototype.ChangeMyPassword = function () {
			Ext.ShowMenu("SysUser/UserPassword", "Change Password", {
				UserId: Ext.Session('UserId').getSession()
			});
		}
	}
	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.BackHome) !== 'function') {
		$If.prototype.BackHome = function () {
			if (typeof (Ext) == 'object') {
				Ext.ShowMenu("Welcome", "Welcome");
			}
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */

	if (typeof ($If.prototype.AuthLogout) !== 'function') {
		$If.prototype.AuthLogout = function () {
			if (typeof (Ext) == 'object') {
				if (Ext.Msg('You will logged-out from this session. Are you sure ?').Confirm()) {
					document.location = Ext.DOM.INDEX + '/Auth/Logout/?login=(false)';
				}
			}
		}
	}
	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.SMS) !== 'function') {
		$If.prototype.SMS = function () {
			if (typeof (Ext) == 'object') {
				try {
					if (ExtApplet.getStatus() == AGENT_NOTREADY) {
						Ext.ShowMenu("SMSInbox", "Inbox", {
							sms_in_read: "0"
						});
					}
				} catch (e) {
					Ext.ShowMenu("SMSInbox", "Inbox", {
						sms_in_read: "0"
					});
				}
			}
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */

	if (typeof ($If.prototype.SaleNotifycation) !== 'function') {
		$If.prototype.SaleNotifycation = function () {

		}
	}


	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.SMSBalance) !== 'function') {
		$If.prototype.SMSBalance = function () {
			if (typeof (Ext) == 'object') {
				return true;
			}
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto layout extends jquery on selector 
	 * 
	 * @pack 			object class EUI 
	 * @auth 			uknown 
	 */
	if (typeof ($If.prototype.PremiSimulation) !== 'function') {
		$If.prototype.PremiSimulation = function () {
			var Simulation = new Ext.Window({
				name: 'WindowSimulation',
				url: Ext.EventUrl(['Simulasi', 'index']).Apply(),
				left: $(window).innerWidth(),
				top: 0,
				width: ($(window).innerWidth() / 2),
				height: $(window).height(),
				scrollbars: 1,
				resizable: 1,
				param: {
					fn: Ext.Session('Fullname').getSession(),
					id: Ext.Session('Username').getSession(),
					ts: Ext.Date().getDuration()
				}
			});
			Simulation.popup();
		}
	}

	// ---------------------------------------------------------------------------

	/* Modul 			auto detect barcode device with char 14 length .
	 *					standar barcode code fonts 39		
	 * 
	 * @pack 			object class EUI 
	 * @auth 			-- uknown -- 
	 */


	if (typeof ($If.prototype.ProductScript) !== 'function') {
		$If.prototype.ProductScript = function (ScriptId) {
			if (ScriptId == '') {
				return false;
			}

			var WindowScript = new Ext.Window({
				url: Ext.EventUrl(new Array("SetProductScript", "ShowProductScript")).Apply(),
				name: 'WinProduct',
				height: (Ext.Layout(window).Height()),
				width: (Ext.Layout(window).Width()),
				left: (Ext.Layout(window).Width() / 2),
				top: (Ext.Layout(window).Height() / 2),
				param: {
					ScriptId: Ext.BASE64.encode(ScriptId),
					Time: Ext.Date().getDuration()
				}
			}).popup();

			if (ScriptId == '') {
				window.close();
			}
		}
	}


	// ---------------------------------------------------------------------------

	/* Modul 			auto detect barcode device with char 14 length .
	 *					standar barcode code fonts 39		
	 * 
	 * @pack 			object class EUI 
	 * @auth 			-- uknown -- 
	 */

	if (typeof ($If.prototype.BarcodeDetector) !== 'function') {
		$If.prototype.BarcodeDetector = function () {
			var RegularExpres = new RegExp('RFC', 'i'); // default code  -- RFC --
			var BarcodeChars = new Array();
			var BarcodeLevel = new Array(window.LEVEL.USER_ADMIN, window.LEVEL.USER_ROOT);
			var BarcodeHandle = parseInt(Ext.Session('HandlingType').getSession());

			// -- hadle on keypress --  

			$(window).keypress(function (e) {
				var BarcodeCompare = $.inArray(BarcodeHandle, BarcodeLevel);
				if (BarcodeCompare >= 0) {

					// -- push on array ---
					BarcodeChars.push(String.fromCharCode(e.which));
					if (e.which == 13) {
						// -- parse serial barcode -- 
						var BarcodeSerial = BarcodeChars.join("");
						var ResultsRegex = BarcodeSerial.match(RegularExpres);

						// -- type char RFC  --  
						if (ResultsRegex != null) {
							BarcodeChars = new Array();
							var BarcodeCustomer = Ext.Ajax({
								url: Ext.EventUrl(new Array('SrcFollowupPod', 'EventBarcode')).Apply(),
								method: 'POST',
								param: {
									Barcode: BarcodeSerial
								}
							}).json();

							// -- send to admin contact detail -- 

							if (BarcodeCustomer.success == 1) {
								Ext.ShowMenu(new Array('SrcFollowupPod', 'ContactDetail'),
									'Admin Followup', {
										CustomerId: BarcodeCustomer.CustomerId,
										ControllerId: 'SrcFollowupPod'
									});
							} else {
								Ext.Msg("Reff. POD ( " + BarcodeSerial + " ) Not Found").Info();
								return false;
							}
						}
					}
				}
			});
		}
	}

})(E_ui);


// ---------------------------------------------------------------------------

/* Modul 			auto layout extends jquery on selector 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
if (typeof (window.Helper) !== 'function') {
	window.Helper = function () {
		Ext.Knowledge()
	};
}

// ---------------------------------------------------------------------------

/* Modul 			launce timer call reminder data User All Agent  
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */

if (typeof (window.SetTimerCallbackLater) == 'function') {
	$(document).ready(function () {
		window.SetTimerCallbackLater(window.CONFIG.CALL_BACK_LATER);
	});
}

// ---------------------------------------------------------------------------

/* Modul 			launce timer call reminder data User All Agent  
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */

if (typeof (Ext.BarcodeDetector) == 'function') {
	$(document).ready(function () {
		//Ext.BarcodeDetector();
	});
}


// ================== END JS ==========================