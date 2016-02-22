<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/Style/skin.css" />
    <script src="/Ckeditor/ckeditor.js"></script> 
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
	$('btn').onclick = function(event){
		//当username为空时,取消submit的按钮的提交
		if ($('title').value == ''||$('topid').value == '') {
			//调用取消函数
			prevent(event);
			alert('标题和栏目不能为空!');
		}
	}
}
</script>
</head>
    <body>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <!-- 头部开始 -->
            <tr>
                <td width="17" valign="top" background="/Images/mail_left_bg.gif">
                    <img src="/Images/left_top_right.gif" width="17" height="29" />
                </td>
                <td valign="top" background="/Images/content_bg.gif">
                    <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" background="/Images/content_bg.gif">
                        <tr><td height="31"><div class="title">添加文章</div></td></tr>
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
                            <td colspan="4">
                                <table>
                                    <tr>
                                        <td width="100" align="center"><img src="/Images/mime.gif" /></td>
                                        <td valign="bottom"><h3 style="letter-spacing:1px;">添加文章页面</h3></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- 一条线 -->
                        <tr>
                            <td height="40" colspan="4">
                                <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tr><td></td></tr>
                                </table>
                            </td>
                        </tr>
                        <!-- 添加产品开始 -->
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="96%">
                                <table width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <form action="" method="post">
                                                <table width="100%"class="cont">
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td width="15%">文章标题：</td>
                                                        <td width="25%"><input class="text" type="text" name="title" id="title" value="" /></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>所属栏目：</td>
                                                        <td>
                                                            <select name='topid' id='topid'>
                                                                <option selected="true" value=''>请选择...</option>
                                                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($vo["pro_id"]); ?>'><?php echo ($vo["pro_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                            </select>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>是否推荐</td>
                                                        <td>
										<input  type="checkbox" name="recommend" value="1" />推荐
                                                        </td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                     <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>作者：</td>
                                                        <td width="20%"><input class="text" type="text" name="writer" value="天启" /></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>                
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>来源：</td>
                                                        <td width="20%"><input class="text" type="text" name="source" value="原创" /></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>     
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>文章简介：</td>
                                                        <td width="20%"><textarea name='description' ></textarea></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>         
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>关键字：</td>
                                                        <td width="60%"><input class="text" type="text" name="keyword" value="" />多个词之间用逗号分隔</td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>文章内容：</td>
                                                        <td width="60%"><textarea name='body' class="ckeditor"></textarea></td>
<script>
	//使用在线编辑器CKEDITOR类的replace方法替换textarea
	//replace方法有第二个参数，用来进行客户化配置，第二个参数是使用{}来控制
	CKEDITOR.replace('body',{
		//加载自定义配置文件
		customConfig: 'config_user.js'		//配置文件的路径是相对CKeditor.js
	
	});
</script>		
                                                        <td></td>
                                                        <td width="2%">&nbsp;</td>
                                                    </tr>                                                                                              
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan="3"><input class="btn" type="submit" id='btn' value="提交" /></td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="2%">&nbsp;</td>
                        </tr>
                        <!-- 添加产品结束 -->
                        <tr>
                            <td height="40" colspan="4">
                                <table width="100%" height="1" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                                    <tr><td></td></tr>
                                </table>
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