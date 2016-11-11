<?php
//友情链接实体类
class LinkModel extends Model {
    private $id;
    private $webname;
    private $weburl;
    private $logourl;
    private $user;
    private $type;
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
    //所有文字链接
    public function getAllTextLink(){
        $_sql="SELECT
                    webname,
                    weburl
                FROM
                    cms_link
                WHERE
                    state=1
                AND
                    type=1
                ORDER BY
                    date DESC";
        return parent::all($_sql);
    }
    //所有logo链接
    public function getAllLogoLink(){
        $_sql="SELECT
                  webname,
                  weburl,
                  logourl
                FROM
                    cms_link
                WHERE
                    state=1
                AND
                    type=2
                ORDER BY
                    date DESC";
        return parent::all($_sql);
    }

    //前20个文字链接
    public function getTwentyTextLink(){
        $_sql="SELECT
                    webname,
                    weburl
                FROM
                    cms_link
                WHERE
                    state=1
                AND
                    type=1
                ORDER BY
                    date DESC
                LIMIT
                    0,20";
        return parent::all($_sql);
    }
    //前9个logo链接
    public function getNineLogoLink(){
        $_sql="SELECT
                  webname,
                  weburl,
                  logourl
                FROM
                    cms_link
                WHERE
                    state=1
                AND
                    type=2
                ORDER BY
                    date DESC
                LIMIT
                    0,9";
        return parent::all($_sql);
    }

    //修改
    public function updateLevel() {
        $_sql = "UPDATE
							cms_level
						 SET
							level_name='$this->level_name',
							level_info='$this->level_info'
						WHERE
							id='$this->id'
						LIMIT
							1";
        return parent::aud($_sql);
    }
    //查找单一轮播
    public function getOneLink() {
        $_sql = "SELECT
						id,
						webname,
						weburl,
						logourl,
						user,
						type,
						state
                    FROM
						cms_link
					WHERE
						id='$this->id'
					LIMIT
						1";
        return parent::one($_sql);
    }

    //确定轮播器
    public function setStateOK() {
        $_sql = "UPDATE
						cms_link
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
						cms_link
					SET
						state=0
					WHERE
						id='$this->id'
					LIMIT
						1";
        return parent::aud($_sql);
    }
    //获取等级总记录
    public function getLinkTotal() {
        $_sql = "SELECT
							COUNT(*)
					   FROM
							cms_link";
        return parent::total($_sql);
    }
    //查询所有等级，带limit
    public function getAllLimitLink() {
        $_sql = "SELECT
							id,
							webname,
							weburl,
							weburl fullweburl,
							logourl,
							logourl fulllogourl,
							user,
							type,
							state
						FROM
							cms_link
						ORDER BY
							id DESC
						$this->limit";
        return parent::all($_sql);
    }

//新增
    public function addLink() {
        $_sql = "INSERT INTO
								cms_link (
											webname,
											weburl,
											logourl,
											user,
											type,
											state,
											date
										)
								VALUES (
											'$this->webname',
											'$this->weburl',
											'$this->logourl',
											'$this->user',
											'$this->type',
											'$this->state',
											NOW()
										)";
        return parent::aud($_sql);
    }

//删除
    public function deleteLink() {
        $_sql ="DELETE FROM
							cms_link
						WHERE
							id='$this->id'";
        return parent::aud($_sql);
    }
    //修改
    public function updateLink() {
        $_sql = "UPDATE
							cms_link
						 SET
							webname='$this->webname',
							weburl='$this->weburl',
							logourl='$this->logourl',
							state='$this->state',
							user='$this->user',
							type='$this->type'
						WHERE
							id='$this->id'
						LIMIT
							1";
        return parent::aud($_sql);
    }
}
?>