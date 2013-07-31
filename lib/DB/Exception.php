<?php
/**
 * easy4php
 *
 * exception
 *
 * @package    	DataBase
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
class DB_Exception {
	 public static function showError ( $msg , $sqlerror, $sqlerrno)  {
        exit($msg) ;
    }

}
