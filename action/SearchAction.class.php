<?php
	class SearchAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl,new ContentModel());
		}
		
		//执行
		public function _action() {
            $this->searchKeyword();
            $this->searchTag();
            $this->searchTitle();
		}
		
        //按照标题搜索
        private  function searchTitle(){
            if($_GET['type']==1){
                if(empty($_GET[inkeyworld])) Tool::alertBack('警告：搜索关键字不得为空');
                parent::page($this->_model->searchTitleCountTotal(),ARTICLE_SIZE);
                $_object = $this->_model->searchTitleCount();
                Tool::subStr($_object,'info',120,'utf-8');
                Tool::subStr($_object,'title',35,'utf-8');
                if($_object){
                    foreach($_object as $_value){
                        if(empty($_value->thumbnail)) $_value->thumbnail='images/none.jpg';
                    }
                }
                $this->_tpl->assign('SearchContent',$_object);
            }
        }

        //按照关键字搜索
        private function searchKeyword(){
            if($_GET['type']==2){
                if(empty($_GET[inkeyworld])) Tool::alertBack('警告：搜索关键字不得为空');
                parent::page($this->_model->searchKeywordCountTotal(),ARTICLE_SIZE);
                $_object = $this->_model->searchKeywordCount();
                Tool::subStr($_object,'info',120,'utf-8');
                Tool::subStr($_object,'title',35,'utf-8');
                if($_object){
                    foreach($_object as $_value){
                        if(empty($_value->thumbnail)) $_value->thumbnail='images/none.jpg';
                    }
                }
                $this->_tpl->assign('SearchContent',$_object);

            }
        }

        //按照Tag标签搜索
        private function searchTag(){
            if($_GET['type']==3){
                if(empty($_GET[inkeyworld])) Tool::alertBack('警告：搜索关键字不得为空');
                parent::page($this->_model->searchTagCountTotal(),ARTICLE_SIZE);
                $_object = $this->_model->searchTagCount();
                Tool::subStr($_object,'info',120,'utf-8');
                Tool::subStr($_object,'title',35,'utf-8');
                if($_object) {
                    foreach ($_object as $_value) {
                        if (empty($_value->thumbnail)) $_value->thumbnail = 'images/none.jpg';
                    }
                }
                $this->_tpl->assign('SearchContent',$_object);
            }
        }
	}
?>