<?php

namespace Admin\Controller;
use Common\Tool\Page;
class UpdateController extends CheckController {
	
	/**
	 * 一键更新
	 */
	public function updateAll(){
		$this->index();
		$this->program();
		$this->article();				
		$this->about();				
	}
	
	/**
	 * 更新页面
	 */
	public function update(){
		$this->display();
	}
	/**
	 * 更新主页
	 */
	public function index() {
		$art=M('article');
		$pro=M('program');
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_id,a.art_title,a.art_purl,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
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
		
		//赋值给模版并加载模版
		$this->assign('arts',$arts);
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
				
		$html=$this->buildHtml('index.html','./','index');
		
		if($html){
			$this->success('更新主页成功!','update');
		}else{
			$this->error('更新主页失败!','update');
		}
	}	
	
	/**
	 * 更新栏目页
	 */
	public function program() {
		$pro=M('program');
		$arr=$pro->getField('pro_id',true);

		$num=0;
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]>=3){
				if($this->updateSon($arr[$i])){
					 $num++;
				}
			}else{
				if($this->updateTop($arr[$i])){
					$num++;
				}
			}	
				
		}
		if($num==10){	
			$this->success('更新栏目成功!','update');
		}else{
			$this->error('更新栏目失败!','update');
		}
	}

	/**
	 * 更新全部文章页
	 */
	public function article(){
		$art=M('article');
		$arr=$art->where('art_topid>0')->getField('art_id',true);
		$num=$art->count('art_id')-1;
		foreach ($arr as $value){
			if($this->updateArticle($value)){				
				$num--;
			}			
		}
		if(!$num){	
			$this->success('更新文章成功!','update');
		}else{
			$this->error("更新文章失败,还有$num篇未更新",'update');
		}
	}
	
	/**
	 * 更新简介页面
	 */
	public function about(){
		$art=M('article');
		$pro=M('program');
		//联合查询取出文章数据和所属栏目
		
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
		
		//赋值给模版并加载模版

		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
				
		$html=$this->buildHtml('about.html','./index/','about');
		
		if($html){
			$this->success('更新简介成功!','update');
		}else{
			$this->error('更新简介失败!','update');
		}
	}
	/**
	 * 根据$id更新文章页 存放目录/art/$id.html
	 */
	private function updateArticle($id){
		$art=M('article');
		$aart=M('addonarticle');
				
		//取出文章数据
		$arts=$art->where("art_id=$id")->find();
		$body=$aart->where("art_id=$id")->getField('art_body');
		
		//取出文章的的栏目id
		$topid=$arts['art_topid'];
		
		$pro=M('program');
		//根据栏目id取出栏目topid
		$t_topid=$pro->where("pro_id=$topid")->getField('pro_topid');
		
		//根据栏目$t_topid取出顶级栏目的url
		$t_url=$pro->where("pro_id=$t_topid")->getField('pro_url');
		
		//根据顶级栏目$t_topid取出子栏目url和name
		$pros=$pro->where("pro_topid=$t_topid")->field('pro_url,pro_name')->select();
		
		//将取出的文章内容进行实体标签转换
		$body=htmlspecialchars_decode($body);
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where("art_topid=$topid")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where("art_topid=$topid and art_recommend=1")->limit('5')->order('art_click')->select();
		
 		//根据当前文章的id和topid取出相同栏目下的前后文章id和标题,然后赋值到模版
		$this->getArtOfNearby ( $id, $topid,$art );
		
		//根据文章id平凑当前位置字符串
		$location=$this->showLocationOfArt($id,$art,$pro); 
		
		//赋值到模版
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('t_url',$t_url);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('body',$body);
		$html=$this->buildHtml("$id.html",'./art/','art');
		return $html; 
	}
	/**
	 * 根据pro_id更新顶级栏目,生成栏目首页然后使用ajax分页完成分页
	 * @param $searchId 栏目的pro_id
	 */
	private function updateTop($searchId){
			
		//实例化数据表
		$art=M('article');
		$pro=M('program');
		//取出本栏目的url
		$f_url=$pro->where("pro_id=$searchId")->getField('pro_url');
		$title=$pro->where("pro_id=$searchId")->getField('pro_name');
		$this->assign('f_url',$f_url);
		$this->assign('title',$title);
		$this->assign('searchId',$searchId);

		//取出顶级栏目下的子栏目
		$pros=$pro->field('pro_id,pro_name,pro_url')->order('pro_id')->where("pro_topid=$searchId")->select();
		$this->assign('pros',$pros);
		//设定查询条件
		for($i=0;$i<count($pros);$i++){
			$proid[]=$pros[$i]['pro_id'];
		}
		$where1['pro_id']=array('in',$proid);
		$where2['art_topid']=array('in',$proid);
	
		//获取查询到的中记录数
		$count=$art->field('art_title')->where($where2)->count();
	
			//实例化系统的分页类
			$page       = new Page(); 
			
			//获取页脚输出的字符串
			$show       = $page->show("http://www.mynote2.com/$f_url/index.html",$count,5);
			
			//赋值到模版,模版中调用{$show}即可
			$this->assign('show',$show);

	
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_id,a.art_purl,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where($where1)->limit('0,5')->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
	
	
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
		
		//赋值到模版
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		
		//获取当前位置并赋值到模版
		$location=$this->showLocationOfList($f_url, $title);
		$this->assign('location',$location);
		$html=$this->buildHtml("index.html","./$f_url/",'list');
		return $html;			
	}
			
	/**
	 *  根据pro_id更新二级栏目,生成栏目首页然后使用ajax分页完成分页
	 *  @param $searchId 栏目的pro_id
	 */
	private function updateSon($searchId){
		//实例化数据表
		$art=M('article');
		$pro=M('program');
		
		//取出本栏目的url
		$t_id=$pro->where("pro_id=$searchId")->getField('pro_topid');
		$t_url=$pro->where("pro_id=$searchId")->getField('pro_url');
		$title=$pro->where("pro_id=$searchId")->getField('pro_name');
		$this->assign('title',$title);
		$this->assign('searchId',$searchId);


		
		
		//取出同栏目下的子栏目
		$pros=$pro->field('pro_id,pro_name,pro_url')->order('pro_id')->where("pro_topid=$t_id")->select();
		$this->assign('pros',$pros);
	
		//取出父栏目的url
		$f_url=$pro->where("pro_id=$t_id")->getField('pro_url');
		$title1=$pro->where("pro_id=$t_id")->getField('pro_name');
		$this->assign('f_url',$f_url);
		//获取查询到的中记录数
		$count=$art->field('art_title')->where("art_topid=$searchId")->count();
		
		//实例化系统的分页类
		$page       = new Page();
			
		//获取页脚输出的字符串
		$show       = $page->show("http://www.mynote2.com/$f_url/$t_url/index.html",$count,5);
			
		//赋值到模版,模版中调用{$show}即可
		$this->assign('show',$show);
		
		
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_id,a.art_purl,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where("art_topid=$searchId")->limit('0,5')->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
		
		
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where("art_topid=$searchId")->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where("art_topid=$searchId and art_recommend=1")->limit('5')->order('art_click')->select();
		
		//获取当前位置并赋值到模版
		$location=$this->showLocationOfList($f_url, $title1,$t_url,$title);
		$this->assign('location',$location);
		
		//赋值到模版
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		$html=$this->buildHtml("index.html","./$f_url/{$t_url}/",'list');
		
		return $html;
		}
		
	/**
	 * 根据当前文章的id和topid取出相同栏目下的前后文章id和标题,然后赋值到模版
	 * 	上一篇文章为$prev_id和$prev_title
	 * 	下一篇文章为$next_id和$next_title
	 * @param id 当前文章id
	 * @param topid 当前文章的topid
	 * @param art 表对象
	 */
	private function getArtOfNearby($id, $topid,$art) {
		//取出下一篇和上一篇文章的id
		$set_id=$art->where("art_topid=$topid")->order('art_id')->getField('art_id',true);
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
		
		//赋值到模版
		$this->assign('prev_id',$prev_id);
		$this->assign('prev_title',$prev_title);
		$this->assign('next_id',$next_id);
		$this->assign('next_title',$next_title);
	}	
	

	/**
	 * 列表页查询当前位置的方法
	 * @param $pro program模型对象
	 * @return string 拼凑好的当前位置字符串
	 */
	private function showLocationOfList($f_url,$title1,$t_url='',$title2=''){
		//定义字符串
		$location="当前位置:<a href='http://www.mynote2.com/index.html'>主页</a> > ";
		//获取url
		$location.="<a href='http://www.mynote2.com/$f_url/index.html' >$title1</a>";
		if($t_url){
			$location.=" ><a href='http://www.mynote2.com/$f_url/$t_url/index.html'>$title2</a>";
			return $location;
		}else{
			return $location;
		}
	}
	
	/**
	 * 文章页查询当前位置的方法,拼凑好字符串后赋值给模版$location
	 * @param $art article模型对象
	 * @param $id 当前文章id
	 */
	private function showLocationOfArt($id,$art,$pro){
		//初始化字符串
		$location="当前位置:<a href='http://www.mynote2.com'>主页</a> > ";
		//根据$id获取所属栏目和顶级栏目名和url
		$programOfArt=$art->alias('a')->where("art_id=$id")->field('a.art_topid,p.pro_name,p.pro_url,p.pro_topid')
		->join('left join tp_program p on a.art_topid=p.pro_id') ->find();
	
		//根据$programOfArt['pro_topid'],获取顶级栏目名和url
		$id=$programOfArt['pro_topid'];
		$programOfTop=$pro->field('pro_name,pro_url')->where("pro_id=$id")->find();
	
		$location.="<a href='http://www.mynote2.com/{$programOfTop["pro_url"]}/index.html'>{$programOfTop['pro_name']}</a>";
		$location.=" > <a href='http://www.mynote2.com/{$programOfTop["pro_url"]}/{$programOfArt["pro_url"]}/index.html'>{$programOfArt['pro_name']}</a>";
		$this->assign('location',$location);
	}
}