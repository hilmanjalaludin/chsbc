<script>

Ext.DOM.showTotalAcc2_2nd = function() {
	var addr1=Ext.Cmp('addr1_2nd').getValue();
	var addr2=Ext.Cmp('addr2_2nd').getValue();
	var addr3=Ext.Cmp('addr3_2nd').getValue();
	var addr4=Ext.Cmp('addr4_2nd').getValue();
	var addr5=Ext.Cmp('addr5_2nd').getValue();

	var additional_cc = Ext.Cmp('add2_2nd').getValue();

    if (additional_cc == 0) {
		$('#q1ba_2nd').val("");
		$('#q1ba_2nd').show();
		$('#q1bb_2nd').val("");
		$('#q1bb_2nd').show();
		$('#q1bc_2nd').val("");
		$('#q1bc_2nd').show();
		$('#q1bd_2nd').val("");
		$('#q1bd_2nd').show();
        $('#q1be_2nd').val("");
		$('#q1be_2nd').show();
		
	} else {
		$('#q1ba_2nd').val(addr1);
		$('#q1ba_2nd').show();
		$('#q1bb_2nd').val(addr2);
		$('#q1bb_2nd').show();
		$('#q1bc_2nd').val(addr3);
		$('#q1bc_2nd').show();
		$('#q1bd_2nd').val(addr4);
		$('#q1bd_2nd').show();
        $('#q1be_2nd').val(addr5);
		$('#q1be_2nd').show();
	}
	console.log('Perbahan Alamat 2nd', Ext.Cmp('add2_2nd').getValue());
}

Ext.DOM.showAlamatKantor_2nd = function() {
	var addr1=Ext.Cmp('addr1_2nd').getValue();
	var addr2=Ext.Cmp('addr2_2nd').getValue();
	var addr3=Ext.Cmp('addr3_2nd').getValue();
	var addr4=Ext.Cmp('addr4_2nd').getValue();
	var addr5=Ext.Cmp('addr5_2nd').getValue();

	var p_alamat = Ext.Cmp('p_alamat_2nd').getValue();

    if (p_alamat == 0) {
		$('#q8a_2nd').val("");
		$('#q8b_2nd').val("");
		$('#q8c_2nd').val("");
		$('#q8d_2nd').val("");
		$('#q8e_2nd').val("");
		
	} else {
		$('#q8a_2nd').val(addr1);
		$('#q8a_2nd').show();
		$('#q8b_2nd').val(addr2);
		$('#q8b_2nd').show();
		$('#q8c_2nd').val(addr3);
		$('#q8c_2nd').show();
		$('#q8d_2nd').val(addr4);
		$('#q8d_2nd').show();
        $('#q8e_2nd').val(addr5);
		$('#q8e_2nd').show();
	}
	// console.log('asd', Ext.Cmp('add2').getValue())
}

Ext.DOM.showPajak_2nd = function() {
	var pajak = Ext.Cmp('pajak_2nd').getValue();
    if (pajak == 'Ya') {
		$('#wpajak_2nd').val("");
		$('#wpajak_2nd').show();
		$('#npajak_2nd').val("");
		$('#npajak_2nd').show();
		
		
	} else {
		$('#wpajak_2nd').hide();
		$('#wpajak_2nd').val(0);
		$('#wpajak_2nd').prop("required", true);
		$('#npajak_2nd').hide();
		$('#npajak_2nd').val(0);
		$('#npajak_2nd').prop("required", true);
	}
	console.log('asd', Ext.Cmp('add2').getValue())
}

