<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="/Js/prototype.lite.js" type="text/javascript"></script>
    <script src="/Js/moo.fx.js" type="text/javascript"></script>
    <script src="/Js/moo.fx.pack.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/Style/skin.css" />
</head>

<body>
    <table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#EEF2FB">
        <tr>
            <td width="182" valign="top">
                <div id="container">

                    <h1 class="type"><a href="/admin.php/article/add" target="main">发布文章</a></h1>
                    <br />
                    <h1 class="type"><a href="/admin.php/program" target="main">栏目管理</a></h1>
                    <br />
                    <h1 class="type"><a href="/admin.php/article/index" target="main">文章管理</a></h1>
                    <br />
                    <h1 class="type"><a href="/admin.php/article/about" target="main">个人简介</a></h1>      
                    <br />
                    <h1 class="type"><a href="/admin.php/picture/upLoadPic" target="main">上传图片</a></h1>                      
                    <br />
                    <h1 class="type"><a href="/admin.php/update/update" target="main">更新静态页</a></h1>                      
                    <br />
                    <?php if(is_array($topAuth)): $i = 0; $__LIST__ = $topAuth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class='test' ><h1 class="type"><a href="javascript:void(0)" target="main"><?php echo ($vo["au_name"]); ?></a></h1>                      
				<ul class="RM" hidden>
				<?php if(is_array($subAuth)): $i = 0; $__LIST__ = $subAuth;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i; if(($so["au_pid"]) == $vo["au_id"]): ?><li><a href="/admin.php/<?php echo ($so["au_c"]); ?>/<?php echo ($so["au_a"]); ?>" target="main"><?php echo ($so["au_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
                    <br />
                    </span><?php endforeach; endif; else: echo "" ;endif; ?>
                    <h1 class="type"><a href="/admin.php/auth/index" target="main">权限列表</a></h1>                      
                    <!-- *********** -->
                </div>
            </td>
        </tr>
    </table>
    <script src='/Js/jquery-1.12.0.min.js'></script>
    <script>
    $().ready(function(){
	    	$('.test').click(
		    	function(){
		    		$(this).children('ul').toggle();
		    	}
	    	); 
    	}); 

    </script>
</body>
</html>