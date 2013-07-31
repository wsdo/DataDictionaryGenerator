<?php
/**
 * easy4php
 *
 * sql for query mysql database.
 *
 * @package    	/lib/DB/Cate/Mysql
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
class DB_Cate_Mysql_Sql  {
	const DEL = '`' ;
	
	public static function showTable($database) {
		return "SHOW TABLES FROM `{$database}`" ;
	}
	
	public static function showTableStatus($tableName) {
		return "SHOW TABLE STATUS LIKE '{$tableName}' " ;
	}
	
	public static function showFields($tableName) {
		return "SHOW FIELDS FROM `{$tableName}`";
	}
	
	public static function showFieldsInformation($database,$tableName) {
		return "SELECT *
				FROM INFORMATION_SCHEMA.COLUMNS
				WHERE table_name = '{$tableName}'
				AND table_schema = '{$database}' " ;
	}
	
	public static function alterTableComment($tableName,$comment) {
		return "ALTER TABLE `$tableName` COMMENT = '$comment'" ;
	}
	
	public static function showTableSql($tableName) {
		return "SHOW CREATE TABLE `$tableName`" ;
	}
}