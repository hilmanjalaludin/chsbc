<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @ def    : include Header page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
 
$this -> load -> form("add_form/{$form}/form_header",$form); 
?>

<div id="panel-content-header"> 
	<?php $this->load->form("add_form/{$form}/form_product");?>
</div>

<div id="result_content_add" style='border:1px solid #dddddd;'>
	<ul>
		<li class="ui-tab-li-none"><a href="#tabs-1">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("PERSONAL INFO");?></a></li>
		
		<li class="ui-tab-li-none"><a href="#tabs-2">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("EMPLOYEMENT");?></a></li>
			
		<!-- l i class="ui-tab-li-none"><a href="#tabs-3">
			<span class="ui-icon ui-icon-pencil"></span><?#php echo lang("PLAN");?></a></li>
		
		<li class="ui-tab-li-none"><a href="#tabs-4">
			<span class="ui-icon ui-icon-pencil"></span><?#php echo lang("UNDERWRITING");?></a></l i -->
	
		<li class="ui-tab-li-lasted"><a href="#tabs-5">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("REFERAL");?></a></li>
			
	</ul>
		
	<div id="tabs-1" class='box-content-data' style="background-color:#FFFFFF;">
		<?php $this->load->form("add_form/{$form}/form_payers");?>
	</div>
	
	<div id="tabs-2" class='box-content-data' style="background-color:#FFFFFF;">
		<?php $this->load->form("add_form/{$form}/form_insured");?>
	</div>
	
	<!-- d iv id="tabs-3" class='box-content-data' style="background-color:#FFFFFF;">
		<?#php $this->load->form("add_form/{$form}/form_transaction");?>
	</div>
	
	<div id="tabs-4" class='box-content-data' style="background-color:#FFFFFF;">
		<?#php $this->load->form("add_form/{$form}/form_underwriting");?>
		
	</div -->	
	
	<div id="tabs-5" class='box-content-data' style="background-color:#FFFFFF;">
		<?php $this->load->form("add_form/{$form}/form_benefiecery");?>
		
	</div>
	
</div>	
	
<!--- test load --->

<div id="product-footer-button" style="margin-top:10px;"> 
	<table align='center'>
		<div class="ui-widget-form-row">
			<td align='center'>
				<?php $this -> load -> form("add_form/{$form}/form_button");?> 
			</td>	
		</tr>	
	</table>
</div>

<?php $this -> load -> form("add_form/{$form}/form_footer"); ?>



