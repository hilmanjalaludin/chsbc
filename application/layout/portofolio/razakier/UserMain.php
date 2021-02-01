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
							<img class="ribbon-icon ribbon-normal" src="<?php echo base_image_layout();?>/favicon.png"  width="36" height="36"/>
						</div>
						<div class="ui-widget-textarea">
							<?php echo title();?>
						</div>
					</div>
				</a>
            </div>
            <!-- /.navbar-header -->
            <?php $this->load->layout(base_layout() . "/UserMenu");?>
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