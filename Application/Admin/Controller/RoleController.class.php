<?php
namespace Admin\Controller;
class RoleController extends CheckController {
	/**
	 * 添加角色页面
	 */
	public function add(){
		//1,没有post就加载添加角色页面
		if(!$_POST){
			$auth=M('auth');
			//1-1取出顶级权限
			$top=$auth->where('au_level=0')->select();
			//1-2子级权限
			$sub=$auth->where('au_level=1')->select();
			$this->assign('top',$top);
			$this->assign('sub',$sub);
			$this->display();	
			exit;
		}
		
		//2,有post数据时,添加数据
		//接收并创建数据
		$role=D('role');
		if($role->create()){
			//准备要写入数据库的字段信息
			//拼凑ids字段
			$arr_ids=$_POST['ids'];
			$ids=implode(',',$arr_ids);
			$role->r_au_ids=$ids;
			//根据ids拼凑ac字段
			//取出权限表中的所有权限
			$auth=M('auth');
			$aulist=$auth->getField('au_id,au_a',true);
			//判断'au_id"是否在$arr_ids中
			foreach ($aulist as $key=>$value){
				if(in_array($key, $arr_ids)){
					//在并且值不为空,添加到字符串$ac中
					if($value){
						$ac.=$value.',';
					} 
				}
			}
			//去除结尾多的一个逗号
			$ac=trim($ac,',');
			//准备字段r_au_ac的数据
			$role->r_au_ac=$ac;

			if($role->add()){
				$this->success('角色创建成功','index');				
			}else{
				$this->error('数据库写入失败!');
			}
		}else{
			//创建数据失败
			$this->error($role->getError());
		}		
	}
	
	/**
	 * 显示角色页面
	 */
	public function index(){
		$role=M('role');
		$list=$role->select();
		$this->assign('list',$list);
		$this->display();
	}
	
	/**
	 * 编辑角色
	 */
	public function modify(){
		//1,没有post数据,那么显示已有数据
		if(!$_POST){
			//查看是否有$_GET['id']数据,根据id判断要编辑的角色
		}
		
		$role=M('role');

	}
}