<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends Model {
	/**
	 * 登录校对
	 *
	 * @param string $username
	 *        	接收过来的帐号
	 * @param string $password
	 *        	接受过来的密码
	 */
	public function checkLogin($username, $password) {
		// 根据用户名查找密码
		$userInfo = $this->where ( "a_username='$username'" )->find ();
		if ($userInfo) {
			if (md5 ( md5 ( $password ) . $userInfo ['a_salt'] ) == $userInfo ['a_password']) {				
				//成功登录,获取信息到session				
				$_SESSION['a_username']=$userInfo['a_uname'];
				$_SESSION['a_id']=$userInfo['a_id'];			
				$_SESSION['a_ip']=$userInfo['a_last_log_ip'];
				$_SESSION['a_time']=date('Y年m月d日,H点i分',$userInfo['a_last_time']);
				
				//更新登录ip和时间
				$this->updateInfo($username);
				return true;
			}
		}
		return false;
	}
	
	/**
	 * 更新用户信息
	 */
	private function updateInfo($username){
		$time=time();
		$ip=$_SERVER['REMOTE_ADDR'];
		$this->a_last_time=$time;
		$this->a_last_log_ip=$ip;
		$this->where("a_username='$username'")->save();	
	}
	

}