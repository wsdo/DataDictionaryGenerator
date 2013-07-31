<?php
/**
 * easy4php
 *
 * 
 *
 * @package    	DataBase
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
abstract class DB_Abstract {
	/**
     * User-provided configuration
     *
     * @var array
     */
    protected $_config = array(); 
    
	
    
     public function __construct($config) {
    	$this->_config = $config ;
    }
    
    
    
    public function halt($msg, $sqlerrno=NULL, $sqlerror=NUll) {
    	showDbMsg($msg, $sqlerrno, $sqlerror) ;
    }
}