Ext.DOM.showPekerjaan_2nd = function() {
	var pekerjaan = Ext.Cmp('q5_2nd').getValue();

	if(pekerjaan==11){
		console.log('p',pekerjaan)
		$('#q6_2nd').val('Hasil Usaha');
		$('#q6_2nd').trigger("chosen:updated");
	}else if(pekerjaan==17){
		$('#q6_2nd').val('Gaji');
		$('#q6_2nd').trigger("chosen:updated");
	}else if(pekerjaan==18){
		$('#q6_2nd').val('Gaji');
		$('#q6_2nd').trigger("chosen:updated");
	}else if(pekerjaan==01){
		$('#q6_2nd').val('Hasil Usaha');
		$('#q6_2nd').trigger("chosen:updated");
	}else if(pekerjaan==09){
		$('#q6_2nd').val('Lainnya');
		$('#q6_2nd').trigger("chosen:updated");
	}else if(pekerjaan==10){
		$('#q6_2nd').val('Dana Pensiun');
		$('#q6_2nd').trigger("chosen:updated");
	}else{
		$('#q6_2nd').val('Lainnya');
		$('#q6_2nd').trigger("chosen:updated");
	}
   
}

Ext.DOM.Test_2nd = function () {
    var val = Ext.Cmp('date_addr_2nd').getValue();
    var res =val.substring(6); 
    console.log('val tahun', res);

    var now=new Date();
    var year=now.getFullYear();
    console.log('val tahun2', year);

    var selisih=year-res;
    console.log('val selisih', selisih);

    if(selisih<3){
        console.log('selisih kurang 3');
        $('#t_kota_2nd').val("");
		$('#t_kota_2nd').show();
        $('#t_negara_2nd').val("");
		$('#t_negara_2nd').show();
    }else{
        console.log ('selesih lebih dari 3');
        $('#t_kota_2nd').hide();
		$('#t_kota_2nd').val(0);
		$('#t_kota_2nd').prop("required", true);
        $('#t_negara_2nd').hide();
		$('#t_negara_2nd').val(0);
		$('#t_negara_2nd').prop("required", true);
    }
}



// doc ready 
$(document).ready( function(){
	// alert('2nd');
	var param=[];
	param['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
	var protectedDataSubmitHttp = Ext.EventUrl( new Array('ModSaveActivity','getcddstat'));  
	Ext.Ajax({
		url 	: protectedDataSubmitHttp.Apply(),
		method 	: 'post',
		param  	: Ext.Join([param]).object() ,
		success  : function( xhr ){
			Ext.Util( xhr ).proc(function( data ){
				Ext.Cmp('InputCDD_2nd').setValue(data.data)			
			});
		}
	}).post();
	
	$('#i_card_exp_2nd').mask("00/00", { placeholder: "__/__"});
	$('#date_addr_2nd').mask("00-00-0000", { placeholder: "__-__-____"});

    $('#t_kota_2nd').hide();
    $('#t_kota_2nd').val('');
    $('#t_negara_2nd').hide();
    $('#t_negara_2nd').val('');
    $('#wpajak_2nd').hide();
    $('#wpajak_2nd').val('');
    $('#npajak_2nd').hide();
    $('#npajak_2nd').val('');

    $("#q6_2nd").attr("disabled", "disabled");
	$("#q1ba_2nd").attr("required", true);
	
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
		window.TriggerOpenForm_2nd(); 
	 } catch( error ){
		 console.log( error )
	 }
	 // end 

	 //cek need income status
	 var nis_2nd=Ext.Cmp('nis_2nd').getValue();
	 if (nis_2nd=='N'){
		 $('#income_2nd').hide()
		 $('#q11_2nd').val(0)
	 }else{
		$('#income_2nd').show()
	 }
});

