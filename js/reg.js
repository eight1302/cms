
//验证登录
function checkReg() {

	var fm = document.reg;
	if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 20) {
		alert('警告：用户名不得为空并且不得小于两位并且不得大于20位！');
		fm.user.focus();
		return false;
	}
	if (fm.pass.value.length < 6) {
		alert('警告：密码不得小于6位！');
		fm.pass.focus();
		return false;
	}
	if (fm.pass.value != fm.notpass.value) {
		alert('警告：密码和密码确认不一致！');
		fm.notpass.focus();
		return false;
	}
	if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
		alert('邮件格式不正确');
		fm.email.value = ''; //清空
		fm.email.focus(); //将焦点以至表单字段
		return false;
	}
	if (fm.code.value.length != 4 ) {
		alert('警告：验证码必须为四位！');
		fm.code.focus();
		return false;
	}
	return true;
}


function checkLogin() {
	var fm = document.login;
	if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 20) {
		alert('警告：用户名不得为空并且不得小于两位并且不得大于20位！');
		fm.user.focus();
		return false;
	}
	if (fm.pass.value.length < 6) {
		alert('警告：密码不得小于6位！');
		fm.pass.focus();
		return false;
	}
	if (fm.code.value.length != 4 ) {
		alert('警告：验证码必须为四位！');
		fm.code.focus();
		return false;
	}
	return true;
}


