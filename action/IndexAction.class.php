<?php
	class IndexAction extends Action
    {

        //构造方法，初始化
        public function __construct(&$_tpl)
        {
            parent::__construct($_tpl);
        }

        //执行
        public function _action(){
            $this->login();
            $this->laterUser();
            $this->showList();
            $this->getVote();
        }


        //获取投票
        private function getVote(){
            $_vote=new VoteModel();
            $this->_tpl->assign('vote_title',$_vote->getVoteTitle()->title);
            $this->_tpl->assign('vote_item',$_vote->getVoteItem());
        }

		//最近登陆的会员
		 private function laterUser(){
			$_user=new UserModel();
			$this->_tpl->assign('AllLaterUser',$_user->getLaterUser());
		}

		//显示推荐，本月热点、本月评论、头条
        private function showList(){
			parent::__construct($this->_tpl,new ContentModel());

			$_object=$this->_model->getNewRecList();
			Tool::subStr($_object,'title',15,'utf-8');
			Tool::objDate($_object,'date');
			$this->_tpl->assign('NewRecList',$_object);

			$_object=$this->_model->getMonthHotList();
			Tool::subStr($_object,'title',15,'utf-8');
			Tool::objDate($_object,'date');
			$this->_tpl->assign('MonthHotList',$_object);
			
			$_object=$this->_model->getMonthCommentList();
			Tool::subStr($_object,'title',15,'utf-8');
			Tool::objDate($_object,'date');
			$this->_tpl->assign('MonthCommentList',$_object);

			$_object=$this->_model->getPicList();
			Tool::subStr($_object,'title',20,'utf-8');
			Tool::objDate($_object,'date');
			$this->_tpl->assign('PicList',$_object);

			$_object=$this->_model->getNewList();
			Tool::subStr($_object,'title',25,'utf-8');
			Tool::objDate($_object,'date');
			$this->_tpl->assign('NewList',$_object);

			$_object=$this->_model->getNewTop();
			$this->_tpl->assign('TopTitle',Tool::subStr($_object->title,null,15,'utf-8'));
			$this->_tpl->assign('TopInfo',Tool::subStr($_object->info,null,80,'utf-8'));
			$this->_tpl->assign('TopId',Tool::subStr($_object->id,null,80,'utf-8'));
			

			$_object=$this->_model->getNewTopList();
			Tool::subStr($_object,'title',25,'utf-8');
			Tool::objDate($_object,'date');
			if($_object){
				$_i=1;
				foreach($_object as $_value){
					if($_i % 2==0){
						$_value->line='';
					}else{
						$_value->line='|';
					}
					$_i++;
				}
			}
			$this->_tpl->assign('NewTopList',$_object);

			$_nav=new NavModel();
			$_object=$_nav->getFourNav();
			if($_object){
				$_i=1;
				foreach($_object as $_value){
					if($_i % 2==0){
						$_value->class='list right bottom';
					}else{
						$_value->class='list bottom';
					}
					$_i++;
					$this->_model->nav=$_value->id;
					$_navList=$this->_model->getNewNavList();
					Tool::subStr($_navList,'title',20,'utf-8');
					Tool::objDate($_navList,'date');
					$_value->list=$_navList;
				}
			}
			
			$this->_tpl->assign('FourNav',$_object);

		}
		

		//登录模块
        private function login() {
			$_cookie = new Cookie('user');
			$_user = $_cookie->getCookie();
			$_cookie = new Cookie('face');
			$_face = $_cookie->getCookie();
			if ($_user && $_face) {
				$this->_tpl->assign('user',Tool::subStr($_user,null,8,'utf-8'));
				$this->_tpl->assign('face',$_face);
			} else {
				$this->_tpl->assign('login',true);	
			}
			$this->_tpl->assign('cache',IS_CAHCE);
			if (IS_CAHCE) $this->_tpl->assign('member','<script type="text/javascript">getIndexLogin();</script>');
		}
		
	}
?>