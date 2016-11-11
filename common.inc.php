<?php
//前台缓存开关
define('IS_CAHCE',true);
//模板句柄
global $_tpl,$_cache;
if (IS_CAHCE && !$_cache->noCache()) {
	ob_start();
	$_tpl->cache(Tool::tplName().'.tpl');
}
$_nav = new NavAction($_tpl);
$_nav->showfront();  //列出主导航

$_cookie = new Cookie('user');
if (IS_CAHCE) {
	$_tpl->assign('header','<script type="text/javascript">getHeader();</script>');
} else {
	if ($_cookie->getCookie()) {
		$_tpl->assign('header',$_cookie->getCookie().'，您好！ <a href="register.php?action=logout">退出</a> ');
	} else {
		$_tpl->assign('header','	<a href="register.php?action=reg" class="user">注册</a> <a href="register.php?action=login" class="user">登录</a>');
	}
}

$_link=new FriendLinkAction($_tpl);
$_link->index();

$_tpl->assign('webname',WEBNAME);

?>