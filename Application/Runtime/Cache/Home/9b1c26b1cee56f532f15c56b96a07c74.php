<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会健身的程序员</title>
<meta name="description" content="天启的个人博客" />
<meta name="keywords" content="健身,程序员,php,博客" />
<link href="/Style/base.css" rel="stylesheet">
<link href="/Style/index.css" rel="stylesheet">
<link href="/Style/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="/Js/modernizr.js"></script>
<![endif]-->
<script src='/Js/jquery-1.12.0.min.js'></script>
<script>
$().ready(function(){
	$('#topnav>a:first').attr('id','topnav_current');
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
	<a href="http://www.mynote2.com/index.php/index/fitness.html">健身世界</a>
	<a href="http://www.mynote2.com/index.php/index/program.html">IT世界</a>
	<a href="http://www.mynote2.com/index.php/index/about.html">关于天启</a>
	<a href="https://github.com/billywl">Github</a>
	</nav>
  </header>

  <article>
    <div class="banner">
      <ul class="texts">
        <p id='p'> 健身是一种态度,需要坚持!!! </p>
        <p> 编程更是一种信仰,我相信,我的指尖会具有改变世界的力量!!!</p>
      </ul>
    </div>
    <div class="bloglist">
      <h2>
        <p><span>最新</span>文章</p>
      </h2>
	    <?php if(is_array($arts)): $i = 0; $__LIST__ = $arts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div class="blogs">
        <h3><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>.html"><?php echo ($a["art_title"]); ?></a></h3>
        <figure><img src="http://www.mynote2.com/uploads/<?php echo ($a["art_purl"]); ?>" ></figure>
        <ul>
          <p><?php echo ($a["art_description"]); ?></p>
          <a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>.html" class="readmore">阅读全文&gt;&gt;</a>
        </ul>
        <p class="autor"><span>作者：<?php echo ($a["art_writer"]); ?></span><span>分类：【<a href="/" ><?php echo ($a["pro_name"]); ?></a>】</span><span>浏览（<a href="/"><?php echo ($a["art_click"]); ?></a>）</span><span>来源（<a href="/"><?php echo ($a["art_source"]); ?></a>）</span></p>
        <div class="dateview"><?php echo (date('m.d号',$a["art_time"])); ?></div>
      </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>

  </article>
  <aside>
    <div class="avatar"><a href="http://www.mynote2.com/index.php/index/about.html"><span>关于天启</span></a></div>
    <div class="topspaceinfo">
      <h1>健身改变自己,指尖改变世界</h1>
      <p>我变得更好,才能让身边的人更幸福......</p>
    </div>
    <div class="about_c">
      <p>网名：天启</p>
      <p>职业：求职php程序员ing </p>
      <p>籍贯：湖北省--武汉市</p>
      <p>学历：本科</p>
      <p>邮箱：183692566@qq.com</p>
    </div>
    <div class="tj_news">
      <h2>
        <p class="tj_t1">程序世界</p>
      </h2>
      <ul>
			<?php if(is_array($a1)): $i = 0; $__LIST__ = $a1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a1): $mod = ($i % 2 );++$i;?><li><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a1["art_id"]); ?>.html"><?php echo ($a1["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <h2>
        <p class="tj_t2">健身世界</p>
      </h2>
      <ul>
			<?php if(is_array($a2)): $i = 0; $__LIST__ = $a2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a2): $mod = ($i % 2 );++$i;?><li><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a2["art_id"]); ?>.html"><?php echo ($a2["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <div class="links">
      <h2>
        <p>友情链接</p>
      </h2>
      <ul>
	    <li><a href="http://www.imooc.com/">慕课网</a></li>
        <li><a href="http://www.yangqq.com/">杨青个人博客</a></li>
      </ul>
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