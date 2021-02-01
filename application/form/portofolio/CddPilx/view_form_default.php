<script>

window.TriggerOpenForm = function() {	
	var verResultData = Ext.Cmp('ver_status').getValue();
		// console.log( window.sprintf("ver_status : %s", verResultData));
		
	if( verResultData == '2' ) {
		// rejected
		var row = Ext.Json( "SrcCustomerList/get_reject_status", {
			verResultData : verResultData	
		});
		
		// ini adalah ambil row jika sucess data 
		// return json .
		row.dataItemEach(function( rs, xh, ro ){
			// console.log( rs );
			ro.Cmp('CallStatus').setValue(rs.RESULT);
			ro.Cmp('CallResult').setValue(rs.STATUS);
		});
		
	// kemudian set data berikut ini untuk validasi 
	// data2 tersebut .
	
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true); 
		Ext.DOM.initFunc.isCallPhone = true;
		Ext.DOM.initFunc.isDial 	 = false;
		Ext.DOM.initFunc.isRunCall 	 = false;
		Ext.DOM.initFunc.isCancel 	 = false;
	}
	
	
	// kemudian set juga untuk mal function form .
	// test .
	Ext.Cmp('VerifForm').setValue( verResultData );
	if( verResultData == '1' ){
		$("#tabs").mytab().tabs().tabs("option", "disabled", []);
	}
}

$(document).ready( function(){
	var param=[];
	param['CustomerId'] = Ext.Cmp('CustomerId').getValue();
	var protectedDataSubmitHttp = Ext.EventUrl( new Array('ModSaveActivity','getcddstat'));  
	Ext.Ajax({
		url 	: protectedDataSubmitHttp.Apply(),
		method 	: 'post',
		param  	: Ext.Join([param]).object() ,
		success  : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				Ext.Cmp('InputCDD').setValue(data.data)			
			});
		}
	}).post();

	$('#i_card_exp').mask("00/00", { placeholder: "__/__"});
	$('#date_addr').mask("00-00-0000", { placeholder: "__-__-____"});

    $('#t_kota').hide();
    $('#t_kota').val('');
    $('#t_negara').hide();
    $('#t_negara').val('');
    $('#wpajak').hide();
    $('#wpajak').val('');
    $('#npajak').hide();
    $('#npajak').val('');

    $("#q6").attr("disabled", "disabled");
	$("#q1ba").attr("required", true);
	
	$(".money").keyup(function(){
		var id = $(this).attr('id'),
			text = Ext.Cmp(id).getValue();
			
		if(text!=''){
			text = Ext.Money(text).ToInt();
			Ext.Cmp(id).setValue(Ext.Money(text).ToRupiah());
		}
		else{
			Ext.Cmp(id).setValue(0);
		}
	});
	
	$(".numeric").keyup(function(){
		var id = $(this).attr('id');
		var text = Ext.Cmp(id).getValue();
		
		if(text!=''){
			text = Ext.Money(text).ToNumeric();
			Ext.Cmp(id).setValue(text);
		}
	});
	
	// cek apakah ini adalah content funsi jika ya tampilkan 
	 try{
		window.TriggerOpenForm(); 
	 } catch( error ){
		 console.log("error trigger :"+ error )
	 }
	 // end 

	 //cek need income status
	 var nis=Ext.Cmp('nis').getValue()
	 if (nis=='N'){
		 $('#income').hide()
		 $('#q11').val(0)
	 }else{
		$('#income').show()
	 }
});

