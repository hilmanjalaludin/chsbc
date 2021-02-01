<?php $this->load->view("mod_view_tracking/view_calltrack_header_summary_html"); ?>
<?php $out = new EUI_Object($call_title); ?>

<table border=0 cellpadding=0 cellspacing=0 width="98%" >
 <tr>
  <td rowspan=3 height=152 class="xl6510476" nowrap><?php echo $out->get_value('HeaderName');?></td>
  <td colspan=6  class="xl6510476"  style='border-left:none;'>DB</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Attempted</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Attempt Ratio</td>
  <td colspan=5  class="xl6510476"  style='border-left:none;'>Connected</td>
  <td colspan=13 class="xl6510476"  style='border-left:none;'>Contacted</td>
  <td colspan=22 class="xl6510476"  style='border-left:none;'>Presentation</td>
  <td rowspan=2  class="xl6510476"  style='border-left:none;'>UnPresent RU</td>
  <td colspan=3  class="xl6510476"  style='border-left:none;'>Follow Up</td>
  
  <td colspan=3  class="xl6510476"  style='border-left:none;'>Achievement</td>
  
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Sales Closing Rate(%)</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Response Rate(%)</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>NOS Rate(%)</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Talk Time</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Ave Talktime/hours</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Ave Talk time/tmr</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Working Hour</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>#TMR</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Working Days</td>
  <td colspan=2  class="xl6510476"  style='border-left:none;'>Productivity/tmr</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Attempted/tmr</td>
  <td rowspan=3  class="xl6510476"  style='border-left:none;'>Ave Premium</td>
  <td colspan=2 class="xl6510476"  style='border-left:none;'>Bad List</td>
 </tr>
 
 <tr>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>New Assigned</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>Re Assigned</td>
  <td class="xl6510476" colspan=3  style='border-top:none;border-left:none;'>Solicited</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>Short DB new</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>Y</td>
  <td class="xl6510476" colspan=3  style='border-left:none;border-top:none;'>N</td>
  <td class="xl6510476" rowspan=2  style='border-left:none;border-top:none;'>Connected Rate(%)</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>Y</td>
  <td class="xl6510476" colspan=11 style='border-left:none;border-top:none;'>N</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>Rate(%)</td>
  <td class="xl6610476" rowspan=2  style='border-top:none;border-left:none;'>#Presentation</td>
  <td class="xl6610476" rowspan=2  style='border-top:none;border-left:none;'>Presentation Rate(%)</td>
  <td class="xl7710476" colspan=3  style='border-left:none;border-top:none;'>Interested</td>
  <td class="xl6510476" colspan=17 style='border-right:yes;border-top:none;'>Not Interested</td>
  <td class="xl6610476" colspan=2 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class="xl6510476" rowspan=2 style='border-top:none;border-left:none'>Rate(%)</td>
  <td class="xl6610476" rowspan=2  style='border-top:none;border-left:none'>PIF</td>
  <td class="xl6610476" rowspan=2  style='border-top:none;border-left:none'>NOS</td>
  <td class="xl6610476" rowspan=2  style='border-top:none;border-left:none' align="center">PREMIUM</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;'>PIF</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;' align="center">PREMIUM</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;' align="center">#</td>
  <td class="xl6510476" rowspan=2  style='border-top:none;border-left:none;' align="center">Ratio(%)</td>
  
 </tr>
 
 <tr height=80 style='height:60.0pt'>
  <td class="xl6510476" style='height:60.0pt;border-top:none; border-left:none;width:49pt'>solicited new Assigned</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>solicited ReUtilized</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>Total Solicited / Utilized</td>
 <td class="xl6510476" style='border-top:none;border-left:none;'>101</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>102</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>103</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>201</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>202</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>203</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>204</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>205</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>206</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>207</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>208</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>209</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>210</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>211</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>601</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>602</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>603</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>301</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>302</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>303</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>304</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>305</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>306</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>307</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>308</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>309</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>310</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>311</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>312</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>313</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>314</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>315</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>316</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>317</td>
  <td class="xl6510476" style='border-top:none;border-left:none'>318</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>401</td>
  <td class="xl6510476" style='border-top:none;border-left:none;'>402</td>
  
 </tr>
 