<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/Style/skin.css" />
    <script type="text/javascript">
        function logout() {
            if(window.confirm('您确定要退出吗？')) {
                top.location = '/admin.php/login/logout';
            }
        }    
        function homePage() {
                top.location = 'http://www.mynote2.com';
        }      
    </script>
</head>
    <body>
        <table cellpadding="0" width="100%" height="64" background="/Images/top_top_bg.gif">
            <tr valign="top">
                <td width="50%"><a href="javascript:void(0)"><img style="border:none" src="/Images/me.jpg" /></a></td>
                <td width="30%" style="padding-top:13px;font:15px Arial,SimSun,sans-serif;color:#FFF">管理员：<b><?php echo (session('a_username')); ?></b> 欢迎使用天启的个人博客管理系统!</td>
                <td style="padding-top:10px;" align="center"><a href="javascript:void(0)"><img style="border:none" src="/Images/index.gif" onclick="homePage()" /></a></td> 
                <td style="padding-top:10px;" align="center"><a href="javascript:void(0)"><img style="border:none" src="/Images/out.gif" onclick="logout();" /></td>
            </tr>
        </table>
    </body>
</html>