<?php
/**
 * easy4php
 *
 * check the database 
 *
 * @copyright	Copyright (c) 2013 - 2018
 * @link		http://www.easy4php.com
 * @author		kuishui
 * @version		1.0
 */
require_once 'init.php';
importClass('DB_Factory') ;
$dbFac = new DB_Factory($_POST) ;
list($result,$msg) = $dbFac->dbCheck() ;
if ($result === true) {
	importClass('File') ;
	$file = md5(implode(',', $_POST)) ;
	File::writeFile(TMP.'config_'.$file.'.php', serialize($msg),'w') ;
	$return = 'succ|'.$file ;
} else 
$return = 'fail|'.$msg ;
header('Content-Type: text/html; charset=gbk');
exit($return) ;
?>