Ext.DOM.showTotalAcc2 = function() {
	var addr1=Ext.Cmp('addr1').getValue();
	var addr2=Ext.Cmp('addr2').getValue();
	var addr3=Ext.Cmp('addr3').getValue();
	var addr4=Ext.Cmp('addr4').getValue();
	var addr5=Ext.Cmp('addr5').getValue();

	var additional_cc = Ext.Cmp('add2').getValue();

    if (additional_cc == 0) {
		$('#q1ba').val("");
		$('#q1ba').show();
		$('#q1bb').val("");
		$('#q1bb').show();
		$('#q1bc').val("");
		$('#q1bc').show();
		$('#q1bd').val("");
		$('#q1bd').show();
        $('#q1be').val("");
		$('#q1be').show();
		
	} else {
		$('#q1ba').val(addr1);
		$('#q1ba').show();
		$('#q1bb').val(addr2);
		$('#q1bb').show();
		$('#q1bc').val(addr3);
		$('#q1bc').show();
		$('#q1bd').val(addr4);
		$('#q1bd').show();
        $('#q1be').val(addr5);
		$('#q1be').show();
	}
	console.log('Perbahan Alamat', Ext.Cmp('add2').getValue());
}

Ext.DOM.showAlamatKantor = function() {
	var addr1=Ext.Cmp('addr1').getValue();
	var addr2=Ext.Cmp('addr2').getValue();
	var addr3=Ext.Cmp('addr3').getValue();
	var addr4=Ext.Cmp('addr4').getValue();
	var addr5=Ext.Cmp('addr5').getValue();

	var p_alamat = Ext.Cmp('p_alamat').getValue();

    if (p_alamat == 0) {
		$('#q8a').val("");
		$('#q8b').val("");
		$('#q8c').val("");
		$('#q8d').val("");
		$('#q8e').val("");
		
	} else {
		$('#q8a').val(addr1);
		$('#q8a').show();
		$('#q8b').val(addr2);
		$('#q8b').show();
		$('#q8c').val(addr3);
		$('#q8c').show();
		$('#q8d').val(addr4);
		$('#q8d').show();
        $('#q8e').val(addr5);
		$('#q8e').show();
	}
	// console.log('asd', Ext.Cmp('add2').getValue())
}

Ext.DOM.showPajak = function() {
	var pajak = Ext.Cmp('pajak').getValue();
    if (pajak == 'Ya') {
		$('#wpajak').val("");
		$('#wpajak').show();
		$('#npajak').val("");
		$('#npajak').show();
	} else {
		$('#wpajak').hide();
		$('#wpajak').val(0);
		$('#wpajak').prop("required", true);
		$('#npajak').hide();
		$('#npajak').val(0);
		$('#npajak').prop("required", true);
	}
	// console.log('asd', Ext.Cmp('add2').getValue())
}

Ext.DOM.showPekerjaan = function() {
	var pekerjaan = Ext.Cmp('q5').getValue();

	if(pekerjaan==11){
		console.log('p',pekerjaan)
		$('#q6').val('Hasil Usaha');
		$('#q6').trigger("chosen:updated");
	}else if(pekerjaan==17){
		$('#q6').val('Gaji');
		$('#q6').trigger("chosen:updated");
	}else if(pekerjaan==18){
		$('#q6').val('Gaji');
		$('#q6').trigger("chosen:updated");
	}else if(pekerjaan==01){
		$('#q6').val('Hasil Usaha');
		$('#q6').trigger("chosen:updated");
	}else if(pekerjaan==09){
		$('#q6').val('Lainnya');
		$('#q6').trigger("chosen:updated");
	}else if(pekerjaan==10){
		$('#q6').val('Dana Pensiun');
		$('#q6').trigger("chosen:updated");
	}else{
		$('#q6').val('Lainnya');
		$('#q6').trigger("chosen:updated");
	}
   
}

Ext.DOM.Test = function () {
    var val = Ext.Cmp('date_addr').getValue();
    var res =val.substring(6); 
    // console.log('val tahun', res);

    var now=new Date();
    var year=now.getFullYear();
    // console.log('val tahun2', year);

    var selisih=year-res;
    // console.log('val selisih', selisih);

    if(selisih<3){
        // console.log('selisih kurang 3');
        $('#t_kota').val("");
		$('#t_kota').show();
        $('#t_negara').val("");
		$('#t_negara').show();
    }else{
        // console.log ('selesih lebih dari 3');
        $('#t_kota').hide();
		$('#t_kota').val(0);
		$('#t_kota').prop("required", true);
        $('#t_negara').hide();
		$('#t_negara').val(0);
		$('#t_negara').prop("required", true);
    }
}

