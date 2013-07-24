
				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>截图列表</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<table class="table table-striped table-bordered" id="imgTable">
							<thead>
								<tr>
									<th>编号</th>
									<th>标题</th>
									<th>所属产品</th>
									<th>图片</th>
									<th>发布时间</th>
									<th>管理</th>
								</tr>
							</thead>
							
							<tbody>
                            <?php if(!empty($result)): ?>
                            <?php foreach($result as $row1): ?>
								<tr>
									<td><?php echo $row1->screenshot_id; ?></td>
									<td><?php echo $row1->screenshot_title; ?></td>
									<td><?php echo $row1->product_name; ?></td>
									<td><img src="<?php echo $row1->screenshot_pic_url; ?>" /></td>
									<td><?php if(!empty($row1->screenshot_posttime)) echo date('Y-m-d H:i:s', $row1->screenshot_posttime); else echo '-'; ?></td>
									<td class="action-td">
										<a href="<?php echo site_url('screenshot/edit/' . $row1->screenshot_id); ?>" class="btn btn-small btn-warning">
											<i class="icon-edit"></i>								
										</a>					
										<a href="<?php echo site_url('screenshot/delete/' . $row1->screenshot_id); ?>" class="btn btn-small">
											<i class="icon-remove"></i>						
										</a>
									</td>
								</tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            	<tr>
                                	<td colspan="6">没有截图</td>
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
                
                <div class="widget">
                    
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>截图</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('screenshot/submit'); ?>" method="post" />
                                    <fieldset>
                                        <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                                        <input type="hidden" id="screenshotId" name="screenshotId" value="<?php echo $screenshot_id; ?>" />
                                        
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
                                            <label class="control-label" for="screenshotTitle">截图标题</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="screenshotTitle" name="screenshotTitle" value="<?php echo $row->screenshot_title; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">											
                                            <label class="control-label" for="wysisyg">截图描述</label>
                                            <div class="controls">
                                                <textarea id="wysiwyg" name="wysiwyg" cols="80" rows="10" class="wysiwyg"><?php echo $row->screenshot_content; ?></textarea>
                                            </div> <!-- /controls -->				
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="picUpload">上传图片</label>
                                            <div class="controls">
                                                <input name="picUpload" type="file" id="picUpload" size="20" class="input-medium" />
                                                <input type="button" name="btnUpload" id="btnUpload" value="上传" onclick="javascript:contentPicUpload('<?php echo site_url('utils/doPicUpload'); ?>', 'picUpload', 'screenshotPicUrlContent', 'screenshotPicUrl')" class="btn btn-primary" />
                                                <input name="screenshotPicUrl" type="hidden" id="screenshotPicUrl" value="<?php echo $row->screenshot_pic_url; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div id="screenshotPicUrlContent" class="control-group">
                                        <?php if(!empty($row->screenshot_pic_url)): ?>
                                        	<div class="preview"><img src="<?php echo $row->screenshot_pic_url; ?>" /><a href="javascript:void(0)">取消</a></div>
                                        <?php endif; ?>
                                        </div>
                                        
                                        <br />
                                        
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">提交</button>
                                        </div> <!-- /form-actions -->
                                    </fieldset>
                                </form>
					
					</div> <!-- /widget-content -->
				
				</div>
                <script src="<?php echo base_url('resources/js/uploader/ajaxfileupload.js'); ?>" language="javascript"></script>
                <script src="<?php echo base_url('resources/js/upload.js'); ?>" language="javascript"></script>
                <script src="<?php echo base_url('resources/js/jquery.resizeimg.js'); ?>" language="javascript"></script>
                <script src="<?php echo base_url('resources/ckeditor/ckeditor.js'); ?>" language="javascript"></script>
                <script language="javascript">
				$(function() {
					$("#imgTable img").resizeImg({w: 300, h: 150});
					$(".preview img").resizeImg();
					CKEDITOR.replace('wysiwyg', {height: "200px", toolbar: "Basic"}); 
				});
				</script>