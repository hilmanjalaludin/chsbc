<?php  $arr_class =& $error_page['class']; ?>


<div class="ui-widget-form-table-compat ui-widget-content" style="width:99%;font-family:Arial;text-align:left;" >
	<table cellspacing="0" cellpadding="0" width="99%"  style="border-right:1px solid #eeefff;border-top:1px solid #eeefff;"> 
		<tr>
			<td style="background-color:#fdfdfe;color:#5258a7;font-weight:bold;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;" nowrap> Err No.</td>
			<td style="background-color:#fdfdfe;color:#5258a7;font-weight:normal;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;"><?php echo mysql_errno(); ?></td>
		</tr>
		<tr>
			<td style="background-color:#fdfdfe;color:#5258a7;font-weight:bold;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;" nowrap> MySQL Err.</td>
			<td style="background-color:#fdfdfe;color:#5258a7;font-weight:normal;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;"> <?php echo mysql_error();?>
			</td>
		</tr>
		<tr>
			<td style="background-color:#fdfdfe;color:#74768d;font-weight:bold;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;" nowrap> Query .</td>
			<td style="background-color:#f0f1ff;color:#5258a7;font-weight:normal;border-left:1px solid #eeefff;border-bottom:1px solid #eeefff;text-align:justify;" valign="top">
				<?php echo $arr_class->_error_page(); ?>
			</td>
		</tr>
	</table>	
</div>