Ext.DOM.submitPost = function () {
    // firtsquestion
   var CustId=Ext.Cmp('CustomerId').getValue();
   var Q1=Ext.Cmp('add2').getValue();
   var Q1ba=Ext.Cmp('q1ba').getValue();
   var Q1bb=Ext.Cmp('q1bb').getValue();
   var Q1bc=Ext.Cmp('q1bc').getValue();
   var Q1bd=Ext.Cmp('q1bd').getValue();
   var Q1be=Ext.Cmp('q1be').getValue();
   
   //Second
   var Q2=Ext.Cmp('date_addr').getValue();
   var Q2a=Ext.Cmp('q2a').getValue();
   var Q2b=Ext.Cmp('q2b').getValue();

   //third
   var Q3=Ext.Cmp('pajak').getValue();
   var Q3a=Ext.Cmp('q3a').getValue();
   var Q3b=Ext.Cmp('q3b').getValue();

   //four
   var Q4=Ext.Cmp('q4').getValue();

   //five
   var Q5=Ext.Cmp('q5').getValue();

   //six
   var Q6=Ext.Cmp('q6').getValue();

    //seven
    var Q7=Ext.Cmp('q7').getValue();

   //eight
 
    var Q8a=Ext.Cmp('q8a').getValue();
    var Q8b=Ext.Cmp('q8b').getValue();
    var Q8c=Ext.Cmp('q8c').getValue();
    var Q8d=Ext.Cmp('q8d').getValue();
    var Q8e=Ext.Cmp('q8e').getValue();

    //nine
    var Q9=Ext.Cmp('q9').getValue();

    //ten
    var Q10=Ext.Cmp('q10').getValue();

    //eleven
    var Q11=Ext.Cmp('q11').getValue();

	var userid=Ext.Cmp('userid').getValue();
	var p_alamat=Ext.Cmp('p_alamat').getValue();

	//validasi

	if(Q1==""){
		Ext.Msg("Data Belum LEngakap").Info();
		$('#add2').focus()
		//Ext.Cmp('q1ba').prop('required',true)
		return false
	}
	if(Q1ba==""){
		Ext.Msg("Address 1 belum terisi").Info();
		$('#q1ba').focus()
		//Ext.Cmp('q1ba').prop('required',true)
		return false
	}

	if(Q1bb==""){
		Ext.Msg("Address 2 belum terisi").Info();
		$('#q1bb').focus()
		return false
	}

	if(Q1bc==""){
		Ext.Msg("Address 3 belum terisi").Info();
		$('#q1bc').focus()
		return false
	}

	if(Q1bd==""){
		Ext.Msg("Address 4 belum terisi").Info();
		$('#q1bd').focus()
		return false
	}

	if(Q1be==""){
		Ext.Msg("Address 5 belum terisi").Info();
		$('#q1be').focus()
		return false
	}

	if(Q2==""){
		Ext.Msg("Data belum lengkap").Info();
		$('#date_addr').focus()
		return false
	}

	var res =Q2.substring(6); 
    var now=new Date();
    var year=now.getFullYear();
	var selisih=year-res;
	
    if(selisih<3){
		if(Q2a==""){
			Ext.Msg("Data Belum Lengkap").Info();
			$('#q2a').focus()
			return false
		}

		if(Q2b==""){
			Ext.Msg("Data Belum Lengkap").Info();
			$('#q2b').focus()
			return false
		}
	}

	if(Q3==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#pajak').focus()
		return false
	}

	if(Q3=="Ya"){
		if(Q3a==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q3a').focus()
		return false
	}

		if(Q3b==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q3b').focus()
		return false
	}

	}

	if(Q5==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q5').focus()
		return false
	}
	if(Q6==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q6').focus()
		return false
	}

	if(Q7==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q7').focus()
		return false
	}

	if(Q8a==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8a').focus()
		return false
	}

	if(Q8b==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8b').focus()
		return false
	}

	if(Q8c==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8c').focus()
		return false
	}

	if(Q8d==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8d').focus()
		return false
	}
	if(Q8e==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8e').focus()
		return false
	}

	if(Q9==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q9').focus()
		return false
	}

	if(Q10==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q10').focus()
		return false
	}

	if(p_alamat==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#p_alamat').focus()
		return false
	}

	var nis=Ext.Cmp('nis').getValue()
	 if (nis=='Y'){
		if(Q11==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q11').focus()
		return false
		}
	 }
	

    // console.log(Q1,Q1ba,Q1bb,Q1bc,Q1bd,Q1be,Q2,Q2a,Q2b,Q3,Q3a,Q3b,Q4,Q5,Q6,Q7,Q8a,Q8b,Q8c,Q8d,Q8e,Q9,Q10,Q11);

    var Controller = Ext.Cmp('ViewCdd').getValue();
    // console.log('con',Controller)
		var PARAM = [];
        PARAM['CustId']=CustId;
		PARAM['Q1']=Q1;
        PARAM['Q1ba']=Q1ba;
        PARAM['Q1bb']=Q1bb;
        PARAM['Q1bc']=Q1bc;
        PARAM['Q1bd']=Q1bd;
        PARAM['Q1be']=Q1be;
        PARAM['Q2']=Q2;
        PARAM['Q2a']=Q2a;
        PARAM['Q2b']=Q2b;
        PARAM['Q3']=Q3;
        PARAM['Q3a']=Q3a;
        PARAM['Q3b']=Q3b;
        PARAM['Q4']=Q4;
        PARAM['Q5']=Q5;
        PARAM['Q6']=Q6;
        PARAM['Q7']=Q7;
		PARAM['Q8']=p_alamat;
        PARAM['Q8a']=Q8a;
        PARAM['Q8b']=Q8b;
        PARAM['Q8c']=Q8c;
        PARAM['Q8d']=Q8d;
        PARAM['Q8e']=Q8e;
        PARAM['Q9']=Q9;
        PARAM['Q10']=Q10;
        PARAM['Q11']=Q11;
		PARAM['UserId']=userid;
    

	
        // console.log('url',Ext.Serialize('frm_verification_').getElement());

        Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_cdd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					// Ext.Serialize('frm_verification_').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					if(save.success == 1){
						alert('Data Berhasil Ditambah!!')
						Ext.Cmp('InputCDD').setValue('1')
						$('#product-tabs').removeClass( "ui-state-disabled" )
					}else{
						alert('Data CDD sudah Pernah Terdaftar!');
					}
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
}

