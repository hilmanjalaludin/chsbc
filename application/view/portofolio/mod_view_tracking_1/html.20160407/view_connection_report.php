<?php 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $DBReport= "";
 
if( !function_exists('DB_server_report') ) 
 {
	 function DB_server_report() 
	{
		global $DBReport;
		
		$DBReport = mysql_connect("192.168.10.236:3306", "enigma", "enigma");
		if( !$DBReport ){
			exit(mysql_error());
		}
		
		if( !mysql_select_db("bnilifesmesco", $DBReport) ){
			exit(mysql_error());	
		}	
	}
 }
 DB_server_report();
 

 //---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
if( !function_exists('function_exists') )
{
	function select_where_in($sql, $where_in  = array() ) {
		return $sql = " $sql IN(". implode(',', $where_in).") ";
	}
}
 
// end  
?>