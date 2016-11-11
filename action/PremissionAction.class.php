<?php
	class PremissionAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new PremissionModel());
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
			parent::page($this->_model->getPremissionTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','权限列表');
            $this->_tpl->assign('name','$this->name');
            $this->_tpl->assign('info','$this->info');
			$this->_tpl->assign('AllPromission',$this->_model->getAllLimitPremission());

		}
		
		//add
		private function add() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['name'])) Tool::alertBack('警告：权限名称不得为空！');
				if (Validate::checkLength($_POST['name'],2,'min')) Tool::alertBack('警告：权限名称不得小于两位！');
				if (Validate::checkLength($_POST['name'],20,'max')) Tool::alertBack('警告：权限名称不得大于20位！');
				if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：权限描述不得大于200位！');
				$this->_model->name = $_POST['name'];
				if ($this->_model->getOnePremission()) Tool::alertBack('警告：此权限名称已有！');
				$this->_model->info = $_POST['info'];
				$this->_model->addPremission() ? Tool::alertLocation('恭喜你，新增权限成功！','?action=show') : Tool::alertBack('很遗憾，新增权限失败！');
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增权限');
			$this->_tpl->assign('prev_url',PREV_URL);

		}
		
		//update
		private function update() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['name'])) Tool::alertBack('警告：等级名称不得为空！');
				if (Validate::checkLength($_POST['name'],2,'min')) Tool::alertBack('警告：等级名称不得小于两位！');
				if (Validate::checkLength($_POST['name'],20,'max')) Tool::alertBack('警告：等级名称不得大于20位！');
				if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：等级描述不得大于200位！');
				$this->_model->id = $_POST['id'];
				$this->_model->name = $_POST['name'];
				$this->_model->info = $_POST['info'];
				$this->_model->updatePremission() ? Tool::alertLocation('恭喜你，修改权限成功！', $_POST['prev_url']) : Tool::alertBack('很遗憾，修改权限失败！');
			}
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$_premission = $this->_model->getOnePremission();
				if(!$_premission) Tool::alertBack('权限传值的id有误！');
				$this->_tpl->assign('id',$_premission->id);
				$this->_tpl->assign('name',$_premission->name);
				$this->_tpl->assign('info',$_premission->info);
				$this->_tpl->assign('prev_url',PREV_URL);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改权限');
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
		//delete
		private function delete() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$this->_model->deletePremission() ? Tool::alertLocation('恭喜你，删除权限成功！', PREV_URL) : Tool::alertBack('很遗憾，删除权限失败！');
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>