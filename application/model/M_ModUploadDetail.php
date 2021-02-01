<?php

class M_ModUploadDetail Extends EUI_Model
{

 function M_ModUploadDetail() { 
 
 }
 
 /*
  *
  */
  
 function _get_default()
 {
	$this -> EUI_Page -> _setPage(10); 
	$this -> EUI_Page -> _setQuery("SELECT a.FTP_UploadId FROM t_gn_upload_report_ftp a"); 	
	
	$flt = null;
	if($this ->URI->_get_have_post('keywords') ) {
		$flt .=  " AND ( 
			a.FTP_UploadFilename LIKE '%{$this ->URI->_get_post('keywords')}%' 
			OR FTP_Flags LIKE '%{$this ->URI->_get_post('keywords')}%' ) ";
	}
	
	$this -> EUI_Page -> _setWhere($flt);
	
	if( $this -> EUI_Page -> _get_query() )
	{
		return $this -> EUI_Page;
	}
 }
 
 
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_content()
{
	$this -> EUI_Page -> _postPage($this -> URI -> _get_post('v_page'));
	$this -> EUI_Page -> _setPage(10);
	
	// set query 
	
	$this -> EUI_Page -> _setQuery('SELECT a.* FROM t_gn_upload_report_ftp a'); 
	
	$flt = null;
	
	if($this ->URI->_get_have_post('keywords') ) 
	{
		$flt .=  " AND ( a.FTP_UploadFilename LIKE '%{$this ->URI->_get_post('keywords')}%' 
						 OR FTP_Flags LIKE '%{$this ->URI->_get_post('keywords')}%' ) ";
			
	}
	
	$this -> EUI_Page -> _setWhere($flt);   
	
	if( $this->URI->_get_have_post('order_by')){
		$this -> EUI_Page -> _setOrderBy($this->URI->_get_post('order_by'),$this->URI->_get_post('type'));
	}
	else{
		$this -> EUI_Page -> _setOrderBy('a.FTP_UploadId','DESC');
	}
		
	$this -> EUI_Page -> _setLimit();
}


/*
 * @ def 		: _get_resource // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_resource()
 {
	self::_get_content();
	if( $this -> EUI_Page -> _get_query()!='') 
	{
		return $this -> EUI_Page -> _result();
	}	
 }
 
/*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function _get_page_number() 
 {
	if( $this -> EUI_Page -> _get_query()!='' ) {
		return $this -> EUI_Page -> _getNo();
	}	
 }


function _getDataUpload($UploadId=null)
{
 $_conds = array();
 
	if(is_array($UploadId) )
	{
		$this -> db -> select('a.*');
		$this -> db -> from('t_gn_upload_report_ftp a');
		$this -> db -> where_in('a.FTP_UploadId', $UploadId);
		foreach( $this ->db->get()->result_assoc() as $rows )
		{
			$_conds[$rows['FTP_UploadId']] = $rows;
		}
	}
	
	return $_conds;
} 


// _setHidden

function _setHidden( $params = null, $_active = 1 )
{
	$_conds = 0;
	if(!is_null($params) )
	{	
	
		foreach($params as $k => $ftpid )
		{
			$this -> db->set('FTP_Flags',$_active);
			$this -> db->where('FTP_UploadId', $ftpid);
			$this -> db->update('t_gn_upload_report_ftp');
			if( $this-> db ->affected_rows() > 0 )
			{
				$_conds++;	
			}
		}
	}
	
	return $_conds;
}


// _setDeleted
function _setDeleted( $params = null )
{
	$_conds = 0;
	
	if(!is_null($params) )
	{	foreach($params as $k => $ftpid )
		{
			$this -> db->where('FTP_UploadId', $ftpid);
			$this -> db->delete('t_gn_upload_report_ftp');
			if( $this-> db ->affected_rows() > 0 )
			{
				$_conds++;	
			}
		}
	}
	
	return $_conds;
}

function _get_trx_blacklist($id)
{
	$datas = array();
	
	$sql = "select 
				b.Custno,
				b.CustomerFirstName,
				c.FTP_Recsource,
				b.CustomerUploadedTs,
				a.Upload_Notes
			from t_gn_blacklist_trx a
			left join t_gn_bucket_customers b on (a.CIF=b.Custno AND a.Upload_Id=b.FTP_UploadId)
			left join t_gn_upload_report_ftp c on a.Upload_Id = c.FTP_UploadId
			where 1=1
			and a.Upload_Id = '".$id."'";
	$qry = $this->db->query($sql);
	
	if($qry->num_rows()>0)
	{
		$datas = $qry->result_assoc();
	}
	
	return $datas;
}

}

?>