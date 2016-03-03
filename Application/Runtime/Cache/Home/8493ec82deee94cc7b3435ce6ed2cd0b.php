<?php if (!defined('THINK_PATH')) exit();?>
	<div class="bloglist">

	    <?php if(is_array($arts)): $i = 0; $__LIST__ = $arts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div class="newblog">
        <ul>
          <h3><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>.html"><?php echo ($a["art_title"]); ?></a></h3>
          <div class="autor">作者: <span class='sp'><?php echo ($a["art_writer"]); ?></span>
		  <span>所属栏目【 <span class='sp'><?php echo ($a["pro_name"]); ?></span>】</span>
		  <span>浏览 ( <span class='sp'><?php echo ($a["art_click"]); ?></span>)</span>
		  <span>来源 ( <span class='sp'><?php echo ($a["art_source"]); ?></span>)</span></div>
          <p><?php echo ($a["art_description"]); ?><a href="http://www.mynote2.com/index.php/index/art/id/<?php echo ($a["art_id"]); ?>.html" class="readmore">阅读全文</a></p>
		  
        </ul>
        <figure><img src="http://www.mynote2.com/uploads/Images/<?php echo ($a["art_purl"]); ?>" ></figure>
        <div class="dateview"><?php echo (date('m.d号',$a["art_time"])); ?></div>
      </div>
	  <!-- /listbox --><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>