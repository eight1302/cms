<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传缩略图</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
</head>
<body id="main">

<form method="post" action="../config/upload.php" enctype="multipart/form-data" style="text-align:center;margin:30px;">
	<input type="hidden" name="size" value="<?php echo $_GET['size']?>" />
	<input type="hidden" name="type" value="<?php echo $_GET['type']?>" />
	<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />
	<input type="file" name="pic" />
	<input type="submit" name="send" value="确定上传" />
</form>

</body>
</html>