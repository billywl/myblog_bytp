<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($arts["art_title"]); ?></title>
<meta name="keywords" content="<?php echo ($arts["art_keyword"]); ?>" />
<meta name="description" content="<?php echo ($arts["art_description"]); ?>" />
<link href="/Style/base.css" rel="stylesheet">
<link href="/Style/style.css" rel="stylesheet">
<link href="/Style/index.css" rel="stylesheet">
<link href="/Style/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="{dede:global.cfg_templets_skin/}/js/modernizr.js"></script>
<![endif]-->
<meta http-equiv="mobile-agent" content="format=xhtml;url={dede:global.cfg_mobileurl/}/view.php?aid={dede:field.id/}">
</head>
<body>
<div class="ibody">
  <header>
    <h1>天启的个人博客</h1>
    <h2>fighting!!!.....目标,很牛的phper!!!</h2>
    <div class="logo"><a href="http://www.mynote2.com"></a></div>
    <nav id="topnav"><a href="http://www.mynote2.com">首页</a>
	<a href="http://www.mynote2.com/index.php/index/fitness">健身世界</a>
	<a href="http://www.mynote2.com/index.php/index/program">编程世界</a>
	<a href="http://www.mynote2.com/index.php/index/about">关于天启</a>
	<a href="https://github.com/billywl">Github</a>
	</nav>
  </header>

  <article>
    <h2 class="about_h">当前位置：{dede:field.position /}</h2>
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
        <p>{dede:prenext get='pre'/}</p>
        <p>{dede:prenext get='next'/}</p>
      </div>
    </div>
  </article>

<aside>
    <div class="avatar"><a href="http://23.252.105.140/a/about/"><span>关于站长</span></a></div>
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
			<?php if(is_array($a1)): $i = 0; $__LIST__ = $a1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a1): $mod = ($i % 2 );++$i;?><li><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a1["art_id"]); ?>"><?php echo ($a1["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <h2>
        <p class="tj_t2">健身世界</p>
      </h2>
      <ul>
			<?php if(is_array($a2)): $i = 0; $__LIST__ = $a2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a2): $mod = ($i % 2 );++$i;?><li><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a2["art_id"]); ?>"><?php echo ($a2["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
  <script src="/Js/silder.js"></script>
  <div class="clear"></div>
  <!-- 清除浮动 --> 
</div>
</body>
</html>