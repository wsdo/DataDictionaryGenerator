<?php
/**
 * easy4php
 *
 * Class for connecting to mysql and performing common operations.
 *
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_Abstract') ;
class DB_Driver_Mysql_Handler extends DB_Abstract {
	public $query_num = 0;


	public function connect() {
		$this->_config['pconnect'] == 0 ? @mysql_connect( $this->_config['host'].':'.$this->_config['port'], $this->_config['username'], $this->_config['password'] ) : @mysql_pconnect( $this->_config['host'].':'.$this->_config['port'], $this->_config['username'], $this->_config['password'] );
		if ( mysql_errno( ) != 0 )   {
			$this->halt( "connect failed" );
		}
		if ( "4.1" < $this->version( ) && $this->_config['charset'] )      {
			mysql_query( "SET NAMES '".$this->_config['charset']."'" );
		}
		if ( "5.0" < $this->version( ) )    {
			mysql_query( "SET sql_mode=''" );
		}
		$this->select_db() ;
	}

	function select_db()  {
		if ( @!mysql_select_db( $this->_config['database'] ) )     {
			$this->halt( "Cannot use database ".$this->_config['database'] );
		}
	}

	function version( )  {
		return mysql_get_server_info( );
	}



	function query( $sql, $method = "" )   {
		if ( $method == "U_B" && function_exists( "mysql_unbuffered_query" ) )    {
			$query = mysql_unbuffered_query( $sql );
		}  else  {
			$query = mysql_query( $sql );
		}
		++ $this->query_num;
		if ( !$query )  {
			$this->halt( $sql );
		}
		return $query;
	}

	function fetch( $sql )   {
		$query = $this->query( $sql, "U_B" );
		$rs = mysql_fetch_array( $query, MYSQL_ASSOC );
		return $rs;
	}

	function fetchArray( $query, $result_type = MYSQL_ASSOC ) {
		return mysql_fetch_array( $query, $result_type );
	}
	function getRowsNum($query)	{
		return mysql_num_rows($query);
	}
	function fetchRow($query)	{
		return mysql_fetch_row($query);
	}
	function escapeStr($str)	{
		return mysql_escape_string($str);
	}

	function getFieldsNum($query) 	{
		return mysql_num_fields($query);
	}

}


?>
