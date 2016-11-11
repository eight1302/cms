<?php
	class LinkAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new linkModel());
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
                case 'state':
                    $this->state();
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
			parent::page($this->_model->getLinkTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','友情链接列表');
            $_object=$this->_model->getAllLimitLink();
            Tool::subStr($_object,'weburl',20,'utf-8');
            Tool::subStr($_object,'logourl',20,'utf-8');
            if($_object) {
                foreach($_object as $_value){
                    switch($_value->type){
                        case 1:
                            $_value->type='文字链接';
                            break;
                        case 2:
                            $_value->type='Logo链接';
                            break;
                    }
                    if(empty($_value->state)){
                        $_value->state='<span class="red">【未审核】</span> | <a href="link.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                    }else{
                        $_value->state='<span class="green">【以审核】</span>| <a href="link.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                    }
                }
            }
			$this->_tpl->assign('AllLink',$_object);
		}
        //state
        private function state() {
            if (isset($_GET['id'])) {
                $this->_model->id = $_GET['id'];
                if (!$this->_model->getOneLink()) Tool::alertBack('警告：不存在此网址！');
                if ($_GET['type'] == 'ok') {
                    $this->_model->setStateOK() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：设置网址失败！');
                } elseif ($_GET['type'] == 'cancel') {
                    $this->_model->setStateCancel() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：取消网址失败！');
                } else {
                    Tool::alertBack('警告：非法操作！');
                }
            } else {
                Tool::alertBack('警告：非法操作！');
            }
        }

        //add
		private function add() {
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

                $this->_model->webname=$_POST['webname'];
                $this->_model->weburl=$_POST['weburl'];
                $this->_model->logourl=$_POST['logourl'];
                $this->_model->user=$_POST['user'];
                $this->_model->type=$_POST['type'];
                $this->_model->state=$_POST['state'];
                $this->_model->addLink() ? Tool::alertLocation('恭喜新增成功','?action=show'):Tool::alertBack('很遗憾，新增失败');
            }
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增友情链接');
			$this->_tpl->assign('prev_url',PREV_URL);
		}

        //update
        private function update() {
            if (isset($_POST['send'])) {
                if (Validate::checkNull($_POST['webname'])) Tool::alertBack('警告：网站名称不得为空！');
                if (Validate::checkLength($_POST['webname'],20,'max')) Tool::alertBack('警告：网站名称不得大于二十位！');
                if (Validate::checkNull($_POST['weburl'])) Tool::alertBack('警告：网站地址不得为空！');
                if (Validate::checkLength($_POST['webname'],100,'max')) Tool::alertBack('警告：网站地址不得大于一百位！');
                if ($_POST['type'] == 2) {
                    if (Validate::checkNull($_POST['logourl'])) Tool::alertBack('警告：Logo地址不得为空！');
                    if (Validate::checkLength($_POST['logourl'],100,'max')) Tool::alertBack('警告：Logo地址不得大于一百位！');
                }
                if (Validate::checkLength($_POST['user'],20,'max')) Tool::alertBack('警告：站长名不得大于二十位！');

                $this->_model->id = $_POST['id'];
                $this->_model->webname = $_POST['webname'];
                $this->_model->weburl = $_POST['weburl'];
                $this->_model->logourl = $_POST['logourl'];
                $this->_model->user = $_POST['user'];
                $this->_model->type = $_POST['type'];
                $this->_model->state = $_POST['state'];
                $this->_model->updateLink() ? Tool::alertLocation('恭喜，修改友情链接成功！',$_POST['prev_url']) : Tool::alertBack('很遗憾，修改友情链接失败，请重试！');
            }
            if (isset($_GET['id'])) {
                $this->_model->id = $_GET['id'];
                $_link = $this->_model->getOneLink();
                if (!$_link) Tool::alertBack('警告：不存在此链接！');
                $this->_tpl->assign('id',$_link->id);
                $this->_tpl->assign('webname',$_link->webname);
                $this->_tpl->assign('weburl',$_link->weburl);
                $this->_tpl->assign('logourl',$_link->logourl);
                $this->_tpl->assign('user',$_link->user);
                $this->_tpl->assign('state',$_link->state);
                if ($_link->type == 1) {
                    $this->_tpl->assign('text_type','checked="checkecd"');
                    $this->_tpl->assign('logo','display:none');
                } elseif ($_link->type == 2) {
                    $this->_tpl->assign('logo_type','checked="checkecd"');
                    $this->_tpl->assign('logo','display:block');
                }
                $this->_tpl->assign('prev_url',PREV_URL);
                $this->_tpl->assign('update',true);
                $this->_tpl->assign('title','修改等级');
            } else {
                Tool::alertBack('非法操作！');
            }
        }

        //delete
        private function delete() {
            if (isset($_GET['id'])) {
                $this->_model->id = $_GET['id'];
                $this->_model->deleteLink() ? Tool::alertLocation('恭喜你，删除友情链接成功！', PREV_URL) : Tool::alertBack('很遗憾，删除友情链接失败！');
            } else {
                Tool::alertBack('非法操作！');
            }
        }
		
	}
?>