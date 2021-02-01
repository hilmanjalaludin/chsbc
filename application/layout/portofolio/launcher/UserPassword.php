<?php

/*
 * @ def 	: User Password 
 * -----------------------------------
 * @ param 	: layout section
 * @ aksess : public
 * @ author	: razaki team
 */
 
?>
<div id="pass" title="Change Password" style="display:none;width:400px;">
  	<fieldset class="change_password" style="border:0px;">
		<table border="0" cellpadding="2px" cellspacing="0px;">
  		  <tr>
  		    <td class="text_caption" nowrap style="height:24px;"><label for="curr_password">Current Password</label> &nbsp;</td>
  		    <td><input type="password" name="curr_password" id="curr_password" class="input_text long" /></td>
  		  </tr>
  		  <tr>
  		    <td class="text_caption" nowrap  style="height:24px;"><label for="new_password">New Password</label>&nbsp;</td>
  		    <td><input type="password" name="new_password" id="new_password" value="" class="input_text long" /></td>
  		  </tr>
  		  <tr>
  		    <td class="text_caption" nowrap  style="height:24px;"><label for="re_new_password">Re-type New Pass.</label>&nbsp;</td>
  		    <td><input type="password" name="re_new_password" id="re_new_password" value="" class="input_text long" /></td>
  		  </tr>
  		</table>
  	</fieldset>
 </div> 
 <div id="password_confirm" title="Change Password"></div>