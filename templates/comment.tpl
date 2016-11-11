<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_manage.js"></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="comment.php?action=show" class="selected">评论列表</a></li>
</ol>

{if $show}
<form method="post" action="?action=states">
<table cellspacing="0">
	<tr><th>编号</th><th>评论内容</th><th>评论人</th><th>所属文档</th><th>状态</th><th>匹审</th><th>操作</th></tr>
	{if $CommentList}
	{foreach $CommentList(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td title="{@value->full}">{@value->content}</td>
		<td>{@value->user}</td>
		<td><a href="../details.php?id={@value->cid}" target="_blank" title="{@value->title}">查看</a></td>
		<td>{@value->state}</td>
		<td><input type="text" name="states[{@value->id}]" value="{@value->num}" class="text sort" /></td>
		<td><a href="comment.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这条评论吗？')">删除</a></td>
	</tr>
	{/foreach}
    	<tr><td></td><td></td><td></td><td></td><td></td><td><input type="submit" name="send" value="匹审" style="cursor:pointer;" /></td></tr>
	{else}
	<tr><td colspan="7">对不起，没有任何数据</td></tr>
	{/if}
</table>
</form>
<div id="page">{$page}</div>
{/if}
</body>
</html>