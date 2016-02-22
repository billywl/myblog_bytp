<?php
namespace Admin\Controller;
use Think\Controller;
class CheckController extends Controller {
	/**
	 * 类的初始化函数,如果没有登录,跳转到登录界面
	 */
	public function _initialize(){
		if(!$this->isLogin()){
			$this->redirect('login/login');
		}		
	}
	/**
	 * 判断是否登录
	 * @return 登录了返回true,没登录返回false 
	 */
	private function isLogin(){
		return  isset($_SESSION['a_id'])&& $_SESSION['a_id']>0;
	}
}