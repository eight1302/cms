/**
 * Created by JOIN on 2016/4/3.
 */
function link(type) {
    var logo=document.getElementById('logo');

    switch(type) {
        case 1:
            logo.style.display='none';
            break;
        case 2:
            logo.style.display='block';
    }
}
function checkUrl(){
    var fm=document.friendlink;
    if (fm.webname.value == '' || fm.webname.value.length > 1000) {
        alert('警告：网站名不得为空并且不得大于20位！');
        fm.webname.focus();
        return false;
    }
    if (fm.weburl.value == '' || fm.weburl.value.length > 100) {
        alert('警告：网站链接不得为空并且不得大于20位！');
        fm.weburl.focus();
        return false;
    }
    if(fm.type[1].checked){
        if (fm.logourl.value == '' || fm.logourl.value.length > 100) {
            alert('警告：Logo链接不得为空并且不得大于20位！');
            fm.logourl.focus();
            return false;
        }
    }

    if (fm.user.value.length > 20) {
        alert('警告：站长名不得大于20位！');
        fm.user.focus();
        return false;
    }
    if(fm.code.value.length!=4){
        alert('警告：验证码必须是4位');
        fm.code.focus();
        return false;
    }
    return true;
}
