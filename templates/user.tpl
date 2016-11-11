<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>main</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/admin_user.js"></script>
</head>
<body id="main">

<div class="map">
	管理首页 &gt;&gt; 会员管理 &gt;&gt; <strong id="title">{$title}</strong>
</div>

<ol>
	<li><a href="user.php?action=show" class="selected">会员列表</a></li>
	<li><a href="user.php?action=add">新增会员</a></li>
	{if $update}
	<li><a href="user.php?action=update&id={$id}">修改会员</a></li>
	{/if}
</ol>

{if $show}
<table cellspacing="0">
	<tr><th>编号</th><th>用户名</th><th>email</th><th>状态</th><th>操作</th></tr>
	{if $AllUser}
	{foreach $AllUser(key,value)}
	<tr>
		<td><script type="text/javascript">document.write({@key+1}+{$num});</script></td>
		<td>{@value->user}</td>
		<td>{@value->email}</td>
        <td>{@value->state}</td>
		<td><a href="user.php?action=update&id={@value->id}">修改</a> | <a href="user.php?action=delete&id={@value->id}" onclick="return confirm('你真的要删除这个会员吗？') ? true : false">
        删除</a></td>
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="5">对不起，没有任何数据</td></tr>
	{/if}
</table>
<div id="page">{$page}</div>
{/if}


{if $add}
<form method="post" name="reg">
	<table cellspacing="0" class="user">
	    <tr><td>用 户 名：<input type="text" class="text" name="user" /> <span class="red">[必填]</span> ( *用户名在2到20位之间 )</tr></td>
		<tr><td>密　　码：<input type="password" class="text" name="pass" /> <span class="red">[必填]</span> ( *密码不得小于6位 )</tr></td>
		<tr><td>密码确认：<input type="password" class="text" name="notpass" /> <span class="red">[必填]</span> ( *密码确认和密码一致 )</tr></td>
		<tr><td>电子邮件：<input type="text" class="text" name="email" /> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</tr></td>
		<tr><td>选择头像：<select name="face" onchange="sface();">
										{foreach $OptionFaceOne(key,value)}
										<option value="0{@value}.gif">0{@value}.gif</option>
										{/foreach}
										{foreach $OptionFaceTwo(key,value)}
										<option value="{@value}.gif">{@value}.gif</option>
										{/foreach}					
									</select>
			</tr></td>
			<tr><td><img name="faceimg" src="../images/01.gif" class="face" alt="01.gif" /></tr></td>
			<tr><td>安全问题：<select name="question">
										<option value="">没有任何安全问题</option>
										<option value=" 我的爱好？"> 我的爱好？</option>
										<option value="我的梦想？">我的梦想？</option>
										<option value="我家庭的幸福指数？">我家庭的幸福指数？</option>
                                        <option value="我爱看的书？">我爱看的书？</option>

									</select>
			</tr></td>
			<tr><td>问题答案：<input type="text" class="text" name="answer" /></tr></td>
			<tr><td>设置权限：<input type="radio" name="state" value="0" />被封杀的会员
                              <input type="radio" name="state" value="1" />待审核的会员
                              <input type="radio" name="state" value="2" checked="checked" />初级会员
                              <input type="radio" name="state" value="3" />中级会员
                              <input type="radio" name="state" value="4" />高级会员
                              <input type="radio" name="state" value="5" />VIP会员
            </td></tr>
            <tr><td><input type="submit" class="submit" name="send" onclick="return checkReg();" value="注册会员" /></tr></td>
	</table>
</form>
{/if}

{if $update}
<form method="post" name="reg">
	<input type="hidden" value="{$id}" name="id" />
    <input type="hidden" value="{$pass}" name="ppass" />
	<input type="hidden" value="{$prev_url}" name="prev_url" />
	<table cellspacing="0" class="user">
	    <tr><td>用 户 名：{$user}</tr></td>
		<tr><td>密　　码：<input type="password" class="text" name="pass" />  ( *留空则不修改 )</tr></td>
		<tr><td>电子邮件：<input type="text" class="text" name="email" value="{$email}"/> <span class="red">[必填]</span> ( *每个电子邮件只能注册一个ID )</tr></td>
		<tr><td>选择头像：<select name="face" onchange="sface();">
										{$face}
									</select>
			</tr></td>
			<tr><td><img name="faceimg" src="../images/{$facesrc}" class="face" alt="01.gif" /></tr></td>
			<tr><td>安全问题：<select name="question">
										{$question}
									</select>
			</tr></td>
			<tr><td>问题答案：<input type="text" class="text" name="answer" value="{$answer}"/></tr></td>
			<tr><td>设置权限：{$state}
            </td></tr>
            <tr><td><input type="submit" class="submit" name="send" onclick="return checkUpdate();" value="修改会员" /> [<a href="{$prev_url}">返回上级</a>]</tr></td>
	</table>
</form>
{/if}



</body>
</html>