<?php
namespace Admin\Model;

use Think\Model;

class ArticleModel extends Model {
	protected $_map = array(			
			'title' =>'art_title', // 把表单中name映射到数据表的pro_name字段
			'id'=>'art_id',
			'topid'  =>'art_topid', 
			'recommend'  =>'art_recommend',
			'writer'=>'art_writer',
			'source'=>'art_source',
			'description'=>'art_description',
			'keyword'=>'art_keyword',
			'body'=>'art_body',
	);
	

}