<?php
namespace Admin\Controller;
use Think\Controller;
class EditController extends Controller {
    public function lst(){
        $this->display();
	}
    public function inset(){
        if($_POST['zz']){
            $date['fl']=$_POST['fl'];
            $date['zz']=$_POST['zz'];
        }else {
            $this->error("添加失败！",'Index/index');
        }
        if($_POST['bt']){
                $date['bt']=$_POST['bt'];
            }else{
            $this->error("添加失败！",'Index/index');
        }
        if($_POST['nr']){
            $date['zy']=$_POST['zy'];
            $date['nr']=$_POST['nr'];
            }else{
            $this->error("添加失败！",'Index/index');
        }
        $fp=$_FILES['tp']['tmp_name'];
        $date['tp']=addslashes(fread($fp,filesize($_FILES['tp']['tmp_name'])));
        $a=M('wenzhang')->add($date);
        if($a) {
            $this->success("添加成功！",'Index/index');
        }else{
            $this->error("添加失败！",'Index/index');
        }
    }
    public function edt(){
        $this->display();
    }
    public function del(){
        $this->display();
    }
}
