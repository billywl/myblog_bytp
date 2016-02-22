<?php
/**
 * 校对验证码函数
 * @param $code 接收到的验证码
 * @param string $id 
 * @return boolean 成功返回true,失败返回false
 */
function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}