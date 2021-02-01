// ------------------------------------------------
/* @ pack 	: object cti Applet Redirect 
 * @ notes  : this will run in IE & Firefox 
 */

var isMSIE = (Ext.Browser().getName() == 'Microsoft Internet Explorer');
var CBTNALL = 0xFFFF;
var CBTNREADY = 0x0001;
var CBTNAUX = 0x0002;
var CBTNACW = 0x0004;
var CBTNPREDICTIVE = 0x0010;
var CBTNOUTBOUND = 0x0008;
var CBTNDIAL = 0x0100;
var CBTNHOLD = 0x0200;
var CBTNHANGUP = 0x0400;
var CBTNTRANSFER = 0x0800;
var CBTNCONFERENCE = 0x1000;
var AGENT_NULL = 0;
var AGENT_LOGIN = 1;
var AGENT_READY = 2;
var AGENT_NOTREADY = 3;
var AGENT_ACW = 4;
var AGENT_OUTBOUND = 5;
var AGENT_PREDICTIVE = 6;
var AGENT_BUSY = 7;
var CALLSTATUS_IDLE = 0;
var CALLSTATUS_ALERTING = 1;
var CALLSTATUS_CONNECTED = 2;
var CALLSTATUS_SERVICEINITIATED = 3;
var CALLSTATUS_ANSWERED = 4;
var CALLSTATUS_HELD = 5;
var CALLSTATUS_ORIGINATING = 6;
var CALLSTATUS_TRUNKSEIZED = 7;
var INBOUND_CALL = 1;
var OUTBOUND_CALL = 2;
var EMAIL_MEDIA = 1;
var onHold = false;
var onCall = false;
var connectedStatus = false;
var agentStatus = AGENT_NULL;
var agentBtnState = 0x0000;
var callBtnState = 0x0000;
var callStatus = 0;
var warned = 0;
var destNo;
var callPasswd;
var callTAC;
var promptDestWin = undefined;
//--------------- cti applet lib -----------------------

