<?php
require_once 'init.php';
$dbUnique = $_GET['u'] ;
$dbConfig = getConfigByUnique($dbUnique) ;
importClass('DB_Factory') ;
$dbFac = new DB_Factory($dbConfig) ;
$bakDir = 'e:/0501/';
$dbRecover = $dbFac->getRecover($bakDir) ;
$allBakTables = $dbRecover->getBakTables()  ;
if ($_GET['tables'])  {
	$recover = explode('|', $_GET['tables']) ;
	$dbRecover->recoverPartsTables($recover) ;
	exit('ok');
}

//V($allBakTables);
//$recover = array('user_report') ;
//$dbRecover->recoverPartsTables($recover) ;
//exit;
//$result = $dbRecover->recoverAllFiles()  ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo URL;?>"  />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_HERO['charset']?>" />
<script  language="JavaScript" src="static/js/jquery-1.7.2.min.js"></script>
<script  language="JavaScript" src="static/plu/artDialog/artDialog.min.js"></script>
<link rel="stylesheet" href="static/css/default.css" type="text/css" />
<link rel="stylesheet" href="static/plu/artDialog/green.css" type="text/css" />
<title><?php echo $_lang['dbSet']?></title>

</head>

<body style="margin-top:8px;margin-left:8px">	
<form name="frm" method="post" action="?">
<table class="mainNavTable" align="center" cellspacing="1" cellpadding="0">
<tbody><tr>
 <td class="mainNavTd" >
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
  <td  style="padding-left:10px;">
  ◆ 操作&gt;数据库还原 &nbsp;</td><td align="right"> </td>
 </tr>
</tbody></table>
</td>
</tr>
</tbody></table>

<table  width="98%" border="0" cellpadding="0" cellspacing="0"  align="center" style="margin-top:8px">
<tr  align="center" height="25"><td colspan="10"  style="padding-bottom:0px;text-align:left;">
<div class="optionTab">
<ul><li class="optionTab_li optionTab_selected" id="tab1" src="dbbak.php?u=<?php echo $dbUnique;?>">备份</li>
<li class="optionTab_li optionTab_unSelected" id="tab2" src="dbbak.php?u=<?php echo $dbUnique;?>">还原</li>
</ul></div>
</td></tr></table>


<table id="tableList" class="recordTable" align="center"  cellspacing="1" cellpadding="0">
<tbody><tr bgcolor="#eef8e7" align="center">
	<td width="6%"  height="25"><div style="position:relative;width:100%;height:100%"><span class="dropdown"><input type="checkbox" id="selectAll" name="selectAll" /></span><span class="dropSpan"  onmouseover="mopen('divMenu1')" onmouseout="mclosetime()"><b class="dropArrow"></b>
			<div id="divMenu1" class="dropMenu" >
		<a href="JavaScript:checkAll('all');">全选</a>
		<a href="JavaScript:checkAll('no');">不选</a>
		<a href="JavaScript:checkAll('other');">反选</a>
		</div>
	</span></div></td>
	<td width="84%" align="left" style="padding-left:10px">表名</td>
	<td width="10%" align="left" style="padding-left:10px">记录数</td>
</tr>
<?php $i=1;foreach ($allBakTables as $table) :?>
<tr class="recordTableTr" align="center">
<td><input type="checkbox" value="<?php echo trim($table['tableName']);?>" name="chkbox" /><?php echo str_pad($i, 2, "0", STR_PAD_LEFT) ;?></td>
<td align="left" style="padding-left:10px"><?php echo $table['tableName'];?></td>
<td align="left"  style="padding-left:10px"><?php echo $table['rows'];?></td>
</tr>
<?php $i++;endforeach;?>

</tbody></table>


