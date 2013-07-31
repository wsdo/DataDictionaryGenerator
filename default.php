<?php
/**
 * easy4php
 *
 * set the config for connecting database
 *
 * @copyright	Copyright (c) 2013 - 2018
 * @link		http://www.easy4php.com
 * @author		keshuichong
 * @version		1.0
 */
require_once 'init.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_HERO['charset']?>" />
<script  language="JavaScript" src="<?php echo JS;?>jquery-1.7.2.min.js"></script>
<title><?php echo $_lang['dbSet']?></title>
<style type="text/css">
body, div, dl, dt, dd, ul, ol, li,h1, h2, h3, h4, h5, h6, pre, code,form, fieldset, legend, input, button,textarea, p, blockquote, th, td,select {margin: 0;padding: 0;}
ol, ul {list-style: none;}
body{font:12px/1.6 Arial,Helvetica,sans-serif; _font-family:"SimSun";}
/*clear float*/
.clearfix:after { 
	content: "."; 
	display: block; 
	height: 0; 
	clear: both; 
	visibility: hidden; 
}
.clearfix { 
	display: inline-block; 
}
.clearfix { 
	display: block;
	*zoom:1; 
}
.clear { 
	clear: both; 
	height: 0; 
	font: 0/0 Arial; 
	visibility: hidden; 
}
.dblist {
	position: relative;
	margin: 0 auto ;
	width:400px;
	padding: 10px;
}
/*选项卡标题*/
.db-name {
	/*border-bottom: 1px solid #cfcfcf;/*下边框1px*/
}
.db-name li {
	display: inline-block;
	float: left;
	height: 28px;
	line-height: 28px;
	border: 1px solid #cfcfcf;
	border-right: 0;/*去掉右边框*/
	margin-top: 1px;
	position: relative;/*因为ul或content容器有1px的下或上边框，且li也有1px的边框,叠加后变成2px,所以li要利用定位使本身位置下移1像素*/
	top: 1px;
	z-index: 1;
	background: #fbfbfb;/*可改变其他背景颜色*/
	/*border-radius: 3px;*/
}
.db-name li.active {/*当前li的样式*/
	border-top: 2px solid #5ba533;/*因为上边框设置为2px，所以li的上外边距要设置为0*/
	border-bottom-color: #fff;/*给下边框的颜色设置为白色或透明实现去掉下边框的效果*/
	z-index: 2;
	margin-top: 0;
	/*background: #fff;*/
}
#db-item-last {
	border-right: 1px solid #cfcfcf;/*给最后一个li补上右边框*/
}
.db-name a {
	color: #333;
	padding: 0 16px;
	line-height: 28px;
	text-decoration: none;
}
.db-name a:hover { 
	color: #5ba533;
	text-decoration: none;
} 

/*选项卡内容*/
.db-set {
	border: 1px solid #cfcfcf;
	/*border-top: none;/*去掉上边框*/
	padding: 10px 25px;
	width: 400px;
	position: absolute;
	left: -20px;
}
.db-set-pane {
	display: none;
}
.db-set .current {
	display: block;
}

input.main {
    background-color: #FAFAFA;
    font-weight: bold;
    padding-top: 4px;
}
.background {
display: block;
width: 100%;
height: 100%;
opacity: 0.4;
filter: alpha(opacity=40);
background:white;
position: absolute;
top: 0;
left: 0;
z-index: 9000;
}
.progressBar {
border: solid 2px #86A5AD;
background: white url(<?php echo IMG;?>progressBar.gif) no-repeat 10px 10px;
}
.progressBar {
	display: block;
	width: 248px;
	height: 50px;
	position: fixed;
	top: 50%;
	left: 50%;
	margin-left: -74px;
	margin-top: -14px;
	padding: 10px 10px 10px 50px;
	text-align: left;
	line-height: 27px;
	font-weight: bold;
	position: absolute;
	z-index: 9001;
} 
</style>
</head>
<body>
<div id="background" class="background" style="display: none; "></div>
<div id="progressBar" class="progressBar" style="display: none; ">正在创建数据字典，请稍等...</div>

<div class="dblist">

<br /><br />
	<h3 align="center"><?php echo $_lang['dbSet']?></h1>
		<ul class="db-name clearfix" id="db-name">
			<li class="db-item active">
				<a href="#Mysql">Mysql</a>
			</li>
			<li class="db-item">
				<a href="#SqlServer">SqlServer</a>
			</li>
			<li class="db-item">
				<a href="#Oracle">Oracle</a>
			</li>
			<li class="db-item">
				<a href="#Access">Access</a>
			</li>
			<li class="db-item" id="db-item-last">
				<a href="#SQLite">SQLite</a>
			</li>
			
		</ul>
		<div class="db-set" id="db-set">
			<div class="db-set-item" id="Mysql">
				<table style="width:90%;padding-top:10px;" border="0" align="center" cellpadding="1" cellspacing="4">
