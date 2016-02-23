<?php

namespace Admin\Controller;
use Common\Tool\Tree;
class ProgramController extends CheckController {
	/**
	 * 默认的栏目管理页面
	 */
	public function index() {
		//实例化模型
		$pro=M('Program');
		//通过select()方法,连贯操作,取出模型中的数据集,并保存到$list中
		//$list=$pro->field('pro_id,pro_name,pro_topid')->select();		
		$list=$pro->alias('a')->field('a.pro_name as pro_tname,b.pro_name,b.pro_id,b.pro_topid')
		->join('right join tp_program b on a.pro_id=b.pro_topid')->select();		
		
		//如果没有获取到数据,弹出提示返回主页
		if($list===false){
			$this->error('数据库连接错误,重试','../index/index');
		}
		
		//无限极分类.使用工具类Tree的静态方法					
		//变量赋值给模版

		$this->assign('list',Tree::tree($list));
		$this->display ();
	}
	
	/**
	 * 添加顶级栏目页面
	 */
	public function addTop() {
		// 如果不没有post数据,直接加载
		if (! $_POST) {
			$this->display ();
		} else {
			//实例化Program的模型,
			$pro=D('Program');
			//获取表单传送过来的数据,并创建数据		
			$pro->create();
			//将数据保存到数据库
			//添加成功返回管理页面的首页
			if($pro->add()){
				$this->success('添加成功','index');
			}else{
				//添加失败
				$this->error('添加失败','index');
			}	
		}
	}
	
	/**
	 * 添加子级栏目页面
	 */
	public function addSon(){
		//没有post信息,填写加载表单模版,填写栏目数据
		if (! $_POST) {
			//判断是否有get传过来的id数据,如果没有属于非法访问,终止
			if(!$_GET){
				die();
			}
			
			//接收get数据,判断是增加哪个顶级栏目的子栏目
			$id=$_GET['id'];			
			
			//实例化模型
			$pro=M('Program');
			$top=$pro->field('pro_name,pro_id')->where("pro_id=$id")->find();
			
			//判断是否有get传过来的id数据,是否合理,如果不合理,为非法访问,终止
			if(!$top){			
				die();
			}
			
			//变量赋值给模版
			$this->assign('top',$top);	
			$this->display ();
		} else {
			//有post数据的时,将数据写入数据库
			//实例化Program的模型,
			$pro=D('Program');
			//获取表单传送过来的数据,并创建数据
			$pro->create();
			//将数据保存到数据库
			//添加成功返回管理页面的首页
			if($pro->add()){
				$this->success('添加成功','index');
			}else{
				//添加失败
				$this->error('添加失败','index');
			}	
		}
	}
	
	/**
	 * 编辑栏目页面
	 */
	public function edit(){
		//没有post信息,填写加载表单模版,填写栏目数据
		if (! $_POST) {
			//判断是否有get传过来的id数据,如果没有属于非法访问,终止
			if(!$_GET){
				die();
			}
				
			//接收get数据,判断是编辑的哪个栏目
			$id=$_GET['id'];
				
			//实例化模型
			$pro=M('program');
			
			//取出要编辑的栏目的信息
			$dataes=$pro->where("pro_id=$id")->find();
			$topid=$dataes['pro_topid'];
			//根据父id获取父栏目名称 
			$name=$pro->where("pro_id=$topid")->getField('pro_name');
			
			//判断是否有get传过来的id数据,是否合理,如果不合理,为非法访问,终止
			if(!$dataes){
				die();
			}	
			
			
			//取出所有栏目的名称
			$list=$pro->field('pro_name,pro_id')->select();
			if(!$list){
				die();
			}
			
			//变量赋值给模版
			$this->assign('dataes',$dataes);
			$this->assign('list',$list);
			$this->assign('name',$name);
			$this->display ();
		} else {
			//有post数据的时,将数据写入数据库
			//实例化Program的模型,
			$pro=D('Program');
			//获取表单传送过来的数据,并创建数据
 			$pro->create();
 			
			//保存更新条件
			$id=$_POST['id'];

			//更新数据
			$result=$pro->where("pro_id={$id}")->save();

			//因为返回的是更新的数量,所以必须使用!==来判断
			if($result!==false){
				//更新成功,返回管理页
				$this->success('更新成功','index');
			}else{
				//更新失败,返回编辑页面
				$this->error('更新失败','edit'); 
			}
		}
	}
	
	/**
	 * 删除栏目方法
	 */
	public function delete(){
		//判断是否有get传过来的id数据,如果没有属于非法访问,终止
		if(!$_GET){
			die();
		}
			
		//接收get数据,判断要删除哪个栏目
		$id=$_GET['id'];
			
		//实例化模型
		$pro=M('Program');
		//删除主键为$id的数据
		$result=$pro->delete($id);
		//因为返回的是更新的数量,所以必须使用!==来判断
		if($result!==false){
			$this->success('删除成功','index');
		}else{
			//添加失败
			$this->error('删除失败','index'); 
		}
	}
}