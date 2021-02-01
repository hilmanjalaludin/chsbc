<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Enigma user Interface
 *
 */
 
class EUI_DB_result {

	var $conn_id				= NULL;
	var $result_id				= NULL;
	var $row_data				= NULL;
	
	var $result_array			= array();
	var $result_assoc			= array();
	var $result_record 			= array();
	var $result_object			= array();
	var $custom_result_object	= array();
	
	var $current_row			= 0;
	var $num_rows				= 0;
	

	/**
	 * Query result.  Acts as a wrapper function for the following functions.
	 *
	 * @access	public
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	function result($type = 'object')
	{
		if ($type == 'array') return $this -> result_array();
		else if ($type == 'assoc') return $this -> result_assoc();
		else if ($type == 'object') return $this -> result_object();
		else return $this->custom_result_object($type);
	}

	// --------------------------------------------------------------------

	/**
	 * Custom query result.
	 *
	 * @param class_name A string that represents the type of object you want back
	 * @return array of objects
	 */
	function custom_result_object($class_name)
	{
		if (array_key_exists($class_name, $this->custom_result_object))
		{
			return $this->custom_result_object[$class_name];
		}

		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		// add the data to the object
		$this->_data_seek(0);
		$result_object = array();

		while ($row = $this->_fetch_object())
		{
			$object = new $class_name();
			
			foreach ($row as $key => $value)
			{
				$object->$key = $value;
			}
			
			$result_object[] = $object;
		}

		// return the array
		return $this->custom_result_object[$class_name] = $result_object;
	}

	// --------------------------------------------------------------------

