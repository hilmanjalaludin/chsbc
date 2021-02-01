<!-- modal content -->
<div id="osx-modal-content">
	<div id="osx-modal-title">
		<span class="fa-stack fa-lg ui-widget-awesome-text" >
			<i class="fa fa-circle fa-stack-2x" ></i>
			<i class="fa fa-info fa-stack-1x fa-inverse"></i>
		</span>&nbsp;About Us</div> 
	<div id="osx-modal-data" style="line-height:12px;">
		<center>
			<h2><?php echo title();?></h2>
			<h5><a href="<?php echo site_release(version());?>" target="_blank" style="text-decoration:none;color:red;"><?php echo version();?></a></h5>
			<p><?php echo copyright();?> - <?php echo author();?></p>
			<p><a href="<?php echo website(); ?>" target="_blank" style="text-decoration:none;color:red;"><?php echo company();?></a></p>
				
		</center>
   </div>
</div>