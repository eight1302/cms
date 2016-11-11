<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<script type="text/javascript" src="js/details.js"></script>
<link rel="stylesheet" type="text/css" href="style/feedback.css" />
</head>
<body>
{include file='header.tpl'}
<div id="feedback">
    <h2>评论列表</h2>
    <h3>{$titlec}</h3>
    <p>{$info}<a href="details.php?id={$id}" target="_blank">[详情]</a></p>
   {if $HotThreeComment}
   {foreach $HotThreeComment(key,value)}
        <dl>
             <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
             <dd><em>{@value->date}发表</em><span>【{@value->user}】</span><img src="images/hot.gif" alt="火" /></dd>
             <dd class="info">[{@value->manner}] {@value->content}</dd>
             <dd class="bot"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}]支持</a> <a 
             href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
        </dl>
     {/foreach}
    {/if}
    <h4>最新评论</h4>
    {if $AllComment}
        {foreach $AllComment(key,value)}
            <dl>
                <dt><img src="images/{@value->face}" alt="{@value->user}"></dt>
                <dd><em>{@value->date}发表</em><span>【{@value->user}】</span></dd>
                <dd class="info">[{@value->manner}] {@value->content}</dd>
                <dd class="bot"><a href="feedback.php?cid={@value->cid}&id={@value->id}&type=sustain">[{@value->sustain}]支持</a> <a  
                href="feedback.php?cid={@value->cid}&id={@value->id}&type=oppose">[{@value->oppose}]反对</a></dd>
            </dl>
        {/foreach}
      {else}
          <dl>
            <dd>没有任何评论</dd>
          </dl>
   {/if}
   <div id="page">{$page}</div>
    
</div>
<div id="sidebar">
    <h2>热评文档总排行</h2>
    {if $HotTwentyComment}
   {foreach $HotTwentyComment(key,value)}
        <ul>
			<li><a href="details.php?id={@value->id}" target="_blank">{@value->title}</a></li>		
		</ul>
    {/foreach}
    {/if}
</div>
<div class="d5">
     <form method="post" name="comment" action="feedback.php?cid={$cid}">
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
{include file='footer.tpl'}
</body>
</html>