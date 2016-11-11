<?php
	//系统配置文件
	define('WEBNAME','瓢城Web俱乐部');
	define('PAGE_SIZE','10');
	define('ARTICLE_SIZE','8');
	define('NAV_SIZE','10');
	define('UPDIR','/uploads/');

	//轮播器配置
	define('RO_TIME','3');
	define('RO_NUM','3');

	//广告服务
	define('ADVER_TEXT_NUM','5');
	define('ADVER_PIC_NUM','3');
	//不可修改的项目

	//数据库配置文件
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','zxm1302');
	define('DB_NAME','cms');
	define('DB_PORT',3306);

	define('GPC',get_magic_quotes_gpc());
	define('PREV_URL',$_SERVER["HTTP_REFERER"]);

	//模板配置信息
	define('TPL_DIR',ROOT_PATH.'/templates/');
	define('TPL_C_DIR',ROOT_PATH.'/templates_c/');
	define('CACHE',ROOT_PATH.'/cache/');
	define('MARK',ROOT_PATH.'/images/yc.png');
?>
