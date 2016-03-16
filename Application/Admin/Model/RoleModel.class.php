<?php

namespace Admin\Controller;

use Think\Model;

class RoleModel extends Model {
	protected $_validate=array(
		array('r_name','require','必须添加角色的名称'),
		array('r_name','','角色名称必须唯一',0,'unique',1),
	);
	
	protected $_map=array(
		'name'=>'r_name',
		'ids'=>'r_au_ids',
		'ac'=>'r_au_ac',
	);
}