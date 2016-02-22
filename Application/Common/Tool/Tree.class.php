<?php
namespace Common\Tool;

class Tree{
	static public $treeList = array(); //存放无限分类结果如果一页面有多个无限分类可以使用 Tool::$treeList = array(); 清空
	/**
	 * 无限级分类
	 * @access public
	 * @param Array $data     //数据库里获取的结果集
	 * @param Int $pid
	 * @param Int $count       //第几级分类
	 * @return Array $treeList
	*/
	static public function tree(&$data,$pid = 0,$count = 0) {
		foreach ($data as $key => $value){
			if($value['pro_topid']==$pid){
				$value['count'] = $count;
				self::$treeList []=$value;
				unset($data[$key]);
				self::tree($data,$value['pro_id'],$count+1);
			}
		}
		return self::$treeList ;
	}
	
	/**
	 * 无限极分类,并跳过
	 * @param array $data 需要进行分组的数组
	 * @param int $stop_id 默认为0表示获取全部
	 * @param int $pid 当前需要查询的顶级分类的id,默认为0
	 * @param int $count 默认是0,表示第一层
	 * @return array 返回一个已经分类的数组
	 */
	static public function tree2(&$data,$stop_id=0,$pid=0,$count=0){
			
		//遍历数组,进行数据判断
		foreach($data as $value){
			//盘点数据的父分类id
			if($value['pro_topid']==$pid){
				if($value['pro_id']!=$stop_id){
					$value['count']=$count;
					self::$treeList[]=$value;
						
					//递归点,当前分类可能有子分类
					self::tree2($data,$stop_id,$value['pro_id'],$count+1);
				}
			}
		}
		return self::$treeList;
	}
}