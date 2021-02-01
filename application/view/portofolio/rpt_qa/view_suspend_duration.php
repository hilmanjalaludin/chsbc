<?php  
/**
 * ====================================
 * Start Report UI
 * ====================================
 */

 /**
  * Kurang total Suspend
  * 
  */

?>

<?php if ( $status == "ui" ) : ?>

<title>Report Per Period and Time</title>
<style type="text/css">
.tg {
    border-collapse: collapse;
    border-spacing: 0;
    border-color: #ccc;
}
.tg td {
    font-family: Arial, sans-serif;
    font-size: 14px;
    padding: 10px 5px;
    border-style: solid;
    border-width: 1px;
    overflow: hidden;
    word-break: normal;
    border-color: #ccc;
    color: #333;
    background-color: #fff;
}
.tg th {
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-weight: normal;
    padding: 10px 5px;
    border-style: solid;
    border-width: 1px;
    overflow: hidden;
    word-break: normal;
    border-color: #ccc;
    color: #333;
    background-color: #f0f0f0;
}
.tg .tg-z2al {
    font-weight: bold;
    font-family: Tahoma, Geneva, sans-serif !important;
    text-align: center;
    vertical-align: top;
}
.tg .tg-tinq {
    font-weight: bold;
    font-size: 13px;
    font-family: Tahoma, Geneva, sans-serif !important;
    text-align: center;
    vertical-align: top;
}
.tg .tg-yw4l {
    vertical-align: top;
}
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
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-g8v5{font-weight:bold;background-color:#eaeaea;text-align:center;vertical-align:top;}
.tg .tg-hgcj{font-weight:bold;text-align:center;}
.tg .tg-yw4l{vertical-align:top;}
.totalAll td {
  background:#32C7D0;
  color:white;
  font-weight:bold;
}
</style>

<div class="titles">
	<p> Performance Range Time Per Date Period <?= $startdate . " / " . $enddate;  ?> </p>
</div>


<?php  foreach ( $this->paramtime as $to => $end ) : ?>
    <p class="rangetime"> Performance Range Time <?= $to . " - " . $end ?> </p>
    <table class="tg" style="undefined;table-layout: fixed; width: 947px">
    <colgroup>
    <col style="width: 148px">
    <col style="width: 218px">
    <col style="width: 186px">
    <col style="width: 180px">
    <col style="width: 215px">
    </colgroup>
      <tr>
        <th class="tg-tinq">QA<br></th>
        <th class="tg-z2al">Date</th>
        <th class="tg-z2al">PIF</th>
        <th class="tg-z2al">Suspend</th>
        <th class="tg-z2al">Duration</th>
      </tr>
    <?php  
        $getPerrangeTime = $this->M_ReportQa->SuspendDuration( $to , $end , $startdate , $enddate , '' , 'getperformance' );     
        if ( $getPerrangeTime != false AND $getPerrangeTime->num_rows() > 0 ) {
            foreach ( $getPerrangeTime->result() as $gpt ) {
                if ( $gpt->NamaQa != NULL ) {
                    ?>
    <tr>
        <td class="tg-yw4l"><?= $gpt->NamaQa; ?><br></td>
        <td class="tg-yw4l"><?= $gpt->Updates; ?><br></td>
        <td class="tg-yw4l"><?= $gpt->totalFollow; ?><br></td>
        <td class="tg-yw4l"><?= $gpt->totalSuspend; ?><br></td>
        <td class="tg-yw4l"><?php if($gpt->TotalDuration == "" ) : echo 0; else : echo _getDuration($gpt->TotalDuration); endif; ?></td>
    </tr>
                    <?php 
                } else {
                    ?>
    <tr>
        <td class="tg-yw4l" colspan="5" align="center">Data Not Available!<br></td>
    </tr>
                    <?php 
                }
            }   
        $getPerrangeTimes = $this->M_ReportQa->SuspendDuration( $to , $end , $startdate , $enddate , '' , 'gettotal' );  
        if ( $getPerrangeTimes != false ) {
            $gpts = $getPerrangeTimes->row(); 

        // Get All total
        ?>
    <tr class='totalAll'>
        <td class="tg-yw4l">Total<br></td>
        <td class="tg-yw4l"><?= $gpts->Updates; ?><br></td>
        <td class="tg-yw4l"><?= $gpts->totalFollow; ?><br></td>
        <td class="tg-yw4l"><?= $gpts->totalSuspend; ?><br></td>
        <td class="tg-yw4l"><?= _getDuration($gpts->TotalDuration); ?></td>
    </tr>    
        <?php }  ?>



        <?php

        } else {
             ?>
    <tr>
        <td class="tg-yw4l" colspan="5" align="center">Data Not Available!<br></td>
    </tr>
                    <?php 
        }


    ?>

    </table>
    <br>


<?php endforeach; ?>

    <?php  

    $getAllTime = $this->M_ReportQa->SuspendDuration( $to , $end , $startdate , $enddate , "ALL" , 'gettotal' );
    if ( $getAllTime != false ) {
        $gal = $getAllTime->row();
    } else {

    }

    ?>
    <table class="tg" style="undefined;table-layout: fixed; width: 517px">
    <colgroup>
    <col style="width: 154px">
    <col style="width: 159px">
    <col style="width: 204px">
    </colgroup>
      <thead>
          <tr>
            <th class="tg-hgcj" colspan="3">Total</th>
          </tr>
          <tr>
            <td class="tg-g8v5">PIF</td>
            <td class="tg-g8v5">Duration</td>
            <td class="tg-g8v5">Suspend</td>
          </tr>
      </thead>

      <tbody>
          <tr>
            <td class="tg-yw4l"><?= $gal->totalFollow; ?></td>
            <td class="tg-yw4l"><?php if($gal->TotalDuration == "" ) : echo 0; else : echo _getDuration($gal->TotalDuration); endif; ?></td>
            <td class="tg-yw4l"><?= $gal->totalSuspend; ?></td>
          </tr>
      </tbody>
    </table>

</body>


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