<!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="AboutUs" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:500px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <span class="fa-stack fa-lg ui-widget-awesome-text" >
			<i class="fa fa-circle fa-stack-2x" ></i>
			<i class="fa fa-info fa-stack-1x fa-inverse"></i>
		</span>&nbsp;About Us
      </div>
      <div class="modal-body">
		<center>
       <p>
			
			<h4><?php echo title();?></h4>
			<h5><a href="<?php echo site_release(version());?>" target="_blank" style="text-decoration:none;color:red;"><?php echo version();?></a></h5>
			<p><?php echo copyright();?> - <?php echo author();?></p>
			<p><a href="<?php echo website(); ?>" target="_blank" style="text-decoration:none;color:red;"><?php echo company();?></a></p>
				
		</p>
		</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>