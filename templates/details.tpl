<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS内容管理系统</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/details.css" />
<script type="text/javascript" src="js/details.js"></script>
<script type="text/javascript" src="config/static.php?id={$id}&type=details"></script>
</head>
<body>

{include file='header.tpl'}
<div id="details">
	<h2>当前位置 &gt; {$nav}</h2>
	<h3>{$titlec}</h3>
	<div class="d1">时间：{$date} 来源：{$source} 作者：{$author} 点击量：{$count} 次</div>
	<div class="d2">{$info}</div>
	<div class="d3">{$content}</div>
    <div class="d4">TAG标签：{$tag}</div>
    <div class="d6">
        <h2><a href="feedback.php?cid={$id}" target="_blank">已有<span>{$comment}</span>人参与评论</a>最新评论</h2>
        {if $NewThreeComment}
            {foreach $NewThreeComment(key,value)}
                <dl>
                     <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
                     <dd><em>{@value->date}发表</em><span>【{@value->user}】</span></dd>
                     <dd class="info">[{@value->manner}] {@value->content}</dd>
                     <dd class="bot"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain" target="_blank">[{@value->sustain}]支持</a> <a 
                     href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose" target="_blank">[{@value->oppose}]反对</a></dd>
                </dl>
            {/foreach}
           {else}
           <dl>
                <dd>此文档没有任何评论！</dd>
           </dl>
        {/if}
    </div>
    <div class="d5">
        <form method="post" name="comment" action="feedback.php?cid={$id}" target="_blank">
                <p>你的评价：<input type="radio" name="manner" value="1" checked="checked" />喜欢
                             <input type="radio" name="manner" value="0" />一般
                             <input type="radio" name="manner" value="-1" />很差
                 </p>
                 <p><textarea name="content"></textarea></p>  
                 <p>验证码：<input type="text" class="text" name="code" />
                 <img src="config/code.php" class="code" onclick="javascript:this.src='config/code.php?tm='+Math.random();" />
                 <input type="submit" name="send" class="submit" onclick="return checkComment();" value="提交评论" />
                 </p>
          </form>
    </div>
</div>
<div id="sidebar">
	<div class="nav">
		<h2>子栏目列表</h2>
		{if $childnav}
		{foreach $childnav(key,value)}
		<strong><a href="list.php?id={@value->id}">{@value->nav_name}</a></strong>
		{/foreach}
		{else}
		<span>该栏目没有子类</span>
		{/if}
	</div>
	<div class="right">
		<h2>本月本类推荐</h2>
        <ul>
            {if $MonthNavRec}
            {foreach $MonthNavRec(key,value)}
                <li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
            {/foreach}
            {/if}	
		</ul>
	</div>
	<div class="right">
		<h2>本月本类热点</h2>
		<ul>
        {if $MonthNavHot}
        {foreach $MonthNavHot(key,value)}
			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
        {/if}
		</ul>
	</div>
	<div class="right">
		<h2>本月本类图文</h2>
		<ul>
         {if $MonthNavHot}
        {foreach $MonthNavPic(key,value)}
			<li><em>{@value->date}</em><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>
		{/foreach}
        {/if}
		</ul>
	</div>
</div>
{include file='footer.tpl'}
</body>
</html>