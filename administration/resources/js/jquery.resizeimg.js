/*------------------------------------------------------------------------------
*插件名称：图片自适应容器大小插件
*调用方式：$(selector).resizeImg({w:maxWidth,h:maxHeight})
*QQ:530624206
*时间：2010-05-14
--------------------------------------------------------------------------------
*/

(function($){

 $.fn.extend({

resizeImg:function(opt,callback){

var defaults={w:200,h:150};

var opts = $.extend(defaults, opt);

  this.each(function(){

    $(this).load(function(){

    var imgWidth=this.width,imgHeight=this.height;

    if(imgWidth>opts["w"]){

  this.width=opts["w"];

  this.height=imgHeight*(opts["w"]/imgWidth);

  imgWidth=opts["w"];

  imgHeight=this.height;

  }

if(imgHeight>opts["h"]){

this.height=opts["h"];

this.width=imgWidth*(opts["h"]/imgHeight);

imgHeight=opts["h"];

imgWidth=this.width;

}

//水平居中，垂直居中

$(this).css({"margin-top":(opts["h"]-imgHeight)/2,"margin-left":(opts["w"]-imgWidth)/2});

});

});
         }
   });
 })(jQuery);
