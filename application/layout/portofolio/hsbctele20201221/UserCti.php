<?php  
$CTI->_setCtiPBX(_get_session('Username'));
if(_get_session('Telphone')!=0 ) {  

?>
	<form name="frmAgent" id="idFrmAgent">
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" >
		<tr>
			<td colspan=4>
				<applet name="ctiapplet" code="centerBackAgent.class" archive="<?php echo base_url();?>library/EUI/asset/centerBackAgentApplet.jar" width="1" height="1"  MAYSCRIPT onLoad="document.ctiapplet.setAgentSkill(1);document.ctiapplet.ctiConnect();">
					<param name="CTIHost"  		value="<?php echo _get_session('ctiIp'); ?>"/>
					<param name="CTIPort"  	 	value="<?php echo _get_session('ctiUdpPort');?>"/>
					<param name="agentId"  	 	value="<?php echo _get_session('agentId');?>"/>
					<param name="agentLogin" 	value="<?php echo _get_session('agentLogin');?>"/>
					<param name="agentName"  	value="<?php echo _get_session('agentName');?>"/>        
					<param name="agentGroup" 	value="<?php echo _get_session('agentGroup');?>"/>
					<param name="agentLevel" 	value="<?php echo _get_session('agentLevel');?>"/>
					<param name="agentExt"   	value="<?php echo _get_session('agentExt');?>"/>        
					<param name="agentPbxGroup" value="<?php echo _get_session('agentPbxGroup'); ?>"/>
					<param name="debugLevel" 	value="10"/>
				</applet>
			
				<input name="destNo" type="hidden" />
				<input name="passwd" type="hidden" />
				<input name="callAction" type="hidden" />
			</td>  		
		</tr>
	</table>
  </form>
<?php }; ?> 
<!-- END OF FILE  -->
<!-- location : // ../application/layout/UserCti.php -->