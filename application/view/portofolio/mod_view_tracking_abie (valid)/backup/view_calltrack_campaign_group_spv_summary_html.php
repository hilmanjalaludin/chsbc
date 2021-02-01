<?php $this->load->view("mod_view_tracking/view_calltrack_header_table_summary_html"); ?>
<?php 

//------- define attribute summary ----------------------------------------------

 $sum_tot_new_assign=0;
 $sum_tot_de_assign=0;
 $sum_tot_re_assign=0;
 $sum_tot_solicited_new_assign=0;
 $sum_tot_solicited_re_assign=0;
 $sum_tot_solicited_per_utilize=0;
 $sum_tot_sort_db_new=0;
 $sum_tot_attempt_call=0;
 $sum_tot_attempt_ratio=0;
 $sum_tot_connected_yes=0;
 $sum_tot_status_101=0;
 $sum_tot_status_102=0;
 $sum_tot_status_103=0;
 $sum_tot_connect_rate=0;
 $sum_tot_contacted_yes=0;
 $sum_tot_status_201=0;
 $sum_tot_status_202=0;
 $sum_tot_status_203=0;
 $sum_tot_status_204=0;
 $sum_tot_status_205=0;
 $sum_tot_status_206=0;
 $sum_tot_status_207=0;
 $sum_tot_status_208=0;
 $sum_tot_status_209=0;
 $sum_tot_status_210=0;
 $sum_tot_status_211=0;
 $sum_tot_contacted_rate=0;
 $sum_tot_sale_closing_rate=0;
 $sum_tot_response_rate=0;
 $sum_tot_persentation=0;
 $sum_tot_persentation_rate=0;
 $sum_tot_status_601=0;
 $sum_tot_status_602=0;
 $sum_tot_status_603=0;
 $sum_tot_status_301=0;
 $sum_tot_status_302=0;
 $sum_tot_status_303=0;
 $sum_tot_status_304=0;
 $sum_tot_status_305=0;
 $sum_tot_status_306=0;
 $sum_tot_status_307=0;
 $sum_tot_status_308=0;
 $sum_tot_status_309=0;
 $sum_tot_status_310=0;
 $sum_tot_status_311=0;
 $sum_tot_status_312=0;
 $sum_tot_status_313=0;
 $sum_tot_status_314=0;
 $sum_tot_status_315=0;
 $sum_tot_status_316=0;
 $sum_tot_status_317=0;
 $sum_tot_status_318=0;
 $sum_tot_status_401=0;
 $sum_tot_status_402=0;
 $sum_tot_nos_rate=0;
 $sum_tot_acv_pif=0;
 $sum_tot_acv_nos=0;
 $sum_tot_acv_anp=0;
 $sum_tot_talk_time=0;
 $sum_tot_avg_talk_time_per_hour=0;
 $sum_tot_avg_talk_time_per_tmr=0;
 $sum_tot_work_hours=0;
 $sum_tot_tmr_login=0;
 $sum_tot_work_days=0;
 $sum_tot_productivity_per_tmr_pif=0;
 $sum_tot_productivity_per_tmr_anp=0;
 $sum_tot_avg_atempt_per_tmr=0;
 $sum_tot_avg_premi=0;
 $sum_tot_bad_list=0;
 $sum_data_followup = 0;
 $sum_tot_avg_bad_list = 0;
 
  

// ------ get attribute data user tmr  ----------------------------------

 $tot_data_user_login = ( $call_content['data_tot_user_login'] ? $call_content['data_tot_user_login'] : 0);
 $tot_data_work_days  = ( $call_content['data_tot_day_work'] ? $call_content['data_tot_day_work'] : 0);
 $tot_data_work_hours = ( $call_content['data_tot_hour_work'] ? $call_content['data_tot_hour_work'] : 0);
 $tot_data_format_hours = _getDuration($tot_data_work_hours);
 $tot_data_talk_hour = 3600;
 
// ------------------- load content ------------------

