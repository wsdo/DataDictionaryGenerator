<?php
require_once 'init.php';
$dbUnique = $_GET['u'];
$dict = getDictByConfig($dbUnique) ;
ob_start() ;
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 12">
<meta name=Originator content="Microsoft Word 12">
<style>

table.MsoNormalTable
{
	border:0;
	margin:0;
	padding:0;
	border-collapse:collapse;
	mso-padding-alt:0cm 0cm 0cm 0cm;
	mso-style-name:普通表格;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";}
p.tabletext, li.tabletext, div.tabletext
	{mso-style-name:tabletext;
	mso-style-unhide:no;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:6.0pt;
	margin-left:0cm;
	line-height:12.0pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;	
	font-family:"Times New Roman","serif";
	mso-fareast-font-family:宋体;}
table.MsoNormalTable tr td {border:solid windowtext 1.0pt;
  		mso-border-alt:solid windowtext .75pt;padding:5pt 5.4pt 0cm 5.4pt}
.tcenter {text-align:center;font-weight:bold;/*word中不起作用,需用b标签替代*/}
  
 p.MsoNormal
	{margin:0cm;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:宋体;}
h1
	{mso-style-link:"标题 1 Char";
	margin-right:0cm;
	margin-left:0cm;
	font-size:24.0pt;
	font-family:宋体;
	font-weight:bold;
	margin-left:72.0pt;
	text-align:center;
	text-indent:-72.0pt;
	}

p.MsoPlainText, li.MsoPlainText, div.MsoPlainText
	{mso-style-link:"纯文本 Char";
	margin:0cm;
	margin-bottom:.0001pt;
	text-align:justify;
	text-justify:inter-ideograph;
	font-size:10.5pt;
	font-family:宋体;
	line-height:123%;
	text-indent:17.75pt;
	}

h2{
mso-style-link:"标题 2 Char";
	margin-right:0cm;
	margin-left:0cm;
	font-size:18.0pt;
	font-family:黑体;
	font-weight:normal;
 margin-top:13.0pt;
 margin-right:0cm;
 margin-bottom:5.0pt;
 margin-left:35.45pt;
 text-align:justify;
 text-justify:inter-ideograph;
 text-indent:-1.0cm;
line-height:123%'
}
.pageSpan{
font-size:16.0pt;font-family:宋体;mso-bidi-font-family:
宋体;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;mso-bidi-language:AR-SA';
}
.pageSpan br{
	mso-special-character:line-break;page-break-before:always;
}
</style>
</head>
<body style='tab-interval:21.0pt;text-justify-trim:punctuation'>
<a id="genWord" href="dbmain.php?u=<?php echo $dbUnique;?>&gen=1" >生成word</a>
<!-- first page -->
<!--begin info -->
<p align=center style='text-align:center;line-height:500%'><b style='mso-bidi-font-weight:normal'><span
style='font-size:16.0pt'>数据字典<span lang=EN-US><o:p></o:p></span></span></b></p>

<p align=center style='text-align:right;line-height:500%'><b style='mso-bidi-font-weight:normal'><span
style='font-size:16.0pt'>www.easy4php.com<span lang=EN-US><o:p></o:p></span></span></b></p>
<p align=center style='text-align:right;line-height:500%'><b style='mso-bidi-font-weight:normal'><span
style='font-size:16.0pt'><?php echo date('y/m/d');?><span lang=EN-US><o:p></o:p></span></span></b></p>
<span lang=EN-US class="pageSpan"><br clear=all></span>

<!--end info -->

<div>
<p align=center style='text-align:center'>修订历史记录</p>
<table class=MsoNormalTable>
 <tr>
  <td width=141>
  <p class="tabletext tcenter" align="center"><b>日期</b></p>
  </td>
  <td width=71>
  <p class="tabletext tcenter" align="center"><b>版本</b></p>
  </td>
   <td width=154>
  <p class="tabletext tcenter" align="center"><b>说明</b></p>
  </td>
   <td width=65>
  <p class="tabletext tcenter" align="center"><b>作者</b></p>
  </td>
   <td width=137>
  <p class="tabletext tcenter" align="center"><b>评审者</b></p>
  </td>
  </tr>
  
 <tr style='mso-yfti-irow:1'>
  <td width=141>
  <p class="tabletext"><?php echo date('Y/m/d');?></p>
  </td>
  <td width=71>
  <p class="tabletext">1.0</p>
  </td>
   <td width=154>
  <p class="tabletext">建立文档</p>
  </td>
   <td width=65>
  <p class="tabletext">easy4php</p>
  </td>
   <td width=137>
  <p class="tabletext">无</p>
  </td>
 </tr>
 </table>
 

</div>
 <span lang=EN-US class="pageSpan"><br clear=all></span>
 <!-- second page -->

 
<div>
<h1 align=center><span style='font-size:16.0pt'>一. 表结构</span></h1>
<!-- begin table list -->
<?php foreach ($dict->tablesList as $table):
$i++
?>

<h2><a name="table_<?php echo $table->tableName;?>"></a>1.<?php echo $i;?> <span style="font-family:黑体;color:#984806;mso-themecolor:accent6;mso-themeshade:128;
font-weight:normal"><?php echo $table->tableName.'('.$table->tableDesc.')';?></span></h2>

<table class=MsoNormalTable>
  <tr class="filedFirst">
  <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>字段</b></p>
  </td>
  <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>类型</b></p>
  </td>
   <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>NUll</b></p>
  </td>
   <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>默认</b></p>
  </td>
   <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>主键</b></p>
  </td>
  <td width=95>
  <p class="tabletext" align="center" style="color:#5F497A"><b>说明</b></p>
  </td>
 </tr>
  <?php foreach ($table->fieldsList as $field):?>
 <tr>
  <td width=95>
  <p class="tabletext"><?php echo $field->fieldName;?></p>
  </td>
  <td width=95>
  <p class="tabletext"><?php echo $field->fieldType;?></p>
  </td>
   <td width=95>
  <p class="tabletext"><?php echo $field->fieldIsNull;?></p>
  </td>
   <td width=95>
  <p class="tabletext"><?php echo $field->fieldDefault;?></p>
  </td>
   <td width=95>
  <p class="tabletext"><?php echo $field->fieldPrimary;?></p>
  </td>
  <td width=95>
  <p class="tabletext"><?php echo $field->fieldDesc;?></p>
  </td>
 </tr>
  <?php endforeach;?>
 </table>
 <?php endforeach;?>
 <!-- end table list -->
 
</div>
 <span lang=EN-US class="pageSpan"><br clear=all></span>


<div name="guifan">
<h1 align=center ><span style='font-size:16.0pt'>二. 命名规范</span></h1>

<h2>2.1 库</h2>
<p class=MsoPlainText>1)全部大写,多个单词用"_"隔开；；</p>