</script>
<?php
$_urut_a = (isset($urutan['A'][1])?null:array('disabled'=>true));
$_urut_b = (isset($urutan['B'][1])?null:array('disabled'=>true));

$_klik_a = (isset($urutan['A'][1])?null:'style="pointer-events:none;cursor:default;"');
$_klik_b = (isset($urutan['B'][1])?null:'style="pointer-events:none;cursor:default;"');
?>
<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
<!-- <form id="frm_verification_"> -->
	<!--HEADER VERIFICATION-->
	<div style="margin-bottom:15px;margin-top:-10px;">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
                <h1 style="font-family=verdana;">CDD</h1>
			</div>
		</div>
	</div>
	<!--END OF HEADER VERIFICATION-->

	<fieldset class="corner" style="margin-bottom:15px;" >
		<?php echo form()->legend(lang(array('Pertanyaan')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT Alamat -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Apakah Alamat Tinggal nya masih sama?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('add2','select long', array('1'=>'YES','0'=>'NO'), $v_i_additional_cc, array("change"=>"showTotalAcc2()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<br>
				</div>
			
			</div>
			<!--END Alamat -->

			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				
				<div class="ui-widget-form-cell left">
					<input type="text" name="q1ba" class="input_text " id="a1"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Perumahan" value="<?=$data->CustomerAddressLine1?>" readonly>
					<input type="text" name="q1ba" class="input_text " id="q1ba"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Perumahan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">adress line 1 </p>
					<br>
                    <input type="text" name="q1bb" class="input_text" id="a2"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan" value="<?=$data->CustomerAddressLine2?>" readonly>
					<input type="text" name="q1bb" class="input_text" id="q1bb"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 2</p>
					<br>
					<input type="text" name="q1bc" class="input_text " id="a3"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota"value="<?=$data->CustomerAddressLine3?>" readonly>
					<input type="text" name="q1bc" class="input_text " id="q1bc"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 3</p>
					<br>
					<input type="text" name="q1bd" class="input_text" id="a4"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara"value="<?= preg_replace("/[^a-zA-Z ]/", '', $data->CustomerAddressLine4)?>" readonly>
					<input type="text" name="q1bd" class="input_text" id="q1bd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 4</p>
					<br>
					<input type="text" name="q1be" class="input_text" id="a5"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos"value="<?=preg_replace("/[^0-9]/", '', $data->CustomerAddressLine4) ?>" readonly>
					<input type="text" name="q1be" class="input_text" id="q1be"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 5</p>
				</div>
			
			</div> 


			<!-- input hidden param -->
			<input type="hidden" id="addr1" value="<?= $data->CustomerAddressLine1?>">
			<input type="hidden" id="addr2" value="<?= $data->CustomerAddressLine2?>">
			<input type="hidden" id="addr3" value="<?= $data->CustomerAddressLine3?>">
			<input type="hidden" id="addr4" value="<?= preg_replace("/[^a-zA-Z ]/", '', $data->CustomerAddressLine4)?>">
			<input type="hidden" id="addr5" value="<?= preg_replace("/[^0-9]/", '', $data->CustomerAddressLine4)?>">
			<input type="hidden" id="userid" value="<?=lang(array(_get_session('UserId')))?>">
			<input type="hidden" id="nis" value="<?php echo $nis->Need_Update_Income?>">


			<!--INPUT EXPIRY DATE CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sejak Kapan Tinggal di Alamat Yang Sekarang '));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
                <input type="text" name="date_addr" id="date_addr" class="input_text long" value="" placeholder="__-__-____" onchange="Test()">
				</div>
			</div>
            <!--END OF EXPIRY DATE CC-->

              <!--INPUT Kota-->
                <div class="ui-widget-form-row baris-1" id="t_kota">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sebelumnya tinggal di kota apa'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q2a" class="input_text " value="" placeholder="Silahkan Di isi" id="q2a">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

            <!--INPUT Kota-->
            <div class="ui-widget-form-row baris-1" id="t_negara">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sebelumnya tinggal di negara apa'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q2b" class="input_text " value="" placeholder="Silahkan Di isi"  id="q2b">
				</div>
				
			</div>
            <!--END OF INPUT Rekening-->
            
            <!-- Start pajak -->
            <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Apakah terdaftar sebagai wajib pajak negara lain?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('pajak','select long', array('Ya'=>'Ya','Tidak'=>'Tidak'), $v_i_additional_cc, array("change"=>"showPajak()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
            </div>
            
                <!--INPUT pajak2-->
                <div class="ui-widget-form-row baris-1" id="wpajak">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Terdaftar sebagai wajib pajak negara apa?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q3a" class="input_text " value="" placeholder="Silahkan Di isi" id="q3a">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

            <!--INPUT pajak2-->
            <div class="ui-widget-form-row baris-1" id="npajak">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nomor wajib pajak negara lain?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q3b" class="input_text " value="" placeholder="Silahkan Di isi" id="q3b">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

			<!--INPUT Rekening-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tujuan Pembukaan Rekening'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q4" class="input_text long " value="Untuk pembayaran produk pinjaman" placeholder="Silahkan Di isi"  id="q4" readonly style="width:200px">
				</div>	
			</div>
            <!--END OF INPUT Rekening-->
            
            <!--INPUT Pekerjaan-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Pekerjaan'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('q5','select long', array('11'=>' 11 Self-Employed','17'=>'17 SALARIED - STAFF & MANAGER  ','18'=>'18 SALARIED - DIRECTOR, COMMISIONER ','01'=>'01 PROFESSIONAL','09'=>'09 NOT WORKING – HOUSEWIFE','10'=>'10 NOT WORKING – RETIRED','16'=>'16 OTHER'), $v_i_additional_cc, array("change"=>"showPekerjaan()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
                   
				</div>
				
			</div>
			 
            <!--END OF INPUT Pekerjaan->
            
              <!--INPUT ADDITIONAL CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sumber Penghasilan untuk pembayaran pinjaman'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('q6','select long chosen-container chosen-container-single', array('Gaji'=>'Gaji','Hasil Usaha'=>'Hasil Usaha','Dana Pensiun'=>'Dana Pensiun','Lainnya'=>'Lainnya'), $v_i_additional_cc, array("change"=>"showSumber()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
				
			</div>
			<!--END OF INPUT ADDITIONAL CC-->

        <!--INPUT Nama Perusahaan-->
        <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nama Perusahaan'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q7" class="input_text " value="" placeholder="Silahkan Di isi" id="q7">
				</div>
				
			</div>
            <!--END OF INPUT Rekening-->

			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Apakah Alamat kantor anda sama dengan alamat rumah'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('p_alamat','select long chosen-container chosen-container-single', array('1'=>'Ya','0'=>'Tidak'), $v_i_additional_cc, array("change"=>"showAlamatKantor()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
				
			</div>

             <!--INPUT Alamat-->
        <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Alamat Kantor'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
                    <input type="text" name="q8a" class="input_text " id="q8a"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Gedung">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 1</p>
				</div>
				
			</div>
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q8b" class="input_text " id="q8b"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 2</p>
					<br>
                    <input type="text" name="q8c" class="input_text " id="q8c"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 3</p>
					<br>
					<input type="text" name="q8d" class="input_text " id="q8d"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 4</p>
					<br>
					<input type="text" name="q8e" class="input_text " id="q8e"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 5</p>
					<br>
				</div>
				
			</div>
            <!--END OF INPUT alamat-->

		

			 <!--INPUT Jabatan -->
             <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Jabatan'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
				<select name="" id="" disabled="true" class="select long">
				<option value="other">Other</option>
				</select>
					<input type="text" name="q9" class="input_text " value="" placeholder="Silahkan Di isi" id="q9"  style="padding-left:10px;width:180px" >
				</div>
				
			</div>
            <!--END OF Jabatan-->

             <!--INPUT Jenis usaha-->
             
             <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Jenis Usaha'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
				<select name="" id="" disabled="true" class="select long">
				<option value="lainnya">Lainnya</option>
				</select>
					<input type="text" name="q10" class="input_text long " value="" placeholder="Silahkan Di isi" id="q10" style="padding-left:10px;">
				</div>
			
			</div>
            <!--END OF Jenis Usaha-->

             <!--INPUT Income Pertahun-->
             <div class="ui-widget-form-row baris-1" id="income">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Income Pertahun'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q11" class="input_text numeric" value="" placeholder="Silahkan Di isi" id="q11">
				</div>
				
			</div>
            <!--END OF Jenis Usaha-->

            <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell left">
                <button style="color: #fff !important;text-transform:uppercase;text-decoration: none;background: #ed3330;padding: 10px;border-radius: 5px;display:block;border: none;transition: all 0.4s ease 0s;x;float:right" onclick="Ext.DOM.submitPost()">Submit</button>
				</div>
				
			</div>

		
        </div>
        <!-- End Table compact -->
	</fieldset>

<!-- </form> -->
