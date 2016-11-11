<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_link.js"></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="link.php?action=show" class="selected">友情链接列表</a></li>
	<li><a href="link.php?action=add">新增友情链接</a></li>
	{if $update}
	<li><a href="link.php?action=update&id={$id}">修改友情链接</a></li>
	{/if}
</ol>

{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>网站名称</th><th>网站链接地址</th><th>LOGO链接地址</th><th>站长名称</th><th>类型</th><th>状态</th><th>操作</th></tr>
	{if $AllLink}
	{foreach $AllLink(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->webname}</td>
		<td title="{@value->fullweburl}">{@value->weburl}</td>
        <td title="{@value->fulllogourl}">{@value->logourl}</td>
        <td>{@value->user}</td>
        <td>{@value->type}</td>
        <td>{@value->state}</td>
		<td><a href="link.php?action=update&id={@value->id}">修改</a> | <a href="link.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个友情链接吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="8">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $add}
<form method="post" name="friendlink">
	<table cellspacing="0" class="left">
        <input type="hidden" value="1" name="state"/>
		<tr><td>网站类型：<input type="radio" name="type" onclick="link(1)" value="1" checked="checked" />文字链接
                        <input type="radio" name="type" onclick="link(2)" value="2" />logo链接</td></tr>
		<tr><td>网站名称：<input type="text" class="text" name="webname" /> <span class="red">[必填]</span> ( *网站名称不得为空20位之间 )</td></tr>
        <tr><td>网址地址：<input type="text" class="text" name="weburl" /> <span class="red">[必填]</span> ( *网站地址不得为空不大于100位 )</td></tr>
        <tr><td id="logo" style="display: none">LOGO地址：<input type="text" class="text" name="logourl" /> <span class="red">[必填]</span> ( *logo地址不得为空不大于100位 )</td></tr>
        <tr><td>站长名字：<input type="text" class="text" name="user" /></td></tr>
        <tr><td><input type="submit" class="submit" name="send" onclick="return checkUrl();" value="申请友情链接" /></td></tr>

	</table>
</form>
{/if}

{if $update}
<form method="post" name="add">
    <input type="hidden" value="{$id}" name="id" />
    <input type="hidden" value="{$prev_url}" name="prev_url" />
    <input type="hidden" value="{$state}" name="state" />
    <table cellspacing="0" class="left">
    <tr><td>网站类型：<input type="radio" name="type" {$text_type} onclick="link(1)" value="1"  /> 文字链接
    <input type="radio" name="type" {$logo_type} onclick="link(2)" value="2" /> Logo链接</td></tr>
        <tr><td>网站名称：<input type="text" value="{$webname}" class="text" name="webname" /> <span class="red">[必填]</span> ( * 网站名称不能为空，不大于20位 )</td></tr>
        <tr><td>网站地址：<input type="text" value="{$weburl}"  class="text" name="weburl" /> <span class="red">[必填]</span> ( *  网站地址不能为空，不大于100位 )</td></tr>
        <tr id="logo" style="{$logo}"><td>Logo地址：<input type="text" value="{$logourl}"  class="text" name="logourl" /> <span class="red">[必填]</span> ( * Logo地址不能为空，不大于100位 )</td></tr>
        <tr><td>站 长 名：<input type="text" class="text" name="user" value="{$user}"  /></td></tr>
        <tr><td><input type="submit" name="send" value="修改友情链接" onclick="return checkLink();" class="submit level" /> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
    </table>
</form>
{/if}



</body>
</html>