<div id="top" class="logo-baner">
	<div style="float:right;z-index:9999;margin-top:40px;margin-right:100px;">
		<span style="color:yellow">
			<b style="font-size:13px;color:#fff;"> Welcome , </b> <?php echo $this -> EUI_Session -> _get_session('Fullname');?></span>&nbsp;
		<span style="color:#7e7e7e;font-size:16px;">|</span>&nbsp;
		<span><a class="logout" href="javascript:void(0);" onclick="Ext.ShowMenu('Logout','Logout');">Logout</a></span>
	</div>
    <div style="float:left;margin-left:180px;z-index:99999;margin-top:-5px;"> 
		<span style="display:block; padding-top:35px;margin-left:10px;margin-right:50px;">
		<a class="new" href="http://razakitechnology.com/siteraztech/product/web-application" 
			target="_blank" style="text-decoration:none;color:#dddddd;" title="Call Center"><h1>E.U.I Call Center</h1></a></span> 
	</div>
</div>

<?php

	//print_r(base_menu_model());
?>