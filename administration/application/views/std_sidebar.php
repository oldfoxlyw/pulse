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
					<li>
						<a href="./faq.html">
							<i class="icon-pushpin"></i>
							FAQ	
						</a>
					</li>
					<li>
						<a href="./plans.html">
							<i class="icon-th-list"></i>
							Pricing Plans		
						</a>
					</li>
					<li>
						<a href="./grid.html">
							<i class="icon-th-large"></i>
							Grid Layout	
							<span class="label label-warning pull-right">5</span>
						</a>
					</li>
					<li>
						<a href="./charts.html">
							<i class="icon-signal"></i>
							Charts	
						</a>
					</li>
					<li>
						<a href="./account.html">
							<i class="icon-user"></i>
							User Account							
						</a>
					</li>
					<li>
						<a href="./login.html">
							<i class="icon-lock"></i>
							Login	
						</a>
					</li>
				</ul>
				<hr />