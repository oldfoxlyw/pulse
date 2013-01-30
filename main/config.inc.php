<?php

define('UC_CONNECT', 'mysql');				// 连接 UCenter 的方式: mysql/NULL, 默认为空时为 fscoketopen()
							// mysql 是直接连接的数据库, 为了效率, 建议采用 mysql

define('UC_DBHOST', 'localhost');
define('UC_DBUSER', 'root');
define('UC_DBPW', '84@41%%wi96^4');
define('UC_DBNAME', 'pulse_db_ucenter');
define('UC_DBCHARSET', 'utf8');
define('UC_DBTABLEPRE', '`pulse_db_ucenter`.uc_');
define('UC_DBCONNECT', '0');
define('UC_KEY', 'a7ba9540d547843ad43d253f1b609cc24ce9c6b3');
define('UC_API', 'http://localhost/ucenter');
define('UC_CHARSET', 'utf-8');
define('UC_IP', '');
define('UC_APPID', '2');
define('UC_PPP', '20');

$cookiepre = 'pulse_';
$cookiedomain = ''; 			// cookie 作用域
$cookiepath = '/';			// cookie 作用路径
$cookieexpire = '86400';