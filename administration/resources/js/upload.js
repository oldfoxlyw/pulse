function contentPicUpload(urlPrefix, uploadId, contentId, valueId, mode, maxCount) {
	$.ajaxFileUpload
	(
		{
			url: urlPrefix + '?el=' + uploadId,
			secureuri:false,
			fileElementId:uploadId,
			dataType: 'json',
			data:{},
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != 'null')
					{
						alert(data.error);
					}
					else
					{
						alert(data.msg);
						if(mode == "append")
						{
							var url = $("#" + valueId).val().split(";");
							if(url.length < maxCount)
							{
								$("#" + valueId).val(data.data + ";" + $("#" + valueId).val());
							}
							else
							{
								url.pop();
								url.push(data.data);
								$("#" + valueId).val(url.join(";"));
							}
							$("#" + contentId).prepend("<div class=\"preview\"><img src='" + data.data + "' /><a href='javascript:void(0)'>取消</a></div>");
						}
						else
						{
							$("#" + contentId).empty();
							$("#" + contentId).append("<div class=\"preview\"><img src='" + data.data + "' /><a href='javascript:void(0)'>取消</a></div>");
							$("#" + valueId).val(data.data);
						}
					}
				}
			},
			error: function (data, status, e) {
				alert(e);
			}
		}
	)
	return false;
}

$(function() {
	$(".preview a").live("click", function() {
		var value = $(this).parent().parent().prev().find("input[type='hidden']").val();
		var index = value.indexOf($(this).prev().attr("src") + ";");
		if(index >= 0)
		{
			value = value.replace($(this).prev().attr("src") + ";", "");
		}
		else
		{
			index = value.indexOf($(this).prev().attr("src"));
			if(index >= 0)
			{
				value = value.replace($(this).prev().attr("src"), "");
			}
		}
		$(this).parent().parent().prev().find("input[type='hidden']").val(value);
		$(this).parent().remove();
	});
});