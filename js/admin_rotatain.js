window.onload = function () {
	var title = document.getElementById('title');
	var ol = document.getElementsByTagName('ol');
	var a = ol[0].getElementsByTagName('a');

	for (i=0;i<a.length;i++) {
		a[i].className = null;
		if (title.innerHTML == a[i].innerHTML) {
			a[i].className = 'selected';
		}
	}
};

function centerWindow(url, name, width, height) {
	var left = (screen.width - width) / 2;
	var top = (screen.height - height) / 2 - 50;
	window.open(url, name, 'width='+width+',height='+height+',top='+top+',left='+left);
}



//验证addContent
function checkAddRotatain() {
	var fm = document.content;
	if (fm.thumbnail.value == '') {
		alert('警告：轮播图不得为空！');
		fm.thumbnail.focus();
		return false;
	}
	if (fm.link.value == '') {
		alert('警告：链接不得为空！');
		fm.link.focus();
		return false;
	}
	if (fm.title.value.length>20) {
		alert('警告：标题不得大于20位！');
		fm.link.focus();
		return false;
	}
	if (fm.info.value.length>200) {
		alert('警告：描述不得大于200位！');
		fm.info.focus();
		return false;
	}
	return true;
}




