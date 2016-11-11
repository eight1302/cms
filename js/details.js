//验证评论
function checkComment() {
	var fm = document.comment;
	if (fm.content.value == '' || fm.content.value.length >255) {
		alert('警告：评论内容不得为空并且不得大于255位！');
		fm.content.focus();
		return false;
	}
	if (fm.code.value.length != 4 ) {
		alert('警告：验证码必须为四位！');
		fm.code.focus();
		return false;
	}
	return true;
}