$css_val = "xl7010476";
$xls_val = 0;
if( is_array($call_users) )  
	foreach( $call_users as $CampaignId => $rows )
{


 $bg_color = ( $xls_val % 2 == 1 ? "#FFFFFF" : "#FFFFEE");
 
// --------- index ----------------------- 
 $AgentName  = $rows['full_name'];
 $AgentId = $rows['UserId'];
 
// --------- get datat DB ---

 $call_data_content = $call_content[$AgentId];

// ------------- total data talk time -----
 $tot_data_talk_time =($call_data_content['data_tot_talk_time']? $call_data_content['data_tot_talk_time'] : 0 );

 
// --------- total Policy Insured -----------

 $tot_data_policy = ( $call_data_content['total_data_policy'] ? $call_data_content['total_data_policy'] : 0 );
 $tot_data_insured = ( $call_data_content['tot_data_insured'] ? $call_data_content['tot_data_insured'] : 0 );
 $tot_data_premi  = ( $call_data_content['tot_data_premi'] ? $call_data_content['tot_data_premi'] : 0 );
 $tot_format_data_premi  = _getCurrency($tot_data_premi);
 
 
 
//---------------------------------------------------------------------------------------------------
 $tot_new_assigned_data = ( $call_data_content['tot_new_assigned'] ? $call_data_content['tot_new_assigned']: 0);
 $tot_de_assigned_data = 0;
 $tot_re_assigned_data = ( $call_data_content['tot_re_assigned'] ? $call_data_content['tot_re_assigned'] : 0 );
 $tot_solicited_new_assign = ( $call_data_content['data_utilize'] ? $call_data_content['data_utilize'] : 0 );
 $tot_solicited_re_utilized = 0;
 $tot_solicited_per_utilized  = 0;
 
// ------------------ solicited ----------------------------------------------------	

 $tot_data_utilize = ( $tot_solicited_new_assign + $tot_solicited_re_utilized);
 $tot_data_sort_new_db = (  $tot_new_assigned_data ? ( $tot_new_assigned_data-$tot_solicited_new_assign) : 0 );
 
 
// --------- atempt  ----------------------
 $tot_data_atempt = ( $call_data_content['tot_data_atempt'] ? $call_data_content['tot_data_atempt'] : 0 );
 $avg_data_atempt = ( $tot_data_atempt ? _setRound(($tot_data_atempt/ $tot_data_utilize)) : 0 );
 
// ----total Y ( 201,202,203,204,205,206,207,208,209,210,211) ----------------

 $tot_data_connected_y201 = ( $call_data_content['tot_data_status_201'] ? $call_data_content['tot_data_status_201'] : 0);
 $tot_data_connected_y202 = ( $call_data_content['tot_data_status_202'] ? $call_data_content['tot_data_status_202'] : 0);
 $tot_data_connected_y203 = ( $call_data_content['tot_data_status_203'] ? $call_data_content['tot_data_status_203'] : 0);
 $tot_data_connected_y204 = ( $call_data_content['tot_data_status_204'] ? $call_data_content['tot_data_status_204'] : 0);
 $tot_data_connected_y205 = ( $call_data_content['tot_data_status_205'] ? $call_data_content['tot_data_status_205'] : 0);
 $tot_data_connected_y206 = ( $call_data_content['tot_data_status_206'] ? $call_data_content['tot_data_status_206'] : 0);
 $tot_data_connected_y207 = ( $call_data_content['tot_data_status_207'] ? $call_data_content['tot_data_status_207'] : 0);
 $tot_data_connected_y208 = ( $call_data_content['tot_data_status_208'] ? $call_data_content['tot_data_status_208'] : 0);
 $tot_data_connected_y209 = ( $call_data_content['tot_data_status_209'] ? $call_data_content['tot_data_status_209'] : 0);
 $tot_data_connected_y210 = ( $call_data_content['tot_data_status_210'] ? $call_data_content['tot_data_status_210'] : 0);
 $tot_data_connected_y211 = ( $call_data_content['tot_data_status_211'] ? $call_data_content['tot_data_status_211'] : 0);
 
 $tot_data_connected_y = ( $tot_data_connected_y201+
					       $tot_data_connected_y202+
						   $tot_data_connected_y203+
						   $tot_data_connected_y204+
						   $tot_data_connected_y205+
						   $tot_data_connected_y206+
						   $tot_data_connected_y207+
						   $tot_data_connected_y208+
						   $tot_data_connected_y209+
						   $tot_data_connected_y210+
						   $tot_data_connected_y211 ); 
						
 
// --------- tot data N (101, 102, 103 )--- 
 
 $tot_data_connected_n101 = ( $call_data_content['tot_data_status_101'] ? $call_data_content['tot_data_status_101'] : 0 );
 $tot_data_connected_n102 = ( $call_data_content['tot_data_status_102'] ? $call_data_content['tot_data_status_102'] : 0 );
 $tot_data_connected_n103 = ( $call_data_content['tot_data_status_103'] ? $call_data_content['tot_data_status_103'] : 0 );
 
// -- avg coneected rate ----------
 $avg_data_connect_rate  = ( $tot_data_connected_y ? _setPercent( ( $tot_data_connected_y/$tot_data_utilize)): 0 );

 
// ---------- data interes --------------------------
 $tot_data_interest_601 = ( $call_data_content['tot_data_status_601'] ? $call_data_content['tot_data_status_601'] : 0);
 $tot_data_interest_602 = ( $call_data_content['tot_data_status_602'] ? $call_data_content['tot_data_status_602'] : 0);
 $tot_data_interest_603 = ( $call_data_content['tot_data_status_603'] ? $call_data_content['tot_data_status_603'] : 0);

// -------- data not interest (301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317)	

 $tot_data_not_interest_301 = ( $call_data_content['tot_data_status_301'] ? $call_data_content['tot_data_status_301'] : 0);
 $tot_data_not_interest_302 = ( $call_data_content['tot_data_status_302'] ? $call_data_content['tot_data_status_302'] : 0);
 $tot_data_not_interest_303 = ( $call_data_content['tot_data_status_303'] ? $call_data_content['tot_data_status_303'] : 0);
 $tot_data_not_interest_304 = ( $call_data_content['tot_data_status_304'] ? $call_data_content['tot_data_status_304'] : 0);
 $tot_data_not_interest_305 = ( $call_data_content['tot_data_status_305'] ? $call_data_content['tot_data_status_305'] : 0);
 $tot_data_not_interest_306 = ( $call_data_content['tot_data_status_306'] ? $call_data_content['tot_data_status_306'] : 0);
 $tot_data_not_interest_307 = ( $call_data_content['tot_data_status_307'] ? $call_data_content['tot_data_status_307'] : 0);
 $tot_data_not_interest_308 = ( $call_data_content['tot_data_status_308'] ? $call_data_content['tot_data_status_308'] : 0);
 $tot_data_not_interest_309 = ( $call_data_content['tot_data_status_309'] ? $call_data_content['tot_data_status_309'] : 0);
 $tot_data_not_interest_310 = ( $call_data_content['tot_data_status_310'] ? $call_data_content['tot_data_status_310'] : 0);
 $tot_data_not_interest_311 = ( $call_data_content['tot_data_status_311'] ? $call_data_content['tot_data_status_311'] : 0);
 $tot_data_not_interest_312 = ( $call_data_content['tot_data_status_312'] ? $call_data_content['tot_data_status_312'] : 0);
 $tot_data_not_interest_313 = ( $call_data_content['tot_data_status_313'] ? $call_data_content['tot_data_status_313'] : 0);
 $tot_data_not_interest_314 = ( $call_data_content['tot_data_status_314'] ? $call_data_content['tot_data_status_314'] : 0);
 $tot_data_not_interest_315 = ( $call_data_content['tot_data_status_315'] ? $call_data_content['tot_data_status_315'] : 0);
 $tot_data_not_interest_316 = ( $call_data_content['tot_data_status_316'] ? $call_data_content['tot_data_status_316'] : 0);
 $tot_data_not_interest_317 = ( $call_data_content['tot_data_status_317'] ? $call_data_content['tot_data_status_317'] : 0);

 
 // -------- data not interest (301,302,303,304,305,306,307,308,309,310,311,312,313,314,315,316,317)	
  $tot_data_call_status_318 = ( $call_data_content['tot_data_status_318'] ? $call_data_content['tot_data_status_318'] : 0);
  $tot_data_call_status_401 = ( $call_data_content['tot_data_status_401'] ? $call_data_content['tot_data_status_401'] : 0);
  $tot_data_call_status_402 = ( $call_data_content['tot_data_status_402'] ? $call_data_content['tot_data_status_402'] : 0);  
  
  
 // --- total perensttion ----
 $tot_data_persentation = ( $tot_data_not_interest_301+ 
							$tot_data_not_interest_302+
							$tot_data_not_interest_303+
							$tot_data_not_interest_304+
							$tot_data_not_interest_305+
							$tot_data_not_interest_306+
							$tot_data_not_interest_307+
							$tot_data_not_interest_308+
							$tot_data_not_interest_309+
							$tot_data_not_interest_310+
							$tot_data_not_interest_311+
							$tot_data_not_interest_312+
							$tot_data_not_interest_313+
							$tot_data_not_interest_314+
							$tot_data_not_interest_315+
							$tot_data_not_interest_316+
							$tot_data_not_interest_317+
							$tot_data_policy );
							
// --------------- response rate --------------------------
 $avg_response_rate = ( $tot_data_utilize ? _setPercent(($tot_data_policy/$tot_data_utilize)): 0 );
 $tot_contacted_y = ( $tot_data_persentation + $tot_data_call_status_318+ $tot_data_call_status_401);
 $avg_sales_closing = ( $tot_contacted_y ? _setPercent(($tot_data_policy/$tot_contacted_y)) : 0 );
 
// total followup 

  $tot_data_followup  = ($tot_data_call_status_401+$tot_data_call_status_402);
  $avg_data_followup  = ( $tot_contacted_y ? _setPercent(($tot_data_followup/$tot_contacted_y)) : 0);
  
// --- Persentation Rate 
 $avg_data_persentation  = ( ($tot_contacted_y) ? _setPercent(($tot_data_persentation/$tot_contacted_y)): 0 );
 $avg_data_nos_rate = ( $tot_data_policy ? _setPercent( (($tot_data_insured-$tot_data_policy)/$tot_data_policy)) : 0);
 $avg_data_contacted_rate  = ( $tot_data_utilize ? ( $tot_contacted_y/$tot_data_utilize) : 0 );
 $avg_data_format_contacted_rate  = _setPercent( $avg_data_contacted_rate);
 
// --- total data badlist ----------------------
 $tot_data_bad_list  = ( $tot_data_connected_n101+ 
						 $tot_data_connected_n102+ 
						 $tot_data_connected_n103+
						 $tot_data_connected_y204+
						 $tot_data_connected_y209+
						 $tot_data_connected_y211);
						 
 $avg_data_bad_list = ( $tot_data_utilize ? _setPercent(($tot_data_bad_list/$tot_data_utilize)) : 0);
 
// --- avg talktime / hour 
 $tot_data_format_talk_time = _getDuration($tot_data_talk_time);
 $avg_data_talk_time_hours = ( $tot_data_work_hours ? ($tot_data_talk_time/$tot_data_work_hours): 0 );
 $avg_data_format_talk_time_hour = _getDuration($avg_data_talk_time_hours);
 
 $avg_data_talk_time_per_tmr = ( $tot_data_talk_time ? ($tot_data_talk_time/$tot_data_user_login) : 0);   
 $avg_data_format_talk_time_per_tmr = _getDuration($avg_data_talk_time_per_tmr);
 
// ----------------- productivity -------------------------- 
 $avg_data_productivity_pif_per_tmr = ( ($tot_data_user_login) ? ($tot_data_policy/$tot_data_user_login) : 0);
 $avg_data_format_productivity_pif_per_tmr = _setPercent($avg_data_productivity_pif_per_tmr);

 // ----------------- productivity --------------------------
 
 $avg_data_productivity_anp_per_tmr = ( ($tot_data_user_login) ? $tot_data_premi/$tot_data_user_login : 0);
 $avg_data_format_productivity_anp_per_tmr = _getCurrency($avg_data_productivity_anp_per_tmr);
 
 // ----------------- productivity --------------------------
 
 $avg_data_productivity_atempt_per_tmr = ( ($tot_data_user_login) ? ($tot_data_atempt/$tot_data_user_login) : 0); 
 $avg_data_format_productivity_atempt_per_tmr = _setPercent( $avg_data_productivity_atempt_per_tmr);
 
 // ----------------- productivity --------------------------
 
 $avg_data_productivity_premi_per_policy_per_year = ( $tot_data_policy ? (($tot_data_premi/$tot_data_policy) /12) : 0);
 $avg_data_format_productivity_premi_per_policy_per_year = _getCurrency($avg_data_productivity_premi_per_policy_per_year);
 
 
// ------------ end option -----------------------------------------

echo "<tr height=28 bgcolor={$bg_color}>
	  <td class='{$css_val} border-top-none-left-yes font-align-left-color-696868' nowrap>{$AgentName}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_new_assigned_data}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_re_assigned_data}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_solicited_new_assign}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_solicited_re_utilized}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_utilize}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_sort_new_db}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_atempt}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_atempt}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_n101}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_n102}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_n103}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_connect_rate}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_contacted_y}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y201}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y202}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y203}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y204}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y205}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y206}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y207}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y208}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y209}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y210}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_connected_y211}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_contacted_rate}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_persentation}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_persentation}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_interest_601}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_interest_602}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_interest_603}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_301}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_302}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_303}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_304}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_305}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_306}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_307}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_308}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_309}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_310}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_311}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_312}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_313}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_314}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_315}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_316}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_not_interest_317}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_call_status_318}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_call_status_401}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_call_status_402}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_followup}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_policy}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_insured}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_format_data_premi}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_sales_closing}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_response_rate}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_nos_rate}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_format_talk_time}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_talk_time_hour}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_talk_time_per_tmr}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_format_hours}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_user_login}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_work_days}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_productivity_pif_per_tmr}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_productivity_anp_per_tmr}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_productivity_atempt_per_tmr}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_format_productivity_premi_per_policy_per_year}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$tot_data_bad_list}</td>
	  <td class='{$css_val} border-top-none-left-none'>{$avg_data_bad_list}</td>
 </tr>";
 
