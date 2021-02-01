<?php $this->load->layout(base_layout() . "/UserHeader");?>
<body>
 <div id="wrapper">
	<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-links">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:void(0);" onclick="window.open('http://<?php echo website(); ?>');">
					<div class="navbar-logo-right">
						<div class="ui-widget-image">
							<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/bni_logo_login.png"  width="100" height="32"/>
						</div>
					</div>
				</a>
            </div>
			
            <!-- /.navbar-header -->
			<?php if( in_array(_get_session('HandlingType'), array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND)) ) : ?>
				<?php $this->load->layout(base_layout() . "/UserMenuChild"); ?>
			<?php else : ?>
				<?php $this->load->layout(base_layout() . "/UserMenuTree");?>
			<?php endif; ?>
			
			<!-- /.navbar-header -->
        </nav>
		<div id="main_content"> </div>
    </div>
	
	<div class="ui-bottom-widget-navigation-bars" >
		<?php $this->load->layout(base_layout().'/UserToolbars'); ?>
	</div>
	
	<div class="ui-bottom-cti-bottom">
		<?php $this->load->layout(base_layout().'/UserCti');?>
	</div>
	
	<?php $this->load->layout(base_layout() . "/UserModal");?>
	<?php $this->load->layout(base_layout() . "/UserLoading");?>
</body>
 
<?php $this->load->layout(base_layout() . "/UserFooter");?>

 
<!-- * END OF MAIN -->