<?php if ( ! defined('EASY4PHP')) exit('Not allowed');
$_HERO['site']['title'] = 'hello' ;
$_HERO['site']['link'] = 'hello' ;
$_HERO['site']['email'] = 'hello' ;


$_HERO['index_page'] = 'index.php' ;
$_HERO['base_url'] = '' ;
$_HERO['static_url'] = 'http://www.test.com/allDbBak/' ;
$_HERO['charset'] = 'utf-8' ;
$_HERO['timezone'] = 'Asia/Shanghai' ;
$_HERO['enviroment'] = 'development' ;
$_HERO['lang'] = 'cn' ;

$_HERO['db_catetory'] = array('Mysql'=>array('Mysql','Mysqli','Pdo'), //adodb
	'SqlServer'=>array('Mssql','Odbc','Pdo'),
	'Oracle'=>array('Oci8','Pdo'),
	'Access'=>array('Odbc')
) ;