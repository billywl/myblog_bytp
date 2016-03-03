<?php

namespace Admin\Controller;
use Common\Tool\Page;
class UpdateController extends CheckController {
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
			$this->success('更新主页成功!','../article/add');
		}else{
			$this->error('更新主页失败!','../article/add');
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
			$this->success('更新主页成功!','../article/add');
		}else{
			$this->error('更新主页失败!','../article/add');
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
			$this->success('更新主页成功!','../article/add');
		}else{
			$this->error('更新主页失败!','../article/add');
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
		$html=$this->buildHtml("$id.html",'/art/','art');
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
		$t_url=$pro->where("pro_id=$searchId")->getField('pro_url');
		$title=$pro->where("pro_id=$searchId")->getField('pro_name');
		$this->assign('t_url',$t_url);
		$this->assign('title',$title);
		

		//取出顶级栏目下的子栏目
		$pros=$pro->field('pro_id,pro_name,pro_url')->where("pro_topid=$searchId")->select();
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
			$show       = $page->show("http://www.mynote2.com/$t_url/index.html",$count,5);
			
			//赋值到模版,模版中调用{$show}即可
			$this->assign('show',$show);

	
		//联合查询取出文章数据和所属栏目
		$arts=$art->alias('a')->field('a.art_id,a.art_purl,a.art_title,a.art_description,a.art_writer,a.art_topid,a.art_click,a.art_source,a.art_time,p.pro_name')
		->where($where1)->limit('0,5')->order('art_id desc')->join('left join tp_program p on a.art_topid=p.pro_id')->select();
	
	
		//查询取出本栏目点击最高的5篇文章标题
		$a1=$art->field('art_id,art_title')->where($where2)->limit('5')->order('art_click')->select();
		//查询取出本栏目推荐的文章标题
		$a2=$art->field('art_id,art_title')->where($where2)->where('art_recommend=1')->limit('5')->order('art_click')->select();
	
		//获取当前位置并赋值到模版
		//$location=$this->showLocationOfList($pro);
		//$this->assign('location',$location);
	
		//赋值到模版
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		$html=$this->buildHtml("index.html","./{$t_url}/",'list');
		
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
		$t_url=$pro->where("pro_id=$searchId")->getField('pro_url');
		$title=$pro->where("pro_id=$searchId")->getField('pro_name');
		$t_id=$pro->where("pro_id=$searchId")->getField('pro_topid');
		$this->assign('t_url',$t_url);
		$this->assign('title',$title);
		$this->assign('searchId',$searchId);
		
		
		//取出同栏目下的子栏目
		$pros=$pro->field('pro_id,pro_name,pro_url')->order('pro_id')->where("pro_topid=$t_id")->select();
		$this->assign('pros',$pros);
	
		//取出父栏目的url
		$f_url=$pro->where("pro_id=$t_id")->getField('pro_url');
		
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
		//$location=$this->showLocationOfList($pro);
		//$this->assign('location',$location);
		
		//赋值到模版
		$this->assign('a1',$a1);
		$this->assign('a2',$a2);
		$this->assign('pros',$pros);
		$this->assign('arts',$arts);
		$this->assign('show',$show);
		
		$html=$this->buildHtml("index.html","./$f_url/{$t_url}/",'list');
		
		return $html;
		/* 		if($html){
		 $this->success('更新主页成功!','../article/add');
		 }else{
		 $this->error('更新主页失败!','../article/add');
		 } */
		//加载模版文件,然后返回
		//$this->display('list');
				
		}
}