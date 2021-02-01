<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>

<title>Report QA Per Period</title><style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-e3zv{font-weight:bold;}
.tg .tg-9hbo{font-weight:bold;vertical-align:top;}
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



<?php if ( $idQa == "ALL" ) : 
  $reportQaAll = $this->M_ReportQa->ReportperQa("getqa" , "ALL")
?>
    <?php if ( $reportQaAll != "error" ) :  ?>
        <?php foreach ( $reportQaAll->result() as $rqa ) : ?>
        <div class="titles">
        	<p>Performance QA Staff ID=<?= $rqa->UserId; ?> <?= $rqa->full_name; ?>  Periode <?= $startdate . " / " . $enddate;  ?> </p>
        </div>
        <table class="tg" style="undefined;table-layout: fixed; width: 1218px">
        <colgroup>
        <col style="width: 119px">
        <col style="width: 136px">
        <col style="width: 126px">
        <col style="width: 137px">
        <col style="width: 148px">
        <col style="width: 138px">
        <col style="width: 155px">
        <col style="width: 120px">
        <col style="width: 139px">
        <col style="width: 139px">
        </colgroup>
          <tr>
            <th class="tg-e3zv">Date</th>
            <th class="tg-e3zv">Qa Name</th>
            <th class="tg-e3zv">Target Achievement</th>
            <th class="tg-e3zv">Target Polis 2 Jam</th>
            <th class="tg-9hbo">Target Durasi 2 Jam</th>
            <th class="tg-9hbo">Target Polis Perhari</th>
            <th class="tg-9hbo">Target Durasi</th>
            <th class="tg-9hbo">Production Sales</th>
            <th class="tg-9hbo">Achievement Pif</th>
            <th class="tg-9hbo">Achievement Durasi</th>
          </tr>
          
          
          <?php 
            $reportperformanceqa = $this->M_ReportQa->ReportperQa( "getperformance" , $rqa->UserId , $startdate , $enddate );
            if ( $reportperformanceqa != "error" ) { 
                foreach ( $reportperformanceqa->result() as $rpq ) { ?>
              <tr>
                <td class="tg-yw4l"><?= $rpq->Updates; ?></td>
                <td class="tg-yw4l"><?= $rpq->NamaQa; ?></td>
                <td class="tg-yw4l static">490</td>
                <td class="tg-yw4l static">6</td>
                <td class="tg-yw4l static">120</td>
                <td class="tg-yw4l static">25</td>
                <td class="tg-yw4l static">490</td>
                <td class="tg-yw4l static"><?= $rpq->totalProduction; ?></td>
                <td class="tg-yw4l"><?= $rpq->totalAchievementPif; ?></td>
                <td class="tg-yw4l"><?= $rpq->totalDuration; ?></td>
              </tr>

                <?php } 
                $reportperformanceqas = $this->M_ReportQa->ReportperQa( "getperformance" , $rqa->UserId , $startdate , $enddate, 'ALL' );
                if ( $reportperformanceqas != "error" ) { 
                    $rpqs = $reportperformanceqas->row();
                ?>
                  <tr class="totalAll">
                    <td class="tg-yw4l" colspan="7">Total</td>
                    <td class="tg-yw4l static"><?= $rpqs->totalProduction; ?></td>
                    <td class="tg-yw4l"><?= $rpqs->totalAchievementPif; ?></td>
                    <td class="tg-yw4l"><?= $rpqs->totalDuration; ?></td>
                  </tr>
               <?php } ?>
                
             <?php } else { ?>
              <tr >
                <td colspan='10' class="tg-yw4l">Data Not Available</td>
              </tr>
            <?php } ?>
          




        </table>
        <?php endforeach; ?>
    <?php else : ?>


    <?php endif; ?>
  

<?php else : ?>
<div class="titles">
  <p>Performance QA Staff <?= $this->M_ReportQa->ReportperQa("getqa" , $idQa); ?> Periode <?= $startdate . " / " . $enddate;  ?> </p>
</div>
<table class="tg" style="undefined;table-layout: fixed; width: 1218px">
<colgroup>
<col style="width: 119px">
<col style="width: 136px">
<col style="width: 126px">
<col style="width: 137px">
<col style="width: 148px">
<col style="width: 138px">
<col style="width: 155px">
<col style="width: 120px">
<col style="width: 139px">
<col style="width: 139px">

</colgroup>
  <tr>
    <th class="tg-e3zv">Date</th>
    <th class="tg-e3zv">Nama</th>
    <th class="tg-e3zv">Target Achievement</th>
    <th class="tg-e3zv">Target Polis 2 Jam</th>
    <th class="tg-9hbo">Target Durasi 2 Jam</th>
    <th class="tg-9hbo">Target Polis Perhari</th>
    <th class="tg-9hbo">Target Durasi</th>
    <th class="tg-9hbo">Production Sales</th>
    <th class="tg-9hbo">Achievement Pif</th>
    <th class="tg-9hbo">Achievement Durasi</th>
  </tr>
  <?php  
      $reportperformanceqa = $this->M_ReportQa->ReportperQa( "getperformance" , $idQa , $startdate , $enddate );
            
            if ( $reportperformanceqa != "error" ) { 
                foreach ( $reportperformanceqa->result() as $rpq ) { ?>
              <tr>
                <td class="tg-yw4l"><?= $rpq->Updates; ?></td>
                <td class="tg-yw4l"><?= $rpq->NamaQa; ?></td>
                <td class="tg-yw4l static">490</td>
                <td class="tg-yw4l static">6</td>
                <td class="tg-yw4l static">120</td>
                <td class="tg-yw4l static">25</td>
                <td class="tg-yw4l static">490</td>
                <td class="tg-yw4l static"><?= $rpq->totalProduction; ?></td>
                <td class="tg-yw4l"><?= $rpq->totalAchievementPif; ?></td>
                <td class="tg-yw4l"><?= $rpq->totalDuration; ?></td>
              </tr>

                <?php } 
                $reportperformanceqas = $this->M_ReportQa->ReportperQa( "getperformance" , $idQa  , $startdate , $enddate, 'ALL' );
                if ( $reportperformanceqas != "error" ) { 
                    $rpqs = $reportperformanceqas->row();
                ?>
                  <tr class="totalAll">
                    <td class="tg-yw4l" colspan="7">Total</td>
                    <td class="tg-yw4l static"><?= $rpqs->totalProduction; ?></td>
                    <td class="tg-yw4l"><?= $rpqs->totalAchievementPif; ?></td>
                    <td class="tg-yw4l"><?= $rpqs->totalDuration; ?></td>
                  </tr>
               <?php } ?>
                
             <?php } else { ?>
              <tr >
                <td colspan='10' class="tg-yw4l">Data Not Available</td>
              </tr>
            <?php } ?>

            

</table>


<?php endif; ?>





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