	/**
	 * Query result.  "object" version.
	 *
	 * @access	public
	 * @return	object
	 */
	function result_object()
	{
		if (count($this->result_object) > 0)
		{
			return $this->result_object;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		$this->_data_seek(0);
		while ($row = $this->_fetch_object())
		{
			$this->result_object[] = $row;
		}

		return $this->result_object;
	}

	// --------------------------------------------------------------------

	/**
	 * Query result.  "array" version.
	 *
	 * @access	public
	 * @return	array
	 */
	function result_array()
	{
		if (count($this->result_array) > 0)
		{
			return $this->result_array;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		$this->_data_seek(0);
		while ($row = $this->_fetch_assoc())
		{
			$this->result_array[] = $row;
		}

		return $this->result_array;
	}
	
	// --------------------------------------------------------------------
	/**
	 * Query result.  with object function data "$object"
	 *
	 * @access	public
	 * @param	string
	 * @auth 	omens
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	 
	 /**
	  * example usage :
	  * $rs = $this->db->get();
	  * $rd = $rs->result_first_record();
	  * $rd->get_value( @param = "field" )
	  */
	  
	 function result_first_record()
	{
		$row = $this->result_first_assoc();
		
		// -- cek existension function required --  
		if( !function_exists( 'Objective' ) )  {
			return null;
		}
		
		// -- cek data array validate -- 
		
		if( !is_array( $row ) ) {
			return null;
		}
		
		return call_user_func('Objective', $row );
		
	}			
	/**
	 * @ access	public
	 * @ return	int row number
	 & @ add by  < omens >
	 */
	 
	function result_first_assoc()
	{
		if (count($this->result_array) > 0)
		{
			return $this->result_array;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0) {
			return array();
		}

		$this->_data_seek(0);
		
		$i = 0;
		while ($row = $this->_fetch_assoc())
		{
			if( $i==1) break;
				$this->result_array = $row;
			$i++;
		}

		return $this -> result_array;
	}
	
	
	/**
	 * @ access	public
	 * @ return	int row number
	 & @ add by  < omens >
	 */
	 
	function result_num_rows()
	{
		$_int = (INT)$this -> num_rows();
		return $_int;
	}
	
// --------------------------------------------------------------------

	/**
	 * Query result.  with object function data "$object"
	 *
	 * @access	public
	 * @param	string
	 * @auth 	omens
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	
	function result_record( $callback = 'Objective' )
	{
		if (count( $this -> result_record ) > 0) {
			return $this -> result_record;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		$this->_data_seek(0);
		while ($row = $this -> _fetch_assoc() )
		{	
			 if( function_exists( $callback  )){
				$this->result_record[] = call_user_func($callback,  $row );
			}
		}
		return $this->result_record;
	}
// --------------------------------------------------------------------

	/**
	 * Query result.  with object function data "$object"
	 *
	 * @access	public
	 * @param	string
	 * @auth 	omens
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	 
	function result_value() 
	{
		$row = $this->result_first_assoc();
		if( is_array( $row ) and count( $row ) == 0 ) {
			return null;
		}
		
	// -- render get from assock this --->
	
		$ar_row = array();
		if( is_array( $row ) ) 
			foreach( $row as $key => $val ){
			$ar_row[] = $val;
		}
		
		return $ar_row[0];
	} 
	
	
	
// --------------------------------------------------------------------

	/**
	 * Query result.  with object function data "$object"
	 *
	 * @access	public
	 * @param	string
	 * @auth 	omens
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	 
	function result_assoc()
	{
		if (count( $this -> result_assoc ) > 0) {
			return $this -> result_assoc;
		}

		// In the event that query caching is on the result_id variable
		// will return FALSE since there isn't a valid SQL resource so
		// we'll simply return an empty array.
		if ($this->result_id === FALSE OR $this->num_rows() == 0)
		{
			return array();
		}

		$this->_data_seek(0);
		while ($row = $this -> _fetch_assoc() ) {
			$this -> result_assoc[] = $row;
		}

		return $this -> result_assoc;
	}
	
	
	// --------------------------------------------------------------------
	/**
	 @ aksess public function  
	 @ EOF < end of row >
	 @ author < omens >
	 **/
	 
	public function EOF() 
	{
		$_cnt = 0;
		$_cnt = count( $this -> result_assoc() );
		if( (INT)$_cnt== 0 ){
			return true;
		}
		else
			return false;
	} 
	
	
	// --------------------------------------------------------------------
	/**
	 @ aksess public function  
	 @ EOF < end of row >
	 @ author < omens >
	 **/
	 
	public function result_singgle_value() 
	{
		$_result = '';
		if (count( $this ->result_first_assoc() ) > 0) 
		{
			$i = 0;
			foreach( $this ->result_first_assoc() as $k => $v ) {
				if( $i==0 ){
					$_result = $v;
					break;
				}	
				$i++;
			}
		}
		return $_result;
	} 

	// --------------------------------------------------------------------

	/**
	 * Query result.  Acts as a wrapper function for the following functions.
	 *
	 * @access	public
	 * @param	string
	 * @param	string	can be "object" or "array"
	 * @return	mixed	either a result object or array
	 */
	function row($n = 0, $type = 'object')
	{
		if ( ! is_numeric($n))
		{
			// We cache the row data for subsequent uses
			if ( ! is_array($this->row_data))
			{
				$this->row_data = $this->row_array(0);
			}

			// array_key_exists() instead of isset() to allow for MySQL NULL values
			if (array_key_exists($n, $this->row_data))
			{
				return $this->row_data[$n];
			}
			// reset the $n variable if the result was not achieved
			$n = 0;
		}

		if ($type == 'object') return $this->row_object($n);
		else if ($type == 'array') return $this->row_array($n);
		else return $this->custom_row_object($n, $type);
	}

	// --------------------------------------------------------------------

	/**
	 * Assigns an item into a particular column slot
	 *
	 * @access	public
	 * @return	object
	 */
	function set_row($key, $value = NULL)
	{
		// We cache the row data for subsequent uses
		if ( ! is_array($this->row_data))
		{
			$this->row_data = $this->row_array(0);
		}

		if (is_array($key))
		{
			foreach ($key as $k => $v)
			{
				$this->row_data[$k] = $v;
			}

			return;
		}

		if ($key != '' AND ! is_null($value))
		{
			$this->row_data[$key] = $value;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a single result row - custom object version
	 *
	 * @access	public
	 * @return	object
	 */
	function custom_row_object($n, $type)
	{
		$result = $this->custom_result_object($type);

		if (count($result) == 0)
		{
			return $result;
		}

		if ($n != $this->current_row AND isset($result[$n]))
		{
			$this->current_row = $n;
		}

		return $result[$this->current_row];
	}

	/**
	 * Returns a single result row - object version
	 *
	 * @access	public
	 * @return	object
	 */
	function row_object($n = 0)
	{
		$result = $this->result_object();

		if (count($result) == 0)
		{
			return $result;
		}

		if ($n != $this->current_row AND isset($result[$n]))
		{
			$this->current_row = $n;
		}

		return $result[$this->current_row];
	}

	// --------------------------------------------------------------------

	/**
	 * Returns a single result row - array version
	 *
	 * @access	public
	 * @return	array
	 */
	function row_array($n = 0)
	{
		$result = $this->result_array();

		if (count($result) == 0)
		{
			return $result;
		}

		if ($n != $this->current_row AND isset($result[$n]))
		{
			$this->current_row = $n;
		}

		return $result[$this->current_row];
	}


	// --------------------------------------------------------------------

	/**
	 * Returns the "first" row
	 *
	 * @access	public
	 * @return	object
	 */
	function first_row($type = 'object')
	{
		$result = $this->result($type);

		if (count($result) == 0)
		{
			return $result;
		}
		return $result[0];
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the "last" row
	 *
	 * @access	public
	 * @return	object
	 */
	function last_row($type = 'object')
	{
		$result = $this->result($type);

		if (count($result) == 0)
		{
			return $result;
		}
		return $result[count($result) -1];
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the "next" row
	 *
	 * @access	public
	 * @return	object
	 */
	function next_row($type = 'object')
	{
		$result = $this->result($type);

		if (count($result) == 0)
		{
			return $result;
		}

		if (isset($result[$this->current_row + 1]))
		{
			++$this->current_row;
		}

		return $result[$this->current_row];
	}

	// --------------------------------------------------------------------

	/**
	 * Returns the "previous" row
	 *
	 * @access	public
	 * @return	object
	 */
	function previous_row($type = 'object')
	{
		$result = $this->result($type);

		if (count($result) == 0)
		{
			return $result;
		}

		if (isset($result[$this->current_row - 1]))
		{
			--$this->current_row;
		}
		return $result[$this->current_row];
	}

	// --------------------------------------------------------------------

	/**
	 * The following functions are normally overloaded by the identically named
	 * methods in the platform-specific driver -- except when query caching
	 * is used.  When caching is enabled we do not load the other driver.
	 * These functions are primarily here to prevent undefined function errors
	 * when a cached result object is in use.  They are not otherwise fully
	 * operational due to the unavailability of the database resource IDs with
	 * cached results.
	 */
	function num_rows() { return $this->num_rows; }
	function num_fields() { return 0; }
	function list_fields() { return array(); }
	function field_data() { return array(); }
	function free_result() { return TRUE; }
	function _data_seek() { return TRUE; }
	// function _fetch_assoc() { return array(); }
	// function _fetch_object() { return array(); }

}
// END DB_result class
