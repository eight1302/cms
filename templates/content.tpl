<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_content.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
</head>
<body id="main">


<div class="map">
	内容管理 &gt;&gt; 查看文档列表 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="content.php?action=show" class="selected">文档列表</a></li>
	<li><a href="content.php?action=add">新增文档</a></li>
	{if $update}
	<li><a href="content.php?action=update&id={$id}">修改文档</a></li>
	{/if}
</ol>


{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>标题</th><th>属性</th><th>文档类别</th><th>浏览次数</th><th>发布时间</th><th>操作</th></tr>
	{if $SearchContent}
	{foreach $SearchContent(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td><a href="../details.php?id={@value->id}" title="{@value->t}" target="_blank">{@value->title}</a></td>
		<td>{@value->attr}</td>
		<td><a href="?action=show&nav={@value->nav}">{@value->nav_name}</a></td>
		<td>{@value->count}</td>
		<td>{@value->date}</td>
		<td><a href="content.php?action=update&id={@value->id}">修改</a> | <a href="content.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个文档吗？') ? true : 
        false">删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="7">对不起，没有任何数据</td></tr>
	{/if}
</table>
<form action="?" method="get">
<div id="page">
		{$page}
		<input type="hidden" name="action" value="show" />
		<select name="nav" class="select">
			<option value="0">默认全部</option>
			{$nav}
		</select>
		<input value="查询" type="submit" />
</div>
</form>
{/if}

{if $add}
<form name="content" method="post" action="?action=add">
<table cellspacing="0" class="content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" name="title" class="text" /> <span class="red">[必填]</span> ( * 标题2-50字符之间)</td></tr>
	<tr><td>栏　　目：<select name="nav"><option value="" style="padding:0;">请选择一个栏目类别</option>{$nav}</select> <span class="red">[必选]</span></td></tr>
	<tr><td>定义属性：<input type="checkbox" name="attr[]" value="头条" />头条
								<input type="checkbox" name="attr[]" value="推荐" />推荐
								<input type="checkbox" name="attr[]" value="加粗" />加粗
								<input type="checkbox" name="attr[]" value="跳转" />跳转
	</td></tr>
	<tr><td>标　　签：<input type="text" name="tag" class="text" /> ( * 每个标签用','隔开，总长30位之内)</td></tr>
	<tr><td>关 键 字：<input type="text" name="keyword" class="text" /> ( * 每个关键字用','隔开，总长30位之内)</td></tr>
	<tr><td>缩 略 图：<input type="text" name="thumbnail" class="text" readonly="readonly" /> 
								<input type="button" value="上传缩略图" onclick="centerWindow('../config/upfile.php?type=content','upfile','500','200')" />
								<img name="pic" style="display:none;" /> ( * 必须是jpg,gif,png，并且200k内)
	</td></tr>
	<tr><td>文章来源：<input type="text" name="source" class="text" /> ( * 文章来源20位之内)</td></tr>
	<tr><td>作　　者：<input type="text" value="{$author}" name="author" class="text" /> ( * 作者10位之内)</td></tr>
	<tr><td><span class="middle">内容摘要：</span><textarea name="info"></textarea> <span class="middle">( * 内容摘要200之内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor"></textarea></td></tr>
	<tr><td>评论选项：<input type="radio" name="commend" value="1" checked="checked" />允许评论 
								<input type="radio" name="commend" value="0" />禁止评论 
					　　　　浏览次数：<input type="text" name="count" value="100" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
									<option value="0">默认排序</option>
									<option value="1">置顶一天</option>
									<option value="2">置顶一周</option>
									<option value="3">置顶一月</option>
									<option value="4">置顶一年</option>
								</select>
					 　 　　消费金币：<input type="text" name="gold" value="0" class="text small" />
	</td></tr>
	<tr><td>阅读权限：<select name="readlimit">
									<option value="0">开放浏览</option>
									<option value="1">初级会员</option>
									<option value="2">中级会员</option>
									<option value="3">高级会员</option>
									<option value="4">VIP会员</option>
								</select>
					 　 　　标题颜色：<select name="color">
									<option value="">默认颜色</option>
									<option value="red" style="color:red;">红色</option>
									<option value="blue" style="color:blue;">蓝色</option>
									<option value="orange" style="color:orange;">橙色</option>
								</select>
	</td></tr>
	<tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="发布文档" /> <input type="reset" value="重置" /></td></tr>
	<tr><td></td></tr>
</table>
</form>
{/if}


{if $update}
<form name="content" method="post" action="?action=update">
<input type="hidden" name="id" value="{$id}" />
<input type="hidden" name="prev_url" value="{$prev_url}" />
<table cellspacing="0" class="content">
	<tr><th><strong>发布一条新文档</strong></th></tr>
	<tr><td>文档标题：<input type="text" name="title" value="{$titlec}" class="text" /> <span class="red">[必填]</span> ( * 标题2-50字符之间)</td></tr>
	<tr><td>栏　　目：<select name="nav"><option value="" style="padding:0;">请选择一个栏目类别</option>{$nav}</select> <span class="red">[必选]</span></td></tr>
	<tr><td>定义属性：{$attr}
	</td></tr>
	<tr><td>标　　签：<input type="text" name="tag" value="{$tag}" class="text" /> ( * 每个标签用','隔开，总长30位之内)</td></tr>
	<tr><td>关 键 字：<input type="text" name="keyword" value="{$keyword}"  class="text" /> ( * 每个关键字用','隔开，总长30位之内)</td></tr>
	<tr><td>缩 略 图：<input type="text" name="thumbnail"  value="{$thumbnail}"  class="text" readonly="readonly" /> 
								<input type="button" value="上传缩略图" onclick="centerWindow('../templates/upfile.html','upfile','400','100')" />
								<img name="pic" src="{$thumbnail}" style="display:block;" /> ( * 必须是jpg,gif,png，并且200k内)
	</td></tr>
	<tr><td>文章来源：<input type="text" name="source" value="{$source}" class="text" /> ( * 文章来源20位之内)</td></tr>
	<tr><td>作　　者：<input type="text" value="{$author}" name="author" class="text" /> ( * 作者10位之内)</td></tr>
	<tr><td><span class="middle">内容摘要：</span><textarea name="info">{$info}</textarea> <span class="middle">( * 内容摘要200之内)</span></td></tr>
	<tr class="ckeditor"><td><textarea id="TextArea1" name="content" class="ckeditor">{$content}</textarea></td></tr>
	<tr><td>评论选项：{$commend}
					　　　 　浏览次数：<input type="text" name="count" value="{$count}" class="text small" />
	</td></tr>
	<tr><td>文档排序：<select name="sort">
									{$sort}
								</select>
					 　 　　消费金币：<input type="text" name="gold" value="{$gold}" class="text small" />
	</td></tr>
	<tr><td>阅读权限：<select name="readlimit">
									{$readlimit}
								</select>
					 　 　　标题颜色：<select name="color">
										{$color}
								</select>
	</td></tr>
	<tr><td><input type="submit" name="send" onclick="return checkAddContent();" value="修改文档" /> <input type="reset" value="重置" /></td></tr>
	<tr><td></td></tr>
</table>
</form>
{/if}


</body>
</html>