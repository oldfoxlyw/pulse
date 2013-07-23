
				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>新闻列表</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>编号</th>
									<th>标题</th>
									<th>所属产品</th>
									<th>所属分类</th>
									<th>发布时间</th>
									<th>管理</th>
								</tr>
							</thead>
							
							<tbody>
                            <?php if(!empty($result)): ?>
                            <?php foreach($result as $row): ?>
								<tr>
									<td><?php echo $row->news_id; ?></td>
									<td><?php echo $row->news_title; ?></td>
									<td><?php echo $row->product_name; ?></td>
									<td><?php echo $row->news_category; ?></td>
									<td><?php if(!empty($row->news_posttime)) echo date('Y-m-d H:i:s', $row->news_posttime); else echo '-'; ?></td>
									<td class="action-td">
										<a href="<?php echo site_url('news/edit/' . $row->news_id); ?>" class="btn btn-small btn-warning">
											<i class="icon-edit"></i>								
										</a>					
										<a href="<?php echo site_url('news/delete/' . $row->news_id); ?>" class="btn btn-small">
											<i class="icon-remove"></i>						
										</a>
									</td>
								</tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            	<tr>
                                	<td colspan="6">没有新闻</td>
                                </tr>
                            <?php endif; ?>
							</tbody>
                            <tfoot>
                            	<tr>
                                	<td colspan="6"><?php echo $pagination; ?></td>
                                </tr>
                            </tfoot>
						</table>
					
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->