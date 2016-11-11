<?php
	class AdverAction extends Action {
		
		//构造方法，初始化 
		public function __construct(&$_tpl) {
			parent::__construct($_tpl, new AdverModel());
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
				case 'state':
					$this->state();
					break;
				case 'text':
					$this->text();
					break;
				case 'header':
					$this->header();
					break;
				case 'sidebar':
					$this->sidebar();
					break;
					
				default:
					Tool::alertBack('非法操作！');
			}
		}
		//sidebar
		private function sidebar(){
			$_object=$this->_model->getNewsidebarAdver();
			
			$_js="var sidebar=[];\r\n";
			$_i=0;
			if($_object){
				foreach($_object as $_value){
					$_i++;
					$_js.="sidebar[$_i]={\r\n";
					$_js.="\t'title':'$_value->title',\r\n";
					$_js.="\t'pic':'$_value->thumbnail',\r\n";
					$_js.="\t'link':'$_value->link'\r\n";
					$_js.="};\r\n";
				}
			}
			$_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
			$_js.="document.write('<a href=\"'+sidebar[i].link+'\" target=\"_blank\" title=\"'+sidebar[i].title+'\"><img src=\"'+sidebar[i].pic+'\"></a>');\r\n";
				
			if(!file_put_contents('../js/sidebar_adver.js',$_js)){
				Tool::alertBack('警告：头部广告生成失败！');
			}

			Tool::alertLocation('恭喜：头部广告生成成功！','?action=show');
		}


		//header
		private function header(){
			$_object=$this->_model->getNewHeaderAdver();
			
			$_js="var header=[];\r\n";
			$_i=0;
			if($_object){
				foreach($_object as $_value){
					$_i++;
					$_js.="header[$_i]={\r\n";
					$_js.="\t'title':'$_value->title',\r\n";
					$_js.="\t'pic':'$_value->thumbnail',\r\n";
					$_js.="\t'link':'$_value->link'\r\n";
					$_js.="};\r\n";
				}
			}
			$_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
			$_js.="document.write('<a href=\"'+header[i].link+'\" target=\"_blank\" title=\"'+header[i].title+'\"><img src=\"'+header[i].pic+'\"></a>');\r\n";
				
			if(!file_put_contents('../js/header_adver.js',$_js)){
				Tool::alertBack('警告：头部广告生成失败！');
			}

			Tool::alertLocation('恭喜：头部广告生成成功！','?action=show');
		}

		//text
		private function text(){
			$_object=$this->_model->getNewTextAdver();
			
			$_js="var text=[];\r\n";
			$_i=0;
			if($_object){
				foreach($_object as $_value){
					$_i++;
					$_js.="text[$_i]={\r\n";
					$_js.="\t'title':'$_value->title',\r\n";
					$_js.="\t'link':'$_value->link'\r\n";
					$_js.="};\r\n";
				}
				$_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
				$_js.="document.write('<a href=\"'+text[i].link+'\" class=\"adv\" target=\"_blank\">'+text[i].title+'</a>');\r\n";
				
			}
			if(!file_put_contents('../js/text_adver.js',$_js)){
				Tool::alertBack('警告：文字广告生成失败！');
			}

			Tool::alertLocation('恭喜：文字广告生成成功！','?action=show');
		}
		
		//show
		private function show() {
			parent::page($this->_model->getAdverTotal());
			$this->_tpl->assign('show',true);
			$this->_tpl->assign('title','广告图列表');
			$_object=$this->_model->getAllAdver();
			Tool::subStr($_object,'link',20,'utf-8');
			if($_object){
				foreach($_object as $_value){
					switch($_value->type){
						case 1:
							$_value->type='文字广告';
							break;
						case 2:
							$_value->type='头部广告（690x80）';
							break;
						case 3:
							$_value->type='侧栏广告（270x200）';
							break;
					}
					if(empty($_value->state)){
						$_value->state='<span class="red">[否]</span>| <a href="adver.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
					}else{
						$_value->state='<span class="green">[是]</span>| <a href="adver.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
					}
				}
			}
			$this->_tpl->assign('AllAdver',$_object);
		}
		
		//state
		private function state() {
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				if (!$this->_model->getOneAdver()) Tool::alertBack('警告：不存在此轮播！');
				if ($_GET['type'] == 'ok') {
					$this->_model->setStateOK() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：设置设置广告图失败！');
				} elseif ($_GET['type'] == 'cancel') {
					$this->_model->setStateCancel() ? Tool::alertLocation(null,PREV_URL) : Tool::alertBack('警告：取消广告图失败！');
				} else {
					Tool::alertBack('警告：非法操作！');
				}
			} else {
				Tool::alertBack('警告：非法操作！');
			}
		}

		//add
		private function add() {
			if(isset($_POST['send'])){
				if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不得为空！');
				if (Validate::checkLength($_POST['title'],2,'min')) Tool::alertBack('警告：标题长度不得小于两位！');
				if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题长度不得大于20位！');
				if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空！');
				if($_POST['type']=='2' || $_POST['type']=='3'){
					if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：广告图不得为空！');
				}
				if (Validate::checkLength($_POST['title'],200,'max')) Tool::alertBack('警告：描述长度不得大于200位！');
				$this->_model->title=$_POST['title'];
				$this->_model->link=$_POST['link'];
				$this->_model->thumbnail=$_POST['thumbnail'];
				$this->_model->type=$_POST['type'];
				$this->_model->state=$_POST['state'];
				$this->_model->info=$_POST['info'];
				$this->_model-> addAdver() ? Tool::alertLocation('恭喜：新增广告成功！','?action=show') : Tool::alertBack('很遗憾：新增广告失败！');
			}
			$this->_tpl->assign('add',true);
			$this->_tpl->assign('title','新增广告图');
			$this->_tpl->assign('prev_url',PREV_URL);
		}
		
				//update
		private function update() {
			if (isset($_POST['send'])) {
				if (Validate::checkNull($_POST['title'])) Tool::alertBack('警告：标题不得为空！');
				if (Validate::checkLength($_POST['title'],2,'min')) Tool::alertBack('警告：标题长度不得小于两位！');
				if (Validate::checkLength($_POST['title'],20,'max')) Tool::alertBack('警告：标题长度不得大于二十位！');
				if (Validate::checkNull($_POST['link'])) Tool::alertBack('警告：链接不得为空！');
				if ($_POST['type'] == '2' || $_POST['type'] == '3') {
					if (Validate::checkNull($_POST['thumbnail'])) Tool::alertBack('警告：广告图片不得为空！');
				}
				if (Validate::checkLength($_POST['info'],200,'max')) Tool::alertBack('警告：描述长度不得大于两百位！');
				
				$this->_model->id = $_POST['id'];
				$this->_model->title = $_POST['title'];
				$this->_model->type = $_POST['type'];
				$this->_model->thumbnail = $_POST['thumbnail'];
				$this->_model->link = $_POST['link'];
				$this->_model->info = $_POST['info'];
				$this->_model->state = $_POST['state'];
				
				$this->_model->updateAdver() ? Tool::alertLocation('恭喜，修改广告成功！',$_POST['prev_url']) : Tool::alertBack('很遗憾，修改广告失败！');
				
				
			}
			if (isset($_GET['id'])) {
				$this->_model->id = $_GET['id'];
				$_adver = $this->_model->getOneAdver();
				if (!$_adver) Tool::alertBack('警告：不存在此广告！');
				$this->_tpl->assign('id',$_adver->id);
				$this->_tpl->assign('titlec',$_adver->title);
				$this->_tpl->assign('info',$_adver->info);
				$this->_tpl->assign('link',$_adver->link);
				$this->_tpl->assign('thumbnail',$_adver->thumbnail);
				$this->_tpl->assign('prev_url',PREV_URL);
				$this->_tpl->assign('update',true);
				$this->_tpl->assign('title','修改广告图');
				switch ($_adver->type) {
					case 1 :
						$this->_tpl->assign('type1','checked="checked"');
						$this->_tpl->assign('pic','style="display:none"');
						break;
					case 2 :
						$this->_tpl->assign('type2','checked="checked"');
						$this->_tpl->assign('pic','style="display:block"');
						$this->_tpl->assign('up',"<input type=\"button\" value=\"上传头部广告690x80\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=690x80','upfile','400','100')\" />");
						break;
					case 3 :
						$this->_tpl->assign('type3','checked="checked"');
						$this->_tpl->assign('pic','style="display:block"');
						$this->_tpl->assign('up',"<input type=\"button\" value=\"上传侧栏广告270x200\" onclick=\"centerWindow('../config/upfile.php?type=adver&size=270x200','upfile','400','100')\" />");
						break;		
				}
				if (empty($_adver->state)) {
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
				$this->_model->deleteAdver() ? Tool::alertLocation('恭喜你，删除广告成功！', PREV_URL) : Tool::alertBack('很遗憾，删除广告失败！');
			} else {
				Tool::alertBack('非法操作！');
			}
		}
		
	}
?>