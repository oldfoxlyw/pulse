<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>星际</title>
<link href="<?php echo base_url("resources/css/body.css"); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("resources/css/in.css"); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url("resources/css/popu.css"); ?>" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main01">
	<div class="nav">
		<div class="navigate">
			<div class="logo"><img src="<?php echo base_url("resources/img/logo_top.png"); ?>" /></div>	
			<div class="run">
				<form>
					<div class="task">
						<input class="iput" value="USERNAME" />	
					</div>
					<div class="task">
						<input class="iput" value="Password" />	
					</div>	
					<div class="push">
						<img src="<?php echo base_url("resources/img/land.png"); ?>" />
					</div>
					<div class="txt">
						<ul>
							<li>注册</li>
							<li>|</li>
							<li>客服</li>
							<li>|</li>
							<li>论坛</li>
						</ul>
						<div class="clear"></div>
					</div>
				</form>
			</div>	
		</div>
	</div>
	<div class="detail">
		<div class="flash">
            <object data="<?php echo base_url("resources/img/ddd.swf"); ?>" type="application/x-shockwave-flash" width="1240" height="650" align="top">
              <!--<![endif]-->
              <param name="quality" value="high" />
              <param name="wmode" value="transparent" />
              <param name="swfversion" value="15.0.0.0" />
              <param name="expressinstall" value="<?php echo base_url("resources/Scripts/expressInstall.swf"); ?>" />
              <embed src="<?php echo base_url("resources/img/ddd.swf"); ?>" width="1240" height="650" quality="high" wmode="opaque" swfversion="15.0.0.0" expressinstall="<?php echo base_url("resources/Scripts/expressInstall.swf"); ?>" align="top"><noembed><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="获取 Adobe Flash Player" width="112" height="650" align="top" /></noembed></embed>
              <!-- 浏览器将以下替代内容显示给使用 Flash Player 6.0 和更低版本的用户。 -->
              <div>
                <h4>此页面上的内容需要较新版本的 Adobe Flash Player。</h4>
                <p><a href="http://www.adobe.com/go/getflashplayer"></a></p>
              </div>
              <!--[if !IE]>-->
            </object>
	  </div>
		<div class="txt"></div>
	</div>		
</div>
<!--over-->
<div class="main02">
	<div class="detail">
		<div class="paly"><img src="<?php echo base_url("resources/img/paly.png"); ?>" /></div>	
		<div class="story" id="btnStory"><img src="<?php echo base_url("resources/img/story.png"); ?>" /></div>
		<div class="story" id="btnStoryLight" style="display:none;"><img src="<?php echo base_url("resources/img/story2.png"); ?>" /></div>
		<div class="web" id="btnWeb"><a href="#"><img src="<?php echo base_url("resources/img/web.png"); ?>" /></a></div>
		<div class="web" id="btnWebLight" style="display:none;"><a href="#"><img src="<?php echo base_url("resources/img/web2.png"); ?>" /></a></div>
		<div class="picture" id="btnPictures"><img src="<?php echo base_url("resources/img/picture.png"); ?>" /></div>
		<div class="picture" id="btnPicturesLight" style="display:none;"><img src="<?php echo base_url("resources/img/picture2.png"); ?>" /></div>
		<div class="bbs" id="btnBBS"><a href="#"><img src="<?php echo base_url("resources/img/bbs.png"); ?>" /></a></div>
		<div class="bbs" id="btnBBSLight" style="display:none;"><a href="#"><img src="<?php echo base_url("resources/img/bbs2.png"); ?>" /></a></div>
	</div>
</div>
<!--over-->
<div class="main03">
	<div class="detail">
		<div class="left">
			<div class="reg">
				<img src="<?php echo base_url("resources/img/reg.png"); ?>" />	
				<form>
					<div class="version">
						<div class="txt">
							<p>输入账号</p>
						</div>
						<div class="dex">
							<input class="iput"  />	
						</div>
						<div class="clear"></div>	
					</div>	
					<!--over-->	
					<div class="version">
						<div class="txt">
							<p>输入账号</p>
						</div>
						<div class="dex">
							<input class="iput"  />	
						</div>
						<div class="clear"></div>	
					</div>	
					<!--over-->
					<div class="version">
						<div class="txt">
							<p>输入账号</p>
						</div>
						<div class="dex">
							<input class="iput"  />	
						</div>
						<div class="clear"></div>	
					</div>	
					<!--over-->	
					<div class="refer">
						<div class="txt">
							<p>同意《帐号注册协议》</p>
						</div>	
						<div class="dex">
							<img src="<?php echo base_url("resources/img/tj.png"); ?>" />
						</div>
					</div>
				</form>
			</div>
			<!--reg over-->	
			<div class="news">
				<img src="<?php echo base_url("resources/img/news.png"); ?>" />	
				<img src="<?php echo base_url("resources/img/bule-line.png"); ?>" />	
				<div class="cent">
                <?php for($i=0; $i<5; $i++): ?>
                <?php if(empty($news[$i])) break; ?>
					<p<?php if(empty($news[$i+1]) || $i==4): ?> style="background:none;"<?php endif; ?>><img src="<?php echo base_url("resources/img/trumpet.png"); ?>" align="absmiddle" style="margin-right:10px;" /><a href="#"><?php echo $news[$i]->news_title; ?></a></p>
                <?php endfor; ?>
				</div>	
				<img src="<?php echo base_url("resources/img/bule-line.png"); ?>" />		
			</div>
			<!--news over-->	
		</div>	
		<!--left over-->
		<div class="right">
			<div class="video">
				<div class="txt"></div>	
			</div>
			<div class="game">
				<div class="txt"></div>	
			</div>
			<div class="war"></div>
			<div class="assembly"></div>
		</div>
		<!--left over-->
	</div>	
	<!--detail over-->
	<div class="share">
		<div class="web"><img src="<?php echo base_url("resources/img/webqq.png"); ?>" /></div>	
		<div class="sina"><img src="<?php echo base_url("resources/img/sina.png"); ?>" /></div>
		<div class="wx"><img src="<?php echo base_url("resources/img/wx.png"); ?>" /></div>
	</div>
	<!--detail over-->
	<div class="foot">
		<div class="base">
			<h3>©2012 DIGIARTY ENTERTAINMENT, INC. ALL RIGHTS RESERVED</h3>
			<div class="logo"></div>	
			<div class="clear"></div>
		</div>
	</div>
