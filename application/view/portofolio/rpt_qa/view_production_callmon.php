<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>
<title>Report Production Call Mon</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-baqh{text-align:center;vertical-align:top;}
.tg .tg-hgcj{font-weight:bold;text-align:center;}
.tg .tg-yw4l{vertical-align:top;}
p {
	padding:10px;
	font-family:Arial, sans-serif;
	font-size:20px;
}
.totalAll td {
  background:#32C7D0;
  color:white;
  font-weight:bold;
}
</style>

<div class="titles">
	<p>Report Production Call Mon Periode <?= $startdate . " / " . $enddate;  ?> </p>
</div>


<table class="tg" style="undefined;table-layout: fixed; width: 951px">
<colgroup>
<col style="width: 135px">
<col style="width: 154px">
<col style="width: 171px">
<col style="width: 125px">
<col style="width: 123px">
<col style="width: 106px">
<col style="width: 137px">
<col style="width: 137px">

</colgroup>
  <tr>
    <th class="tg-hgcj">Date</th>
    <th class="tg-hgcj">Production Sales<br></th>
    <th class="tg-hgcj">Production QA</th>
    <th class="tg-hgcj">Duration</th>
    <th class="tg-hgcj">Suspend</th>
    <th class="tg-hgcj">Verified</th>
    <th class="tg-hgcj">Declined</th>
    <th class="tg-hgcj">Pending</th>
  </tr>

  <?php  
  
  $getCallmon = $this->M_ReportQa->CallMonPerformance( $startdate , $enddate , 'getperformance' );
  if ( $getCallmon != "error" ) {
      foreach ( $getCallmon->result() as $gcm ) { ?>
        <tr>
          <td class="tg-031e"><?= $gcm->Dates; ?></td>
          <td class="tg-031e"><?= $gcm->TotalProductionSales; ?></td>
          <td class="tg-031e"><?= $gcm->TotalProductionQa; ?></td>
          <td class="tg-031e"><?= $gcm->totalDuration; ?></td>
          <td class="tg-031e"><?= $gcm->TotalSuspend; ?></td>
          <td class="tg-031e"><?= $gcm->TotalVerified; ?></td>
          <td class="tg-031e"><?= $gcm->TotalDeclined; ?></td>
          <td class="tg-031e"><?= $gcm->TotalNew; ?></td>
        </tr>
<?php }
  } else {

  }

  ?>


  <?php // total ?>
  
  <?php 
  
  $getCallmonTotal = $this->M_ReportQa->CallMonPerformance( $startdate , $enddate , 'gettotal' );
  if ( $getCallmonTotal != 'error' ) {
      $gct = $getCallmonTotal->row(); ?>
          <tr class="totalAll">
            <td class="tg-baqh">Total</td>
            <td class="tg-031e"><?= $gct->TotalProductionSales; ?></td>
            <td class="tg-031e"><?= $gct->TotalProductionQa; ?></td>
            <td class="tg-031e"><?= $gct->totalDuration; ?></td>
            <td class="tg-031e"><?= $gct->TotalSuspend; ?></td>
            <td class="tg-031e"><?= $gct->TotalVerified; ?></td>
            <td class="tg-031e"><?= $gct->TotalDeclined; ?></td>
            <td class="tg-031e"><?= $gct->TotalNew; ?></td>
          </tr>
      <?php
  } else {

  }

  ?>  



</table>

<br><br>

<table class="tg" style="undefined;table-layout: fixed; width: 650px">
<colgroup>
<col style="width: 165px">
<col style="width: 138px">
<col style="width: 167px">
<col style="width: 180px">
</colgroup>
  <tr>
    <th class="tg-hgcj">Date</th>
    <th class="tg-hgcj">QA</th>
    <th class="tg-hgcj">Total PIF<br></th>
    <th class="tg-hgcj">Durasi</th>
  </tr>
  <?php
  $getCallmonTotals = $this->M_ReportQa->CallMonPerformance( $startdate , $enddate , 'ALL' );  
  if ( $getCallmonTotals == true ) {
      foreach ( $getCallmonTotals->result() as $gcts ) { ?>
          <tr>
            <td class="tg-031e"><?= $gcts->Dates; ?></td>
            <td class="tg-031e"><?= $gcts->namaQa; ?></td>
            <td class="tg-031e"><?= $gcts->TotalProductionQa; ?></td>
            <td class="tg-031e"><?= $gcts->totalDuration; ?></td>
          </tr>
  <?php } 
  $getCallmonsTotals = $this->M_ReportQa->CallMonPerformance( $startdate , $enddate , 'ALL' , 'ALL' );  
  if ( $getCallmonsTotals == true ) {
      $gcsts = $getCallmonsTotals->row(); ?>
          <tr class="totalAll">
            <td class="tg-031e" colspan="2">Total </td>
            <td class="tg-031e"><?= $gcsts->TotalProductionQa; ?></td>
            <td class="tg-031e"><?= $gcsts->totalDuration; ?></td>
          </tr>
  <?php 
  } else {

  }

  ?>


  <?php } else { ?>
  <tr>
    <td class="tg-031e" colspan="4">Data Not Available</td>
  </tr>
  <?php }

  ?>

</table>


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
