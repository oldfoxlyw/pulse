
				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>服务器列表</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<table class="table table-striped table-bordered" id="imgTable">
							<thead>
								<tr>
									<th>所属产品</th>
									<th>服务器编号</th>
									<th>名称</th>
									<th>开启时间</th>
									<th>服务器状态</th>
									<th>操作</th>
								</tr>
							</thead>
							
							<tbody>
                            <?php if(!empty($result)): ?>
                            <?php foreach($result as $row1): ?>
								<tr>
									<td><?php echo $row1->product_name; ?></td>
									<td><?php echo $row1->server_id; ?></td>
									<td><?php echo $row1->server_name; ?></td>
									<td><?php if(!empty($row1->server_time_start)) echo date('Y-m-d H:i:s', $row1->server_time_start); else echo '-'; ?></td>
									<td>
                                    <select name="rowStatus" class="input-small">
                                   	  <option value="NORMAL"<?php if($row1->server_status=='NORMAL'): ?> selected="selected"<?php endif; ?>>正常</option>
                                      <option value="HOT"<?php if($row1->server_status=='HOT'): ?> selected="selected"<?php endif; ?>>火爆</option>
                                      <option value="CLOSE"<?php if($row1->server_status=='CLOSE'): ?> selected="selected"<?php endif; ?>>关闭</option>
                                    </select>
                                  	</td>
							  		<td class="action-td">
										<a href="<?php echo site_url('server/edit/' . $row1->product_id . '_' . $row1->server_id); ?>" class="btn btn-small btn-warning">
											<i class="icon-edit"></i>								
										</a>					
										<a href="<?php echo site_url('server/delete/' . $row1->product_id . '_' . $row1->server_id); ?>" class="btn btn-small">
											<i class="icon-remove"></i>						
										</a>
									</td>
								</tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            	<tr>
                                	<td colspan="7">没有服务器</td>
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
						<h3><?php if(empty($edit)): ?>添加<?php else: ?>修改<?php endif; ?>服务器</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<form id="edit-profile" class="form-horizontal" action="<?php echo site_url('server/submit'); ?>" method="post" />
                                    <fieldset>
                                        <input type="hidden" id="edit" name="edit" value="<?php echo $edit; ?>" />
                                        <input type="hidden" id="oldServerId" name="oldServerId" value="<?php echo $old_server_id; ?>" />
                                        <input type="hidden" id="oldProductId" name="oldProductId" value="<?php echo $old_product_id; ?>" />
                                        
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
                                            <label class="control-label" for="serverId">服务器编号</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="serverId" name="serverId" value="<?php echo $row->server_id; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        <link rel="stylesheet" href="<?php echo base_url('resources/css/jquery-ui.css'); ?>" type="text/css" />
                                        <div class="control-group">
                                            <label class="control-label" for="serverName">服务器名称</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="serverName" name="serverName" value="<?php echo $row->server_name; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverTimeStart">开启时间</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="serverTimeStart" name="serverTimeStart" value="<?php if(!empty($row->server_time_start)) echo date('Y-m-d H:i:s', $row->server_time_start); ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverStatus">产品状态</label>
                                            <div class="controls">
                                                <select name="serverStatus" class="input-medium">
                                                  <option value="HOT"<?php if($row->server_status=='HOT'): ?> selected="selected"<?php endif; ?>>火爆</option>
                                                  <option value="NORMAL"<?php if($row->server_status=='NORMAL'): ?> selected="selected"<?php endif; ?>>正常</option>
                                                  <option value="CLOSE"<?php if($row->server_status=='CLOSE'): ?> selected="selected"<?php endif; ?>>关闭</option>
                                                </select>
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverWebUrl">Web服务器地址</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="serverWebUrl" name="serverWebUrl" value="<?php echo $row->server_web_url; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverGameIP">C++服务器地址</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="serverGameIP" name="serverGameIP" value="<?php echo $row->server_game_ip; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverGamePort">C++服务器端口</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium" id="serverGamePort" name="serverGamePort" value="<?php echo $row->server_game_port; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverServiceUrl">平台服务器地址</label>
                                            <div class="controls">
                                                <input type="text" class="input-large" id="serverServiceUrl" name="serverServiceUrl" value="<?php echo $row->server_service_url; ?>" />
                                            </div> <!-- /controls -->
                                        </div> <!-- /control-group -->
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="serverType">是否为测试服</label>
                                            <div class="controls">
                                                <input type="checkbox" id="serverType" name="serverType" value="1"<?php if($row->server_type=='0'): ?> checked="checked"<?php endif; ?> />
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
                
                <script src="<?php echo base_url('resources/js/jquery-ui.js'); ?>" language="javascript"></script>
                <script language="javascript">
				$(function() {
					$.datepicker.regional['zh-CN'] = {
						clearText: '清除',
						clearStatus: '清除已选日期',
						closeText: '关闭',
						closeStatus: '不改变当前选择',
						prevText: '<上月',
						prevStatus: '显示上月',
						prevBigText: '<<',
						prevBigStatus: '显示上一年',
						nextText: '下月>',
						nextStatus: '显示下月',
						nextBigText: '>>',
						nextBigStatus: '显示下一年',
						currentText: '今天',
						currentStatus: '显示本月',
						monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
						monthNamesShort: ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'],
						monthStatus: '选择月份',
						yearStatus: '选择年份',
						weekHeader: '周',
						weekStatus: '年内周次',
						dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
						dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
						dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
						dayStatus: '设置 DD 为一周起始',
						dateStatus: '选择 m月 d日, DD',
						dateFormat: 'yy-mm-dd',
						firstDay: 7,
						initStatus: '请选择日期',
						isRTL: false
					};
					$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
					$("#serverTimeStart").datepicker();
				});
				</script>