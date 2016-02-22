<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= " />
<title>dede:field.title/</title>
<meta name="keywords" content="dede:field name='keywords'/" />
<meta name="description" content="dede:field name='description' function='html2text(@me)'/" />
<link href="dede:global.cfg_templets_skin//css/base.css" rel="stylesheet">
<link href="dede:global.cfg_templets_skin//css/style.css" rel="stylesheet">
<link href="dede:global.cfg_templets_skin//css/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="dede:global.cfg_templets_skin//js/modernizr.js"></script>
<![endif]-->


<meta http-equiv="mobile-agent" content="format=xhtml;url=dede:global.cfg_mobileurl//list.php?tid=dede:field.id/">

<script>
var _hmt = _hmt || [];
(function() 
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?b2057ff45463393b2df638f007baadbd";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
)();
</script>
</head>


<body class="articlelist">
<div class="ibody">
dede:include filename='head.htm' /
  <article>
        <div class='extend' text-align='center'>
  		dede:channel type="son" row=4
<a href="[field:typelink/]"> [field:typename/] |</a>
		/dede:channel
		</div>

    <h2 class="about_h">当前位置：dede:field.position /</h2>
	<div class="bloglist">
    dede:list pagesize='5'

	    <div class="newblog">
        <ul>
          <h3><a href="[field:arcurl/]">[field:title/]</a></h3>
          <div class="autor"><span>[field:writer/]</span>
		  <span>分类：[field:typeid function="getTypenameByTypeid(@me)" /]</span>
		  <span>浏览(<a href="/">[field:click/]</a>)</span>
		  <span>来源(<a href="/">[field:source/]</a>)</span></div>
          <p>[field:description/]<a href="[field:arcurl/]" target="_blank" class="readmore">全文</a></p>
		  
        </ul>
        <figure><img src="[field:litpic/]" ></figure>
        <div class="dateview">[field:senddate function=date("Y-m-d",@me)/]</div>
      </div>
    /dede:list
	  <!-- /listbox -->
  <div class="dede_pages">
   <ul class="pagelist">
   dede:pagelist listitem="info,index,end,pre,next,pageno" listsize="5"/

   </ul>
  </div>

    </div>
  </article>

	dede:include filename='subaside.htm' /



  <script src="dede:global.cfg_templets_skin//js/silder.js"></script>
  <div class="clear"></div>
 </div>


</body>
</html>