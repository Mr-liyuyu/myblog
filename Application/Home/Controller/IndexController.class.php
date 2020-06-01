<?php
namespace Home\Controller;

use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $sq=M('wenzhang');
        if(isset($_GET['num'])){
            $data['num']=$_GET['num'];
        }else{
            $data['num']=0;
        }
        if(isset($_GET['fl'])){
            $fl=$_GET['fl'];
            $data=$sq->where("fl=$fl")->order("id desc")->limit($data['num']*10,10)->select();
        }else {
            $data = $sq->order("id desc")->limit($data['num'] * 10, 10)->select();
        }
        if($data[0]['id']==null){
            $this->error("没找到文章！","/");
        }
        $data=array_map(function($value){
			return array_map(stripcslashes,$value);
        },$data);
        $this->assign("fl",$fl);
        $this->assign('wenz',$data);
        $this->display();
	}
	public function about(){
        echo "本站作者：李生<br/>";
        echo "创建时间：2020/5/20<br/>";
	echo "作者qq：1124925896<br/>";
        echo "创作声明：本站大部分资源来自互联网如有侵权请联系删除！<br/>";
    }
    public function read(){
        $id=$_GET['id'];
        $id1=$id-1;
        $id2=$id+1;
        $sq=M('wenzhang');
        $data0=$sq->where("id=$id1")->select();
        $data1=$sq->where("id=$id")->select();
        $data2=$sq->where("id=$id2")->select();
        $data=$sq->order("id desc")->limit(10)->select();
        $data1=array_map(function($value){
                        return array_map(stripcslashes,$value);
        },$data1);
        $this->assign('wenz',$data);
        $this->assign('data0',$data0);
        $this->assign('data1',$data1);
        $this->assign('data2',$data2);
        $this->display();
    }
}
