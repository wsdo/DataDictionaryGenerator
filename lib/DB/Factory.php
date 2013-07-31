<?php
class DB_Factory {
	private $category ;
	private $driver ;
	private $driverPath ;
	private $categoryPath ;
	private $dbConfig ;
	private $db ;


	function __construct($dbConfig,$initDb=true) {
		$this->dbConfig = $dbConfig ;
		$this->category = $dbConfig['category'] ;
		$this->driver = $dbConfig['driver'] ;
		$this->categoryPath = 'DB_Cate_'.$this->category.'_' ;
		$this->driverPath = 'DB_Driver_'.$this->driver.'_' ;
		if ($initDb) $this->db = & $this->getBean() ;
	}	
	
	function dbCheck() {
		importClass($this->driverPath.'Check') ;
		//return call_user_func($this->driverPath.'Check::begin',$config) ;//Note that the parameters for call_user_func() are not passed by reference. 
		return call_user_func_array($this->driverPath.'Check::begin',array(&$this->dbConfig)) ; 
		
	}
	
	function & getBean(){
		
		$db = & loadClass($this->driverPath.'Handler', true, $this->dbConfig) ;	
		$db->connect() ;	
		return $db ;		
	}
	function getBackup($bakDir,$bakFileSize,$bakTables,$bakFilePrefix) {
		importClass($this->categoryPath.'Backup') ;
		$class = "DB_Cate_{$this->category}_Backup" ;
		return new $class($this->db,$this->dbConfig['database'],$bakDir,$bakFileSize,$bakTables,$bakFilePrefix) ;
	}
	
	function getRecover($bakDir) {
		importClass($this->categoryPath.'Recover') ;
		$class = "DB_Cate_{$this->category}_Recover" ;
		return new $class($this->db, $bakDir, $this->dbConfig) ;
	}
	
	function getDict() {
		importClass($this->categoryPath.'GenDict') ;
		return call_user_func_array($this->categoryPath.'GenDict::getFields',array($this->db,$this->dbConfig['database'])) ; 
	}
}
