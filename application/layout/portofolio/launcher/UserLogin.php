<?php $this->load->layout(base_layout()."/UserLoginHeader");?>
<body>
    <table id="tblLoginContainer" class="ui-widget-content"
	  width="50%" align="center" cellpadding="5" cellspacing="0">
      	<tr>
        	<td>
          <table width="100%" cellspacing="0">
          	<tr>
            	<td>
					<table width="100%" cellspacing="0" border="0">
						<tr>
							<td align="left"> 
								<div class="ui-widget-form-row">
									<div class="ui-widget-form-cell"> 
										<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/favicon.png"  width="42" height="42"/>
									</div>
									<div class="ui-widget-form-cell ui-widget-title-welcome"> <?php echo description();?></div>
								</div>	
							</td>
							<td align="right" class="formTitleLogin">&nbsp;</td>
						</tr>
					
					</table>
            	</td>
            </tr>
            <tr>
            	<td align="center">
            	<table class="tableFormLogin" width="98%" cellpadding="0" cellspacing="0">
              	<tr>
                	<td>
                  <form id="frmLogin" name="frmLogin">
                  	<table align="center" border=0>
                    	<tr>
							<td colspan="2" class="formHeaderLogin"><?php echo lang("Welcome");?>! <?php echo lang("Please log in");?>.</td>
						</tr>
						<tr>
							<td class="formRowRightLogin" width="30%"><?php echo lang("Username");?></td>
							<td class="formRowLoginData" width="70%"><?php echo form()->input("username","input_text",NULL,NULL,array('style'=>'width:200px;height:22px;'));?></td>
						</tr>
						<tr>
							<td class="formRowRightLogin"><?php echo lang("Password");?></td>
							<td class="formRowLoginData"><?php echo form() ->password('password','input_text',null,null,array('style'=>'width:200px;height:22px;'));?></td>
						</tr>
						<tr height="24">
							<td>&nbsp;</td>
							<td colspan="0" class="center" style="padding:16px 0px 16px 0px;">
							<input type="button" class="buttonCommon" id="btnLogin"  
								name="btnLogin" value="<?php echo lang("Log In"); ?>"  
								style="width: 100px" onclick="Ext.DOM.UserLogin();">
							</td>
						</tr>
					 </table>
					</form>
                	</td>
              	</tr>
            	</table>
            	</td>
			</tr>
          </table>  
		 </td>
		</tr>
	</table>   
</body>
</html>