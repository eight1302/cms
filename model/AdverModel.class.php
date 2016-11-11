<?php
	//等级实体类
	class AdverModel extends Model {
		private $type;
		private $id;
		private $link;
		private $info;
		private $title;
		private $state;
		private $thumbnail;
		private $limit;
		
		//拦截器(__set)
		private function __set($_key, $_value) {
			$this->$_key = Tool::mysqlString($_value);
		}
		
		//拦截器(__get)
		private function __get($_key) {
			return $this->$_key;
		}
		
		//获取最新的N条广告
		public function getNewTextAdver(){
			$_sql="SELECT
						title,
						link
					FROM
						cms_adver
					WHERE
						state=1
					AND
						type=1
					ORDER BY
						date DESC
					LIMIT
						0,5";
			return parent::all($_sql);
		}
		//获取最新的N头部条广告
		public function getNewHeaderAdver(){
			$_sql="SELECT
						title,
						link,
						thumbnail
					FROM
						cms_adver
					WHERE
						state=1
					AND
						type=2
					ORDER BY
						date DESC
					LIMIT
						0,".ADVER_PIC_NUM;
			return parent::all($_sql);
		}
		//获取最新的N条侧栏广告
		public function getNewsidebarAdver(){
			$_sql="SELECT
						title,
						link,
						thumbnail
					FROM
						cms_adver
					WHERE
						state=1
					AND
						type=3
					ORDER BY
						date DESC
					LIMIT
							0,".ADVER_PIC_NUM;
			return parent::all($_sql);
		}

		//获取广告图总记录
		public function getAdverTotal() {
			$_sql = "SELECT 
							COUNT(*) 
					   FROM 
							cms_adver";
			return parent::total($_sql);
		}
		//查找单一广告图
		public function getOneAdver() {
			$_sql = "SELECT 
							id,
							title,
							link,
							thumbnail,
							info
					FROM 
							cms_adver
					WHERE 
							id='$this->id' 
					LIMIT 
							1";
			return parent::one($_sql);
		}

		//确定广告图
		public function setStateOK() {
			$_sql = "UPDATE 
							cms_adver 
				     	SET 
							state=1 
			          WHERE 
							id='$this->id' 
					  LIMIT 
							1";
			return parent::aud($_sql);
		}
		
		//取消广告图
		public function setStateCancel() {
			$_sql = "UPDATE 
							cms_adver 
						SET 
							state=0 
						WHERE 
							id='$this->id' 
						LIMIT 
							1";
			return parent::aud($_sql);
		}
		

		//查询所有广告图
		public function getAllAdver() {
			$_sql = "SELECT 
							id,
							title,
							link,
							type,
							state
						FROM 
							cms_adver
						ORDER BY
							date DESC
						$this->limit";
			return parent::all($_sql);
		}

		//新增
		public function addAdver() {
			$_sql = "INSERT INTO 
								cms_adver (
											title,
											link,
											thumbnail,
											info,
											type,
											state,
											date
										) 
								VALUES (
											'$this->title',
											'$this->link',
											'$this->thumbnail',
											'$this->info',
											'$this->type',
											1,
											NOW()
										)";
			return parent::aud($_sql);
		}

		//修改
		public function updateAdver() {
			$_sql = "UPDATE 
							cms_adver 
						SET 
							title='$this->title',
							state='$this->state',
							link='$this->link',
							info='$this->info',
							thumbnail='$this->thumbnail',
							type='$this->type'	
					 WHERE 
							id='$this->id' 
					  LIMIT 
							1";
			return parent::aud($_sql);
		}
		
		//删除
		public function deleteAdver() {
			$_sql ="DELETE FROM 
								cms_adver
							WHERE 
								id='$this->id' 
							LIMIT 
								1";
			return parent::aud($_sql);
		}
	}
?>