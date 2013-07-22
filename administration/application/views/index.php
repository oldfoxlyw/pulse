				<h1 class="page-title">
					<i class="icon-home"></i>
					控制面板					
				</h1>
				
				<div class="stat-container">
										
					<div class="stat-holder">						
						<div class="stat">							
							<span><?php echo $account_count; ?></span>							
							用户数
						</div> <!-- /stat -->						
					</div> <!-- /stat-holder -->
					
					<div class="stat-holder">						
						<div class="stat">							
							<span<?php if($appeal_count > 0): ?> style="color:#F00;"<?php endif; ?>><?php echo $appeal_count; ?></span>							
							未处理的申诉
						</div> <!-- /stat -->
					</div> <!-- /stat-holder -->
					
					<div class="stat-holder">
						<div class="stat">
							<span><?php echo $order_count; ?></span>							
							订单总数
						</div> <!-- /stat -->						
					</div> <!-- /stat-holder -->
					
				</div> <!-- /stat-container -->
				
				<div class="widget">
										
					<div class="widget-header">
						<i class="icon-signal"></i>
						<h3></h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">					
						
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->