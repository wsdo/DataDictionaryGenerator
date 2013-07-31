<?php
/**
 * easy4php
 *
 * Class for connecting to database using odbc and performing common operations.
 *
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_Abstract') ;
class DB_Driver_Odbc_Handler extends DB_Abstract {
	private $query_num = 0;
 	private $link ;
    
    public function connect() {
     	$this->link = $this->_config['pconnect'] == 0 ? @odbc_connect( $this->_config['dsn'], $this->_config['username'], $this->_config['password'], SQL_CUR_USE_ODBC ) : odbc_pconnect( $this->_config['dsn'], $this->_config['username'], $this->_config['password'], SQL_CUR_USE_ODBC );
        if ( !$this->link )  {
            $this->halt( "Connect to odbc  failed" );
        }
    }
        
 	function query( $sql )   {
        $query = @odbc_do( $this->link, $sql );
        ++ $this->query_num;
        if ( !$query )  {
            $this->halt( "Query Error: ".$sql );
        }
        return $query;
    }
    
    function fetch( $sql )   {
        $query = $this->query( $sql, "U_B" );
        $rs = odbc_fetch_array( $query );
        return $rs;
    }

    function fetchArray( $query ) {
        return odbc_fetch_array( $query );
    }
    
	function close( ) {
        return odbc_close( $this->link );
    }

}


?>