<h2>2.2 表</h2>
<p class=MsoPlainText>1)全部小写,多个单词用"_"隔开；</p>

<h2>2.3 字段</h2>
<p class=MsoPlainText>1)全部小写,多个单词用"_"隔开; </p>
<p class=MsoPlainText>2)主键统一用"id"表示;</p>
<p class=MsoPlainText>2)外键用"表名"+"_id", 如user_id;</p>
<p class=MsoPlainText>3)时间用时间戳保存类型int(11),命名"含义"+"_time",如add_time,login_time;</p>
<p class=MsoPlainText>4)布尔型用tinynint(1),命名"is_"+"_含义", 如is_delete,1表示是,0表示否</p>
</div>

<div name="guifan">
<h1 align=center ><span style='font-size:16.0pt'>三. 数据库优化</span></h1>

<h2>2.1 库</h2>
<p class=MsoPlainText>1)全部大写,多个单词用"_"隔开；；</p>

<h2>2.2 表</h2>
<p class=MsoPlainText>1)全部小写,多个单词用"_"隔开；</p>

<h2>2.3 字段</h2>
<p class=MsoPlainText>1)全部小写,多个单词用"_"隔开; </p>
<p class=MsoPlainText>2)主键统一用"id"表示;</p>
<p class=MsoPlainText>2)外键用"表名"+"_id", 如user_id;</p>
<p class=MsoPlainText>3)时间用时间戳保存类型int(11),命名"含义"+"_time",如add_time,login_time;</p>
<p class=MsoPlainText>4)布尔型用tinynint(1),命名"is_"+"_含义", 如is_delete,1表示是,0表示否</p>
</div>


</body>
</html>
<?php 
$word = ob_get_contents();
ob_end_clean();
if($_GET['gen']) {
	//importClass('File') ;
	//$doc = TMP.'dd.doc' ;
	//File::writeFile($doc, $word,'w');	
	header( "Content-Type: application/vnd.ms-word; name='word'" );
	header( "Content-type: application/octet-stream" );
	header( "Content-Disposition: attachment; filename=dd.doc" );
	header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
	header( "Pragma: no-cache" );
	header( "Expires: 0" );
    $word = preg_replace('~<a id="genWord".*</a>~isU', '', $word) ;
} else {
	$word = preg_replace('~<!--begin info -->.*<!--end info -->~isU', '', $word) ;
}
echo $word;
?>
