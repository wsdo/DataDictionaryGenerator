<?php
abstract class DB_Backup  {
	public  $bakDir ;
	public  $bakFileSize = 2000;
	public  $bakFilePrefix ;
	public  $db ;
	public  $database ;
	public  $bakTables ;
	
	public  function __construct($db,$database,$bakDir,$bakFileSize,$bakTables,$bakFilePrefix) {
		$this->db = $db ;
		$this->setBakDir($bakDir) ;
		$this->database = $database ;
		$this->bakFileSize =$bakFileSize ;
		$this->bakTables = $bakTables ;
		//V($bakFilePrefix);
		if(empty($bakFilePrefix))  
			$this->setBakFilePrefix();
		else 
			$this->bakFilePrefix = $bakFilePrefix ;
	}
	
	public  function setBakDir($bakDir) {
		!is_dir($bakDir) && showMsg($bakDir." doesn't exist ") ;
		$this->bakDir = $bakDir ;
	}
	
	public  function setBakFile($index) {
		return $this->bakDir.'/'.$this->bakFilePrefix.'_'.$index.'.sql' ;		
	}
	
	public  function setBakFilePrefix() {
		$this->bakFilePrefix = $this->database.'_'.date('Ymd').'_'.time() ;	
	}
	
	public  function getTraceFile() {
		return  $this->bakDir.'/'.$this->bakFilePrefix.'.txt' ;		
	}
	
	public function getTmpContenFile() {
		return  $this->bakDir.'/'.$this->bakFilePrefix.'_tmpContent.txt' ;	
	}
	
	
}