var CTI = {
	call_tac: 0,
	user_level: 0,


	MaskingNumber: function (number) {

	},

	//////////INI//////////
	init: function (call_tac, user_level) {
		this.call_tac = call_tac;
		this.user_level = user_level;
	},
	/////////////INI//////////

	prepareCTIClient: function () {
		try {
			if (document.ctiapplet.getAgentStatus() == Ext.DOM.AGENT_NULL) {
				document.ctiapplet.setAgentSkill(1);
				document.ctiapplet.ctiConnect();
				document.ctiapplet.setAgentEventHandler('CTI.OnAgentEventHandler');
				document.ctiapplet.setCallEventHandler('CTI.OnCallEventHandler');
				document.ctiapplet.setOtherMediaEventHandler('CTI.OnOtherMediaEventHandler');
			}

			if (isMSIE)
				document.ctiapplet.style.display = 'none';
		} catch (e) {
			Ext.Error({
				log: e,
				name: 'CTI.prepareCTIClient()',
				lineNumber: e.lineNumber
			});
		}
	},

	prepareDisconnect: function () {
		document.ctiapplet.ctiDisconnect();
	},

	dialOut: function (destNo) {
		callTAC = this.call_tac;
		if (destNo.indexOf(callTAC) == 0)
			destNo = destNo.substring(callTAC.length);
		document.ctiapplet.callDial(callTAC, destNo, "1234");
	},

	timeStamp: function () {
		var now = new Date();
		var stamp = now.getFullYear() + '/' + (now.getMonth() + 1) + '/' + now.getDate() + ' ' + now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
		return stamp;
	},

	disableAgentButton: function (val) {
		document.getElementById("idFrmAgent").btnReady.disabled = (val & CBTNREADY);
		document.frmAgent.btnReady.disabled = (val & CBTNREADY);
		document.frmAgent.btnAUX.disabled = (val & CBTNAUX);
	},

	disableCallButton: function (val) {
		callBtnState |= val;
		document.frmAgent.btnHold.disabled = (callBtnState & CBTNHOLD);
		document.frmAgent.btnHangup.disabled = (callBtnState & CBTNHANGUP);
	},

	enableCallButton: function (val) {
		callBtnState &= ~val;
		if (!onCall)
			document.frmAgent.btnDial.disabled = (callBtnState & CBTNDIAL);
		document.frmAgent.btnHold.disabled = (callBtnState & CBTNHOLD);
		document.frmAgent.btnHangup.disabled = (callBtnState & CBTNHANGUP);
	},

	disableAllButton: function () {
		//disableCallButton(CBTNALL);  
	},

	OnLeaveInbound: function () {
		return (Ext.Ajax({
			url: Ext.DOM.INDEX + '/CallGroupTeam/index/',
			method: 'POST',
			param: {
				time: Ext.Date().getDuration()
			}
		}).json());
	},

	////////////////////////////////////////

	OnAgentEventHandler: function (agentstatus) {
		switch (agentstatus) {
			case AGENT_LOGIN:
				Ext.Cmp("AgentStatus").setText('" Login');
				break;

			// ready check status if inbound status
			case AGENT_READY:
				//if( this.OnLeaveInbound().INBOUND == INBOUND_CALL ) // default is outbound
				Ext.Cmp("AgentStatus").setText('" Ready');
				// else {
				// document.ctiapplet.agentSetNotReady(5);
				// Ext.Cmp("AgentStatus").setText('" Ready Outbound');
				// }
				break;

			case AGENT_NOTREADY:
				var selAuxreason = Ext.Cmp('auxReason').getElementId();
				if ((Ext.Cmp('auxReason').getText() != '')) {
					if (Ext.Cmp('auxReason').getValue() != '') {
						Ext.Cmp("AgentStatus").setText('Not Ready [ ' + Ext.Cmp('auxReason').getText() + ' ]');
					} else {
						Ext.Cmp("AgentStatus").setText('Not Ready');
					}
				} else
					Ext.Cmp("AgentStatus").setText('" Not Ready');
				break;

			case AGENT_ACW:
				Ext.Cmp("AgentStatus").setText('" Acw');
				break;

			case AGENT_OUTBOUND:
				Ext.Cmp("AgentStatus").setText('" Busy');
				break;

			case AGENT_PREDICTIVE:
				break;

			case AGENT_BUSY:
				Ext.Cmp("AgentStatus").setText('" Busy');
				break;

			default:
				if (warned == 0) {
					Ext.Msg('Login Telephony anda ditolak karena kemungkinanan anda sudah login ditempat lain\natau sudah ada yang login di PC ini').Info();
					warned = 1;
					Ext.Cmp("AgentStatus").setText('" Reject');
				}
				break;
		}
	},

	OnCallEventHandler: function (callstatus) {
		switch (callstatus) {
			case CALLSTATUS_IDLE:
				onHold = false;
				onCall = false;
				Ext.Cmp("idCallStatus").setText("Idle");
				break;

			case CALLSTATUS_ALERTING:
				onCall = true;
				// inbound call type 
				console.log('CALLSTATUS_ALERTING=' + CALLSTATUS_ALERTING);
				var CustomerId = CTI.convertCallSessionId2CustomerId(document.ctiapplet.getCallSessionKey());
				if (document.ctiapplet.getCallDirection() == INBOUND_CALL) {
					Ext.Cmp("idCallStatus").setText("Call Inbound from " + document.ctiapplet.getCallerId());
					// try {
						// Ext.CallerScript();
					// } catch (e) {
						// console.log(e);
					// };
					Ext.ShowMenu("CallerIncoming", "New Call", {
						CustomerId: CustomerId, //869915
						PDSCall:1
						// callerid : document.ctiapplet.getCallerId(), 
						// callsessionid: document.ctiapplet.getCallSessionKey(),
						// ivrdata : document.ctiapplet.getIVRData()
					});
				}

				if (document.ctiapplet.getCallDirection() == OUTBOUND_CALL) {
					try {
						var str = String(ExtApplet.getPhoneNumber());
						var res = str.substr(0, 5) + 'XXXXXX';
						// Ext.Cmp("idCallStatus").setText("Call to "+ExtApplet.getPhoneNumber());
						Ext.Cmp("idCallStatus").setText("Call to - " + res);
					} catch (e) {
						Ext.Error({
							log: e,
							name: 'CTI.Call Status=> ' + CALLSTATUS_ALERTING,
							lineNumber: e.lineNumber
						});
					}
				}
				break;

			case CALLSTATUS_ANSWERED:
				console.log('CALLSTATUS_ANSWERED ' + CALLSTATUS_ANSWERED);
				onCall = true;
				if (document.ctiapplet.getCallDirection() == INBOUND_CALL)
					Ext.Cmp("idCallStatus").setText("Call to " + document.ctiapplet.getCallerId());
				else if (document.ctiapplet.getCallDirection() == OUTBOUND_CALL) {
					try {
						Ext.Cmp("idCallStatus").setText("Call to " + ExtApplet.getPhoneNumber());
					} catch (e) {
						Ext.Error({
							log: e,
							name: 'CTI.Call Status=> ' + CALLSTATUS_ANSWERED,
							lineNumber: e.lineNumber
						});
					}
				}
				break;

			case CALLSTATUS_SERVICEINITIATED:
				onCall = true;
				Ext.Cmp("idCallStatus").setText("Phone offhook");
				break;

			case CALLSTATUS_ORIGINATING:
				console.log('CALLSTATUS_ORIGINATING ' + CALLSTATUS_ORIGINATING);
				onCall = true;
				if (document.ctiapplet.getCallDirection() == INBOUND_CALL) {}
				if (document.ctiapplet.getCallDirection() == OUTBOUND_CALL) {
					try {
						var str = String(ExtApplet.getPhoneNumber());
						var res = str.substr(0, 5) + 'XXXXXX';
						// Ext.Cmp("idCallStatus").setText("Connected to - "+ ExtApplet.getPhoneNumber() );
						// Ext.Cmp("idCallStatus").setText("Connected to - "+ res );
						Ext.Cmp("idCallStatus").setText("Dialing to - " + res);
					} catch (e) {
						Ext.Error({
							log: e,
							name: 'CTI.Call Status=> ' + CALLSTATUS_ORIGINATING,
							lineNumber: e.lineNumber
						});
					}
				}
				break;

			case CALLSTATUS_CONNECTED:
				console.log('CALLSTATUS_CONNECTED ' + CALLSTATUS_CONNECTED);
				onCall = true;
				onHold = false;

				if (document.ctiapplet.getCallDirection() == INBOUND_CALL) {
					Ext.Cmp("idCallStatus").setText("Call from " + document.ctiapplet.getCallerId() + " connected");
				}

				if (document.ctiapplet.getCallDirection() == OUTBOUND_CALL) {
					try {
						var str = String(ExtApplet.getPhoneNumber());
						var res = str.substr(0, 5) + 'XXXXXX';
						// Ext.Cmp("idCallStatus").setText("Connected to - "+ ExtApplet.getPhoneNumber() );
						// Ext.Cmp("idCallStatus").setText("Connected to - "+ res );
						Ext.Cmp("idCallStatus").setText("Talking to - " + res);
						// $("#tabs").mytab().tabs().tabs("option", "disabled", [3,4]);
					} catch (e) {
						Ext.Error({
							log: e,
							name: 'CTI.Call Status=> ' + CALLSTATUS_CONNECTED,
							lineNumber: e.lineNumber
						});
					}
				}
				break;

			case CALLSTATUS_HELD:
				onHold = true;
				Ext.Cmp("idCallStatus").setText("Call with " + ExtApplet.getPhoneNumber() + " on hold");
				break;
		}
	},

	OnOtherMediaEventHandler: function (media, eventid) {
		switch (media) {
			case EMAIL_MEDIA:
				(parent.frames[0] != 'undefined' ? parent.frames[0].cti_notification(1, document.ctiapplet.getMediaId()) : '');
				break;
		}
	},

	onButtonHoldClick: function () {
		if (onHold) {
			document.ctiapplet.callRetrieve();
		} else {
			document.ctiapplet.callHold();
		}
	},

	setLabelStatus: function (v_status_agent) {
		if (v_status_agent != '') {
			Ext.Cmp('idCallStatus').setText(Ext.Cmp('auxReason').getText())
			if (Ext.Cmp('auxReason').empty() != true) {
				try {
					document.ctiapplet.agentSetNotReady(v_status_agent);
				} catch (e) {
					Ext.Cmp("AgentStatus").setText("ERR CTI Applet");
					window.setTimeout(function () {
						Ext.Cmp("AgentStatus").setText("AGENT_STATUS");
					}, 2000);
					Ext.Error({
						log: e,
						name: 'CTI.agentSetNotReady()',
						lineNumber: e.lineNumber
					});
				}
			} else {
				try {
					document.ctiapplet.agentSetNotReady(0);
				} catch (e) {
					Ext.Error({
						log: e,
						name: 'CTI.agentSetNotReady()',
						lineNumber: e.lineNumber
					});
				}
			}
			return false;
		} else
			return;
	},

	setLabelReady: function () {
		try {
			// alert(Ext.Cmp('auxReason').getValue());
			Ext.Cmp('idCallStatus').setText("Idle");
			Ext.Cmp('auxReason').setValue("");
			if ((document.ctiapplet.getAgentStatus() != AGENT_READY)) {
				document.ctiapplet.agentSetReady();
				return false;
			}
		} catch (e) {
			Ext.Cmp('idCallStatus').setText("ERR CTI Applet");
			window.setTimeout(function () {
				Ext.Cmp("idCallStatus").setText("-");
			}, 2000);
			Ext.Error({
				log: e,
				name: 'CTI.setLabelReady()',
				lineNumber: e.lineNumber
			});
		}
	},

	ctiSetTicketNumber: function (n) {
		document.ctiapplet.setAssignmentId(n);
	},

	convertCallSessionId2CustomerId: function (callsession) {
		var CustomerId = Ext.Ajax({
			url: Ext.DOM.INDEX + '/CallerIncoming/getCustomerIdfromCallSession/',
			method: 'POST',
			param: {
				callsessionid: callsession
			}
		}).json();
		// alert(CustomerId['assign_data']);
		console.log(CustomerId);
		// return CustomerId['assign_data'];
		return CustomerId['assign_id'];
	}






};
//=========== END JS ===>