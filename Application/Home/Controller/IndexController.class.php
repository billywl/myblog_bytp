<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		//表取出数据
		$art=M('article');
		$pro=M('program');
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where('a.art_topid>0')->limit('5')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
		
		$a1=$art->field('art_title')->where('art_topid>18 and art_topid<23')->limit('5')->select();
		$a2=$art->field('art_title')->where('art_topid>23 and art_topid<28')->limit('5')->select();
		
		$this->assign('arts',$arts);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		
		$this->display();
    }
    
    //健身世界列表页
	public function fitness(){
			$title       = '健身世界';
		
		
		//如果没有通过get传递u参数,name说明访问的顶级栏目
    		if(!$_GET['u']){	    			
	    		//实例化数据表
	    		$art=M('article');
			$pro=M('program');
			
			//取出健身世界下的子栏目
			$pros=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=2')->select();
		
			//设定查询条件
			for($i=0;$i<count($pros);$i++){
				$proid[]=$pros[$i]['pro_id'];
			}
			$where1['pro_id']=array('in',$proid);
			$where2['art_topid']=array('in',$proid);
			
			//获取查询到的中记录数
			$count=$art->field('art_title')->where($where2)->count();

			//实例化系统的分页类
			$page       = new \Think\Page($count,3);
			
			//获取页脚输出的字符串
			$show       = $page->show();
			
			

			//联合查询取出文章数据和所属栏目
			$arts=$art->alias('a')->field('a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
			->where($where1)->limit($page->firstRow.','.$page->listRows)->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			

			//查询取出本栏目点击最高的5篇文章标题
			$a1=$art->field('art_title')->where($where2)->limit('5')->order('art_click')->select();
			//查询取出本栏目推荐的文章标题
			$a2=$art->field('art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			
			
			//赋值到模版
			$this->assign('title',$title);
			$this->assign('a1',$a1);
			$this->assign('a2',$a2);
			$this->assign('pros',$pros);
			$this->assign('arts',$arts);
			$this->assign('show',$show);
			
			//方法名赋值给模版
			$t_url=__METHOD__;
			//获取方法名字符串
			$ind=strpos($t_url,'::');
			$t_url=substr($t_url,$ind+2);		
			$this->assign('t_url',$t_url);
			
			//加载模版文件,然后返回
	    		$this->display('../Application/Home/View/list.html');
	    		return ;
    		}
    		//如果有u参数循环判断
    		$u=$_GET['u'];
		$pro=M('program');
		$pros=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=2')->select();
    		//var_dump($pros);
    		foreach($pros as $value){
    			if($value['pro_url']==$u){
    				$id=$value['pro_id'];
    				break;
    			}
    		}
    		//如果$id不为空说明访问的是子栏目
		if(!$id){
			$this->error('您访问的栏目不存在','../');
		}   
		
		
		//当$id不为空说明访问的是it的健身世界的子类栏目
		//实例化数据表
		$art=M('article');
		$pro=M('program');
		
		
		//获取查询到的中记录数
		$count=$art->field('art_title')->where("art_topid=$id")->count();
		
		//实例化系统的分页类
		$page       = new \Think\Page($count,3);
			
		//获取页脚输出的字符串
		$show       = $page->show();
			
			
		
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where("art_topid=$id")->limit($page->firstRow.','.$page->listRows)->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_title')->where("art_topid=$id")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_title')->where("art_topid=$id")->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			
			
		//赋值到模版
		$this->assign('title',$title);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		//方法名赋值给模版
		$t_url=__METHOD__;
		//获取方法名字符串
		$ind=strpos($t_url,'::');
		$t_url=substr($t_url,$ind+2);
		$this->assign('t_url',$t_url);
		
		//加载模版文件
		$this->display('../Application/Home/View/list.html');
    		
    }
    
      //程序世界列表页
	public function program(){
			$title       = 'IT世界';
		
		
		//如果没有通过get传递u参数,name说明访问的顶级栏目
    		if(!$_GET['u']){	    			
	    		//实例化数据表
	    		$art=M('article');
			$pro=M('program');
			
			//取出健身世界下的子栏目
			$pros=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=1')->select();
		
			//设定查询条件
			for($i=0;$i<count($pros);$i++){
				$proid[]=$pros[$i]['pro_id'];
			}
			$where1['pro_id']=array('in',$proid);
			$where2['art_topid']=array('in',$proid);
			
			//获取查询到的中记录数
			$count=$art->field('art_title')->where($where2)->count();

			//实例化系统的分页类
			$page       = new \Think\Page($count,3);
			
			//获取页脚输出的字符串
			$show       = $page->show();
			
			

			//联合查询取出文章数据和所属栏目
			$arts=$art->alias('a')->field('a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
			->where($where1)->limit($page->firstRow.','.$page->listRows)->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			

			//查询取出本栏目点击最高的5篇文章标题
			$a1=$art->field('art_title')->where($where2)->limit('5')->order('art_click')->select();
			//查询取出本栏目推荐的文章标题
			$a2=$art->field('art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			
			
			//赋值到模版
			$this->assign('title',$title);
			$this->assign('a1',$a1);
			$this->assign('a2',$a2);
			$this->assign('pros',$pros);
			$this->assign('arts',$arts);
			$this->assign('show',$show);
			
			//方法名赋值给模版
			$t_url=__METHOD__;
			//获取方法名字符串
			$ind=strpos($t_url,'::');
			$t_url=substr($t_url,$ind+2);		
			$this->assign('t_url',$t_url);
			
			//加载模版文件,然后返回
	    		$this->display('../Application/Home/View/list.html');
	    		return ;
    		}
    		//如果有u参数循环判断
    		$u=$_GET['u'];
		$pro=M('program');
		$pros=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=1')->select();
    		//var_dump($pros);
    		foreach($pros as $value){
    			if($value['pro_url']==$u){
    				$id=$value['pro_id'];
    				break;
    			}
    		}
    		//如果$id不为空说明访问的是子栏目
		if(!$id){
			$this->error('您访问的栏目不存在','../');
		}   
		
		
		//当$id不为空说明访问的是it的健身世界的子类栏目
		//实例化数据表
		$art=M('article');
		$pro=M('program');
		
		
		//获取查询到的中记录数
		$count=$art->field('art_title')->where("art_topid=$id")->count();
		
		//实例化系统的分页类
		$page       = new \Think\Page($count,3);
			
		//获取页脚输出的字符串
		$show       = $page->show();
			
			
		
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where("art_topid=$id")->limit($page->firstRow.','.$page->listRows)->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_title')->where("art_topid=$id")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_title')->where("art_topid=$id")->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			
			
		//赋值到模版
		$this->assign('title',$title);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		//方法名赋值给模版
		$t_url=__METHOD__;
		//获取方法名字符串
		$ind=strpos($t_url,'::');
		$t_url=substr($t_url,$ind+2);
		$this->assign('t_url',$t_url);
		
		//加载模版文件
		$this->display('../Application/Home/View/list.html');
	    }
}