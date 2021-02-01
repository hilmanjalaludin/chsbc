

    <script>
    /*
    * Enigma User Interface
    *
    * An open source application development framework for Web 2.0 or newer
    *
    * @package Enigma User Interface *.js
    * @author ExpressionEngine Dev Team
    * @copyright Copyright (c) 2008 - 2017, razaki, Inc.
    * @license http://razakitechnology.com/user_guide/license.html
    * @link http://razakitechnology.com
    * @since Version 1.3.20
    * @filesource
    */
    // ----------------------------------------------------------------------------------------
     
    Ext.DOM.getLoan_2nd = function(val){
    console.log('## getLoan_2nd');
    var CustomerId = Ext.Cmp('CustomerId_2nd').getValue(),
    protectData = Ext.EventUrl( new Array('ProductInfoFlexi','getLoanPerVariable') );
    // please overider by spiner plugin dont event by ext.Ajax
    // cause have the "bugs ", load not perfected .
    // will be cache not clear .
    // $('#loans').Spiner ({
    $('.loan-flexi').Spiner ({
    url : protectData.Apply(),
    method : 'GET',
    param : {
    loansvar : val,
    CustomerId:CustomerId,
    },
    complete : function( protectedHtml ){
    $( protectedHtml ).css({ "height" : "100%", "padding-left" : "4px" });
    // this must be selector replace by html
    // class jQuery.
    }
    });
    }
     
    Ext.DOM.openCoverage_2nd = function( xselltype=0 ){
    if(xselltype=='NO'){
    Ext.Cmp('vartiering_2nd').disabled(true);
    Ext.Cmp('benefname_2nd').disabled(true);
    Ext.Cmp('benefbank_2nd').disabled(true);
    Ext.Cmp('benefaccount_2nd').disabled(true);
    Ext.Cmp('benefbranch_2nd').disabled(true);
     
    if( !Ext.Cmp('key_tenor_2nd').IsNull() ) {
    Ext.Cmp('key_tenor_2nd').disabled(true);
    }
    }
    else{
    Ext.Cmp('vartiering_2nd').disabled(false);
    Ext.Cmp('benefname_2nd').disabled(false);
    Ext.Cmp('benefbank_2nd').disabled(false);
    Ext.Cmp('benefaccount_2nd').disabled(false);
    Ext.Cmp('benefbranch_2nd').disabled(false);
    Ext.Cmp('addressVerif_2nd').disabled(false);
     
    if( !Ext.Cmp('key_tenor_2nd').IsNull() ) {
    Ext.Cmp('key_tenor_2nd').disabled(false);
    }
     
    }
    }
     
    $(document).ready(function() {
     
     
    $("#tnc2nd").change(function() {
     
    var value = $(this).val()
     
    if(value=='NO'){
    Ext.Cmp('tnc2_2nd').disabled(true);
    document.getElementById("tnc2_2nd").value = "";
    }else if (value=='YES'){
    var ScriptId = '9';
    var WindowScript = new Ext.Window
    ({
    url : Ext.EventUrl(['SetProductScript','ShowProductScripttnc']).Apply(),
    name : 'WinProduct',
    height : ($(window).innerHeight()),
    width : ($(window).innerWidth() - ( $(window).innerWidth()/2 )),
    left : ($(window).innerWidth()/2),
    top : ($(window).innerHeight()/2),
    param : {
    ScriptId : ScriptId,
    Time : Ext.Date().getDuration()
    }
    }).newtab();
     
    // if( ScriptId =='' ) {
    // window.close();
    // }
    Ext.Cmp('tnc2_2nd').disabled(false);
    //Ext.Cmp('tnc2').value('TNC');
    document.getElementById("tnc2_2nd").value = "TNC";
    }else{
    Ext.Cmp('tnc2_2nd').disabled(true);
    }
    })
     
     
     
    $("#benefbank_2nd").change(function(){
    var valueBenef = $(this).val(),
    BenefAccounts = $("#benefaccount_2nd"),
    protectDataSendurl = Ext.EventUrl( new Array('SrcCustomerList','getDigitBank', valueBenef) );
     
    // Ext.DOM.INDEX + "/SrcCustomerList/getDigitBank/" + valueBenef;
     
    var getDigit = {
    url : protectDataSendurl.Apply() ,
    type : "POST" ,
    dataType : 'json' ,
    success : function (digit) {
     
    console.log(digit);
     
    var MinDigit = digit.minlength;
    var MaxDigit = digit.maxlength;
     
    $(BenefAccounts).attr('minlength',MinDigit);
    $(BenefAccounts).attr('maxlength',MaxDigit);
    }
    };
     
    $.ajax(getDigit);
    });
     
    $("#benefaccount_2nd").keydown(function (e) {
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
     
    $('#benefname_2nd').bind("cut copy paste",function(e) {
    e.preventDefault();
    });
    $('#benefaccount_2nd').bind("cut copy paste",function(e) {
    e.preventDefault();
    });
    $('#benefbranch_2nd').bind("cut copy paste",function(e) {
    e.preventDefault();
    });
     
    // disabled on here data process
    // Ext.DOM.getVerificationStatus_2nd();
    Ext.Cmp('vartiering_2nd').disabled(true);
    Ext.Cmp('benefname_2nd').disabled(true);
    Ext.Cmp('benefbank_2nd').disabled(true);
    Ext.Cmp('benefaccount_2nd').disabled(true);
    Ext.Cmp('benefbranch_2nd').disabled(true);
    Ext.Cmp('NewBillingAddress').disabled(true);
    Ext.Cmp('addressVerif_2nd').disabled(true);
     
    if( !Ext.Cmp('key_tenor_2nd').IsNull() ) {
    Ext.Cmp('key_tenor_2nd').disabled(true);
    }
    });
     
    Ext.DOM.getVerificationStatus_2nd = function (callback){
    var CustomerId = Ext.Cmp('CustomerId_2nd').getValue();
    //console.log('flexi string');
    Ext.Ajax({
    url : Ext.EventUrl(new Array('ProductInfoFlexi', 'getVerificationStatus')).Apply(),
    method :'POST',
    param :{CustomerId:CustomerId},
    ERROR : function(fn){
    Ext.Util(fn).proc(function(Result){
    // console.log("Result test :"+Result.ver_result);
    // if(Result.ver_result==1){
    // // $('#ButtonUserSave').show()
    // }else{
    // // $('#ButtonUserSave').hide()
    // }
    callback(Result.ver_result);
    });
    }
    }).post();
    }
     
     
     
    Ext.DOM.Fallback2_nd = function (verification){
    //console.log('Fallback');
    if(verification > 0){
    Ext.DOM.saveProductInfoFlexi();
    }else{
    alert('Verifikasi Belum Lengkap!');
    return false;
    }
    }
     
    Ext.DOM.NewAddress = function ($this) {
    if ($this == 0) {
    Ext.Cmp('NewBillingAddress').disabled(false);
    } else if ($this == 1) {
    Ext.Cmp('NewBillingAddress').disabled(true);
    }
    }
     
    Ext.DOM.saveProductInfoFlexi = function (){
    console.log("## saveProductInfoFlexi");
    // /*var lengthaccount = document.getElementById('benefaccount').value;*/
    // var isVerif = document.getElementById('ver_status').value;
    // var isVerif = Ext.DOM.getVerificationStatus_2nd();
    // if(!isVerif){
    // alert('Verifikasi Belum Lengkap!');
    // return false;
    // }
     
    var checkLengthBenefbank = $("#benefaccount_2nd").val();
    var checkLengthBenefbank = parseInt(checkLengthBenefbank.length);
    var minLenBenef = $("#benefaccount_2nd").attr("minlength");
    var minLenBenef = parseInt(minLenBenef);
     
    if( Ext.Cmp('tnc2nd').getValue() == '' ){
    window.alert("tnc Type is Empty (multiProduct)!");
    return false;
     
    }
     
    if( Ext.Cmp('tnc2nd').getValue() == 'NO' ){
    window.alert("tnc Type is Empty (multiProduct)!");
    return false;
     
    }
     
    if( Ext.Cmp('tnc2nd').getValue() == 0 ){
    window.alert("tnc Type is Empty (multiProduct)!");
    return false;
    }
     
     
    if ( checkLengthBenefbank < minLenBenef ) {
    alert("Length benef Account is not more than " + minLenBenef + " minimal (" + minLenBenef + " length)" );
    return false;
    }
     
    if( Ext.Cmp('typexsell_2nd').getValue() == '' ){
    window.alert("Xsel Type is Empty!");
    return false;
    }
     
     
    else{
    if( Ext.Cmp('typexsell_2nd').getValue() == 'YES' ){
    // alert(Ext.Cmp('typexsell').getValue());
    if( Ext.Cmp('vartiering_2nd').getValue()<1){
    window.alert('Variable Tiering is empty!');
    return false;
    }
    else if( Ext.Cmp('benefname_2nd').getValue()== "" ){
    window.alert('Benef Name is empt (flexi)!');
    return false;
    }
    else if( Ext.Cmp('benefbank_2nd').getValue()== "" ){
    window.alert('Benef Bank is empty!');
    return false;
    }
    else if( Ext.Cmp('benefaccount_2nd').getValue()== "" ){
    window.alert('Benef Account is empty!');
    return false;
    }
    else if( Ext.Cmp('addressVerif_2nd').getValue()== "" ) {
    window.alert("Address Verify is Empty!");
    return false;
    }
    /*else if(lengthaccount.length < 10){
    alert('Account Number less than Requirement!!');
    return false;
    }*/
    else if( Ext.Cmp('benefbranch_2nd').getValue() == "" ){
    window.alert('Benef Branch is empty!');
    return false;
    }
    else if( Ext.Cmp('vartiering_2nd').getValue()>1 ){
    var select_tenor = $('input[name=key_tenor_2nd]:checked').val();
     
    if($('input[name=key_tenor_2nd]:checked').val()==null){
    window.alert('Tenor Tiering is empty!');
    return false;
    }
    else{
    var addressVerif = [];
    var NewBillingAddress = [];
    var loan_amount = document.getElementById("LoanAmount_"+select_tenor+"_2nd").textContent;
    var Installment = document.getElementById("Installment_"+select_tenor+"_2nd").textContent;
     
    addressVerif['addressVerif'] = Ext.Cmp('addressVerif_2nd').getValue();
    NewBillingAddress = Ext.Cmp('NewBillingAddress').getValue();
    // console.log('NewBillingAddress', Ext.Cmp('NewBillingAddress').getValue());
    //alert(Ext.Cmp('bolAddress').getValue());
    //verifAddress['AdressVerif'] = Ext.Cmp('CheckAddress').getValue();
    // var Rate = document.getElementById("Rate_"+select_tenor).textContent;
    var Rate = document.getElementById("Rate_"+select_tenor+"_2nd").textContent;
    var r = confirm("Proccessing The Loan as !\nTenor : "+select_tenor+"\nLoan : "+loan_amount+"\nInstallment : "+Installment+"\nRate : "+Rate+"\nAre You Sure?");
    if (r == true) {
    Ext.Ajax({
    url : Ext.EventUrl(new Array('ProductInfoFlexi', 'saveLoan')).Apply(),
    method :'POST',
    param :Ext.Join(new Array(
    Ext.Serialize('formProductInfo1_2nd').getElement(),
    Ext.Serialize('formProductInfo2_2nd').getElement(),
    Ext.Serialize('formProductInfo3_2nd').getElement(),
    addressVerif,
    NewBillingAddress
    )).object(),
    success : function(fn){
    Ext.Util(fn).proc(function(save){
    if( save.success ) {
    Ext.Msg("Save Product Info").Success();
    Ext.Cmp('isSave_2nd').setValue('1');
    Ext.Cmp('InputForm').setValue('1');
    }else{
    Ext.Msg("Save Product Info").Failed();
    }
    });
    }
    }).post();
    } else {
    return false
    }
    }
    }
    }
    else if(Ext.Cmp('typexsell_2nd').getValue()=='NO'){
    Ext.Ajax({
    url : Ext.EventUrl(new Array('ProductInfoFlexi', 'saveLoan')).Apply(),
    method : 'POST',
    param : {
    typexsell : Ext.Cmp('typexsell_2nd').getValue(),
    addressVerif : Ext.Cmp('addressVerif_2nd').getValue(),
    CustomerId : Ext.Cmp('CustomerId_2nd').getValue()
    },
    success : function(fn){
    Ext.Util(fn).proc(function(save){
     
    if( save.success ) {
    Ext.Msg("Save Product Info").Success();
    Ext.Cmp('isSave_2nd').setValue('1');
    Ext.Cmp('InputForm').setValue('1');
    }
    else{
    Ext.Msg("Save Product Info").Failed();
    }
    });
    }
    }).post();
    }
    }
    }
     
    </script>
    <?php
    $newDate = date("d-m-Y", strtotime($param['CustomerDOB']));
     
    /* COMBO-COMBO */
    $coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
    $plan = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
    $sex = array(1=>"Pria",2=>"Wanita");
    /* END OF COMBO-COMBO */
     
    ?>
     
    <fieldset class="corner" style="margin-bottom:15px;padding:20px 0px 20px 0px;">
    <?php echo form()->legend(lang("Product Info"), "fa-tasks");?>
    <?php echo form()->hidden('isSave_2nd',NULL,(is_array($result)&&count($result)>0?1:0));?>
    <?php echo form()->hidden('Mode_2nd',NULL,$param['Mode']);?>
     
    <fieldset class="corner" style="margin-bottom:15px;border:0px solid #fff;padding:20px 5px 20px 5px;">
    <form name="formProductInfo1_2nd">
    <!-- <input type='hidden' class="AddressVerif" id="AddressVerif" name='AddressVerif' value='1'> -->
    <?php echo form()->hidden('CustomerId_2nd',NULL, $param['CustomerId'] );?>
    <div class="ui-widget-form-table" style="margin-top:-5px;">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Type Cross Sell");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->combo("typexsell_2nd", "select tolong", array('YES'=>'Flexi Credit w/ Disbursement','NO'=>'Flexi Credit'),$frm['typexsell'],array("change"=>"Ext.DOM.openCoverage_2nd(this.value)"));?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Variable Tiering");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell">
    <?php
    echo form()->combo("vartiering_2nd", "select tolong",
    array(
    50 => 50,
    60 => 60,
    70 => 70,
    80 => 80,
    100 => 100,
    99 => 'Fix 5 Mio'
    ),
    ($frm['vartiering']>0?$frm['vartiering']:100),array("change"=>"Ext.DOM.getLoan_2nd(this.value)"));?></div>
    </div>
    </div>
     
    <div class="ui-widget-form-table" style="margin-right:-5px;">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    </div>
    </div>
     
    <div class="ui-widget-form-table" style="margin-right:-5px;">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    <div class="ui-widget-form-cell text_caption">&nbsp;</div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Flexi Credit Limit");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell text_caption"><?php echo lang(number_format($result['FINAL_LIMIT'], 2, '.', ','));?></div>
    </div>
    </div>
     
    </form>
    </fieldset>
     
    <!-- middle tabulasi -->
     
    <fieldset class="corner" style="margin-bottom:15px;border:0px solid #fff;padding:20px 5px 20px 5px;">
    <?php echo form()->hidden('isSave_2nd',NULL,(is_array($result)&&count($result)>0?1:0));?>
    <?php echo form()->hidden('Mode_2nd',NULL,$param['Mode']);?>
    <form name="formProductInfo2_2nd">
    <div id="loans" class="loan-flexi">
    <?php
    $arr_header = array(
    "Tenor" => lang("Tenor"),
    "LoanAmount" => lang("Loan Amount"),
    "Installment" => lang("Monthly Installment"),
    "Rate" => lang("Rate")
    );
    $arr_class = array(
    "Tenor" => "content-middle",
    "LoanAmount" => "content-middle",
    "Installment" => "content-middle",
    "Rate" => "content-lasted"
    );
     
    echo "<table border=0 cellspacing=0 width=\"99%\">".
    "<tr height=\"30\"> ".
    "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>".
    "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
    foreach( $arr_header as $field => $value ){
    echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span title=\"Sort By {$value}\">&nbsp;{$value}</span></th>";
    }
    echo "</tr>";
     
    $arr_num =1; $n = 0;
    if( is_array($loans) ){
    $no = 1;
    $tenor = "";
    $checkedtenor = NULL;
    foreach( $loans as $num => $rows ){
    $row = new EUI_Object( $rows );
    $tenor = $row->get_value('Tenor',$arr_function['Tenor']);
    if($tenor==6){
    $tenor=0;
    }
    // if($frm['Tenor']==0){
    // $frm['Tenor']=6;
    // }
    // echo $frm['Tenor'];
    $back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
    if ($tenor[0] == 3) {
    $font_color = 'blue';
    } else if ($tenor[0] == 6 || $tenor[0] ==12) {
    $font_color = 'black';
    } else if ($tenor[0] == 18) {
    $font_color = 'magenta';
    } else if ($tenor[0] == 24) {
    $font_color = 'red';
    } else {
    $font_color = 'green';
    }
    if($frm['Tenor']==$tenor){
    $checkedtenor = array("checked"=>"checked");
    }else{
    $checkedtenor = NULL;
    }
    // echo $frm['Tenor']."=>".$tenor.$checkedtenor."<br>";
    echo "<tr bgcolor=\"{$back_color}\" style=\"color:{$font_color}\" class=\"onselect\" height=\"35\">".
    "<td class=\"content-first\" nowrap>{$no}</td>".
    "<td class=\"content-first\" nowrap>".form()->radio( "key_tenor_2nd", "content-first", $tenor, null,$checkedtenor)."</td>";
    foreach( array_keys($arr_header) as $k => $fields ){
    if(strtolower($fields) === 'tenor'){
    $numbers = $row->get_value($fields,$arr_function[$fields]);
    if($numbers==6){
    $numbers=0;
    }
    }else{
    if(strtolower($fields) == 'rate'){
    $numbera = $row->get_value($fields,$arr_function[$fields])*100;
    $numbers = number_format($numbera, 2, '.', ',')."%";
    }else{
    $loansvar = $frm['vartiering'];
    // $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
    $numbers = $row->get_value($fields,$arr_function[$fields]);
    if($loansvar>40){
    $loan = ($numbers * $loansvar)/100;
    $numbers = number_format($loan, 0, '.', ',');
    }else{
    $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
    }
    }
    }
    echo "<td align='right' id=\"".$fields."_".$tenor."_2nd\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
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
    <fieldset class="corner" style="margin-bottom:15px;border:0px solid #fff;padding:20px 0px 20px 0px;">
    <?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
    <?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
    <form name="formProductInfo3_2nd">
    <?php ?>
    <div class="ui-widget-form-table" style="margin-top:-5px;">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Name");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->input("benefname_2nd", "select tolong", $frm['BenefName'],array("onPaste"=>"return false"),array("onPaste"=>"return false"));?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Bank");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->combo("benefbank_2nd", "select tolong", $listbank, $frm['BenefBank'],array("onPaste"=>"return false"));?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Apakah alamat billing masih sama?");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell">
    <?php //echo form()->combo("addressVerif_2nd", "select tolong", array('1'=>'Ya','0'=>'Tidak'), $frm['addressVerif'], array("change"=>"Ext.DOM.NewAddress(this.value)"));?>
    <select name="addressVerif_2nd" id="addressVerif_2nd" onchange="NewAddress(this.value)" class="select tolong">
    <?php if($frm['AddressVerif'] == 1){?>
    <option value="">Choose</option>
    <option selected="" value="1">Ya</option>
    <option value="0">Tidak</option>
    <?php }elseif($frm['AddressVerif'] == 0){ ?>
    <option value="">Choose</option>
    <option value="1">Ya</option>
    <option selected="" value="0">Tidak</option>
    <?php }else {?>
    <option value="">Choose</option>
    <option value="1">Ya</option>
    <option value="0">Tidak</option>
    <?php } ?>
     
    </select>
    </div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("ke alamat mana billing ingin dikirimkan?");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->combo("NewBillingAddress", "select tolong", array('Home'=>'Home','Office'=>'Office'),$frm['NewBillingAddress']);?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Pembacaan TnC");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell">
     
    <select name="tnc2nd" id="tnc2nd" class="select tolong">
    <?php if($frm['tnc']==='YES'){?>
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
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell">
    <span><p style="font-size: 10px;color: red ;font-weight:bold">(PASTIKAN PEMBACAAN TNC LENGKAP)</p></span>
     
    </div>
    </div>
    </div>
     
    <div class="ui-widget-form-table" style="margin-top:-5px;">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Account");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->input("benefaccount_2nd", "select tolong", $frm['BenefAccount'], null, array("onPaste"=>"return false"));?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Benef branch");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo form()->input("benefbranch_2nd", "select tolong", $frm['BenefBranch']);?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"><?php echo lang("Address");?></div>
    <div class="ui-widget-form-cell text_caption">:</div>
    <div class="ui-widget-form-cell"><?php echo $result['addr1'] ?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell"><?php echo $result['addr2'] ?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell"><?php echo $result['addr3'] ?></div>
    </div>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell"><?php echo $result['addr4'] ?></div>
    </div>
    </div>
    <?php
    if($param['Mode']!='VIEW'){
    ?>
    <div class="ui-widget-form-row" align="Right">
    <div class="ui-widget-form-cell">&nbsp;</div>
    <div class="ui-widget-form-cell">&nbsp;</div>
    <div class="ui-widget-form-cell" align="Right">
    <?php //echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoFlexi();'));?>
    <?php if(_get_session('HandlingType')==4 || _get_session('HandlingType')==8){
    // echo form()->button("ButtonUserSave_2nd", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoFlexi();'));
    echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getVerificationStatus_2nd(Ext.DOM.Fallback2_nd);'));
    }?>
    </div>
    </div>
    <div class="ui-widget-form-row" >
    <div class="ui-widget-form-cell">&nbsp;</div>
    <div class="ui-widget-form-cell">&nbsp;</div>
    <div class="ui-widget-form-cell" align="Right">
    <input type="text" name="tnc2_2nd" id="tnc2_2nd" class="select tolong" value="<?php echo $frm['tnc'] === 'YES' ? 'TNC' : '' ?>" disabled="" style="width: 110px">
    </div>
     
    </div>
    <?php
    }
    ?>
    </form>
    </fieldset>
    </fieldset>

