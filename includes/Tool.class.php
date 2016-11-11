<?php
	class Tool {
		
		//弹窗跳转
		static public function alertLocation($_info, $_url) {
			if (!empty($_info)) {
				echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
				exit();
			} else {
				header('Location:'.$_url);
				exit();
			}
		}
		
		//弹窗返回
		static public function alertBack($_info) {
			echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
			exit();
		}

		//弹窗关闭
		static public function alertClose($_info) {
			echo "<script type='text/javascript'>alert('$_info');close();</script>";
			exit();
		}
		
		//弹窗赋值关闭(上传专用)
		static public function alertOpenerClose($_info,$_path) {
			echo "<script type='text/javascript'>alert('$_info');</script>";
			echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
			echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
			echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
			echo "<script type='text/javascript'>window.close();</script>";
			exit();
		}
		
		//将当前文件转换成.tpl文件名
		static public function tplName() {
			$_str = explode('/',$_SERVER["SCRIPT_NAME"]);
			$_str = explode('.',$_str[count($_str)-1]);
			return $_str[0];
		}
		
		//讲html字符串转换成html标签
		static public function unHtml($_str) {
			return htmlspecialchars_decode($_str);
		}
		
		//时期转换
		static public function objDate(&$_object,$_field){
			if($_object){
				foreach($_object as $_value){
					$_value->$_field=date('m-d',strtotime($_value->$_field));
				}
			}
		}

		//将对象数组转换成字符串，并且去掉最后的逗号
		static public function objArrOfStr(&$_object,$_field) {
			if ($_object) {
				foreach ($_object as $_value) {
					$_html .= $_value->$_field.',';
				}
			}
			return substr($_html,0,strlen($_html)-1);
		}
		
		//字符串截取
		static public function subStr(&$_object,$_field,$_length,$_encoding) {
			if ($_object) {
				if (is_array($_object)) {
					foreach ($_object as $_value) {
						if (mb_strlen($_value->$_field,$_encoding) > $_length) {
							$_value->$_field = mb_substr($_value->$_field,0,$_length,$_encoding).'...';
						}
					}
				} else {
					if (mb_strlen($_object,$_encoding) > $_length) {
						return mb_substr($_object,0,$_length,$_encoding).'...';
					}else{
						return $_object;	
					}
				}
			}
		}
		
		//显示html过滤
		static public function htmlString($_date) {
			if (is_array($_date)) {
				foreach ($_date as $_key=>$_value) {
					$_string[$_key] = Tool::htmlString($_value);  //递归
				}
			} elseif (is_object($_date)) {
				foreach ($_date as $_key=>$_value) {
					$_string->$_key = Tool::htmlString($_value);  //递归
				}
			} else {
				$_string = htmlspecialchars($_date);
			}
			return $_string;
		}
		
		//数据库输入过滤
		static public function mysqlString($_date) {
			return !GPC ? mysql_real_escape_string($_date) : $_date;
		}
		
		//清理session
		static public function unSession() {
			if (session_start()) {
				session_destroy();
			}
		}
		
	}
?>