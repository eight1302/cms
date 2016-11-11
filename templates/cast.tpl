<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$webname}</title>
<link rel="stylesheet" type="text/css" href="style/basic.css" />
<link rel="stylesheet" type="text/css" href="style/cast.css" />
</head>
<body>
{include file='header.tpl'}
<div id="cast">
<h2>调查投票</h2>
<table cellspacing="1">
    <caption>{$vote_title}</caption>
    <tr><th>投票项目</th><th>图示比例</th><th>百分比</th><th>获得票数</th></tr>
   {if $vote_item}
       {foreach $vote_item(key,value)}
            <tr><td>{@value->title}</td><td style="text-align: left;width:{$width}px;"><img src="images/b{@value->picnum}.jpg" style="width:{@value->picwidth}px;height: 21px;i"></td><td>{@value->percent}</td><td>{@value->connt}</td></tr>
        {/foreach}
    {/if}
</table>
</div>
{include file='footer.tpl'}
</body>
</html>