<table border=0 align="left" cellspacing=1 width="100%">
<tr height='24'>
	<th class="font-standars ui-corner-top ui-state-default first" width="10%" nowrap>&nbsp;Call Date</td>
	<th class="font-standars ui-corner-top ui-state-default first" width="10%" nowrap>&nbsp;Agent</td>
	<th class="font-standars ui-corner-top ui-state-default first" width="20%" nowrap>&nbsp;Call Status</td>
	<th class="font-standars ui-corner-top ui-state-default first" width="10%" nowrap>&nbsp;Approve Status</td>
	<th class="font-standars ui-corner-top ui-state-default first" width="40%" nowrap>&nbsp;Note</td>
	<th class="font-standars ui-corner-top ui-state-default first" width="10%" nowrap>&nbsp;#</td>
</tr>
<?php 
if(!is_null($CallHistory) 
	AND is_array($CallHistory) ) 
{  

?>
 <?php $i= 0; foreach($CallHistory as $rows ) { $color = ($i%2!=0?'#FFFEEE':'#FFFFFF');  ?>
<tr class='onselect' bgcolor='<?php __($color);?>'>
	<td class="content-first left" nowrap><?php __($rows['CallHistoryCreatedTs']);?></td>
	<td class="content-middle left" nowrap><?php __($rows['full_name']);?></td>
	<td class="content-middle left">
		<div class="text-content justify-text" >
			Status ( <span class="call-status"><?php __($rows['CallReasonCategoryName']);?></span> ) - 
			Reason ( <span class="result-status"><?php __($rows['CallReasonDesc']);?></span> )
		</div>
	</td>
	<td class="content-middle center"><div class="text-content justify-center "><span class="call-status"><?php __($rows['AproveName']);?></span></div></td>
	<td class="content-middle left"><div class="text-content justify-text"><?php __($rows['CallHistoryNotes']);?></div></td>
	<td class="content-lasted center" ><?php __(($rows['CallSessionId']?form()->button($rows['CallSessionId'],'play button','Play',array("click"=>"Ext.DOM.PlayByCallSession(this.name);")):null));?></td>
</tr>
<?php $i++; } ?>
<?php } ?>
</table>