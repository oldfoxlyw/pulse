<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="<?php echo site_url("user/login/submit"); ?>">
	<p>
  <label for="accountName">用户名</label>
  <input type="text" name="accountName" id="accountName" />
    </p>
    <p>
  <label for="accountPass">密码</label>
  <input type="text" name="accountPass" id="accountPass" />
  	</p>
    <p>
  <input type="checkbox" name="cookieRemain" id="cookieRemain" value="1" />
  <label for="cookieRemain">自动登录</label>
  	</p>
    <p>
  <input type="submit" name="button" id="button" value="提交" />
  	</p>
</form>
</body>
</html>