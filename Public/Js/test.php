<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title> new document </title>
  <meta name="generator" content="editplus" />
  <meta name="author" content="" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
    <script src='jquery.min.js'></script>
 </head>

 <body>
 <form>
	<input type='checkbox' class='top' />top
	<input type='checkbox' class='sub' />sub1
	<input type='checkbox' class='sub' />sub2
  </form>

  <script >
  var flag=1;
	$('.top').bind('click',function(){
		if((flag%2)!=0){
			$('.sub').attr('checked','checked');
			flag++;
		}else{
			$('.sub').removeAttr('checked');
			flag++;
		}
	});

</script>
 </body>
</html>
<?php
	var_dump($_POST);
