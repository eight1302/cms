<?php
//权限实体类
class PremissionModel extends Model {
    private $id;
    private $name;
    private $info;
    private $limit;

    //拦截器(__set)
    private function __set($_key, $_value) {
        $this->$_key = Tool::mysqlString($_value);
    }

    //拦截器(__get)
    private function __get($_key) {
        return $this->$_key;
    }

    //修改
    public function updatePremission() {
        $_sql = "UPDATE
							cms_premission
						 SET
							name='$this->name',
							info='$this->info'
						WHERE
							id='$this->id'
						LIMIT
							1";
        return parent::aud($_sql);
    }
    //查询所有等级，带limit
    public function getAllLimitPremission() {
        $_sql = "SELECT
							id,
							name,
							info
						FROM
							cms_premission
						ORDER BY
							id DESC
						$this->limit";
        return parent::all($_sql);
    }
    //查询所有等级，不带limit
    public function getAllPremission() {
        $_sql = "SELECT
							id,
							name,
							info
						FROM
							cms_premission
						ORDER BY
							id ASC
						";
        return parent::all($_sql);
    }
    //获取等级总记录
    public function getPremissionTotal() {
        $_sql = "SELECT
							COUNT(*)
					   FROM
							cms_premission";
        return parent::total($_sql);
    }
    //查询单个
    public function getOnePremission() {
        $_sql = "SELECT
							id,
							name,
							info
						FROM
							cms_premission
					    WHERE
							id='$this->id'
						OR
							name='$this->name'
						LIMIT
							1";
        return parent::one($_sql);
    }
    //新增
    public function addPremission() {
        $_sql = "INSERT INTO
								cms_premission (
											name,
											info
										)
								VALUES (
											'$this->name',
											'$this->info'
										)";
        return parent::aud($_sql);
    }
    //删除
    public function deletePremission() {
        $_sql ="DELETE FROM
								cms_premission
							WHERE
								id='$this->id'
							LIMIT
								1";
        return parent::aud($_sql);
    }

}
?>