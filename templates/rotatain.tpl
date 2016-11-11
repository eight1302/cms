<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_rotatain.js"></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="rotatain.php?action=show" class="selected">轮播器列表</a></li>
	<li><a href="rotatain.php?action=add">新增轮播器</a></li>
	{if $update}
	<li><a href="rotatain.php?action=update&id={$id}">修改轮播器</a></li>
	{/if}
</ol>

{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>标题</th><th>链接</th><th>是否首页轮播</th><th>操作</th></tr>
	{if $AllRotatain}
	{foreach $AllRotatain(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td><a href="{@value->full}" target="_blank">{@value->title}</a></td>
		<td>{@value->link}</td>
		<td>{@value->state}</td>
		<td><a href="rotatain.php?action=update&id={@value->id}">查看并修改</a> | <a href="rotatain.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个轮播吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
	<tr><td colspan="5" style="color:blue;">( * 每当任何轮播器的操作或变动，都必须点击[生成xml文件]，来更新首页轮播器 )</td></tr>
	<tr><td colspan="5"><input type="button" value="生成xml文件" onclick="javascript:location.href='?action=xml'" /></td></tr>
	{else}
	<tr><td colspan="5">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $add}
<form method="post" name="content">
	<table cellspacing="0" class="left">
		<tr><td>轮 播 图：<input type="text" name="thumbnail" readonly="readonly" class="text" />
								<input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','400','100')" />
								<img name="pic" style="display:none;" /> ( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)</td></tr>
		<tr><td>链　　接：<input type="text" name="link" class="text" /> (* 不得为空，站内站外连接均可)</td></tr>
		<tr><td>标　　题：<input type="text" name="title" class="text" /> (* 不得大于20位！)</td></tr>
		<tr><td><textarea name="info"></textarea> (* 描述不得大于200位！)</td></tr>
		<tr><td><input type="submit" name="send" value="新增轮播图" onclick="return checkAddRotatain();" class="submit level" /> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
	</table>
</form>
{/if}

{if $update}
<form method="post" name="content">
	<input type="hidden" value="{$id}" name="id" />
	<input type="hidden" value="{$prev_url}" name="prev_url" />
	<table cellspacing="0" class="left">
		<tr><td>轮 播 图：<input type="text" value="{$thumbnail}" name="thumbnail" readonly="readonly" class="text" />
								<input type="button" value="上传轮播图" onclick="centerWindow('../config/upfile.php?type=rotatain','upfile','400','100')" />
								<img name="pic" src="{$thumbnail}" style="display:block;" /> ( * 最佳大小是268X193或以上，必须是jpg,gif,png，并且200k内)</td></tr>
		<tr><td>链　　接：<input type="text" value="{$link}" name="link" class="text" /> (* 不得为空，站内站外连接均可)</td></tr>
		<tr><td>标　　题：<input type="text" value="{$titlec}" name="title" class="text" /> (* 不得大于20位！)</td></tr>
		<tr><td><textarea name="info">{$info}</textarea> (* 描述不得大于200位！)</td></tr>
		<tr><td>是否轮播：<input type="radio" {$left_state} name="state" value="1" /> 是 <input type="radio" {$right_state} name="state" value="0" /> 否</td></tr>
		<tr><td><input type="submit" name="send" value="修改轮播图" onclick="return checkAddRotatain();" class="submit level" /> [ <a href="{$prev_url}">返回列表</a> ]</td></tr>
	</table>
</form>
{/if}



</body>
</html>