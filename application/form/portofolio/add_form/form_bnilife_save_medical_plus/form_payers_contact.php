<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
 
 $vars = new EUI_object(_get_all_request() );
 
?>

<?php if( $vars->get_value('ViewLayout') == 'ADD_FORM') : ?>
<?php $this->load->form("add_form/{$form}/form_payers_contact_add");?>
<?php else : ?>
<?php $this->load->form("add_form/{$form}/form_payers_contact_edit");?>
<?php endif; ?>


		<?php
		if ( _get_session("HandlingType") == USER_AGENT_OUTBOUND ) : 
			$kelurahan = "";
			$kecamatan = "";
			$kabupaten = "";
			$kodepos   = "";
			$alamat    = "";
		else : 
			$kelurahan = $Payers['PayerAddressLine3'];
			$kecamatan = $Payers['PayerAddressLine2'];
			$kabupaten = $Payers['PayerCity'];
			$kodepos   = $Payers['PayerZipCode'];
			$alamat    = $Payers['PayerAddressLine1'];
		endif; ?>

<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required"> Communications<br>Channel</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerPreferedComunication", "select long zx-select ",Comunication(), $Payers['PayerPreferedComunication']);?> </div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Email</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerEmail", "input_text long",$Payers['PayerEmail']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Address Type</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerAddrType",'textarea long zx-select', BillingAddress(), $Payers['PayerAddrType']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Jenis Pekerjaan</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerOccupationId",'textarea long zx-select', WorkType(), $Payers['PayerOccupationId']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Province</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("PayerProvinceId", 'select long zx-select',Province(),$Payers['ProvinceId']);?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Jalan /<br> Perumahan <br>( RT/RW+No )</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine1","textarea long city_payer uppercase ",$alamat,null,array("style"=>"height:100%;width:175px;", "length"=>200));?></div>		
		
	
		
	</div>
	
	
</div>


<div class="ui-widget-form-table">	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Patokan</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine4","textarea long kecamtan_payer uppercase",$Payers['PayerAddressLine4'],null,array("style"=>"height:25px;width:175px;", "length"=>200));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Kelurahan</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerAddressLine3","textarea long kecamtan_payer uppercase",$kelurahan,null,array("style"=>"height:25px;width:175px;", "length"=>200));?></div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Kecamatan</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"> <?php echo form()->textarea("PayerAddressLine2","textarea long city_payer uppercase",$kecamatan,null,array("style"=>"height:25px;width:175px;", "length"=>200));?></div>
	</div>
	
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Kabupaten/<br>Kota</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerCity","input_text long autocomplte_payer uppercase ui-widget-disabled-data",$kabupaten);?>  </div>
	</div>
	
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Kode Pos</div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("PayerZipCode","input_text long",$kodepos);?></div>
	</div>
	
	
	
</div>

<div class="ui-widget-form-table">	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption required">Alamat database </div>
		<div class="ui-widget-form-cell text_caption left">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->textarea("PayerCityRead","textarea long ui-widget-disabled-data city_payer uppercase ",
		$Upload['PayerCityRead'],"",array("style"=>"height:100%;width:175px;", "length"=>200));?></div>
	</div>
	
</div>