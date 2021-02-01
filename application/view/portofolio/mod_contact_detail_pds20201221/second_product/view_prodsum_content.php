<div class="ui-widget-table-compact" style="width:99%;">
<?php if(!is_null($ProdSummary) && is_array($ProdSummary) ) {
$i = 0;	
foreach($ProdSummary as $row )  { 
	$color = ($i%2!=0?'#FFFEEE':'#FFFFFF');  
	echo "<div class='ui-widget-form-row' style='border:1px solid #dddddd; margin-left:10px; padding:5px 5px 5px 10px;'>{$row}</div>";
	$i++; 
}
?>
<?php } ?>

</div>