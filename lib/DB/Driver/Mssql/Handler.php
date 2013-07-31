<?php
/**
 * easy4php
 *
 * Class for connecting to Microsoft SQL Server databases by the mssql driver and performing common operations.
 *
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_Abstract') ;
class DB_Driver_Mssql_Handler extends DB_Abstract {
	private $query_num = 0;
 	private $link ;
    
    public function connect() {
     	$this->link = $this->_config['pconnect'] == 0 ? @mssql_connect( $this->_config['host'], $this->_config['username'], $this->_config['password'] ) : @mssql_pconnect( $this->_config['host'], $this->_config['username'], $this->_config['password']);
        if ( !$this->link )  {
            $this->halt( "Connect to mssql  failed" );
        }
        $this->selectDb();
    }
	function selectDb()  {
		if ( @!mssql_select_db( $this->_config['database'] ) )     {
			$this->halt( "Cannot use database ".$this->_config['database'] );
		}
	}    
 	function query( $sql )   {
        $query = @mssql_query(  $sql ,$this->link);
        ++ $this->query_num;
        if ( !$query )  {
            $this->halt( "Query Error: ".$sql );
        }
        return $query;
    }
    
  

    function fetchArray( $query ,$result_type = MSSQL_ASSOC) {
        return mssql_fetch_array( $query, $result_type );
    }
    
	function close( ) {
        return mssql_close( );
    }
    
    function affectedRows( )    {
        return mssql_rows_affected( $this->link );
    }

    function getRowsNum( $query )    {
        $rows = mssql_num_rows( $query );
        return $rows;
    }

    function freeResult( $query )    {
        return mssql_free_result( $query );
    }
    

}


?>
