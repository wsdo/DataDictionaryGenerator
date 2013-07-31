<?php
/**
 * easy4php
 *
 * recover the mysql database from  sql.
 *
 * @package    	/lib/DB/Cate/Mysql
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
importClass('DB_Recover') ; 
class DB_Cate_Mysql_Recover extends DB_Recover  {
	
	public function recoverAllFiles() {
		for ($i=1; $i<=$this->sqlFilesNum; $i++)	{
			$sql = File::getFileContent($this->getFileName($i)) ;
			$this->sqlExecute($sql) ;
			unset($sql) ;
		}
		return true ;
	}
	
	public function recoverTable($table,$startid,$endid) {
		for($t=$startid;$t<=$endid;$t++)	{
			$sql = File::getFileContent($this->getFileName($t)) ;						
			if ($t==$startid && preg_match('~#--Table `'.$table.'` Begin(.*)$~is',$sql,$m))
			$sql = $m[1];
			if ($t==$endid && preg_match('~(.*?)#Table End~is',$sql,$s))
			$sql = preg_replace('~(.*?)#Table End.*$~is','\\1',$sql) ;
			$this->sqlExecute($sql) ;
								
		}
	}
	
	function sqlExecute($sql)	{
		$sqls = $this->sqlSplit($sql);
		if(is_array($sqls)):		
			foreach($sqls as $sql) :
				if(trim($sql) != '')	$this->db->query(($sql));
			endforeach;
		else:
			$this->db->query($sqls);
		endif ;
		return true;
	}

	function sqlSplit($sql)	{
		$dbCharset = $this->dbConfig['charset'];
		if($this->db->version() > '4.1' && $dbCharset)	{
			$sql = preg_replace("/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "TYPE=\\1 DEFAULT CHARSET=".$dbCharset,$sql);
		}
		$sql = str_replace("\r", "\n", $sql);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query):
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			$queries = array_filter($queries);
			foreach($queries as $query):
				$str1 = substr($query, 0, 1);
				if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
			endforeach;
			$num++;
		endforeach;
		return($ret);
	}
}