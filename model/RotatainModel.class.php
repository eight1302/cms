<?php
	//轮播器实体类
	class RotatainModel extends Model {
		private $id;
		private $thumbnail;
		private $link;
		private $title;
		private $info;
		private $state;
		private $limit;
		
		//拦截器(__set)
		private function __set($_key, $_value) {
			$this->$_key = Tool::mysqlString($_value);
		}
		
		//拦截器(__get)
		private function __get($_key) {
			return $this->$_key;
		}
		
		
		//获取系统指定的个数，最新的轮播器
		public function getNewRotatain() {
			$_sql = "SELECT 
											title,
											thumbnail,
											link 
								FROM 
											cms_rotatain 
							WHERE 
											state=1 
						ORDER BY
											date DESC 
								LIMIT 
											0,".RO_NUM;
			return parent::all($_sql);
		}
		
		//查找单一轮播
		public function getOneRotatain() {
			$_sql = "SELECT 
											id,
											title,
											link,
											info,
											thumbnail,
											state 
								FROM 
											cms_rotatain
							WHERE 
											id='$this->id' 
								LIMIT 
											1";
			return parent::one($_sql);
		}
		
		//确定轮播器
		public function setStateOK() {
			$_sql = "UPDATE 
											cms_rotatain 
								SET 
											state=1 
							WHERE 
											id='$this->id' 
								LIMIT 
											1";
			return parent::aud($_sql);
		}
		
		//取消轮播器
		public function setStateCancel() {
			$_sql = "UPDATE 
											cms_rotatain 
								SET 
											state=0 
							WHERE 
											id='$this->id' 
								LIMIT 
											1";
			return parent::aud($_sql);
		}
		
		
		//获取轮播器总记录
		public function getRotatainTotal() {
			$_sql = "SELECT 
										COUNT(*) 
								FROM 
										cms_rotatain";
			return parent::total($_sql);
		}
		
		//查询所有的轮播器
		public function getAllRotatain() {
			$_sql = "SELECT 
												id,
												title,
												link,
												link full,
												state 
								FROM 
												cms_rotatain
							ORDER BY
												state DESC,date DESC
									$this->limit";
			return parent::all($_sql);
		}
		
		//新增轮播器
		public function addRotatain() {
			$_sql = "INSERT INTO 
												cms_rotatain (
																				thumbnail,
																				info,
																				title,
																				link,
																				state,
																				date
																		) 
														VALUES (
																				'$this->thumbnail',
																				'$this->info',
																				'$this->title',
																				'$this->link',
																				1,
																				NOW()
																		)";
			return parent::aud($_sql);
		}
		
		//修改
		public function updateRotatain() {
			$_sql = "UPDATE 
											cms_rotatain 
								  SET 
											thumbnail='$this->thumbnail',
											info='$this->info',
											title='$this->title',
											link='$this->link',
											state='$this->state'
							WHERE 
											id='$this->id' 
								 LIMIT 
											1";
			return parent::aud($_sql);
		}
		
		//删除
		public function deleteRotatain() {
			$_sql ="DELETE FROM 
														cms_rotatain
										WHERE 
														id='$this->id' 
										LIMIT 
														1";
			return parent::aud($_sql);
		}
	}
?>