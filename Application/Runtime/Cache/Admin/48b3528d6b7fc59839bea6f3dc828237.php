<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<title>天启 - 个人博客管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="天启个人博客管理中心" />
<meta name="keywords" content="天启,个人博客管理中心" />
<link rel="stylesheet" type="text/css" href="/Style/skin.css" />
<script src="/Js/public.js" type="text/javascript"></script>
<script>
function prevent(event) {
	if(window.event) {
		//对于ie
		window.event.returnValue=false;
	} else {
		//对于w3c
		event.preventDefault();
	}
}

window.onload = function(){
	$('btnLogin').onclick = function(event){
		//当username为空时,取消submit的按钮的提交
		if ($('username').value == ''||$('password').value == '') {
			//调用取消函数
			prevent(event);
			alert('账号密码不能为空!');
		}
	}
}
</script>
</head>
<body>
	<table width="100%">
		<!-- 顶部部分 -->
		<tr height="41">
			<td colspan="2" background="/Images/login_top_bg.gif">&nbsp;</td>
		</tr>
		<!-- 主体部分 -->
		<tr style="background: url(/Images/login_bg.jpg) repeat-x;"
			height="532">
			<!-- 主体左部分 -->
			<td id="left_cont">
				<table width="100%" height="100%">
					<tr height="155">
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="20%" rowspan="2">&nbsp;</td>
						<td width="60%">
							<table width="100%">
								<tr height="70">
									<td align="right"></td>
								</tr>
							</table>
							<td width="15%" rowspan="2">&nbsp;</td>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</td>
			<!-- 主体右部分 -->
			<td id="right_cont">
				<table height="100%">
					<tr height="30%">
						<td colspan="3">&nbsp;</td>
					</tr>
					<tr>
						<td width="30%" rowspan="5">&nbsp;</td>
						<td valign="top" id="form">
							<form action="/admin.php/Login/login" method="post">
								<table valign="top" width="50%">
									<tr>
										<td colspan="2"><h4
												style="letter-spacing: 1px; font-size: 16px;">天启个人博客管理中心</h4></td>
									</tr>
									<tr>
										<td>管理员：</td>
										<td><input type="text" name="username" value="" id="username" /></td>
									</tr>
									<tr>
										<td>密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>
										<td><input type="password" name="password" value="" id="password" /></td>
									</tr>
									<tr>
										<td>验证码：</td>
										<td><input type="text" id='captcha' name="verify" value=""
											style="width: 50px;" /><img src="/admin.php/Login/verify" alt="验证码"
											onclick="this.src='/admin.php/Login/verify/'+Math.random()"
											title="点击更换验证码" style="vertical-align: middle" /></td>
									</tr>
									<tr class="bt" align="center">
										<td>&nbsp;<input type="submit" id='btnLogin' value="登陆" /></td>
										<td>&nbsp;<input type="reset" value="重填" /></td>
									</tr>
								</table>
							</form>
						</td>
						<td rowspan="5">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<!-- 底部部分 -->
		<tr id="login_bot">
			<td colspan="2"><p>Copyright © 天启个人博客管理中心</p></td>
		</tr>
	</table>
</body>
</html>