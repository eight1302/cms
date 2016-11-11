<?php
	class FeedBackAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl);
		}
		
		//action
		public function _action() {
			$this->addComment();
			$this->setCount();
			$this->showComment();
		}

		//新增评论
		private function addComment() {
			if (isset($_POST['send'])) {
				$_url = 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
				if ($_url == PREV_URL) {
					if (Validate::checkNull($_POST['content'])) Tool::alertBack('警告：评论内容不得为空！');
					if (Validate::checkLength($_POST['content'],255,'max')) Tool::alertBack('警告：评论内容长度不得大于255位！');
					if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertBack('警告：验证码必须是四位！');
					if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertBack('警告：验证码不正确！');
				} else {
					if (Validate::checkNull($_POST['content'])) Tool::alertClose('警告：评论内容不得为空！');
					if (Validate::checkLength($_POST['content'],255,'max')) Tool::alertClose('警告：评论内容长度不得大于255位！');
					if (Validate::checkLength($_POST['code'],4,'equals')) Tool::alertClose('警告：验证码必须是四位！');
					if (Validate::checkEquals(strtolower($_POST['code']),$_SESSION['code'])) Tool::alertClose('警告：验证码不正确！');
				}
				parent::__construct($this->_tpl, new CommentModel());
				$_cookie = new Cookie('user');
				if ($_cookie->getCookie()) {
					$this->_model->user = $_cookie->getCookie();
				} else {
					$this->_model->user = '游客';
				}
				$this->_model->manner = $_POST['manner'];
				$this->_model->content = $_POST['content'];
				$this->_model->cid = $_GET['cid'];
				$this->_model->addComment() ? Tool::alertLocation('评论添加成功，请等待管理员审核！','feedback.php?cid='.$this->_model->cid) : Tool::alertLocation('评论添加失败，请重新添加！','feedback.php?cid='.$this->_model->cid);
			}	
		}
		
		//显示评论
		private function showComment() {
			if (isset($_GET['cid'])) {
				parent::__construct($this->_tpl, new CommentModel());
				$this->_model->cid = $_GET['cid'];
				$_content = new ContentModel();
				$_content->id = $_GET['cid'];
				if (!$_content->getOneContent()) Tool::alertBack('警告：不存在文档的评论！');
				parent::page($this->_model->getCommentTotal());
				$_object = $this->_model->getAllComment();
				$_object2 = $this->_model->getHotThreeComment();
				$_object3 = $_content->getHotTwentyComment();
				$this->setObject($_object);
				$this->setObject($_object2);
				
				$this->_tpl->assign('titlec',$_content->getOneContent()->title);
				$this->_tpl->assign('info',$_content->getOneContent()->info);
				$this->_tpl->assign('id',$_content->getOneContent()->id);
				$this->_tpl->assign('cid',$this->_model->cid);
				$this->_tpl->assign('AllComment',$_object);
				$this->_tpl->assign('HotThreeComment',$_object2);
				$this->_tpl->assign('HotTwentyComment',$_object3);
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}
		
		
		//支持和反对
		private function setCount() {
			if (isset($_GET['cid']) && isset($_GET['id']) && isset($_GET['type'])) {
				parent::__construct($this->_tpl, new CommentModel());
				$this->_model->id = $_GET['id'];
				if (!$this->_model->getOneComment()) Tool::alertBack('警告：不存在此评论！');
				if ($_GET['type'] == 'sustain') {
					$this->_model->setSustain() ? Tool::alertLocation('支持成功！','feedback.php?cid='.$_GET['cid']) : Tool::alertLocation('支持失败！','feedback.php?cid='.$_GET['cid']);
				}
				if ($_GET['type'] == 'oppose') {
					$this->_model->setOppose() ? Tool::alertLocation('反对成功！','feedback.php?cid='.$_GET['cid']) : Tool::alertLocation('反对失败！','feedback.php?cid='.$_GET['cid']);
				}
			} 
		}

		//转成
		private function setObject(&$_object){
			if ($_object) {
					foreach ($_object as $_value) {
						switch ($_value->manner) {
							case -1 :
								$_value->manner = '很差';
								break;
							case 0 :
								$_value->manner = '一般';
								break;
							case 1 :
								$_value->manner = '喜欢';
								break;					
						}
						if (empty($_value->face)) {
							$_value->face = '00.gif';
						}
						if (!empty($_value->oppose)) {
							$_value->oppose = '-'.$_value->oppose;
						}
					}
				}
		}
	}
?>