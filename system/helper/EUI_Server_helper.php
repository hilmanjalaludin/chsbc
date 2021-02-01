<?php

/** Constructor
 * @param   array       A reference to an array to use for storage. This will be populated with key/value pairs that store the time/value, respectively.
 *                      Because it is passed by reference, it can be stored externally in a session or database, allowing persistant use of this object
 *                      across page loads.
 * @param  int  The maximum age of values to store, in seconds
 */
 
class average_rate_calculator 
{
  var $_max_age;
  var $_values;

  function average_rate_calculator(&$storage_array, $max_age) 
  {
	
	$this->_max_age = $max_age;
    if (!is_array($storage_array)) {
			$storage_array = array();
    }
    $this->_values =& $storage_array;
  }
  /** Adds a value to the array
   * @param  float        The value to add
   * @param  int  The timestamp to use for this value, defaults to now
   */
  function add($value, $timestamp=null) 
  {
	  if (!$timestamp) $timestamp = time();
	  
	  $this->_values[$timestamp] = $value;
  }
	/** Calculate the average per second value
   * @return  The average value, as a rate per second
   */
  function average() {
		$this->_clean();

    $avgs = array();
    $last_time = false;
    $last_val = false;
	foreach ($this->_values as $time=>$val) 
	{
     
		if (!$last_time){
			$avgs[] = ($val - $last_val) / ($time - $last_time);
		}
	  
      $last_time = $time;
      $last_val = $val;
    }
	
    // return the average of all our averages
	
	if ($count = count($avgs)) {
			return array_sum($avgs) / $count;
    } else {
      return 'unknown';
    }
  }
  /** Clean old values out of the array
   */
  function _clean() 
  {
    $too_old = time() - $this->_max_age;

    foreach (array_keys($this->_values) as $key) 
	{
			if ($key < $too_old) {
      	unset($this->_values[$key]);
      }
    }
  }
}


/*
 * class sysinfo server running.....
 * ----------------------------------------
 * oke kep silent only 
 */
 
class sysinfo
{

 private static $instance = null;
 
