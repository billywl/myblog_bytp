<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/Style/skin.css" />
<script type='text/javascript'>
	function addProgram() {
		location = '/admin.php/Program/addTop';
	}
	function confirmDel() {
		return confirm('确认删除本栏目!');
	}
</script>
</head>
<body>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<!-- 头部开始 -->
		<tr>
			<td width="17" valign="top" background="/Images/mail_left_bg.gif">
				<img src="/Images/left_top_right.gif" width="17" height="29" />
			</td>
			<td valign="top" background="/Images/content_bg.gif">
				<table width="100%" height="31" border="0" cellpadding="0"
					cellspacing="0" background="/Images/content_bg.gif">
					<tr>
						<td height="31"><div class="title">添加栏目</div></td>
					</tr>
				</table>
			</td>
			<td width="16" valign="top" background="/Images/mail_right_bg.gif"><img
				src="/Images/nav_right_bg.gif" width="16" height="29" /></td>
		</tr>
		<!-- 中间部分开始 -->
		<tr>
			<!--第一行左边框-->
			<td valign="middle" background="/Images/mail_left_bg.gif">&nbsp;</td>
			<!--第一行中间内容-->
			<td valign="top" bgcolor="#F7F8F9">
				<table width="100%" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<!-- 空白行-->
					<tr>
						<td colspan="2" valign="top">&nbsp;</td>
						<td>&nbsp;</td>
						<td valign="top">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="4">
							<table>
								<tr>
									<td width="100" align="center"><img src="/Images/mime.gif" /></td>
									<td valign="bottom"><input type="button" name="button"
										value="添加顶级栏目" onclick='addProgram()' /></td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- 一条线 -->
					<tr>
						<td height="40" colspan="4">
							<table width="100%" height="1" border="0" cellpadding="0"
								cellspacing="0" bgcolor="#CCCCCC">
								<tr>
									<td></td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- 添加栏目开始 -->
					<tr>
						<td width="2%">&nbsp;</td>
						<td width="96%">
							<table width="100%">
								<tr>
									<td colspan="2">
										<form action="" method="">
											<table width="100%" class="cont tr_color">

												<tr>
													<th>栏目id</th>
													<th align="left">栏目名称</th>
													<th>父栏目id</th>
													<th>添加子类</th>
													<th>编辑</th>
													<th>删除</th>
												</tr>
												<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" class="d">
													<td><?php echo ($vo["pro_id"]); ?></td>													
													<td align="left"><?php echo (str_repeat("<---",$vo["count"])); echo ($vo["pro_name"]); ?></td>
													<td><?php echo ($vo["pro_tname"]); ?></td>
													<td><a href='/admin.php/Program/addSon?id=<?php echo ($vo["pro_id"]); ?>'>点击添加子类</a></td>
													<td><a href='/admin.php/Program/edit?id=<?php echo ($vo["pro_id"]); ?>'>点击编辑</a></td>
													<td><a href='/admin.php/Program/delete?id=<?php echo ($vo["pro_id"]); ?>'
														onclick="if(confirm('确定删除?')==false) return false;">点击删除</a></td>
												</tr><?php endforeach; endif; else: echo "" ;endif; ?>


											</table>
										</form>
									</td>
								</tr>
							</table>
						</td>
						<td width="2%">&nbsp;</td>
					</tr>
					<!-- 添加栏目结束 -->
					<tr>
						<td height="40" colspan="4">
							<table width="100%" height="1" border="0" cellpadding="0"
								cellspacing="0" bgcolor="#CCCCCC">
								<tr>
									<td></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td width="2%">&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
			<td background="/Images/mail_right_bg.gif">&nbsp;</td>
		</tr>
		<!-- 底部部分 -->
		<tr>
			<td valign="bottom" background="/Images/mail_left_bg.gif"><img
				src="/Images/buttom_left.gif" width="17" height="17" /></td>
			<td background="/Images/buttom_bgs.gif"><img
				src="/Images/buttom_bgs.gif" width="17" height="17"></td>
			<td valign="bottom" background="/Images/mail_right_bg.gif"><img
				src="/Images/buttom_right.gif" width="16" height="17" /></td>
		</tr>
	</table>
</body>
</html>