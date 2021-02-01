<?php
/* COMBO-COMBO */
	$coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
	$plan 	  = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
	$sex 	  = array(1=>"Pria",2=>"Wanita");
/* END OF COMBO-COMBO */
?>
<div id="ui-widget-content-markup-tabs" class="ui-widget-content-frame">
	<ul>
		<li class="ui-tab-li-none"> <a href="#ui-widget-content-pertama">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Calculator Hospin");?> </a>
		</li>
		<li class="ui-tab-li-none"> <a href="#ui-widget-content-kedua">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Calculator PIL-EIR");?> </a>
		</li>
		<li class="ui-tab-li-none"> <a href="#ui-widget-content-ketiga">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Calculator PIL-CASHBACK");?> </a>
		</li>
	</ul>
	
	<div id="ui-widget-content-pertama" class="ui-widget-content-frame">
		<fieldset class="corner" style="margin-bottom:15px;">
			<?php echo form()->legend(lang("Product Info"), "fa-tasks");?>
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Coverage");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->combo("coverage", "select long", $coverage,null,array("change"=>"Ext.DOM.openCoverage(this.value)"));?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Main Insured<br/>DOB");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom">
						<?php echo form()->input("dob_main","date input_text",null);?>
						&nbsp;Age&nbsp;
						<span id="age_main-2" style="color:blue;font-weight:bold">-</span>
						<?php echo form()->hidden("age_main","text", null);?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Spouse DOB");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom">
						<?php echo form()->input("dob_spouse","date input_text",null);?>
						&nbsp;Age&nbsp;
						<span id="age_spouse-2" style="color:blue;font-weight:bold">-</span>
						<?php echo form()->hidden("age_spouse","text", null);?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Child 1 DOB");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom">
						<?php echo form()->input("dob_c1","date input_text",$r_dob_main);?>
						&nbsp;Age&nbsp;
						<span id="age_c1-2" style="color:blue;font-weight:bold">-</span>
						<?php echo form()->hidden("age_c1","text", null);?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Child 2 DOB");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom">
						<?php echo form()->input("dob_c2","date input_text",$r_dob_main);?>
						&nbsp;Age&nbsp;
						<span id="age_c2-2" style="color:blue;font-weight:bold">-</span>
						<?php echo form()->hidden("age_c2","text", null);?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Child 3 DOB");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom">
						<?php echo form()->input("dob_c3","date input_text",$r_dob_main);?>
						&nbsp;Age&nbsp;
						<span id="age_c3-2" style="color:blue;font-weight:bold">-</span>
						<?php echo form()->hidden("age_c3","text", null);?>
					</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Plan HI");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->combo("plan", "select long",$plan,null,array("change"=>"Ext.DOM.getPremi(this.value)"));?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption"><?php echo lang("Premi");?></div>
					<div class="ui-widget-form-cell text_caption">:</div>
					<div class="ui-widget-form-cell" >
						<?php echo form()->hidden("monthly_premium", null);?>
						<?php echo form()->input("monthly_premium-2", "input_text long",null,null,array('disabled'=>true));?>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
	
	<div id="ui-widget-content-kedua" class="ui-widget-content-frame">
		<fieldset class="corner" style="margin-bottom:15px;">
			<?php echo form()->legend(lang("PIL-IER Calculation"), "fa-tasks");?>
			<?php $tenor = array(6=>6,12=>12,18=>18,24=>24,36=>36,48=>48,60=>60); ?>
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Principal");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->input("principal", "input_text long money", null, null);?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Flat Rate");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->input("flatrate", "input_text long allowNumberDes", null, null);?>&nbsp;%</div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Tenor");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->combo("tenor", "select long", $tenor, null, array("change"=>"Ext.DOM.GetEffectiveRate();"));?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Effective Rate");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->input("effectiverate", "input_text long", null, null, array("disabled"=>"disabled"));?>&nbsp;%</div>
				</div>
			</div>
			<div class="ui-widget-form-table" align="right" style="float:right;">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom">&nbsp;</div>
					<!-- d i v class="ui-widget-form-cell bottom"><?#php echo form()->input("principaltext", "input_text long", null, null);?></d i v -->
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom" align="right"><?php echo form()->button("calculate", "button save", lang('Calculate'), array("click" => "Ext.DOM.Calculate();"));?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom" align="right"><?php echo form()->button("keluar", "button close", lang('Close'), array('click' => 'Ext.DOM.closeWin();'));?></div>
				</div>
			</div>
			<div>
				<div class="ui-widget-form-cell bottom text_caption"><br></div>
			</div>
			</fieldset>
			<fieldset>
			<div id="table-scheme">
				<?php 
				$arr_header = array(
					"Installment" => lang("Installment"),
					"os"=> lang("O/S"),
					"Interest"=> lang("Insterest"),
					"Principal"=> lang("Principal")
				);
				$arr_class = array(
					"Installment" =>"content-middle",
					"os"=>"content-middle",
					"Interest"=>"content-middle",
					"Principal"=>"content-lasted"
				);

				echo	"<table border=0 cellspacing=1 width=\"100%\">".
					"<tr height=\"30\"> ".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
				foreach( $arr_header as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
				}
				echo "</tr>";

				echo "</table>";
				?>
			</div>
		</fieldset>
	</div>
	
	<div id="ui-widget-content-ketiga" class="ui-widget-content-frame">
		<fieldset class="corner" style="margin-bottom:15px;">
			<?php echo form()->legend(lang("PIL-IER Calculation"), "fa-tasks");?>
			<?php $tenor = array(6=>6,12=>12,18=>18,24=>24,36=>36,48=>48,60=>60); ?>
			<div class="ui-widget-form-table">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?php echo lang("Loan");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?php echo form()->input("loan", "input_text long money", null, null);?></div>
				</div>
				<!-- d iv class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption"><?#php echo lang("Interest Rate");?></div>
					<div class="ui-widget-form-cell bottom text_caption">:</div>
					<div class="ui-widget-form-cell bottom"><?#php echo form()->input("interestrate", "input_text long allowNumberDes", null, null);?>&nbsp;%</div>
				</di v -->
			</div>
			<div class="ui-widget-form-table" align="right" style="float:right;">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom">&nbsp;</div>
					<!-- d i v class="ui-widget-form-cell bottom"><?#php echo form()->input("principaltext", "input_text long", null, null);?></d i v -->
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom" align="right"><?php echo form()->button("calculate", "button save", lang('Calculate'), array("click" => "Ext.DOM.Calculate2();"));?></div>
				</div>
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell bottom" align="right"><?php echo form()->button("keluar", "button close", lang('Close'), array('click' => 'Ext.DOM.closeWin();'));?></div>
				</div>
			</div>
			<div>
				<div class="ui-widget-form-cell bottom text_caption"><br></div>
			</div>
		</fieldset>
		<fieldset>
		<div id="table-scheme2">
				<?php 
				$arr_header = array(
					"12" => "12",
					"24" => "24",
					"36" => "36",
					"48" => "48",
					"60" => "60"
				);
				$arr_class = array(
					"12" => "content-middle",
					"24" => "content-middle",
					"36" => "content-middle",
					"48" => "content-middle",
					"60" => "content-lasted",
				);
				$arr_interset = array('1.10%','1.20%','1.20%','1.24%','1.30%');
				
				echo	"<table border=0 cellspacing=1 width=\"100%\">".
				"<tr height=\"30\"> ".
						"<th rowspan = \"3\" class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("Gratis Bunga") ."<br>".lang("(X Bulan)")."</th>".
						"<th colspan = \"5\" class=\"ui-corner-top ui-state-default center th-lasted\" width=\"2%\" nowrap>". lang("Tenor") ."</th>".
					"</tr> ".
					"<tr height=\"30\"> ";
				foreach( $arr_interset as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
				}
					echo "</tr> ".
					"<tr height=\"30\"> ";
				foreach( $arr_header as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
				}
				echo "</tr>";

				echo "</table>";
				?>
			</div>
		</fieldset>
	</div>
</div>