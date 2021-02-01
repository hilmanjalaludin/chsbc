<script>
	Ext.DOM.getPremi = function(val){
		var Coverage = Ext.Cmp('coverage').getValue();
		var ChildPremi = Ext.DOM.getChildPremi(val);
		// var ChildPremi = {"ProductPlanId":"26","ProductPlanPremium":"178400"};
		
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
		}
		return childpremisum;
	}
	
	function AgeCallculator( Date ){
		return( Ext.Ajax  ({
				url 	: Ext.EventUrl(new Array('ProductInfo', 'SelectCalculateAge') ).Apply(), 
				method 	:'GET',
				param 	: { 
					Date  : ( typeof( Date ) !='undefined' ? Date : '' )
				},
			}).json()
		);
	}
	
	function getChilds(){
		var coverage = Ext.Cmp('coverage').getValue();
		var childs = [];
		if(coverage==1 || coverage==3){
			if(Ext.Cmp('name_c1').getValue() != "" && Ext.Cmp('age_c1').getValue() != ""){
				childs.push({
					Name:Ext.Cmp('name_c1').getValue(),
					Age:Ext.Cmp('age_c1').getValue()
				});
			}
			if(Ext.Cmp('name_c2').getValue() != "" && Ext.Cmp('age_c2').getValue() != ""){
				childs.push({
					Name:Ext.Cmp('name_c2').getValue(),
					Age:Ext.Cmp('age_c2').getValue()
				});
			}
			if(Ext.Cmp('name_c3').getValue() != "" && Ext.Cmp('age_c3').getValue() != ""){
				childs.push({
					Name:Ext.Cmp('name_c3').getValue(),
					Age:Ext.Cmp('age_c3').getValue()
				});
			}
		}
		return childs;
	}

	$(document).ready(function(){
		$('.date').datepicker({
			buttonImage	: Ext.DOM.LIBRARY+'/gambar/calendar.gif',
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
		})
		
		Ext.DOM.openCoverage(Ext.Cmp('coverage').getValue());
		Ext.DOM.getAgeOnReady();
		
		if(Ext.Cmp('isSave').getValue()==1)
		{
			Ext.DOM.getPremi(Ext.Cmp('plan').getValue());
			Ext.Cmp('InputForm').setValue(1)
		}
		
		if(Ext.Cmp('Mode').getValue()=='VIEW')
		{
			Ext.Cmp('coverage').disabled(true);
			Ext.Cmp('plan').disabled(true);
			Ext.DOM.setDisabled('main',true);
			Ext.DOM.setDisabled('spouse',true);
			Ext.DOM.setDisabled('c1',true);
			Ext.DOM.setDisabled('c2',true);
			Ext.DOM.setDisabled('c3',true);
		}
	});
	
	Ext.DOM.getAgeOnReady = function()
	{
		var Coverage = Ext.Cmp('coverage').getValue();
		if(Coverage == 1){ // MAIN & FAMILY
			Ext.DOM.setAgeOnReady('main');
			Ext.DOM.setAgeOnReady('spouse');
			Ext.DOM.setAgeOnReady('c1');
			Ext.DOM.setAgeOnReady('c2');
			Ext.DOM.setAgeOnReady('c3');
		}else if(Coverage == 2){ // MAIN ONLY
			Ext.DOM.setAgeOnReady('main');
		}else if(Coverage == 3){ // MAIN & CHILD
			Ext.DOM.setAgeOnReady('main');
			Ext.DOM.setAgeOnReady('c1');
			Ext.DOM.setAgeOnReady('c2');
			Ext.DOM.setAgeOnReady('c3');
		}else if(Coverage == 4){ // MAIN & SPOUSE
			Ext.DOM.setAgeOnReady('main');
			Ext.DOM.setAgeOnReady('spouse');
		}else{
			Ext.DOM.setAgeOnReady('main');
		}
	}
	
	Ext.DOM.setAgeOnReady = function(id)
	{
		if(id != null || id!=""){
			var dob = Ext.Cmp('dob_'+id).getValue();
			if( dob!=null || dob!="" ){
				var age = new AgeCallculator(dob);
				Ext.Cmp("age_"+id).setValue(age.Age);
				Ext.Cmp("age_"+id+"-2").setText(age.years+" y, "+age.months+" m, "+age.days+" d");
			}
		}
	}
	
	Ext.DOM.setDisabled = function(id,flag)
	{
		Ext.Cmp('name_'+id).disabled(flag);
		Ext.Cmp('sex_'+id).disabled(flag);
		Ext.Cmp('dob_'+id).disabled(flag);
	}
	
	Ext.DOM.setClear = function(id)
	{
		Ext.Cmp('name_'+id).setValue('');
		Ext.Cmp('sex_'+id).setValue('');
		Ext.Cmp('dob_'+id).setValue('');
		Ext.Cmp('age_'+id).setValue('');
		Ext.Cmp('age_'+id+'-2').setText('-');
	}
	
	Ext.DOM.openCoverage = function (val){
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
			// Ext.DOM.setDisabled('main',false
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
			
			// Ext.Cmp('name_main').setValue('');
			// Ext.Cmp('sex_main').setValue('');
			Ext.Cmp('dob_main').setValue('');
			Ext.Cmp('age_main').setValue('');
			Ext.Cmp('age_main-2').setText('-');
			// Ext.DOM.setClear('main');
			
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
	
	Ext.DOM.saveProductInfo = function (){
		Ext.Ajax({
			url		: Ext.EventUrl(new Array('ProductInfo', 'savePremi')).Apply(),
			method	:'POST',
			param	:Ext.Join(new Array( 
						Ext.Serialize('formProductInfo').getElement()
					)).object(),
			ERROR  : function(fn){
				Ext.Util(fn).proc(function(save){
					if( save.success ) {
						Ext.Msg("Save Product Info").Success();
						Ext.Cmp('isSave').setValue('1');
						Ext.Cmp('InputForm').setValue('1');
						// $("#tabs").mytab().tabs().tabs("option", "selected", 0);
						// Ext.DOM.CallHistory({page : 0, orderby : "", type : ""});
					}else{
						Ext.Msg("Save Product Info").Failed();
					}
				});
			}
		}).post();
	}
	
</script>
<?php
	$newDate = date("d-m-Y", strtotime($param['CustomerDOB']));
	
	/* COMBO-COMBO */
	$coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
	$plan 	  = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
	$sex 	  = array(1=>"Pria",2=>"Wanita");
	/* END OF COMBO-COMBO */
	
	$r_coverage = (isset($result['coverage'])?$result['coverage']:null);
	$r_plan 	= (isset($result['plan'])?$result['plan']:null);
	/* $r_monthly_premium 	 = (isset($result['monthly_premium'])?$result['monthly_premium']:null);
	$r_monthly_premium_2 = (isset($result['monthly_premium'])?number_format($result['monthly_premium'],0,',','.'):null); */
	
	/* MAIN */
	$r_name_main = (isset($result['name_main'])?$result['name_main']:$param['CustomerName']);
	$r_sex_main  = (isset($result['sex_main'])?$result['sex_main']:$param['GenderId']);
	$r_dob_main  = (isset($result['dob_main'])&&$result['dob_main']!='0000-00-00'?date('d-m-Y',strtotime($result['dob_main'])):$newDate);
	/* END OF MAIN */
	
	/* SPOUSE */
	$r_name_spouse = (isset($result['name_spouse'])?$result['name_spouse']:null);
	$r_sex_spouse  = (isset($result['sex_spouse'])?$result['sex_spouse']:null);
	$r_dob_spouse  = (isset($result['dob_spouse'])&&$result['dob_spouse']!='0000-00-00'?date('d-m-Y',strtotime($result['dob_spouse'])):null);
	/* END OF SPOUSE */
	
	/* C1 */
	$r_name_c1 = (isset($result['name_c1'])?$result['name_c1']:null);
	$r_sex_c1  = (isset($result['sex_c1'])?$result['sex_c1']:null);
	$r_dob_c1  = (isset($result['dob_c1'])&&$result['dob_c1']!='0000-00-00'?date('d-m-Y',strtotime($result['dob_c1'])):null);
	/* END OF C1 */
	
	/* C2 */
	$r_name_c2 = (isset($result['name_c2'])?$result['name_c2']:null);
	$r_sex_c2  = (isset($result['sex_c2'])?$result['sex_c2']:null);
	$r_dob_c2  = (isset($result['dob_c2'])&&$result['dob_c2']!='0000-00-00'?date('d-m-Y',strtotime($result['dob_c2'])):null);
	/* END OF C2 */
	
	/* C3 */
	$r_name_c3 = (isset($result['name_c3'])?$result['name_c3']:null);
	$r_sex_c3  = (isset($result['sex_c3'])?$result['sex_c3']:null);
	$r_dob_c3  = (isset($result['dob_c3'])&&$result['dob_c3']!='0000-00-00'?date('d-m-Y',strtotime($result['dob_c3'])):null);
	/* END OF C3 */
?>
<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->legend(lang("Product Info"), "fa-tasks");?>
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo">
	<?php echo form()->hidden('CustomerId',NULL, $param['CustomerId'] );?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Coverage");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom"><?php echo form()->combo("coverage", "select  tolong", $coverage,$r_coverage,array("change"=>"Ext.DOM.openCoverage(this.value)"));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Main Insured");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("name_main", "text  tolong",$r_name_main);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Sex");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("sex_main", "select  tolong", $sex, $r_sex_main);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom">
				<?php echo form()->input("dob_main","date text",$r_dob_main);?>
				&nbsp;Age&nbsp;
				<span id="age_main-2" style="color:blue;font-weight:bold">-</span>
				<?php echo form()->hidden("age_main","text", null);?>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Child's Name 1");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("name_c1", "text tolong", $r_name_c1);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Sex");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("sex_c1", "select  tolong", $sex, $r_sex_c1);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom">
				<?php echo form()->input("dob_c1","date text",$r_dob_c1);?>
				&nbsp;Age&nbsp;
				<span id="age_c1-2" style="color:blue;font-weight:bold">-</span>
				<?php echo form()->hidden("age_c1","text", null);?>
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Plan HI");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("plan", "select  tolong",$plan,$r_plan,array("change"=>"Ext.DOM.getPremi(this.value)"));?></div>
		</div>
	</div>
	
	<div class="ui-widget-form-table" style="margin-top:-5px;">
	
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Spouse");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("name_spouse", "text  tolong",$r_name_spouse);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Sex");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("sex_spouse", "select  tolong", $sex,$r_sex_spouse);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom">
				<?php echo form()->input("dob_spouse","date text", $r_dob_spouse);?>
				&nbsp;Age&nbsp;
				<span id="age_spouse-2" style="color:blue;font-weight:bold">-</span>
				<?php echo form()->hidden("age_spouse","text", null);?>
			</div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("2");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("name_c2", "text  tolong",$r_name_c2);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Sex");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("sex_c2", "select  tolong", $sex,$r_sex_c2);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom">
				<?php echo form()->input("dob_c2","date text",$r_dob_c2);?>
				&nbsp;Age&nbsp;
				<span id="age_c2-2" style="color:blue;font-weight:bold">-</span>
				<?php echo form()->hidden("age_c2","text", null);?>
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Premi");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" >
				<?php echo form()->hidden("monthly_premium", null);?>
				<?php echo form()->input("monthly_premium-2", "text tolong",null,null,array('disabled'=>true));?>
			</div>
		</div>
	</div>
	
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		<div class="ui-widget-form-row">&nbsp;</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("3");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("name_c3", "text  tolong",$r_name_c3);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Sex");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("sex_c3", "select  tolong", $sex, $r_sex_c3);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("DOB");?></div>
			<div class="ui-widget-form-cell bottom text_caption">:</div>
			<div class="ui-widget-form-cell bottom">
				<?php echo form()->input("dob_c3","date text",$r_dob_c3);?>
				&nbsp;Age&nbsp;
				<span id="age_c3-2" style="color:blue;font-weight:bold">-</span>
				<?php echo form()->hidden("age_c3","text", null);?>
			</div>
		</div>
		<?php
		if($param['Mode']!='VIEW'){
		?>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" align="Right">
				<?php echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfo();'));?>
			</div>
		</div>
		<?php
		}
		?>
	</div>
	
	</form>
</fieldset>