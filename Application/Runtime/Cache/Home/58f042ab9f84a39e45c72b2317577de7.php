<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<meta name="keywords" content="健身,编程,php,天启,个人博客'/" />
<meta name="description" content="会健身的程序员天启的个人博客" />
<link href="/Style/base.css" rel="stylesheet">
<link href="/Style/style.css" rel="stylesheet">
<link href="/Style/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="/Js/modernizr.js"></script>
<![endif]-->




</head>


<body class="articlelist">
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
        <div class='extend' text-align='center'>
		<?php if(is_array($pros)): $i = 0; $__LIST__ = $pros;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><a href="http://www.mynote2.com/index.php/index/<?php echo ($t_url); ?>/u/<?php echo ($p["pro_url"]); ?>"><?php echo ($p["pro_name"]); ?> |</a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		




    <h2 class="about_h">当前位置：dede:field.position /</h2>
	<div class="bloglist">

	    <?php if(is_array($arts)): $i = 0; $__LIST__ = $arts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div class="newblog">
        <ul>
          <h3><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>"><?php echo ($a["art_title"]); ?></a></h3>
          <div class="autor"><span><?php echo ($a["art_writer"]); ?></span>
		  <span>分类：{a.pro_name}</span>
		  <span>浏览(<a href="/"><?php echo ($a["art_click"]); ?></a>)</span>
		  <span>来源(<a href="/"><?php echo ($a["art_source"]); ?></a>)</span></div>
          <p><?php echo ($a["art_description"]); ?><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>" class="readmore">全文</a></p>
		  
        </ul>
        <div class="dateview"><?php echo (date('m.d号',$a["art_time"])); ?></div>
      </div>
	  <!-- /listbox --><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
<div class="pagination"><?php echo ($show); ?></div>
  </article>

	  <aside>
    <div class="rnav">
		<?php if(is_array($pros)): $i = 0; $__LIST__ = $pros;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><li class="rnav<?php echo ($i); ?>"><a href="http://www.mynote2.com/index.php/index/<?php echo ($t_url); ?>/u/<?php echo ($p["pro_url"]); ?>"><?php echo ($p["pro_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="ph_news">
      <h2>
        <p>点击排行</p>
      </h2>
      <ul class="ph_n">
      <?php if(is_array($a1)): $i = 0; $__LIST__ = $a1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a1): $mod = ($i % 2 );++$i;?><li><span class="num<?php echo ($i); ?>"><?php echo ($i); ?></span><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a1["art_id"]); ?>"><?php echo ($a1["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
      <h2>
        <p>文章推荐</p>
      </h2>
      <ul>
      <?php if(is_array($a2)): $i = 0; $__LIST__ = $a2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a2): $mod = ($i % 2 );++$i;?><li><span class="num<?php echo ($i); ?>"><?php echo ($i); ?></span><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a2["art_id"]); ?>"><?php echo ($a2["art_title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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



  <script src="/Js/silder.js"></script>
  <div class="clear"></div>
 </div>


</body>
</html>