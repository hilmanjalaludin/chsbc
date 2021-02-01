
<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>

<title>Report Daily Summary QA</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-hgcj{font-weight:bold;text-align:center;}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top;}
.tg .tg-yw4l{vertical-align:top;}
p {
	padding:10px;
	font-family:Arial, sans-serif;
	font-size:20px;
}
.rangetime {
    padding:5px;
    font-family:Arial, sans-serif;
    font-size:15px;
    font-weight:bold;
}
.totalAll td {
  background:#32C7D0;
  color:white;
  font-weight:bold;
}
</style>

<div class="titles">
	<p>Performance Daily Summary QA Periode <?= $startdate . " / " . $enddate;  ?> </p>
</div>


<?php  foreach ( $this->paramtime as $to => $end ) : ?>
    <p class="rangetime"> Performance Range Time <?= $to . " - " . $end ?> </p>

<table class="tg" style="undefined;table-layout: fixed; width: 823px">
<colgroup>
<col style="width: 132px">
<col style="width: 120px">
<col style="width: 192px">
<col style="width: 120px">
<col style="width: 135px">
<col style="width: 124px">
</colgroup>
  <tr>
    <th class="tg-hgcj">Date</th>
    <th class="tg-amwm">Production TM<br></th>
    <th class="tg-amwm">Ach Polis<br></th>
    <th class="tg-amwm">Ach Duration<br></th>
    <th class="tg-amwm">New</th>
  </tr>
  <?php  

  $date = array( "startdate" => $startdate , "enddate" => $enddate );
  $time = array( "starttime" => $to , "endtime" => $end );
  $dailySummary = $this->M_ReportQa->DailySummary( $date , $time );
  if ( $dailySummary != false ) {
      foreach ( $dailySummary->result() AS $ds ) :
          $New = $ds->ProductionTm - $ds->AchPolicy;
          if ( $ds->TotalDurasi == "" ) $duration = 0;
          else $duration = $ds->TotalDurasi;
      ?>
  <tr>
    <td class="tg-yw4l"><?= $ds->TanggalJualan; ?></td>
    <td class="tg-yw4l"><?= $ds->ProductionTm; ?></td>
    <td class="tg-yw4l"><?= $ds->AchPolicy; ?></td>
    <td class="tg-yw4l"><?= $duration;  ?></td>
    <td class="tg-yw4l"><?= $New; ?></td>
  </tr>
      <?php 
      endforeach;
	 $dailySummaryTotal = $this->M_ReportQa->DailySummary( $date , $time , "ALL" );
	 if ($dailySummaryTotal != false) {
		$dst = $dailySummaryTotal->row();
		$New = $dst->ProductionTm - $dst->AchPolicy;
        if ( $dst->TotalDurasi == "" ) $duration = 0;
        else $duration = $dst->TotalDurasi;
		?>
	  <tr class="totalAll">
		<td class="tg-yw4l">Total</td>
		<td class="tg-yw4l"><?= $dst->ProductionTm; ?></td>
		<td class="tg-yw4l"><?= $dst->AchPolicy; ?></td>
		<td class="tg-yw4l"><?= $duration;  ?></td>
		<td class="tg-yw4l"><?= $New; ?></td>
	  </tr>
	<?php }
  } else {
      ?>
  <tr>
    <td class="tg-yw4l" align="center" colspan="5">Data Not Available!</td>
  </tr>
      <?php 
  }

  ?>

</table>


<?php endforeach; ?>







<?php 
/**
 * ====================================
 * End Report CSS
 * ====================================
 */
?>

<?php elseif ( $status == "Export" ) :  ?>
<?php 
/**
 * ====================================
 * Start Report Export Excel
 * ====================================
 */
?>




















<?php 
/**
 * ====================================
 * End Report Export Excel
 * ====================================
 */
?>
<?php endif; ?>