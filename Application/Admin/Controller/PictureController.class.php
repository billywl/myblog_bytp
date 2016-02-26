<?php
namespace Admin\Controller;
//文章控制器
class PictureController extends CheckController{
	public function upLoadPic(){
		//没有post就直接加载添加页面
		if(!$_POST){
			$this->display();
		}else{

			//如果 有post数据	
			//接收文件信息
			$info=$this->getUpLoadFile();
			if(!$info) {
				// 上传错误提示错误信息
				$this->error('图片上传失败');
				return;
			}
				
			//生成图片文件的缩略图并打上为文字水印
			$flag=$this->getThumbAndWater ($info);
	
			var_dump($info);
			//将数据写入数据库
			if($flag){
				$this->success('添加成功','upLoadPic');
			}else{
				//添加失败
				$this->error('添加失败','upLoadPic');
			}
		}	
	}
	
	
	/**
	 * 接收表单的提交的图片并保存
	 * @return $info mixed 上传成功为图片的信息,失败为false
	 */
	private function getUpLoadFile(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =     './Uploads/Images/'; // 设置附件上传根目录
		$upload->savePath  =     ''; // 设置附件上传（子）目录
		// 上传文件
		$info   =   $upload->upload();
		return  $info;
	}
	
	/**
	 * 生成图片文件的缩略图并打上为文字水印
	 * @param $info tp方式获取的上传图片信息
	 */
	 private function getThumbAndWater($info) {
		 //实例化图片类
		$image = new \Think\Image();
		//打开上传的图片
		$image->open("./Uploads/Images/{$info['pic']['savepath']}{$info['pic']['savename']}");
		
		//生成缩略图
		$image->thumb(200, 150,\Think\Image::IMAGE_THUMB_FIXED)->save("./Uploads/Images/{$info['pic']['savepath']}thumb.{$info['pic']['savename']}");
		
		// 缩略图添加文字水印
		$image->text('会健身的程序员','./Uploads/cai.ttf',10,'#ff5151',9)
		->save("./Uploads/Images/{$info['pic']['savepath']}thumb.{$info['pic']['savename']}");
		
		// 给原图添加文字水印
		$flag=$image->open("./Uploads/Images/{$info['pic']['savepath']}{$info['pic']['savename']}")
		->text('会健身的程序员','./Uploads/cai.ttf',30,'#ff5151',9)
		->save("./Uploads/Images/{$info['pic']['savepath']}{$info['pic']['savename']}");
		return $flag;
	}
}	