<?php
/*
 * @ def 	: User Footer
 * -----------------------------------
 * @ param 	: layout section
 * @ aksess : public
 * @ author	: razaki team
 */
?>

<div id="foot" style="border:1px solid #dddddd;height:35px;overflow:auto;">
 
<span>  
	<?php $this -> load -> layout(base_layout().'/UserToolbars'); ?>
	<?php $this -> load -> layout(base_layout().'/UserCti'); ?>
</span>
</div>