// ------------------- summary attribute data ---------------------------------------
 
 $sum_tot_new_assign+= $tot_new_assigned_data;
 $sum_tot_de_assign+= $tot_de_assigned_data;
 $sum_tot_re_assign+= $tot_re_assigned_data;
 $sum_tot_solicited_new_assign+= $tot_solicited_new_assign;
 $sum_tot_solicited_re_assign+= $tot_solicited_re_utilized;
 $sum_tot_solicited_per_utilize+= $tot_data_utilize;
 $sum_tot_sort_db_new+=$tot_data_sort_new_db;
 $sum_tot_attempt_call+=$tot_data_atempt;
 $sum_tot_connected_yes+=$tot_data_connected_y;
 
 // ------------------ summary  of contacted [  Y ]total bottom -------------------------
 
 $sum_tot_status_201+= $tot_data_connected_y201;
 $sum_tot_status_202+= $tot_data_connected_y202;
 $sum_tot_status_203+= $tot_data_connected_y203;
 $sum_tot_status_204+= $tot_data_connected_y204;
 $sum_tot_status_205+= $tot_data_connected_y205;
 $sum_tot_status_206+= $tot_data_connected_y206;
 $sum_tot_status_207+= $tot_data_connected_y207;
 $sum_tot_status_208+= $tot_data_connected_y208;
 $sum_tot_status_209+= $tot_data_connected_y209;
 $sum_tot_status_210+= $tot_data_connected_y210;
 $sum_tot_status_211+= $tot_data_connected_y211;
 
