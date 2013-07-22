				<div class="account-container">
					<div class="account-details">
						<span class="account-name"><?php echo $admin->admin_name; ?></span>
						<span class="account-role"><?php echo $admin->role_name; ?></span>
						<span class="account-actions">
							<a href="javascript:;">密码修改</a> |
							<a href="<?php echo site_url('login/out'); ?>">退出登录</a>
						</span>
					</div> <!-- /account-details -->
				</div> <!-- /account-container -->
				<hr />
				<ul id="main-nav" class="nav nav-tabs nav-stacked">
					<li<?php if($page_name=='index'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('index'); ?>">
							<i class="icon-home"></i>
							管理首页
						</a>
					</li>
                    <hr />
					<li<?php if($page_name=='news'): ?> class="active"<?php endif; ?>>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							新闻管理
						</a>
					</li>
					<li<?php if($page_name=='screenshot'): ?> class="active"<?php endif; ?>>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							截图管理
						</a>
					</li>
					<li<?php if($page_name=='activity'): ?> class="active"<?php endif; ?>>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							日常活动
						</a>
					</li>
					<li<?php if($page_name=='mail_template'): ?> class="active"<?php endif; ?>>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							邮件模版
						</a>
					</li>
                    <hr />
					<li<?php if($page_name=='product'): ?> class="active"<?php endif; ?>>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							产品管理
						</a>
					</li>
					<li<?php if($page_name=='server_list'): ?> class="active"<?php endif; ?>>
						<a href="./charts.html">
							<i class="icon-signal"></i>
							服务器管理
						</a>
					</li>
					<hr />
					<li<?php if($page_name=='account'): ?> class="active"<?php endif; ?>>
						<a href="./account.html">
							<i class="icon-user"></i>
							帐号管理
						</a>
					</li>
					<li<?php if($page_name=='order'): ?> class="active"<?php endif; ?>>
						<a href="./login.html">
							<i class="icon-lock"></i>
							订单查询
						</a>
					</li>
					<li<?php if($page_name=='appeal'): ?> class="active"<?php endif; ?>>
						<a href="./login.html">
							<i class="icon-lock"></i>
							在线申诉
						</a>
					</li>
					<li<?php if($page_name=='coupon'): ?> class="active"<?php endif; ?>>
						<a href="./login.html">
							<i class="icon-lock"></i>
							礼券
						</a>
					</li>
					<hr />
					<li<?php if($page_name=='admin_role'): ?> class="active"<?php endif; ?>>
						<a href="./faq.html">
							<i class="icon-pushpin"></i>
							管理员角色
						</a>
					</li>
					<li<?php if($page_name=='admin'): ?> class="active"<?php endif; ?>>
						<a href="./plans.html">
							<i class="icon-th-list"></i>
							管理员
						</a>
					</li>
					<li<?php if($page_name=='log'): ?> class="active"<?php endif; ?>>
						<a href="./plans.html">
							<i class="icon-th-list"></i>
							操作日志
						</a>
					</li>
				</ul>