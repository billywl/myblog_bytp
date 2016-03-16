<?php
namespace Admin\Model;

use Think\Model;

class AuthModel extends Model {
	protected $_map = array(			
			'id'=>'au_id',
			'name'=>'au_name',
			'pid'=>'au_pid',
			'cc'=>'au_c',
			'aa'=>'au_a',
			'path'=>'au_path',
			'level'=>'au_level',
	);
	
    protected $_validate=array(
        array('au_name','require','必须添加权限的名称'),
    );
	
	
}