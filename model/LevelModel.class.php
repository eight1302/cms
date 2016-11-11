<?php
	//等级实体类
	class LevelModel extends Model {
		private $id;
		private $level_name;
		private $level_info;
		private $limit;
        private $premission;

		//拦截器(__set)
		private function __set($_key, $_value) {
			$this->$_key = Tool::mysqlString($_value);
		}

		//拦截器(__get)
		private function __get($_key) {
			return $this->$_key;
		}

		//获取等级总记录
		public function getLevelTotal() {
			$_sql = "SELECT
							COUNT(*)
					   FROM
							cms_level";
			return parent::total($_sql);
		}

		//查询单个
		public function getOneLevel() {
			$_sql = "SELECT
							id,
							level_name,
							level_info
						FROM
							cms_level
					    WHERE
							id='$this->id'
						OR
							level_name='$this->level_name'
						LIMIT
							1";
			return parent::one($_sql);
		}

		//查询所有等级，不带limit
		public function getAllLevel() {
			$_sql = "SELECT
							id,
							level_name,
							level_info
						FROM
							cms_level
					ORDER BY
							id DESC";
			return parent::all($_sql);
		}

		//查询所有等级，带limit
		public function getAllLimitLevel() {
			$_sql = "SELECT
							id,
							level_name,
							level_info,
							premission
						FROM
							cms_level
						ORDER BY
							id DESC
						$this->limit";
			return parent::all($_sql);
		}

		//新增
		public function addLevel() {
			$_sql = "INSERT INTO
								cms_level (
											level_name,
											level_info,
											premission
										)
								VALUES (
											'$this->level_name',
											'$this->level_info',
											premission='$this->premission'
										)";
			return parent::aud($_sql);
		}

		//修改
        public function updateLevel() {
            $_sql = "UPDATE
							cms_level
						 SET
							level_name='$this->level_name',
							level_info='$this->level_info',
							premission='$this->premission'
						WHERE
							id='$this->id'
						LIMIT
							1";
            return parent::aud($_sql);
        }

		//删除
		public function deleteLevel() {
			$_sql ="DELETE FROM
								cms_level
							WHERE
								id='$this->id'
							LIMIT
								1";
			return parent::aud($_sql);
		}

	}
?>