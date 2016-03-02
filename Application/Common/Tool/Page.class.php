<?php
namespace Common\Tool;
	//分页类
	class Page{
		public $firstRow; // 起始行数
		public $listRows; // 列表每页显示行数
		public $parameter; // 分页跳转时要带的参数
		public $totalRows; // 总行数
		public $totalPages; // 分页总页面数
		public $rollPage   = 10;// 分页栏每页显示的页数
		public $lastSuffix = true; // 最后一页是否显示总页数
		
		private $p       = 'p'; //分页参数名
		private $url     = ''; //当前链接URL
		private $nowPage = 1;
		
		/**
		 * 分页方法
		 * @param int $basename 请求的目标文件
		 * @param int $counts 总记录数
		 * @param int $page 当前页码
		 * @return string 具有分页点击a标签的字符串
		 * 示例:每页总共多少条记录,每页显示多少条记录,当前是第几页,<a>首页</a>,<a>前一页</a>,<a>后一页</a>,<a>末页</a>
		 */	
		public static function show($basename,$counts,$pageSize,$page=1){
			//计算出中总页数
			$pageCounts=ceil($counts/$pageSize);
/* 			//select下拉框分页
			$select = "<span id='select_page'>&nbsp;&nbsp;当前为第<select onchange=\"location.href='$basename/p/'+this.value\">";
			//循环遍历
			for($i = 1;$i <= $pageCounts;$i++){
				if($page == $i){
					//默认选中当前页
					$select .= "<option value='$i' selected='selected'>{$i}页</option>";
				}else{
					$select .= "<option value='$i'>{$i}页</option>";
				}
			}
			//完善select
			$select .= "</select></span>&nbsp;&nbsp;&nbsp;&nbsp"; */
			
			
			//计算上一页和下一页
			$prev=($page ==1)?$page:($page-1);
			$next=($page==$pageCounts)?$page:($page+1);
			$str= <<<ENDF
				每页显示{$pageSize}条记录,总共有 {$counts}条记录,&nbsp;&nbsp;&nbsp;&nbsp;
ENDF;
			
			//当总页数小于6时,直接列出全部页的链接
			$click='<span id="click_page">';
			if($pageCounts<6){
				for($i=1;$i<=$pageCounts;$i++){
				//每页增加一个数字a标签
				$click .="<a href='#' onclick='show($i)'>$i</a>&nbsp;&nbsp;&nbsp;&nbsp;</span>";
				}return $str.$click;	
			//当总页数大于6时,列出效果为首页...前一页 选中页 下一页...	
			}else{
				if($page<=3){
					for($i=1;$i<=4;$i++){
						//当总页数大于5且选中页数小于等于3时,列出所有前4个标签和...
						$click .="<a href='$basename/p/$i'>$i</a>&nbsp;&nbsp;";
					}return $str.$click."...&nbsp;&nbsp;</span>$select";
				}elseif($page>3&&$page<$pageCounts-1){
					//当总页数大于5且选中页数大于等于4时,且选中页小于总页数-1时 列出效果为首页...前一页 选中页 下一页...
					$click .="<a href='$basename/p/1'>1</a>&nbsp;&nbsp;...";
					$click .="<a href='$basename/p/$prev'>$prev</a>&nbsp;&nbsp;";
					$click .="<a href='$basename/p/$page'>$page</a>&nbsp;&nbsp;";
					$click .="<a href='$basename/p/$next'>$next</a>&nbsp;&nbsp;...&nbsp;&nbsp;</span>";
					return $str.$click.$select;
				}else{
					$click .="<a href='$basename?page=1'>1</a>&nbsp;&nbsp;...";
					if($page==$pageCounts-1){
					//当总页数大于5且选中页数等于总页数-1时,列出效果为首页...前一页 选中页 下一页
						$click .="<a href='$basename?page=$prev'>$prev</a>&nbsp;&nbsp;";
						$click .="<a href='$basename?page=$page'>$page</a>&nbsp;&nbsp;";
						$click .="<a href='$basename?page=$next'>$next</a>&nbsp;&nbsp;</span>";
					}else{
						//当总页数大于5且选中页数等于总页数-1时,列出效果为首页...前一页 选中页
						$click .="<a href='$basename?page=$prev'>$prev</a>&nbsp;&nbsp;";
						$click .="<a href='$basename?page=$page'>$page</a>&nbsp;&nbsp;</span>";
					}return $str.$click.$select;
				}

			}
		}	
	}