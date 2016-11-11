<?php
	class RotatainAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new RotatainModel());
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
				case 'state' :
					$this->state();
					break;
				case 'xml' :
					$this->xml();
					break;
				default:
					Tool::alertBack('非法操作！');
			}
		}
		
		
		//show
		private function show() {
			parent::page($this->_model->getRotatainTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','轮播器列表');
			$_object = $this->_model->getAllRotatain();
			Tool::subStr($_object,'title',20,'utf-8');
			Tool::subStr($_object,'link',20,'utf-8');
			if ($_object) {
				foreach ($_object as $_value) {
					if (empty($_value->state)) {
						$_value->state = '<span class="red">[否]</span> | <a href="rotatain.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
					} else {
						$_value->state = '<span class="green">[是]</span> | <a href="rotatain.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
					}
				}
			}
			$this->_tpl->assign('AllRotatain',$_object);
		}
		
		
		//state
		private function state() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				if (!$this->_model->getOneRotatain()) Tool::alertBack('警告：不存在此轮播！');
				if ($_GET['type'] == 'ok') {
					$this->_model->setStateOK() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：设置轮播失败！');
				} elseif ($_GET['type'] == 'cancel') {
					$this->_model->setStateCancel() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：取消轮播失败！');
				} else {
					Tool::alertBack('警告：非法操作！');
				}
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}
		
		//add
		private function add() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：轮播图不得为空！');
				if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空！');
				if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位！');
				if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：简介不得大于200位！');
				$this->_model->link = $_POST['link'];
				$this->_model->thumbnail = $_POST['thumbnail'];
				$this->_model->info = $_POST['info'];
				$this->_model->title = $_POST['title'];
				$this->_model->addRotatain() ? Tool::alertLocation('恭喜你，轮播器新增成功！','?action=show') : Tool::alertBack('很遗憾，轮播器新增失败');
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增轮播器');
			$this->_tpl->assign('prev_url',PREV_URL);
		}
		
		//xml
		private function xml() {
			$_object = $this->_model->getNewRotatain();

            $_xml .= '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
			$_xml .= '<bcaster autoPlayTime="'.RO_NUM.'">'."\r\n";
			if ($_object) {
				foreach ($_object as $_value) {
					$_xml .= '<item item_url="'.$_value->thumbnail.'"  link="'.$_value->link.'"  itemtitle=""></item>'."\r\n";
				}
			}
			$_xml .= '</bcaster>'."\r\n";
			
			$_sxe= new SimpleXMLElement($_xml); 
			$_sxe->asXML('../bcastr.xml'); 
			Tool::alertLocation('恭喜，生成轮播xml文件成功！','?action=show');
		}
		
		//update
		private function update() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：轮播图不得为空！');
				if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空！');
				if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题不得大于20位！');
				if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：简介不得大于200位！');
				$this->_model->id = $_POST['id'];
				$this->_model->link = $_POST['link'];
				$this->_model->thumbnail = $_POST['thumbnail'];
				$this->_model->info = $_POST['info'];
				$this->_model->title = $_POST['title'];
				$this->_model->state = $_POST['state'];
				$this->_model->updateRotatain() ? Tool::alertLocation('恭喜你，轮播器修改成功！',$_POST['prev_url']) : Tool::alertBack('很遗憾，轮播器修改失败');
			}
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$_rotatain = $this->_model->getOneRotatain();
				if (!$_rotatain) Tool::alertBack('警告：不存在此轮播');
				$this->_tpl->assign('id',$_rotatain->id);
				$this->_tpl->assign('titlec',$_rotatain->title);
				$this->_tpl->assign('thumbnail',$_rotatain->thumbnail);
				$this->_tpl->assign('info',$_rotatain->info);
				$this->_tpl->assign('link',$_rotatain->link);
				$this->_tpl->assign('prev_url',PREV_URL);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改轮播器');
				if (empty($_rotatain->state)) {
					$this->_tpl->assign('right_state','checked="checked"');
				} else {
					$this->_tpl->assign('left_state','checked="checked"');
				}
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
		//delete
		private function delete() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$this->_model->deleteRotatain() ? Tool::alertLocation('恭喜你，删除轮播成功！', PREV_URL) : Tool::alertBack('很遗憾，删除轮播失败！');
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>