<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="<?php echo site_url('user/register/submit'); ?>">
  <p>
    <label for="accountName">用户名</label>
    <input type="text" name="accountName" id="accountName" />
  </p>
  <p>
    <label for="accountPass">密码</label>
    <input type="text" name="accountPass" id="accountPass" />
  </p>
  <p>
    <input type="radio" name="accountSex" id="accountSex1" value="1" />
    <label for="accountSex1">男</label>
    <input type="radio" name="accountSex" id="accountSex2" value="0" />
    <label for="accountSex2">女</label>
  </p>
  <p>
    <label for="accountEmail">Email</label>
    <input type="text" name="accountEmail" id="accountEmail" />
  </p>
  <p>
    <label for="accountRealName">真实姓名</label>
    <input type="text" name="accountRealName" id="accountRealName" />
  </p>
  <p>
    <label for="accountIdentity">身份证号</label>
    <input type="text" name="accountIdentity" id="accountIdentity" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="提交" />
  </p>
</form>
</body>
</html>