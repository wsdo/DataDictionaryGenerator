<?php if ( ! defined('EASY4PHP')) exit('Not allowed');
/**
 * easy4php
 *
 * file operations
 *
 * @package    	/lib
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
class File {
	
	
	public static function writeFile($file,$content,$mode="a") {
		$fp = fopen($file, $mode);
		if (flock($fp, LOCK_EX)) { 
    		fwrite($fp, $content);
    		flock($fp, LOCK_UN); 
    		fclose ($fp);
    		return  true  ;
		} 
  		fclose ($fp);
  		return false ;
	}
	
	
	public static function getFileContent($file) {
		if (!file_exists($file)) showMsg($file.' not exist') ;
		return file_get_contents($file) ;
	}
	
	
}
