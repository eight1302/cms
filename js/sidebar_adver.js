var sidebar=[];
sidebar[1]={
	'title':'车优惠伴我行',
	'pic':'/cms/uploads/20160402/20160402223018517.png',
	'link':'http://www.yc60.com'
};
sidebar[2]={
	'title':'M绅士全场3折',
	'pic':'/cms/uploads/20160402/20160402223118955.png',
	'link':'http://www.tmall.com'
};
sidebar[3]={
	'title':'天猫淘宝',
	'pic':'/cms/uploads/20160402/20160402223234578.jpeg',
	'link':'http://www.tmall.com'
};
var i=Math.floor(Math.random()*3+1);
document.write('<a href="'+sidebar[i].link+'" target="_blank" title="'+sidebar[i].title+'"><img src="'+sidebar[i].pic+'"></a>');
