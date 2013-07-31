<?php
abstract class DB_Recover  {
	public $sqlFilesNum = 0 ;
	public $sqlFilePrefix ;
	public $db ;
	public $dbConfig ;
	public $bakDir ;
	
	public function __construct($db, $bakDir,$dbConfig) {
		$this->bakDir = $bakDir ;
		$this->db = $db ;
		$this->dbConfig = $dbConfig ;
		$dbName = $dbConfig['database'] ;
		$sqlFiles = glob($bakDir.$dbName."_*.sql") ;
		if (count($sqlFiles) < 1) showMsg('bak files unexist') ;
		foreach($sqlFiles as $k=>$v)	{
			list($d,$t,$thetime,$id) = explode("_",substr(basename($v),0,-4)) ;
			$arrfile[$k] = $thetime ;
		}
		asort($arrfile) ;
		$all_count = array_count_values($arrfile) ;
		$maxtime = array_pop($arrfile) ;
		$this->sqlFilesNum = $all_count[$maxtime] ;
		$this->sqlFilePrefix = $bakdir.$dbName."_".date('Ymd',$maxtime)."_".$maxtime ; 
	}
	public function getFileName($i) {
		return $this->bakDir.'/'.$this->sqlFilePrefix."_".$i.".sql" ;
	}
	public function getTraceFile() {
		return $this->bakDir.'/'.$this->sqlFilePrefix.".txt" ;
	}
	public function getBakTables() {
		importClass('File') ;
		$content = File::getFileContent($this->getTraceFile()) ;
		if (preg_match_all('~`(.*)`\|(\d+)\|(\d+)\|~isU', $content, $matches)) {
			foreach($matches[1] as $k=>$v):
				$tables[] = array('tableName'=>$v,'rows'=>$matches[3][$k]) ;
			endforeach;
			//V($tables);
			return $tables ;
		}
		return false ;
	}
	
	public function getRecoverTableFilesID($tableName) {
		importClass('File') ;	
		$content = File::getFileContent($this->getTraceFile()) ;
		$mat = '~`'.$tableName.'`\|(\d+)\|[^`]*[^\|]*\|(\d+)~is' ;
		if (preg_match($mat,$content,$m))	{
			$startid = $m[1] ;
			$endid = $m[2] ;
		}	else if (preg_match('~`'.$tableName.'`\|(\d+)\|~is',$content,$m))	{
			$startid = $m[1] ;
			$endid = $this->sqlFilesNum ;
		}	else	{
			return array(NULL,NULL) ;
		}
		return array($startid, $endid) ;
	}
	
	public function recoverAllFiles() {}
	
	public function recoverTable($table,$startid,$endid) {}
	
	public function recoverPartsTables($parts) {
		foreach ($parts as $table) :
			list($startid,$endid) = $this->getRecoverTableFilesID($table) ;
			if ($startid === NULL) continue ;
			$this->recoverTable($table,$startid,$endid) ;
		endforeach;
	}
	
}