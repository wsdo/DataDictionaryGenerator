<?php
/**
 * easy4php
 *
 * the left of frame
 *
 * @copyright	Copyright (c) 2013 - 2018
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */

require_once 'init.php';
$dbUnique = $_GET['u'] ;
$dict = getDictByConfig($dbUnique) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo URL;?>"  />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_HERO['charset']?>" />
<script  language="JavaScript" src="static/js/jquery-1.7.2.min.js"></script>
<link rel="stylesheet" href="static/css/default.css" type="text/css" />
<title><?php echo $_lang['dbSet']?></title>
</head>
<style type="text/css">
/*--begin frame left--*/
.left_menu {
	height: 100%;
	width: 205px;
	margin-left:3px;
}
.left_menu .left_menu_c {
	float: left;
	height: 100%;
	width: 200px;
}
.left_menu .left_menu_c .menu_title {
	cursor:pointer;
	background-image: url(static/img/menu_bg.gif);
	background-repeat: repeat-x;
	height: 27px;
	background-position: 0px -1px;
	font-size: 12px;
	font-weight: bold;
	color: #3E6444;
	padding-top: 2px;
	padding-left: 20px;
	line-height: 20px;
	border-right: 1px solid #80AB73;
	border-left: 1px solid #80AB73;
}
.left_menu .left_menu_c .menu_title img {
	width:11px;
	height:6px;
}
.left_menu .left_menu_c .menu_title .img_down{
 	-moz-transform:rotate(-90deg);
 	-webkit-transform:rotate(-90deg);
 	filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);   
 	_margin-left:5px;;
}
.left_menu .left_menu_c .menu_list {
	border-right: 1px solid #80AB73;
	clear: both;
	border-left: 1px solid #80AB73;
}
.left_menu .left_menu_c .menu_list ul {
	margin-right: 10px;
	margin-left: 5px;
	margin-top: 0px;
}
.left_menu .left_menu_c .menu_list img {	
	width:6px;
	height:6px;
	_margin:10px;
	margin-right:3px;
	vertical-align:middle
}
.left_menu .left_menu_c .menu_list_li {
clear:both;
}
.left_menu .left_menu_c .menu_list li span {	
	cursor:pointer;
}
.left_menu .left_menu_c .menu_list li {	
	font-size: 12px;
	line-height: 25px;
	padding-left: 10px;
}
.left_menu .left_menu_c .menu_list .menu_cnt {
	background-image: url(static/img/menu_list_bg.gif);
}
.left_menu .left_menu_c .left_menu_by {
	clear:both;
	border-bottom: 1px solid #80AB73;
	border-left: 1px solid #80AB73;
	border-right: 1px solid #80AB73;
	text-align: right;
}
.left_menu .left_menu_c hr {
	height:1px;margin:0;*margin:0 0 -18px 0;float:none;*float:left;display:block;
	border:none;
	border-bottom: 1px dotted #80AB73;
	border-left: 1px solid #80AB73;
	border-right: 1px solid #80AB73;
}
/*--end frame left--*/
</style>
<body>	
<!-- begin top -->
<div class="left_menu">
<div class="left_menu_c">
<!-- begin menu 0 -->
  <div id="menu_title0" class="menu_title"><img src="static/img/arrow_down.gif" /> 数据库表</div>
  <div id="menu_list0" class="menu_list">
   <ul>
   <?php foreach ($dict->tablesList as $table) :?>
    <li><span class="menu_list_li" tableName="table_<?php echo $table->tableName;?>"><img src="static/img/menu_list_dot.gif" /> <?php echo $table->tableName;?></span></li>
<?php endforeach;?>
   </ul>
  </div>
<!-- end menu 0 -->
  
  
 
  <hr />
   <div class="left_menu_by">by lele &nbsp;</div>
</div><!-- end left_menu_c--> 
</div><!-- end left_menu-->
<script type="text/javascript">
$('.menu_title').on('click',function() {
    if ($(this).next('div').css('display') == 'none') {
		$(this).next('div').css('display','block') ;
		$(this).find('img').removeClass('img_down');
    }
    else {
    	$(this).next('div').css('display','none') ;
    	$(this).next('div').find('img').attr('class','img_down') ;
    	$(this).find('img').addClass('img_down');
    }
}) ;
$('.menu_list_li').on('click',function() {
	$('.menu_list_li').parent().removeClass('menu_cnt');
	var table = $(this).attr('tableName') ;
	//alert(table);
	window.top.frames['site_main'].document.location='dbmain.php?u=<?php echo $dbUnique?>#'+table ;
	$(this).parent().addClass('menu_cnt');

}) ;
</script>
<!-- end right -->
</body>
</html>


