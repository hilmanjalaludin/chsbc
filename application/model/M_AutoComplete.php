<?php
class M_AutoComplete extends EUI_Model
{

/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
 
function M_AutoComplete(){ 
	// & run 

}



/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
 
public function _getZipCode( $keyword = '' )
{
  $zip_code = array();
  
  $this -> db ->select('a.ZipCode, a.ZipKelurahan, a.ZipKecamatan, a.ZipKotaKab, b.ProvinceId, b.CountryCode');
  $this -> db ->from('t_lk_zip a');
  $this -> db ->join('t_lk_province b ',' a.ZipProvinceId=b.ProvinceId','LEFT');
  $this -> db ->join('t_lk_country c ',' b.CountryCode=c.CountryCode','LEFT');
  $this -> db ->where("a.ZipCode REGEXP ('^{$keyword}')");
  
  foreach( $this -> db ->get() -> result_assoc() as $rows ) 
  {
	$key_set = "{$rows['ZipCode']}/{$rows['ZipKelurahan']}/{$rows['ZipKecamatan']}/{$rows['ZipKotaKab']}";
	$zip_code[$key_set] = "{$rows['ZipCode']}/{$rows['ZipKelurahan']}/{$rows['ZipKecamatan']}/{$rows['ZipKotaKab']}/{$rows['ProvinceId']}/{$rows['CountryCode']}";	
  }
  
  return $zip_code;

}




/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
 
public function _getKota( $keyword = '' )
{
  $zip_code = array();
  
  $this -> db ->select('a.ZipCode, a.ZipKelurahan, a.ZipKecamatan, a.ZipKotaKab, b.ProvinceId, b.CountryCode');
  $this -> db ->from('t_lk_zip a');
  $this -> db ->join('t_lk_province b ',' a.ZipProvinceId=b.ProvinceId','LEFT');
  $this -> db ->join('t_lk_country c ',' b.CountryCode=c.CountryCode','LEFT');
  $this -> db ->where("a.ZipKotaKab REGEXP ('^{$keyword}')");
  
  foreach( $this -> db ->get() -> result_assoc() as $rows ) 
  {
	$key_set = "{$rows['ZipKotaKab']}";
	$zip_code[$key_set] = "{$rows['ZipCode']}/{$rows['ZipKelurahan']}/{$rows['ZipKecamatan']}/{$rows['ZipKotaKab']}/{$rows['ProvinceId']}/{$rows['CountryCode']}";	
  }
  
  return $zip_code;

}
	
/*
 * @ def 	: set css on ready document
 * -----------------------------
 *
 * @ param  : on ready Ext JS Libs
 * @ aksess : public 
 */
 
 
public function _getKecamatan( $keyword = '' )
{
  $zip_code = array();
  
  $this -> db ->select('a.ZipCode, a.ZipKelurahan, a.ZipKecamatan, a.ZipKotaKab, b.ProvinceId, b.Province, b.CountryCode');
  $this -> db ->from('t_lk_zip a');
  $this -> db ->join('t_lk_province b ',' a.ZipProvinceId=b.ProvinceId','LEFT');
  $this -> db ->join('t_lk_country c ',' b.CountryCode=c.CountryCode','LEFT');
  $this -> db ->where("a.ZipKecamatan REGEXP ('^{$keyword}')");
  
  foreach( $this -> db ->get() -> result_assoc() as $rows ) 
  {
	$key_set = "{$rows['ZipKecamatan']}/{$rows['ZipKotaKab']}/{$rows['Province']}";
	$zip_code[$key_set] = "{$rows['ZipCode']}/{$rows['ZipKelurahan']}/{$rows['ZipKecamatan']}/{$rows['ZipKotaKab']}/{$rows['ProvinceId']}/{$rows['CountryCode']}";	
  }
  
  return $zip_code;

}	
}