 public static function &get_instance()
 {
	if(is_null(self::$instance)){
		self::$instance = new self();
	}
	return self::$instance;
 }

/*
 * @ def : get load average
 * -----------------------------
 *
 * @ param : array();
 */
 
public function loadavg ($bar = false) 
{
	$buf = file_get_contents('/proc/loadavg');
	if( $buf == "ERROR" ) 
	{
		$results['avg'] = array('N.A.', 'N.A.', 'N.A.');
	} else {
		$results['avg'] = preg_split("/\s/", $buf, 4);
		unset($results['avg'][3]);        // don't need the extra values, only first three
	}    
		
	$buf = file_get_contents('/proc/stat');
	if( $buf != "ERROR" ) 
	{
		sscanf($buf, "%*s %f %f %f %f", $ab, $ac, $ad, $ae);
		  // Find out the CPU load
		  // user + sys = load
		  // total = total
		  $load = $ab + $ac + $ad;        // cpu.user + cpu.sys
		  $total = $ab + $ac + $ad + $ae; // cpu.total

		  // we need a second value, wait 1 second befor getting (< 1 second no good value will occour)
		  sleep(1);
		  $buf = file_get_contents('/proc/stat');
			sscanf($buf, "%*s %f %f %f %f", $ab, $ac, $ad, $ae);
		  $load2 = $ab + $ac + $ad;
		  $total2 = $ab + $ac + $ad + $ae;
		  $results['cpupercent'] = ($total2 != $total)?((100*($load2 - $load)) / ($total2 - $total)):0;
	 }

	return $results;
 }
  
/*
 * @ def : get uptime
 * -----------------------------
 *
 * @ param : array();
 */
   
public function uptime() 
  {
  	$buf = file_get_contents('/proc/uptime');
    $ar_buf = preg_split( '/\s/', $buf );
    $timestamp = trim( $ar_buf[0] );
    $uptime = '';
  	
  	$min = $timestamp / 60;
  	$hours = $min / 60;
  	$days = floor($hours / 24);
  	$hours = floor($hours - ($days * 24));
  	$min = floor($min - ($days * 60 * 24) - ($hours * 60));

  	if ($days != 0) {
    	$uptime .= $days. "&nbsp;days&nbsp;";
  	}

  	if ($hours != 0) {
    	$uptime .= $hours . "&nbsp;hours&nbsp;";
  	}

  	$uptime .= $min . "&nbsp;minutes";
  	return $uptime;
}

/*
 * @ def : get uptime
 * -----------------------------
 *
 * @ param : array();
 */
 
function network () 
{
	$results = array();
	$bufr = file_get_contents('/proc/net/dev');
    
	if ( $bufr != "ERROR" )
	{
      $bufe = explode("\n", $bufr);
    
	  foreach( $bufe as $buf ) 
	  {
        if (preg_match('/:/', $buf)) 
		{
			$test = preg_split('/:/', $buf, 2);
			
          list($dev_name,$stats_list) = preg_split('/:/', $buf, 2);
         
		  $stats = preg_split('/\s+/', trim($stats_list));
		  
		  $results[$dev_name] = array();

          $results[$dev_name]['rx_bytes'] = $stats[0];
          $results[$dev_name]['rx_packets'] = $stats[1];
          $results[$dev_name]['rx_errs'] = $stats[2];
          $results[$dev_name]['rx_drop'] = $stats[3];

          $results[$dev_name]['tx_bytes'] = $stats[8];
          $results[$dev_name]['tx_packets'] = $stats[9];
          $results[$dev_name]['tx_errs'] = $stats[10];
          $results[$dev_name]['tx_drop'] = $stats[11];

          $results[$dev_name]['errs'] = $stats[2] + $stats[10];
          $results[$dev_name]['drop'] = $stats[3] + $stats[11];
        }
      }
    }
    return $results;
  }

/*
 * @ def : get uptime
 * -----------------------------
 *
 * @ param : array();
 */
   
function memory () 
{
	$results['ram'] = array();
	$results['swap'] = array();
	$results['devswap'] = array();

    $bufr = file_get_contents( '/proc/meminfo' );
    if($bufr!='ERROR') 
	{
		$bufe = explode("\n", $bufr);
		foreach( $bufe as $buf ) 
		{
			if (preg_match('/^MemTotal:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
						$results['ram']['total'] = $ar_buf[1];
			} else if (preg_match('/^MemFree:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
			  $results['ram']['t_free'] = $ar_buf[1];
			} else if (preg_match('/^Cached:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
			  $results['ram']['cached'] = $ar_buf[1];
			} else if (preg_match('/^Buffers:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
			  $results['ram']['buffers'] = $ar_buf[1];
			} else if (preg_match('/^SwapTotal:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
			  $results['swap']['total'] = $ar_buf[1];
			} else if (preg_match('/^SwapFree:\s+(.*)\s*kB/i', $buf, $ar_buf)) {
			  $results['swap']['free'] = $ar_buf[1];
			}
       }

      $results['ram']['t_used'] = $results['ram']['total'] - $results['ram']['t_free'];
      $results['ram']['percent'] = $results['ram']['total'] ? (round(($results['ram']['t_used'] * 100) / $results['ram']['total'])) : 0;
      $results['swap']['used'] = $results['swap']['total'] - $results['swap']['free'];

      // If no swap, avoid divide by 0
      //
      if (trim($results['swap']['total'])) {
              $results['swap']['percent'] = round(($results['swap']['used'] * 100) / $results['swap']['total']);
      } else {
              $results['swap']['percent'] = 0;
      }
      // values for splitting memory usage
      if (isset($results['ram']['cached']) && isset($results['ram']['buffers'])) {
              $results['ram']['app'] = $results['ram']['t_used'] - $results['ram']['cached'] - $results['ram']['buffers'];
              $results['ram']['app_percent'] = round(($results['ram']['app'] * 100) / $results['ram']['total']);
              $results['ram']['buffers_percent'] = round(($results['ram']['buffers'] * 100) / $results['ram']['total']);
              $results['ram']['cached_percent'] = round(($results['ram']['cached'] * 100) / $results['ram']['total']);
      }

      $bufr = file_get_contents( '/proc/swaps' );
      if ( $bufr != "ERROR" ) 
	  {
        $swaps = explode("\n", $bufr);
        for ($i = 1; $i < (sizeof($swaps)); $i++) 
		{
            if(trim( $swaps[$i] )!= '') 
			{
				$ar_buf = preg_split('/\s+/', $swaps[$i], 6);
                $results['devswap'][$i - 1] = array();
                $results['devswap'][$i - 1]['dev'] = $ar_buf[0];
                $results['devswap'][$i - 1]['total'] = $ar_buf[2];
                $results['devswap'][$i - 1]['used'] = $ar_buf[3];
                $results['devswap'][$i - 1]['free'] = ($results['devswap'][$i - 1]['total'] - $results['devswap'][$i - 1]['used']);
                $results['devswap'][$i - 1]['percent'] = round(($ar_buf[3] * 100) / $ar_buf[2]);
			}
         }
      }
    }
    return $results;
  }
  
/*
 * @ def : get uptime
 * -----------------------------
 *
 * @ param : array();
 */
  
public function disk()
{
  	$results = array(); $j=0;
	exec('df -k', $df);
  	foreach( $df as $df_line) 
	{
		$df_buf1  = preg_split("/(\%\s)/", $df_line, 2);    	
    	$ret = preg_match("/(.*)(\s+)(([0-9]+)(\s+)([0-9]+)(\s+)([0-9]+)(\s+)([0-9]+)$)/", $df_buf1[0], $df_buf2);
		
		if($ret == 0) continue;
		$df_buf = array($df_buf2[1], $df_buf2[4], $df_buf2[6], $df_buf2[8], $df_buf2[10], $df_buf1[1]);
      
		  $results[$j] = array();
		  $results[$j]['disk'] = str_replace( "\\$", "\$", $df_buf1[1] );
		  $results[$j]['size'] = $df_buf[1];
		  $results[$j]['used'] = $df_buf[2];
		  $results[$j]['free'] = $df_buf[3];
		  $results[$j]['percent'] = round(($results[$j]['used'] * 100) / $results[$j]['size']);
      $j++;
    }
    
    return $results;
	}
}

// END OF HELPER ATTRRIBUTE 

?>
