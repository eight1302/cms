<?php
	class UserAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new UserModel());
		}
		
		//action
		public function _action() {
			switch ($_GET['action']) {
				case 'show' :
					$this->show();
					break;
				case 'add' :
					$this->add();
					break;
				case 'update' :
					$this->update();
					break;
				case 'delete' :
					$this->delete();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		
		
		//show
		private function show() {
			parent::page($this->_model->getUserTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','会员列表');
			$_object=$this->_model->getAllUser();
			foreach($_object as $_value){
				switch($_value->state){
					case 0:
						$_value->state='被封杀的会员';
						break;
					case 1:
						$_value->state='待审核的会员';
						break;
					case 2:
						$_value->state='初级会员';
						break;
					case 3:
						$_value->state='中级会员';
						break;
					case 4:
						$_value->state='高级会员';
						break;
					case 5:
						$_value->state='VIP会员';
						break;
				}
			}
			$this->_tpl->assign('AllUser',$_object);
		}
		
		//add
		private function add() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['user'])) Tool::alertBack('警告：用户名不得为空！');
				if (Validate::checkLength($_POST['user'],2,'min')) Tool::alertBack('警告：用户名长度不得小于两位！');
				if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：用户名长度不得大于二十位！');
				if (Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
				if (Validate::checkEquals($_POST['pass'],$_POST['notpass'])) Tool::alertBack('警告：密码和确认密码不一致！');
				if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
				if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
				if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
					$this->_model->question = $_POST['question'];
					$this->_model->answer = $_POST['answer'];
				}
				$this->_model->user = $_POST['user'];
				$this->_model->pass = sha1($_POST['pass']);
				$this->_model->email = $_POST['email'];
				$this->_model->face = $_POST['face'];
				$this->_model->state = $_POST['state'];
				if ($this->_model->checkUser()) Tool::alertBack('警告：用户名重复！');
				if ($this->_model->checkEmail()) Tool::alertBack('警告：邮件重复！');
				if ($this->_model->addUser()) {
					Tool::alertLocation('恭喜你，注册成功！','user.php?action=show');
				} else { 
					Tool::alertBack('很遗憾，注册失败！');
				}
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增会员');
			$this->_tpl->assign('prev_url',PREV_URL);
			$this->_tpl->assign('OptionFaceOne',range(1,9));
			$this->_tpl->assign('OptionFaceTwo',range(10,24));
		}
		
		//update
		private function update() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['pass'])){
					$this->_model->pass=$_POST['ppass'];

				}else{
					if (Validate::checkLength($_POST['pass'],6,'min')) Tool::alertBack('警告：密码不得小于六位！');
					$this->_model->pass=sha1($_POST['pass']);
				}
				if (Validate::checkNull($_POST['email'])) Tool::alertBack('警告：电子邮件不得为空！');
				if (Validate::checkEmail($_POST['email'])) Tool::alertBack('警告：电子邮件格式不正确！');
				if (!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])) {
					$this->_model->question = $_POST['question'];
					$this->_model->answer = $_POST['answer'];
				}
				$this->_model->id=$_POST['id'];
				$this->_model->email = $_POST['email'];
				$this->_model->face = $_POST['face'];
				$this->_model->state = $_POST['state'];
				$this->_model->updateUser() ? Tool::alertLocation('恭喜你，修改成功！',$_POST['prev_url']) : Tool::alertBack('很遗憾，修改失败！');
			}
			if (isset($_GET['id'])) {
				$this->_model->id=$_GET['id'];
				$_user=$this->_model->getOneUser();
				if($_user){
					$this->_tpl->assign('update',true);
					$this->_tpl->assign('title','修改会员');
					$this->_tpl->assign('prev_url',PREV_URL);
					$this->_tpl->assign('id',$_user->id);
					$this->_tpl->assign('user',$_user->user);
					$this->_tpl->assign('pass',$_user->pass);
					$this->_tpl->assign('email',$_user->email);
					$this->_tpl->assign('facesrc',$_user->face);
					$this->_tpl->assign('answer',$_user->answer);
					$this->question($_user->question);
					$this->face($_user->face);
					$this->state($_user->state);

				}else{
					Tool::alertBack('警告：非法操作！');
				}
				
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}
		
		//状态
		private function state($_state){
			$_stateArr=array('被封杀的会员','待审核的会员','低级会员','中级会员','高级会员','VIP会员');
			foreach ($_stateArr as $_key=>$_value) {
				if ($_state == $_key) $_checked='checked="checked"';
				$_html .= ' <input type="radio" name="state" '.$_checked.' value="'.$_key.'"  />'.$_value.'';
				$_checked = '';
			}
			$this->_tpl->assign('state',$_html);
		}

		//安全提问
		private function question($_question){
			$_questionArr=array('我的爱好？','我的梦想？','我家庭的幸福指数？','我爱看的书？');
			foreach ($_questionArr as $_value) {
				if ($_value == $_question) $_selected='selected="selected"';
				$_html .= '<option '.$_selected.' value="'.$_value.'" >'.$_value.'</option>';
				$_selected = '';
			}
			$this->_tpl->assign('question',$_html);
			
		}


		//delete
		private function delete() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$this->_model->deleteUser() ? Tool::alertLocation('恭喜你，删除会员成功！', PREV_URL) : Tool::alertBack('很遗憾，删除会员失败！');
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}

		//头像
		private function face($_face){
			$_one=range(1,9);
			$_two=range(10,24);
			foreach ($_one as $_value) {
				if ('0'.$_value.'.gif' == $_face) $_selected='selected="selected"';
				$_html .= '<option '.$_selected.' value="0'.$_value.'.gif" >0'.$_value.'.gif</option>';
				$_selected = '';
			}
			foreach ($_two as $_value) {
				if ($_value.'.gif' == $_face) $_selected='selected="selected"';
				$_html .= '<option '.$_selected.' value="'.$_value.'.gif" >'.$_value.'.gif</option>';
				$_selected = '';
			}
			$this->_tpl->assign('face',$_html);
		}
		
	}
?>