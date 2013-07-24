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
						<a href="<?php echo site_url('news/lists'); ?>">
							<i class="icon-th-large"></i>
							新闻管理
						</a>
					</li>
					<li<?php if($page_name=='news_publish'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('news/publish'); ?>">
							<i class="icon-th-large"></i>
							发布新闻
						</a>
					</li>
					<li<?php if($page_name=='screenshot'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('screenshot/lists'); ?>">
							<i class="icon-th-large"></i>
							截图管理
						</a>
					</li>
					<li<?php if($page_name=='activity'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('activity'); ?>">
							<i class="icon-th-large"></i>
							日常活动
						</a>
					</li>
					<li<?php if($page_name=='mail_template'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('mail_template'); ?>">
							<i class="icon-th-large"></i>
							邮件模版
						</a>
					</li>
                    <hr />
					<li<?php if($page_name=='product'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('product'); ?>">
							<i class="icon-th-large"></i>
							产品管理
						</a>
					</li>
					<li<?php if($page_name=='server_list'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('server_list'); ?>">
							<i class="icon-signal"></i>
							服务器管理
						</a>
					</li>
					<hr />
					<li<?php if($page_name=='account'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('account'); ?>">
							<i class="icon-user"></i>
							帐号管理
						</a>
					</li>
					<li<?php if($page_name=='order'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('order'); ?>">
							<i class="icon-lock"></i>
							订单查询
						</a>
					</li>
					<li<?php if($page_name=='appeal'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('appeal'); ?>">
							<i class="icon-lock"></i>
							在线申诉
						</a>
					</li>
					<li<?php if($page_name=='coupon'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('coupon'); ?>">
							<i class="icon-lock"></i>
							礼券
						</a>
					</li>
					<hr />
					<li<?php if($page_name=='admin_role'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('admin_role'); ?>">
							<i class="icon-pushpin"></i>
							管理员角色
						</a>
					</li>
					<li<?php if($page_name=='admin'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('admin'); ?>">
							<i class="icon-th-list"></i>
							管理员
						</a>
					</li>
					<li<?php if($page_name=='log'): ?> class="active"<?php endif; ?>>
						<a href="<?php echo site_url('log'); ?>">
							<i class="icon-th-list"></i>
							操作日志
						</a>
					</li>
				</ul>