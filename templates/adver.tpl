<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_adver.js"></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 内容管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="adver.php?action=show" class="selected">广告图列表</a></li>
	<li><a href="adver.php?action=add">新增广告图</a></li>
	{if $update}
	<li><a href="adver.php?action=update&id={$id}">修改广告图</a></li>
	{/if}
</ol>

{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>广告标题</th><th>链接</th><th>类型</th><th>是否前台广告</th><th>操作</th></tr>
	{if $AllAdver}
	{foreach $AllAdver(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->title}</td>
		<td>{@value->link}</td>
        <td>{@value->type}</td>
        <td>{@value->state}</td>
		<td><a href="adver.php?action=update&id={@value->id}">查看并修改</a> | <a href="adver.php?action=delete&id={@value->id}" onclick="return 
        confirm('你真的要删除这个轮播吗？') ? true : false">删除</a></td>
	</tr>
	{/foreach}
    <tr><td colspan="6" style="color:green;">(任何广告服务的操作，都必须生成js文件放开在前台更新)</td></tr>
    <tr><td colspan="6">
        <input type="button" value="生成文字广告js" onclick="javascript:location.href='?action=text'" />
        <input type="button" value="生成头部广告js" onclick="javascript:location.href='?action=header'"/>
        <input type="button" value="生成侧栏广告js" onclick="javascript:location.href='?action=sidebar'"/>
    
    </td></tr>
    
	{else}
	<tr><td colspan="6">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $add}
<form method="post" name="content">
    <input type="hidden" name="adv" />
	<table cellspacing="0" class="left">
        <tr><td>广告栏：<input type="radio" name="type" onclick="adver(1)" value="1" checked="checked" />文字广告
                          <input type="radio" name="type" onclick="adver(2)" value="2" />头部广告（690x80）
                          <input type="radio" name="type" onclick="adver(3)" value="3" />侧栏广告（270x200）
            </td></tr>
		<tr><td>广告标题：<input type="text" name="title" class="text" /> (* 广告标题名称不得小于两位，不得大于20位！)</td></tr>
        <tr><td>广告链接：<input type="text" name="link" class="text" /> (* 广告链接名称不得为空)</td></tr>
        <tr id="thumbnail" style="display:none;"><td>广告图片：<input type="text" name="thumbnail" class="text" readonly="readonly" /> 
								<span id="up"></span>
	   							<img name="pic" style="display:none;" /> ( * 必须是jpg,gif,png，并且200k内)
	    </td></tr>
		<tr><td><textarea name="info"></textarea> (* 描述不得大于200位！)</td></tr>
		<tr><td><input type="submit" name="send" value="新增广告图" onclick="return checkAdver();" class="submit level" /> [ <a href="{$prev_url}">返
        回列表</a> ]</td></tr>
	</table>
</form>
{/if}

{if $update}
<form method="post" name="content">
	<input type="hidden" name="id" value="{$id}" />
	<input type="hidden" name="prev_url" value="{$prev_url}" />
	<input type="hidden" name="adv" />
	<table cellspacing="0" class="left">
		<tr><td>广告类型：<input type="radio" name="type" onclick="adver(1)" value="1" {$type1} /> 文字广告
									<input type="radio" name="type" onclick="adver(2)" value="2" {$type2} /> 头部广告690x80
									<input type="radio" name="type" onclick="adver(3)" value="3" {$type3} /> 侧栏广告270x200
		</td></tr>
		<tr><td>广告标题：<input type="text" name="title" value="{$titlec}" class="text" /> (* 广告标题不得小于两位，不得大于20位！)</td></tr>
		<tr><td>广告链接：<input type="text" name="link" value="{$link}" class="text" /> (* 广告链接不得为空！)</td></tr>
		<tr id="thumbnail" {$pic}><td>广告图片：<input type="text" name="thumbnail" value="{$thumbnail}" class="text" readonly="readonly" /> 
									<span id="up">{$up}</span>
									<img name="pic" src="{$thumbnail}" style="display:block;" /> ( * 必须是jpg,gif,png，并且200k内)
		</td></tr>
		<tr><td><textarea name="info">{$info}</textarea> (* 描述不得大于200位！)</td></tr>
		<tr><td>是否生成：<input type="radio" name="state" value="1" {$left_state} /> 是
									<input type="radio" name="state" value="0" {$right_state} /> 否  </td></tr>
		<tr><td><input type="submit" name="send" value="修改广告" onclick="return checkAdver();" class="submit level" /> [ <a href="{$prev_url}">返回
        列表</a> ]</td></tr>
	</table>
</form>
{/if}



</body>
</html>