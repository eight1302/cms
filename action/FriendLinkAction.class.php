<?php
	class FriendLinkAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new LinkModel());
		}
		
		//action
		public function _action() {
			switch ($_GET['action']) {
                case 'frontshow' :
                    $this->frontshow();
                    break;
                case 'frontadd' :
                    $this->frontadd();
                    break;
                case 'index' :
                    $this->index();
                    break;
				default:
					Tool::alertBack('非法操作！');
			}
		}

        //frontshow
        private function frontshow(){
            $this->_tpl->assign('frontshow',true);
            $this->_tpl->assign('Alltext',$this->_model->getAllTextLink());
            $this->_tpl->assign('Alllogo',$this->_model->getAllLogoLink());
        }
        //index
        public function index(){
            $this->text();
            $this->logo();
        }

        //text
        private function text(){
            $this->_tpl->assign('text',$this->_model->getTwentyTextLink());
        }

        //logo
        private function logo(){
            $this->_tpl->assign('logo',$this->_model->getNineLogoLink());
        }
        //frontadd
        private function frontadd() {
            if(isset($_POST['send'])) {
                if(Validate::checkNull($_POST['webname'])) Tool::alertBack('网站的名称不得为空！');
                if(Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('网站的名称不得大于20位！');
                if(Validate::checkNull($_POST['weburl'])) Tool::alertBack('链接地址不得为空！');
                if(Validate::checkLength($_POST['weburl'],100,'max')) Tool::alertBack('链接地址不得大于100位！');
                if($_POST['type']==2){
                    if(Validate::checkNull($_POST['logourl'])) Tool::alertBack('LOGO地址不得为空！');
                    if(Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('LOGO地址不得大于100位！');
                }

                if(Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('站长名称不得大于20位！');
                if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('警告：验证码必须是四位！');
                if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('警告：验证码不正确！');

                $this->_model->webname=$_POST['webname'];
                $this->_model->weburl=$_POST['weburl'];
                $this->_model->logourl=$_POST['logourl'];
                $this->_model->user=$_POST['user'];
                $this->_model->type=$_POST['type'];
                $this->_model->state=$_POST['state'];
                $this->_model->addLink() ? Tool::alertClose('恭喜申请成功，请耐心等待'):Tool::alertBack('很遗憾，申请失败');
            }
            $this->_tpl->assign('frontadd',true);
        }
	}
?>