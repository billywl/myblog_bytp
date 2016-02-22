<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	/**
	 * 登录方法,如果有提交信息则验证,没有则进入登录界面
	 */
	public function login(){
		if($_POST){
			//校对验证码			
			$code=$_POST['verify'];
			if(!check_verify($code)){
				$this->error('验证码错误','login',2);				
			}
			
			//user authentication用户验证
			$username=isset($_POST['username'])?$_POST['username']:'';
			$password=isset($_POST['password'])?$_POST['password']:'';
			
			// data validation数据合法性验证
			if(empty($username)||empty($password)){
				//missing data,return 信息不完整,返回到登录界面
				$this->error('账号密码不能为空','login',2);
			}
			
			//用户信息检查
			$adminmodel = D('Admin');
			if(!$adminmodel->checkLogin($username,$password)){
				$this->error('账号密码错误','login',2);
			}
			$this->redirect('index/index');
			
			
		}

		$this->display();
	}
	//$this->success('登录成功','../index/index',2);
	public function verify(){
		//生成验证码对象
		$verify = new \Think\Verify();
		//指定验证码字体为12像素
		$verify->fontSize=12;
		//关闭干扰点和线
		$verify->useNoise = false;
		$verify->useCurve = false;
		$verify->length=4;
		//创建验证码图片
		$verify->entry();
	}
	
	/**
	 * 退出返回登录界面并清除session
	 */
	public function logout(){
		//清空session
		session('a_id',null);
		$this->redirect('login/login');
	}
}