</div>


<div id="popupPicture" class="popu">
	<div class="close">关闭</div>
	<div class="pointerleft"><img src="<?php echo base_url("resources/img/left05.png"); ?>" /></div>
	<div class="pointerright"><img src="<?php echo base_url("resources/img/right06.png"); ?>" /></div>
	<div class="top"></div>
	<div class="cent">
		<div class="left01"><img src="img/sreen01.jpg" /></div>
		<div class="right01"><img src="img/sreen01.jpg" /></div>
		<div class="clear"></div>
	</div>
	<div class="cent">
		<div class="left01"><img src="img/sreen01.jpg" /></div>
		<div class="right01"><img src="img/sreen01.jpg" /></div>
		<div class="clear"></div>
	</div>
	<div class="cent">
		<div class="left01"><img src="img/sreen01.jpg" /></div>
		<div class="right01"><img src="img/sreen01.jpg" /></div>
		<div class="clear"></div>
	</div>
	<div class="bot"></div>	
</div>


<div id="popupStory" class="popu01">
	<div class="close">关闭</div>
	<div class="top"></div>
	<div class="cent">
		<div class="adv"><img src="<?php echo base_url("resources/img/story.jpg"); ?>" /></div>
		<p>2012年的地球，从自然生态到人的思想道德都已沦落到腐败不堪的境地。由于人的自私，人的无休无止的贪婪，人类对自然环境和资源的长期掠夺性的破坏，地球自身的平衡系统已经面临崩溃。与此同时，人类社会的精神污染也同样触目惊心,社会上各种腐败和社会不良现象层出不穷.</p>
		<p>2012年的地球，从自然生态到人的思想道德都已沦落到腐败不堪的境地。由于人的自私，人的无休无止的贪婪，人类对自然环境和资源的长期掠夺性的破坏，地球自身的平衡系统已经面临崩溃。与此同时，人类社会的精神污染也同样触目惊心,社会上各种腐败和社会不良现象层出不穷.</p>
		<p>2012年的地球，从自然生态到人的思想道德都已沦落到腐败不堪的境地。由于人的自私，人的无休无止的贪婪，人类对自然环境和资源的长期掠夺性的破坏，地球自身的平衡系统已经面临崩溃。与此同时，人类社会的精神污染也同样触目惊心,社会上各种腐败和社会不良现象层出不穷.</p>
		<div class="clear"></div>
	</div>
	
	<div class="bot"></div>	
</div>
<script src="<?php echo base_url("resources/js/jquery-1.10.2.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("resources/js/popup.js"); ?>" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$("#btnWeb").mouseover(function() {
		$("#btnWebLight").fadeIn();
	});
	$("#btnWebLight").mouseout(function() {
		$("#btnWebLight").fadeOut();
	});
	
	$("#btnStory").mouseover(function() {
		$("#btnStoryLight").fadeIn();
	});
	$("#btnStoryLight").mouseout(function() {
		$("#btnStoryLight").fadeOut();
	}).click(function() {
		popmask();
		$("#popupStory").fadeIn("fast");
		center("popupStory");
	});
	
	$("#btnPictures").mouseover(function() {
		$("#btnPicturesLight").fadeIn();
	});
	$("#btnPicturesLight").mouseout(function() {
		$("#btnPicturesLight").fadeOut();
	}).click(function() {
		popmask();
		$("#popupPicture").fadeIn("fast");
		center("popupPicture");
	});
	
	$("#btnBBS").mouseover(function() {
		$("#btnBBSLight").fadeIn();
	});
	$("#btnBBSLight").mouseout(function() {
		$("#btnBBSLight").fadeOut();
	});
	
	$(".close").click(function() {
		$("#popupmask").remove();
		$(this).parent().fadeOut("fast");
	});
});
</script>
</body>
</html>


