<?php
/**
 * easy4php
 *
 * initialization 
 *
 * @copyright	Copyright (c) 2013 - 2018
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
define('EASY4PHP', 1);
define('CNT_PATH', __FILE__ ? dirname(__FILE__) : './');
define('CONFIG', CNT_PATH.'/inc/');
define('LANG', CNT_PATH.'/inc/lang/');
define('LIB', CNT_PATH.'/lib/');
define('TMP', CNT_PATH.'/tmp/');
define('STATIC', CNT_PATH.'/static/');

require_once CONFIG.'site.inc.php' ;
define('URL', $_HERO['static_url']);
define('IMG', URL.'static/img/');
define('JS', URL.'static/js/');
define('CSS', URL.'static/css/');
date_default_timezone_set($_HERO['timezone']);
require_once LIB.'function.php' ;
require_once LANG.$_HERO['lang'].'.lang.php';
if ($_HERO['enviroment'])	{
	switch ($_HERO['enviroment'])	{
		case 'all':
			error_reporting(E_ALL);
		break ;
		case 'development':
			error_reporting(E_ALL ^ E_NOTICE);
		break ;
		case 'production':
			error_reporting(0);
		break ;
		default:
			exit('enviroment error');
	}
}





