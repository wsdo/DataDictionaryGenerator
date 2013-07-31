<?php
/**
 * easy4php
 *
 * backup the mysql database.
 *
 * @package    	/lib/DB/Cate/Mysql
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_Backup') ; 
class DB_Cate_Mysql_Backup extends DB_Backup  {
	public $offset = 100000 ;
	public $stepByStep = true ;
	

	
	public function begin($startRow=0, $goOn=0, $tableId=0, $fileId=1, $loop=0) {
		importClass('File') ;
		$tablesNum = count($this->bakTables) ;		
		$content = '' ;
		$this->stepByStep && $content = $this->readTmpContent() ;
		//V($startRow, $goOn, $tableId, $fileId, $loop);
		$viewsNum = 0 ;
		for ($t=$loop; $t <= $tablesNum; $t++) {
			$queryTable = $this->setQueryTable($tableId) ;
			if ($queryTable === false) { //over
				//echo '--'.$tableId.'--' ;
				$content.= "\n#Table End\n\n" ;	
				break ;
			}
			if ($tableId != $t) {
				$t = $tableId ;
			}	else	{ //另起一张表
				$content && $content.= "\n#Table End\n\n" ;					
				$this->writeTrace( "$queryTable|$fileId" ) ;
				$content .= "#--Table $queryTable Begin\n\n" ;
				$content .= "DROP TABLE IF EXISTS $queryTable;\n";
				$createtable = $this->db->query("SHOW CREATE TABLE $queryTable");
				$create = $this->db->fetchRow($createtable);
				$content .= $create[1].";\n\n";
			}
			if (strlen($content) < $this->bakFileSize * 1024) 	:
				$tmp_e = $tablesNum - $viewsNum ;
				if ($t >= $tmp_e) {
					$tableId++ ;
					continue ;
				}
				$sql = "select * from $queryTable limit $startRow,$this->offset" ;
				//echo $sql."\n" ;
				$result = $this->db->query($sql) ;
				$fieldsNum = $this->db->getFieldsNum($result) ;
				$rowsNum = $this->db->getRowsNum($result);
				while ($data = $this->db->fetchRow($result))	{
					$startRow++ ;
					$comma = "";
					$content .= "INSERT INTO $queryTable VALUES(";
					for($i = 0; $i < $fieldsNum; $i++)	{
						$content .= $comma."'".$this->db->escapeStr($data[$i])."'";
						$comma = ",";
					}
					$content .= ");\n";
					if (strlen($content) >= $this->bakFileSize*1024)	{
						$this->writeSql($fileId, $content) ;
						//$content = '' ;
						//$fileId++ ;
					}
				}
				if ($rowsNum == $this->offset)	{
					$goOn++ ;
					//continue ;
				}	else	{
					$total = $goOn * $this->offset + $rowsNum ;
					$goOn = 0;
					$this->writeTrace("|$total|ok\n") ;
					++$tableId ;
					$startRow = 0 ;
					//continue ;
				}
			else:
				$this->writeSql($fileId, $content) ;				
			endif;
			if ($this->stepByStep && $this->setQueryTable($tableId)) {
				$content && $this->writeTmpContent($content) ;
				return array($startRow, $goOn, $tableId, $fileId, $t+1,$this->bakFilePrefix) ;
			}
		}		
		$content &&	$this->writeSql($fileId, $content) ;
		return true ;
	}
	
	public function writeSql(&$fileId, &$content) {
		File::writeFile($this->setBakFile($fileId), $content,'w') ;
		$content = '' ;
		$fileId++ ;
		$this->stepByStep && $this->writeTmpContent('') ;
			
		//echo '文件:"'.$this->setBakFile($fileId).'.导出成功'."\n" ;
	}
	
	public function writeTrace($trace) {
		File::writeFile($this->getTraceFile(), $trace) ;
	}
	
	
	
	public function writeTmpContent($content) {
		File::writeFile($this->getTmpContenFile(), $content,'w') ;
	}
	
	public function readTmpContent() {
		if (!file_exists($this->getTmpContenFile())) return '' ;
		$content = File::getFileContent($this->getTmpContenFile()) ;
		if (empty($content)) return '' ;
		return $content ;
	}
	
	public function setQueryTable($tableId) {
		//V($this->bakTables,$tableId);
		if (!isset($this->bakTables[$tableId])) return false ;
		return '`'.$this->bakTables[$tableId].'`' ; 
	}
	
	
	
	
}