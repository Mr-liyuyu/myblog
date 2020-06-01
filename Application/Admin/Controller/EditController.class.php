<?php
namespace Admin\Controller;

use Think\Controller;
class EditController extends Controller {
    public function lst(){
        session_start();
        if($_SESSION['admin']['name']=='lizhun'&&$_SESSION['admin']['psd']=='qq6799278') {
            if(isset($_GET['num'])){
                $data['num']=$_GET['num'];
            }else{
                $data['num']=0;
            }
            $data = M('wenzhang')->order("id desc")->limit($data['num'] * 10, 10)->select();
            if($data[0]['id']==null){
                $this->error("没找到文章！","./lst");
            }
            $count=M('wenzhang')->count();
            $numb=$data['num']+1;
            if(($count % 10)>0){
                $page=(int)($count/10);
                $page++;
            }else{
                $page=$count/10;
            }
            $a=$data['id'];
            array_map(stripcslashes,$data);
            $data['id']=$a;
            $this->assign('count',$count);
            $this->assign('numb',$numb);
            $this->assign('page',$page);
            $this->assign('wenz',$data);
            $this->display();
        }else{
            $this->error("请先登录！",'/Public/login.html');
        }
	}
    public function inset(){
        session_start();
        if($_SESSION['admin']['name']=='lizhun'&&$_SESSION['admin']['psd']=='qq6799278') {
            if ($_POST['zz']) {
                $data['fl'] = addslashes($_POST['fl']);
                $data['zz'] = addslashes($_POST['zz']);
            } else {
                $this->error("添加失败！", './lst');
            }
            if ($_POST['bt']) {
                $data['bt'] = addslashes($_POST['bt']);
            } else {
                $this->error("添加失败！", './lst');
            }
            if ($_POST['nr']) {
                $data['zy'] = addslashes(mb_substr($_POST['nr'],0,50));
                $data['nr'] = addslashes($_POST['nr']);
            } else {
                $this->error("添加失败！", './lst');
            }
            $data['rq'] = addslashes(date('Y/m/d'));
            $a = M('wenzhang')->add($data);
            if ($a) {
                $name = $a . ".jpg";
                move_uploaded_file($_FILES['tp']['tmp_name'],"/var/www/html/Public/" . $name);
                M("wenzhang")->where("id={$a}")->setField("tp", addslashes($name));
                $this->success("添加成功！", './lst');
            } else {
                $this->error("添加失败！", './lst');
            }
        }else {
            $this->error("请先登录！",'/Public/login.html');
        }
    }
    public function del(){
        session_start();
        if($_SESSION['admin']['name']=='lizhun'&&$_SESSION['admin']['psd']=='qq6799278') {
            if(isset($_GET)){
                if(M('wenzhang')->delete($_GET['id'])){
                    $this->success('删除成功！','./lst');
                }else{
                    $this->error('操作失败！',"./lst");
                }
            }elseif(isset($_POST)){
                for($a=0;$a<10;$a++){
                    $str='num'.$a;
                    if($_POST[$str]){
                        M('wenzhang')->delete($_POST[$str]);
                    }
                }
            }
        }else {
            $this->error("请先登录！",'/Public/login.html');
        }
    }
}
