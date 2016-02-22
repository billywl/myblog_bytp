<?php
namespace Admin\Controller;
use Common\Tool\Tree;
//文章控制器
class ArticleController extends CheckController{
	//文章管理首页,显示所有文章列表
	public function index(){
		$art=M('article');
		//需要分页

		//获取查询到的中记录数
		$count=$art->field('art_id')->where('art_topid>0')->count();
		
		//实例化系统的分页类
		$page       = new \Think\Page($count,10);
		
		//获取页脚输出的字符串
		$show       = $page->show();
		
		//赋值到模版,模版中调用{$show}即可
		$this->assign('show',$show);
		
		//获取文章数据
		$list=$art->alias('a')->field('a.art_id,a.art_title,a.art_time,a.art_topid,a.art_writer,b.pro_name')
		->join('left join tp_program b on a.art_topid=b.pro_id')->order('art_id desc')->where('art_topid>0')
		->limit($page->firstRow.','.$page->listRows)->select();
		
		//赋值给模版
		$this->assign('list',$list);
		$this->display();
	}
	
	//添加文章的方法
	public function add(){
		//没有post就直接加载添加页面
		if(!$_POST){
			//取出所有栏目数据
			$art=M('program');
			$list=$art->field('pro_id,pro_name,pro_topid')->select();
			//无限极分类并赋值到模版
			$this->assign('list',Tree::tree($list));
			$this->display();			
		}else{
			//如果 有post数据
			//实例化模型
			$art=D('article');
			
			//添加时间戳
			$_POST['art_time']=time();
			
			//自动填写以下空白数据
			$_POST['keyword']=$_POST['keyword']!=''?$_POST['keyword']:$_POST['title'];
			$_POST['description']=$_POST['description']!=''?$_POST['description']:substr($_POST['body'], 0,30);
			$_POST['writer']=$_POST['writer']!=''?$_POST['writer']:'天启';
			$_POST['source']=$_POST['source']!=''?$_POST['source']:'原创';

			if(!$_POST['title']){
				die();
			}
			
			if(!$_POST['topid']){
				die();
			}
			
 			//如果传来的topid为不存在的栏目,终止
 			$pro=D('program');
			$id=$_POST['topid'];

			$flag=$pro->where("pro_id=$id")->find();			
			if (!$flag){
				die();
			} 
			
			//用create()方法创建数据
			$art->create();
			
			//将数据写入数据库
			if($art->add()){
				$this->success('添加成功','add');
			}else{
				//添加失败
				$this->error('添加失败','add');
			}			
		} 
	}
	
	/**
	 * 编辑文章页面
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
			$art=M('article');
						
			//取出要编辑的文章的信息
			$dataes=$art->where("art_id=$id")->find();
			
			//判断是否有get传过来的id数据,是否合理,如果不合理,为非法访问,终止
			if(!$dataes){
				die();
			}			
			
			//根据父id获取父栏目名称
			$pro=M('program');
			$topid=$dataes['art_topid'];
			$name=$pro->where("pro_id=$topid")->getField('pro_name');

			//没有name,异常访问,终止
			if(!$name){
				die();
			}
				
				
			//取出所有栏目的名称
			$list=$pro->field('pro_name,pro_id')->where('pro_topid!=0')->select();
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
			
			//如果没有推荐值传过来说明推荐值为0 
			if(!$_POST['art_recommend']){
				$_POST['art_recommend']=0;
			}
			
			//实例化Program的模型,
			$art=D('article');
			//获取表单传送过来的数据,并创建数据
			$art->create();
	
			
			//保存更新条件
			$id=$_POST['id'];
	
			//更新数据
			$result=$art->where("art_id={$id}")->save();

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
	 * 删除文章
	 */
	public function delete(){
		//判断是否有get传过来的id数据,如果没有属于非法访问,终止
		if(!$_GET){
			die();
		}
			
		//接收get数据,判断要删除哪个栏目
		$id=$_GET['id'];
			
		//实例化模型
		$pro=M('article');
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
	
	/**
	 * 编辑个人简介
	 */
	public function about(){
		//没有post信息,填写加载表单模版,填写栏目数据
		if (! $_POST) {
			//实例化模型
			$art=M('article');
	
			//取出要个人介绍的信息
			$dataes=$art->where("art_topid<0")->find();
							
			//变量赋值给模版
			$this->assign('dataes',$dataes);
			$this->display ();
		} else {
			//有post数据的时,将数据写入数据库
								
			//实例化Program的模型,
			$art=D('article');
			//获取表单传送过来的数据,并创建数据
			$art->create();
				
			//保存更新条件
			$id=$_POST['id'];
	
			//更新数据
			$result=$art->where("art_id={$id}")->save();
	
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
}