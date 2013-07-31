<?php
/**
 * easy4php
 *
 * sql for query SqlServer.
 *
 * @package    	/lib/DB/Cate/SqlServer
 * @copyright	Copyright (c) 2008 - 2011
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
class DB_Cate_SqlServer_Sql  {
	public static $version = '2005' ; //2000 2008
	
	
	public static function showTableAndDesc() {
		switch (self::$version) {
			case '2005' :
				return "Select tableName=d.name,tableDesc = isnull(f.value,'')
						FROM sysobjects d 
						left join sys.extended_properties f on   d.id=f.major_id and f.minor_id=0
						where d.xtype='U' and  d.name<>'dtproperties'" ;
				break;
			case '2000' :
				return "select tableName=d.name,tableDesc=isnull(s.value,'')
						from sysobjects d left join sysproperties s
						on s.id=d.id and s.smallid=0
						where d.xtype='U' and  d.name<>'dtproperties'" ;
				break;
			default:
				showDbMsg('error db version') ;
		}
		
	}
	
	
	
	public static function showFieldsInformation($tableName) {
		switch (self::$version) {
			case '2005' :
				return "SELECT    fieldName=a.name, 
  						fieldType=b.name, 
						fieldTypeLength=a.length,
					    fieldDefault=isnull(e.text,''), 
					    fieldIsnull=case when a.isnullable=1 then 'YES' else 'NO' end, 
					    fieldIdentity=case when COLUMNPROPERTY( a.id,a.name,'IsIdentity')=1 then 'YES' else 'NO' end,
					    fieldPrimary=case when exists(SELECT 1 FROM sysobjects where xtype='PK' and parent_obj=a.id and name in (
					    SELECT name FROM sysindexes WHERE indid in(
					    SELECT indid FROM sysindexkeys WHERE id = a.id AND colid=a.colid
					    ))) then 'PRI' else '' end,
					     fieldDesc=isnull(g.[value],'')
					      FROM syscolumns a left join systypes b on a.xtype=b.xusertype inner join sysobjects d on a.id=d.id  
					         and d.xtype='U' and  d.name='{$tableName}'
					           left join syscomments e on a.cdefault=e.id left join sys.extended_properties g on a.id=G.major_id and a.colid=g.minor_id  
					                 order by a.id,a.colorder" ;
				break;
			case '2000' :
				return "SELECT    fieldName=a.name, 
  						fieldType=b.name, 
						fieldTypeLength=a.length,
					    fieldDefault=isnull(e.text,''), 
					    fieldIsnull=case when a.isnullable=1 then 'YES' else 'NO' end, 
					    fieldIdentity=case when COLUMNPROPERTY( a.id,a.name,'IsIdentity')=1 then 'YES' else 'NO' end,
					    fieldPrimary=case when exists(SELECT 1 FROM sysobjects where xtype='PK' and parent_obj=a.id and name in (
					    SELECT name FROM sysindexes WHERE indid in(
					    SELECT indid FROM sysindexkeys WHERE id = a.id AND colid=a.colid
					    ))) then 'PRI' else '' end,
					     fieldDesc=isnull(g.[value],'')
					      FROM syscolumns a left join systypes b on a.xtype=b.xusertype inner join sysobjects d on a.id=d.id  
					         and d.xtype='U' and  d.name='{$tableName}'
					           left join syscomments e on a.cdefault=e.id left join sys.extended_properties g on a.id=g.id and a.colid=g.smallid   
					                 order by a.id,a.colorder" ;
				break;
			default:	
				showDbMsg('error db version') ;
		}
	}
	
}