<form name="frm_db" method="post" target="Checkframe"> 
<tr >
  <td class="default">主 机:</td>
  <td class="default"><input type="text" name="host" value="localhost" /></td>
</tr>
<tr  >
  <td class="default">端 口:</td>
  <td class="default"><input type="text" name="port" value="3306" /></td>
</tr>
<tr>
  <td class="default">数据库名称:</td>
  <td class="default"><input type="text" name="database" /></td>
</tr>
<tr>
  <td class="default">用户名:</td>
  <td class="default"><input type="text" name="username" /></td>
</tr>
<tr>
  <td class="default">密  码:</td>
  <td class="default"><input type="text" name="password" /></td>
</tr>
<tr >
  <td class="default">数据库编码:</td>
  <td class="default"><select name="charset">
  <option value="gbk">gbk</option>
  <option value="utf8">utf-8</option>
  </select></td>
</tr>
<tr >
  <td class="default">驱动:</td>
  <td class="default"><select name="driver">
  <option value="Mysql">mysql</option>
  <option value="Mysqli">mysqli</option>
  <option value="Pdo">pdo</option>
  </select></td>
</tr>

<tr >
  <td class="default">是否持久连接:</td>
  <td class="default"><select name="pconnect">
  <option value="0">否</option>
  <option value="1">是</option>
  </select></td>
</tr>



<tr>
<td style="padding-top:4px">
<input type="hidden" name="uniqueFile" id="uniqueFile" value="" />
<input type="button" name="sb" value="提交" onclick="dbSub()" class="main" disabled /></td>
<td class="default"><input type="button" name="linkchk" class="main" value="测试连接" onclick="dbChk()" /></td>
</tr>
<tr><td height="15px" colspan="2" class="default"><div name="chkinfo"></div></td>
</tr>
</form>
</table>
			</div>
			<div class="db-set-pane db-set-item" id="SqlServer">
					<table style="width:90%;padding-top:10px;" border="0" align="center" cellpadding="1" cellspacing="4">
<form name="frm_db" method="post" target="Checkframe"> 
<tr name="tr_host">
  <td class="default">主 机:</td>
  <td class="default"><input type="text" name="host" value="localhost" /></td>
</tr>
<tr  name="tr_port">
  <td class="default">端 口:</td>
  <td class="default"><input type="text" name="port" value="3310" /></td>
</tr>
<tr name="tr_database">
  <td class="default">数据库名称:</td>
  <td class="default"><input type="text" name="database" /></td>
</tr>
<tr>
  <td class="default">用户名:</td>
  <td class="default"><input type="text" name="username" /></td>
</tr>
<tr>
  <td class="default">密  码:</td>
  <td class="default"><input type="text" name="password" /></td>
</tr>
<tr>
  <td class="default">数据库编码:</td>
  <td class="default"><select name="charset">
  <option value="gbk">gbk</option>
  <!--  <option value="UCS-2">UCS-2</option>-->
  </select></td>
</tr>
<tr id="dbdriver">
  <td class="default">驱动:</td>
  <td class="default"><select name="driver">
  <option value="Mssql">Mssql</option>
  <option value="Odbc">Odbc</option>
  <option value="Pdo">pdo</option>
  </select></td>
</tr>
<tr name="need_dsn" style="display:none">
  <td class="default">配置dsn:</td>
  <td class="default"><select name="needDsn">
  <option value="0">否</option>
  <option value="1">是</option>
  </select></td>
</tr>
<tr name="tr_dsn" style="display:none">
   <td class="default">dsn名称:</td>
  <td class="default"><input type="text" name="dsn" /></td>
</tr>
<tr id="dbpconnect">
  <td class="default">是否持久连接:</td>
  <td class="default"><select name="pconnect">
  <option value="0">否</option>
  <option value="1">是</option>
  </select></td>
</tr>



