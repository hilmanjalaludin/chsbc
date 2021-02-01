
<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>

<title>Dashboard Real Time Performance Qa Per/Hour</title>
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

<script>
  setTimeout(function(){ 
    location.reload();
  }, 3000);
</script>

<div class="titles">
	<p> Real Time Performance Qa Per/Hour </p>
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
    <th class="tg-hgcj">QA Name</th>
    <th class="tg-amwm">Production TM<br></th>
    <th class="tg-amwm">Ach Polis<br></th>
    <th class="tg-amwm">Ach Duration<br></th>
    <th class="tg-amwm">New</th>
  </tr>
  <?php  

  $time = array( "starttime" => $to , "endtime" => $end );
  $getRealTime = $this->M_ReportQa->getRealTime( $time , "" ,  $startdate );
  if ( $getRealTime != false ) {
      foreach ( $getRealTime->result() AS $ds ) :
          $New = $ds->totalAssign - $ds->TotalFollow;
          if ( $ds->totalduration == "" ) $duration = 0;
          else $duration = $ds->totalduration;
      ?>
  <tr>
    <td class="tg-yw4l"><?= $ds->NamaQa; ?></td>
    <td class="tg-yw4l"><?= $ds->totalAssign; ?></td>
    <td class="tg-yw4l"><?= $ds->TotalFollow; ?></td>
    <td class="tg-yw4l"><?= $duration;  ?></td>
    <td class="tg-yw4l"><?= $New; ?></td>
  </tr>
      <?php 
      endforeach;
	   $getRealTime = $this->M_ReportQa->getRealTime( $time , "ALL" , $startdate );
	   if ( $getRealTime != false ) {
		   $grt = $getRealTime->row();
		   $New = $grt->totalAssign - $grt->TotalFollow;
		   ?>
  <tr class="totalAll">
    <td class="tg-yw4l">Total</td>
    <td class="tg-yw4l"><?= $grt->totalAssign; ?></td>
    <td class="tg-yw4l"><?= $grt->TotalFollow; ?></td>
    <td class="tg-yw4l"><?= $duration;  ?></td>
    <td class="tg-yw4l"><?= $grt->totalduration; ?></td>
  </tr>
		   <?php 
	   } else {
		   
	   }
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