<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($arts["art_title"]); ?></title>
<meta name="keywords" content="<?php echo ($arts["art_keyword"]); ?>" />
<meta name="description" content="<?php echo ($arts["art_description"]); ?>" />
<link href="/Style/base.css" rel="stylesheet">
<link href="/Style/style.css" rel="stylesheet">
<link href="/Style/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="/Js/modernizr.js"></script>
<![endif]-->

<script src='/Js/jquery-1.12.0.min.js'></script>

<script>
$().ready(function() {
	$("#pre").bind("click", function(event) {
		if ($('#pre').text() == '没有文章了!') {
			//取消按钮提交表单的默认行为
			event.preventDefault();
			window.event.returnValue=false;
		}
	})
	
	$("#nex").bind("click", function(event) {
		if ($('#nex').text() == '没有文章了!') {
			//取消按钮提交表单的默认行为
			event.preventDefault();
			window.event.returnValue=false;
		}
	})	
	
	//获取当前页面中当前位置中的栏目url
	var loc=$('.about_h>a:eq(1)').attr('href');
	
	//获取head.html中的所有a标签中的url
	var list=$('#topnav>a');
	
	//循环比较,如果哪个url和栏目url相等,设置属性id=topnav_current,高亮
 	for(var i=0;i<list.length;i++){
		if(list[i]==loc){
			var id=i;
		}
 	}
 	$('#topnav>a:eq('+id+')').attr('id','topnav_current');
	
});

</script>
</head>
<body>

<div class="ibody">
  <header>
    <h1>天启的个人博客</h1>
    <h2>fighting!为梦想去努力的路不会觉得累!!!</h2>
    <div class="logo"><a href="http://www.mynote2.com"></a></div>
    <nav id="topnav">
      <a href="http://www.mynote2.com">首页</a>
	<a href="http://www.mynote2.com/index.php/index/fitness/p/1.html">健身世界</a>
	<a href="http://www.mynote2.com/index.php/index/program/p/1.html">IT世界</a>
	<a href="http://www.mynote2.com/index.php/index/about.html">关于天启</a>
	<a href="https://github.com/billywl">Github</a>
	</nav>
  </header>

  <article>
    <h2 class="about_h"><?php echo ($location); ?></h2>
    <div class="index_about">
      <h2 class="c_titile"><?php echo ($arts["art_title"]); ?></h2>
      <p class="box_c"><span class="d_time">发布时间：<?php echo (date('m.d',$arts["art_time"])); ?></span>
      <span>作者：<?php echo ($arts["art_writer"]); ?></span><span>浏览:<?php echo ($arts["art_click"]); ?>次</span>
      <span>来源:<?php echo ($arts["art_source"]); ?></span></p>

      <ul class="infos">
       <?php echo ($arts["art_body"]); ?>
      </ul>
      <div class="keybq">
        <p><span>关键字词</span>：<?php echo ($arts["art_keyword"]); ?></p>
      </div>

     
      <div class="nextinfo">
        <p>上一篇:<a  id='pre' href='http://www.mynote2.com/index.php/index/art/id/<?php echo ($prev_id); ?>.html'><?php echo ($prev_title); ?></a></p>
        <p>下一篇:<a id='nex' href='http://www.mynote2.com/index.php/index/art/id/<?php echo ($next_id); ?>.html'><?php echo ($next_title); ?></a></p>
      </div>
    </div>
  </article>

  <aside>
    <div class="rnav">
		<?php if(is_array($pros)): $i = 0; $__LIST__ = $pros;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><li class="rnav<?php echo ($i); ?>"><a href="http://www.mynote2.com/index.php/index/<?php echo ($t_url); ?>/u/<?php echo ($p["pro_url"]); ?>/p/1.html"><?php echo ($p["pro_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="ph_news">
      <h2>
        <p>点击排行</p>
      </h2>
      <ul class="ph_n">
      <?php if(is_array($a1)): $i = 0; $__LIST__ = $a1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a1): $mod = ($i % 2 );++$i;?><li><span class="num<?php echo ($i); ?>"><?php echo ($i); ?></span><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a1["art_id"]); ?>/p/1.html"><?php echo ($a1["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <h2>
        <p>文章推荐</p>
      </h2>
      <ul>
      <?php if(is_array($a2)): $i = 0; $__LIST__ = $a2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a2): $mod = ($i % 2 );++$i;?><li><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a2["art_id"]); ?>.html"><?php echo ($a2["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
	      <div class="links">
      <h2>
        <p>友情链接</p>
      </h2>
      <ul>
	    <li><a href="http://www.imooc.com/">慕课网</a></li>
        <li><a href="http://www.yangqq.com/">杨青个人博客</a></li>
      </ul>
    </div>
    </div>
    <div class="copyright">
      <ul>
        <p> Design by 天启</a></p>
        <p>备案号</p>
        </p>
      </ul>
    </div>
  </aside>
  <div class="clear"></div>
  <!-- 清除浮动 --> 
</div>
</body>
</html>