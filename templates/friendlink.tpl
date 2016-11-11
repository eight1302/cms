<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/friend.css" />
<script type="text/javascript" src="js/link.js"></script>
</head>
<body>
{include file='header.tpl'}
{if $frontadd}
<div id="friendlink">
<h2>申请加入链接</h2>
    <form method="post" name="friendlink">
        <input type="hidden" value="0" name="state" />
        <dl>
            <dd>网站类型：<input type="radio" name="type" onclick="link(1)" value="1" checked="checked" />文字链接
                网站类型：<input type="radio" name="type" onclick="link(2)" value="2" />logo链接
            </dd>
            <dd>网站名称：<input type="text" class="text" name="webname" /> <span class="red">[必填]</span> ( *网站名称不得为空20位之间 )</dd>
            <dd>网址地址：<input type="text" class="text" name="weburl" /> <span class="red">[必填]</span> ( *网站地址不得为空不大于100位 )</dd>
            <dd id="logo" style="display: none">LOGO地址：<input type="text" class="text" name="logourl" /> <span class="red">[必填]</span> ( *logo地址不得为空不大于100位 )</dd>
            <dd>站长名字：<input type="text" class="text" name="user" /> </dd>
            <dd>验 证 码：<input type="text" class="text" name="code" /> <span class="red">[必填]</span></dd>
            <dd><img src="config/code.php" onclick="javascript:this.src='config/code.php?tm='+Math.random();" class="code" /></dd>
            <dd><input type="submit" class="submit" name="send" onclick="return checkUrl();" value="申请友情链接" /></dd>
        </dl>
    </form>
</div>
{/if}

{if $frontshow}
    <div id="friendlink">
        <h2>所有链接</h2>
        <h3>文字链接</h3>
        <div>
            {if $Alltext}
                {foreach $Alltext(key,value)}
                    <a href="{@value->weburl}" target="_blank">{@value->webname}</a>
                {/foreach}
            {/if}
        </div>
        <h3>Logo链接</h3>
        <div>
            {if $logo}
                {foreach $Alllogo(key,value)}
                    <a href="{@value->weburl}" target="_blank"><img src="{@value->logourl}" alt="{@value->webname}" /></a>
                {/foreach}
            {/if}
        </div>
    </div>
{/if}
{include file='footer.tpl'}
</body>
</html>