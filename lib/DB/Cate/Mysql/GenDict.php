<?php
/**
 * easy4php
 *
 * get the dictionary of mysql database 
 *
 * @package    	/lib/DB/Cate/Mysql
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_GenDict') ; 
class DB_Cate_Mysql_GenDict implements DB_GenDict  {
	
	
	public static function getFields($db,$database) {
		importClass('DB_Cate_Mysql_Sql') ; 
		importClass('DB_Dict') ; 
		$object_database = new DB_DictDatabase() ;
		$object_database->name = $database ;
		$query_t = $db->query(DB_Cate_Mysql_Sql::showTable($database)) ;
		while ($row_table = $db->fetchArray($query_t)) {
			$object_table  = new DB_DictTable() ;			
			$object_table->tableName =  $row_table["Tables_in_".$database] ;
			$table_status = $db->fetch(DB_Cate_Mysql_Sql::showTableStatus($object_table->tableName)) ;
			$object_table->tableDesc = $table_status['Comment'] ;
			$query_f = $db->query(DB_Cate_Mysql_Sql::showFieldsInformation($database,$object_table->tableName)) ; 
			while($row_field = $db->fetchArray($query_f)) {
				$object_field = new DB_DictField() ;
				$object_field->fieldName = $row_field['COLUMN_NAME'] ;
				$object_field->fieldDesc = $row_field['COLUMN_COMMENT'] ;
				$object_field->fieldType = $row_field['COLUMN_TYPE'] ;
				$object_field->fieldDefault = $row_field['COLUMN_DEFAULT'] ;
				$object_field->fieldIsNull = $row_field['IS_NULLABLE']=='NO' ? '否':'是' ;
				$object_field->fieldIdentity = $row_field['EXTRA']=='auto_increment' ? 'yes':'no' ;
				$object_field->fieldPrimary = $row_field['COLUMN_KEY']=='PRI' ? '是':'否' ;
				$fieldsList[] = $object_field ;
				unset($object_field) ;
			}
			$object_table->fieldsList = $fieldsList ;
			$tablesList[] = $object_table ;
			//VE($object_table) ;
			unset($object_table,$fieldsList) ;
		}
		$object_database->tablesList = $tablesList ;
		unset($tablesList) ;
		return $object_database ;
	}
	
	
}