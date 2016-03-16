<?php
namespace Admin\Controller;
//use Admin\Controller\CheckController;
class IndexController extends CheckController {
	public function index(){
		$this->display();
	}
	
	public function left(){
		$auth=M('auth');
		$topAuth=$auth->where('au_level=0')->field('au_id,au_name')->select();
		$subAuth=$auth->where('au_level=1')->select();
		$this->assign('topAuth',$topAuth);
		$this->assign('subAuth',$subAuth); 
		$this->display();
	}
}