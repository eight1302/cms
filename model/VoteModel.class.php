<?php
//投票实体类
class VoteModel extends Model {
    private $id;
    private $title;
    private $info;
    private $vid;
    private $connt;
    private $state;

    //拦截器(__set)
    private function __set($_key, $_value) {
        $this->$_key = Tool::mysqlString($_value);
    }

    //拦截器(__get)
    private function __get($_key) {
        return $this->$_key;
    }


    //获取总票数
    public function getVoteSum() {
        $_sql = "SELECT
											SUM(connt) c
								FROM 
											cms_vote 
							WHERE 
											vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
        return parent::one($_sql);
    }

    //累计投票
    public function setCount() {
        $_sql = "UPDATE
											cms_vote 
								SET 
											connt=connt+1
							WHERE 
											id='$this->id'";
        return parent::aud($_sql);
    }

    //获取首选标题
    public function getVoteTitle() {
        $_sql = "SELECT
											title 
								FROM 
											cms_vote 
							WHERE 
											state=1 
								LIMIT 
											1";
        return parent::one($_sql);
    }

    //获取首选的项目
    public function getVoteItem() {
        $_sql = "SELECT
											id,
											title,
											connt
								FROM 
											cms_vote 
							WHERE 
											vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
        return parent::all($_sql);
    }

    //取消投票首选
    public function setStateCancel() {
        $_sql = "UPDATE
											cms_vote 
								SET 
											state=0 
							WHERE 
											state=1
								LIMIT 
											1";
        return parent::aud($_sql);
    }

    //确定投票首选
    public function setStateOK() {
        $_sql = "UPDATE
											cms_vote 
								SET 
											state=1 
							WHERE 
											id='$this->id' 
								LIMIT 
											1";
        return parent::aud($_sql);
    }


    //查询单个
    public function getOneVote() {
        $_sql = "SELECT
											id,
											title,
											info
								FROM 
											cms_vote 
							WHERE 
											id='$this->id' 
								LIMIT 
											1";
        return parent::one($_sql);
    }


    //获取投票项目总记录
    public function getChildVoteTotal() {
        $_sql = "SELECT
											COUNT(*) 
								FROM 
											cms_vote
								WHERE
											vid=$this->id";
        return parent::total($_sql);
    }

    //查询所有投票项目，带limit
    public function getAllChildVote() {
        $_sql = "SELECT
											id,
											title,
											connt
								FROM 
											cms_vote
							WHERE
											vid='$this->id'
							ORDER BY
											date DESC
								$this->limit";
        return parent::all($_sql);
    }


    //获取投票主题总记录
    public function getVoteTotal() {
        $_sql = "SELECT
											COUNT(*) 
								FROM 
											cms_vote
								WHERE
											vid=0";
        return parent::total($_sql);
    }

    //查询所有投票主题，带limit
    public function getAllVote() {
        $_sql = "SELECT
											c.id,
											c.title,
											c.state,
											(SELECT SUM(connt) FROM cms_vote WHERE vid=c.id) pcount
								FROM 
											cms_vote c
							WHERE
											c.vid=0
							ORDER BY
											c.date DESC
								$this->limit";
        return parent::all($_sql);
    }

    //新增
    public function addVote() {
        $_sql = "INSERT INTO
												cms_vote (
																				title,
																				info,
																				vid,
																				date
																		) 
														VALUES (
																				'$this->title',
																				'$this->info',
																				'$this->vid',
																				NOW()
																		)";
        return parent::aud($_sql);
    }

    //修改
    public function updateVote() {
        $_sql = "UPDATE
											cms_vote 
								  SET 
											title='$this->title',
											info='$this->info' 
							WHERE 
											id='$this->id' 
								 LIMIT 
											1";
        return parent::aud($_sql);
    }


    //删除
    public function deleteVote() {
        $_sql ="DELETE FROM
														cms_vote 
										WHERE 
														id='$this->id' 
												OR
														vid='$this->id'";
        return parent::aud($_sql);
    }

}
?>