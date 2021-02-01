<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header("Calculator Hospin");?></title>
 <meta name="viewport" content="width=device-width" /> 
 <link type="text/css" rel="stylesheet" href="<?php echo base_themes_style( themes() );?>/ui.all.css?time=<?php echo time();?>" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.overwriter.css?time=<?php echo time();?>" />
 <link type="text/css" rel="shortcut icon" href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
 
 <!-- loaction script data --->
 
 <script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-1.4.4.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo version();?>&&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo version();?>&&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_helper();?>/EUI.Browser.js?version=<?php echo version();?>&&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript">
	;(function(criit){ 
		criit.prototype.Money = function(angka){
			return ({
				ToRupiah : function(){
					if(angka!=''){
						var rev     = parseInt(angka, 10).toString().split("").reverse().join("");
						var rev2    = "";
						for(var i = 0; i < rev.length; i++){
							rev2  += rev[i];
							if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
								rev2 += ".";
							}
						}
						return rev2.split("").reverse().join("");
					}
					else{return 0;}
				},
				ToDollar : function(){
					if(angka!=''){
						var rev     = parseInt(angka, 10).toString().split("").reverse().join("");
						var rev2    = "";
						for(var i = 0; i < rev.length; i++){
							rev2  += rev[i];
							if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
								rev2 += ",";
							}
						}
						return rev2.split("").reverse().join("");
					}
					else{return 0;}
				},
				ToInt : function(){
					if(angka != ''){ return parseInt(angka.replace(/[^\w\s]/gi, '')); }
					else{return 0;}
				},
				ToNumeric : function(){
					if(angka != ''){ return angka.replace(/[^0-9]/gi, ''); }
					else{return 0;}
				},
				// allowNumberDes:function(){
					// angka=""+angka;
					// alert(angka);
					// var Lstring;
					// var Lconstant;
					// var Rstring;
					// Lstring = angka.length;
					// Lconstant = (angka.length -1);
					// Rstring = angka.substring(Lconstant,Lstring);
					// console.log(Rstring);
					// if(isNaN(Rstring)){
						// if(Rstring != ','){
							// angka = angka.substring(0,Lconstant);
						// }else{
							// if( (angka.match(/[,]/g) || []).length > 0 ){
								// angka = angka.substring(0,angka.length-1);
							// }else{
								// if( angka.substring(0,1) == ',' ){
									// angka = angka.substring(0,angka.length-1);
								// }
							// }
						// }
					// }
				// },
			});
		}
	})(E_ui);

	function AgeCallculator( Date ){
		if(Date==""){
			return age={Age:0,years:0,months:0,days:0};
		}else{
			return( Ext.Ajax  ({
					url 	: Ext.EventUrl(new Array('ProductInfo', 'SelectCalculateAge') ).Apply(), 
					method 	:'GET',
					param 	: { 
						Date  : ( typeof( Date ) !='undefined' ? Date : '' )
					},
				}).json()
			);
		}
	}
	
	Ext.DOM.setDisabled = function(id,flag)
	{
		Ext.Cmp('dob_'+id).disabled(flag);
		
		if(!flag){
			$('#dob_'+id).css('border-color','blue');
		}
		else{
			$('#dob_'+id).css('border-color','#cccddd');
		}
	}
	
	Ext.DOM.setClear = function(id)
	{
		Ext.Cmp('dob_'+id).setValue('');
		Ext.Cmp('age_'+id).setValue('');
		Ext.Cmp('age_'+id+'-2').setText('-');
	}
	
	Ext.DOM.openCoverage = function(val){
		var Coverage = Ext.Cmp('coverage').getValue();
		if(Coverage == 1){ // MAIN & FAMILY
			// Ext.DOM.setDisabled('main',false);
			Ext.DOM.setDisabled('main',false);
			
			Ext.DOM.setDisabled('spouse',false);
			Ext.DOM.setDisabled('c1',false);
			Ext.DOM.setDisabled('c2',false);
			Ext.DOM.setDisabled('c3',false);
			
			Ext.Cmp('monthly_premium').setValue("");
			Ext.Cmp('monthly_premium-2').setValue("");
		}else if(Coverage == 2){ // MAIN ONLY
			Ext.DOM.setDisabled('main',false);
			
			Ext.DOM.setDisabled('spouse',true);
			Ext.DOM.setClear('spouse');
			Ext.DOM.setDisabled('c1',true);
			Ext.DOM.setClear('c1');
			Ext.DOM.setDisabled('c2',true);
			Ext.DOM.setClear('c2');
			Ext.DOM.setDisabled('c3',true);
			Ext.DOM.setClear('c3');
			
			Ext.Cmp('monthly_premium').setValue("");
			Ext.Cmp('monthly_premium-2').setValue("");
		}else if(Coverage == 3){ // MAIN & CHILD
			// Ext.DOM.setDisabled('main',false);
			Ext.DOM.setDisabled('main',false);
			
			Ext.DOM.setDisabled('spouse',true);
			Ext.DOM.setClear('spouse');
			Ext.DOM.setDisabled('c1',false);
			Ext.DOM.setDisabled('c2',false);
			Ext.DOM.setDisabled('c3',false);
			
			Ext.Cmp('monthly_premium').setValue("");
			Ext.Cmp('monthly_premium-2').setValue("");
		}else if(Coverage == 4){ // MAIN & SPOUSE
			// Ext.DOM.setDisabled('main',false);
			Ext.DOM.setDisabled('main',false);
			Ext.DOM.setDisabled('spouse',false);
			
			Ext.DOM.setDisabled('c1',true);
			Ext.DOM.setClear('c1');
			Ext.DOM.setDisabled('c2',true);
			Ext.DOM.setClear('c2');
			Ext.DOM.setDisabled('c3',true);
			Ext.DOM.setClear('c3');
			
			Ext.Cmp('monthly_premium').setValue("");
			Ext.Cmp('monthly_premium-2').setValue("");
		}
		else{ 
			Ext.DOM.setDisabled('main',true);
			Ext.DOM.setClear('main');
			Ext.DOM.setDisabled('spouse',true);
			Ext.DOM.setClear('spouse');
			Ext.DOM.setDisabled('c1',true);
			Ext.DOM.setClear('c1');
			Ext.DOM.setDisabled('c2',true);
			Ext.DOM.setClear('c2');
			Ext.DOM.setDisabled('c3',true);
			Ext.DOM.setClear('c3');
			
			Ext.Cmp('monthly_premium').setValue("");
			Ext.Cmp('monthly_premium-2').setValue("");
		}
	}
	
	Ext.DOM.getPremi = function(val){
		var Coverage = Ext.Cmp('coverage').getValue();
		var ChildPremi = Ext.DOM.getChildPremi(val);
		
		if( val!="" || val!=null )
		{
			if(Coverage == ""){
				alert("Coverage Harus diIsi!");
				return false;
			}else{
				var Plan = val;
				var premiAge = 0;
				
				if(Coverage == 1 || Coverage ==4){
					var ages = [Ext.Cmp('age_main').getValue(),Ext.Cmp('age_spouse').getValue()];
					premiAge = Math.max.apply(Math, ages);
					Coverage = 4;
				}else{
					premiAge = Ext.Cmp('age_main').getValue();
					Coverage = 2;
				}

				var premi = Ext.Ajax  ({
						url 	: Ext.EventUrl(new Array('ProductInfo', 'getPremi') ).Apply(), 
						method 	:'GET',
						param 	: { 
							premiAge	: premiAge,
							Plan		: Plan,
							Coverage	: Coverage
						},
					}).json();
				
				if(ChildPremi != undefined){
					var totalPremi = parseInt(premi.ProductPlanPremium) + parseInt(ChildPremi);
				}else{
					var totalPremi = premi.ProductPlanPremium;
				}
				Ext.Cmp("monthly_premium").setValue(totalPremi);
				Ext.Cmp("monthly_premium-2").setValue(Ext.Money(totalPremi).ToRupiah());
				// console.log(childs);
			}
		}
		else{
			Ext.Cmp("monthly_premium").setValue('');
			Ext.Cmp("monthly_premium-2").setValue('');
		}
	}
	
	Ext.DOM.getChildPremi = function(val){
		var childs = new getChilds();
		// console.log(childs);
		if(childs.length > 0){
			var childpremi = Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfo', 'getPremi')).Apply(),
				method	:'GET',
				param	:{
					premiAge: 'child',
					Plan	: val,
					Coverage: 3,
				}
			}).json();
			
			var childpremisum = childpremi.ProductPlanPremium * childs.length;
			// alert(childpremisum);
		}
		return childpremisum;
	}
	
	function getChilds(){
		var coverage = Ext.Cmp('coverage').getValue();
		var childs = [];
		if(coverage==1 || coverage==3){
			if(Ext.Cmp('age_c1').getValue() != ""){
				childs.push({
					Age:Ext.Cmp('age_c1').getValue()
				});
			}
			if(Ext.Cmp('age_c2').getValue() != ""){
				childs.push({
					Age:Ext.Cmp('age_c2').getValue()
				});
			}
			if(Ext.Cmp('age_c3').getValue() != ""){
				childs.push({
					Age:Ext.Cmp('age_c3').getValue()
				});
			}
		}
		return childs;
	}
	
	//wisnu
	
	Ext.DOM.closeWin = function() {
		window.parent.close();   // Closes the new window
	}
	Ext.DOM.GetEffectiveRate = function(){
		var flatrate = Ext.Cmp('flatrate').getValue();
		var tenor = Ext.Cmp('tenor').getValue();
		var rate = Ext.Ajax  ({
			url 	: Ext.EventUrl(new Array('Simulasi', 'get_effective_rate') ).Apply(), 
			method 	:'GET',
			param 	: { 
				flatrate	: flatrate,
				tenor		: tenor
			},
		}).json();
		var effective_rate = rate.effective_rate;
		// num.toFixed(2)
		Ext.Cmp("effectiverate").setValue(effective_rate.toFixed(1));
	}
	Ext.DOM.Calculate = function(){
		var flatrate = Ext.Cmp('flatrate').getValue();
		var tenor = Ext.Cmp('tenor').getValue();
		var principal = Ext.Cmp('principal').getValue();
		var effectiverate = Ext.Cmp('effectiverate').getValue();
		if(effectiverate == "" || principal == "" || principal == 0 || effectiverate == 0){
			alert('Please Fill All Available Fields!');
			return false;
		}else{
			Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('Simulasi', 'CalculatePMT') ).Apply(), 
				method 	:'GET',
				param 	: { 
					flatrate	: flatrate,
					tenor		: tenor,
					principal	: Ext.Money(principal).ToInt(),
					effectiverate: effectiverate
				},
			}).load('table-scheme');
			// var PMT = rate.PMT;
			// Ext.Cmp("principaltext").setValue(PMT);
		}
	}
	
	Ext.DOM.Calculate2 = function(){
		var loan = Ext.Cmp('loan').getValue();
		var interestrate = Ext.Cmp('interestrate').getValue();
		if(loan == "" || interestrate == ""){
			alert('Please Fill All Available Fields!');
			return false;
		}else{
			Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('Simulasi', 'Cashbacktable') ).Apply(), 
				method 	:'GET',
				param 	: { 
					loan		: Ext.Money(loan).ToInt(),
					interestrate: interestrate
				},
			}).load('table-scheme2');
		}
	}
	
	//end wisnu line
	
	$(document).ready(function(){
		$('#ui-widget-content-markup-tabs').mytab().tabs();	
		$('#ui-widget-content-markup-tabs').mytab().tabs("option", "selected", 0);
		$("#ui-widget-content-markup-tabs").mytab().close({}, true);
		$('.ui-widget-content-frame').css("background-color","#FFFFFF");
		$('.select').chosen();
		
		$("input.date").attr("disabled", true);
		$('.date').mask("00-00-0000", { placeholder: "__-__-____"});
		$('.date').datepicker({
			buttonImage	: window.opener.Ext.DOM.LIBRARY+'/gambar/calendar.gif',
			buttonImageOnly: true,  
			dateFormat	: 'dd-mm-yy', yearRange: "1945:2030",
			changeYear	: true,
			changeMonth	: true,
			onSelect	: function(date){
				if(typeof(date) =='string'){
					if(new Date(date.replace(/-/gi,"/")) > new Date()) {
						alert('Invalid Date');
						Ext.Cmp($(this).attr('id')).setValue('');
					}
					else{
						if( $(this).attr('id')=='dob_main' ) {
							var my_payer = new AgeCallculator( $(this).val());
							if( typeof(my_payer) == 'object' ){ 
								if(my_payer.Age > 59){
									alert("Tidak meng-cover usia diatas 60 tahun");
									Ext.Cmp($(this).attr('id')).setValue('');
								}else{
									Ext.Cmp("age_main").setValue(my_payer.Age);
									Ext.Cmp("age_main-2").setText(my_payer.years+" y, "+my_payer.months+" m, "+my_payer.days+" d");
								}
							}	
						}
						if( $(this).attr('id')=='dob_spouse' ) {
							var my_payer = new AgeCallculator( $(this).val());
							if( typeof(my_payer) == 'object' ){
								if(my_payer.Age > 59){
									alert("Tidak meng-cover usia diatas 60 tahun");
								}else{
									Ext.Cmp("age_spouse").setValue(my_payer.Age);
									Ext.Cmp("age_spouse-2").setText(my_payer.years+" y, "+my_payer.months+" m, "+my_payer.days+" d");
								}
							}	
						}
						if( $(this).attr('id')=='dob_c1' ) {
							var my_payer = new AgeCallculator( $(this).val());
							if( typeof(my_payer) == 'object' ){
								if(my_payer.years > 21){
									alert("Usia Anak tidak boleh lebih dari 21 tahun");
								}else{
									Ext.Cmp("age_c1").setValue(my_payer.Age);
									Ext.Cmp("age_c1-2").setText(my_payer.years+" y, "+my_payer.months+" m, "+my_payer.days+" d");
								}
							}	
						}
						if( $(this).attr('id')=='dob_c2' ) {
							var my_payer = new AgeCallculator( $(this).val());
							if( typeof(my_payer) == 'object' ){
								if(my_payer.years > 21){
									alert("Usia Anak tidak boleh lebih dari 21 tahun");
								}else{
									Ext.Cmp("age_c2").setValue(my_payer.Age);
									Ext.Cmp("age_c2-2").setText(my_payer.years+" y, "+my_payer.months+" m, "+my_payer.days+" d");
								}
							}	
						}
						if( $(this).attr('id')=='dob_c3' ) {
							var my_payer = new AgeCallculator( $(this).val());
							if( typeof(my_payer) == 'object' ){
								if(my_payer.years > 21){
									alert("Usia Anak tidak boleh lebih dari 21 tahun");
								}else{
									Ext.Cmp("age_c3").setValue(my_payer.Age);
									Ext.Cmp("age_c3-2").setText(my_payer.years+" y, "+my_payer.months+" m, "+my_payer.days+" d");
								}
							}	
						}
					}
				}	
			}
		});
			$(".money").keyup(function(){
				var id = $(this).attr('id');
				var text = Ext.Cmp(id).getValue();
				
				if(text!=''){
					text = Ext.Money(text).ToInt();
					Ext.Cmp(id).setValue(Ext.Money(text).ToDollar());
				}
				else{
					Ext.Cmp(id).setValue(0);
				}
			});
			
			// $(".allowNumberDes").keyup(function(){
				// var id = $(this).attr('id');
				// var text = Ext.Cmp(id).getValue();
				
				// if(text!=''){
					// text = Ext.Money(text).ToRupiah();
					// Ext.Cmp(id).setValue(text);
				// }
				// else{
					// Ext.Cmp(id).setValue(0);
				// }
			// });
		$('body').css({ "margin" : "8px"});
	});
 </script>
</head>
<body>