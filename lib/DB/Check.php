<?php
interface DB_Check {
	/**
     * begin
     *
     * @return void
     */
    public static function begin(&$config);
	/**
     * check the connection.
     *
     * @return void
     */
    public static function chkConnect($config);
    
 	/**
     * check the configuration.
     *
     * @return void
     */
    public static function chkConfig(&$config) ;
    /**
     * check the extension.
     *
     * @return void
     */
    public static function chkDriver() ;
}