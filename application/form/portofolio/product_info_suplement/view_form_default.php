<script>
/*
 * Enigma User Interface
 *
 * An open source application development framework for Web 2.0 or newer
 *
 * @package		Enigma User Interface *.js
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2017, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.3.20
 * @filesource test
 */
// ----------------------------------------------------------------------------------------		
	Ext.DOM.FallbackNopelLimiter = function (getNopelLimiter){
		// Ext.DOM.getNopelLimiter (Ext.DOM.FallbackNopelLimiter);
		if(getNopelLimiter || getNopelLimiter!='undefined'){
			Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);
		}else{
			alert('Lengkapi Form!');
			// Ext.DOM.getVerificationStatus();
			return false;
		}
	}
	
	Ext.DOM.getNopelLimiter = function (callback){
		var Product = Ext.Cmp('Product').getValue();
		var JenisJasa = Ext.Cmp('JenisJasa').getValue();
		var Prefix = Ext.Cmp('Prefix').getValue();
		Ext.Ajax({
			url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'getSuplementNopelLimiter')).Apply(),
			method	:'POST',
			param	:{SuplementProduct:Product,SuplementJenisJasa:JenisJasa,SuplementPrefix:Prefix},
			ERROR	: function(fn){
				Ext.Util(fn).proc(function(result){
					console.log("Result set :"+result.Nopelvalidity);
					Ext.Cmp('nopel_limiter').setValue(result.Nopelvalidity);
					callback(result.Nopelvalidity);
					// if(result.Nopelvalidity){
						// Ext.Cmp('NomorPelanggan').disabled(false);
						// Ext.Cmp('NamaPelanggan').disabled(false);
					// }
					// callback(result.ver_result);
				});
			}
		}).post();
	}
	
	Ext.DOM.deleteSup = function (supId){
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		var confm = confirm("Are you sure!?");
		if(confm){
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'deleteSuplement')).Apply(),
				method	:'POST',
				param	:{billingid:supId,CustomerId:CustomerId},
				ERROR	: function(fn){
					Ext.Util(fn).proc(function(result){
						if(result.delete){
							// alert('Delete Success!');
							Ext.DOM.reloadSuplement();
						}else{
							alert('Delete Fail!');
						}
					});
				}
			}).post();
		}else{
			return false;
		}
	}
	
	Ext.DOM.getVerificationStatus = function (callback){
		//alert('varif dulu')
		Ext.DOM.getNopelLimiter();
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		Ext.Ajax({
			url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'getVerificationStatus')).Apply(),
			method	:'POST',
			param	:{CustomerId:CustomerId},
			ERROR	: function(fn){
				Ext.Util(fn).proc(function(result){
					// console.log("Result test :"+result.ver_result);
					callback(result.ver_result);
				});
			}
		}).post();
	}

	Ext.DOM.Fallback = function (verification){
		if(verification){
			Ext.DOM.saveProductInfoSuplement();
		}else{
			alert('Verifikasi Belum Lengkap!');
			//Ext.DOM.saveProductInfoSuplement();
			return false;
		}
		
	}
	
	Ext.DOM.NopelValidator = function(minmax,nopel){
		if(minmax[0]==minmax[1]){
			if(nopel==minmax[1]){
				return true;
			}else{
				return false;
			}
		}else{
			if(nopel>=minmax[0] && nopel<=minmax[1]){
				return true;
			}else{
				return false;
			}
		}
	}

	var isFullname = false, isNameOnCard = false, isNoIdentificationType = false, isDob = false

	Ext.DOM.validateFullname = function (input) {
		if(input.value.length > 33) {
			document.getElementById('warningFullname').innerHTML = 'Nama lengkap tanpa singkatan maksimal 33 karakter'
			document.getElementById('warningFullname').style.color = 'red'
			isFullname = false
		} else {
			document.getElementById('warningFullname').innerHTML = null
			document.getElementById('warningFullname').style.color = ''
			isFullname = true
		}
	}

	Ext.DOM.validateNameOnCard = function (input) {
		if(input.value.length > 19) {
			document.getElementById('warningNameOnCard').innerHTML = 'Name on card maksimal 19 karakter'
			document.getElementById('warningNameOnCard').style.color = 'red'
			isNameOnCard = false
		} else {
			document.getElementById('warningNameOnCard').innerHTML = null
			document.getElementById('warningNameOnCard').style.color = ''
			isNameOnCard = true
		}
	}

	Ext.DOM.validateIdentificationType = function (select) {
		if(select.value != 4) {
			alert('Kartu harus KTP')
			document.getElementById('identificationType').value=4;
		} else {
			return
		}
	}

	Ext.DOM.validateNoIdentificationType = function (input) {
		if(input.value.length != 16) {
			document.getElementById('warningNoIdentificationType').innerHTML = 'No Ktp maksimal 16 karakter'
			document.getElementById('warningNoIdentificationType').style.color = 'red'
			isNoIdentificationType = false
		} else {
			document.getElementById('warningNoIdentificationType').innerHTML = null
			document.getElementById('warningNoIdentificationType').style.color = ''
			isNoIdentificationType = true
		}
	}

	Ext.DOM.validateDob = function (input) {
		var split = input.value.split('-');
		var res = split[1]+'/'+split[0]+'/'+split[2];
		var date1 = new Date(res);
		var date2 = new Date();
		var diffTime = Math.abs(date2 - date1);
		var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
		var diffYear = diffDays / 365;
		var warning;
		if(diffYear < 17) {
			warning = 'Umur minimal 17 tahun';
			isDob = false;
		} else {
			warning = '';
			isDob = true;
		}
		document.getElementById('warningDob').innerHTML = warning;
		document.getElementById('warningDob').style.color = 'red';
	}

	var isFullname2 = true, isNameOnCard2 = false, isNoIdentificationType2 = true, isDob2 = true

	Ext.DOM.validateFullname2 = function (input) {
		if(input.value.length > 33) {
			document.getElementById('warningFullname2').innerHTML = 'Nama lengkap tanpa singkatan maksimal 33 karakter'
			document.getElementById('warningFullname2').style.color = 'red'
			isFullname2 = false
		} else {
			document.getElementById('warningFullname2').innerHTML = null
			document.getElementById('warningFullname2').style.color = ''
			isFullname2 = true
		}
	}

	Ext.DOM.validateNameOnCard2 = function (input) {
		if(input.value.length > 19) {
			document.getElementById('warningNameOnCard2').innerHTML = 'Name on card maksimal 19 karakter'
			document.getElementById('warningNameOnCard2').style.color = 'red'
			isNameOnCard2 = false
		} else {
			document.getElementById('warningNameOnCard2').innerHTML = null
			document.getElementById('warningNameOnCard2').style.color = ''
			isNameOnCard2 = true
		}
	}

	Ext.DOM.validateIdentificationType2 = function (select) {
		if(select.value != 4) {
			alert('Kartu harus KTP')
			document.getElementById('identificationType').value=4;
		} else {
			return
		}
	}

	Ext.DOM.validateNoIdentificationType2 = function (input) {
		if(input.value.length != 16) {
			document.getElementById('warningNoIdentificationType2').innerHTML = 'No Ktp maksimal 16 karakter'
			document.getElementById('warningNoIdentificationType2').style.color = 'red'
			isNoIdentificationType2 = false
		} else {
			document.getElementById('warningNoIdentificationType2').innerHTML = null
			document.getElementById('warningNoIdentificationType2').style.color = ''
			isNoIdentificationType2 = true
		}
	}

	Ext.DOM.validateDob2 = function (input) {
		var split = input.value.split('-');
		var res = split[1]+'/'+split[0]+'/'+split[2];
		var date1 = new Date(res);
		var date2 = new Date();
		var diffTime = Math.abs(date2 - date1);
		var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
		var diffYear = diffDays / 365;
		var warning;
		if(diffYear < 17) {
			warning = 'Umur minimal 17 tahun';
			isDob2 = false;
		} else {
			warning = '';
			isDob2 = true;
		}
		document.getElementById('warningDob2').innerHTML = warning;
		document.getElementById('warningDob2').style.color = 'red';
	}

	Ext.DOM.validateMandatory = function (noKtp, namaDepan, fullname, nameOnCard, formerName, pob, dob, mmn, addessSup, phone, resPhone, email, salutation, nationality, cob, gender, maritalStatus, relationship, occupation) {
		var res;
		if(noKtp == '' || noKtp == null) {
			res = {
				msg : 'No ktp tidak boleh kosong !',
				status : 0
			}
		} else if(namaDepan == '' || namaDepan == null) {
			res = {
				msg : 'Nama depan tidak boleh kosong !',
				status : 0
			}
		} else if(fullname == '' || fullname == null) {
			res = {
				msg : 'Nama lengkap tidak boleh kosong !',
				status : 0
			}
		} else if (nameOnCard == '' || nameOnCard == null) {
			res = {
				msg : 'Name on card tidak boleh kosong !',
				status : 0
			}
		} else if (formerName == '' || formerName == null) {
			res = {
				msg : 'Former name tidak boleh kosong !',
				status : 0
			}
		} else if(pob == '' || pob == null) {
			res = {
				msg : 'Place of birth tidak boleh kosong !',
				status : 0
			}
		} else if(dob == '' || dob == null) {
			res = {
				msg : 'Date of birth tidak boleh kosong !',
				status : 0
			}
		} else if(mmn == '' || mmn == null) {
			res = {
				msg : 'Mmn tidak boleh kosong !',
				status : 0
			}
		} else if(addessSup == '' || addessSup == null) {
			res = {
				msg : 'Address suplement tidak boleh kosong !',
				status : 0
			}
		} else if(phone == '' || phone == null) {
			res = {
				msg : 'Mobile phone no tidak boleh kosong !',
				status : 0
			}
		} else if(resPhone == '' || resPhone == null) {
			res = {
				msg : 'Resident phone tidak boleh kosong !',
				status : 0
			}
		} else if(email == '' || email == null) {
			res = {
				msg : 'Email tidak boleh kosong !',
				status : 0
			}
		} else if(salutation == '' || salutation == null) {
			res = {
				msg : 'salutation tidak boleh kosong !',
				status : 0
			}
		} else if(nationality == '' || nationality == null) {
			res = {
				msg : 'nationality tidak boleh kosong !',
				status : 0
			}
		} else if(gender == '' || gender == null) {
			res = {
				msg : 'gender tidak boleh kosong !',
				status : 0
			}
		} else if(maritalStatus == '' || maritalStatus == null) {
			res = {
				msg : 'marital status tidak boleh kosong !',
				status : 0
			}
		} else if(relationship == '' || relationship == null) {
			res = {
				msg : 'relationship tidak boleh kosong !',
				status : 0
			}
		} else if(occupation == '' || occupation == null) {
			res = {
				msg : 'occupation tidak boleh kosong !',
				status : 0
			}
		}
		else {
			res = {
				msg : '',
				status : 1
			}
		}
		return res;
	}
	
	Ext.DOM.saveProductInfoSuplement = function (){
		if( Ext.Cmp('tnc').getValue() == 0 || Ext.Cmp('tnc').getValue() == 'NO'){
			window.alert("tnc Type must be YES!");
			return false;
		}
		var valMandatory = Ext.DOM.validateMandatory(Ext.Cmp('NoIdentificationType').getValue(), Ext.Cmp('namaDepan').getValue(), Ext.Cmp('fullname').getValue(), Ext.Cmp('nameOnCard').getValue(), Ext.Cmp('formerName').getValue(), Ext.Cmp('pob').getValue(), Ext.Cmp('dob').getValue(), Ext.Cmp('mmn').getValue(), Ext.Cmp('addressSuplement').getValue(), Ext.Cmp('mobilePhoneNo').getValue(), Ext.Cmp('residentPhone').getValue(), Ext.Cmp('emailPi').getValue(), Ext.Cmp('salutation').getValue(), Ext.Cmp('nationality').getValue(), Ext.Cmp('cob').getValue(), Ext.Cmp('gender').getValue(), Ext.Cmp('maritalStatus').getValue(), Ext.Cmp('relationship').getValue(), Ext.Cmp('occupation').getValue());
		if(valMandatory.status == 1) {
			if(!isFullname) {
				alert('Nama lengkap tanpa singkatan maksimal 33 karakter');
			} else if(!isNoIdentificationType) {
				alert('No Ktp maksimal 16 karakter');
			} else if(!isDob) {
				alert('Umur minimal 17 tahun');
			} else {
				if(Ext.Cmp('identificationType').getValue() != 4) {
					alert('Kartu harus KTP')
					document.getElementById('identificationType').value=4
				} else {
					Ext.Ajax({
						url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'saveProductSuplement')).Apply(),
						method	:'POST',
						param	:{
							CUSTNO1: Ext.Cmp('CUSTNO1').getValue(),
							Accno: Ext.Cmp('Accno').getValue(),
							cardno: Ext.Cmp('cardno').getValue(),
							CustomerId: Ext.Cmp('CustomerId').getValue(),
							identificationType: Ext.Cmp('identificationType').getValue(),
							NoIdentificationType: Ext.Cmp('NoIdentificationType').getValue(),
							salutation: Ext.Cmp('salutation').getValue(),
							namaDepan: Ext.Cmp('namaDepan').getValue(),
							namaTengah: Ext.Cmp('namaTengah').getValue(),
							namaBelakang: Ext.Cmp('namaBelakang').getValue(),
							fullname: Ext.Cmp('fullname').getValue(),
							nameOnCard: Ext.Cmp('nameOnCard').getValue(),
							formerName: Ext.Cmp('formerName').getValue(),
							gender: Ext.Cmp('gender').getValue(),
							pob: Ext.Cmp('pob').getValue(),
							dob: Ext.Cmp('dob').getValue(),
							maritalStatus: Ext.Cmp('maritalStatus').getValue(),
							mmn: Ext.Cmp('mmn').getValue(),
							occupation: Ext.Cmp('occupation').getValue(),
							addressQuestion: Ext.Cmp('addressQuestion').getValue(),
							addressSuplement: Ext.Cmp('addressSuplement').getValue(),
							relationship: Ext.Cmp('relationship').getValue(),
							nationality: Ext.Cmp('nationality').getValue(),
							cob: Ext.Cmp('cob').getValue(),
							idPlaceIssued: Ext.Cmp('idPlaceIssued').getValue(),
							idDateIssued: Ext.Cmp('idDateIssued').getValue(),
							idExpiredDate: Ext.Cmp('idExpiredDate').getValue(),
							mobilePhoneNo: Ext.Cmp('mobilePhoneNo').getValue(),
							residentPhone: Ext.Cmp('residentPhone').getValue(),
							email: Ext.Cmp('emailPi').getValue(),
							residentArea: Ext.Cmp('residentArea').getValue(),
							sendAddress: Ext.Cmp('sendAddress').getValue(),
						},
						ERROR	: function(fn){
							Ext.Util(fn).proc(function(result){
								if(result.success == 1) {
									Ext.Cmp('isSave').setValue('1');
									Ext.Cmp('InputForm').setValue('1');
									alert('Sukses !')
									Ext.DOM.reloadSuplement();
									Ext.DOM.clearInput();
								} else {
									alert('Suplement tidak bisa save 3x !');
								}
							});
						}
					}).post();
				}
			}
		} else {
			alert(valMandatory.msg);
		}
	}

	function salutationCase(str) {
		var splitStr = str.toLowerCase().split('/');
		for (var i = 0; i < splitStr.length; i++) {
			splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
		}
		return splitStr.join('/'); 
	}

	Ext.DOM.editSup = function(supId) {
		var confm = confirm("Untuk edit lihat form di atas!");
		if(confm){
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'editSuplement')).Apply(),
				method	:'POST',
				param	:{supId:supId},
				ERROR	: function(fn){
					Ext.Util(fn).proc(function(result){
						if(result.data){
							if(result.data.addressQuestion == 1) {
								document.getElementById('sendAddress').disabled = false
							}
							document.getElementById('wrap-update').style.display = 'block'
							document.getElementById('wrap-save').style.display = 'none'
							document.getElementById('wrap-tnc').style.display = 'none'
							document.getElementById('idSuplement').value = result.data.Id
							document.getElementById('identificationType').value = result.data.identificationType
							document.getElementById('NoIdentificationType').value = result.data.NoIdentificationType
							document.getElementById('salutation').value = salutationCase(result.data.salutation)
							document.getElementById('namaDepan').value = result.data.namaDepan
							document.getElementById('namaTengah').value = result.data.namaTengah
							document.getElementById('namaBelakang').value = result.data.namaBelakang
							document.getElementById('fullname').value = result.data.fullname
							document.getElementById('nameOnCard').value = result.data.nameOnCard
							document.getElementById('formerName').value = result.data.formerName
							document.getElementById('gender').value = result.data.gender
							document.getElementById('pob').value = result.data.pob
							document.getElementById('dob').value = result.data.dob
							document.getElementById('maritalStatus').value = result.data.maritalStatus
							document.getElementById('mmn').value = result.data.mmn
							document.getElementById('occupation').value = result.data.occupation
							document.getElementById('addressQuestion').value = result.data.addressQuestion
							document.getElementById('addressSuplement').value = result.data.addressSuplement
							document.getElementById('relationship').value = result.data.relationship
							document.getElementById('nationality').value = result.data.nationality
							document.getElementById('cob').value = result.data.cob
							document.getElementById('idPlaceIssued').value = result.data.idPlaceIssued
							document.getElementById('idDateIssued').value = result.data.idDateIssued
							document.getElementById('idExpiredDate').value = result.data.idExpiredDate
							document.getElementById('mobilePhoneNo').value = result.data.mobilePhoneNo
							document.getElementById('residentPhone').value = result.data.residentPhone
							document.getElementById('emailPi').value = result.data.email
							document.getElementById('residentArea').value = result.data.residentArea,
							document.getElementById('sendAddress').value = result.data.sendAddress
						}else{
							document.getElementById('wrap-update').style.display = 'none'
						}
					});
				}
			}).post();
		}else{
			return false;
		}
	}

	Ext.DOM.updateProductInfoSuplement = function () {
		// var valMandatory = Ext.DOM.validateMandatory(Ext.Cmp('NoIdentificationType').getValue(), Ext.Cmp('namaDepan').getValue(), Ext.Cmp('fullname').getValue(), Ext.Cmp('nameOnCard').getValue(), Ext.Cmp('formerName').getValue(), Ext.Cmp('pob').getValue(), Ext.Cmp('dob').getValue(), Ext.Cmp('mmn').getValue(), Ext.Cmp('addressSuplement').getValue(), Ext.Cmp('mobilePhoneNo').getValue(), Ext.Cmp('residentPhone').getValue(), Ext.Cmp('emailPi').getValue(), Ext.Cmp('salutation').getValue(), Ext.Cmp('nationality').getValue(), Ext.Cmp('cob').getValue(), Ext.Cmp('gender').getValue(), Ext.Cmp('maritalStatus').getValue(), Ext.Cmp('relationship').getValue(), Ext.Cmp('occupation').getValue());
		// if(valMandatory.status == 1) {
			// if(!isFullname) {
			// 	alert('Nama lengkap tanpa singkatan maksimal 33 karakter');
			// } else if(!isNoIdentificationType) {
			// 	alert('No Ktp maksimal 16 karakter');
			// } else if(!isDob) {
			// 	alert('Umur minimal 17 tahun');
			// } else {
				if(Ext.Cmp('identificationType').getValue() != 4) {
					alert('Kartu harus KTP')
					document.getElementById('identificationType').value=4
				} else {
					Ext.Ajax({
						url		: Ext.EventUrl(new Array('ProductInfoSuplement', 'editProductSuplement')).Apply(),
						method	:'POST',
						param	:{
							Id: Ext.Cmp('idSuplement').getValue(),
							identificationType: Ext.Cmp('identificationType').getValue(),
							NoIdentificationType: Ext.Cmp('NoIdentificationType').getValue(),
							salutation: Ext.Cmp('salutation').getValue(),
							namaDepan: Ext.Cmp('namaDepan').getValue(),
							namaTengah: Ext.Cmp('namaTengah').getValue(),
							namaBelakang: Ext.Cmp('namaBelakang').getValue(),
							fullname: Ext.Cmp('fullname').getValue(),
							nameOnCard: Ext.Cmp('nameOnCard').getValue(),
							formerName: Ext.Cmp('formerName').getValue(),
							gender: Ext.Cmp('gender').getValue(),
							pob: Ext.Cmp('pob').getValue(),
							dob: Ext.Cmp('dob').getValue(),
							maritalStatus: Ext.Cmp('maritalStatus').getValue(),
							mmn: Ext.Cmp('mmn').getValue(),
							occupation: Ext.Cmp('occupation').getValue(),
							addressQuestion: Ext.Cmp('addressQuestion').getValue(),
							addressSuplement: Ext.Cmp('addressSuplement').getValue(),
							relationship: Ext.Cmp('relationship').getValue(),
							nationality: Ext.Cmp('nationality').getValue(),
							cob: Ext.Cmp('cob').getValue(),
							idPlaceIssued: Ext.Cmp('idPlaceIssued').getValue(),
							idDateIssued: Ext.Cmp('idDateIssued').getValue(),
							idExpiredDate: Ext.Cmp('idExpiredDate').getValue(),
							mobilePhoneNo: Ext.Cmp('mobilePhoneNo').getValue(),
							residentPhone: Ext.Cmp('residentPhone').getValue(),
							email: Ext.Cmp('emailPi').getValue(),
							residentArea: Ext.Cmp('residentArea').getValue(),
							sendAddress: Ext.Cmp('sendAddress').getValue(),
						},
						ERROR	: function(fn){
							Ext.Util(fn).proc(function(result){
								if(result.success == 1) {
									Ext.Cmp('isSave').setValue('1');
									Ext.Cmp('InputForm').setValue('1');
									alert('Sukses !')
									document.getElementById('wrap-save').style.display = 'none'
									Ext.DOM.clearInput();
									Ext.DOM.reloadSuplement();
								} else {
									alert('Opss.. tidak sukses !');
								}
							});
						}
					}).post();
				}
			// }
		// } else {
		// 	alert('ga okeee')
		// }
	}

	Ext.DOM.cancelSave = function () {
		document.getElementById('wrap-update').style.display = 'none'
		document.getElementById('formProductInfo1').reset()
		document.getElementById('identificationType').value = 4
	}

	Ext.DOM.clearInput = function () {
		document.getElementById('formProductInfo1').reset()
	}
	
	Ext.DOM.addressQuestions = function(choose) {
		if(choose.value == 1 || choose.value == '' || choose.value == null) {
			document.getElementById('sendAddress').disabled = true
		} else {
			document.getElementById('sendAddress').disabled = false
		}
	}
	
	Ext.DOM.reloadSuplement = function(){
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ProductInfoSuplement/reloadSuplement/',
			method  : 'GET',
			param  : {
				CustomerId : CustomerId
			}	
		}).load("Suplementttt");
	}
	
