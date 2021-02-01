<?php 
/*
 * @ package 		modulation 
 */
?>	
<ul>
	<li class="ui-tab-li-none"> 
		<a href="#ui-widget-user-callhistory">
		<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Call In History");?> </a> </li>
	
	<li class="ui-tab-li-none"> 
		<a href="#ui-widget-outbound-callhistory">
		<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Call Out History");?> </a> </li>
		
	<?php if( SysCallerModul('V_CMP_MODUL') ) : ?>	
	<li class="ui-tab-li-none"> <a href="#ui-widget-user-ticket">
		<span class="ui-icon ui-icon-newwin"></span><?php echo lang("Complaint History");?> </a> </li>
	<?php endif; ?>
	
	<?php //if( SysCallerModul('V_SMS_MODUL') ) : ?>	
	<!-- <li class="ui-tab-li-lasted"> <a href="#ui-widget-user-sms">
		<span class="ui-icon ui-icon-mail-closed"></span><?php //echo lang("SMS History");?> </a> </li> -->
	<?php //endif; ?>
	
	<?php if( SysCallerModul('V_APP_MODUL') ) : ?>	
	<li class="ui-tab-li-none"> <a href="#ui-widget-user-apointment">
		<span class="ui-icon ui-icon-clock"></span><?php echo lang("Rawat Jalan History");?> </a> </li>
	<?php endif; ?>	
	

	<?php if( SysCallerModul('V_APP_MODUL') ) : ?>		
	<li class="ui-tab-li-none"> <a href="#ui-widget-user-mcu">
		<span class="ui-icon ui-icon-clock"></span><?php echo lang("MCU History");?> </a> </li>
	<?php endif; ?>	
	
	<?php if( SysCallerModul('V_BOK_MODUL') ) : ?>		
	<li class="ui-tab-li-lasted"> <a href="#ui-widget-user-booking">
		<span class="ui-icon ui-icon-clock"></span><?php echo lang("Booking History");?> </a> </li>
	<?php endif; ?>		
	
</ul>
	
	<div id="ui-widget-user-callhistory" class="ui-widget-user-callhistory"></div>
	<div id="ui-widget-outbound-callhistory" class="ui-widget-user-callhistory"></div>
	
	
	<?php if( SysCallerModul('V_CMP_MODUL') ) : ?>	
	<div id="ui-widget-user-ticket" class="ui-widget-user-ticket" >
		<div class="ui-widget-user-ticket-nav">
			<table>
				<tr>
					<td class="text_caption"> <span class="primary fa fa-book"></span> </td>
					<td>&nbsp;<?php echo form()->input("ticket_no","input_text long customize");?></td>
					<td><?php echo form()->link(lang("Search by ticket number"), "fa-search", "FindByTicket") ;?></td>
				</tr>
			</table>
		</div>
		<div id="ui-widget-content-ticket" class="ui-widget-content-ticket"></div>
	</div>
	<?php endif; ?>
	
	 <?php //if( SysCallerModul('V_SMS_MODUL') ) : ?>	
	<!--<div id="ui-widget-user-sms" class="ui-widget-user-sms"> </div>-->
	<?php //endif; ?> 
	
	<?php if( SysCallerModul('V_APP_MODUL') ) : ?>	
	 <div id="ui-widget-user-apointment" class="ui-widget-user-sms"> </div>
	<?php endif; ?>
	
	<?php if( SysCallerModul('V_APP_MODUL') ) : ?>	
	<div id="ui-widget-user-mcu" class="ui-widget-user-sms"> </div>
	<?php endif; ?>
	
	<?php if( SysCallerModul('V_BOK_MODUL') ) : ?>	
	<div id="ui-widget-user-booking" class="ui-widget-user-sms"> </div>
	<?php endif; ?>