<table width="98%" border="0" bgcolor="#CFCFCF" align="center" cellspacing="1" cellpadding="0" style="margin-top:8px">
<tbody><tr bgcolor="#ffffff">
<td height="36">
<span style="padding-left:50px"><input type="button" value="提 交" id="btnSub" /></span>
<input type="hidden" name="dbUnique" value="<?php echo $dbUnique;?>" id="dbUnique" />
</td>
</tr></tbody></table>
</form>
<script type="text/javascript">
$('.optionTab_li').click(function() {
	window.location.href=$(this).attr('src') ;
}) ;
$('#btnSub').click(function() {
	
	var selected = '' ;
	$('input[type="checkbox"][name="chkbox"]').each(function() {
		if($(this).attr('checked')){
			selected += $(this).val()+'|' ;					
		}
	}); 
	if (!selected) {
		//art.dialog({content:'请先选择要备份的表',width:260,height:150});
		art.dialog({title:'提示',content:'请先选择要还原的表',lock:true});
		return false ;
	}
	var addHtml  = '<div style="height:100px;overflow-y:scroll" id="bakContent"><ul><li style="width:200px"><input type="button" name="beginRecover" id="beginRecover" value="开始还原" onclick="beginRecover();" /></li></ul>' ;
	addHtml += '</div>' ;
	art.dialog({title:'数据还原',content:addHtml,lock:true}); //chrome,ff下执行完了才弹出层
	
	
});

function beginRecover() {
	$('#beginRecover').attr('disabled',true) ;
	var u = $('#dbUnique').val() ;
	var selected = '' ;
	$('input[type="checkbox"][name="chkbox"]').each(function() {
		if($(this).attr('checked')){
			selected += $(this).val()+'|' ;		
			$('#bakContent').append('<ul><li style="width:200px">还原表:'+$(this).val()+'</li></ul>') ;
			$('#bakContent').scrollTop($('#bakContent').height());	
			var result=goRecover(u,$(this).val()) ;	
			if (result!="ok") {
				$('#bakContent').append('<ul><li style="width:200px">还原失败!</li></ul>') ;
				return ; //会go on
			}
		}
	}); 
	$('#bakContent').append('<ul><li style="width:200px">还原完毕!</li></ul>') ;
	$('#bakContent').scrollTop($('#bakContent').height());
	
	return false ; 
}

function goRecover(u,tables) {
	var result = '';
	$.ajax({ 	
		url: "dbrecover.php", 
		async: false ,
		type: 'get',
		data:{"u":u,'tables':tables},
		dataType: 'html', 
		success: function(data){ 
		   result =  data ;
		   
		}
	});
	return result ;
}

$(document).ready(function() {
	$(".recordTableTr").hover(
			
		function () {
			$(this).addClass("trbgcolor");
		},
		function () {
			$(this).removeClass("trbgcolor");
		}
	);

	$('#selectAll').click(function() {
		
		if ($(this).prop('checked'))
		  checkAll('all') ;
		else 
			checkAll('no');
	}); 
	
	$('input[type="checkbox"][name="chkbox"]').click(function() {
				if($(this).attr('checked')){
					$(this).parent().parent().addClass("trselectedbgcolor");					
				} else {						
					$(this).parent().parent().removeClass("trselectedbgcolor");
				}
		
	}); 
	
}); 
function checkAll(type) {
	if (type=='all') {
		$('#selectAll').prop("checked",true);	
		$('input[type="checkbox"][name="chkbox"]').each(
				function() {
					$(this).prop("checked",true);	
					$(this).parent().parent().addClass("trselectedbgcolor");
				}
		) ;
	} else if (type=='no'){
		$('#selectAll').prop("checked",false);
		$('input[type="checkbox"][name="chkbox"]').each(
				function() {
					$(this).prop("checked",false);	
					$(this).parent().parent().removeClass("trselectedbgcolor");
				}
		) ;
	} else {
		$('input[type="checkbox"][name="chkbox"]').each(
				function() {
					if($(this).prop('checked')){
						$(this).prop("checked",false);
						$(this).parent().parent().removeClass("trselectedbgcolor");
					} else {
						$(this).prop("checked",true);					
						$(this).parent().parent().addClass("trselectedbgcolor");
					}
				}
			);
	}
}

<!--
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 
// -->
</script>
</body>
</html>

	