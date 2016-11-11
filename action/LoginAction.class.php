<?php
	class LoginAction extends Action {
		
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new ManageModel());
		}
		
		
		//action
		public function _action() {
			switch ($_GET['action']) {
				case 'login' :
					$this->login();
					break;
				case 'logout' :
					$this->logout();
					break;
			}
		}
		
		
		//login
		private function login() {
			if (isset($_POST['send'])) {
				if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('警告：验证码必须是四位！');
				if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('警告：验证码不正确！');
				if (Validate::checkNull($_POST['admin_user'])) Tool::alertBack('警告：用户名不得为空！');
				if (Validate::checkLength($_POST['admin_user'],2,'min')) Tool::alertBack('警告：用户名不得小于两位！');
				if (Validate::checkLength($_POST['admin_user'],20,'max')) Tool::alertBack('警告：用户名不得大于20位！');
				if (Validate::checkNull($_POST['admin_pass'])) Tool::alertBack('警告：密码不得为空！');
				if (Validate::checkLength($_POST['admin_pass'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
				$this->_model->admin_user = $_POST['admin_user'];
				$this->_model->admin_pass = sha1($_POST['admin_pass']);
				$this->_model->last_ip = $_SERVER["REMOTE_ADDR"];
				$_login = $this->_model->getLoginManage();
				if ($_login) {
                    if (strstr($_login->premission, '1')) {
                        $_SESSION['admin']['admin_user'] = $_login->admin_user;
                        $_SESSION['admin']['level_name'] = $_login->level_name;
                        $this->_model->setLoginCount();
                        Tool::alertLocation(null, 'admin.php');
                    }else{
                        Tool::alertBack('警告：权限不够，无法登陆！');
                    }
				} else {
					Tool::alertBack('警告：用户名或密码错误！');
				}
			}
		}
		
		
		//logout
		private function logout() {
			Tool::unSession();
			Tool::alertLocation(null, 'admin_login.php');
		}
		
	}
?>