<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	$('btn').onclick = function(event){
		//当username为空时,取消submit的按钮的提交
		if ($('name').value == ''||$('url').value =='') {
			//调用取消函数
			prevent(event);
			alert('栏目名不能为空!');
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
                    <table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" background=".//Images/content_bg.gif">
                        <tr><td height="31"><div class="title">添加角色</div></td></tr>
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
                        <!-- 添加栏目开始 -->
                        <tr>
                            <td width="2%">&nbsp;</td>
                            <td width="96%">
                                <table width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <form action="" method="post">
                                                <table width="100%" class="cont">
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>角色名称：</td>
                                                        <td width="90%"><input class="text" type="text" id='name' name="name" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td>选择权限：</td>
                                                     </tr>
                                                  <?php if(is_array($top)): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                        <td width="2%">&nbsp;</td>
                                                        <td width="90%">
										<input type="checkbox" class='top' id='top' name='ids[]' value="<?php echo ($vo["au_id"]); ?>"/><?php echo ($vo["au_name"]); ?>
                                                        	<?php if(is_array($sub)): $i = 0; $__LIST__ = $sub;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i; if(($so["au_pid"]) == $vo["au_id"]): ?><input type="checkbox" class='sub' name='ids[]' value="<?php echo ($so["au_id"]); ?>" /><?php echo ($so["au_name"]); endif; endforeach; endif; else: echo "" ;endif; ?>
                                                        </td>
                                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan="3"><input class="btn" id='btn' type="submit" value="提交" /></td>
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
                        <!-- 添加栏目结束 -->
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
                <td valign="bottom" bac	kground="/Images/mail_right_bg.gif">
                    <img src="/Images/buttom_right.gif" width="16" height="17" />
                </td>           
            </tr>
        </table>
        <script src='/Js/jquery-1.12.0.min.js'></script>
        <script>
        	$().ready(
        		function (){
        			$('.top').bind('click',function(){
	        			if(this.checked){
	        				$(this).parent().children('.sub').attr("checked",true);
	        			}else{
	        				$(this).parent().children('.sub').attr("checked",false);
	        			}
        			});
        	});
        </script>
    </body>
</html>