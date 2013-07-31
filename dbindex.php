<?php
/**
 * easy4php
 *
 * default page 
 *
 * @copyright	Copyright (c) 2013 - 2018
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
require_once 'init.php';
$ope = $_GET['ope'] ;
$dbUnique = $_GET['u'] ;
ob_start();
importClass('File') ;
$dbConfig = getConfigByUnique($dbUnique) ;
$tmpDict = TMP.'dict_'.$dbUnique.'.php' ;
if (!file_exists($tmpDict) || $ope=='refresh' || $ope=='init') {
	importClass('DB_Factory') ;
	$dbFac = new DB_Factory($dbConfig) ;
	$dict = $dbFac->getDict () ;	
	$serialized_object = serialize($dict);
	$safe_object = str_replace("\0", "~~NULL_BYTE~~", $serialized_object);  
	File::writeFile($tmpDict, $safe_object,'w') ;
} else {
	$dict = getDictByConfig($dbUnique) ;
}
$msg = ob_get_contents();
ob_end_clean() ;
//V($msg);
if ($ope == 'init') {
	if ($msg) exit('fail') ;
	exit('succ') ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo URL;?>"  />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_HERO['charset']?>" />
<script  language="JavaScript" src="static/js/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="static/css/default.css" type="text/css" />
<title><?php echo $_lang['dbSet']?></title>
<style type="text/css">
/*--begin frame top--*/

body.showframe {
    background: url("static/img/leftframe_bg.gif") repeat-y scroll -11px top transparent;
}
.site_top {
	height: 62px;
	width: 100%;
	background: url(static/img/site_top_bg.gif) repeat-x ;
}
.site_top .site_logo {
	float: left;
	height: 50px;
	width: 168px;
	padding-top: 10px;
	padding-left: 23px;
}
.site_top .site_info {
	float: left;
}
.site_top .site_info .site_welcome {
	font-size: 12px;
	height: 20px;
	color: #1D4A03;
	padding-top: 11px;
	padding-left:100px;
}

.site_top .site_search {
	float:right;	
	padding-top:10px;
	_margin-top:-60px; /*-- hack IE6 换行bug--*/
}
.site_top .site_search .search_input {
	float:left;
	background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #BBBBBB;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1) inset;
    font-size: 12px;
    height: 20px;
    line-height: 1.666;
    padding: 3px 8px;
    
}

.site_top .site_search .search_input .search_name {
    color: #CCCCCC;
    cursor: text;
    font-size: 12px;
    height: 90%;
    left: 9px;
    line-height: 26px;
    overflow: hidden;
}
.site_top .site_search .search_input .search_key {

    background: none repeat scroll 0 0 transparent;
    border: 0 none;
    font-size: 12px;
    margin: 0;
    outline: 0 none;
    padding: 0;
}
.site_top .site_search .search_btn {
	float:left;
	margin-top:3px;
	margin-left:2px;
	margin-right:10px;
}
.site_nav {
	height: 29px;
}
.site_nav .listnav {
}
.site_nav li {
	cursor:pointer;
	float: left;
	height: 23px;
	width: 90px;
	line-height: 24px;
	padding-top: 2px;
	text-align:center;
}
.site_nav li a {
	font-weight: bold;
	color: #1D4A03;
	display:block;
	text-decoration:none;
}
.site_nav .selected {
	background: url(static/img/site_top_nav.gif) repeat scroll 0% 0% transparent; 
}
.site_nav .unselected {
	background: url(static/img/site_top_nav2.gif) repeat scroll 0% 0% transparent; 
}

.frame_left {
	margin:0;
	padding:0;
    bottom: 0;
    left: 0;
    position: absolute;
    top: 62px;
    width: 225px;
    z-index: 9;
}
.frame_right {
    bottom: 0;
    position: absolute;
    right: 0;
    top: 62px;
    z-index: 9;
    left:240px;
}
.site_menu {
    height: 100%;
}
.site_main {
    height: 100%;
}

.site_menu iframe {
    height: 100%;
    width: 99.99%;
    z-index: 20;
}
.site_main iframe {
    height: 100%;
    width: 99.99%;
    z-index: 20;
}
/*--end frame top--*/
</style>
</head>
<body>	
<!-- begin top -->
<div class="site_top">
 <div class="site_logo"><img src="static/img/site_logo.jpg" width="145" height="30" /></div>
 <div class="site_info">
  <div class="site_welcome">您好哦.</div>  
  <div class="site_nav">
   <ul><li id="nav0" class="listnav selected">数据字典</li>
   <li id="nav1" class="listnav unselected" >数据库备份</li>
   </ul>
  </div>
 </div>
 <!-- begin site search -->
 <div class="site_search"> 	
 	<div class="search_input"><label class="search_name" ></label>
		<input class="search_key" type="text" />		
		</div>
 	 <div class="search_btn" ><img src="static/img/site_search.gif" width="23" height="20" /></div>
</div> 
<!-- end site search -->
</div>
<!-- end top -->
<div class="clr"></div>
<!-- begin left -->
<div class="frame_left">
  <div class="site_menu">
  <iframe src="dbleft.php?u=<?php echo $dbUnique ;?>" id="site_menu" name="site_menu" frameborder="0"></iframe>
  </div>
</div>
<!-- end left -->

<!-- begin right -->
<div class="frame_right">
  <div class="site_main">
  <iframe id="site_main" name="site_main" frameborder="0" src="dbmain.php?u=<?php echo $dbUnique ;?>"></iframe>
  </div>
</div>
<!-- end right -->
<script type="text/javascript">
$('.listnav').on('click',function() {
	$('.listnav').removeClass('selected') ;
	$('.listnav').addClass('unselected') ;
	$(this).removeClass('unselected') ;
    $(this).addClass('selected') ;
    if ($(this).attr('id') == 'nav1') {
    	window.top.frames['site_main'].document.location='dbbak.php?u=<?php echo $dbUnique?>' ;
    } else {
    	window.top.frames['site_main'].document.location='dbmain.php?u=<?php echo $dbUnique?>' ;
    }
}) ;
</script>
</body>
</html>


