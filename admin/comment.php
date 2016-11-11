<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
global $_tpl;
$_comment = new CommentAction($_tpl);   //入口
$_comment->_action();
$_tpl->display('comment.tpl');
?>