// ------------------ summary  of contacted [ N ]total bottom ------------------------- 

 $sum_tot_status_101+= $tot_data_connected_n101;
 $sum_tot_status_102+= $tot_data_connected_n102;
 $sum_tot_status_103+= $tot_data_connected_n103;
 
// ------------------ summary  of  Interest total bottom -------------------------'

 $sum_tot_status_601+= $tot_data_interest_601;
 $sum_tot_status_602+= $tot_data_interest_602;
 $sum_tot_status_603+= $tot_data_interest_603;

// ------------------ summary  of  Not Interest total bottom -------------------------
 $sum_tot_status_301+= $tot_data_not_interest_301;
 $sum_tot_status_302+= $tot_data_not_interest_302;
 $sum_tot_status_303+= $tot_data_not_interest_303;
 $sum_tot_status_304+= $tot_data_not_interest_304;
 $sum_tot_status_305+= $tot_data_not_interest_305;
 $sum_tot_status_306+= $tot_data_not_interest_306;
 $sum_tot_status_307+= $tot_data_not_interest_307;
 $sum_tot_status_308+= $tot_data_not_interest_308;
 $sum_tot_status_309+= $tot_data_not_interest_309;
 $sum_tot_status_310+= $tot_data_not_interest_310;
 $sum_tot_status_311+= $tot_data_not_interest_311;
 $sum_tot_status_312+= $tot_data_not_interest_312;
 $sum_tot_status_313+= $tot_data_not_interest_313;
 $sum_tot_status_314+= $tot_data_not_interest_314;
 $sum_tot_status_315+= $tot_data_not_interest_315;
 $sum_tot_status_316+= $tot_data_not_interest_316;
 $sum_tot_status_317+= $tot_data_not_interest_317;
 
