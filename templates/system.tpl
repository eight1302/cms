<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 系统配置文件&gt;&gt;<strong class="title">系统配置信息</strong>
</div>

<form method="post">
<table cellspacing="0">
	<tr><th style="text-align: center;"><strong>系统配置信息</strong></th></tr>
    <tr><td>网 站 名 称 ：<input type="text" class="text" name="webname" value="{$webname}" /></td></tr>
    <tr><td>常 规 分 页 ：<input type="text" class="text" name="page_size" value="{$page_size}" /></td></tr>
    <tr><td>文 档 分 页 ：<input type="text" class="text" name="article_size" value="{$article_size}" /></td></tr>
    <tr><td>导 航 个 数 ：<input type="text" class="text" name="nav_size" value="{$nav_size}" /></td></tr>
    <tr><td>图片上传目录：<input type="text" class="text" name="updir" value="{$updir}" /></td></tr>
    <tr><td>轮播器个 数 ：<input type="text" class="text" name="ro_time" value="{$ro_time}" /></td></tr>
    <tr><td>轮播器速 度 ：<input type="text" class="text" name="ro_num" value="{$ro_num}" /></td></tr>
    <tr><td>文 字 广 告 ：<input type="text" class="text" name="adver_text_num" value="{$adver_text_num}" /></td></tr>
    <tr><td>图 片 广 告 ：<input type="text" class="text" name="adver_pic_num" value="{$adver_pic_num}" /></td></tr>
</table>
    <p style="margin:20px;text-align: center;"><input type="submit" name="send"value="修改配置文件" /></p>
</form>







</body>
</html>