/* saving */
Ext.DOM.submitPost_2nd = function () {
    // firtsquestion
   var CustId=Ext.Cmp('CustomerId_2nd').getValue();
   var Q1=Ext.Cmp('add2_2nd').getValue();
   var Q1ba=Ext.Cmp('q1ba_2nd').getValue();
   var Q1bb=Ext.Cmp('q1bb_2nd').getValue();
   var Q1bc=Ext.Cmp('q1bc_2nd').getValue();
   var Q1bd=Ext.Cmp('q1bd_2nd').getValue();
   var Q1be=Ext.Cmp('q1be_2nd').getValue();
   
   //Second
   var Q2=Ext.Cmp('date_addr_2nd').getValue();
   var Q2a=Ext.Cmp('q2a_2nd').getValue();
   var Q2b=Ext.Cmp('q2b_2nd').getValue();

   //third
   var Q3=Ext.Cmp('pajak_2nd').getValue();
   var Q3a=Ext.Cmp('q3a_2nd').getValue();
   var Q3b=Ext.Cmp('q3b_2nd').getValue();

   //four
   var Q4=Ext.Cmp('q4_2nd').getValue();

   //five
   var Q5=Ext.Cmp('q5_2nd').getValue();

   //six
   var Q6=Ext.Cmp('q6_2nd').getValue();

    //seven
    var Q7=Ext.Cmp('q7_2nd').getValue();

   //eight
    var Q8a=Ext.Cmp('q8a_2nd').getValue();
    var Q8b=Ext.Cmp('q8b_2nd').getValue();
    var Q8c=Ext.Cmp('q8c_2nd').getValue();
    var Q8d=Ext.Cmp('q8d_2nd').getValue();
    var Q8e=Ext.Cmp('q8e_2nd').getValue();

    //nine
    var Q9=Ext.Cmp('q9_2nd').getValue();

    //ten
    var Q10=Ext.Cmp('q10_2nd').getValue();

    //eleven
    var Q11=Ext.Cmp('q11_2nd').getValue();

	var userid=Ext.Cmp('userid_2nd').getValue();
	var p_alamat=Ext.Cmp('p_alamat_2nd').getValue();

	//validasi

	if(Q1==""){
		Ext.Msg("Data Belum LEngakap").Info();
		$('#add2_2nd').focus()
		//Ext.Cmp('q1ba').prop('required',true)
		return false
	}
	if(Q1ba==""){
		Ext.Msg("Address 1 belum terisi").Info();
		$('#q1ba_2nd').focus()
		//Ext.Cmp('q1ba').prop('required',true)
		return false
	}

	if(Q1bb==""){
		Ext.Msg("Address 2 belum terisi").Info();
		$('#q1bb_2nd').focus()
		return false
	}

	if(Q1bc==""){
		Ext.Msg("Address 3 belum terisi").Info();
		$('#q1bc_2nd').focus()
		return false
	}

	if(Q1bd==""){
		Ext.Msg("Address 4 belum terisi").Info();
		$('#q1bd_2nd').focus()
		return false
	}

	if(Q1be==""){
		Ext.Msg("Address 5 belum terisi").Info();
		$('#q1be_2nd').focus()
		return false
	}

	if(Q2==""){
		Ext.Msg("Data belum lengkap").Info();
		$('#date_addr_2nd').focus()
		return false
	}

	var res =Q2.substring(6); 
    var now=new Date();
    var year=now.getFullYear();
	var selisih=year-res;
	
    if(selisih<3){
		if(Q2a==""){
			Ext.Msg("Data Belum Lengkap").Info();
			$('#q2a_2nd').focus()
			return false
		}

		if(Q2b==""){
			Ext.Msg("Data Belum Lengkap").Info();
			$('#q2b_2nd').focus()
			return false
		}
	}

	if(Q3==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#pajak_2nd').focus()
		return false
	}

	if(Q3=="Ya"){
		if(Q3a==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q3a_2nd').focus()
		return false
	}

		if(Q3b==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q3b_2nd').focus()
		return false
	}

	}

	if(Q5==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q5_2nd').focus()
		return false
	}
	if(Q6==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q6_2nd').focus()
		return false
	}

	if(Q7==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q7_2nd').focus()
		return false
	}

	if(Q8a==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8a_2nd').focus()
		return false
	}

	if(Q8b==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8b_2nd').focus()
		return false
	}

	if(Q8c==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8c_2nd').focus()
		return false
	}

	if(Q8d==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8d_2nd').focus()
		return false
	}
	if(Q8e==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q8e_2nd').focus()
		return false
	}

	if(Q9==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q9_2nd').focus()
		return false
	}

	if(Q10==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q10_2nd').focus()
		return false
	}

	if(p_alamat==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#p_alamat_2nd').focus()
		return false
	}

	var nis=Ext.Cmp('nis_2nd').getValue()
	 if (nis=='Y'){
		if(Q11==""){
		Ext.Msg("Data Belum Lengkap").Info();
		$('#q11_2nd').focus()
		return false
		}
	 }
	

    // console.log(Q1,Q1ba,Q1bb,Q1bc,Q1bd,Q1be,Q2,Q2a,Q2b,Q3,Q3a,Q3b,Q4,Q5,Q6,Q7,Q8a,Q8b,Q8c,Q8d,Q8e,Q9,Q10,Q11);

    var Controller = Ext.Cmp('ViewCdd_2nd').getValue();
    console.log('con',Controller)
		var PARAM = [];
        PARAM['CustId_2nd']=CustId;
		PARAM['Q1_2nd']=Q1;
        PARAM['Q1ba_2nd']=Q1ba;
        PARAM['Q1bb_2nd']=Q1bb;
        PARAM['Q1bc_2nd']=Q1bc;
        PARAM['Q1bd_2nd']=Q1bd;
        PARAM['Q1be_2nd']=Q1be;
        PARAM['Q2_2nd']=Q2;
        PARAM['Q2a_2nd']=Q2a;
        PARAM['Q2b_2nd']=Q2b;
        PARAM['Q3_2nd']=Q3;
        PARAM['Q3a_2nd']=Q3a;
        PARAM['Q3b_2nd']=Q3b;
        PARAM['Q4_2nd']=Q4;
        PARAM['Q5_2nd']=Q5;
        PARAM['Q6_2nd']=Q6;
        PARAM['Q7_2nd']=Q7;
        PARAM['Q8a_2nd']=Q8a;
        PARAM['Q8b_2nd']=Q8b;
        PARAM['Q8c_2nd']=Q8c;
        PARAM['Q8d_2nd']=Q8d;
        PARAM['Q8e_2nd']=Q8e;
        PARAM['Q9_2nd']=Q9;
        PARAM['Q10_2nd']=Q10;
        PARAM['Q11_2nd']=Q11;
		PARAM['UserId_2nd']=userid;
    

	
        console.log('url',Ext.Serialize('frm_verification_').getElement());

        Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_cdd_2nd']).Apply(),
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
						Ext.Cmp('InputCDD_2nd').setValue('1')
						$('#product-tabs').removeClass( "ui-state-disabled" )
					}else{
						alert('gagal!');
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
                <h3 style="font-family=verdana;">CDD 2</h3>
			</div>
		</div>
	</div>
	<!--END OF HEADER VERIFICATION-->

	<fieldset class="corner" style="margin-bottom:15px;" >
		<?php echo form()->legend(lang(array('Pertanyaan')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT Alamat -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption">
					<?php echo lang(array('Apakah Alamat Tinggal nya masih samas?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('add2_2nd','select long', array('1'=>'YES','0'=>'NO'), $v_i_additional_cc, array('change'=>'showTotalAcc2_2nd(this.value)'), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<br>
				</div>
			
			</div>
			<!--END Alamat -->

			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				
				<div class="ui-widget-form-cell left">
					<input type="text" name="q1ba_2nd" class="input_text " id="a1_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Perumahan" value="<?=$data->CustomerAddressLine1?>" readonly>
					<input type="text" name="q1ba_2nd" class="input_text " id="q1ba_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Perumahan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">adress line 1 </p>
					<br>
                    <input type="text" name="q1bb_2nd" class="input_text" id="a2_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan" value="<?=$data->CustomerAddressLine2?>" readonly>
					<input type="text" name="q1bb_2nd" class="input_text" id="q1bb_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 2</p>
					<br>
					<input type="text" name="q1bc_2nd" class="input_text " id="a3_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota"value="<?=$data->CustomerAddressLine3?>" readonly>
					<input type="text" name="q1bc_2nd" class="input_text " id="q1bc_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 3</p>
					<br>
					<input type="text" name="q1bd_2nd" class="input_text" id="a4_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara"value="<?= preg_replace("/[^a-zA-Z ]/", '', $data->CustomerAddressLine4)?>" readonly>
					<input type="text" name="q1bd_2nd" class="input_text" id="q1bd_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 4</p>
					<br>
					<input type="text" name="q1be_2nd" class="input_text" id="a5_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos"value="<?=preg_replace("/[^0-9]/", '', $data->CustomerAddressLine4) ?>" readonly>
					<input type="text" name="q1be_2nd" class="input_text" id="q1be_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 5</p>
				</div>
			
			</div> 


			<!-- input hidden param -->
			<input type="hidden" id="addr1_2nd" value="<?= $data->CustomerAddressLine1?>">
			<input type="hidden" id="addr2_2nd" value="<?= $data->CustomerAddressLine2?>">
			<input type="hidden" id="addr3_2nd" value="<?= $data->CustomerAddressLine3?>">
			<input type="hidden" id="addr4_2nd" value="<?= preg_replace("/[^a-zA-Z ]/", '', $data->CustomerAddressLine4)?>">
			<input type="hidden" id="addr5_2nd" value="<?= preg_replace("/[^0-9]/", '', $data->CustomerAddressLine4)?>">
			<input type="hidden" id="userid_2nd" value="<?=lang(array(_get_session('UserId')))?>">
			<input type="hidden" id="nis_2nd" value="<?php echo $nis->Need_Update_Income?>">


			<!--INPUT EXPIRY DATE CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sejak Kapan Tinggal di Alamat Yang Sekarang '));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
                <input type="text" name="date_addr_2nd" id="date_addr_2nd" class="input_text long" value="" placeholder="__-__-____" onchange="Test_2nd()">
				</div>
			</div>
            <!--END OF EXPIRY DATE CC-->

              <!--INPUT Kota-->
                <div class="ui-widget-form-row baris-1" id="t_kota_2nd">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sebelumnya tinggal di kota apa'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q2a_2nd" class="input_text " value="" placeholder="Silahkan Di isi" id="q2a_2nd">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

            <!--INPUT Kota-->
            <div class="ui-widget-form-row baris-1" id="t_negara_2nd">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sebelumnya tinggal di negara apa'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q2b_2nd" class="input_text " value="" placeholder="Silahkan Di isi"  id="q2b_2nd">
				</div>
				
			</div>
            <!--END OF INPUT Rekening-->
            
            <!-- Start pajak -->
            <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Apakah terdaftar sebagai wajib pajak negara lain?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('pajak_2nd','select long', array('Ya'=>'Ya','Tidak'=>'Tidak'), $v_i_additional_cc, array("change"=>"showPajak_2nd()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
            </div>
            
                <!--INPUT pajak2-->
                <div class="ui-widget-form-row baris-1" id="wpajak_2nd">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Terdaftar sebagai wajib pajak negara apa?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q3a_2nd" class="input_text " value="" placeholder="Silahkan Di isi" id="q3a_2nd">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

            <!--INPUT pajak2-->
            <div class="ui-widget-form-row baris-1" id="npajak_2nd">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nomor wajib pajak negara lain?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q3b_2nd" class="input_text " value="" placeholder="Silahkan Di isi" id="q3b_2nd">
				</div>
			</div>
            <!--END OF INPUT Rekening-->

			<!--INPUT Rekening-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tujuan Pembukaan Rekening'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q4_2nd" class="input_text long " value="Untuk pembayaran produk pinjaman" placeholder="Silahkan Di isi"  id="q4_2nd" readonly style="width:200px">
				</div>	
			</div>
            <!--END OF INPUT Rekening-->
            
            <!--INPUT Pekerjaan-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Pekerjaan'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('q5_2nd','select long', array('11'=>' 11 Self-Employed','17'=>'17 SALARIED - STAFF & MANAGER  ','18'=>'18 SALARIED - DIRECTOR, COMMISIONER ','01'=>'01 PROFESSIONAL','09'=>'09 NOT WORKING – HOUSEWIFE','10'=>'10 NOT WORKING – RETIRED','16'=>'16 OTHER'), $v_i_additional_cc, array("change"=>"showPekerjaan_2nd()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
                   
				</div>
				
			</div>
			 
            <!--END OF INPUT Pekerjaan->
            
              <!--INPUT ADDITIONAL CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sumber Penghasilan untuk pembayaran pinjaman'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('q6_2nd','select long chosen-container chosen-container-single', array('Gaji'=>'Gaji','Hasil Usaha'=>'Hasil Usaha','Dana Pensiun'=>'Dana Pensiun','Lainnya'=>'Lainnya'), $v_i_additional_cc, array("change"=>"showSumber_2nd()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
				
			</div>
			<!--END OF INPUT ADDITIONAL CC-->

        <!--INPUT Nama Perusahaan-->
        <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nama Perusahaan'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q7_2nd" class="input_text " value="" placeholder="Silahkan Di isi" id="q7_2nd">
				</div>
				
			</div>
            <!--END OF INPUT Rekening-->

			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Apakah Alamat kantor anda sama dengan alamat rumah'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('p_alamat_2nd','select long chosen-container chosen-container-single', array('1'=>'Ya','0'=>'Tidak'), $v_i_additional_cc, array("change"=>"showAlamatKantor_2nd()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
				</div>
				
			</div>

             <!--INPUT Alamat-->
        <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Alamat Kantor'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
                    <input type="text" name="q8a_2nd" class="input_text " id="q8a_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Gedung">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 1</p>
				</div>
				
			</div>
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q8b_2nd" class="input_text " id="q8b_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Jalan">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 2</p>
					<br>
                    <input type="text" name="q8c_2nd" class="input_text " id="q8c_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Kota">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 3</p>
					<br>
					<input type="text" name="q8d_2nd" class="input_text " id="q8d_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="Nama Negara">
					<p style="display:inline-block;margin-left:2pt;font-size:12pt;color:red">address line 4</p>
					<br>
					<input type="text" name="q8e_2nd" class="input_text " id="q8e_2nd"  style="width:200px;padding-left:10px;display:inline-block;margin-top:10px" placeholder="KodePos">
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
					<input type="text" name="q9_2nd" class="input_text " value="" placeholder="Silahkan Di isi" id="q9_2nd"  style="padding-left:10px;width:180px" >
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
					<input type="text" name="q10_2nd" class="input_text long " value="" placeholder="Silahkan Di isi" id="q10_2nd" style="padding-left:10px;">
				</div>
			
			</div>
            <!--END OF Jenis Usaha-->

             <!--INPUT Income Pertahun-->
             <div class="ui-widget-form-row baris-1" id="income_2nd">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Income Pertahun'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="q11_2nd" class="input_text numeric" value="" placeholder="Silahkan Di isi" id="q11_2nd">
				</div>
				
			</div>
            <!--END OF Jenis Usaha-->

            <div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell left">
                <button style="color: #fff !important;text-transform:uppercase;text-decoration: none;background: #ed3330;padding: 10px;border-radius: 5px;display:block;border: none;transition: all 0.4s ease 0s;x;float:right" onclick="Ext.DOM.submitPost_2nd()">Submit</button>
				</div>
				
			</div>

		
        </div>
        <!-- End Table compact -->
	</fieldset>

<!-- </form> -->