// --------------- summary of Unpersent ---------------------------------------
 $sum_tot_persentation+=$tot_data_persentation;
 $sum_tot_status_318+= $tot_data_call_status_318;
 
// --------------- summary of followup & ---------------------------------------

 $sum_tot_status_401+= $tot_data_call_status_401; 
 $sum_tot_status_402+= $tot_data_call_status_402;
 $sum_tot_acv_pif+= $tot_data_policy;
 $sum_tot_acv_nos+= $tot_data_insured;
 $sum_tot_acv_anp+= $tot_data_premi;
 $sum_tot_format_acv_anp = _getCurrency($sum_tot_acv_anp);
 $sum_tot_talk_time+= $tot_data_talk_time;
 $sum_tot_bad_list +=$tot_data_bad_list;
 $sum_data_followup +=$tot_data_followup;
 
 $xls_val++;
}
// ----------------- callculate of bottom avg ----------------------------

 $sum_tot_tmr_login = $tot_data_user_login;
 $sum_tot_work_days = $tot_data_work_days;
 $sum_tot_work_hours = $tot_data_work_hours;
 
 $sum_tot_contacted = ($sum_tot_persentation+$sum_tot_status_318+$sum_tot_status_401);
 $sum_tot_attempt_ratio = ($sum_tot_solicited_per_utilize  ? ($sum_tot_attempt_call/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_connect_rate  = ($sum_tot_solicited_per_utilize ? ($sum_tot_connected_yes/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_contacted_rate = ($sum_tot_solicited_per_utilize ? ($sum_tot_contacted/ $sum_tot_solicited_per_utilize) : 0 );
 $sum_tot_sale_closing_rate = ($sum_tot_contacted ? ($sum_tot_acv_pif/$sum_tot_contacted) : 0 );
 $sum_tot_response_rate = ($sum_tot_solicited_per_utilize ? ( $sum_tot_acv_pif/$sum_tot_solicited_per_utilize): 0);
 $sum_tot_persentation_rate = ($sum_tot_contacted ? ( $sum_tot_persentation /$sum_tot_contacted ) : 0);
 $sum_tot_nos_rate = (($sum_tot_acv_nos - $sum_tot_acv_pif ) ? ( ( $sum_tot_acv_nos - $sum_tot_acv_pif )/$sum_tot_acv_pif) : 0); 
 $sum_tot_avg_talk_time_per_hour= ( $sum_tot_talk_time ? ($sum_tot_talk_time/$sum_tot_work_hours): 0 );
 $sum_tot_avg_talk_time_per_tmr= ( $sum_tot_talk_time ? ($sum_tot_talk_time/ $sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_pif = (($sum_tot_tmr_login) ? ($sum_tot_acv_pif/$sum_tot_tmr_login) : 0);
 $sum_tot_productivity_per_tmr_anp = (($sum_tot_tmr_login) ? ($sum_tot_acv_anp/$sum_tot_tmr_login) : 0);
 $sum_tot_avg_atempt_per_tmr = (($sum_tot_tmr_login) ? ($sum_tot_attempt_call/$sum_tot_tmr_login) : 0); 
 $sum_tot_avg_premi = ( $sum_tot_acv_pif ? (($sum_tot_acv_anp/ $sum_tot_acv_pif) /12) : 0);
 $sum_tot_avg_followup = ( $sum_tot_contacted ? ($sum_data_followup/$sum_tot_contacted) : 0);
 $sum_tot_avg_bad_list = ( $sum_tot_solicited_per_utilize ? ($sum_tot_bad_list/$sum_tot_solicited_per_utilize) : 0);
 
 
// --------------------------------------------------------------------------------------------------------
 
 $sum_tot_format_attempt_ratio 	 	= _setRound($sum_tot_attempt_ratio);
 $sum_tot_format_connect_rate 	 	= _setPercent($sum_tot_connect_rate);
 $sum_tot_format_contacted_rate  	= _setPercent($sum_tot_contacted_rate);
 $sum_tot_format_nos_rate 		    = _setPercent($sum_tot_nos_rate);
 $sum_tot_format_response_rate 	    = _setPercent($sum_tot_response_rate);
 $sum_tot_format_persentation_rate  = _setPercent($sum_tot_persentation_rate);
 $sum_tot_format_sale_closing_rate  = _setPercent($sum_tot_sale_closing_rate);
 $sum_tot_productivity_per_tmr_pif  = _setPercent($sum_tot_productivity_per_tmr_pif);
 $sum_tot_avg_atempt_per_tmr 	    = _setPercent($sum_tot_avg_atempt_per_tmr);
 $sum_tot_format_avg_followup	    = _setPercent($sum_tot_avg_followup);
 $sum_tot_format_avg_bad_list		= _setPercent($sum_tot_avg_bad_list);
 
 // ----------- other format  ----------------------------------------------------------------
 $sum_tot_format_talk_time 				= _getDuration($sum_tot_talk_time);
 $sum_tot_format_work_hours 			= _getDuration($sum_tot_work_hours);
 $sum_tot_format_avg_talk_time_per_hour = _getDuration($sum_tot_avg_talk_time_per_hour);  
 $sum_tot_format_avg_talk_time_per_tmr 	= _getDuration($sum_tot_avg_talk_time_per_tmr); 
 $sum_tot_productivity_per_tmr_anp 		= _getCurrency($sum_tot_productivity_per_tmr_anp); 
 $sum_tot_avg_premi 					= _getCurrency($sum_tot_avg_premi);
   
 
  
  
// ------------- contacted rate ---------------------

 
$css_val = "xl6510477";
echo "<tr height=30 style='color:#FFFFEE;'>
		<td class='{$css_val} border-top-none-left-yes' style='text-align:left;' nowrap>Summary</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_new_assign}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_re_assign}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_solicited_new_assign}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_solicited_re_assign}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_solicited_per_utilize}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_sort_db_new}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_attempt_call}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_attempt_ratio}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_connected_yes}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_101}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_102}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_103}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_connect_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_contacted_yes}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_201}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_202}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_203}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_204}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_205}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_206}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_207}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_208}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_209}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_210}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_211}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_contacted_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_persentation}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_persentation_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_601}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_602}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_603}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_301}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_302}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_303}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_304}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_305}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_306}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_307}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_308}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_309}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_310}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_311}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_312}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_313}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_314}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_315}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_316}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_317}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_318}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_401}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_status_402}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_avg_followup}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_acv_pif}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_acv_nos}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_acv_anp}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_sale_closing_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_response_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_nos_rate}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_talk_time}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_avg_talk_time_per_hour}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_avg_talk_time_per_tmr}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_work_hours}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_tmr_login}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_work_days}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_productivity_per_tmr_pif}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_productivity_per_tmr_anp}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_avg_atempt_per_tmr}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_avg_premi}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_bad_list}</td>
		<td class='{$css_val} border-top-none-left-none'>{$sum_tot_format_avg_bad_list}</td>
 </tr>";
 
?>
<!-- load footer table --> 

<?php $this->load->view("mod_view_tracking/view_calltrack_footer_table_summary_html"); ?>