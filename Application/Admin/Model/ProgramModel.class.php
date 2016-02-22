<?php
namespace Admin\Model;

use Think\Model;

class ProgramModel extends Model {
	protected $_map = array(
			'name' =>'pro_name', // 把表单中name映射到数据表的pro_name字段
			'f_id'  =>'pro_topid', 
			'url'=>'pro_url',
			'title'  =>'pro_title',
			'keyword'=>'pro_keyword',
			'description'=>'pro_description'
	);
	

}