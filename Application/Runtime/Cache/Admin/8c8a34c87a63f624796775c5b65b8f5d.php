<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/Style/skin.css" />
</head>
    <body>
        <table width="100%" height="550"border="0" cellpadding="0" cellspacing="0">
            <!-- 头部开始 -->
            <tr>
                <td width="17" valign="top" background="/Images/mail_left_bg.gif">
                    <img src="/Images/left_top_right.gif" width="17" height="29" />
                </td>
                <td valign="top" background="/Images/content_bg.gif">
                    <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" background="/Images/content_bg.gif">
                        <tr><td height="31"><div class="title">欢迎界面</div></td></tr>
                    </table>
                </td>
                <td width="16" valign="top" background="/Images/mail_right_bg.gif"><img src="/Images/nav_right_bg.gif" width="16" height="29" /></td>
            </tr>
            <!-- 中间部分开始 -->
            <tr>
                <!--第一行左边框-->
                <td valign="middle" background="/Images/mail_left_bg.gif">&nbsp;</td>
                <!--第一行中间内容-->
                <td valign="top" bgcolor="#F7F8F9">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <!-- 空白行-->
                        <tr><td colspan="2" valign="top">&nbsp;</td><td>&nbsp;</td><td valign="top">&nbsp;</td></tr>

                        <tr>
                            <!--左边内容-->
                            <td colspan="2" valign="top">
                                <h3 style="margin:0 0 10px 10px;">感谢使用 天启的个人博客 网站管理系统</h3>
                                <img src="/Images/ts.gif" width="16" height="16" style="margin-left:10px;"> 提示：<br />
                                <p style="text-indent:20px;line-height:25px;margin-left:10px;font-size:15px;">您上次登录的ip为<?php echo (session('a_ip')); ?>!</p>
                                <p style="text-indent:20px;line-height:25px;margin-left:10px;font-size:15px;">您上次登录登录时间为<?php echo (session('a_time')); ?>!</p>
					  <p style="text-indent:20px;line-height:25px;margin-left:10px;font-size:15px;">如果您有任何疑问请QQ联系超级管理员183692566</p>                           
                            </td>
                            <!--间隔-->
                            <td width="7%">&nbsp;</td>
                            <!--右边内容-->
                            <td width="40%" valign="top">

                            </td>
                        </tr>
                        <tr height="20"><td colspan="2" valign="top">&nbsp;</td><td>&nbsp;</td><td valign="top">&nbsp;</td></tr>
                        <!--第二行-->
                        <tr>
                            <td colspan="2" valign="top">
                                <table width="100%" height="230" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC;">
                                    <tr>
                                        <td width="7%" background="/Images/news_title_bg.gif">
                                            <img src="/Images/news_title_bg.gif" width="2" height="27">
                                        </td>
                                        <td width="93%" background="/Images/news_title_bg.gif" class="left_bt">最新动态</td>
                                    </tr>
                                    <tr>
                                        <td height="186" valign="top" colspan="2"></td>
                                    </tr>
                                    <tr><td height="5" colspan="2">&nbsp;</td></tr>
                                </table>
                            </td>
                            <td>&nbsp;</td>
                            <td valign="top">

                            </td>
                        </tr>
                        <tr>
                            <td height="40" colspan="4">
                            </td>
                        </tr>
                    </table>
                </td>
                <td background="/Images/mail_right_bg.gif">&nbsp;</td>
            </tr>
            <!-- 底部部分 -->
            <tr>
                <td valign="bottom" background="/Images/mail_left_bg.gif">
                    <img src="/Images/buttom_left.gif" width="17" height="17" />
                </td>
                <td background="/Images/buttom_bgs.gif">
                    <img src="/Images/buttom_bgs.gif" width="17" height="17">
                </td>
                <td valign="bottom" background="/Images/mail_right_bg.gif">
                    <img src="/Images/buttom_right.gif" width="16" height="17" />
                </td>           
            </tr>
        </table>
    </body>
</html>