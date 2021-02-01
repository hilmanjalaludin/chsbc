<?php
	if ( $mode == "EXCEL" ) {
		$filename = "UploadInvalid_".date("YmdHis");
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$filename.xls");
	}
?>
	<table border="1" cellpadding="1" cellspacing="0">
		<tr>
			<th style="background:#C4EAEB;" >No</th>
			<th style="background:#C4EAEB;" >CUST_NO</th>
			<th style="background:#C4EAEB;" >CUST_NAME</th>
			<th style="background:#C4EAEB;" >CAMPAIGN_NAME</th>
			<th style="background:#C4EAEB;" >UPLOAD_DATE</th>
			<th style="background:#C4EAEB;" >STATUS_DUPCHECK</th>
		</tr>
		<?php
		    if( !empty($data) ) :
				$datas = json_decode($data['Data_Upload']);
				$values= (array)$datas; $no = 1;
				foreach ($values as $value) :
					$this->val = Objective( $value );
					$color = ($no%2 == 0) ? "background:#E4E8E8;" : "" ;
		?>
		<tr>
			<td style="<?=$color;?>" ><?php echo $no++; ?></td>
			<td style="<?=$color;?>" ><?php echo $this->val->field('cusno'); ?></td>
			<td style="<?=$color;?>" ><?php echo $this->val->field('name'); ?></td>
			<td style="<?=$color;?>" ><?php echo $this->val->field('campaignId'); ?></td>
			<td style="<?=$color;?>" ><?php echo substr($data['Create_Ts'],0,19);?></td>
			<td style="<?=$color;?>" ><?php echo $this->val->field('invalid'); ?></td>
		</tr>
		<?php $i++; endforeach; endif;?>
	</table>
