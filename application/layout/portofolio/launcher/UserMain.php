<?php $this->load->layout( base_layout() .'/UserHeader'); ?>
<body>
<!-- start : user change password -->
 <?php $this->load->layout( base_layout() .'/UserPassword'); ?>
<!-- end : user change password -->
	
<!-- start : user change password -->
 <?php $this->load->layout(base_layout().'/UserMenu');?> 
<!-- end : user change password -->
	
<!-- start : main process of home -->
 <div class="page" id="main_content"></div>
<!-- end : main process of home -->
<?php $this->load->layout(base_layout().'/UserModal'); ?>		
<!-- start : all attribute require --> 
 <?php $this->load->layout(base_layout().'/UserLogout'); ?> 
 <?php $this->load->layout(base_layout().'/UserToolbars'); ?>
 

 
<!-- end : all attribute require -->

<div>
</div>
</body>	
</html>