// ----------------------------------------------------------------------------------------

	Ext.DOM.getLoan = function(val){		
		var CustomerId = Ext.Cmp('CustomerId').getValue(),
	    protectData = Ext.EventUrl( new Array('ProductInfoPilx','getLoanPerVariable') );
	  
		// please overider by spiner plugin dont event by ext.Ajax 
		// cause have the "bugs ", load not perfected .
		// will be cache not clear .
	  
		$('#loans').Spiner ({
			url  	: protectData.Apply(),
			method : 'GET',
			param 	: {
				loansvar : val, 
				CustomerId:CustomerId
			},
			complete : function( protectedHtml ){
			$( protectedHtml ).css({ "height" : "100%" });
				// this must be selector replace by html 
				// class jQuery.  
			}
		});	
	}
	

	Ext.DOM.IncomingColSet = function (){
		var incomecol = Ext.Cmp('incomecol').getValue();
		if(incomecol=="Belum Ada Income Doc"){
			Ext.Cmp('incomecol_yn').disabled(false);
			Ext.Cmp('incomecol_tp').disabled(true);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
		}else{
			Ext.Cmp('incomecol_yn').disabled(true);
			Ext.Cmp('incomecol_tp').disabled(true);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
		}
	}
		

	Ext.DOM.IncomingCol = function(){
		var incomecol = Ext.Cmp('incomecol_yn').getValue();
		if(incomecol == "Y"){
			Ext.Cmp('incomecol_tp').disabled(false);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
		}else if(incomecol == "N"){
			Ext.Cmp('incomecol_tp').disabled(true);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
			Ext.Cmp('incomecol_tp').setValue('');
			Ext.Cmp('incomecol_tp_rng').setValue('');
			Ext.Cmp('incomecol_tp_fix').setValue('');
		}
	}
	
	Ext.DOM.IncomingType = function(){
		var incomingtype = Ext.Cmp('incomecol_tp').getValue();
		if(incomingtype=="Fix"){
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(false);
			Ext.Cmp('incomecol_tp_rng').setValue('');
		}else if(incomingtype=="Range"){
			Ext.Cmp('incomecol_tp_rng').disabled(false);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
			Ext.Cmp('incomecol_tp_fix').setValue('');
		}
	}
	
	Ext.DOM.CashbackSet = function (){
		var cashback = Ext.Cmp('cashback').getValue();
		if(cashback=="YES"){
			Ext.Cmp('cashback_yn').disabled(false);
		}else{
			Ext.Cmp('cashback_yn').disabled(true);
		}
	}
	
	Ext.DOM.IncomeDocSet = function (){
		var cashback = Ext.Cmp('cashback').getValue();
		if(cashback=="YES"){
			Ext.Cmp('incomedoccollec').disabled(true);
		}else{
			Ext.Cmp('incomedoccollec').disabled(true); 
		}
	}

	$(document).ready(function() {

		$("#tnc").change(function() {

			var value = $(this).val()
			
			if(value=='NO'){	
				Ext.Cmp('tnc2').disabled(true);
				document.getElementById("tnc2").value = "";
			}else if (value=='YES'){
				var ScriptId = Ext.Cmp('CampaignId').getValue();
				var WindowScript = new Ext.Window 
				({
						url     : Ext.EventUrl(['SetProductScript','ShowProductScripttncCipReguler']).Apply(), 
						name    : 'WinProduct',
						height  : ($(window).innerHeight()),
						width   : ($(window).innerWidth() - ( $(window).innerWidth()/2 )),
						left    : ($(window).innerWidth()/2),
						top	    : ($(window).innerHeight()/2),
						param   : {
							ScriptId : ScriptId,
							Time	 : Ext.Date().getDuration()
						}
					}).newtab();

				// if( ScriptId =='' ) {
				// 	window.close();
				// }
				Ext.Cmp('tnc2').disabled(false);
				//Ext.Cmp('tnc2').value('TNC');
				document.getElementById("tnc2").value = "TNC";
			}else{
				Ext.Cmp('tnc2').disabled(true);		
			}	
		})

	// $("#ButtonUserSave").hide()
		Ext.Cmp('NomorPelanggan').disabled(false);
		Ext.Cmp('NamaPelanggan').disabled(false);
		
		$("#benefbank").change(function(){
			var valueBenef    = $(this).val(),
			BenefAccounts = $("#benefaccount"),
			protectDataSendurl = Ext.EventUrl( new Array('SrcCustomerList','getDigitBank', valueBenef) );  
				
				// Ext.DOM.INDEX + "/SrcCustomerList/getDigitBank/" + valueBenef;
			
			var getDigit = {
				url  	 : protectDataSendurl.Apply() , 
				type 	 : "POST" , 
				dataType : 'json' , 
				success  : function (digit) {

					// console.log(digit);

					var MinDigit = digit.minlength;
					var MaxDigit = digit.maxlength;

					$(BenefAccounts).attr('minlength',MinDigit);
					$(BenefAccounts).attr('maxlength',MaxDigit);
				}
			};
			
			$.ajax(getDigit);
		});
		
		
		$("#benefaccount").keydown(function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A, Command+A
				(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		$('#benefname').bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		$('#benefaccount').bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		$('#benefbranch').bind("cut copy paste",function(e) {
			e.preventDefault();
		});

		Ext.DOM.IncomingColSet();
		Ext.DOM.CashbackSet();
		Ext.DOM.IncomeDocSet();
		// Ext.DOM.getVerificationStatus();
	
		
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

			$('.date').datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, changeMonth:true, changeYear:true, dateFormat:'dd-mm-yy',readonly:true, yearRange: '-100:+10'});

	});
	
	
	
	
