<?php $this->load->layout(base_layout()."/UserLoginHeader");?>
<body>
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
		  <span>
			<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/favicon.png"  width="42" height="42"/>
			<span class="title-form-login"><?php echo description();?> </span> 
		  </span>		
      </div>
      <div class="modal-body">
          <form id="frmLogin" name="frmLogin" class="form center-block"  >
		   <div class="form-group">
				<input type="text" id="username" name="username" class="form-control input-form-login" placeholder="User ID">
            </div>
			
            <div class="form-group">
              <input type="password" id="password" name="password" class="form-control input-form-login" placeholder="Password">
            </div>
            
			<div class="form-group">
              <input type="button" value="<?php echo lang("Log In"); ?>" onclick="Ext.DOM.UserLogin();" class="btn btn-primary btn-block button-login">
            </div>
          </form>
      </div>
  </div>
  </div>
</div>
     
</body>
</html>