<?php
namespace Admin\Controller;
class RoleController extends CheckController {
	/**
	 * 添加角色页面
	 */
	public function addRole(){
		//没有post就加载添加角色页面
		if(!$_POST){
			$auth=M('auth');
			$top=$auth->where('au_level=0')->select();
			$sub=$auth->where('au_level=1')->select();
			$this->assign('top',$top);
			$this->assign('sub',$sub);
			$this->display();	
		}
	}
}