<tr><td style="padding-top:4px">
<input type="hidden" name="uniqueFile" id="uniqueFile" value="" />
<input type="button" name="sb" value="提交" onclick="dbSub()" class="main" disabled /></td>
<td class="default"><input type="button" name="linkchk" class="main" value="测试连接" onclick="dbChk()" /></td>
</tr>
<tr><td height="15px" colspan=2 class="default"><div name="chkinfo"></div></td>
</tr>
</form>
</table>
			</div>
			<div class="db-set-pane db-set-item" id="Oracle">oracle</div>
			<div class="db-set-pane db-set-item" id="Access">access</div>
			<div class="db-set-pane db-set-item" id="SQLite">SQLite</div>
			
		</div>
	</div> 
<script type="text/javascript">
var cntDb = 'Mysql' ;
$('#db-name > li > a').click(function() {
	cntDb = $(this).attr('href').replace('#','') ;
	$('.active').removeClass('active') ;
	$(this).parent().addClass('active') ;
	$('.db-set-item').removeClass('current') ;
	$('.db-set-item').addClass('db-set-pane') ;
	$('#'+cntDb).addClass('current') ;
}) ;
function dbSub() {
	$("#background,#progressBar").show() ;	
	var u = $('#uniqueFile').val();
	$.ajax({ 	
		url: "dbindex.php", 
		async: false ,
		type: 'get',
		data:{"ope":"init","u":u},
		dataType: 'html', 
		success: function(data){ 
		   if (data=='succ')  {
			   window.location.href='dbindex.php?ope=go&u='+u ;
		   } else {
			   alert('初始化失败') ;
			   $("#background,#progressBar").hide() ;	
		   }
		   
		}
	});
}
$('#SqlServer,#Access').find('select[name="driver"]').on('change',function(){
	var v = $(this).find("option:selected").val() ;
	if(v=='Odbc') 
		$('#SqlServer,#Access').find('tr[name="need_dsn"]').css('display','') ;
	else {		
		$('#SqlServer,#Access').find('tr[name="need_dsn"]').css('display','none') ;
		$('#SqlServer,#Access').find('tr[name="tr_dsn"]').css('display','none') ;
	}		
});
$('#SqlServer,#Access').find('select[name="needDsn"]').on('change',function(){
	var v = $(this).find("option:selected").val() ;
	if(v==1) {
		$('#SqlServer,#Access').find('tr[name="tr_dsn"]').css('display','') ;
		$('#SqlServer,#Access').find('tr[name="tr_host"]').css('display','none') ;
		$('#SqlServer,#Access').find('tr[name="tr_port"]').css('display','none') ;
		$('#SqlServer,#Access').find('tr[name="tr_database"]').css('display','none') ;
	}
	else {		
		$('#SqlServer,#Access').find('tr[name="tr_dsn"]').css('display','none') ;
		$('#SqlServer,#Access').find('tr[name="tr_host"]').css('display','') ;
		$('#SqlServer,#Access').find('tr[name="tr_port"]').css('display','') ;
		$('#SqlServer,#Access').find('tr[name="tr_database"]').css('display','') ;
	}		
});
function dbChk() {
	var divDb = $('#'+cntDb) ;
	var host = divDb.find('input:text[name="host"]').val() ;	
	var port = divDb.find('input:text[name="port"]').val() ;
	var database = divDb.find('input:text[name="database"]').val() ;
	var username = divDb.find('input:text[name="username"]').val() ;
	var password = divDb.find('input:text[name="password"]').val() ;
	var charset = divDb.find('select[name="charset"]').find("option:selected").val();
	var driver = divDb.find('select[name="driver"]').find("option:selected").val();
	var pconnect = divDb.find('select[name="pconnect"]').find("option:selected").val();
	var needDsn = divDb.find('select[name="needDsn"]').find("option:selected").val();
	var dsn = divDb.find('input:text[name="dsn"]').val() ;
	$.ajax({ 	
		url: "dbchk.php", 
		async: false ,
		type: 'post',
		data:{"category":cntDb,"host":host,"port":port,"database":database,"username":username,"password":password,"charset":charset,"driver":driver,"pconnect":pconnect,"needDsn":needDsn,"dsn":dsn},
		dataType: 'html', 
		success: function(data){ 
			var arr = data.split('|') ;
			var result = arr[0] ;
			var info = arr[1] ;
		   if (result=='succ')  {
			   msg = '连接成功' ;
			   $('#uniqueFile').val(info) ;
			   $('input:button[name="sb"]').attr('disabled',false) ;
		   } else {
			   msg = '连接失败:'+info ;
			   $('input:button[name="sb"]').attr('disabled',true) ;
		   }
		   divDb.find('div[name="chkinfo"]').html('<font color="red">'+msg+'</font>') ;
		}
	});
}
</script>
</body>
</html>
