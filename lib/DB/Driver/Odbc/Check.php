<?php
importClass('DB_Check') ;
class DB_Driver_Odbc_Check implements DB_Check {
	
	public static function begin( &$config) {
		$chkDriver = self::chkDriver($config) ;
		if(  $chkDriver !== true ) return array('driver',$chkDriver) ;
		$chkConfig = self::chkConfig($config) ;
		if(  $chkConfig !== true ) return array('config',$chkConfig) ;
		$chkConnect = self::chkConnect($config) ;
		if(  $chkConnect !== true ) return array('connect',$chkConnect) ;
		return array(true,$config) ;		
	}
	/**
     * check the configuration.
     *
     * @return void
     */
    public  static function chkConfig(&$config) {
    	if (!isset($config['needDsn'])) return 'empty_needDsn' ;
    	if (empty($config['category'])) return 'empty_category' ;
    	if (empty($config['charset'])) return 'empty_charset' ;
    	if ($config['needDsn'] == 0) {
    		switch ($config['category']) {
    			case 'SqlServer' :
    				if (empty($config['host'])) return 'empty_host' ;
    				$config['dsn'] = "DRIVER={sql server};server=".$config['host'].";database=".$config['database'];
    				break ;
    			case 'Access' :
    				if (empty($config['path'])) return 'empty_path' ;
    				$config['dsn'] = "DRIVER=Microsoft Access Driver (*.mdb);DBQ=".realpath( $config['path'] ) ;
    				break ;
    			default:
    				return 'error_category';
    		}
    	} else {
    		if (empty($config['dsn'])) return 'empty_dsn' ;
    	}
    	if (empty($config['username'])) return 'empty_username' ;
    	if (!isset($config['password'])) return 'unset_password' ;
    	$config = array('dsn'=>$config['dsn'],
    		'category'=>$config['category'],
    		'database'=>$config['database'],
    		'driver'=>$config['driver'],
    		'charset'=>$config['charset'],
	    	'username'=>$config['username'],
	    	'password'=>$config['password'],    	
	    	'pconnect'=>$config['pconnect']
    	) ;
    	return true ;
    }
	/**
     * check the connection.
     *
     * @return void
     */
    public  static function chkConnect($config) {   	
     	$conid = @odbc_connect( $config['dsn'], $config['username'], $config['password'], SQL_CUR_USE_ODBC );
        if ( odbc_error(  ) )   {
            //return odbc_errormsg(); //SQL Server 2005 不支持 utf-8 编码，其使用  UCS-2  编码架构（所有 unicode 字符都占用 2 个字节）。 
        	return 'connect failed' ;
        }
        return true;
    }
    /**
     * check the extension.
     *
     * @return void
     */
    public static function chkDriver() {
    	//if(!function_exists(odbc_connect)) return 'unload the odbc extention' ;
    	return true ;
    }
}