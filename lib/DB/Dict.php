<?php
/**
 * easy4php
 *
 * database dictionary
 *
 * @package    	DataBase
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
class DB_DictDatabase  {
	private $name ;
	private $tablesList = array()  ;
	
	public function __get($property_name)	{
	if(isset($this->$property_name))	{
		return($this->$property_name);
	}	else	{
			return(NULL);
		}
	}
	public function __set($property_name, $value)	{
		$this->$property_name = $value;
	}
}
class DB_DictTable  {
	private $tableName ;
	private $tableDesc ;
	private $fieldsList = array()  ;
	
	public function __get($property_name)	{
	if(isset($this->$property_name))	{
		return($this->$property_name);
	}	else	{
			return(NULL);
		}
	}
	public function __set($property_name, $value)	{
		$this->$property_name = $value;
	}
}

class DB_DictField  {
	private $fieldName ;
	private $fieldDesc ;
	private $fieldType ;
	//private $fieldTypeLength ;
	private $fieldDefault ;
	private $fieldIsNull ;	
	private $fieldIdentity ;
	private $fieldPrimary ;
	
	public function __get($property_name)	{
	if(isset($this->$property_name))	{
		return($this->$property_name);
	}	else	{
			return(NULL);
		}
	}
	public function __set($property_name, $value)	{
		$this->$property_name = $value;
	}
}