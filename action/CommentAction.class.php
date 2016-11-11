<?php
	class CommentAction extends Action {
		
		//构造方法，初始化
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new CommentModel());
		}
		
		//action
		public function _action() {
			switch ($_GET['action']) {
				case 'show' :
					$this->show();
					break;
				case 'state' :
					$this->state();
					break;
				case 'states' :
					$this->states();
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
			parent::page($this->_model->getCommentListTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','评论列表');
			$_object=$this->_model->getCommentList();
			Tool::subStr($_object,'content',30,'utf-8');
			if($_object){
				foreach($_object as $_value){
					if(empty($_value->state)){
						$_value->state='<span class="red">[未审核]</span> | <a href="comment.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
					}else{
						$_value->state='<span class="green">[已审核]</span> | <a href="comment.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
					}
				}
			}
			$this->_tpl->assign('CommentList',$_object);
		}
		
		//state单量审核
		private function state(){
			if(isset($_GET['id'])){
				$this->_model->id=$_GET['id'];
				if(!$this->_model->getOneComment()) Tool::alertBack('警告：次评论不存在！');
				if($_GET[type]=='ok'){
					$this->_model->setStateOK() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：审核失败！');
				}else if($_GET[type]=='cancel'){
					$this->_model->setStateCancel() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：取消审核失败！');
				}else{
					Tool::alertBack('警告：非法操作！');
				}
			}else{
				Tool::alertBack('警告：非法操作！');
			}
		}
		

		//states批量审核
		private function states(){
			if (isset($_POST['send'])) {
				$this->_model->states = $_POST['states'];
				if ($this->_model->setStates()) Tool::alertLocation(null, PREV_URL);
			}
		}
		//delete
		private function delete() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$this->_model->deleteComment() ? Tool::alertLocation('恭喜你，删除评论成功！', PREV_URL) : Tool::alertBack('很遗憾，删除评论失败！');
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>