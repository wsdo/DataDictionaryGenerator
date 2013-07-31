<?php
/**
 * easy4php
 *
 * get the dictionary of SqlServer database 
 *
 * @package    	/lib/DB/Cate/SqlServer
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_GenDict') ; 
class DB_Cate_SqlServer_GenDict implements DB_GenDict  {
	
	
	public static function getFields($db,$database) {
		importClass('DB_Cate_SqlServer_Sql') ; 
		importClass('DB_Dict') ; 
		$object_database = new DB_DictDatabase() ;
		$object_database->name = $database ;
		$query_t = $db->query(DB_Cate_SqlServer_Sql::showTableAndDesc()) ;
		while ($row_table = $db->fetchArray($query_t)) {
			$object_table  = new DB_DictTable() ;			
			$object_table->tableName =  $row_table['tableName'] ;
			$object_table->tableDesc = $row_table['tableDesc'] ;
			$query_f = $db->query(DB_Cate_SqlServer_Sql::showFieldsInformation($object_table->tableName)) ; 
			while($row_field = $db->fetchArray($query_f)) {
				$object_field = new DB_DictField() ;
				$object_field->fieldName = $row_field['fieldName'] ;
				$object_field->fieldDesc = $row_field['fieldDesc'] ;
				$object_field->fieldType = $row_field['fieldType'].'('.$row_field['fieldTypeLength'].')' ;
				$object_field->fieldDefault = $row_field['fieldDefault'] ;
				$object_field->fieldIsNull = $row_field['fieldIsnull']=='NO' ? 'no':'yes' ;
				$object_field->fieldIdentity = $row_field['fieldIdentity']=='YES' ? 'yes':'no';
				$object_field->fieldPrimary = $row_field['fieldPrimary']=='PRI' ? 'yes':'no' ;
				$fieldsList[] = $object_field ;
				unset($object_field) ;
			}
			$object_table->fieldsList = $fieldsList ;
			$tablesList[] = $object_table ;
			//V($object_table) ;
			unset($object_table,$fieldsList) ;
		}
		$object_database->tablesList = $tablesList ;
		unset($tablesList) ;
		return $object_database ;
	}
	
	
}