<script>

/**
{
	"table": "t_gn_campaign",
	"rows":
	[
		{
			"CampaignId": 1,
			"CampaignCode": "PORTOF001",
			"CampaignDesc": "CIP REGULER",
			"CampaignName": "CIP REGULER"
		},
		{
			"CampaignId": 2,
			"CampaignCode": "PORTOF002",
			"CampaignDesc": "CIP NTB",
			"CampaignName": "CIP NTB"
		},
		{
			"CampaignId": 3,
			"CampaignCode": "PORTOF003",
			"CampaignDesc": "CIP CC",
			"CampaignName": "CIP CC"
		},
		{
			"CampaignId": 4,
			"CampaignCode": "PORTOF004",
			"CampaignDesc": "CIP TOP UP",
			"CampaignName": "CIP TOP UP"
		},
		{
			"CampaignId": 5,
			"CampaignCode": "PORTOF005",
			"CampaignDesc": "PIL XSELL",
			"CampaignName": "PILXSELL"
		},
		{
			"CampaignId": 6,
			"CampaignCode": "PORTOF006",
			"CampaignDesc": "PIL TOP UP",
			"CampaignName": "PILTOPUP"
		},
		{
			"CampaignId": 7,
			"CampaignCode": "PORTOF007",
			"CampaignDesc": "HOSPIN",
			"CampaignName": "HOSPIN"
		},
		{
			"CampaignId": 8,
			"CampaignCode": "PORTOF008",
			"CampaignDesc": "PA",
			"CampaignName": "PA"
		},
		{
			"CampaignId": 9,
			"CampaignCode": "PORTOF009",
			"CampaignDesc": "FLEXI",
			"CampaignName": "FLEXI"
		}
	]
}

-- Campaign Active Now

PILXSELL
PILTOPUP
HOSPIN
FLEXI

*/

Ext.DOM.LoadProductInfo = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	var Controller = Ext.Cmp('ViewProductInfo').getValue();
	var CustomerName = Ext.Cmp('CustomerFirstName').getValue();
	var CustomerDOB = Ext.Cmp('CustomerDOB').getValue();
	var GenderId = Ext.Cmp('GenderId').getValue();
    Ext.Ajax 
	({
		url    : Ext.EventUrl([Controller,'index']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			CustomerName : CustomerName,
			CustomerDOB : CustomerDOB,
			GenderId	: GenderId,
			Mode : 'VIEW'
		}
	}).load("tabs-5");
}


Ext.DOM.LoadVerification = function()
{
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	var Controller = Ext.Cmp('ViewVerification').getValue();
    Ext.Ajax 
	({
		url    : Ext.EventUrl([Controller,'index']).Apply(),
		method : "GET",
		param  : {
			CustomerId 	: CustomerId,
			Mode : 'VIEW'
		}
	}).load("tabs-4");
}


$(document).ready(function () {
	Ext.DOM.LoadVerification();
	Ext.DOM.LoadProductInfo();
});

</script>