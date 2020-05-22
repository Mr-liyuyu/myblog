<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $data=M('wenzhang')->select();
        $this->assign('wenz',$data);
        $this->display();
	}
	public function about(){
        echo "本站作者：李生<br/>";
        echo "创建时间：2020/5/20<br/>";
        echo "创作声明：本站大部分资源来自互联网如有侵权请联系删除！<br/>";
        }
    public function read(){
        $this->display();
        }
}
