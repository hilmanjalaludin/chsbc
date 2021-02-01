<?php
/*
 * @def : read Text file
 *
 */
 
class EUI_ReadText
{

private static $instance  = null;
private $_filename_text = null;
private $_set_text_delimiter = null;
private static $_class_exponen_data = null;


/* get_instance **/

public static function &get_instance()
{
	if(is_null(self::$instance) ) {
		self::$instance  = new self();
	}
	
	return self::$instance;
}

/* 
 * @ def 	: aksesor read on location definition 
 * @ secure	: must be read file execute mode 0775 
 */

public function ReadText( $_FILE_TEXT_LOCATION = null  )
{
	if( is_null( $this -> _filename_text ) ) {
		$this -> _filename_text = $_FILE_TEXT_LOCATION;
	}
}


/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
 
public function setDelimiter($_DELIMITER = null )
{
	if( is_null( $this -> _set_text_delimiter ) ) 
	{
		$this -> _set_text_delimiter = $_DELIMITER;
		$this -> getData();
	}
	
}

// ---------- removal tab ----------------------------
 public function removaltabs( $values = '' )
{
  $values = preg_replace('/\s+/',' ', $values); // tabs 
  $values = str_replace('"','', $values); // double Quotes
  return mysql_real_escape_string($values); // is valid 
  
}

/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
 
public function getData( $_BUFFER =40960)
{

 if(is_null($this->_filename_text) ) exit('File Not exist');
 else
 {
	$fhandle = @fopen($this->_filename_text, "r");
	if ($fhandle)  
	{
		$line = 1; $_EXPLODE_LINE =null;
		
		while (($_READ_LINE = fgets($fhandle, $_BUFFER)) !== FALSE) 
		{
			if( $COLUMNS = EXPLODE($this -> _set_text_delimiter, $_READ_LINE) 
				AND preg_match('/\|/i', $_READ_LINE )!=FALSE )
			{
				$n = 0;
				 if( is_array($COLUMNS) ) 
					foreach($COLUMNS as $keywords => $values ) 
				{
					$_EXPLODE_LINE[$line][$n] = $this->removaltabs($values);
					$n++;
				}	
				$line++;
			}	
		}
			
		
		// class set data 
		
		if (!feof($fhandle)) { 
			exit("Error: unexpected fgets() fail\n");
		}
			
		fclose($fhandle);
		if( is_null(self::$_class_exponen_data) )
		{
			self::$_class_exponen_data = $_EXPLODE_LINE;
		}	
	 }
		
	}
}

/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
 
public function getCount()
{
	$count = 0;

  if( !is_null(self::$_class_exponen_data) ) 
  {
	if( $data = self::$_class_exponen_data ){
		$count = count($data);
	}
 }
  
  
 return $count;
}



/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
 
public function Results()
{
 
 $result = array();

  if( !is_null(self::$_class_exponen_data) ) 
  {
	if( $data = self::$_class_exponen_data ){
		$result = $data;
	}
 }
  
  
 return $result;
}

/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
public function getHeader()
{

 $result = array();
  if( !is_null(self::$_class_exponen_data) ) 
  {
	if( $data = self::$_class_exponen_data ) {
		$result = $data[1];
	}
 }
 return $result;
}

/* 
 * @ def 	: settup delimiter of the text 
 * @ delimieter	: must valid OK 
 */
 
 
 
public function getValue($r, $c )
{
 
 $result = array();
  if( !is_null(self::$_class_exponen_data) ) 
  {
	if( $data = self::$_class_exponen_data ) {
		$result = $data[$r][$c];
	}
 }
 return $result;
 
}



}

if( !function_exists('ReadText') ){
	
  function TextImport() 
  {
	if( class_exists('EUI_ReadText') ){
		$TXT =& EUI_ReadText::get_instance();
		return $TXT;
	 }
  }
}


 
 
?>