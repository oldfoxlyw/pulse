
				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>产品列表</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<table class="table table-striped table-bordered" id="imgTable">
							<thead>
								<tr>
									<th>编号</th>
									<th>产品名称</th>
									<th>产品类别</th>
									<th>产品状态</th>
									<th>是否设置为推荐服</th>
									<th>排序</th>
									<th>操作</th>
								</tr>
							</thead>
							
							<tbody>
                            <?php if(!empty($result)): ?>
                            <?php foreach($result as $row1): ?>
								<tr>
									<td><?php echo $row1->product_id; ?></td>
									<td><?php echo $row1->product_name; ?></td>
									<td><?php echo $row1->product_category; ?></td>
									<td>
                                    <select name="rowStatus" class="input-small">
                                   	  <option value="HOT"<?php if($row1->product_status=='HOT'): ?> selected="selected"<?php endif; ?>>火爆</option>
                                      <option value="PUBLIC"<?php if($row1->product_status=='PUBLIC'): ?> selected="selected"<?php endif; ?>>开放</option>
                                      <option value="BETA"<?php if($row1->product_status=='BETA'): ?> selected="selected"<?php endif; ?>>测试</option>
                                      <option value="CLOSE"<?php if($row1->product_status=='CLOSE'): ?> selected="selected"<?php endif; ?>>关闭</option>
                                    </select>
                                  </td>
									<td>
									  <input type="checkbox" name="rowRecommand"<?php if($row1->product_recommand=='1'): ?> checked="checked"<?php endif; ?> value="1" />
									  是
								    </td>
									<td><?php echo $row1->product_sort; ?></td>
							  		<td class="action-td">
										<a href="<?php echo site_url('product/edit/' . $row1->product_id); ?>" class="btn btn-small btn-warning">
											<i class="icon-edit"></i>								
										</a>					
										<a href="<?php echo site_url('product/delete/' . $row1->product_id); ?>" class="btn btn-small">
											<i class="icon-remove"></i>						
										</a>
									</td>
								</tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            	<tr>
                                	<td colspan="7">没有产品</td>
                                </tr>
                            <?php endif; ?>
							</tbody>
                            <tfoot>
                            	<tr>
                                	<td colspan="7"><?php echo $pagination; ?></td>
                                </tr>
                            </tfoot>
						</table>
					
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->
                
                <div class="widget">
                    
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>产品</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('product/submit'); ?>" method="post" />
                                    <fieldset>
                                        <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                                        <input type="hidden" id="productId" name="productId" value="<?php echo $product_id; ?>" />
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productName">产品名称</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="productName" name="productName" value="<?php echo $row->product_name; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productCategory">产品分类</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="productCategory" name="productCategory" value="<?php echo $row->product_category; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productComment">产品描述</label>
                                            <div class="controls">
                                                <textarea id="productComment" name="productComment" class="input-xxlarge" cols="80" rows="10"><?php echo $row->product_comment; ?></textarea>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productUrlWebsite">产品官网地址</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="productUrlWebsite" name="productUrlWebsite" value="<?php echo $row->product_url_website; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productUrlEntry">产品游戏地址</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="productUrlEntry" name="productUrlEntry" value="<?php echo $row->product_url_entry; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productStatus">产品状态</label>
                                            <div class="controls">
                                                <select name="productStatus" class="input-medium">
                                                  <option value="HOT"<?php if($row->product_status=='HOT'): ?> selected="selected"<?php endif; ?>>火爆</option>
                                                  <option value="PUBLIC"<?php if($row->product_status=='PUBLIC'): ?> selected="selected"<?php endif; ?>>开放</option>
                                                  <option value="BETA"<?php if($row->product_status=='BETA'): ?> selected="selected"<?php endif; ?>>测试</option>
                                                  <option value="CLOSE"<?php if($row->product_status=='CLOSE'): ?> selected="selected"<?php endif; ?>>关闭</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productRecommand">是否设置为推荐服</label>
                                            <div class="controls">
                                                <input type="checkbox" id="productRecommand" name="productRecommand"<?php if($row->product_recommand=='1'): ?> checked="checked"<?php endif; ?> value="1" />是
												<p class="help-block">同一款游戏有且仅有一个推荐服</p>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productSort">排序</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="productSort" name="productSort" value="<?php echo $row->product_sort; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productCurrencyName">游戏现金币名称</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="productCurrencyName" name="productCurrencyName" value="<?php echo $row->product_currency_name; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productExchangeRate">平台币兑换比例</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="productExchangeRate" name="productExchangeRate" value="<?php echo $row->product_exchange_rate; ?>" />
												<p class="help-block">1平台币能兑换多少游戏现金币</p>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productServerRole">获取角色列表的接口</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="productServerRole" name="productServerRole" value="<?php echo $row->product_server_role; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productServerRecharge">充值的接口</label>
                                            <div class="controls">
                                                <input type="text" class="input-xlarge" id="productServerRecharge" name="productServerRecharge" value="<?php echo $row->product_server_recharge; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <br />
                                        
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">提交</button>
                                        </div> <!-- /form-actions -->
                                    </fieldset>
                                </form>
					
					</div> <!-- /widget-content -->
				
				</div>