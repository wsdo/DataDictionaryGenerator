<?php if ( ! defined('EASY4PHP')) exit('Not allowed');

//get the current microtime
if ( ! function_exists('getCntTime')) {
	function getCntTime() {
    	list($usec, $sec) = explode(" ", microtime());
    	return ((float)$usec + (float)$sec);
	}	
}

if ( ! function_exists('getDictByConfig')) {
	function getDictByConfig($dbUnique) {
    	importClass('File') ;
		$tmpDict = TMP.'dict_'.$dbUnique.'.php' ;
		importClass('DB_Dict') ; 
		$object = str_replace( "~~NULL_BYTE~~", "\0", File::getFileContent($tmpDict));  
		$dict =  unserialize($object);
		return $dict ;
	}	
}
if ( ! function_exists('getConfigByUnique')) {
	function getConfigByUnique($dbUnique) {
    	importClass('File') ;
    	$tmpConfig = TMP.'config_'.$dbUnique.'.php' ;
		$dbConfig = @unserialize(File::getFileContent($tmpConfig)) ;
		if (!is_array($dbConfig)) error('reading config error') ;
		return $dbConfig ;
	}	
}
if ( ! function_exists('V')) {
	function V() {
		/* $num = func_num_args();
		 for($i=0; $i<$num; $i++) var_dump(func_get_arg($i)) ;*/
		echo '<br/>---debug begin---' ;
		$params = func_get_args()  ;
		call_user_func_array('var_dump', $params) ;
		echo '---debug end---<br/>' ;
	}
}
if ( ! function_exists('VE')) {
	function VE() {
		echo '<br/>---debug begin---' ;
		 $params = func_get_args()  ;
		 call_user_func_array('var_dump', $params) ;
		 echo '---debug end---<br/>' ;
		 exit;
	}
}

if ( ! function_exists('P')) {
	function P() {
		echo '---debug begin---' ;
		 $num = func_num_args();
		 if ($num == 1) print_r(func_get_arg(0)) ;
		 if ($num == 2 && func_get_arg(1)==false) print_r(func_get_arg(0),false) ;
		echo '---debug end---' ;
	}
}

if ( ! function_exists('error')) {
	function error($msg) {
		exit($msg) ;
	}
}

if ( ! function_exists('showMsg')) {
	function showMsg($msg) {
		importClass('LibException') ;
		LibException::showError($msg) ;;
	}
}

if ( ! function_exists('showDbMsg')) {
	function showDbMsg($msg, $sqlerrno=NULL, $sqlerror=NUll) {
		importClass('DB_Exception') ;
		DB_Exception::showError($msg, $sqlerror, $sqlerrno) ;
	}
}
//include the class file
if ( ! function_exists('importClass')) {
	function importClass($className,$type = 'lib') {
		$path = str_replace('_', '/', $className) ;		
    	switch ($type) {
    		case 'lib' :
    			$file = LIB.'/'.$path.'.php' ;
    			break ;
    		default:
    			error('go wrong') ;
    	}
    	if (!file_exists($file)) error($file.' not found ') ;
    	require_once $file ;
	}	
}
//load the class support singleton pattern
if ( ! function_exists('loadClass')) {
	function &loadClass($className, $singleton=false, $params=null, $type = 'lib') {
		static $_classes = array();
		if ($singleton && isset($_classes[$className]))		{
			return $_classes[$className];
		}
		importClass($className, $type) ;
		if ($singleton) {
			$_classes[$className] = new $className($params) ;
			return $_classes[$className] ;
		}
    	return new $className($params) ;
	}	
}