</script>
<?php

	$newDate = date("d-m-Y", strtotime($param['CustomerDOB']));
	
	
	/* COMBO-COMBO */
	$coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
	$plan 	  = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
	$sex 	  = array(1=>"Pria",2=>"Wanita");
	$incomecol= array('Y'=>'Yes', 'N'=>'No');
	$incomecol_tp = array('Fix'=>'Fix','Range'=>'Range');
	$incomecol_tp_range = array();
	for($i=1;$i<10;$i++){
		if($i == 1){
			$incomecol_tp_range[$i] = "< 3 Juta";
			$i+=1;
		}else{
			$incomecol_tp_range[$i] = $i." Juta";
		}
	}
	for($i=10;$i<=60;$i+=10){
		if($i > 10){
			if($i==60){
				$incomecol_tp_range['>50 Juta'] = ">50 Juta";
			}else{
				$incomecol_tp_range[($i-9)."-".$i." Juta"] = ($i-9)."-".$i." Juta";
			}
		}else{
			$incomecol_tp_range[$i." Juta"] = $i." Juta";
		}
	}
	/* END OF COMBO-COMBO */
	
?>

<fieldset class="corner" style="margin-bottom:15px;">
	<?php
		// echo '<pre>';
		// print_r($param);
		// echo '</pre><br/>';
		// echo '<pre>';
		// print_r($Detail);
		// echo '</pre><br/>';
	?>
	<?php echo form()->legend(lang("Product Info Suplement"), "fa-tasks");?>
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<?php echo form()->hidden('isVerif',NULL,$ver_result['ver_result']);?>
	
	<form name="formProductInfo1" id="formProductInfo1">
	
	<?php echo form()->hidden('CUSTNO1',NULL, $param['CUSTNO1'] );?>
	<?php echo form()->hidden('CustomerName',NULL, $param['CustomerName'] );?>
	<?php echo form()->hidden('Accno',NULL, $param['Accno'] );?>
	<?php echo form()->hidden('cardno',NULL, $param['cardno'] );?>

	<?php echo form()->hidden('CustomerId',NULL, $param['CustomerId'] );?>
	<div class="ui-widget-form-table-compact" style="width:99%;margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("ID Purpose");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="identificationType" id="identificationType" class="select  tolong" onchange="Ext.DOM.validateIdentificationType(this)">
					<?php
						foreach($IdentificationType as $item){
							if($item['IdentificationTypeId'] == 4) {
								echo '<option value="'.$item['IdentificationTypeId'].'" selected>'.$item['IdentificationType'].'</option>';
							} else {
								echo '<option value="'.$item['IdentificationTypeId'].'">'.$item['IdentificationType'].'</option>';
							}
						}
					?>
				</select>
				<?php 
					// echo form()->input("NoIdentificationType", "select  tolong", null,null,array("change"=>""));
				?>
				<?php echo form()->hidden('idSuplement',NULL, NULL);?>
				<input type="text" class="select  tolong" name="NoIdentificationType" id="NoIdentificationType" oninput="Ext.DOM.validateNoIdentificationType(this)">
				<small id="warningNoIdentificationType"></small>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Nama sesuai KTP");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="salutation" id="salutation" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($salutation as $item){
							echo '<option value="'.$item['SalutationCode'].'">'.$item['Salutation'].'</option>';
						}
					?>
				</select>
				<?php echo form()->input("namaDepan", "select  tolong", null,null,array("change"=>""));?>
				<?php echo form()->input("namaTengah", "select  tolong", null,null,array("change"=>""));?>
				<?php echo form()->input("namaBelakang", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Nama lengkap tanpa singkatan");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="divJenisJasa">
				<?php
					// echo form()->input("fullname", "select  tolong", null,null,array("change"=>"Ext.DOM.validateFullname(this);"));
				?>
				<input type="text" class="select  tolong" name="fullname" id="fullname" oninput="Ext.DOM.validateFullname(this)" maxlength="33">
				<small id="warningFullname"></small>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Name on card");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="divPrefix">
				<?php
					// echo form()->input("nameOnCard", "select  tolong", null,null,array("change"=>""));
				?>
				<input type="text" class="select  tolong" name="nameOnCard" id="nameOnCard" oninput="Ext.DOM.validateNameOnCard(this)" maxlength="19">
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Former name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("formerName", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Gender");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="gender" id="gender" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($gender as $item){
							echo '<option value="'.$item['GenderId'].'">'.$item['Gender'].'</option>';
						}
					?>
				</select>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Place of birth");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("pob", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php
					// echo form()->input('dob','input_text box date');
				?>
				<input type="text" class="input_text box date" name="dob" id="dob" placeholder="__-__-____" onchange="Ext.DOM.validateDob(this)">
				<small id="warningDob"></small>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Marital status");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="maritalStatus" id="maritalStatus" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($maritalStatus as $item){
							echo '<option value="'.$item['MaritalStatusCode'].' - '.$item['MaritalStatusDesc'].'">'.$item['MaritalStatusDesc'].'</option>';
						}
					?>
				</select>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("MMN");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("mmn", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Occupation");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="occupation" id="occupation" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($occupation as $item){
							echo '<option value="'.$item['OccId'].'">'.$item['OccDesc'].'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Address Suplement");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			<?php echo form()->textarea("addressSuplement","textarea long city_payer uppercase ",null,null, null);?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Relationship");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="relationship" id="relationship" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($relationship as $item){
							echo '<option value="'.$item['RelationshipTypeId'].'">'.$item['RelationshipTypeDesc'].'</option>';
						}
					?>
				</select>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Nationality");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="nationality" id="nationality" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($country as $item1){
							echo '<option value="'.$item1['CountryId'].'">'.$item1['CountryName'].'</option>';
						}
					?>
				</select>
			</div>
		</div>
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Country of birth");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="cob" id="cob" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($country as $item2){
							echo '<option value="'.$item2['CountryId'].'">'.$item2['CountryName'].'</option>';
						}
					?>
				</select>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("ID place issued");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="idPlaceIssued" id="idPlaceIssued" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($country as $item3){
							echo '<option value="'.$item3['CountryId'].'">'.$item3['CountryName'].'</option>';
						}
					?>
				</select>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("ID date issued");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php
					echo form()->input('idDateIssued','input_text box date');
				?>
				<!-- <input type="text" class="input_text box date" name="idDateIssued" id="idDateIssued" placeholder="____-__-__"> -->
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("ID expired date");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php
					// echo form()->input('idExpiredDate','input_text box date');
				?>
				<!-- <input type="text" class="input_text box date" name="idExpiredDate" id="idExpiredDate" placeholder="__-__-____" value="31-12-2100"> -->
				<input type="text" class="select  tolong" name="idExpiredDate" id="idExpiredDate" placeholder="__-__-____" value="31-12-2100" readonly disabled/>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Mobile phone no");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("mobilePhoneNo", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Resident Phone");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("residentPhone", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Email");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("emailPi", "select  tolong", null,null,array("change"=>""));?>
			</div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Resident area");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="residentArea" id="residentArea" class="select  tolong">
					<option value="">--- choose ---</option>
					<?php
						foreach($area as $item){
							echo '<option value="'.$item['areaid'].'">'.$item['areadesc'].'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">
				<?php
					// echo lang("Apakah alamat billing masih sama?");
				?>
				</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="addressQuestion" id="addressQuestion" class="select  tolong" onchange="Ext.DOM.addressQuestions(this)">
					<option value="">--- choose ---</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
				&nbsp;
				<span>
					Address : &nbsp;
					<?php
						// echo $result['addr1'].' '.$result['addr2'].' '.$result['addr3'].' '.$result['addr4'];
					?>
				</span>
			</div>
		</div> -->
		<!-- <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">
				<?php
					// echo lang("Ke alamat mana billing ingin dikirimkan?");
				?>
			</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select name="sendAddress" id="sendAddress" class="select  tolong" disabled>
					<option value="">--- choose ---</option>
					<option value="rumah">Rumah</option>
					<option value="kantor">Kantor</option>
				</select>
			</div>
		</div> -->
		<div class="ui-widget-form-row" id="wrap-tnc">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Pembacaan TnC");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			
			<select name="tnc" id="tnc" class="select tolong">
			 <?php  if($frm['tnc']==='YES'){?> 
				<option value="0">Choose</option>
				<option selected="" value="YES">YES</option>
				<option value="NO">NO</option>
				<?php }else{ ?>
				<option value="0">Choose</option>
				<option value="YES">YES</option>
				<option value="NO">NO</option>
		    	<?php } ?>
			</select>
			
			
			</div>
		</div>	
		<div class="ui-widget-form-row">
			<?php
				if($param['Mode']!='VIEW'){
			?>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" id="wrap-save">
				<?php //echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));?>
				<?php 
				// if(_get_session('HandlingType')==4 || _get_session('HandlingType')==8){
						// echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));
					// echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);'));
					//echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoSuplement(Ext.DOM.FallbackNopelLimiter);'));
					echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);'));
				// }
				?>
			</div>
			<div class="ui-widget-form-cell" id="wrap-update" style="display: none;">
				<?php 
					echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.updateProductInfoSuplement();'));
					echo form()->button("ButtonUserCancelSave", "button cancel", lang('Cancel'), array('click' => 'Ext.DOM.cancelSave();'));
				?>
			</div>
			<?php
				}
			?>
		</div>
	</div>
		</div>
	</div>
	<?php
	$incomeDoc_Collected = $result["incomeDocs_collected"];
	if ( $incomeDoc_Collected == 'Y' ) { ?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Income Doc Collected");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			<?php 
			//print_r($result);
			//echo $result["incomeDocs_collected"];
			?>
			<?php echo form()->combo("incomeDoc_Collected", "select incomeDoc_Collected tolong", array('Y'=>'Y','N'=>'N'),'Y',null,'');?></div>
		</div>
	</div>
		
	<?php } else {
		echo form()->hidden('incomeDoc_Collected',NULL,NULL);
	}
	?>
	
	
	</form> 

	<fieldset class="corner" style="margin-bottom:15px; border:0px solid #000;">
		<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
		<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
		<form name="formProductInfo2">
			<div id="Suplementttt">
				<?php
				$arr_header = array(
					"fullname"=> lang("fullname"),
					// "gender" => lang("gender"),
					// "mobilePhoneNo" => lang("mobilePhoneNo"),
					// "CustomerId"=> "Customer Id",
					// "Custno"=> lang("Cust Number"), 
					"Action"=> lang(" Action ")
				);
				$arr_class = array(
					"fullname"=> "content-middle",
					// "gender" => "content-middle",
					// "mobilePhoneNo" => "content-middle",
					// "CustomerId"=> "content-middle",
					// "Custno"=> "content-middle",
					"Action"=> "content-lasted"
				);
			echo	"<table border=0 cellspacing=1 width=\"100%\">".
					"<tr height=\"30\"> ".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
					// "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
			foreach( $arr_header as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
			}
			echo "</tr>";
		
		$arr_num =1; $n = 0;
		if( is_array($frm) ){
			$no = 1;
			$tenor = 0;
			$checkedtenor = NULL;
			foreach( $frm as $num => $rows ){
				$row = new EUI_Object( $rows );
				
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');

				echo	"<tr bgcolor=\"{$back_color}\" style=\"color:black\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>";
						// "<td class=\"content-first\" nowrap>".form()->radio( "key_bill", "content-first", $num, null, array("disabled"=>"disabled"))."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					$numbers = $row->get_value($fields,$arr_function[$fields]);
					
					if(strtolower($fields) == 'action'){
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">
							<button type='button' value='".$num."' onclick='Ext.DOM.deleteSup(this.value)'>Delete</button><button type='button' value='".$num."' onclick='Ext.DOM.editSup(this.value)'>Edit</button></td>";
					}else{
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
					}
				}
				echo "</tr>";
				$no++;
			}
		}
		echo "</table>";
	?>
	</div>
	</form>
</fieldset>


</fieldset>