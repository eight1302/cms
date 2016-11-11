<?php
	class DetailsAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl);
		}
		
		//执行
		public function _action() {
			$this->getDetails();	
		}
		
		//获取文档详细内容
		private function getDetails() {
			if (isset($_GET['id'])) {
				parent::__construct($this->_tpl, new ContentModel());
				$this->_model->id = $_GET['id'];
				if (!$this->_model->setContentCount()) Tool::alertBack('警告：不存在此文档！');
				$_content = $this->_model->getOneContent();
				$_comment=new CommentModel();
				$_comment->cid=$this->_model->id;
				$this->_tpl->assign('id',$_content->id);
				$this->_tpl->assign('titlec',$_content->title);
				$this->_tpl->assign('date',$_content->date);
				$this->_tpl->assign('source',$_content->source);
				$this->_tpl->assign('author',$_content->author);
				$this->_tpl->assign('info',$_content->info);
				$this->_tpl->assign('tag',$_content->tag);
				$this->_tpl->assign('content',Tool::unHtml($_content->content));
				$this->getNav($_content->nav);
				if (IS_CAHCE) {
					$this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');
				} else {
					$this->_tpl->assign('comment',$_comment->getCommentTotal());
					$this->_tpl->assign('count',$_content->count);
				}
                $this->_tpl->assign('comment',$_comment->getCommentTotal());
                $_object=$_comment->getNewThreeComment();
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
				$this->_tpl->assign('NewThreeComment',$_object);
				
				$this->_model->nav=$_content->nav;
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
		private function getNav($_id) {
			$_nav = new NavModel();
			$_nav->id = $_id;
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
		}

		
	}
?>