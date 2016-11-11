<?php
	//评论实体类
	class CommentModel extends Model {
		private $user;
		private $manner;
		private $content;
		private $cid;
		private $limit;
		private $states;

		//拦截器(__set)
		private function __set($_key, $_value) {
			$this->$_key = Tool::mysqlString($_value);
		}
		
		//拦截器(__get)
		private function __get($_key) {
			return $this->$_key;
		}
		
		//批量审核
		public function setStates() {
			foreach ($this->states as $_key=>$_value) {
				if (!is_numeric($_value)) continue;
				if($_value>0) $_value=1;
				if($_value<0) $_value=0;
				$_sql .= "UPDATE cms_comment SET state='$_value' WHERE id='$_key';";
			}
			return parent::multi($_sql);
		}

		//通过审核
		public function setStateOK(){
			$_sql="UPDATE
						cms_comment
					SET
						state=1
					WHERE
						id='$this->id'
					LIMIT
						1";
			return parent::aud($_sql);
		}

		//取消通过审核
		public function setStateCancel(){
			$_sql="UPDATE
						cms_comment
					SET
						state=0
					WHERE
						id='$this->id'
					LIMIT
						1";
			return parent::aud($_sql);
		}

		//获取三条最火评论，如果妻子支持+反对=0，那么久不显示（前台）
		public function getHotThreeComment(){
			$_sql = "SELECT 	
							c.id,
							c.cid,
							c.user,
							c.manner,
							c.content,
							c.date,
							c.sustain,
							c.oppose,
							u.face 
						FROM 
							cms_comment c
					LEFT JOIN
							cms_user u
						ON
							c.user=u.user
						WHERE 
							c.state=1
						AND
							c.cid='$this->cid'
						AND
							c.sustain+c.oppose>0
						ORDER BY
							c.sustain+c.oppose DESC
						LIMIT
								0,3";
			return parent::all($_sql);
		}

		//获取最新三条评论（前台）
		public function getNewThreeComment() {
			$_sql = "SELECT 	
							c.id,
							c.cid,
							c.user,
							c.manner,
							c.content,
							c.date,
							c.sustain,
							c.oppose,
							u.face 
						FROM 
							cms_comment c
					LEFT JOIN
							cms_user u
						ON
							c.user=u.user
						WHERE 
							c.state=1
						AND
							c.cid='$this->cid'
						ORDER BY
							c.date DESC
						LIMIT
								0,3";
			return parent::all($_sql);
		}
		//获取评论总量（后台）
		public function getCommentListTotal() {
			$_sql = "SELECT 
							COUNT(*) 
					FROM 
							cms_comment 
					";
			return parent::total($_sql);
		}
		//获取评论总量(前台)
		public function getCommentTotal() {
			$_sql = "SELECT 
							COUNT(*) 
					FROM 
							cms_comment 
					WHERE 
							state=1
					  AND
							cid='$this->cid'";
			return parent::total($_sql);
		}
		
		//查找单一评论
		public function getOneComment() {
			$_sql = "SELECT 
							id 
						FROM 
							cms_comment
						WHERE 
							id='$this->id' 
						LIMIT 
							1";
			return parent::one($_sql);
		}
		
		//支持
		public function setSustain() {
			$_sql = "UPDATE 
							cms_comment 
						SET 
							sustain=sustain+1 
						WHERE 
							id='$this->id' 
						LIMIT 
							1";
			return parent::aud($_sql);
		}
		
		//反对
		public function setOppose() {
			$_sql = "UPDATE 
							cms_comment 
						SET 
							oppose=oppose+1 
						WHERE 
							id='$this->id' 
						LIMIT 
							1";
			return parent::aud($_sql);
		}
		
		//所有评论审核（后台）
		public function getCommentList(){
			$_sql="SELECT
						c.id,
						c.cid,
						c.user,
						c.content,
						c.content full,
						c.state,
						c.state num,
						ct.title
					FROM
						cms_comment c,
						cms_content ct
					WHERE
						c.cid=ct.id
					ORDER BY
						c.date DESC
						$this->limit";
			return parent::all($_sql);
		}
		//所有评论（前台）
		public function getAllComment() {
			$_sql = "SELECT 	
							c.id,
							c.cid,
							c.user,
							c.manner,
							c.content,
							c.date,
							c.sustain,
							c.oppose,
							u.face 
						FROM 
							cms_comment c
					LEFT JOIN
							cms_user u
						ON
							c.user=u.user
				   	 WHERE 
							c.state=1
					   AND
							c.cid='$this->cid'
					ORDER BY
							c.date DESC
							$this->limit";
			return parent::all($_sql);
		}
		
		//新增评论
		public function addComment() {
			$_sql = "INSERT INTO 
								cms_comment (
											user,
											manner,
											content,
											cid,
											date
												) 
										VALUES (
											'$this->user',
											'$this->manner',
											'$this->content',
											'$this->cid',
											NOW()
											)";
			return parent::aud($_sql);
		}

		//删除
		public function deleteComment() {
			$_sql ="DELETE FROM 
												cms_comment
										WHERE 
												id='$this->id' 
										LIMIT 1";
			return parent::aud($_sql);
		}
	}
?>