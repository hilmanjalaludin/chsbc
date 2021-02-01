
<fieldset class="corner ui-widget-fieldset" style="border-radius:5px;padding:10px 5px 10px 8px;">
<?php echo form()->legend(lang("Summary Apoinment Todays"),"fa-calendar");?>

<div id="summary-apoinment-todays">
	<table border=0 align="left" cellspacing="1" width="100%">
		<tr>
			<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Date</td>
			<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Summary</td>
			<th class="font-standars ui-corner-top ui-state-default first">&nbsp;Action</td>
		</tr>
		
<?php 
$spanData = "<img src=\"". base_url() ."library/gambar/icon/zoom.png\">";
foreach( $AppointmentDays as $rows ){ ?>	
	<tr>
		<td class="contact-history-table first" WIDTH="12%"><div class="text-content left-text"><?php echo $rows['tanggal'];?></div></td>
		<td class="contact-history-table middle" WIDTH="12%"><div class="text-content center-text"><?php echo $rows['jumlah'];?></div></td>
		<td class="contact-history-table middle" WIDTH="12%">
			<div class="text-content center-text" style="margin-top:10px;">
				<span onclick="javascript:ShowAppoinment('<?php echo $rows['AppoinmentDate'];?>');"><?php echo $spanData;?></span>
			</div>
		</td>
	</tr>
<?php } ?>	
	</table>
</div>
</fieldset>	