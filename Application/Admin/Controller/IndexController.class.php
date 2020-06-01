<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        session_start();
        if($_SESSION['admin']['name']=='lizhun'&&$_SESSION['admin']['psd']=='qq6799278') {
            $this->display();
        }else{
            $this->error("请先登录！",'/Public/login.html');
        }
	}
	public function logon(){
        if($_POST['name']=='lizhun'&&$_POST['psd']=='qq6799278'){
            session_start();
            $_SESSION['admin']['name']=$_POST['name'];
            $_SESSION['admin']['psd']=$_POST['psd'];
            $this->success("登录成功！",'index');
        }else{
            $this->error("登录失败！",'/Public/login.html');
        }
    }
}
