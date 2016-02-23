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
		->where('a.art_topid>0')->limit('5')->join('left join tp_program p on a.art_topid=p.pro_id')->order('art_id desc')->select();
		
		//取出健身世界和程序世界下的子栏目
		$pros1=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=1')->select();
		$pros2=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=2')->select();
		
		//设定查询条件
		for($i=0;$i<count($pros1);$i++){
			$proid1[]=$pros1[$i]['pro_id'];
		}
		$where1['art_topid']=array('in',$proid1);
		
		for($i=0;$i<count($pros2);$i++){
			$proid2[]=$pros2[$i]['pro_id'];
		}
		$where2['art_topid']=array('in',$proid2);
		
		
		//取出侧边栏数据
		$a1=$art->field('art_id,art_title')->where($where1)->limit('5')->order('art_id desc')->select();
		$a2=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_id desc')->select();
		
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
			$arts=$art->alias('a')->field('a.art_id,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
			->where($where1)->limit($page->firstRow.','.$page->listRows)->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			

			//查询取出本栏目点击最高的5篇文章标题
			$a1=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_click')->select();
			//查询取出本栏目推荐的文章标题
			$a2=$art->field('art_id,art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			//获取当前位置并赋值到模版
			$location=$this->showLocationOfList($pro);
			$this->assign('location',$location);
			
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
	    		$this->display('list');
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
		->where("art_topid=$id")->limit($page->firstRow.','.$page->listRows)->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where("art_topid=$id")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where("art_topid=$id")->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			
		//获取当前位置并赋值到模版
		$location=$this->showLocationOfList($pro);
		$this->assign('location',$location);
		
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
		$this->display('list');
    		
    }
    
      //程序世界列表页
	public function program(){
			$title       = 'IT世界';
		
		
		//如果没有通过get传递u参数,name说明访问的顶级栏目
    		if(!$_GET['u']){	    			
	    		//实例化数据表
	    		$art=M('article');
			$pro=M('program');
			
			//取出IT世界下的子栏目
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
			$arts=$art->alias('a')->field('a.art_id,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
			->where($where1)->limit($page->firstRow.','.$page->listRows)->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			

			//查询取出本栏目点击最高的5篇文章标题
			$a1=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_click')->select();
			//查询取出本栏目推荐的文章标题
			$a2=$art->field('art_id,art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
			//获取当前位置并赋值到模版
			$location=$this->showLocationOfList($pro);
			$this->assign('location',$location);
			
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
	    		$this->display('list');
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
		$arts=$art->alias('a')->field('a.art_id,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where("art_topid=$id")->limit($page->firstRow.','.$page->listRows)->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
			
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where("art_topid=$id")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where("art_topid=$id")->where('art_recommend=1')->limit('5')->order('art_click')->select();
			
		//获取当前位置并赋值到模版
		$location=$this->showLocationOfList($pro);
		$this->assign('location',$location);
		
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
		$this->display('list');
	    }
	    
	    
	//个人简介页面
	public function about(){
		//获取简介的数据
		$art=M('article');
		$pro=M('program');
		
		$arts=$art->where('art_topid=-1')->find();
			
		//取出健身世界和程序世界下的子栏目
		$pros1=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=1')->select();
		$pros2=$pro->field('pro_id,pro_name,pro_url')->where('pro_topid=2')->select();
		
		//设定查询条件
		for($i=0;$i<count($pros1);$i++){
			$proid1[]=$pros1[$i]['pro_id'];
		}
		$where1['art_topid']=array('in',$proid1);
		
		for($i=0;$i<count($pros2);$i++){
			$proid2[]=$pros2[$i]['pro_id'];
		}
		$where2['art_topid']=array('in',$proid2);
		

		
		//取出侧边栏数据
		$a1=$art->field('art_id,art_title')->where($where1)->limit('5')->order('art_id desc')->select();
		$a2=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_id desc')->select();
		
		$this->assign('arts',$arts);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);

		
		$this->display();
	}
	
	//文章页面
	public function art(){
		//判断是否有get传递的id数据
		if(!isset($_GET['id'])){
			$this->error('您访问的文章不存在!','../../');
		}
		$id=$_GET['id'];
		$art=M('article');
		//文章的点击数+1
		$art->art_click=$art->where("art_id=$id")->getField('art_click')+1;
		//更新数据库
		$art->where("art_id=$id")->save(); 
		
		$location=$this->showLocationOfArt($art,$id);
		//取出文章数据
		$arts=$art->where("art_id=$id")->find();
		$topid=$arts['art_topid'];
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where("art_topid=$topid")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where("art_topid=$topid")->where('art_recommend=1')->limit('5')->order('art_click')->select();

		//取出下一篇和上一篇文章的id
		$set_id=$art->where("art_topid=$topid")->getField('art_id',true);
		//获取当前文章id的下标
		$current=array_search($id, $set_id);
		//获取上一篇本栏目文章id的下标
		$prev=$current==0?-1:$current-1;
		//获取下一篇本栏目文章id的下标
		$next=$current==(count($set_id)-1)?-1:$current+1;
		//根据id的下标取出id值
		$prev_id=$set_id[$prev];
		$next_id=$set_id[$next];
		
		//根据id取出文章标题
		if($prev<0){
			$prev_title='没有文章了!';
			
		}else{
			$prev_title=$art->where("art_id=$prev_id")->getField('art_title');
			
		}
		
		if($next<0){
			$next_title='没有文章了!';
				
		}else{
			$next_title=$art->where("art_id=$next_id")->getField('art_title');
				
		}
		
		//根据文章id平凑当前位置字符串
		$location=$this->showLocationOfArt($art,$id);
		$this->assign('location',$location);
		
		//赋值到模版
		
		$this->assign('prev_id',$prev_id);
		$this->assign('prev_title',$prev_title);
		$this->assign('next_id',$next_id);
		$this->assign('next_title',$next_title);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		
		$this->assign('arts',$arts);
		$this->display();
		
	}
	
	public function showLocationOfList($pro){
		//定义字符串
		$location="当前位置:<a href='http://www.mynote2.com'>主页</a> > ";
		//获取uri
		$loc=$_SERVER['PHP_SELF'];
		
		//截取方法名,并拼凑到字符串
		$loc=substr($loc,strpos($loc, 'ndex/')+5);
		//判断是否有/u参数
		$stop=strpos($loc, '/u');
		
		//截取字符串获取当前方法名
		if(!strstr($loc,'/',true)){
			$func=$loc;
		}else{
			$func=strstr($loc,'/',true);
		}
		
		$name1=$pro->where("pro_url='$func'")->getField('pro_name');
		$location.="<a href='http://www.mynote2.com/index.php/index/$func'>$name1</a>";
		
		//如果没有/u参数,返回当前拼凑好的字符串
		if(!$stop){
			return $location;
		}
		
		//如果有/u参数,截取u参数,并拼凑到字符串中
		$loc=substr($loc,strpos($loc,'/u/')+3);
			//截取字符串获取当前方法名
		if(!strstr($loc,'/',true)){
			$u=$loc;
		}else{
			$u=strstr($loc,'/',true);
		}
		$name2=$pro->where("pro_url='$u'")->getField('pro_name');
		$location.="> <a href='http://www.mynote2.com/index.php/index/$func/u/$u'>$name2</a>";
		return $location;
	}
	
	private function showLocationOfArt($art,$id){
		//初始化字符串
		$location="当前位置:<a href='http://www.mynote2.com'>主页</a> > ";
		//根据$id获取所属栏目和顶级栏目名和url
		$programOfArt=$art->alias('a')->where("art_id=$id")->field('a.art_topid,p.pro_name,p.pro_url,p.pro_topid')
		->join('left join tp_program p on a.art_topid=p.pro_id') ->find();

		//根据$programOfArt['pro_topid'],获取顶级栏目名和url
		$id=$programOfArt['pro_topid'];
		$pro=M('program');
		$programOfTop=$pro->field('pro_name,pro_url')->where("pro_id=$id")->find();
		
		$location.="<a href='http://www.mynote2.com/index.php/index/{$programOfTop["pro_url"]}'>{$programOfTop['pro_name']}</a>";
		$location.=" > <a href='http://www.mynote2.com/index.php/index/{$programOfTop["pro_url"]}/u/{$programOfArt["pro_url"]}'>{$programOfArt['pro_name']}</a>";
		return $location;
	}
}