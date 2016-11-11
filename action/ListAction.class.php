<?php
	class ListAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl);
		}
		
		//执行
		public function _action() {
			$this->getNav();
			$this->getListContent();
		}
		
		//获取前台列表显示
		private function getListContent() {
			if (isset($_GET['id'])) {
				parent::__construct($this->_tpl, new ContentModel());
				
				$_nav = new NavModel();
				
				$_nav->id = $_GET['id'];
				$_navid = $_nav->getNavChildId();
				
				if ($_navid) {
					$this->_model->nav = Tool::objArrOfStr($_navid,'id');
				} else {
					$this->_model->nav = $_nav->id;
				}
				
				parent::page($this->_model->getListContentTotal(),ARTICLE_SIZE);
				
				$_object = $this->_model->getListContent();
				Tool::subStr($_object,'info',120,'utf-8');
				Tool::subStr($_object,'title',35,'utf-8');
				if (IS_CAHCE) {
					if ($_object) {
						foreach ($_object as $_value) {
							$_value->count = "<script type='text/javascript'>getContentCount();</script>";
						}
					}
				}
				if($_object){
					foreach($_object as $_value){
						if(empty($_value->thumbnail)) $_value->thumbnail='images/none.jpg';
					}
				}
				$this->_tpl->assign('AllListContent',$_object);

				$_object = $this->_model->getMonthNavRec();
				$this->setObject($_object);
				$this->_tpl->assign('MonthNavRec',$_object);

				$_object = $this->_model->getMonthNavHot();
				$this->setObject($_object);
				$this->_tpl->assign('MonthNavHot',$_object);

				$_object = $this->_model->getMonthNavPic();
				$this->setObject($_object);
				$this->_tpl->assign('MonthNavPic',$_object);
				
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}
		

		//setObject
		private function setObject(&$_object){
			if($_object){
				Tool::subStr($_object,'title',15,'utf-8');
				Tool::objDate($_object,'date');
			}
		}
		//获取前台显示的导航
		private function getNav() {
			if (isset($_GET['id'])) {
				$_nav = new NavModel();
				$_nav->id = $_GET['id'];
				if ($_nav->getOneNav()) {
					//主导航
					if ($_nav->getOneNav()->nnav_name) $_nav1 = '<a href="list.php?id='.$_nav->getOneNav()->iid.'">'.$_nav->getOneNav()->nnav_name.'</a> &gt; ';
					$_nav2 = '<a href="list.php?id='.$_nav->getOneNav()->id.'">'.$_nav->getOneNav()->nav_name.'</a>';
					$this->_tpl->assign('nav',$_nav1.$_nav2);
					//子导航集
					$this->_tpl->assign('childnav',$_nav->getAllChildFrontNav());					
				} else {
					Tool::alertBack('警告：此导航不存在！');
				}
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}
		
	}
?>