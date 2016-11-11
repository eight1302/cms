var header=[];
header[1]={
	'title':'爱制造旗舰店',
	'pic':'/cms/uploads/20160402/20160402223304116.png',
	'link':'http://www.360.cn'
};
header[2]={
	'title':'暑假人气网游推荐',
	'pic':'/cms/uploads/20160402/20160402223357265.png',
	'link':'http://www.163.com'
};
header[3]={
	'title':'生活家买一送三',
	'pic':'/cms/uploads/20160402/20160402223331273.png',
	'link':'http://www.tmall.com'
};
var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+header[i].link+'" target="_blank" title="'+header[i].title+'"><img src="'+header[i].pic+'"></a>');
