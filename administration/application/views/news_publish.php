				<div class="widget">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>发布新闻</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<br />
						<div class="tab-content">
							<div class="tab-pane active">
                                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('news/submit'); ?>" method="post" />
                                    <fieldset>
                                        <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                                        <input type="hidden" id="newsId" name="newsId" value="<?php echo $news_id; ?>" />
                                        <div class="control-group">											
                                            <label class="control-label" for="newsTitle">新闻标题</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="newsTitle" name="newsTitle" value="<?php echo $row->news_title; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="productId">所属产品</label>
                                            <div class="controls">
                                            	<select id="productId" name="productId" class="input-medium">
                                                <?php if(empty($product_result)): ?>
                                                	<option value="0">请先添加产品</option>
                                                <?php else: ?>
                                                <?php foreach($product_result as $value): ?>
                                                	<option value="<?php echo $value->product_id; ?>"<?php if($row->product_id==$value->product_id): ?> selected="selected"<?php endif; ?>><?php echo $value->product_name; ?></option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="newsCategory">自定义分类</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="newsCategory" name="newsCategory" value="<?php echo $row->news_category; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="wysisyg">新闻内容</label>
                                            <div class="controls">
                                                <textarea id="wysiwyg" name="wysiwyg" cols="80" rows="10" class="wysiwyg"><?php echo $row->news_content; ?></textarea>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <br />
                                        
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">提交</button>
                                        </div> <!-- /form-actions -->
                                    </fieldset>
                                </form>
                            </div>
                        </div>
					
					</div> <!-- /widget-content -->
					
				</div>
                <script src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>" language="javascript"></script>
                <script language="javascript">
				$(function() {
					CKEDITOR.replace('wysiwyg'); 
				});
				</script>