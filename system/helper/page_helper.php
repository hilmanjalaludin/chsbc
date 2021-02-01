<?php

/** class Page fatory extends 
 ** from parent Class MYSQL
 ** will render to object
 ** function < library attribut page >
 ** author < omens >
 ** donate < jombi_par@yahoo.com >
 **/
 
class EUI_Pages  {
 
/** define of varibel
 ** to default send to 
 ** object 
 **/
 
 var $_pages;
 var $_query;
 var $_where;
 var $_start;
 var $_post;
 
 
/** 
 ** aksesor/constructor of main class
 ** default call property method 
 ** return < @__constructor  > 
 **/
 
function Pages()
{ 
	$this -> _post  = 0;
	$this -> _start = 0;
	$this -> _pages = 0;
	$this -> _query = null;
	$this -> _where = null;
	
}		

/** 
 ** set record/page 
 ** for display page 
 ** return <@void>
 **/
 
function _setPage( $_int )
{
	$this -> _pages = $_int;
}

/**
 ** set send of page request
 ** for counter page to view
 ** return < @void >
 **/
 
 function _postPage( $_post= '' )
 {
	if( $_post!='' ) 
		$this -> _post = $_post;
	else
		$this -> _post = 0;
 }

/**
 ** set default of query to execute 
 ** on navigation OR list page
 ** return < @void >
 **/
 
function _setQuery( $_sql='')
{
	$this -> _query.= $_sql." WHERE 1 = 1 "; 
}

/**
 ** get start number of page every 
 ** session page  
 ** return < @void >
 **/
 
function _getNo()
{
	if( ($this -> _query!='') )
		$_page_number = (($this -> _getStart())+1);
	else
		$_page_number = 0;
	
	return $_page_number;	
}

/**
 ** set AND Condition fileter if availabel filtering
 ** query string sql 
 ** return < @void >
 **/
 
function _setWhere( $_where='' )
{ 
	if( $_where!='' )
	{
		$this -> _query.= $_where;
	}	
}

/**
 ** get start number for counting page,
 ** every rows 
 ** return < INT >
 **/
 
 function _getStart()
 {
	$_pos  = 0;
	if( !empty( $this -> _post ) && ( $this -> _post >0 ) )
	{
		$_pos  = ((( $this -> _post )-1) * ((INT)$this -> _pages));
	}
	
	return $_pos;		
 }

 
/**
 ** set order asc/desc by spesific columns ,
 ** if availabel to set
 ** return < void >
 **/
 
function _setOrderBy( $_cols =null , $_type ='ASC' )
{ 
  if( $_cols!=null )
	{
		$this -> _query.= " ORDER BY $_cols $_type ";
	}
}

/**
 ** set group if availabel to set
 ** return < void >
 **/
 
function _setGroupBy( $_group = null )
{
	if( $_group != null ){
		$this -> _query.= " Group BY $_group ";
	}
}

/**
 ** set limit of query list 
 ** return < void >
 **/
 
function _setLimit()
{
	$this -> _start = $this -> _getStart();
	
	if( $this -> _start > 0 )
		$this -> _query.= " LIMIT {$this -> _start}, {$this -> _pages} ";
	else
		$this -> _query.= " LIMIT {$this -> _start}, {$this -> _pages} ";
}

/** 
 ** get total record / rows num
 ** return < int >
 **/
 
 function _get_total_record()
 {
	$_int = 0;
	if( ( $this -> _query !='') && ( $this -> _query!=null ))
	{
		$qry = $this -> query( $this ->_query );
		if( is_object($qry) ){
			$_int = $qry -> result_num_rows();	
		}
	}
	
	return $_int;
 }
 
 
/** 
 ** get total all page
 ** return < int >
 **/
 
 function _get_total_page()
 {
	$_total_pages = 1; // default page render to jquery
	
	$_totals_record = self::_get_total_record();
	if( $_totals_record > 0 )
	{
		$_total_pages = ceil( ($_totals_record)/($this -> _pages ) );
	}
	
	return $_total_pages;
 }
 
/** 
 ** get query buffer on execute
 ** mysql sesssion
 **/
 
 function _result()
 {
	
	$_qry_execute = $this -> query( $this -> _query );
	if( is_object($_qry_execute) ) {
		return $_qry_execute;
	}
	else
		return null;
 }
 
 
 /**
  ** get sql string if neded to show bugs
  ** return string
  **/
  
 function _get_query()
 {
	return $this -> _query;
 } 
 
 /**
  ** get sql string if neded to show bugs
  ** return string
  **/
  
 function _get_syntax()
 {
	return "<pre style=\"border:1px solid #ff4321;background-color:#EEEFFF;color:blue;\">".$this -> _query."</pre>";
 } 
  
}
?>