var text=[];
text[1]={
	'title':'网易开始代理魔兽世界',
	'link':'http://www.163.com'
};
text[2]={
	'title':'瓢城Web俱乐部开始PHP教程',
	'link':'http://www.yc60.com'
};
text[3]={
	'title':'新浪微博开始大量招聘',
	'link':'http://www.weibo.com'
};
text[4]={
	'title':'腾讯开始进军网游市场',
	'link':'http://www.qq.com'
};
var i=Math.floor(Math.random()*4+1);
document.write('<a href="'+text[i].link+'" class="adv" target="_blank">'+text[i].title+'</a>');
