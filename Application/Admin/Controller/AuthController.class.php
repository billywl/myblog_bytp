<?php

namespace Admin\Controller;

// 权限控制器
class AuthController extends CheckController {
	/**
	 * 添加权限,并处理添加数据
	 */
	public function addAuth() {
		// ~~~加载添加权限页面~~~~~~~~~~~~~
		// 判断是否有post数据
		if (! $_POST) {
			//取出权限列表赋值到模版
			$auth = D ( 'auth' );
			$list=$auth->field('au_id,au_name,au_level')->order('au_path')->select();
			//根据level在au_name前加上前缀用于无限极分类
			for($i=0;$i<count($list);$i++){
				$list[$i]['au_name']=str_repeat('|--', $list[$i]['au_level']).$list[$i]['au_name'];			
			}
			$this->assign('list',$list);
			$this->display ();
			return; 
		}
		
		// ~~~处理添加权限数据~~~~~~~~~~~~~
		// 创建模型对象
		$auth = D ( 'auth' );
		// 接收并创建数据
		if ($auth->create ()) {
			// 写入数据库
			if (($id = $auth->add ()) != false) {
				// 权限添加成功
				// 添加权限全路径和级别
				// 如果$au_pid=0,全路径就等于$id,级别为0(顶级)
				if ($_POST ['au_pid'] == 0) {
					// 添加顶级权限时
					$au_id = $id;
					$au_path = $id;
					$au_level = 0;
				} else {
					// 添加子级权限时
					$au_id = $id;
					$au_path = $auth->where ( "au_id={$_POST['au_pid']}" )->getField ( 'au_path' );
					$au_path .= '-'.$id;
					$au_level = substr_count ( $au_path, '-' );
				}
				
				// 准备用于更新path和level的数据
				$data = array (
						'au_id' => $au_id,
						'au_path' => $au_path,
						'au_level' => $au_level 
				);
				
				// 更新权限数据,需要用!==判断
				if ($auth->save ( $data ) !== false) {
					$this->success ( '权限添加成功', 'index' );
				} else {
					// 添加更新失败,需要先删除已经添加的权限数据,然后跳转提示
					if ($auth->delete ( $id ) !== false) {
						$this->error ( '权限添加失败,原因路径和级别更新失败且删除已有权限失败' );
					} else {
						$this->error ( '权限添加失败,原因路径和级别更新失败' );
					}
				}
			} else {
				$this->error ( '权限添加失败' );
			}
		} else {
			$this->error ( $auth->getError () );
		}
	}
	
	/**
	 * 权限管理首页,列出所有权限
	 */
	public function index() {
		// 从数据库取出所有权限并赋值给模版
		$auth = M ( 'auth' );
		$list = $auth->order ( 'au_path' )->select ();
		$this->assign ( 'list', $list );
		$this->display ();
	}
	
}	