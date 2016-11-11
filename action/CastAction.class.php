<?php
class CastAction extends Action {

    //构造方法，初始化
    public function __construct(&$_tpl) {
        parent::__construct($_tpl, new VoteModel());
    }

    //执行
    public function _action() {
        $this->setCount();
        $this->getVote();
    }

    //获取投票
    private function getVote() {
        $_vote = new VoteModel();
        $_sum = $_vote->getVoteSum()->c;
        $_width = 400;
        $this->_tpl->assign('vote_title',$_vote->getVoteTitle()->title);
        $this->_tpl->assign('width',$_width);
        $_object = $_vote->getVoteItem();
        if ($_object) {
            $_i = 1;
            foreach ($_object as $_value) {
                $_value->percent = round($_value->connt / $_sum * 100,2) . '%';
                $_value->picwidth = $_value->connt / $_sum * $_width;
                $_value->picnum = $_i;
                $_i++;
            }
        }
        $this->_tpl->assign('vote_item',$_object);

    }

    //累计
    private function setCount() {
        if (isset($_POST['send'])) {
            if (empty($_POST['vote'])) {
                Tool::alertClose('警告：请选择一个投票项目！');
            }
            if ($_COOKIE['ip'] == $_SERVER["REMOTE_ADDR"]) {
                if (time() - $_COOKIE['time'] < 86400) {
                    Tool::alertLocation('警告：您已经参与了本投票，请不要重复投票！','cast.php');
                }
            }
            $this->_model->id = $_POST['vote'];
            $this->_model->setCount();
            setcookie('ip',$_SERVER["REMOTE_ADDR"]);
            setcookie('time',time());
            Tool::alertLocation('恭喜，累计投票成功，感谢您的参与！','cast.php');
        }
    }

}
?>