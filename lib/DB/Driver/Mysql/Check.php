<?php
importClass('DB_Check') ;
class DB_Driver_Mysql_Check implements DB_Check {
	
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
    	if (empty($config['host'])) return 'empty_host' ;
    	if (empty($config['port'])) return 'empty_port' ;
    	if (empty($config['username'])) return 'empty_username' ;
    	if (empty($config['database'])) return 'empty_database' ;
    	if (empty($config['charset'])) return 'empty_charset' ;
    	if (!isset($config['password'])) return 'unset_password' ;
    	$config = array('host'=>$config['host'],
    		'category'=>$config['category'],
    		'driver'=>$config['driver'],
	    	'port'=>$config['port'],
	    	'username'=>$config['username'],
    		'charset'=>$config['charset'],
	    	'database'=>$config['database'],
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
     	@mysql_connect( $config['host'].':'.$config['port'], $config['username'], $config['password'] );
        if ( mysql_errno( ) != 0 )   {
            return 'connect failed' ;
        }
    	if ( !mysql_select_db( $config['database'] ) )  {
            return  "Cannot use database ".$config['database'] ;
        }
        return true ;
    }
    /**
     * check the extension.
     *
     * @return void
     */
    public static function chkDriver() {
    	if(!function_exists(mysql_connect)) return 'unload the mysql extention' ;
    	return true ;
    }
}