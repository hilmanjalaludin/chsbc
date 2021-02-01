
<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */
?>

<?php if ( $status == "ui" ) : ?>
<title>QA Activity</title>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
.tg .tg-qkx5{font-weight:bold;background-color:#f38630;color:#ffffff;text-align:center;vertical-align:top;}
.tg .tg-hgcj{font-weight:bold;text-align:center;}
.tg .tg-yw4l{vertical-align:top;}
p {
    padding:10px;
    font-family:Arial, sans-serif;
    font-size:20px;
}
</style>


  


  <?php  
  /* Status Not Ready
        * 1. Briefing
        * 2. Pray
        * 3. Rest
        * 4. Lunch
        * 5. Outbound
    */
$date = $startdate;
$end_date = $enddate;
$no = 1;
while (strtotime($date) <= strtotime($end_date)) { 

  $getQaActivity = $this->M_ReportQa->getQaActivity($date, $enddate ,'getactivityqa');
  if ( $getQaActivity != "error" ) {
    $no = 1; ?>

<div class="titles">
    <p>QA Activity <?= $date; ?> </p>
</div>

<table class="tg" style="undefined;table-layout: fixed; width: 1161px">
<colgroup>
<col style="width: 53px">
<col style="width: 210px">
<col style="width: 87px">
<col style="width: 98px">
<col style="width: 96px">
<col style="width: 96px">
<col style="width: 79px">
<col style="width: 84px">
<col style="width: 89px">
<col style="width: 91px">
<col style="width: 90px">
<col style="width: 111px">
<col style="width: 120px">
</colgroup>
<tr>
    <th class="tg-hgcj" rowspan="2">No</th>
    <th class="tg-hgcj" rowspan="2">Name</th>
    <th class="tg-hgcj" rowspan="2">Date</th>
    <th class="tg-hgcj" rowspan="2">Start</th>
    <th class="tg-hgcj" rowspan="2">Finish</th>
    <th class="tg-hgcj" rowspan="2">Total Time<br></th>
    <th class="tg-hgcj" colspan="5">Not Ready<br></th>
    <th class="tg-hgcj" rowspan="2">Total Not Ready<br></th>
    <th class="tg-hgcj" rowspan="2">Ready <br> (Efective Time )</th>
  </tr>
  <tr>
    <td class="tg-qkx5">Briefing</td>
    <td class="tg-qkx5">Pray</td>
    <td class="tg-qkx5">Rest</td>
    <td class="tg-qkx5">Lunch</td>
    <td class="tg-qkx5">Outbound</td>
  </tr>

    <?php 
      foreach ( $getQaActivity->result() as $gqa ) {  

      ?>
          <tr>
            <td class="tg-yw4l"><?php echo $no++; ?></td>
            <td class="tg-yw4l"><?= $gqa->NamaQa; ?></td>
            <td class="tg-yw4l"><?= $gqa->DateSet; ?></td>
            <td class="tg-yw4l"><?= $gqa->StartTime; ?></td>
            <td class="tg-yw4l"><?= $gqa->EndTime; ?></td>
            <td class="tg-yw4l"><?= $gqa->TotalTime; ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->Briefing); ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->Pray); ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->Rest); ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->Lunch); ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->Outbound); ?></td>
            <td class="tg-yw4l"><?= _getDuration($gqa->TotalNotReady); ?></td>
            <td class="tg-yw4l"><?= $gqa->TotalTime-$gqa->TotalNotReady; ?></td>
          </tr> 
  <?php  }
  } else {

  }
  ?>
  </table>

  <?php 
  $date = date ("d-m-Y", strtotime("+1 day", strtotime($date)));

}
  ?>








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