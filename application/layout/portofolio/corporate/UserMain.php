<?php $this -> load -> layout( base_layout() .'/UserHeader'); ?>
<body>
<?php $this -> load -> layout( base_layout() .'/UserPassword'); ?>
<div id="container-inside" class="inner">
	 <!-- Header -->
	<div id="header">	
		<div id="web-title-header" class="web-title-header">&nbsp;</div>
		<!-- Header Controls -->
			<div class="header-controls">
				<ul>
					<li class="first"><?php echo _get_session('Username');?></li>
					<li class="middle"><?php echo _get_session('Fullname');?>&nbsp;</li>
					<li class="lasted"><a href="javascript:void(0);" title="Logout from system" onclick="Ext.ShowMenu('Logout','Logout');">Logout</a></li>
				</ul>
			</div>  
			<!-- /Header Controls -->
			<div class="clear-both"></div>
	</div>
 <!-- /Header -->
<!-- Primary Navigation -->		
<?php $this -> load -> layout( base_layout() .'/UserMenu'); ?> 
<!-- /Primary Navigation -->
<div id="main_content" align="center"></div>	


<!--attribute ser config -->

<?php $this->load->layout(base_layout() .'/UserToolbars'); ?>
<?php $this->load->layout(base_layout() .'/UserCti'); ?>

<?php $this->load->layout(base_layout() .'/UserDialog'); ?>
<?php $this->load->layout(base_layout() .'/UserLogout'); ?> 
<!-- stop -->
</div>	
<?php $this -> load -> layout( base_layout() .'/UserFooter'); ?> 

