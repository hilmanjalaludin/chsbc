<!-- add menu Help -> about as -->
	<div class="ribbon-tab" id="help-about">
		<span class="ribbon-title">Help</span>	
		
		<div class="ribbon-section"> 
			<div class="ribbon-button ribbon-button-large" onclick="Ext.DOM.ChangeMyPassword();" id="user-logout-id" >
				<span class="button-title">Change Password</span>
				<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/icons/logout_c.png" width="36" height="36"/>
				<img class="ribbon-icon ribbon-hot" src="<?php echo base_image_layout();?>/icons/logout_o.png" width="36" height="36" />
				<img class="ribbon-icon ribbon-disabled" src="<?php echo base_image_layout();?>/icons/logout_d.png" width="36" height="36"/>
			</div>		
		</div>	
		
		<div class="ribbon-section"> 
			<div class="ribbon-button ribbon-button-large" onclick="Ext.DOM.UserLogOut();" id="user-logout-id" >
				<span class="button-title">Logout</span>
				<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/icons/logout_c.png" width="36" height="36"/>
				<img class="ribbon-icon ribbon-hot" src="<?php echo base_image_layout();?>/icons/logout_o.png" width="36" height="36" />
				<img class="ribbon-icon ribbon-disabled" src="<?php echo base_image_layout();?>/icons/logout_d.png" width="36" height="36"/>
			</div>		
		</div>	
		
		<div class="ribbon-section osx"> 
			<div class="ribbon-button ribbon-button-large" id="about-id" >
				<span class="button-title osx">About Us</span>
				<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/favicon.png"  width="36" height="36"/>
				<img class="ribbon-icon ribbon-hot" src="<?php echo base_image_layout();?>/favicon.png" width="36" height="36" />
				<img class="ribbon-icon ribbon-disabled" src="<?php echo base_image_layout();?>/favicon.png" width="36" height="36"/>
			</div>		
		</div>	
	</div>

	