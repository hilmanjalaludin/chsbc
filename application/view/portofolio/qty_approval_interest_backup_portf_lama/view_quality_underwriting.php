<?php  
 $no = 1; $arr_form_code = array();
 if( is_array( $Question ) AND count( $Question) 
	 AND $QtyUnderwriting > 0 )  
{  ?>
	<fieldset class="corner" style="margin-top:15px;border-radius:5px;padding:5px 8px 10px 5px;">
	<?php echo form()->legend(lang("Underwriting"),"fa-edit");?>
	<?php echo form()->hidden("isunderwriting", NULL, ((is_array($Question) AND count( $Question)) ? "1" : "0"));?>
	<div class="ui-widget-form-table-compact table-body-content" style="margin-right:8px;width:98%;">
		<div class="ui-widget-form-row ui-widget-header table-row-header">
			<div class="ui-widget-form-cell ui-corner-top table-cell-header center">No</div>
			<div class="ui-widget-form-cell ui-corner-top table-cell-header center">Question</div>
			<div class="ui-widget-form-cell ui-corner-top table-cell-header center">Answer</div>
		</div>
	<?php 
		foreach( $Question as $UnderWriteCode => $row )
	{
		$arr_form_code[] =$UnderWriteCode;
		
		$out = new EUI_Object($row);
		$frm = (array)$out->get_value('form');
		$InputName = join("_", array("Underwriting",$UnderWriteCode));
		echo "<div class=\"ui-widget-form-row onselect\">".
				"<div class=\"ui-widget-form-cell-wrap-line-height-18 table-cell-content center\" style=\"width:3%;\">{$no}</div>".
				"<div class=\"ui-widget-form-cell-wrap-line-height-18 table-cell-content left\" style=\"width:70%;\">{$out->get_value('description')}</div>";
				
				if(isset( $frm['type'] ) 
					AND $frm['type'] == 'checkbox' )
				{
					echo "<div class=\"ui-widget-form-cell table-cell-content center\" style=\"width:20%;\">";
						if( is_array( $frm['value'] )  AND count( $frm['value'] ) ) 
							foreach( $frm['value'] as $key_value => $value ) 
						{
							$arr_extra  = null;
							if( in_array( $key_value, array($out->get_value('value')))){ 
								$arr_extra = array('checked' => true);
							}
							echo form()->checkbox($InputName, NULL, $key_value, array("change" => "Ext.Cmp('$InputName').oneChecked(this);"), $arr_extra) ."<span style=\"font-weight:bold;color:rgb(113,14,14);\">{$value}</span> &nbsp; &nbsp;";	
						}	
					echo "</div>";
					
				} 
				else if( isset( $frm['type'] ) 
					AND $frm['type'] == 'textarea' )
				{
					echo "<div class=\"ui-widget-form-cell table-cell-content center\" style=\"width:20%;\">";
						if( !is_array($frm['value']) ) {
							echo form()->textarea($InputName, 'textarea textlong uppercase', $out->get_value('value'),NULL, array('style' => 'height:25px;'));
						}	
						
					echo "</div>";
					
				} 
				else{
					echo "<div class=\"ui-widget-form-cell-wrap-line-height-18 table-cell-content left\"></div>";
					
				}
		echo "</div>";	
			 
		$no++;	 
	 }
		echo form()->hidden("ListUnderwriting",NULL, join(",",$arr_form_code));
	?>	 </div></fieldset>
<?php } ?>
