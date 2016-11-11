<div id="link">
	<h2><span><a href="friendlink?action=frontshow" target="_blank">所有链接</a> | <a href="friendlink?action=frontadd" target="_blank">申请加入</a></span>友情链接</h2>
	<ul>
        {if $text}
            {foreach $text(key,value)}
		        <li><a href="{@value->weburl}">{@value->webname}</a></li>
            {/foreach}
        {/if}
	</ul>
	<dl>
        {if $logo}
            {foreach $logo(key,value)}
                <dd><a href="{@value->logourl}" target="_blank"><img src="{@value->logourl}" alt="{@value->webname}" /></a></dd>
            {/foreach}
        {/if}
	</dl>
</div>
<div id="footer">
	<p>Powered by <span>YC60.COM</span> (C) 2015/9-2016/5.</p>
	<p>联系方式：18830728982；QQ:380080496. 制作人：<span>张晓敏</span> 版权所有</p>
</div>