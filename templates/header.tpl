<script type="text/javascript" src="config/static.php?type=header"></script>
<div id="top">
	{$header}
	<script type="text/javascript" src="js/text_adver.js" ></script>
</div>
<div id="header">
	<h1><a href="###">{$webname}</a></h1>
	<div class="adver"><script type="text/javascript" src="js/header_adver.js" ></script></div>
</div>
<div id="nav">
	<ul>
		<li><a href="./">首页</a></li>
		{if $FrontNav}
		{foreach $FrontNav(key,value)}
		<li><a href="list.php?id={@value->id}">{@value->nav_name}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
<div id="search">
	<form method="get" action="search.php">
		<select name="type">
			<option selected="selected" value="1">按标题</option>
			<option value="2">按关键字</option>
			<option value="3">全局查询</option>
		</select>
		<input type="text" name="inkeyworld" class="text" />
		<input type="submit" class="submit" value="搜索" />
	</form>
	<strong>TAG标签：</strong>
	<ul>
		<li><a href="###">基金(3)</a></li>
		<li><a href="###">美女(1)</a></li>
		<li><a href="###">白兰地(3)</a></li>
		<li><a href="###">音乐(1)</a></li>
		<li><a href="###">体育(1)</a></li>
		<li><a href="###">直播(1)</a></li>
		<li><a href="###">会晤(1)</a></li>
		<li><a href="###">韩日(1)</a></li>
		<li><a href="###">警方(1)</a></li>
		<li><a href="###">广州(1)</a></li>
	</ul>
</div>